<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;

class loginController extends Controller
{
    public function index() //cegah login ulang - login ->dashboard
    {
        if (Session::has('admin_id')) {
            return redirect('/dashboardadmin');
        }

        return view('layouts.loginadmin');
    }

    public function login(Request $request) //auth aman and simple - validasi
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return back()->withErrors([
                'login' => 'Username atau password salah'
            ]);
        }

        // Laravel-native session handling
        $request->session()->regenerate();

        Session::put([
            'admin_id' => $admin->id,
            'admin_name' => $admin->name,
            'admin_last_activity' => time(), // ADD THIS LINE
        ]);

        return redirect('/dashboardadmin')
            ->with('sukses', 'Selamat datang, ' . $admin->name);
    }

    public function logout(Request $request) //hapus all admin session, redirect ke login admin
    {
        Session::flush();
        $request->session()->regenerate();

        return redirect('/loginadmin')
            ->with('logout', 'Anda berhasil logout');
    }
}