@extends('layouts.app')
@section('title', 'Daftar Mata Kuliah')
@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h3>Daftar Mata Kuliah</h3>
        <a href="{{ route('matakuliah.create') }}" class="btn btn-primary">+ Tambah</a>
    </div>
    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>Semester</th>
                <th>Dosen</th>
                <th width="220">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($matakuliah as $mk)
                <tr>
                    <td>{{ $mk->kode_mk }}</td>
                    <td>{{ $mk->nama_mk }}</td>
                    <td>{{ $mk->sks }}</td>
                    <td>{{ $mk->semester ?? '-' }}</td>
                    <td>{{ $mk->dosen->name ?? '-' }}</td>
                    <td>
                        <a href="{{ route('matakuliah.show', $mk) }}" class="btn btn-sm btn-info">Detail</a>
                        <a href="{{ route('matakuliah.edit', $mk) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('matakuliah.destroy', $mk) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Hapus mata kuliah ini?')">
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
