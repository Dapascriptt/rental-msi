<?php

namespace Database\Seeders;                       // alamat class seeder

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;                   // class dasar seeder

// Seeder UTAMA. Inilah yang dijalankan saat "php artisan db:seed".
// Tugasnya memanggil seeder-seeder lain secara berurutan.
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([                             // panggil daftar seeder di bawah ini, urut dari atas
            UserSeeder::class,                    // 1) buat user admin
            // TipeSeeder::class,                 // (dinonaktifkan; tipe dibuat di AlatBeratSeeder)
            // BarangSeeder::class,
            // UnitSeeder::class,
            // HargaBarangSeeder::class,
            // PemesananSeeder::class,
            AlatBeratSeeder::class,               // 2) isi data alat berat lengkap (tipe, barang, spesifikasi, harga, unit)
        ]);
    }
}
