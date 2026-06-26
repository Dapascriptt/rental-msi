<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaBarang extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id',
        'harga',
        'satuan'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
