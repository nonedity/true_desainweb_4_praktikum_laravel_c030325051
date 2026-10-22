@extends('layouts.app')
@section('title', 'Daftar Mahasiswa')
@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h3>Daftar Mahasiswa</h3>
        <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">+ Tambah</a>
    </div>

    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Semester</th>
                <th>Status</th>
                <th width="220">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mahasiswa as $m)
                <tr>
                    <td>{{ $m->nim }}</td>
                    <td>{{ $m->nama }}</td>
                    <td>{{ $m->prodi }}</td>
                    <td>{{ $m->semester }}</td>
                    <td>{{ $m->status }}</td>
                    <td>
                        <a href="{{ route('mahasiswa.show', $m) }}" class="btn btn-sm btn-info">Detail</a>
                        <a href="{{ route('mahasiswa.edit', $m) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('mahasiswa.destroy', $m) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
