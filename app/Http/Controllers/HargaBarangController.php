<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\HargaBarang;
use Illuminate\Http\Request;

class HargaBarangController extends Controller
{
    public function index()
    {
        $hargaBarangs = HargaBarang::with('barang')->get();
        return view('harga_barangs.index', compact('hargaBarangs'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('harga_barangs.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        HargaBarang::create($request->all());
        return redirect()->route('harga-barangs.index');
    }

    public function edit(HargaBarang $hargaBarang)
    {
        $barangs = Barang::all();
        return view('harga_barangs.create', compact('hargaBarang', 'barangs'));
    }

    public function update(Request $request, HargaBarang $hargaBarang)
    {
        $hargaBarang->update($request->all());
        return redirect()->route('harga-barangs.index');
    }

    public function destroy(HargaBarang $hargaBarang)
    {
        $hargaBarang->delete();
        return back();
    }
}
