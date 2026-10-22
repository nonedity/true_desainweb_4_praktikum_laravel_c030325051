<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\EloquentDemoController;
use App\Http\Controllers\HitungTotalSksController;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\Laporan\AkademikController;
use App\Http\Controllers\Laporan\RekapController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\QueryBuilderDemoController;
use App\Http\Controllers\SapaController;
use App\Http\Controllers\StatistikMahasiswaController;
use Illuminate\Support\Facades\Route;

/* ---------- Aplikasi utama (SIAKAD mini) ---------- */
Route::redirect('/', '/mahasiswa');

Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('matakuliah', MatakuliahController::class);

Route::get('/laporan', [AkademikController::class, 'index'])->name('laporan.akademik');   // Query Builder
Route::get('/laporan/rekap', [RekapController::class, 'index']);
Route::get('/statistik', StatistikMahasiswaController::class);                            // invokable
Route::get('/total-sks', HitungTotalSksController::class);                                // invokable
Route::get('/admin/dashboard', [DashboardController::class, 'index']);                    // sub-folder Admin

/* ---------- Bahan praktikum ---------- */
Route::get('/sapa-closure', function () {
    $nama = 'Ahmad Fauzi';
    return "Halo, {$nama}! Ini ditulis langsung di route.";
});
Route::get('/sapa-controller', [SapaController::class, 'index']);
Route::get('/perkenalan', [LatihanController::class, 'index']);

Route::get('/demo/eager-loading', [EloquentDemoController::class, 'bandingkan']);

Route::prefix('qb')->name('qb.')->controller(QueryBuilderDemoController::class)->group(function () {
    Route::get('/semua', 'tampilkanSemua')->name('semua');
    Route::get('/filter', 'tampilkanFilter')->name('filter');
    Route::get('/filter-lanjut', 'filterLanjut');
    Route::get('/agregasi', 'agregasi');
    Route::get('/prodi', 'statistikProdi')->name('prodi');
    Route::get('/join', 'join');
    Route::get('/halaman-json', 'halamanJson');
    Route::get('/tugas-1', 'tugasSatu');
    Route::get('/halaman', 'halaman');

    Route::get('/crud', 'crud')->name('crud');
    Route::post('/crud', 'simpan')->name('crud.simpan');
    Route::put('/crud/{id}', 'ubah')->name('crud.ubah');
    Route::delete('/crud/{id}', 'hapus')->name('crud.hapus');
});