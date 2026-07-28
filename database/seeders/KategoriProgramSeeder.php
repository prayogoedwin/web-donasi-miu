<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'title' => 'Pembangunan',
                'description' => 'Program pembangunan infrastruktur dan fasilitas umum.'
            ],
            [
                'title' => 'Operasional',
                'description' => 'Program operasional untuk mendukung kegiatan organisasi.'
            ],
            [
                'title' => 'Sosial',
                'description' => 'Program sosial untuk membantu masyarakat yang membutuhkan.'
            ],
            [
                'title' => 'Pendidikan',
                'description' => 'Program pendidikan untuk meningkatkan kualitas pendidikan.'
            ],
            [
                'title' => 'Yatim & Dhuafa',
                'description' => 'Program bantuan untuk anak yatim dan dhuafa.'
            ],
            [
                'title' => 'Kesehatan',
                'description' => 'Program kesehatan untuk meningkatkan layanan kesehatan masyarakat.'
            ],
            [
                'title' => 'Lainnya',
                'description' => 'Program lainnya yang tidak termasuk dalam kategori di atas.'
            ]
        ];
        foreach ($data as $item) {
            \App\Models\KategoriProgram::create($item);
        }
    }
}
