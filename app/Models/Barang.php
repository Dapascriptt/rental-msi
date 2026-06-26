<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipe_id',
        'nama_barang',
        'deskripsi',
         'image'
    ];

    public function tipe()
    {
        return $this->belongsTo(Tipe::class);
    }

    public function spesifikasis()
    {
        return $this->hasMany(Spesifikasi::class);
    }

    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    public function hargaBarangs()
    {
        return $this->hasMany(HargaBarang::class);
    }
}