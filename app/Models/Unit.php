<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id',
        'kode_unit',
        'serial_machine',
        'serial_engine',
        'tahun_migrasi',
        'status'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function pemesananUnits()
    {
        return $this->hasMany(PemesananUnit::class);
    }
}
