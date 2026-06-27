<?php

namespace App\Http\Controllers;                 // alamat class

use App\Models\Barang;                          // model Barang (untuk dropdown)
use App\Models\HargaBarang;                     // model HargaBarang
use Illuminate\Http\Request;                    // pembawa data form

class HargaBarangController extends Controller
{
    public function index()                     // menampilkan semua harga barang
    {
        $hargaBarangs = HargaBarang::with('barang')->get(); // ambil harga + nama barangnya (hindari N+1)
        return view('harga_barangs.index', compact('hargaBarangs'));
    }

    public function create()                    // form tambah harga
    {
        $barangs = Barang::all();               // ambil semua barang untuk dropdown
        return view('harga_barangs.create', compact('barangs'));
    }

    public function store(Request $request)     // menyimpan harga baru
    {
        HargaBarang::create($request->all());   // simpan input
        return redirect()->route('harga-barangs.index');
    }

    public function edit(HargaBarang $hargaBarang) // form edit; data dicari otomatis dari id URL
    {
        $barangs = Barang::all();
        return view('harga_barangs.create', compact('hargaBarang', 'barangs'));
    }

    public function update(Request $request, HargaBarang $hargaBarang) // simpan perubahan
    {
        $hargaBarang->update($request->all());
        return redirect()->route('harga-barangs.index');
    }

    public function destroy(HargaBarang $hargaBarang) // hapus harga
    {
        $hargaBarang->delete();
        return back();
    }
}
