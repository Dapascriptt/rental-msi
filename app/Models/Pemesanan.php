<?php

namespace App\Models;                            // alamat class model

use Illuminate\Database\Eloquent\Factories\HasFactory; // agar model bisa pakai factory
use Illuminate\Database\Eloquent\Model;          // class dasar model Eloquent

class Pemesanan extends Model                     // model Pemesanan mewakili tabel "pemesanans"
{
    use HasFactory;                               // mengaktifkan fitur factory

    protected $fillable = [                       // kolom yang boleh diisi massal
        'nama_pemesan',                           // nama orang yang memesan
        'no_hp',                                  // nomor HP pemesan
        'perusahaan',                             // nama perusahaan (opsional)
        'alamat',                                 // alamat pemesan
        'tanggal_mulai',                          // tanggal mulai sewa
        'tanggal_selesai',                        // tanggal selesai sewa
        'status',                                 // status pesanan: pending/ongoing/confirmed/cancelled
        'emails',                                 // email pemesan (untuk notifikasi)
        'keterangan'                              // catatan tambahan
    ];

    protected $casts = [                          // ubah tipe data otomatis saat diambil dari DB
        'tanggal_mulai' => 'date',                // jadikan objek tanggal (mudah diformat)
        'tanggal_selesai' => 'date',
    ];

    public function details()                     // relasi: 1 pemesanan punya banyak detail (barang yang dipesan)
    {
        return $this->hasMany(PemesananDetail::class);
    }
}
