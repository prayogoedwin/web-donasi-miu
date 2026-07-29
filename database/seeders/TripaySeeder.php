<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tripay;

class TripaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tripay::create([
            'environment' => 'sandbox',
            'api_key' => 'YOUR_SANDBOX_API_KEY',
            'url_sandbox' => 'https://tripay.co.id/api-sandbox',
            'url_production' => 'https://tripay.co.id/api',
        ]);


    }
}
