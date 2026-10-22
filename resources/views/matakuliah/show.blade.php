@extends('layouts.app')
@section('title', 'Detail Mata Kuliah')
@section('content')
    <h3>{{ $matakuliah->nama_mk }} <small class="text-muted">({{ $matakuliah->kode_mk }})</small></h3>
    <p>{{ $matakuliah->sks }} SKS · Dosen: {{ $matakuliah->dosen->name ?? '-' }}</p>

    <h5>Mahasiswa yang Mengambil ({{ $matakuliah->nilai->count() }})</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($matakuliah->nilai as $n)
                <tr>
                    <td>{{ $n->mahasiswa->nim }}</td>
                    <td>{{ $n->mahasiswa->nama }}</td>
                    <td>{{ $n->nilai }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Belum ada mahasiswa.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">Kembali</a>
@endsection
