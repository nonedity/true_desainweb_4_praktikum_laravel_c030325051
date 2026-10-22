<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HitungTotalSksController;
use App\Http\Controllers\Laporan\RekapController;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\QueryBuilderDemoController;
use App\Http\Controllers\SapaController;
use App\Http\Controllers\StatistikMahasiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sapa-closure', function () {
    $nama = 'Ahmad Fauzi';
    $pesan = "Halo, {$nama}! Ini ditulis langsung di route.";
    return $pesan;
});

Route::get('/sapa-controller', [SapaController::class, 'index']);

Route::get('/latihan', [LatihanController::class, 'indeks']);

Route::resource('mahasiswa', MahasiswaController::class);
Route::post('/mahasiswa-uji', [MahasiswaController::class, 'store']);
Route::get('/mahasiswa-uji', function () {
    return view('mahasiswa.form-uji');
});

Route::get('/api-mahasiswa', [MahasiswaController::class, 'apiIndex']);

Route::get('/cari-mahasiswa', [MahasiswaController::class, 'cariMahasiswa']);
Route::get('/form-cari', function () {
    return view('mahasiswa.form-cari');
});

Route::get('/statistik', StatistikMahasiswaController::class);

Route::get('/admin/dashboard', [DashboardController::class, 'index']);

Route::resource('matakuliah', MatakuliahController::class);

Route::get('/total-sks', HitungTotalSksController::class);

Route::get('/laporan/rekap', [RekapController::class, 'index']);

Route::prefix('qb')->name('qb.')->controller(QueryBuilderDemoController::class)->group(function () {
    Route::get('/semua', 'tampilkanSemua')->name('semua');
    Route::get('/filter', 'tampilkanFilter')->name('filter');
    Route::get('/filter-lanjut', 'filterLanjut');
    Route::get('/agregasi', 'agregasi');
    Route::get('/prodi', 'statistikProdi')->name('prodi');
    Route::get('/join', 'join');
    Route::get('/halaman-json', 'halamanJson');

    Route::get('/crud', 'crud')->name('crud');
    Route::post('/crud', 'simpan')->name('crud.simpan');
    Route::put('/crud/{id}', 'ubah')->name('crud.ubah');
    Route::delete('/crud/{id}', 'hapus')->name('crud.hapus');

    Route::get('/tugas-1', 'tugasSatu');

    Route::get('/halaman', 'halaman');
});