<?php

namespace App\Models;                            // alamat class model

use Illuminate\Database\Eloquent\Factories\HasFactory; // agar model bisa pakai factory
use Illuminate\Database\Eloquent\Model;          // class dasar model Eloquent

class PemesananUnit extends Model                 // tabel penghubung: unit mana yang dipakai di sebuah detail pesanan
{
    use HasFactory;                               // mengaktifkan fitur factory

    protected $fillable = [                       // kolom yang boleh diisi massal
        'pemesanan_detail_id',                    // foreign key ke detail pemesanan
        'unit_id'                                 // foreign key ke unit fisik
    ];

    public function detail()                      // relasi: milik 1 detail pemesanan
    {
        // parameter kedua menyebut nama kolom FK secara eksplisit (pemesanan_detail_id)
        return $this->belongsTo(PemesananDetail::class, 'pemesanan_detail_id');
    }

    public function unit()                        // relasi: merujuk ke 1 unit
    {
        return $this->belongsTo(Unit::class);
    }
}
