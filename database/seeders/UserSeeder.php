<?php

namespace Database\Seeders;                       // alamat class seeder

use App\Models\User;                              // model User
use Illuminate\Database\Seeder;                   // class dasar seeder
use Illuminate\Support\Facades\Hash;              // untuk hash password

class UserSeeder extends Seeder
{
    public function run(): void                    // membuat akun admin default
    {
        // updateOrCreate: kalau email ini sudah ada -> diperbarui; kalau belum -> dibuat.
        // Mencegah duplikat saat seeder dijalankan berkali-kali.
        User::updateOrCreate(
            ['email' => 'admin@rental.com'],       // kunci pencarian: email admin
            [
                'name' => 'Admin',                 // nama
                'password' => Hash::make('password123'), // password 'password123' yang di-hash
            ]
        );
    }
}
