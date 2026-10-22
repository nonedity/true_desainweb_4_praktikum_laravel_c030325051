<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Statistik per Prodi</title>
</head>

<body>
    <h1>Jumlah Mahasiswa per Program Studi</h1>
    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>Prodi</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rekap as $r)
                <tr>
                    <td>{{ $r->prodi }}</td>
                    <td>{{ $r->jumlah }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
