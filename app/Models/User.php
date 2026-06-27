<?php

namespace App\Models;                            // alamat class model

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;      // agar model bisa pakai factory
use Illuminate\Foundation\Auth\User as Authenticatable;     // class dasar khusus user yang bisa login
use Illuminate\Notifications\Notifiable;                    // agar user bisa dikirimi notifikasi
use Laravel\Sanctum\HasApiTokens;                           // agar user bisa punya token API (Sanctum)

class User extends Authenticatable                // model User; dipakai untuk sistem login
{
    use HasApiTokens, HasFactory, Notifiable;     // memakai tiga kemampuan di atas

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [                       // kolom yang boleh diisi massal
        'name',                                   // nama user
        'email',                                  // email (dipakai untuk login)
        'password',                               // password (otomatis di-hash, lihat $casts)
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [                         // kolom yang DISEMBUNYIKAN saat data diubah jadi array/JSON
        'password',                               // jangan pernah tampilkan password
        'remember_token',                         // token "ingat saya" juga disembunyikan
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [                          // ubah tipe data otomatis
        'email_verified_at' => 'datetime',        // jadikan objek tanggal-waktu
        'password' => 'hashed',                   // password otomatis di-hash saat disimpan
    ];
}
