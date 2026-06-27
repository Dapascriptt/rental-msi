<?php

namespace App\Http\Controllers;                 // alamat class

use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // kemampuan cek izin (authorization)
use Illuminate\Foundation\Validation\ValidatesRequests;   // kemampuan validasi request
use Illuminate\Routing\Controller as BaseController;      // controller dasar bawaan Laravel

// Ini controller INDUK. Semua controller lain "extends Controller" mewarisi dari sini,
// sehingga otomatis bisa memakai fitur validasi & authorization.
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;   // aktifkan kedua kemampuan di atas
}
