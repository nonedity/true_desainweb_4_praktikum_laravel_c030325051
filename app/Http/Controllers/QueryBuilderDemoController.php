<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryBuilderDemoController extends Controller
{
    // READ: seluruh data
    public function tampilkanSemua()
    {
        $judul = 'Semua Mahasiswa';
        $data = DB::table('mahasiswas')->get();

        return view('demo.query-builder', compact('data', 'judul'));
    }

    // READ + filter + urut
    public function tampilkanFilter()
    {
        $judul = 'Mahasiswa Semester >= 3 (urut nama)';
        $data = DB::table('mahasiswas')
            ->where('semester', '>=', 3)
            ->orderBy('nama')
            ->get();

        return view('demo.query-builder', compact('data', 'judul'));
    }

    // Variasi filtering (hasil ditampilkan sebagai daftar nama agar ringkas)
    public function filterLanjut(): JsonResponse
    {
        return response()->json([
            'semester_min_5' => DB::table('mahasiswas')->where('semester', '>=', 5)->pluck('nama'),
            'ti_atau_si' => DB::table('mahasiswas')
                ->where('prodi', 'Teknik Informatika')
                ->orWhere('prodi', 'Sistem Informasi')
                ->pluck('nama'),
            'semester_1_atau_2' => DB::table('mahasiswas')->whereIn('semester', ['1', '2'])->pluck('nama'),
            'semester_3_sampai_6' => DB::table('mahasiswas')->whereBetween('semester', ['3', '6'])->pluck('nama'),
            'email_kosong' => DB::table('mahasiswas')->whereNull('email')->pluck('nama'),
            'nama_mengandung_ahmad' => DB::table('mahasiswas')->whereLike('nama', '%Ahmad%')->pluck('nama'),
        ]);
    }

    // Pengurutan, pembatasan, agregasi
    public function agregasi(): JsonResponse
    {
        return response()->json([
            'nama_a_z' => DB::table('mahasiswas')->orderBy('nama', 'asc')->pluck('nama'),
            'semester_tertinggi_5' => DB::table('mahasiswas')
                ->orderBy('semester', 'desc')->limit(5)
                ->get(['nama', 'semester']),
            'total' => DB::table('mahasiswas')->count(),
            'semester_max' => DB::table('mahasiswas')->max('semester'),
            'semester_rata2' => DB::table('mahasiswas')->avg('semester'),
        ]);
    }

    // groupBy
    public function statistikProdi()
    {
        $rekap = DB::table('mahasiswas')
            ->select('prodi', DB::raw('count(*) as jumlah'))
            ->groupBy('prodi')
            ->get();

        return view('demo.statistik-prodi', compact('rekap'));
    }

    // Join
    public function join(): JsonResponse
    {
        return response()->json([
            'dua_tabel' => DB::table('nilai_matakuliahs')
                ->join('mahasiswas', 'nilai_matakuliahs.mahasiswa_id', '=', 'mahasiswas.id')
                ->select('mahasiswas.nama', 'nilai_matakuliahs.nilai')
                ->limit(5)
                ->get(),
            'tiga_tabel_nilai_tertinggi' => DB::table('nilai_matakuliahs')
                ->join('mahasiswas', 'nilai_matakuliahs.mahasiswa_id', '=', 'mahasiswas.id')
                ->join('matakuliahs', 'nilai_matakuliahs.matakuliah_id', '=', 'matakuliahs.id')
                ->select('mahasiswas.nama', 'matakuliahs.nama_mk', 'nilai_matakuliahs.nilai')
                ->orderByDesc('nilai_matakuliahs.nilai')
                ->limit(5)
                ->get(),
        ]);
    }

    // Pagination (versi JSON agar terlihat struktur datanya)
    public function halamanJson(): JsonResponse
    {
        return response()->json(DB::table('mahasiswas')->orderBy('id')->paginate(5));
    }

    // CRUD: tampilkan form + daftar
    public function crud()
    {
        $data = DB::table('mahasiswas')->orderByDesc('id')->limit(15)->get();

        return view('demo.crud', compact('data'));
    }

    // CREATE
    public function simpan(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nim' => ['required', 'string', 'max:15', 'unique:mahasiswas,nim'],
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', 'unique:mahasiswas,email'],
            'prodi' => ['required', 'string', 'max:100'],
            'semester' => ['required', 'integer', 'between:1,14'],
        ]);

        DB::table('mahasiswas')->insert($validated + [
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('qb.crud')->with('pesan', 'Data berhasil ditambahkan (INSERT).');
    }

    // UPDATE
    public function ubah(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'semester' => ['required', 'integer', 'between:1,14'],
        ]);

        DB::table('mahasiswas')->where('id', $id)->update($validated + ['updated_at' => now()]);

        return redirect()->route('qb.crud')->with('pesan', "Semester id {$id} diperbarui (UPDATE).");
    }

    // DELETE
    public function hapus(int $id): RedirectResponse
    {
        DB::table('mahasiswas')->where('id', $id)->delete();

        return redirect()->route('qb.crud')->with('pesan', "Data id {$id} dihapus (DELETE).");
    }

    public function tugasSatu()
    {
        $judul = 'TI, Semester 3-6, urut nama';
        $data = DB::table('mahasiswas')
            ->where('prodi', 'Teknik Informatika')
            ->whereBetween('semester', [3, 6])
            ->orderBy('nama', 'asc')
            ->get();

        return view('demo.query-builder', compact('data', 'judul'));
    }

    public function halaman()
    {
        $data = DB::table('mahasiswas')->orderBy('id')->paginate(10);

        return view('demo.halaman', compact('data'));
    }
}