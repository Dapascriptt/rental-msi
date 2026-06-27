<?php

namespace App\Models;                            // alamat class model

use Illuminate\Database\Eloquent\Factories\HasFactory; // agar model bisa pakai factory
use Illuminate\Database\Eloquent\Model;          // class dasar model Eloquent

class Spesifikasi extends Model                   // model Spesifikasi mewakili tabel "spesifikasis"
{
    use HasFactory;                               // mengaktifkan fitur factory

    protected $fillable = [                       // kolom yang boleh diisi massal
        'barang_id',                              // foreign key ke barang
        'key',                                    // nama spesifikasi (contoh: "Tenaga")
        'value'                                   // nilai spesifikasi (contoh: "150 HP")
    ];

    public function barang()                      // relasi: 1 spesifikasi dimiliki 1 barang
    {
        return $this->belongsTo(Barang::class);   // belongsTo karena tabel ini menyimpan barang_id
    }
}
