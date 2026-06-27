<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migration ini MENAMBAH kolom ke tabel yang sudah ada (pakai Schema::table, bukan create).
return new class extends Migration
{
    public function up(): void                    // menambahkan kolom 'image' ke tabel barangs
    {
       Schema::table('barangs', function (Blueprint $table) {
            $table->string('image')->nullable();   // kolom nama file gambar (boleh kosong)
        });
    }

    public function down(): void                   // kebalikannya: hapus kolom 'image'
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};
