<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pemesan',
        'no_hp',
        'perusahaan',
        'alamat',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'emails',
        'keterangan'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function details()
    {
        return $this->hasMany(PemesananDetail::class);
    }
}
