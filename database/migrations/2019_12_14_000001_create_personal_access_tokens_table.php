<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migration bawaan Laravel (Sanctum): tabel token akses API per user.
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable');           // relasi polymorphic: token bisa milik model apa pun (biasanya User)
            $table->string('name');                // nama token
            $table->string('token', 64)->unique(); // string token, unik
            $table->text('abilities')->nullable(); // daftar izin token (boleh kosong)
            $table->timestamp('last_used_at')->nullable(); // terakhir dipakai
            $table->timestamp('expires_at')->nullable();    // kapan kedaluwarsa
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};
