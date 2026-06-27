<?php

namespace App\Models;                            // alamat class model

use Illuminate\Database\Eloquent\Factories\HasFactory; // agar model bisa pakai factory (data palsu)
use Illuminate\Database\Eloquent\Model;          // class dasar semua model Eloquent

class Barang extends Model                        // model Barang mewakili tabel "barangs"
{
    use HasFactory;                               // mengaktifkan fitur factory

    protected $fillable = [                       // daftar kolom yang boleh diisi massal (create/update)
        'tipe_id',                                // foreign key ke tabel tipes
        'nama_barang',                            // nama barang
        'deskripsi',                              // keterangan barang
         'image'                                  // nama file gambar
    ];

    public function tipe()                        // relasi: 1 barang dimiliki 1 tipe
    {
        return $this->belongsTo(Tipe::class);     // belongsTo dipakai karena tabel barangs menyimpan tipe_id
    }

    public function spesifikasis()                // relasi: 1 barang punya banyak spesifikasi
    {
        return $this->hasMany(Spesifikasi::class);
    }

    public function units()                       // relasi: 1 barang punya banyak unit fisik
    {
        return $this->hasMany(Unit::class);
    }

    public function hargaBarangs()                // relasi: 1 barang punya banyak data harga
    {
        return $this->hasMany(HargaBarang::class);
    }
}
