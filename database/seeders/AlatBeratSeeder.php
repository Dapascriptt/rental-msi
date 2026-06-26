<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tipe;
use App\Models\Barang;
use App\Models\HargaBarang;
use App\Models\Unit;
use App\Models\Spesifikasi;

class AlatBeratSeeder extends Seeder
{
    /**
     * Ambil image berdasarkan model alat berat.
     */
    private function getImageByModel($model)
    {
        return match ($model) {
            'Caterpillar 313' => 'caterpillar-313.png',
            'DX225LCA' => 'dx225LCA.png',
            'DX220A-2' => 'dx220A-2.webp',
            'PC300-8' => 'PC300-8.png',
            'SK130XDL-10', 'SK130XDL-10E' => 'sk130xdl-10.png',
            'SK200-8' => 'sk200-8.png',
            'SK200-10 HD' => 'sk200-10.png',
            default => null,
        };
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataAlatBerat = [
            [
                'brand' => 'Doosan',
                'model' => 'DX225LCA',
                'sn_machine' => '10116',
                'sn_engine' => null,
                'tahun' => '2012',
                'harga' => 270000,
                'spesifikasi' => [
                    'Berat' => '21500',
                    'Kapasitas Bucket (m3)' => '0,92 - 1,05',
                    'Kedalaman Galian Maksimum (m)' => '6,62',
                    'Tinggi (Transportasi) (m)' => '3,03',
                    'Panjang (Transportasi) (m)' => '9,50',
                    'Lebar (Transportasi) (m)' => '2,99',
                ],
            ],
            [
                'brand' => 'Komatsu',
                'model' => 'PC300-8',
                'sn_machine' => null,
                'sn_engine' => null,
                'tahun' => '2014',
                'harga' => 380000,
                'spesifikasi' => [
                    'Berat' => '31000',
                    'Kapasitas Bucket (m3)' => '1,40 - 1,60',
                    'Kedalaman Galian Maksimum (m)' => '7,38',
                    'Tinggi (Transportasi) (m)' => '3,28',
                    'Panjang (Transportasi) (m)' => '11,13',
                    'Lebar (Transportasi) (m)' => '3,19',
                ],
            ],
            [
                'brand' => 'Kobelco',
                'model' => 'SK200-8',
                'sn_machine' => null,
                'sn_engine' => null,
                'tahun' => '2015',
                'harga' => 270000,
                'spesifikasi' => [
                    'Berat' => '20000',
                    'Kapasitas Bucket (m3)' => '0,80 - 1,00',
                    'Kedalaman Galian Maksimum (m)' => '6,67',
                    'Tinggi (Transportasi) (m)' => '2,98',
                    'Panjang (Transportasi) (m)' => '9,42',
                    'Lebar (Transportasi) (m)' => '2,80',
                ],
            ],
            [
                'brand' => 'Doosan',
                'model' => 'DX220A-2',
                'sn_machine' => 'DXCCEBDGCM0022091',
                'sn_engine' => '7DB58TIS143964E05',
                'tahun' => '2022',
                'harga' => 300000,
                'spesifikasi' => [
                    'Berat' => '21800',
                    'Kapasitas Bucket (m3)' => '0,92 - 1,05',
                    'Kedalaman Galian Maksimum (m)' => '6,59',
                    'Tinggi (Transportasi) (m)' => '3,00',
                    'Panjang (Transportasi) (m)' => '9,50',
                    'Lebar (Transportasi) (m)' => '2,99',
                ],
            ],
            [
                'brand' => 'Kobelco',
                'model' => 'SK200-10 HD',
                'sn_machine' => 'YN1531724',
                'sn_engine' => '7JO5ETGP90006',
                'tahun' => '2022',
                'harga' => 300000,
                'spesifikasi' => [
                    'Berat' => '20600',
                    'Kapasitas Bucket (m3)' => '0,80 - 1,00',
                    'Kedalaman Galian Maksimum (m)' => '6,70',
                    'Tinggi (Transportasi) (m)' => '2,97',
                    'Panjang (Transportasi) (m)' => '9,42',
                    'Lebar (Transportasi) (m)' => '2,80',
                ],
            ],
            [
                'brand' => 'Kobelco',
                'model' => 'SK130XDL-10',
                'sn_machine' => 'LX08406468',
                'sn_engine' => 'D04FR-032511',
                'tahun' => '2023',
                'harga' => 240000,
                'spesifikasi' => [
                    'Berat' => '13700',
                    'Kapasitas Bucket (m3)' => '0,45 - 0,65',
                    'Kedalaman Galian Maksimum (m)' => '5,52',
                    'Tinggi (Transportasi) (m)' => '2,80',
                    'Panjang (Transportasi) (m)' => '7,59',
                    'Lebar (Transportasi) (m)' => '2,49',
                ],
            ],
            [
                'brand' => 'Kobelco',
                'model' => 'SK130XDL-10',
                'sn_machine' => 'LX08406470',
                'sn_engine' => 'DO4FR-032504',
                'tahun' => '2023',
                'harga' => 240000,
                'spesifikasi' => [
                    'Berat' => '13700',
                    'Kapasitas Bucket (m3)' => '0,45 - 0,65',
                    'Kedalaman Galian Maksimum (m)' => '5,52',
                    'Tinggi (Transportasi) (m)' => '2,80',
                    'Panjang (Transportasi) (m)' => '7,59',
                    'Lebar (Transportasi) (m)' => '2,49',
                ],
            ],
            [
                'brand' => 'Kobelco',
                'model' => 'SK130XDL-10E',
                'sn_machine' => 'LX10400136',
                'sn_engine' => '670918',
                'tahun' => '2023',
                'harga' => 240000,
                'spesifikasi' => [
                    'Berat' => '13900',
                    'Kapasitas Bucket (m3)' => '0,50 - 0,65',
                    'Kedalaman Galian Maksimum (m)' => '5,52',
                    'Tinggi (Transportasi) (m)' => '2,80',
                    'Panjang (Transportasi) (m)' => '7,59',
                    'Lebar (Transportasi) (m)' => '2,49',
                ],
            ],
            [
                'brand' => 'Kobelco',
                'model' => 'SK200-10 HD',
                'sn_machine' => 'YN15434118',
                'sn_engine' => 'JO5ETG55680',
                'tahun' => '2024',
                'harga' => 350000,
                'spesifikasi' => [
                    'Berat' => '20600',
                    'Kapasitas Bucket (m3)' => '0,80 - 1,00',
                    'Kedalaman Galian Maksimum (m)' => '6,70',
                    'Tinggi (Transportasi) (m)' => '2,97',
                    'Panjang (Transportasi) (m)' => '9,42',
                    'Lebar (Transportasi) (m)' => '2,80',
                ],
            ],
            [
                'brand' => 'Doosan',
                'model' => 'DX220A-2',
                'sn_machine' => null,
                'sn_engine' => null,
                'tahun' => '2024',
                'harga' => 350000,
                'spesifikasi' => [
                    'Berat' => '21800',
                    'Kapasitas Bucket (m3)' => '0,92 - 1,05',
                    'Kedalaman Galian Maksimum (m)' => '6,59',
                    'Tinggi (Transportasi) (m)' => '3,00',
                    'Panjang (Transportasi) (m)' => '9,50',
                    'Lebar (Transportasi) (m)' => '2,99',
                ],
            ],
            [
                'brand' => 'Komatsu',
                'model' => 'PC300-8',
                'sn_machine' => null,
                'sn_engine' => null,
                'tahun' => '2024',
                'harga' => 500000,
                'spesifikasi' => [
                    'Berat' => '31100',
                    'Kapasitas Bucket (m3)' => '1,40 - 1,60',
                    'Kedalaman Galian Maksimum (m)' => '7,38',
                    'Tinggi (Transportasi) (m)' => '3,28',
                    'Panjang (Transportasi) (m)' => '11,13',
                    'Lebar (Transportasi) (m)' => '3,19',
                ],
            ],
            [
                'brand' => 'Caterpillar',
                'model' => 'Caterpillar 313',
                'sn_machine' => null,
                'sn_engine' => null,
                'tahun' => '2025',
                'harga' => 280000,
                'spesifikasi' => [
                    'Berat' => '13800',
                    'Kapasitas Bucket (m3)' => '0,53 - 0,65',
                    'Kedalaman Galian Maksimum (m)' => '5,90',
                    'Tinggi (Transportasi) (m)' => '2,83',
                    'Panjang (Transportasi) (m)' => '7,79',
                    'Lebar (Transportasi) (m)' => '2,49',
                ],
            ],
            [
                'brand' => 'Caterpillar',
                'model' => 'Caterpillar 313',
                'sn_machine' => null,
                'sn_engine' => null,
                'tahun' => '2025',
                'harga' => 280000,
                'spesifikasi' => [
                    'Berat' => '13800',
                    'Kapasitas Bucket (m3)' => '0,53 - 0,65',
                    'Kedalaman Galian Maksimum (m)' => '5,90',
                    'Tinggi (Transportasi) (m)' => '2,83',
                    'Panjang (Transportasi) (m)' => '7,79',
                    'Lebar (Transportasi) (m)' => '2,49',
                ],
            ],
        ];

        foreach ($dataAlatBerat as $index => $item) {
            // 1. Insert atau get Tipe / Brand
            $tipe = Tipe::firstOrCreate([
                'nama_tipe' => $item['brand'],
            ]);

            // 2. Insert atau update Barang / Model
            $barang = Barang::updateOrCreate(
                [
                    'tipe_id' => $tipe->id,
                    'nama_barang' => $item['model'],
                ],
                [
                    'deskripsi' => 'Unit Alat Berat ' . $item['brand'] . ' ' . $item['model'],
                    'image' => $this->getImageByModel($item['model']),
                ]
            );

            // 3. Insert atau update spesifikasi barang
            foreach ($item['spesifikasi'] as $key => $value) {
                Spesifikasi::updateOrCreate(
                    [
                        'barang_id' => $barang->id,
                        'key' => $key,
                    ],
                    [
                        'value' => $value,
                    ]
                );
            }

            // 4. Insert atau update harga barang, ambil harga tertinggi
            $hargaExisting = HargaBarang::where('barang_id', $barang->id)->first();

            if (!$hargaExisting) {
                HargaBarang::create([
                    'barang_id' => $barang->id,
                    'harga' => $item['harga'],
                    'satuan' => 'Jam',
                ]);
            } else {
                if ($item['harga'] > $hargaExisting->harga) {
                    $hargaExisting->update([
                        'harga' => $item['harga'],
                    ]);
                }
            }

            // 5. Insert unit
            $kodeUnit = 'UNIT-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT);

            Unit::create([
                'barang_id' => $barang->id,
                'kode_unit' => $kodeUnit,
                'serial_machine' => $item['sn_machine'],
                'serial_engine' => $item['sn_engine'],
                'tahun_migrasi' => $item['tahun'],
                'status' => 'available',
            ]);
        }
    }
}