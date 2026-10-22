@extends('layouts.app')
@section('title', 'Laporan Akademik')
@section('content')
    <h3 class="mb-3">Laporan Akademik <small class="text-muted fs-6">(dibangun dengan Query Builder)</small></h3>

    <div class="row text-center mb-4">
        @foreach ([
            'Total Mahasiswa' => $ringkasan->total_mahasiswa,
            'Program Studi' => $ringkasan->total_prodi,
            'Mata Kuliah' => $totalMk,
            'Total SKS' => $totalSks,
            'Rata-rata Semester' => $ringkasan->rata_semester,
        ] as $label => $nilai)
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="fs-3 fw-bold">{{ $nilai }}</div>
                        <div class="text-muted small">{{ $label }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <h5>Rekap per Program Studi</h5>
    <table class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Prodi</th>
                <th>Jumlah Mahasiswa</th>
                <th>Rata-rata Nilai</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($perProdi as $r)
                <tr>
                    <td>{{ $r->prodi }}</td>
                    <td>{{ $r->jumlah_mahasiswa }}</td>
                    <td>{{ $r->rata_nilai ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Belum ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h5>Rekap per Mata Kuliah</h5>
    <table class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>Peserta</th>
                <th>Rata-rata Nilai</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($perMatakuliah as $r)
                <tr>
                    <td>{{ $r->kode_mk }}</td>
                    <td>{{ $r->nama_mk }}</td>
                    <td>{{ $r->sks }}</td>
                    <td>{{ $r->jumlah_peserta }}</td>
                    <td>{{ $r->rata_nilai ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h5>5 Mahasiswa Terbaik (rata-rata nilai terbobot SKS)</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Total SKS</th>
                <th>Rata-rata</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peringkat as $i => $r)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $r->nim }}</td>
                    <td>{{ $r->nama }}</td>
                    <td>{{ $r->prodi }}</td>
                    <td>{{ $r->total_sks }}</td>
                    <td>{{ $r->rata_terbobot }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
