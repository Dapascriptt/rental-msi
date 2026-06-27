<?php

namespace App\Http\Controllers\Auth;          // alamat class: ada di sub-folder Auth

use App\Http\Controllers\Controller;           // controller dasar
use Illuminate\Http\Request;                    // pembawa data request
use Illuminate\Support\Facades\Auth;            // helper untuk urusan login/logout
use Illuminate\Support\Facades\RateLimiter;     // helper untuk membatasi jumlah percobaan
use Illuminate\Support\Str;                     // helper untuk olah teks (string)

class LoginController extends Controller
{
    public function showLoginForm()             // menampilkan halaman form login
    {
        return view('auth.login');              // tampilkan view resources/views/auth/login.blade.php
    }

    public function login(Request $request)     // memproses data login yang dikirim user
    {
        $credentials = $request->validate([     // ambil & validasi email + password
            'email' => ['required', 'email'],   // email wajib & format harus email
            'password' => ['required'],         // password wajib diisi
        ]);

        // membuat "kunci" unik per email+IP untuk menghitung percobaan login orang ini
        $throttleKey = Str::transliterate(Str::lower($request->input('email')).'|'.$request->ip());

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {    // jika sudah gagal 5 kali
            $seconds = RateLimiter::availableIn($throttleKey);  // hitung sisa waktu tunggu

            return back()->withErrors([                         // kembali dengan pesan error
                'email' => "Terlalu banyak percobaan login. Silakan coba lagi dalam $seconds detik.",
            ])->onlyInput('email');                             // tetap isi field email
        }

        if (Auth::attempt($credentials, $request->boolean('remember'))) {   // coba login; cek ke database
            RateLimiter::clear($throttleKey);                   // login sukses -> reset hitungan percobaan

            $request->session()->regenerate();                  // buat ulang session demi keamanan
            return redirect()->intended('/tipes');              // arahkan ke halaman tujuan, default /tipes
        }

        RateLimiter::hit($throttleKey);                         // login gagal -> tambah hitungan percobaan

        return back()->withErrors([                             // kembali ke form dengan pesan error
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');                                 // tetap isi email yang tadi diketik
    }

    public function logout(Request $request)    // memproses logout
    {
        Auth::logout();                          // keluarkan user dari sesi login
        $request->session()->invalidate();       // hapus semua data session
        $request->session()->regenerateToken();  // buat token CSRF baru demi keamanan
        return redirect('/login');               // arahkan kembali ke halaman login
    }
}
