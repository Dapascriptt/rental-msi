<?php

namespace Database\Seeders;                       // alamat class seeder

use App\Models\Barang;                            // model Barang, untuk menyimpan data barang
use App\Models\Tipe;                              // model Tipe, untuk mencari tipe yang sudah ada
use Illuminate\Database\Console\Seeds\WithoutModelEvents; // bawaan Laravel (di sini tidak dipakai)
use Illuminate\Database\Seeder;                   // class dasar seeder

class BarangSeeder extends Seeder
{
    public function run(): void                    // dijalankan saat "php artisan db:seed"
    {
        // Cari dulu tipe yang sudah dibuat oleh TipeSeeder, ambil baris pertama yang cocok.
        // (BarangSeeder harus jalan SETELAH TipeSeeder, karena butuh id tipe-nya)
        $excavator = Tipe::where('nama_tipe', 'Excavator')->first();  // ambil objek tipe Excavator
        $dumpTruck = Tipe::where('nama_tipe', 'Dump Truck')->first(); // ambil objek tipe Dump Truck
        $genset = Tipe::where('nama_tipe', 'Genset')->first();        // ambil objek tipe Genset

        Barang::create([                            // buat 1 barang baru di tabel barangs
            'tipe_id' => $excavator->id,            // hubungkan ke tipe Excavator lewat id-nya
            'nama_barang' => 'Komatsu PC200',       // nama barangnya
        ]);

        Barang::create([
            'tipe_id' => $dumpTruck->id,            // hubungkan ke tipe Dump Truck
            'nama_barang' => 'Hino 500',
        ]);

        Barang::create([
            'tipe_id' => $genset->id,               // hubungkan ke tipe Genset
            'nama_barang' => 'Genset 100 KVA',
        ]);
    }
}
