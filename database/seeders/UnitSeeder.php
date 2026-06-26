<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        $barangs = Barang::all();

        foreach ($barangs as $barang) {
            for ($i = 1; $i <= 5; $i++) {
                Unit::create([
                    'barang_id' => $barang->id,
                    'kode_unit' => strtoupper(substr($barang->nama_barang, 0, 3)) . '-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                    'status' => 'available'
                ]);
            }
        }
    }
}