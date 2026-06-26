<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_tipe'
    ];

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }
}
