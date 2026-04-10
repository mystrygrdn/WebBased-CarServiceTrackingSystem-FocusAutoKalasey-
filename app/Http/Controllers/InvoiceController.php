<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\ServiceTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Enums\ServiceStatus;
use PDF;

class InvoiceController extends Controller
{
    //pilih service untuk dibuat invoice - prevent double invoice
    //ambil service yg blm selesai, yg sdh selesai tdk bisa buat invoice
    public function index()
    {
        $serviceTrackings = ServiceTracking::with([
            'customer',
            'vehicle'
        ])
        ->whereBetween('status', [
            ServiceStatus::DITERIMA->value,
            ServiceStatus::LANGKAH_AKHIR->value
        ]) // ✅ HANYA STATUS 1–5
        ->orderBy('created_at', 'DESC')
        ->get();

        return view('admin.createinvoice', compact('serviceTrackings'));
    }

    //OPTIONAL//
    public function create()
    {
        return redirect()->route('invoice.index');
    }

    //simpan invoice dan generate PDF - transaksi lengkap +otomatis
    public function store(Request $request)
    {
        $request->validate([
            'service_tracking_id' => 'required|exists:service_tracking,id',
            'items.*.pekerjaan_part' => 'required|string',
            'items.*.qty' => 'required|numeric|min:1',
            'items.*.harga' => 'required|string',
        ]);

        $service = ServiceTracking::with([
            'customer',
            'vehicle'
        ])->findOrFail($request->service_tracking_id);

        /* HITUNG TOTAL */
        $subtotal = 0;
        foreach ($request->items as $item) {
            $qty   = (int) $item['qty'];
            $harga = (int) str_replace('.', '', $item['harga']);
            $subtotal += $qty * $harga;
        }

        $tax   = round($subtotal * 0.11);
        $total = $subtotal + $tax;

        /* SIMPAN INVOICE */
        $invoice = Invoice::create([
            'service_tracking_id' => $service->id,
            'nomor_invoice' => 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(4)),
            'tanggal_masuk' => $service->tanggal_masuk,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
        ]);

        /* SIMPAN ITEM */
        foreach ($request->items as $item) {
            $qty   = (int) $item['qty'];
            $harga = (int) str_replace('.', '', $item['harga']);

            InvoiceItem::create([
                'invoice_id'     => $invoice->id,
                'pekerjaan_part' => $item['pekerjaan_part'],
                'qty'            => $qty,
                'harga'          => $harga,
                'subtotal'       => $qty * $harga,
                'keterangan'     => $item['keterangan'] ?? null,
            ]);
        }

        /* LOAD RELASI */
        $invoice->load([
            'items',
            'serviceTracking.customer',
            'serviceTracking.vehicle'
        ]);

        /* GENERATE PDF */
        $pdf = PDF::loadView('admin.pdfinvoice', compact('invoice'));

        $fileName = 'invoice_' . $invoice->id . '.pdf';
        $path = storage_path('app/public/invoice/' . $fileName);
        $pdf->save($path);

        /* SIMPAN PATH */
        $invoice->update([
            'pdf_url' => 'storage/invoice/' . $fileName
        ]);

        return redirect()->route('invoice.preview', $invoice->id);
    }

    //PREVIEW PDF//
    public function preview($id)
    {
        $invoice = Invoice::findOrFail($id);

        return view('admin.invoice-preview', [
            'invoice' => $invoice,
            'pdfUrl'  => asset($invoice->pdf_url),
        ]);
    }

    //buka pdf di tab baru//
    public function pdf($id)
    {
        $invoice = Invoice::with([
            'items',
            'serviceTracking.customer',
            'serviceTracking.vehicle'
        ])->findOrFail($id);

        $pdf = PDF::loadView('admin.pdfinvoice', compact('invoice'));
        return $pdf->stream('invoice_' . $invoice->id . '.pdf');
    }

    //riwayat invoice
    public function history()
    {
        $invoices = Invoice::with([
            'serviceTracking.customer',
            'serviceTracking.vehicle'
        ])->latest()->get();

        return view('admin.riwayatinvoice', compact('invoices'));
    }

    //edit invoice - selalu sinkron dengan pdf
    public function edit($id)
    {
        $invoice = Invoice::with([
            'items',
            'serviceTracking.customer',
            'serviceTracking.vehicle'
        ])->findOrFail($id);

        return view('admin.editinvoice', compact('invoice'));
    }

    //update - generate lagi pdf
    public function update(Request $request, $id)
    {
        $invoice = Invoice::with('items')->findOrFail($id);

        $request->validate([
            'items.*.pekerjaan_part' => 'required|string',
            'items.*.qty' => 'required|numeric|min:1',
            'items.*.harga' => 'required|string',
        ]);

        /* HITUNG ULANG */
        $subtotal = 0;
        foreach ($request->items as $item) {
            $qty   = (int) $item['qty'];
            $harga = (int) str_replace('.', '', $item['harga']);
            $subtotal += $qty * $harga;
        }

        $tax   = round($subtotal * 0.11);
        $total = $subtotal + $tax;

        /* UPDATE INVOICE */
        $invoice->update([
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
        ]);

        /* HAPUS ITEM LAMA */
        $invoice->items()->delete();

        /* SIMPAN ITEM BARU */
        foreach ($request->items as $item) {
            $qty   = (int) $item['qty'];
            $harga = (int) str_replace('.', '', $item['harga']);

            InvoiceItem::create([
                'invoice_id'     => $invoice->id,
                'pekerjaan_part' => $item['pekerjaan_part'],
                'qty'            => $qty,
                'harga'          => $harga,
                'subtotal'       => $qty * $harga,
                'keterangan'     => $item['keterangan'] ?? null,
            ]);
        }

        /* LOAD RELASI */
        $invoice->load([
            'items',
            'serviceTracking.customer',
            'serviceTracking.vehicle'
        ]);

        /* REGENERATE PDF */
        $pdf = PDF::loadView('admin.pdfinvoice', compact('invoice'));

        $fileName = 'invoice_' . $invoice->id . '.pdf';
        $path = storage_path('app/public/invoice/' . $fileName);
        $pdf->save($path);

        return redirect()->route('invoice.preview', $invoice->id)
            ->with('success', 'Invoice berhasil diupdate');
    }

    //delete invoice dan pdf//
    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);

        if ($invoice->pdf_url) {
            $file = str_replace('storage/', '', $invoice->pdf_url);
            Storage::disk('public')->delete($file);
        }

        $invoice->items()->delete();
        $invoice->delete();

        return redirect()->route('invoice.history')
            ->with('success', 'Invoice berhasil dihapus');
    }
}