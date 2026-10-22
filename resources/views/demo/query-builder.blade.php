<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>{{ $judul }}</title>
</head>

<body>
    <h1>{{ $judul }}</h1>
    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Prodi</th>
                <th>Semester</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $m)
                <tr>
                    <td>{{ $m->nim }}</td>
                    <td>{{ $m->nama }}</td>
                    <td>{{ $m->email ?? '-' }}</td>
                    <td>{{ $m->prodi }}</td>
                    <td>{{ $m->semester }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <p>Jumlah baris: {{ $data->count() }}</p>
</body>

</html>
