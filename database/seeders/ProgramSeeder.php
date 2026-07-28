<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'title' => 'Perluasan Lantai 2 untuk Jamaah Wanita',
                'description' => 'oleh Takmir Masjid \'Izzatul \'Ulya',
                'is_priority' => false,
                'kategori_program_id' => 1, // Pembangunan
                'target_amount' => 1000000000,
                'collected_amount' => 250000000,
                'donor_count' => 150,
                'status' => 'active',
                'image_path' => null,
                'start_date' => now(),
                'end_date' => now()->addMonths(6),
            ],
            [
                'title' => 'Santunan Bulanan 40 Anak Yatim Sariharjo',
                'description' => 'oleh Bidang Sosial Masjid',
                'is_priority' => false,
                'kategori_program_id' => 2, // Operasional
                'target_amount' => 500000000,
                'collected_amount' => 100000000,
                'donor_count' => 75,
                'status' => 'active',
                'image_path' => null,
                'start_date' => now(),
                'end_date' => now()->addMonths(3),
            ],
            [
                'title' => 'Infak Listrik, Air & Kebersihan Masjid',
                'description' => 'Kebutuhan rutin bulanan',
                'is_priority' => false,
                'kategori_program_id' => 2, // Operasional
                'target_amount' => 200000000,
                'collected_amount' => 50000000,
                'donor_count' => 30,
                'status' => 'active',
                'image_path' => null,
                'start_date' => now(),
                'end_date' => now()->addMonths(1),
            ],
            [
                'title' => "Wakaf Al-Qur'an & Buku Iqra TPA",
                'description' => 'oleh Bidang Dakwah & TPA',
                'is_priority' => false,
                'kategori_program_id' => 4, // Pendidikan
                'target_amount' => 300000000,
                'collected_amount' => 75000000,
                'donor_count' => 50,
                'status' => 'active',
                'image_path' => null,
                'start_date' => now(),
                'end_date' => now()->addMonths(4),
            ],
            [
                'title' => 'Renovasi Tempat Wudhu & Toilet Umum',
                'description' => 'oleh Takmir Masjid \'Izzatul \'Ulya',
                'is_priority' => true,
                'kategori_program_id' => 1, // Pembangunan
                'target_amount' => 800000000,
                'collected_amount' => 400000000,
                'donor_count' => 200,
                'status' => 'active',
                'image_path' => null,
                'start_date' => now(),
                'end_date' => now()->addMonths(5),
            ],
            [
                'title' => 'Dapur Berkah Jumat — Berbagi Nasi Kotak',
                'description' => 'oleh Bidang Sosial Masjid',
                'is_priority' => false,
                'kategori_program_id' => 2, // Operasional
                'target_amount' => 100000000,
                'collected_amount' => 25000000,
                'donor_count' => 40,
                'status' => 'active',
                'image_path' => null,
                'start_date' => now(),
                'end_date' => now()->addMonths(2),
            ],

            // Tambahkan data program lainnya sesuai kebutuhan
        ];

        foreach ($data as $item) {
            \App\Models\Program::create($item);
        }
    }
}
