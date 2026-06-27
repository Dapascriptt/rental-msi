<?php

namespace Database\Seeders;                       // alamat class seeder

use App\Models\Barang;                            // model Barang
use App\Models\Pemesanan;                         // model Pemesanan
use App\Models\PemesananDetail;                   // model detail pemesanan
use Illuminate\Database\Console\Seeds\WithoutModelEvents; // bawaan (tidak dipakai)
use Illuminate\Database\Seeder;                   // class dasar seeder

class PemesananSeeder extends Seeder
{
    public function run(): void                    // membuat 1 contoh pemesanan
    {
        $barang = Barang::first();                 // ambil barang pertama sebagai contoh

        $pemesanan = Pemesanan::create([           // buat data pemesanan contoh
            'nama_pemesan' => 'Budi',
            'no_hp' => '08123456789',
            'perusahaan' => 'PT Maju Jaya',
            'alamat' => 'Samarinda',
            'tanggal_mulai' => now(),              // mulai hari ini
            'tanggal_selesai' => now()->addDays(3), // selesai 3 hari kemudian
            'status' => 'pending'
        ]);

        PemesananDetail::create([                  // buat 1 detail untuk pemesanan di atas
            'pemesanan_id' => $pemesanan->id,
            'barang_id' => $barang->id,
            'qty' => 2,
            'harga' => 500000,
            'satuan' => 'hari',
            'durasi' => 3
        ]);
    }
}
