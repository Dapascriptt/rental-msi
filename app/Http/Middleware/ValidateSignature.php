<?php

namespace App\Http\Middleware;                  // alamat class

use Illuminate\Routing\Middleware\ValidateSignature as Middleware; // bawaan Laravel

// Memvalidasi "signed URL" (URL bertanda tangan), yaitu link yang punya
// tanda tangan rahasia agar tidak bisa dipalsukan. Contoh: link verifikasi.
class ValidateSignature extends Middleware
{
    /**
     * The names of the query string parameters that should be ignored.
     *
     * @var array<int, string>
     */
    protected $except = [                       // parameter URL yang diabaikan saat memeriksa tanda tangan
        // 'fbclid',                            // (biasanya parameter pelacakan dari iklan/sosial media)
        // 'utm_campaign',
        // 'utm_content',
        // 'utm_medium',
        // 'utm_source',
        // 'utm_term',
    ];
}
