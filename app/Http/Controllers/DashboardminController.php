<?php

namespace App\Http\Controllers;

use App\Models\ServiceTracking;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use App\Enums\ServiceStatus;

class DashboardminController extends Controller
{
    public function index()
    {
        //service on proses(1-5 indikator pekerjaan aktif)
        $serviceOnProcess = ServiceTracking::whereBetween('status', [
                ServiceStatus::DITERIMA->value,
                ServiceStatus::LANGKAH_AKHIR->value
        ])->count();

        //service selesai (6 = selesai)
        $serviceSelesai = ServiceTracking::where('status', ServiceStatus::SELESAI->value)->count();

        //pendapatan per bulan - dari invoice
        $incomeRaw = Invoice::select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('SUM(total) as total')
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'bulan')
            ->toArray();

        // isi 12 bulan supaya grafik aman (bulan tanpa transaksi=0)
        $incomePerMonth = [];
        for ($i = 1; $i <= 12; $i++) {
            $incomePerMonth[$i] = $incomeRaw[$i] ?? 0;
        }

        return view('admin.dashboardadmin', compact(
            'serviceOnProcess',
            'serviceSelesai',
            'incomePerMonth'
        ));
    }
}