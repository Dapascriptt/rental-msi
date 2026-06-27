<?php

namespace App\Http\Middleware;                  // alamat class

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware; // bawaan Laravel

// Middleware ini otomatis menghapus spasi berlebih di awal/akhir setiap
// input form (mirip fungsi trim()). Berguna agar data lebih rapi.
class TrimStrings extends Middleware
{
    /**
     * The names of the attributes that should not be trimmed.
     *
     * @var array<int, string>
     */
    protected $except = [                       // input yang TIDAK boleh di-trim (spasi mungkin disengaja)
        'current_password',
        'password',
        'password_confirmation',
    ];
}
