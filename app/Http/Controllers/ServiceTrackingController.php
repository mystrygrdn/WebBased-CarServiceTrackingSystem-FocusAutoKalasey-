<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceTracking;
use App\Models\Customers;
use App\Models\Vehicles;
use App\Models\Admin;
use Illuminate\Support\Str;
use App\Enums\ServiceStatus;

class ServiceTrackingController extends Controller
{
    //Tampilkan halaman daftar & form tambah service//
    public function create()
    {
        return view('admin.prosesservice', [
            'customers' => Customers::with('vehicles')->get(),
            'admins'    => Admin::all(),
            'service_tracking' => ServiceTracking::with(['customer','vehicle','admin'])
                ->where('status', '!=', ServiceStatus::SELESAI->value)
                ->orderBy('updated_at', 'DESC')
                ->get(),
        ]);
    }

    //Simpan service baru//
    public function store(Request $request)
    {
        $request->validate([
            'customers_id'   => 'required',
            'vehicles_id'    => 'required',
            'admin_id'       => 'required',
            'tanggal_masuk'  => 'required|date',
            'estimated_date' => 'nullable|date',
            'status'         => 'required|integer|min:' . ServiceStatus::DITERIMA->value . '|max:' . ServiceStatus::SELESAI->value,
            'jenis_service'  => 'nullable|string',
            'notes'          => 'nullable|string',
            'photo'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3072',
        ]);

        $no_service = 'SRV-' . strtoupper(Str::random(6));

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('service_photos', 'public');
        }

        // Record initial status timestamp on create
        $timestamps = [$request->status => now()->format('Y-m-d H:i:s')];

        ServiceTracking::create([
            'customers_id'      => $request->customers_id,
            'vehicles_id'       => $request->vehicles_id,
            'admin_id'          => $request->admin_id,
            'no_service'        => $no_service,
            'status'            => $request->status,
            'status_timestamps' => $timestamps,
            'tanggal_masuk'     => $request->tanggal_masuk,
            'estimated_date'    => $request->estimated_date,
            'jenis_service'     => $request->jenis_service,
            'notes'             => $request->notes,
            'photo_url'         => $photoPath,
        ]);

        return redirect()->route('tracking.create')
            ->with('success', 'Data service berhasil disimpan!');
    }

    //Tampilkan halaman edit service//
    public function edit($id)
    {
        $service   = ServiceTracking::findOrFail($id);
        $customers = Customers::with('vehicles')->get();
        $admins    = Admin::all();

        return view('admin.editservice', compact('service', 'customers', 'admins'));
    }

    //Update service (hanya field yang bisa diedit)//
    public function update(Request $request, $id)
    {
        $service = ServiceTracking::findOrFail($id);

        $request->validate([
            'status'         => 'required|integer|min:' . ServiceStatus::DITERIMA->value . '|max:' . ServiceStatus::SELESAI->value,
            'estimated_date' => 'nullable|date',
            'jenis_service'  => 'nullable|string',
            'notes'          => 'nullable|string',
            'photo'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3072',
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('service_photos', 'public');
            $service->photo_url = $photoPath;
        }

        $service->status         = $request->status;
        $service->estimated_date = $request->estimated_date;
        $service->jenis_service  = $request->jenis_service;
        $service->notes          = $request->notes;

        // Auto-record timestamp when status changes
        if ($service->isDirty('status')) {
            $timestamps = $service->status_timestamps ?? [];
            $timestamps[$request->status] = now()->format('Y-m-d H:i:s');
            $service->status_timestamps = $timestamps;
        }

        $service->save();

        return redirect()->route('tracking.create')
            ->with('success', 'Data service berhasil diupdate!');
    }

    //Hapus service//
    public function destroy($id)
    {
        $service = ServiceTracking::findOrFail($id);
        $service->delete();

        return redirect()->route('tracking.create')
            ->with('success', 'Data service berhasil dihapus!');
    }

    //HALAMAN SERVICE TRACKING (CUSTOMER) - readonly//
    public function customerTracking()
    {
        $vehicleId = session('vehicle_id');

        if (!$vehicleId) {
            return redirect()->route('logincustomer');
        }

        $service = ServiceTracking::with(['customer', 'vehicle'])
            ->where('vehicles_id', $vehicleId)
            ->orderBy('updated_at', 'DESC')
            ->first();

        return view('customer.servicetracking', compact('service'));
    }

    //AJAX POLLING - NEAR REAL TIME//
    public function getLatestStatus()
    {
        $vehicleId = session('vehicle_id');

        if (!$vehicleId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $service = ServiceTracking::where('vehicles_id', $vehicleId)
            ->orderBy('updated_at', 'DESC')
            ->first();

        if (!$service) {
            return response()->json(['status' => null]);
        }

        $steps = [
            1 => 'Diterima di Bengkel',
            2 => 'Diagnosa Kerusakan',
            3 => 'Persiapan Service',
            4 => 'Proses Pengerjaan',
            5 => 'Langkah Akhir',
            6 => 'Selesai',
        ];

        return response()->json([
            'status'            => (int) $service->status,
            'status_label'      => $steps[$service->status] ?? 'Unknown',
            'photo_url'         => $service->photo_url
                                    ? asset('storage/' . $service->photo_url)
                                    : null,
            'updated_at'        => $service->updated_at->format('Y-m-d H:i:s'),
            'status_timestamps' => $service->status_timestamps ?? [],
        ]);
    }
}