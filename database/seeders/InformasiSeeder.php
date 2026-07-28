<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InformasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'key' => 'nama_masjid',
                'value' => 'Masjid \'Izzatul \'Ulya'
            ],
            [
                'key' => 'alamat_masjid',
                'value' => 'Jl. Raya Sariharjo No. 123, Sariharjo, Ngaglik, Sleman, Yogyakarta'
            ],
            [
                'key' => 'no_telepon',
                'value' => '+62 812-3456-7890'
            ],
            [
                'key' => 'email',
                'value' => 'info@masjid-izzatul-ulya.or.id'
            ],
            [
                'key' => 'Text Header 1',
                'value' => 'Sebar Kebaikan, Rawat Rumah Allah'
            ],
            [
                'key' => 'Text sub Header 1',
                'value' => 'Satu genggaman untuk menunaikan infak, sedekah, dan wakaf bagi kemakmuran masjid.',
            ],
            [
                'key' => 'Text Header 2',
                'value' => 'Wujudkan Kubah & Ruang Utama yang Lebih Layak'
            ],
            [
                'key' => 'Text sub Header 2',
                'value' => 'Bantu percepat penyelesaian renovasi masjid lewat donasi terkurasi & transparan dari Takmir langsung.',
            ]
        ];
        foreach ($data as $item) {
            \App\Models\Informasi::create($item);
        }
    }
}
