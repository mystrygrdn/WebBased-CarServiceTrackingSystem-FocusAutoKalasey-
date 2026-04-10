<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\admin;

class adminController extends Controller
{
    public function index() //Mengambil suruh data admin, dikirim ke manajemenadmin
    {
        return view('admin.manajemenadmin', [
            'admin' => admin::latest()->get()
        ]);
    }

    public function add() //Show form input new admin(manajemenadmin)
    {
        return view('admin.insertadmin');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'username' => 'required|unique:admin,username',
        'password' => 'required',
    ]);

    Admin::create([
        'name'     => $request->name,        // 🔥 INI YANG KURANG
        'username' => $request->username,
        'password' => bcrypt($request->password),
    ]);

    return redirect()->route('manajemenadmin')
        ->with('success', 'Admin berhasil ditambahkan!');
}


    public function edit($id) //mengambil data admin (form editadmin)
    {
        $admin = admin::findOrFail($id);
        return view('admin.editadmin', compact('admin'));
    }

    public function update(Request $request, $id) //update data admin
    {
        $admin = admin::findOrFail($id);

        $request->validate([ 
            'name' => 'required',
            'username' => 'required|unique:admin,username,' . $id,
        ]);

        $admin->name = $request->name;
        $admin->username = $request->username;

        if ($request->password) { //update pass opsional
            $admin->password = bcrypt($request->password);
        }

        $admin->save();

        return redirect()->route('manajemenadmin')->with('success', 'Admin berhasil diperbarui!');
    }

    public function destroy($id) //ini menghapus admin
    {
        admin::findOrFail($id)->delete();

        return redirect()->route('manajemenadmin')->with('success', 'Admin berhasil dihapus!');
    }
}