<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class vehiclesController extends Controller
{
    public function index() //show all daftar kendaraan send to admin.datakendaraan
    {
        return view('admin.datakendaraan', [
            'vehicles' => Vehicle::orderBy('id', 'DESC')->get()
        ]);
    }

    public function create() //show form tambah kendaraan
    {
        return view('admin.insertvehicle');
    }

    public function store(Request $request) //save ke db dan validasi
    {
        $request->validate([
            'plate_number' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required|integer',
            'customer_id' => 'required|integer',
        ]);

        Vehicle::create([
            'plate_number' => $request->plate_number,
            'brand' => $request->brand,
            'model' => $request->model,
            'year' => $request->year,
            'customer_id' => $request->customer_id,
        ]);

        return redirect()->route('vehicle.index')->with('success', 'Data kendaraan berhasil ditambahkan!');
    }
}