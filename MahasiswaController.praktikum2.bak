<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function store(Request $request)
    {
        $nama = $request->input('nama');
        $nim = $request->input('nim');

        return "Data yang diterima -> NIM: " . e($nim) . ", Nama: " . e($nama);
    }

    public function apiIndex()
    {
        return response()->json([
            'status' => 'sukses',
            'pesan' => 'Ini contoh response JSON dari Controller',
        ]);
    }

    public function cariMahasiswa(Request $request)
    {
        $nama = $request->query('nama');

        return "Anda mencari mahasiswa dengan kata kunci: " . e($nama);
    }
}
