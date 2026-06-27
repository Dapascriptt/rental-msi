<?php

use Illuminate\Database\Migrations\Migration;    // class dasar migration
use Illuminate\Database\Schema\Blueprint;         // "kuas" untuk mendesain kolom
use Illuminate\Support\Facades\Schema;            // helper buat/hapus tabel

return new class extends Migration                // migration sebagai class anonim
{
    public function up(): void                    // dijalankan saat "php artisan migrate"
    {
        Schema::create('tipes', function (Blueprint $table) { // buat tabel "tipes"
            $table->id();                          // kolom id (primary key, naik otomatis)
            $table->string('nama_tipe');           // kolom teks nama tipe
            $table->timestamps();                  // created_at & updated_at otomatis
        });
    }

    public function down(): void                   // dijalankan saat rollback
    {
        Schema::dropIfExists('tipes');             // hapus tabel tipes
    }
};
