<?php

namespace Database\Seeders;                       // alamat class seeder

use App\Models\Barang;                            // model Barang
use App\Models\HargaBarang;                       // model HargaBarang
use Illuminate\Database\Console\Seeds\WithoutModelEvents; // bawaan (tidak dipakai)
use Illuminate\Database\Seeder;                   // class dasar seeder

class HargaBarangSeeder extends Seeder
{
    public function run(): void                    // membuat 2 harga (per hari & per minggu) untuk tiap barang
    {
        $barangs = Barang::all();                  // ambil semua barang

        foreach ($barangs as $barang) {
            HargaBarang::create([
                'barang_id' => $barang->id,
                'harga' => rand(300000, 1000000),  // harga acak untuk satuan hari
                'satuan' => 'hari'
            ]);

            HargaBarang::create([
                'barang_id' => $barang->id,
                'harga' => rand(2000000, 5000000), // harga acak untuk satuan minggu
                'satuan' => 'minggu'
            ]);
        }
    }
}
