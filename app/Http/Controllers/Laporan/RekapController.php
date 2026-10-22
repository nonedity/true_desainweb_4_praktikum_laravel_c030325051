<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;

class RekapController extends Controller
{
    public function index()
    {
        $jumlahMahasiswa = Mahasiswa::count();
        $jumlahMatakuliah = Matakuliah::count();

        return "Rekap: {$jumlahMahasiswa} mahasiswa, {$jumlahMatakuliah} mata kuliah.";
    }
}