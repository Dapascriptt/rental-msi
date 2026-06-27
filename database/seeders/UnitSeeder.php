<?php

namespace Database\Seeders;                       // alamat class seeder

use App\Models\Barang;                            // model Barang
use App\Models\Unit;                              // model Unit
use Illuminate\Database\Seeder;                   // class dasar seeder

class UnitSeeder extends Seeder
{
    public function run(): void                    // membuat 5 unit untuk tiap barang
    {
        $barangs = Barang::all();                  // ambil semua barang

        foreach ($barangs as $barang) {            // untuk tiap barang
            for ($i = 1; $i <= 5; $i++) {          // buat 5 unit
                Unit::create([
                    'barang_id' => $barang->id,
                    // kode = 3 huruf pertama nama barang + nomor 3 digit (contoh: KOM-001)
                    'kode_unit' => strtoupper(substr($barang->nama_barang, 0, 3)) . '-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                    'status' => 'available'
                ]);
            }
        }
    }
}
