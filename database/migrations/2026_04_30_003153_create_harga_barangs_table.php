<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void                    // membuat tabel "harga_barangs"
    {
        Schema::create('harga_barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->constrained('barangs')->cascadeOnDelete(); // FK ke barangs
            $table->decimal('harga', 15, 2);       // angka desimal (15 digit, 2 angka di belakang koma) untuk uang
            $table->enum('satuan', ['jam', 'hari', 'minggu', 'bulan', 'tahun']); // satuan waktu sewa (pilihan terbatas)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('harga_barangs');
    }
};
