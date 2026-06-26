<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spesifikasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id',
        'key',
        'value'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
