<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migration bawaan Laravel: tabel untuk menyimpan token reset password.
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();    // email sebagai primary key
            $table->string('token');               // token rahasia untuk reset password
            $table->timestamp('created_at')->nullable(); // kapan token dibuat
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
    }
};
