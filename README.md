# Mini SIAKAD - Proyek Akhir Pemrograman Web

**Nama:** SUNTA ADITYA PANGESTU
**NIM:** C030325051

## Controller yang Dibuat
| Controller | Jenis | Fungsi |
|---|---|---|
| `MahasiswaController` | Resource + Route Model Binding | CRUD mahasiswa (Eloquent) |
| `MatakuliahController` | Resource + Route Model Binding | CRUD mata kuliah (Eloquent) |
| `StatistikMahasiswaController` | Single action (invokable) | Statistik mahasiswa per prodi |
| `HitungTotalSksController` | Single action (invokable) | Total SKS seluruh mata kuliah |
| `Admin/DashboardController` | Sub-folder | Dashboard admin |
| `Laporan/RekapController` | Sub-folder | Rekap jumlah data |
| `Laporan/AkademikController` | Sub-folder | Laporan akademik (Query Builder) |
| `QueryBuilderDemoController` | Resource-like demo | Demo CRUD, filter, agregasi, join, pagination |
| `EloquentDemoController` | Demo | Perbandingan query log dengan dan tanpa eager loading |
| `SapaController`, `LatihanController` | Dasar | Praktikum 1 |

## Pembagian Query Builder dan Eloquent
**Query Builder (`DB::table()`):**
- `Laporan/AkademikController`: ringkasan, rekap per prodi, rekap per mata kuliah, peringkat (groupBy, join, agregasi)
- `QueryBuilderDemoController`: CRUD, filter, pagination (Praktikum 5)

**Eloquent:**
- `MahasiswaController` dan `MatakuliahController`: CRUD lengkap dengan validasi
- Relasi: `Mahasiswa hasMany NilaiMatakuliah`, `NilaiMatakuliah belongsTo Mahasiswa/Matakuliah`, `Matakuliah belongsTo User (dosen)`
- Accessor: `Mahasiswa::status`, `Mahasiswa::rata_nilai`
- Eager loading: `with('nilai')`, `load('nilai.matakuliah')`

## Bukti Perbandingan Query Log
| Halaman | Tanpa eager loading | Dengan eager loading |
|---|---|---|
| `/mahasiswa` (12 data) | 13 query (`?lazy=1`) | 2 query |
| `/demo/eager-loading` (10 data) | 11 query | 2 query |

(Lihat folder `screenshots/`.)

## Cara Menjalankan
```bash
composer install
cp .env.example .env
php artisan key:generate
# atur DB_DATABASE, DB_USERNAME, DB_PASSWORD di .env, lalu buat database kosong
php artisan migrate
php artisan db:seed
php artisan serve
```
Buka `http://127.0.0.1:8000`.
