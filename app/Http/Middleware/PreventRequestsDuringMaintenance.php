<?php

namespace App\Http\Middleware;                  // alamat class

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware; // bawaan Laravel

// Saat aplikasi dalam "mode maintenance" (php artisan down), middleware ini
// menampilkan halaman "sedang dalam perbaikan" untuk setiap request.
class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * The URIs that should be reachable while maintenance mode is enabled.
     *
     * @var array<int, string>
     */
    protected $except = [                       // daftar URL yang TETAP bisa diakses meski sedang maintenance
        //
    ];
}
