<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void                    // membuat tabel "pemesanan_details" (barang apa saja dalam 1 pesanan)
    {
       Schema::create('pemesanan_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemesanan_id')->constrained('pemesanans')->cascadeOnDelete(); // FK ke pemesanan induk
            $table->foreignId('barang_id')->constrained('barangs')->cascadeOnDelete();        // FK ke barang yang dipesan

            $table->integer('qty');                // jumlah unit yang dipesan

            // snapshot harga: harga & satuan disalin saat memesan, agar tidak berubah
            // walau harga master barang nanti diubah
            $table->decimal('harga', 15, 2);       // harga saat memesan
            $table->enum('satuan', ['jam', 'hari', 'minggu', 'bulan', 'tahun']); // satuan saat memesan

            $table->integer('durasi'); // lama durasi sewa

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemesanan_details');
    }
};
