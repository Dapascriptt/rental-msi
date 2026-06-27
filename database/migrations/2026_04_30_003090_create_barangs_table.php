<?php

use Illuminate\Database\Migrations\Migration;    // class dasar migration
use Illuminate\Database\Schema\Blueprint;         // pendesain kolom
use Illuminate\Support\Facades\Schema;            // helper tabel

return new class extends Migration
{
    public function up(): void                    // membuat tabel "barangs"
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();                          // id (primary key)
            $table->foreignId('tipe_id')->constrained('tipes')->cascadeOnDelete(); // FK ke tipes; tipe dihapus -> barang ikut terhapus
            $table->string('nama_barang');         // nama barang
            $table->text('deskripsi')->nullable(); // deskripsi (boleh kosong)
            $table->timestamps();                  // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barangs');           // hapus tabel barangs saat rollback
    }
};
