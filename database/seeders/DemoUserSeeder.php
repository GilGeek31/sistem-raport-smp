<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DemoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        //1. Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@demo.test'],
            ['name' => 'Admin Sekolah', 'password' => Hash::make('password')]
        );
        $admin->assignRole('admin');

        //2. Guru (sekaligus jadi wali kelas)
        $userGuru = User::firstOrCreate(
            ['email' => 'guru@demo.test'],
            ['name' => 'Ibrahim', 'password' => Hash::make('password')]
        );
        $userGuru->assignRole(['guru', 'wali_kelas']);

        $guru = Guru::firstOrCreate(
            ['email' => 'guru@demo.test'],
            [
                'user_id' => $userGuru->id,
                'nip' => '198308082022211021',
                'nama' => 'Ibrahim',
                'no_hp' => '081234567890',
            ]
        );

        //3. Kepala Sekolah
        $userKepsek = User::firstOrCreate(
            ['email' => 'kepsek@demo.test'],
            ['name' => 'Indir Mawan', 'password' => Hash::make('password')]
        );
        $userKepsek->assignRole('kepala_sekolah');

        //4. Tahun Ajaran Aktif (untuk dipakai membuat kelas demo)
        $tahunAjaran = TahunAjaran::where('status_aktif', true)->first();

        //5. Kelas Demo, wali kelasnya pak ibrahim
        $kelas = Kelas::firstOrCreate(
            [
                'nama_kelas' => '7A',
                'tahun_ajaran_id' => $tahunAjaran->id
            ],
            [
                'tingkat' => 7,
                'wali_kelas_id' => $guru->id
            ]
        );

        //6. Siswa
        $userSiswa = User::firstOrCreate(
            [
                'email' => 'siswa@demo.test'
            ],
            [
                'name' => 'Julian Sahbani',
                'password' => Hash::make('password')
            ]
        );
        $userSiswa->assignRole('siswa');

        Siswa::firstOrCreate(
            ['nisn' => '0051234567'],
            [
                'user_id' => $userSiswa->id,
                'nama' => 'Julian Sahbani',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2011-05-10',
                'status' => 'aktif',
            ]
        );
    }
}
