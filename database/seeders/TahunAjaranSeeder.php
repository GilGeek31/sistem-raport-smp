<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TahunAjaran;

class TahunAjaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TahunAjaran::firstOrCreate(
            ['nama' => '2025/2026', 'semester' => 'ganjil'],
            ['status_aktif' => true]
        );

        TahunAjaran::firstOrCreate(
            ['nama' => '2025/2026', 'semester' => 'genap'],
            ['status_aktif' => false]
        );
    }
}
