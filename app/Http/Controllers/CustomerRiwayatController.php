<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceTracking;
use App\Models\Vehicles;
use App\Enums\ServiceStatus;

class CustomerRiwayatController extends Controller
{
    public function index()
    {
        // Pastikan customer login
        $customerId = session('customer_id');
        if (!$customerId) {
            return redirect()->route('customer.login');
        }

        // Ambil kendaraan berdasarkan customer login
        $vehicle = Vehicles::where('customers_id', $customerId)->first();

        if (!$vehicle) {
            return view('customer.riwayatcustomer', [
                'riwayat' => collect()
            ]);
        }

        // Ambil riwayat service kendaraan ini saja & status selesai (6)
        $riwayat = ServiceTracking::with(['vehicle', 'admin'])
            ->where('vehicles_id', $vehicle->id) //berdasarkan
            ->where('status', ServiceStatus::SELESAI->value)
            ->orderBy('tanggal_masuk', 'DESC')
            ->get();
    //tampilkan ke view
        return view('customer.riwayatcustomer', compact('riwayat'));
    }
}