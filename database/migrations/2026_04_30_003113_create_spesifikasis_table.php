<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void                    // membuat tabel "spesifikasis"
    {
        Schema::create('spesifikasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->constrained('barangs')->cascadeOnDelete(); // FK ke barangs
            $table->string('key');                 // nama spesifikasi (contoh: "Tenaga")
            $table->string('value');               // nilai spesifikasi (contoh: "150 HP")
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spesifikasis');
    }
};
