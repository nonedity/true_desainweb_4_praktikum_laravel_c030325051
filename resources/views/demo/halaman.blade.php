<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Pagination Query Builder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container py-4">
    <h1>Daftar Mahasiswa (10 per halaman)</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Semester</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $m)
                <tr>
                    <td>{{ $m->nim }}</td>
                    <td>{{ $m->nama }}</td>
                    <td>{{ $m->prodi }}</td>
                    <td>{{ $m->semester }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $data->links() }}
</body>

</html>
