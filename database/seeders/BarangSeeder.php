<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Tipe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $excavator = Tipe::where('nama_tipe', 'Excavator')->first();
        $dumpTruck = Tipe::where('nama_tipe', 'Dump Truck')->first();
        $genset = Tipe::where('nama_tipe', 'Genset')->first();

        Barang::create([
            'tipe_id' => $excavator->id,
            'nama_barang' => 'Komatsu PC200',
        ]);

        Barang::create([
            'tipe_id' => $dumpTruck->id,
            'nama_barang' => 'Hino 500',
        ]);

        Barang::create([
            'tipe_id' => $genset->id,
            'nama_barang' => 'Genset 100 KVA',
        ]);
    }
}
