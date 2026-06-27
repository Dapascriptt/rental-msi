<?php

namespace App\Http\Controllers;   // menentukan "alamat" class ini, harus sesuai struktur folder

use App\Models\Barang;            // mengimpor Model Barang supaya bisa dipakai di file ini
use App\Models\Tipe;              // mengimpor Model Tipe
use Illuminate\Http\Request;      // mengimpor class Request (pembawa data dari form/user)

class BarangController extends Controller   // membuat controller, mewarisi Controller bawaan Laravel
{
    public function index()                 // menampilkan SEMUA barang
    {
        $barangs = Barang::with('tipe')->get();   // ambil semua barang + data tipe-nya sekaligus (hindari N+1)

        return view('barangs.index', compact('barangs'));  // tampilkan view & kirim variabel $barangs ke sana
    }

    public function create()                // menampilkan FORM tambah barang
    {
        $tipes = Tipe::all();               // ambil semua tipe (untuk mengisi pilihan dropdown di form)

        return view('barangs.create', compact('tipes'));   // tampilkan form, kirim daftar $tipes
    }

    public function store(Request $request) // MENYIMPAN barang baru; $request berisi data form
    {
        $validated = $request->validate([                       // validasi input; jika gagal otomatis balik ke form
            'nama_barang' => 'required|string|max:255',         // wajib, harus teks, maksimal 255 karakter
            'tipe_id' => 'required|exists:tipes,id',            // wajib, dan id-nya harus ada di tabel tipes
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072', // boleh kosong; jika ada harus gambar < 3MB
        ]);

        if ($request->hasFile('image')) {                       // cek apakah user benar-benar mengunggah file gambar
            $file = $request->file('image');                    // ambil objek file yang diunggah

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension(); // buat nama unik agar tidak bentrok

            $file->move(public_path('images'), $filename);      // pindahkan file ke folder public/images

            $validated['image'] = $filename;                    // simpan NAMA file-nya ke data yang akan disimpan ke DB
        }

        Barang::create($validated);                             // simpan data barang baru ke database

        return redirect()->route('barangs.index');              // setelah simpan, pindah ke halaman daftar barang
    }

    public function edit(Barang $barang)    // menampilkan form EDIT; $barang otomatis dicari Laravel dari id di URL
    {
        $tipes = Tipe::all();               // ambil semua tipe untuk dropdown

        return view('barangs.create', compact('barang', 'tipes')); // pakai view yang sama dgn create, tapi kirim $barang juga
    }

    public function update(Request $request, Barang $barang)  // MENYIMPAN perubahan barang
    {
        $validated = $request->validate([                      // validasi sama seperti saat menyimpan baru
            'nama_barang' => 'required|string|max:255',
            'tipe_id' => 'required|exists:tipes,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        if ($request->hasFile('image')) {                      // jika user mengunggah gambar baru
            if ($barang->image && file_exists(public_path('images/' . $barang->image))) { // dan gambar lama masih ada
                unlink(public_path('images/' . $barang->image)); // hapus gambar lama agar tidak menumpuk sampah
            }

            $file = $request->file('image');                   // ambil file baru

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension(); // nama unik

            $file->move(public_path('images'), $filename);     // pindahkan ke public/images

            $validated['image'] = $filename;                   // catat nama file baru
        }

        $barang->update($validated);                           // perbarui data barang di database

        return redirect()->route('barangs.index');             // kembali ke daftar barang
    }

    public function destroy(Barang $barang) // MENGHAPUS barang
    {
        if ($barang->image && file_exists(public_path('images/' . $barang->image))) { // jika punya gambar & filenya ada
            unlink(public_path('images/' . $barang->image));   // hapus file gambarnya dulu
        }

        $barang->delete();                                     // hapus data barang dari database

        return back();                                         // kembali ke halaman sebelumnya
    }
}
