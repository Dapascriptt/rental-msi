<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemesanan_id',
        'barang_id',
        'qty',
        'harga',
        'satuan',
        'durasi'
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function units()
    {
        return $this->hasMany(PemesananUnit::class);
    }
}
