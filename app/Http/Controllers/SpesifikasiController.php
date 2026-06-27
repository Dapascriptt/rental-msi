<?php

namespace App\Http\Controllers;                 // alamat class

use App\Models\Spesifikasi;                     // model Spesifikasi
use App\Models\Barang;                          // model Barang
use Illuminate\Http\Request;                    // pembawa data form

class SpesifikasiController extends Controller
{
   public function index(Request $request)      // menampilkan daftar spesifikasi (dengan filter)
    {
        $barangs = Barang::orderBy('nama_barang', 'asc')->get(); // semua barang, urut nama A-Z (untuk filter)

        $query = Spesifikasi::with('barang')->latest(); // siapkan query spesifikasi + barangnya, urut terbaru

        if ($request->filled('barang_id')) {    // jika filter barang diisi
            $query->where('barang_id', $request->barang_id); // saring berdasarkan barang
        }

        $spesifikasis = $query->paginate(10)->withQueryString(); // 10 per halaman, pertahankan filter di link paginasi

        return view('spesifikasis.index', compact('spesifikasis', 'barangs'));
    }

    public function create()                    // form tambah spesifikasi
    {
        $barangs = Barang::all();
        return view('spesifikasis.form', compact('barangs'));
    }

    public function store(Request $request)     // menyimpan banyak spesifikasi sekaligus
    {
        $request->validate([
            'barang_id' => 'required',
            'keys' => 'required|array',         // daftar nama spesifikasi (array)
            'values' => 'required|array',       // daftar nilai spesifikasi (array)
        ]);

        foreach ($request->keys as $index => $key) {     // loop tiap pasangan key-value
            if ($key && $request->values[$index]) {      // hanya simpan jika keduanya terisi
                Spesifikasi::create([
                    'barang_id' => $request->barang_id,
                    'key' => strtoupper($key),           // simpan nama spesifikasi dalam HURUF BESAR
                    'value' => $request->values[$index],
                ]);
            }
        }

        return redirect()->route('spesifikasis.index')
            ->with('success', 'Spesifikasi berhasil ditambahkan');
    }

    public function edit(Spesifikasi $spesifikasi) // form edit spesifikasi
    {
        $barangs = Barang::all();

        // ambil SEMUA spesifikasi milik barang yang sama (karena diedit sekaligus per barang)
        $allSpecs = Spesifikasi::where('barang_id', $spesifikasi->barang_id)->get();

        return view('spesifikasis.form', compact('spesifikasi', 'barangs', 'allSpecs'));
    }

    public function update(Request $request, Spesifikasi $spesifikasi) // simpan perubahan spesifikasi
    {
        $request->validate([
            'barang_id' => 'required',
            'keys' => 'required|array',
            'values' => 'required|array',
        ]);

        // strategi: hapus semua spesifikasi lama barang ini, lalu buat ulang dari input baru
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

    public function destroy(Spesifikasi $spesifikasi) // hapus 1 spesifikasi
    {
        $spesifikasi->delete();

        return redirect()->route('spesifikasis.index')
            ->with('success', 'Spesifikasi berhasil dihapus');
    }
}
