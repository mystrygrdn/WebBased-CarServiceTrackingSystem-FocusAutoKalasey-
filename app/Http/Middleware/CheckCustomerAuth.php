<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckCustomerAuth
{
    public function handle(Request $request, Closure $next)
    {
        $idleTimeout = 5; // menit
        $currentTime = time();

        if (!Session::has('customer_id')) {
            Session::flush();
            return redirect()->route('logincustomer')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $lastActivity = Session::get('customer_last_activity', $currentTime);

        if (($currentTime - $lastActivity) > ($idleTimeout * 60)) {
            Session::flush();
            return redirect()->route('logincustomer')
                ->with('timeout', 'Sesi berakhir karena tidak aktif selama 5 menit.');
        }

        Session::put('customer_last_activity', $currentTime);

        return $next($request);
    }
}