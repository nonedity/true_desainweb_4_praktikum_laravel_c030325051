<?php

use App\Http\Controllers\LatihanController;
use App\Http\Controllers\SapaController;
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