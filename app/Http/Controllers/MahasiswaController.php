<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class MahasiswaController extends Controller
{
    private function aturan(?Mahasiswa $mahasiswa = null): array
    {
        return [
            'nim' => ['required', 'string', 'max:15', Rule::unique('mahasiswas', 'nim')->ignore($mahasiswa)],
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', Rule::unique('mahasiswas', 'email')->ignore($mahasiswa)],
            'prodi' => ['required', 'string', 'max:100'],
            'semester' => ['required', 'integer', 'between:1,14'],
        ];
    }

    public function index(Request $request)
    {
        DB::enableQueryLog();

        $lazy = $request->boolean('lazy');   // ?lazy=1 hanya untuk demonstrasi N+1

        $mahasiswa = Mahasiswa::query()
            ->when(!$lazy, fn($q) => $q->with('nilai'))   // eager loading
            ->orderBy('nama')
            ->get();

        return view('mahasiswa.index', compact('mahasiswa', 'lazy'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Mahasiswa::create($request->validate($this->aturan()));

        return redirect()->route('mahasiswa.index')->with('pesan', 'Data berhasil ditambahkan');
    }

    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('nilai.matakuliah');   // eager load relasi bertingkat
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa): RedirectResponse
    {
        $mahasiswa->update($request->validate($this->aturan($mahasiswa)));

        return redirect()->route('mahasiswa.index')->with('pesan', 'Data berhasil diperbarui');
    }

    public function destroy(Mahasiswa $mahasiswa): RedirectResponse
    {
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('pesan', 'Data berhasil dihapus');
    }
}