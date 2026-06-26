<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('units', function (Blueprint $table) {
            $table->string('serial_machine')->nullable()->after('kode_unit');
            $table->string('serial_engine')->nullable()->after('serial_machine');
            $table->integer('tahun_migrasi')->nullable()->after('serial_engine');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('units', function (Blueprint $table) {
            $table->dropColumn(['serial_machine', 'serial_engine', 'tahun_migrasi']);
        });
    }
};
