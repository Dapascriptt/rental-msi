<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Menambahkan kolom email & keterangan ke tabel pemesanans yang sudah ada.
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
           $table->string('emails')->nullable()->after('nama_pemesan');      // email pemesan (untuk notifikasi)
           $table->string('keterangan')->nullable()->after('tanggal_selesai'); // catatan tambahan
        });
    }

    public function down(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            $table->dropColumn('emails');      // hapus kolom emails
            $table->dropColumn('keterangan');  // hapus kolom keterangan
        });
    }
};
