<?php

use Illuminate\Http\Request;                      // pembawa request
use Illuminate\Support\Facades\Route;             // class Route

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| File ini untuk mendaftarkan route API (biasanya diakses aplikasi lain /
| mobile, balasannya JSON). URL-nya otomatis berawalan /api.
| Di project ini API hampir tidak dipakai (fokus ke web.php).
|
*/

// Route bawaan: GET /api/user -> kembalikan data user yang sedang login.
// Dilindungi 'auth:sanctum' (harus pakai token API yang valid).
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();                      // kembalikan data user pemilik token
});
