<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\HargaBarang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HargaBarangSeeder extends Seeder
{
    public function run(): void
    {
        $barangs = Barang::all();

        foreach ($barangs as $barang) {
            HargaBarang::create([
                'barang_id' => $barang->id,
                'harga' => rand(300000, 1000000),
                'satuan' => 'hari'
            ]);

            HargaBarang::create([
                'barang_id' => $barang->id,
                'harga' => rand(2000000, 5000000),
                'satuan' => 'minggu'
            ]);
        }
    }
}
