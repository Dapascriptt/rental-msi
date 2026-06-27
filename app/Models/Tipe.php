<?php

namespace App\Models;                            // alamat class model

use Illuminate\Database\Eloquent\Factories\HasFactory; // agar model bisa pakai factory (data palsu)
use Illuminate\Database\Eloquent\Model;          // class dasar semua model Eloquent

class Tipe extends Model                          // model Tipe mewakili tabel "tipes"
{
    use HasFactory;                               // mengaktifkan fitur factory

    protected $fillable = [                       // kolom yang boleh diisi massal (create/update)
        'nama_tipe'                               // nama tipe alat berat (Excavator, Genset, dll)
    ];

    public function barangs()                     // relasi: 1 tipe punya banyak barang
    {
        return $this->hasMany(Barang::class);     // hasMany karena tipe adalah "induk" dari barang
    }
}
