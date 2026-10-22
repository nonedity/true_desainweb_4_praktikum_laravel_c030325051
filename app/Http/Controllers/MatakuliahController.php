<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MatakuliahController extends Controller
{
    private function aturan(?Matakuliah $matakuliah = null): array
    {
        return [
            'kode_mk' => ['required', 'string', 'max:10', Rule::unique('matakuliahs', 'kode_mk')->ignore($matakuliah)],
            'nama_mk' => ['required', 'string', 'max:255'],
            'sks' => ['required', 'integer', 'between:1,6'],
            'semester' => ['nullable', 'integer', 'between:1,14'],
            'dosen_id' => ['nullable', 'exists:users,id'],
        ];
    }

    public function index()
    {
        $matakuliah = Matakuliah::with('dosen')->orderBy('kode_mk')->get();
        return view('matakuliah.index', compact('matakuliah'));
    }

    public function create()
    {
        $dosens = User::orderBy('name')->get(['id', 'name']);
        return view('matakuliah.create', compact('dosens'));
    }

    public function store(Request $request): RedirectResponse
    {
        Matakuliah::create($request->validate($this->aturan()));
        return redirect()->route('matakuliah.index')->with('pesan', 'Mata kuliah berhasil ditambahkan');
    }

    public function show(Matakuliah $matakuliah)
    {
        $matakuliah->load('dosen', 'nilai.mahasiswa');
        return view('matakuliah.show', compact('matakuliah'));
    }

    public function edit(Matakuliah $matakuliah)
    {
        $dosens = User::orderBy('name')->get(['id', 'name']);
        return view('matakuliah.edit', compact('matakuliah', 'dosens'));
    }

    public function update(Request $request, Matakuliah $matakuliah): RedirectResponse
    {
        $matakuliah->update($request->validate($this->aturan($matakuliah)));
        return redirect()->route('matakuliah.index')->with('pesan', 'Mata kuliah berhasil diperbarui');
    }

    public function destroy(Matakuliah $matakuliah): RedirectResponse
    {
        $matakuliah->delete();
        return redirect()->route('matakuliah.index')->with('pesan', 'Mata kuliah berhasil dihapus');
    }
}