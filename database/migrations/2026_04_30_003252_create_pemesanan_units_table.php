<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void                    // membuat tabel penghubung "pemesanan_units" (unit fisik mana yang dipakai)
    {
        Schema::create('pemesanan_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemesanan_detail_id')->constrained('pemesanan_details')->cascadeOnDelete(); // FK ke detail pesanan
            $table->foreignId('unit_id')->constrained('units')->cascadeOnDelete();                          // FK ke unit fisik
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemesanan_units');
    }
};
