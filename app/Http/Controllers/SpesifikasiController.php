<?php

namespace App\Http\Controllers;

use App\Models\Spesifikasi;
use App\Models\Barang;
use Illuminate\Http\Request;

class SpesifikasiController extends Controller
{
   public function index(Request $request)
    {
        $barangs = Barang::orderBy('nama_barang', 'asc')->get();

        $query = Spesifikasi::with('barang')->latest();

        if ($request->filled('barang_id')) {
            $query->where('barang_id', $request->barang_id);
        }

        $spesifikasis = $query->paginate(10)->withQueryString();

        return view('spesifikasis.index', compact('spesifikasis', 'barangs'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('spesifikasis.form', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required',
            'keys' => 'required|array',
            'values' => 'required|array',
        ]);

        foreach ($request->keys as $index => $key) {
            if ($key && $request->values[$index]) {
                Spesifikasi::create([
                    'barang_id' => $request->barang_id,
                    'key' => strtoupper($key),
                    'value' => $request->values[$index],
                ]);
            }
        }

        return redirect()->route('spesifikasis.index')
            ->with('success', 'Spesifikasi berhasil ditambahkan');
    }

    public function edit(Spesifikasi $spesifikasi)
    {
        $barangs = Barang::all();

        $allSpecs = Spesifikasi::where('barang_id', $spesifikasi->barang_id)->get();

        return view('spesifikasis.form', compact('spesifikasi', 'barangs', 'allSpecs'));
    }

    public function update(Request $request, Spesifikasi $spesifikasi)
    {
        $request->validate([
            'barang_id' => 'required',
            'keys' => 'required|array',
            'values' => 'required|array',
        ]);

        Spesifikasi::where('barang_id', $request->barang_id)->delete();

        foreach ($request->keys as $index => $key) {
            if ($key && $request->values[$index]) {
                Spesifikasi::create([
                    'barang_id' => $request->barang_id,
                    'key' => strtoupper($key),
                    'value' => $request->values[$index],
                ]);
            }
        }

        return redirect()->route('spesifikasis.index')
            ->with('success', 'Spesifikasi berhasil diupdate');
    }

    public function destroy(Spesifikasi $spesifikasi)
    {
        $spesifikasi->delete();

        return redirect()->route('spesifikasis.index')
            ->with('success', 'Spesifikasi berhasil dihapus');
    }
}