<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class CustomerInvoiceController extends Controller
{
    public function index() //ambil invoice yg ada relasi dengan service milik customer 
    {
        $customerId = session('customer_id');
        if (!$customerId) {
            abort(403);
        }
        //wherehas=filter invoice berdasarkan relasi, not langsung dari tabel invoice
        $invoices = Invoice::whereHas('serviceTracking', function ($q) use ($customerId) {
            $q->where('customers_id', $customerId);
        })->latest()->get();

        return view('customer.invoice-list', compact('invoices'));
    }

    public function show($id) //show detail invoice
    {
        $customerId = session('customer_id');
        if (!$customerId) {
            abort(403);
        }

        $invoice = Invoice::with([
            'items',
            'serviceTracking.customer',
            'serviceTracking.vehicle'
        ])->findOrFail($id);

        // SECURITY
        if ($invoice->serviceTracking->customers_id != $customerId) {
            abort(403);
        }

        return view('customer.invoice', [
            'invoice' => $invoice,
            'pdfUrl'  => asset($invoice->pdf_url), //show link pdf-readonly
        ]);
    }
}