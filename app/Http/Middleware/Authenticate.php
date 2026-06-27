<?php

namespace App\Http\Middleware;                  // alamat class

use Illuminate\Auth\Middleware\Authenticate as Middleware; // middleware auth bawaan Laravel
use Illuminate\Http\Request;                    // pembawa request

// Middleware 'auth'. Tugasnya: kalau user BELUM login, tolak akses dan
// arahkan ke halaman login. Inilah yang melindungi semua route admin.
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string // menentukan ke mana user diarahkan saat belum login
    {
        // jika request berupa API (minta JSON) -> jangan redirect (null);
        // jika request browser biasa -> arahkan ke halaman login
        return $request->expectsJson() ? null : route('login');
    }
}
