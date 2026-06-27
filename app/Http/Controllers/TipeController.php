<?php

namespace App\Http\Controllers;                 // alamat class

use App\Models\Tipe;                            // model Tipe
use Illuminate\Http\Request;                    // pembawa data dari form/user

class TipeController extends Controller
{
    public function index()                     // menampilkan semua tipe
    {
        $tipes = Tipe::all();                   // ambil semua data tipe
        return view('tipes.index', compact('tipes')); // kirim ke view
    }

    public function create()                    // menampilkan form tambah tipe
    {
        return view('tipes.create');            // tidak perlu kirim data apa pun
    }

    public function store(Request $request)     // menyimpan tipe baru
    {
        Tipe::create($request->all());          // simpan semua input (aman karena $fillable membatasi kolom)
        return redirect()->route('tipes.index'); // kembali ke daftar
    }

    public function edit(Tipe $tipe)            // form edit; $tipe dicari otomatis dari id di URL
    {
        return view('tipes.create', compact('tipe')); // pakai view create, kirim data $tipe
    }

    public function update(Request $request, Tipe $tipe) // menyimpan perubahan
    {
        $tipe->update($request->all());         // perbarui data
        return redirect()->route('tipes.index');
    }

    public function destroy(Tipe $tipe)         // menghapus tipe
    {
        $tipe->delete();                        // hapus dari database
        return back();                          // kembali ke halaman sebelumnya
    }
}
