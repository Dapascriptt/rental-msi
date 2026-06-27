<?php

namespace App\Models;                            // alamat class model

use Illuminate\Database\Eloquent\Factories\HasFactory; // agar model bisa pakai factory
use Illuminate\Database\Eloquent\Model;          // class dasar model Eloquent

class Unit extends Model                          // model Unit mewakili tabel "units" (wujud fisik barang)
{
    use HasFactory;                               // mengaktifkan fitur factory

    protected $fillable = [                       // kolom yang boleh diisi massal
        'barang_id',                              // foreign key ke barang induknya
        'kode_unit',                              // kode unik tiap unit
        'serial_machine',                         // nomor seri mesin
        'serial_engine',                          // nomor seri engine
        'tahun_migrasi',                          // tahun migrasi/produksi
        'status'                                  // status: available / booked / maintenance
    ];

    public function barang()                      // relasi: 1 unit dimiliki 1 barang
    {
        return $this->belongsTo(Barang::class);   // belongsTo karena tabel units menyimpan barang_id
    }

    public function pemesananUnits()              // relasi: 1 unit bisa muncul di banyak baris pemesanan
    {
        return $this->hasMany(PemesananUnit::class);
    }
}
