<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AkademikController extends Controller
{
    public function index()
    {
        // Ringkasan umum
        $ringkasan = DB::table('mahasiswas')
            ->selectRaw('COUNT(*) as total_mahasiswa, COUNT(DISTINCT prodi) as total_prodi, ROUND(AVG(semester), 1) as rata_semester')
            ->first();

        $totalMk = DB::table('matakuliahs')->count();
        $totalSks = DB::table('matakuliahs')->sum('sks');

        // Rekap per prodi: jumlah mahasiswa dan rata-rata nilai (groupBy + leftJoin)
        $perProdi = DB::table('mahasiswas as m')
            ->leftJoin('nilai_matakuliahs as n', 'n.mahasiswa_id', '=', 'm.id')
            ->select(
                'm.prodi',
                DB::raw('COUNT(DISTINCT m.id) as jumlah_mahasiswa'),
                DB::raw('ROUND(AVG(n.nilai), 2) as rata_nilai')
            )
            ->groupBy('m.prodi')
            ->orderByDesc('jumlah_mahasiswa')
            ->get();

        // Rekap per mata kuliah: peserta dan rata-rata nilai
        $perMatakuliah = DB::table('matakuliahs as k')
            ->leftJoin('nilai_matakuliahs as n', 'n.matakuliah_id', '=', 'k.id')
            ->select(
                'k.kode_mk',
                'k.nama_mk',
                'k.sks',
                DB::raw('COUNT(n.id) as jumlah_peserta'),
                DB::raw('ROUND(AVG(n.nilai), 2) as rata_nilai')
            )
            ->groupBy('k.id', 'k.kode_mk', 'k.nama_mk', 'k.sks')
            ->orderBy('k.kode_mk')
            ->get();

        // 5 mahasiswa dengan rata-rata nilai terbobot SKS tertinggi (join tiga tabel)
        $peringkat = DB::table('mahasiswas as m')
            ->join('nilai_matakuliahs as n', 'n.mahasiswa_id', '=', 'm.id')
            ->join('matakuliahs as k', 'k.id', '=', 'n.matakuliah_id')
            ->select(
                'm.nim',
                'm.nama',
                'm.prodi',
                DB::raw('SUM(k.sks) as total_sks'),
                DB::raw('ROUND(SUM(n.nilai * k.sks) / SUM(k.sks), 2) as rata_terbobot')
            )
            ->groupBy('m.id', 'm.nim', 'm.nama', 'm.prodi')
            ->orderByDesc('rata_terbobot')
            ->limit(5)
            ->get();

        return view('laporan.akademik', compact(
            'ringkasan',
            'totalMk',
            'totalSks',
            'perProdi',
            'perMatakuliah',
            'peringkat'
        ));
    }
}