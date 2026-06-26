<?php

namespace Database\Seeders;

use App\Models\Tipe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipeSeeder extends Seeder
{
    public function run(): void
    {
        $tipes = [
            ['nama_tipe' => 'Excavator'],
            ['nama_tipe' => 'Dump Truck'],
            ['nama_tipe' => 'Genset'],
        ];

        foreach ($tipes as $tipe) {
            Tipe::create($tipe);
        }
    }
}