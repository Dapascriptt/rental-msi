<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Menambahkan 3 kolom baru ke tabel units yang sudah ada.
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('units', function (Blueprint $table) {
            $table->string('serial_machine')->nullable()->after('kode_unit');     // nomor seri mesin; ->after = letakkan setelah kolom kode_unit
            $table->string('serial_engine')->nullable()->after('serial_machine'); // nomor seri engine
            $table->integer('tahun_migrasi')->nullable()->after('serial_engine'); // tahun migrasi/produksi
        });
    }

    public function down(): void
    {
        Schema::table('units', function (Blueprint $table) {
            $table->dropColumn(['serial_machine', 'serial_engine', 'tahun_migrasi']); // hapus ketiga kolom saat rollback
        });
    }
};
