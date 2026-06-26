<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemesanan_detail_id',
        'unit_id'
    ];

    public function detail()
    {
        return $this->belongsTo(PemesananDetail::class, 'pemesanan_detail_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
