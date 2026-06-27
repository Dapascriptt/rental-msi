<?php

namespace App\Models;                            // alamat class model

use Illuminate\Database\Eloquent\Factories\HasFactory; // agar model bisa pakai factory
use Illuminate\Database\Eloquent\Model;          // class dasar model Eloquent

class HargaBarang extends Model                   // model HargaBarang mewakili tabel "harga_barangs"
{
    use HasFactory;                               // mengaktifkan fitur factory

    protected $fillable = [                       // kolom yang boleh diisi massal
        'barang_id',                              // foreign key ke barang
        'harga',                                  // nominal harga sewa
        'satuan'                                  // satuan waktu: jam / hari / minggu / bulan / tahun
    ];

    public function barang()                      // relasi: 1 harga dimiliki 1 barang
    {
        return $this->belongsTo(Barang::class);   // belongsTo karena tabel ini menyimpan barang_id
    }
}
