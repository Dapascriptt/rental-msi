<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void                    // membuat tabel "pemesanans"
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemesan');        // nama pemesan
            $table->string('no_hp')->nullable();   // nomor HP (boleh kosong)
            $table->string('perusahaan')->nullable(); // nama perusahaan (boleh kosong)
            $table->text('alamat')->nullable();    // alamat (boleh kosong)

            $table->date('tanggal_mulai');         // tanggal mulai sewa
            $table->date('tanggal_selesai');       // tanggal selesai sewa

            $table->enum('status', ['pending', 'confirmed', 'ongoing', 'done', 'cancelled']) // status pesanan
                ->default('pending');              // default 'pending' saat pertama dibuat

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
