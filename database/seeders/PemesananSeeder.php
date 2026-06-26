<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Pemesanan;
use App\Models\PemesananDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PemesananSeeder extends Seeder
{
    public function run(): void
    {
        $barang = Barang::first();

        $pemesanan = Pemesanan::create([
            'nama_pemesan' => 'Budi',
            'no_hp' => '08123456789',
            'perusahaan' => 'PT Maju Jaya',
            'alamat' => 'Samarinda',
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now()->addDays(3),
            'status' => 'pending'
        ]);

        PemesananDetail::create([
            'pemesanan_id' => $pemesanan->id,
            'barang_id' => $barang->id,
            'qty' => 2,
            'harga' => 500000,
            'satuan' => 'hari',
            'durasi' => 3
        ]);
    }
}
