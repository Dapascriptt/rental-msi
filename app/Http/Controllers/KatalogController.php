<?php

namespace App\Http\Controllers;                 // alamat class

use App\Models\Barang;                          // model Barang
use App\Models\Tipe;                            // model Tipe
use App\Models\Unit;                            // model Unit
use Illuminate\Http\Request;                    // pembawa data (query pencarian/filter)

class KatalogController extends Controller       // controller halaman publik (tanpa login)
{
    public function katalog(Request $request)    // menampilkan halaman katalog + fitur cari/filter
    {
        $tipes = Tipe::all();                    // semua tipe (untuk tombol filter kategori)

        $barangs = Barang::with('tipe')          // ambil barang + tipenya
            ->when($request->tipe_id, function ($q) use ($request) {  // JIKA ada filter tipe...
                $q->where('tipe_id', $request->tipe_id);             // ...saring per tipe
            })
            ->when($request->search, function ($q) use ($request) {  // JIKA ada kata pencarian...
                $q->where(function ($query) use ($request) {
                    $query->where('nama_barang', 'like', '%' . $request->search . '%') // cari di nama barang
                    ->orWhereHas('units', function ($q2) use ($request) {              // ATAU cari di kode unit
                        $q2->where('kode_unit', 'like', '%' . $request->search . '%');
                    });
                });
            })
            ->latest()                           // urutkan dari terbaru
            ->get();                             // eksekusi & ambil hasil

        return view('landing-page.katalog.katalog', compact('tipes', 'barangs'));
    }

    public function showByBarang(Barang $barang) // menampilkan detail 1 barang; $barang dicari otomatis dari URL
    {
        $barang->load('tipe', 'units', 'spesifikasis', 'hargaBarangs'); // muat semua relasi yang dibutuhkan

        $barangLainnya = Barang::where('tipe_id', $barang->tipe_id) // cari barang lain dengan tipe yang sama
            ->where('id', '!=', $barang->id)     // kecuali barang yang sedang dibuka
            ->latest()
            ->limit(4)                           // ambil maksimal 4 (rekomendasi)
            ->get();

        $cartSession = session()->get('cart', []); // ambil isi keranjang dari session
        $cartItems = [];

        if (!empty($cartSession)) {              // jika keranjang tidak kosong, siapkan datanya untuk ditampilkan
            $barangIds = array_keys($cartSession);
            $cartItems = Barang::with('hargaBarangs')->whereIn('id', $barangIds)->get()->map(function($brg) use ($cartSession) {
                $brg->selected_units = Unit::whereIn('id', $cartSession[$brg->id]['units'])->get(); // tempelkan unit yang dipilih
                return $brg;
            });
        }

        return view('landing-page.katalog.detail', compact('barang', 'barangLainnya', 'cartItems'));
    }
}
