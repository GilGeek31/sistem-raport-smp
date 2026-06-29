# Sistem Pengelolaan Nilai Raport Siswa (SMP Kelas 7-9)

> Sistem informasi berbasis web untuk mengelola nilai raport siswa, mendukung Kurikulum Merdeka, dengan fitur input nilai per semester, cetak raport otomatis, dan leger kelas.

<!--
TODO: Tambahkan badge di sini setelah CI/CD & demo siap, contoh:
![Build Status](https://github.com/username/sistem-raport/workflows/tests/badge.svg)
![License](https://img.shields.io/badge/license-MIT-blue)
-->

🔗 **[Live Demo](#)** &nbsp;|&nbsp; 🎥 **[Video Walkthrough](#)** &nbsp;|&nbsp; 📄 **[Dokumentasi API](#)**

<!-- TODO: ganti tanda # di atas dengan link asli setelah deploy -->

---

## Daftar Isi

- [Latar Belakang & Masalah](#latar-belakang--masalah)
- [Fitur Utama](#fitur-utama)
- [Tech Stack](#tech-stack)
- [Arsitektur & Desain Database](#arsitektur--desain-database)
- [Tantangan Teknis & Solusi](#tantangan-teknis--solusi)
- [Screenshot](#screenshot)
- [Instalasi](#instalasi)
- [Menjalankan Test](#menjalankan-test)
- [Role & Hak Akses](#role--hak-akses)
- [Roadmap](#roadmap)
- [Struktur Folder](#struktur-folder)
- [Lisensi](#lisensi)
- [Kontak](#kontak)

---

## Latar Belakang & Masalah

<!--
TODO: Tulis 2-4 kalimat tentang masalah nyata yang melatari proyek ini.
Contoh kerangka:
- Proses apa yang sebelumnya manual? (misal: rekap nilai pakai Excel terpisah per guru)
- Apa risikonya? (salah hitung rata-rata, raport telat cetak, data hilang saat pergantian guru)
- Siapa yang terdampak? (wali kelas, kepala sekolah, orang tua)

Contoh isi:
"Di [nama sekolah], proses rekap nilai raport sebelumnya dilakukan manual oleh
masing-masing guru mata pelajaran menggunakan spreadsheet terpisah, kemudian
digabung manual oleh wali kelas menjelang pembagian raport. Proses ini rawan
human error pada penghitungan rata-rata, sulit dilacak riwayatnya, dan
memakan waktu 3-5 hari kerja setiap akhir semester. Sistem ini dibangun untuk
mengotomasi proses tersebut sekaligus menyediakan riwayat nilai siswa yang
konsisten dari kelas 7 hingga 9."
-->

## Fitur Utama

- ✅ Input nilai akhir semester per mata pelajaran (dengan validasi hak akses guru per mapel)
- ✅ Generate deskripsi capaian kompetensi otomatis (template per rentang nilai, Kurikulum Merdeka)
- ✅ Cetak raport per siswa dalam format PDF
- ✅ Leger nilai per kelas (rekap seluruh siswa & mapel dalam satu kelas)
- ✅ Manajemen data master: siswa, guru, mata pelajaran, kelas, tahun ajaran
- ✅ Perhitungan otomatis rata-rata nilai per siswa per semester
- ✅ Role-based access control (Admin, Guru Mapel, Wali Kelas, Kepala Sekolah)
- ✅ Riwayat kelas siswa antar tahun ajaran (kenaikan kelas terlacak)
    <!-- TODO: tambah/hapus baris sesuai fitur yang benar-benar selesai diimplementasikan -->

## Tech Stack

| Layer         | Teknologi                          | Alasan Pemilihan                                                           |
| ------------- | ---------------------------------- | -------------------------------------------------------------------------- |
| Backend       | Laravel 11 (PHP 8.2+)              | Ekosistem matang, built-in auth & validation, cocok untuk CRUD-heavy app   |
| Database      | MySQL 8                            | Relasional, cocok untuk data terstruktur dengan banyak relasi antar tabel  |
| Frontend      | Blade + Tailwind CSS               | Server-rendered, ringan, tidak perlu API terpisah untuk skala satu sekolah |
| Auth & Role   | Laravel Breeze + Spatie Permission | Role-based access control yang battle-tested                               |
| PDF Generator | barryvdh/laravel-dompdf            | Generate raport langsung dari template Blade                               |
| Testing       | Pest / PHPUnit                     | <!-- TODO: pilih salah satu, hapus yang tidak dipakai -->                  |

<!--
TODO: Jika menambah fitur lain (queue untuk notifikasi, Excel export, dsb),
tambahkan baris baru di tabel ini dengan alasannya. Reviewer portofolio
sangat menghargai *alasan* di balik pilihan teknis, bukan cuma daftar nama tools.
-->

## Arsitektur & Desain Database

<!--
TODO: Tempel/screenshot ER Diagram di sini.
Jelaskan singkat keputusan desain non-trivial, contoh:
- Kenapa riwayat kelas dipisah dari tabel siswa (untuk melacak histori kenaikan kelas)
- Kenapa ada tabel pivot guru_mapel (untuk membatasi guru hanya input nilai mapel yang diampu)
-->

```
[Sisipkan gambar ERD di sini, contoh: ![ERD](docs/erd.png)]
```

**Keputusan desain penting:**

1. **Riwayat kelas terpisah dari data siswa** — siswa pindah kelas setiap tahun ajaran, sehingga riwayat ditampung di tabel tersendiri agar raport tahun-tahun sebelumnya tetap akurat meski siswa sudah naik kelas.
2. **Tabel pivot guru-mapel-kelas** — menjadi basis otorisasi: guru hanya bisa menginput nilai untuk mapel dan kelas yang benar-benar diampu, dicek lewat Policy class.
 <!-- TODO: tambahkan keputusan desain lain yang relevan -->

## Tantangan Teknis & Solusi

<!--
TODO: Ini bagian yang PALING dihargai reviewer/interviewer. Tulis 2-4 studi kasus
nyata yang kamu temui selama development. Format STAR (Situation-Task-Action-Result)
bekerja baik di sini. Contoh kerangka:

### Studi Kasus 1: [Nama masalah]
**Masalah:** ...
**Solusi:** ...
**Hasil:** ...

Contoh isi nyata (edit sesuai pengalaman kamu):

### Studi Kasus 1: Mencegah duplikasi input nilai
**Masalah:** Guru bisa input nilai dobel untuk siswa, mapel, dan semester yang sama
tanpa sadar, menyebabkan data tidak konsisten di leger.
**Solusi:** Menambahkan unique constraint composite (siswa_id, mapel_id, semester,
tahun_ajaran_id) di level database, dikombinasikan dengan validasi di Form Request
agar pesan error informatif (bukan generic 500 error).
**Hasil:** Tidak ada lagi data nilai ganda; UX juga lebih baik karena guru langsung
diarahkan ke mode edit jika nilai sudah pernah diinput.

### Studi Kasus 2: [isi sesuai pengalamanmu]
...
-->

## Screenshot

<!--
TODO: Tambahkan screenshot/GIF dari fitur-fitur utama. Urutan yang disarankan:
1. Dashboard (per role berbeda jika ada)
2. Form input nilai
3. Tampilan leger kelas
4. Hasil cetak raport PDF
-->

| Dashboard Admin                              | Input Nilai                                      |
| -------------------------------------------- | ------------------------------------------------ |
| ![dashboard](docs/screenshots/dashboard.png) | ![input-nilai](docs/screenshots/input-nilai.png) |

| Leger Kelas                          | Raport PDF                             |
| ------------------------------------ | -------------------------------------- |
| ![leger](docs/screenshots/leger.png) | ![raport](docs/screenshots/raport.png) |

## Instalasi

```bash
# 1. Clone repository
git clone https://github.com/USERNAME/sistem-raport.git
cd sistem-raport

# 2. Install dependencies
composer install
npm install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Konfigurasi database di .env, lalu jalankan migrasi + seeder
php artisan migrate --seed

# 5. Build asset frontend
npm run build

# 6. Jalankan server lokal
php artisan serve
```

Akses aplikasi di `http://127.0.0.1:8000`.

**Akun demo (dari seeder):**

| Role       | Email               | Password      |
| ---------- | ------------------- | ------------- |
| Admin      | admin@demo.test     | <!-- TODO --> |
| Guru       | guru@demo.test      | <!-- TODO --> |
| Wali Kelas | walikelas@demo.test | <!-- TODO --> |

<!-- TODO: pastikan seeder benar-benar membuat akun ini sebelum publish -->

## Menjalankan Test

```bash
php artisan test
```

<!--
TODO: Setelah test ditulis, jelaskan singkat apa yang di-cover, misal:
"Test mencakup: validasi rentang nilai (0-100), perhitungan rata-rata,
otorisasi guru per mapel, dan generate PDF raport."
-->

## Role & Hak Akses

| Role           | Hak Akses                                                                             |
| -------------- | ------------------------------------------------------------------------------------- |
| Admin          | Kelola seluruh data master (siswa, guru, mapel, kelas, tahun ajaran), kelola pengguna |
| Guru Mapel     | Input & edit nilai untuk mapel dan kelas yang diampu saja                             |
| Wali Kelas     | Lihat leger kelas yang diampu, cetak raport, input nilai sikap                        |
| Kepala Sekolah | Lihat seluruh laporan (read-only), approve/tanda tangan digital raport                |

## Roadmap

- [ ] Export rekap nilai ke Excel
- [ ] Notifikasi email otomatis ke wali kelas saat semua nilai mapel sudah lengkap
- [ ] Modul nilai P5 (Projek Penguatan Profil Pelajar Pancasila)
- [ ] API REST untuk akses orang tua/siswa (read-only)
  <!-- TODO: sesuaikan dengan rencana pengembangan lanjutan -->

## Struktur Folder

```
app/
├── Http/Controllers/   # Menerima request, delegasikan ke Service
├── Models/             # Siswa, Guru, Mapel, Kelas, Nilai, dst.
├── Services/           # Logika bisnis (hitung rata-rata, validasi akses)
├── Policies/           # Otorisasi per role/resource
└── Exports/            # Generator PDF/Excel
routes/
└── web.php             # Route dikelompokkan per role dengan middleware
database/
├── migrations/         # Skema tabel
└── seeders/            # Data dummy untuk testing & demo
```

## Lisensi

<!-- TODO: pilih lisensi, contoh MIT jika ingin proyek ini open-source di portofolio -->

Proyek ini menggunakan lisensi [MIT](LICENSE).

## Kontak

<!-- TODO: isi dengan info kontak kamu -->

Dibuat oleh **[Nama Kamu]** — [LinkedIn](#) · [Email](#) · [Portofolio](#)
