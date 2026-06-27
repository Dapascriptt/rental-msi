<?php

namespace Database\Seeders;                       // alamat class seeder

use App\Models\Tipe;                              // model Tipe, untuk menyimpan data
use Illuminate\Database\Console\Seeds\WithoutModelEvents; // bawaan Laravel (di sini tidak dipakai)
use Illuminate\Database\Seeder;                   // class dasar seeder

class TipeSeeder extends Seeder
{
    public function run(): void                    // dijalankan saat "php artisan db:seed"
    {
        $tipes = [                                 // siapkan daftar data tipe yang mau dimasukkan
            ['nama_tipe' => 'Excavator'],
            ['nama_tipe' => 'Dump Truck'],
            ['nama_tipe' => 'Genset'],
        ];

        foreach ($tipes as $tipe) {                // ulangi untuk tiap data di daftar
            Tipe::create($tipe);                   // simpan satu baris tipe ke database
        }
    }
}
