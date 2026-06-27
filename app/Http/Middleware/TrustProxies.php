<?php

namespace App\Http\Middleware;                  // alamat class

use Illuminate\Http\Middleware\TrustProxies as Middleware; // bawaan Laravel
use Illuminate\Http\Request;                    // pembawa request

// Mengatur "proxy" yang dipercaya (misal saat aplikasi di belakang load
// balancer). Agar Laravel tahu alamat IP & protokol asli pengunjung.
class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array<int, string>|string|null
     */
    protected $proxies;                         // daftar IP proxy yang dipercaya (null = belum diset)

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers =                        // header yang dipakai untuk mendeteksi info asli dari proxy
        Request::HEADER_X_FORWARDED_FOR |       // IP asli pengunjung
        Request::HEADER_X_FORWARDED_HOST |      // host asli
        Request::HEADER_X_FORWARDED_PORT |      // port asli
        Request::HEADER_X_FORWARDED_PROTO |     // protokol asli (http/https)
        Request::HEADER_X_FORWARDED_AWS_ELB;    // header khusus AWS load balancer
}
