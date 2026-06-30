<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mapel;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mapels = [
            ['kode_mapel' => 'MTK', 'nama_mapel' => 'Matematika', 'kategori' => 'umum'],
            ['kode_mapel' => 'BIN', 'nama_mapel' => 'Bahasa Indonesia', 'kategori' => 'umum'],
            ['kode_mapel' => 'BIG', 'nama_mapel' => 'Bahasa Inggris', 'kategori' => 'umum'],
            ['kode_mapel' => 'IPS', 'nama_mapel' => 'Ilmu Pengetahuan Alam', 'kategori' => 'umum'],
            ['kode_mapel' => 'IPS', 'nama_mapel' => 'Ilmu Pengetahuan Sosisal', 'kategori' => 'umum'],
            ['kode_mapel' => 'PKN', 'nama_mapel' => 'Pendidikan Pancasila', 'kategori' => 'umum'],
            ['kode_mapel' => 'PJOK', 'nama_mapel' => 'Pendidikan Jasmani', 'kategori' => 'umum'],
            ['kode_mapel' => 'SBD', 'nama_mapel' => 'Seni Budaya', 'kategori' => 'umum'],
        ];

        foreach ($mapels as $mapel) {
            Mapel::firstOrCreate(['kode_mapel' => $mapel['kode_mapel']], $mapel);
        }
    }
}
