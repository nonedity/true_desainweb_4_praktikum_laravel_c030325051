@extends('layouts.app')
@section('title', 'Detail Mahasiswa')
@section('content')
    <h3>{{ $mahasiswa->nama }} <small class="text-muted">({{ $mahasiswa->nim }})</small></h3>
    <p>{{ $mahasiswa->prodi }} · Semester {{ $mahasiswa->semester }} · {{ $mahasiswa->status }}</p>

    <h5>Daftar Nilai</h5>
    @forelse ($mahasiswa->nilai as $n)
        <p>{{ $n->matakuliah->nama_mk ?? '-' }}: {{ $n->nilai }}</p>
    @empty
        <p>Belum ada data nilai.</p>
    @endforelse

    <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
@endsection
