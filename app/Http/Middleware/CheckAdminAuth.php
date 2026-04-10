<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckAdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        $idleTimeout = 5; // menit
        $currentTime = time();

        if (!Session::has('admin_id')) {
            Session::flush();
            return redirect()->route('loginadmin')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $lastActivity = Session::get('admin_last_activity', $currentTime);

        if (($currentTime - $lastActivity) > ($idleTimeout * 60)) {
            Session::flush();
            return redirect()->route('loginadmin')
                ->with('timeout', 'Sesi berakhir karena tidak aktif selama 5 menit.');
        }

        Session::put('admin_last_activity', $currentTime);

        return $next($request);
    }
}