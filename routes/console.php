<?php

use Illuminate\Foundation\Inspiring;              // helper kutipan inspiratif
use Illuminate\Support\Facades\Artisan;           // untuk mendaftarkan perintah artisan

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| File ini untuk membuat perintah artisan sederhana (custom command).
| Perintah didaftarkan di sini lalu bisa dijalankan via "php artisan ...".
|
*/

// Contoh bawaan: jalankan "php artisan inspire" untuk menampilkan kutipan.
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());           // tampilkan kutipan inspiratif di terminal
})->purpose('Display an inspiring quote');        // ->purpose = deskripsi yang muncul di "php artisan list"
