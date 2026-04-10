<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceTracking;
use App\Enums\ServiceStatus;

class RiwayatServiceController extends Controller
{
    public function index() //ambil data service
    {
        $riwayat = ServiceTracking::with(['customer', 'vehicle', 'admin'])
            ->where('status', ServiceStatus::SELESAI->value)
            ->orderBy('updated_at', 'DESC') //urutkan data
            ->get();

        return view('admin.riwayatservice', compact('riwayat')); //kirim ke view -readonly
    }
}