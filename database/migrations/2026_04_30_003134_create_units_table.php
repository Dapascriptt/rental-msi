<?php

use Illuminate\Database\Migrations\Migration;    // class dasar migration
use Illuminate\Database\Schema\Blueprint;         // "kuas" untuk mendesain kolom tabel
use Illuminate\Support\Facades\Schema;            // helper untuk membuat/menghapus tabel

return new class extends Migration                // migration ditulis sebagai class anonim
{
    /**
     * Run the migrations.
     */
    public function up(): void                    // dijalankan saat "php artisan migrate"
    {
        Schema::create('units', function (Blueprint $table) {   // buat tabel bernama "units"
            $table->id();                          // kolom id (angka, naik otomatis, primary key)
            $table->foreignId('barang_id')->constrained('barangs')->cascadeOnDelete(); // FK ke barangs; barang dihapus -> unit ikut terhapus
            $table->string('kode_unit')->unique(); // kolom teks kode_unit, nilainya tidak boleh kembar
            $table->enum('status', ['available', 'booked', 'maintenance'])->default('available'); // pilihan terbatas, default 'available'
            $table->timestamps();                  // buat 2 kolom otomatis: created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void                   // dijalankan saat migrasi dibatalkan (rollback)
    {
        Schema::dropIfExists('units');             // hapus tabel units jika ada (kebalikan dari up)
    }
};
