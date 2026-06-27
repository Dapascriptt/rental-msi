<?php

namespace App\Http\Middleware;                  // alamat class

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware; // bawaan Laravel

// Middleware ini otomatis MENGENKRIPSI semua cookie agar tidak bisa
// dibaca/diubah sembarangan oleh pengguna. Bekerja diam-diam di latar.
class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array<int, string>
     */
    protected $except = [                       // daftar cookie yang DIKECUALIKAN dari enkripsi
        //                                      // (kosong = semua cookie dienkripsi)
    ];
}
