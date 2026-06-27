<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migration bawaan Laravel: tabel untuk mencatat "job" (tugas latar) yang GAGAL.
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();      // kode unik tiap job
            $table->text('connection');            // koneksi queue yang dipakai
            $table->text('queue');                 // nama antrean
            $table->longText('payload');           // isi data job
            $table->longText('exception');         // pesan error penyebab gagal
            $table->timestamp('failed_at')->useCurrent(); // waktu gagal (default = sekarang)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('failed_jobs');
    }
};
