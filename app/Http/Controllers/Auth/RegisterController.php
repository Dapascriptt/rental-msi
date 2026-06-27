<?php

namespace App\Http\Controllers\Auth;            // alamat class (sub-folder Auth)

use App\Http\Controllers\Controller;            // controller dasar
use App\Models\User;                            // model User
use Illuminate\Http\Request;                    // pembawa data form
use Illuminate\Support\Facades\Auth;            // helper auth
use Illuminate\Support\Facades\Hash;            // untuk mengenkripsi (hash) password

class RegisterController extends Controller      // controller pendaftaran user (hanya admin yang login)
{
    public function showRegistrationForm()       // menampilkan form daftar user
    {
        return view('auth.register');
    }

    public function register(Request $request)   // memproses pendaftaran user baru
    {
        $request->validate([                     // validasi input
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'], // email wajib & belum terdaftar
            'password' => ['required', 'string', 'min:8', 'confirmed'], // min 8 karakter & cocok dgn konfirmasi
        ]);

        User::create([                           // simpan user baru
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // password di-hash dulu (jangan simpan apa adanya)
        ]);

        return redirect('/tipes')->with('success', 'User berhasil didaftarkan.');
    }
}
