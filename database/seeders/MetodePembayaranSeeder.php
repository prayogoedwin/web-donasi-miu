<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MetodePembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'title' => 'Bank Transfer',
                'kode' => 'BT001',
            ],
            [
                'title' => 'Alfamart',
                'kode' => 'AL001',
            ],
            [
                'title' => 'Indomaret',
                'kode' => 'IN001',
            ],
            [
                'title' => 'QRIS',
                'kode' => 'QR001',
            ],
            [
                'title' => 'Gopay',
                'kode' => 'GP001',
            ],
            [
                'title' => 'Dana',
                'kode' => 'DA001',
            ],
            [
                'title' => 'OVO',
                'kode' => 'OV001',
            ],
            [
                'title' => 'LinkAja',
                'kode' => 'LA001',
            ],
        ];

        \App\Models\MetodePembayaran::insert($data);
    }
}
