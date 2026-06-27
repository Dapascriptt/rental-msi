<?php

namespace App\Http\Middleware;                  // alamat class

use App\Providers\RouteServiceProvider;          // berisi konstanta HOME (alamat beranda)
use Closure;                                      // tipe untuk "langkah berikutnya"
use Illuminate\Http\Request;                      // pembawa request
use Illuminate\Support\Facades\Auth;              // helper cek status login
use Symfony\Component\HttpFoundation\Response;    // tipe data balasan (response)

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * Tugas middleware ini: kalau user SUDAH login, jangan biarkan dia
     * membuka halaman login/register lagi, langsung lempar ke beranda.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;  // jika tak ada guard khusus, pakai guard default

        foreach ($guards as $guard) {                 // periksa tiap guard
            if (Auth::guard($guard)->check()) {       // jika user TERNYATA sudah login
                return redirect(RouteServiceProvider::HOME); // lempar ke beranda, hentikan request di sini
            }
        }

        return $next($request);                       // jika belum login, lanjutkan request ke tujuan berikutnya
    }
}
