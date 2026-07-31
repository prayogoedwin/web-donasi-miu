<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Informasi;

class InformasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Identitas & Profil Masjid
        $identitas = Informasi::create([
            'key' => 'identitas_masjid',
            'value' => 'Identitas & Profil Masjid',
        ]);

        $identitasData = [
            ['key' => 'nama_masjid', 'value' => '\'Izzatul \'Ulya'],
            ['key' => 'tagline_hero', 'value' => 'Sebar Kebaikan, Rawat Rumah Allah'],
            ['key' => 'sub_tagline_hero', 'value' => 'Satu genggaman untuk menunaikan infak, sedekah, dan wakaf bagi kemakmuran masjid.'],
            ['key' => 'alamat_lengkap', 'value' => 'Nandan, Sariharjo, Ngaglik, Sleman'],
            ['key' => 'deskripsi_singkat', 'value' => 'Berdiri di Nandan, Sariharjo, Ngaglik, Sleman, Masjid \'Izzatul \'Ulya menjadi pusat ibadah dan kegiatan sosial-dakwah bagi warga sekitar. Portal donasi ini adalah kanal resmi kepengurusan masjid untuk menghimpun infak, sedekah, dan wakaf dari donatur di mana saja.'],
            ['key' => 'pengelola', 'value' => 'Takmir Masjid \'Izzatul \'Ulya'],
        ];

        foreach ($identitasData as $item) {
            $item['parent_id'] = $identitas->id;
            Informasi::create($item);
        }

        // 2. Statistik Masjid
        $statistik = Informasi::create([
            'key' => 'statistik_masjid',
            'value' => 'Statistik Masjid',
        ]);

        $statistikData = [
            ['key' => 'Jamaah Tetap', 'value' => '1.200+'],
            ['key' => 'Tahun Melayani', 'value' => '12'],
            ['key' => 'Kegiatan Dakwah/Th', 'value' => '30+'],
            ['key' => 'Dana Tersalurkan', 'value' => '100%'],
        ];

        foreach ($statistikData as $item) {
            $item['parent_id'] = $statistik->id;
            Informasi::create($item);
        }

        // 3. Keunggulan / Fitur Portal
        $keunggulan = Informasi::create([
            'key' => 'keunggulan_portal',
            'value' => 'Keunggulan Portal Donasi',
        ]);

        $keunggulanData = [
            [
                'key' => 'Pengelola Terverifikasi',
                'value' => 'Dikelola langsung oleh Takmir & Bendahara Masjid \'Izzatul \'Ulya, bukan pihak ketiga.'
            ],
            [
                'key' => 'Laporan Transparan',
                'value' => 'Rekap dana masuk dan penyaluran dipublikasikan tiap bulan di papan infak & laman ini.'
            ],
            [
                'key' => 'Real-time Progress',
                'value' => 'Pantau capaian tiap program donasi secara langsung, kapan pun dan di mana pun.'
            ],
        ];

        foreach ($keunggulanData as $item) {
            $item['parent_id'] = $keunggulan->id;
            Informasi::create($item);
        }

        // 4. Rekening Resmi
        $rekening = Informasi::create([
            'key' => 'rekening_resmi',
            'value' => 'Rekening Resmi Donasi',
        ]);

        $rekeningData = [
            ['key' => 'bank', 'value' => 'Bank Syariah Indonesia (BSI)'],
            ['key' => 'nomor_rekening', 'value' => '7 xxx xxx xxx'],
            ['key' => 'atas_nama', 'value' => 'Takmir Masjid Izzatul Ulya'],
        ];

        foreach ($rekeningData as $item) {
            $item['parent_id'] = $rekening->id;
            Informasi::create($item);
        }

        // 5. Cara Berdonasi
        $caraDonasi = Informasi::create([
            'key' => 'cara_berdonasi',
            'value' => 'Langkah Cara Berdonasi',
        ]);

        $caraDonasiData = [
            ['key' => 'Langkah 01', 'value' => 'Pilih Program - Tentukan program donasi sesuai niat & kepedulian Anda.'],
            ['key' => 'Langkah 02', 'value' => 'Isi Nominal & Data - Masukkan jumlah donasi dan data diri (opsional anonim).'],
            ['key' => 'Langkah 03', 'value' => 'Bayar via Transfer/QRIS - Selesaikan pembayaran melalui bank transfer, e-wallet, atau QRIS.'],
            ['key' => 'Langkah 04', 'value' => 'Terima Bukti & Doa - Bukti donasi dikirim otomatis, doa jazakumullahu khairan menyertai.'],
        ];

        foreach ($caraDonasiData as $item) {
            $item['parent_id'] = $caraDonasi->id;
            Informasi::create($item);
        }

        // 6. link-link
        $link_link = Informasi::create([
            'key' => 'link_link',
            'value' => 'Link-Link',
        ]);

        $linkLinkData = [
            ['key' => 'IG', 'value' => 'https://instagram.com/your_instagram_handle'],
            ['key' => 'FB', 'value' => 'https://facebook.com/your_facebook_page'],
            ['key' => 'WA', 'value' => 'https://wa.me/your_whatsapp_number'],
            ['key' => 'MAP', 'value' => 'https://maps.google.com/?q=your_address'],
        ];

        foreach ($linkLinkData as $item) {
            $item['parent_id'] = $link_link->id;
            Informasi::create($item);
        }
    }
}
