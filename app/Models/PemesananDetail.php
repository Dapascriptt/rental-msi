<?php

namespace App\Models;                            // alamat class model

use Illuminate\Database\Eloquent\Factories\HasFactory; // agar model bisa pakai factory
use Illuminate\Database\Eloquent\Model;          // class dasar model Eloquent

class PemesananDetail extends Model               // model PemesananDetail mewakili tabel "pemesanan_details"
{
    use HasFactory;                               // mengaktifkan fitur factory

    protected $fillable = [                       // kolom yang boleh diisi massal
        'pemesanan_id',                           // foreign key ke pemesanan induk
        'barang_id',                              // barang apa yang dipesan
        'qty',                                    // jumlah unit yang dipesan
        'harga',                                  // harga saat dipesan
        'satuan',                                 // satuan waktu sewa
        'durasi'                                  // lama durasi sewa
    ];

    public function pemesanan()                   // relasi: 1 detail dimiliki 1 pemesanan
    {
        return $this->belongsTo(Pemesanan::class);
    }

    public function barang()                      // relasi: 1 detail merujuk ke 1 barang
    {
        return $this->belongsTo(Barang::class);
    }

    public function units()                       // relasi: 1 detail bisa punya banyak unit yang dipesan
    {
        return $this->hasMany(PemesananUnit::class);
    }
}
