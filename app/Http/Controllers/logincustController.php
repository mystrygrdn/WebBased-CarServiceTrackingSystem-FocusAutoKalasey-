<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Vehicles;

class logincustController extends Controller
{
    public function showLoginForm() //cegah login ulang, login->dashboard
    {
        if (Session::has('vehicle_id')) {
            return redirect()->route('customer.dashboard');
        }

        return view('layouts.logincustomer');
    }

    public function login(Request $request) //simple auth, validasi dll
    {
        $request->validate([
            'nomor_polisi' => 'required',
        ]);

        $vehicle = Vehicles::with('customer')
            ->where('nomor_polisi', $request->nomor_polisi)
            ->first();

        if (!$vehicle || !$vehicle->customer) {
            return back()->withErrors([
                'nomor_polisi' => 'Nomor polisi tidak ditemukan.'
            ]);
        }

        // Laravel-native session handling
        $request->session()->regenerate();

        // simpan berdasarkan kendaraan not customer
        Session::put([
            'vehicle_id' => $vehicle->id,                    // ID kendaraan yang login
            'nomor_polisi' => $vehicle->nomor_polisi,        // Nomor polisi
            'customer_id' => $vehicle->customer->id,         // Tetap simpan customer_id untuk relasi
            'customer_name' => $vehicle->customer->nama,     // Nama customer
            'vehicle_merek' => $vehicle->merek,              // Merek mobil
            'vehicle_model' => $vehicle->model,              // Model mobil
            'customer_last_activity' => time(),              // ADD THIS LINE
        ]);

        return redirect('/dashboardcustomer');
    }

    public function logout(Request $request) //hapus all session - direct to login
    {
        Session::flush();
        $request->session()->regenerate();

        return redirect()->route('logincustomer');
    }

    public function dashboard() //cek session login - redirect ke dashboard cust
    {
        if (!Session::has('vehicle_id')) {
            return redirect()->route('logincustomer');
        }

        return redirect('/dashboardcustomer');
    }
}