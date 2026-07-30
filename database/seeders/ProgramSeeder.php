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
                'proposed_by' => 'Takmir Masjid \'Izzatul \'Ulya',
                'description' => 'Program ini bertujuan untuk memperluas area sholat lantai 2 khusus untuk jamaah wanita, sehingga dapat menampung lebih banyak jamaah dan memberikan kenyamanan dalam beribadah.',
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
                'proposed_by' => 'Bidang Sosial Masjid',
                'description' => 'Program ini bertujuan untuk memberikan santunan bulanan kepada 40 anak yatim di Desa Sariharjo, sebagai bentuk kepedulian dan dukungan terhadap pendidikan dan kesejahteraan mereka.',
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
                'proposed_by' => 'Bidang Operasional Masjid',
                'description' => 'Program ini bertujuan untuk mengumpulkan dana infak guna membiayai kebutuhan listrik, air, dan kebersihan masjid, sehingga masjid tetap bersih, nyaman, dan dapat digunakan oleh jamaah dengan baik.',
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
                'proposed_by' => 'Bidang Dakwah & TPA',
                'description' => 'Program ini bertujuan untuk mengumpulkan dana wakaf guna membeli Al-Qur\'an dan buku Iqra untuk Taman Pendidikan Al-Qur\'an (TPA) di masjid, sehingga anak-anak dapat belajar membaca Al-Qur\'an dengan baik.',
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
                'proposed_by' => 'Takmir Masjid \'Izzatul \'Ulya',
                'description' => 'Program ini bertujuan untuk merenovasi tempat wudhu dan toilet umum di masjid, sehingga fasilitas tersebut menjadi lebih bersih, nyaman, dan layak digunakan oleh jamaah.',
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
                'proposed_by' => 'Bidang Sosial Masjid',
                'description' => 'Program ini bertujuan untuk menyediakan nasi kotak bagi masyarakat kurang mampu setiap hari Jumat, sebagai bentuk kepedulian dan berbagi berkah kepada sesama.',
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
