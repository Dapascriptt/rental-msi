<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migration bawaan Laravel: membuat tabel users (untuk sistem login).
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();                          // id user
            $table->string('name');                // nama user
            $table->string('email')->unique();     // email, tidak boleh kembar (dipakai login)
            $table->timestamp('email_verified_at')->nullable(); // waktu verifikasi email (boleh kosong)
            $table->string('password');            // password (tersimpan dalam bentuk hash)
            $table->rememberToken();               // kolom token untuk fitur "ingat saya"
            $table->timestamps();                  // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
