<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\Vehicles;
use Illuminate\Support\Facades\Validator;

class customersController extends Controller
{
    public function index() //menampilkan daftar customer
    {
        $customers = Customers::with('vehicles')
            ->orderBy('id', 'DESC')
            ->get();

        return view('admin.datapelanggan', compact('customers'));
    }

    public function create() //show form tambah customer
    {
        return view('admin.insertcustomer');
    }

    public function store(Request $request)
    {
        //validasi customer dan save
        $request->validate([
            'nama'    => 'required|string|max:255',
            'alamat'  => 'required|string',
            'telepon' => 'required|string|max:20',
        ]);

        $customer = Customers::create([
            'nama'  => $request->nama,
            'alamat'=> $request->alamat,
            'no_hp' => $request->telepon,
        ]);

        //simpan kendaraan
        if ($request->has('vehicles')) {

            $vehicles = collect($request->vehicles)->filter(function ($v) {
                return !empty($v['merek'])
                    || !empty($v['model'])
                    || !empty($v['tahun'])
                    || !empty($v['warna'])
                    || !empty($v['nomor_polisi']);
            });

            if ($vehicles->count() > 0) {
                $request->validate([
                    'vehicles.*.merek'         => 'required|string|max:100',
                    'vehicles.*.model'         => 'required|string|max:100',
                    'vehicles.*.tahun'         => 'required|digits:4',
                    'vehicles.*.warna'         => 'required|string|max:100',
                    'vehicles.*.nomor_polisi'  => 'required|string|max:20',
                ]);

                foreach ($vehicles as $v) {
                    $customer->vehicles()->create($v);
                }
            }
        }

        return redirect()
            ->route('customer.index')
            ->with('success', 'Customer berhasil ditambahkan');
    }

    public function edit($id) //ambil customer+kendaraan - tampilkan form edit
    {
        $customer = Customers::with('vehicles')->findOrFail($id);
        return view('admin.editcustomer', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        //validasi customer - update
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:20',
        ]);

        $customer = Customers::findOrFail($id);
        $customer->update([
            'nama'   => $request->nama,
            'alamat' => $request->alamat,
            'no_hp'  => $request->telepon,
        ]);

        // hapus kendaraan yg di delete user
        if ($request->filled('deleted_vehicles')) {
            $deletedIds = explode(',', $request->deleted_vehicles);
            Vehicles::whereIn('id', $deletedIds)
                ->where('customers_id', $customer->id)
                ->delete();
        }

        //update and tambah kendaraan
        if ($request->filled('vehicles')) {

            foreach ($request->vehicles as $key => $v) {

                // Skip jika semua field kosong
                if (empty($v['merek']) && empty($v['model']) && empty($v['tahun']) && empty($v['warna']) && empty($v['nomor_polisi'])) {
                    continue;
                }

                // Validasi
                $validator = Validator::make($v, [
                    'merek' => 'required|string|max:100',
                    'model' => 'required|string|max:100',
                    'tahun' => 'required|digits:4',
                    'warna' => 'required|string|max:100',
                    'nomor_polisi' => 'required|string|max:20',
                ]);

                if ($validator->fails()) {
                    return back()
                        ->withErrors($validator)
                        ->withInput();
                }

                // Cek apakah kendaraan baru (key dimulai dengan 'new_')
                if (strpos($key, 'new_') === 0) {
                    // Tambah kendaraan baru
                    $customer->vehicles()->create([
                        'merek' => $v['merek'],
                        'model' => $v['model'],
                        'tahun' => $v['tahun'],
                        'warna' => $v['warna'],
                        'nomor_polisi' => $v['nomor_polisi'],
                    ]);
                } else {
                    // Update kendaraan existing
                    if (!empty($v['id'])) {
                        $vehicle = Vehicles::where('id', $v['id'])
                            ->where('customers_id', $customer->id)
                            ->first();
                        
                        if ($vehicle) {
                            $vehicle->update([
                                'merek' => $v['merek'],
                                'model' => $v['model'],
                                'tahun' => $v['tahun'],
                                'warna' => $v['warna'],
                                'nomor_polisi' => $v['nomor_polisi'],
                            ]);
                        }
                    }
                }
            }
        }

        return redirect()
            ->route('customer.index')
            ->with('success', 'Customer berhasil diupdate');
    }
    //hapus customer
    public function destroy($id)
    {
        $customer = Customers::findOrFail($id);
        $customer->delete();

        return redirect()
            ->route('customer.index')
            ->with('success', 'Data customer berhasil dihapus');
    }
}