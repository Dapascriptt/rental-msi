<?php

namespace App\Http\Middleware;                  // alamat class

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware; // bawaan Laravel

// Memeriksa token CSRF (@csrf) di setiap form POST/PUT/DELETE. Kalau token
// tidak ada/salah, request ditolak (error 419). Melindungi dari serangan CSRF.
class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [                       // daftar URL yang DIKECUALIKAN dari pengecekan CSRF
        //                                      // (misalnya endpoint webhook dari pihak ketiga)
    ];
}
