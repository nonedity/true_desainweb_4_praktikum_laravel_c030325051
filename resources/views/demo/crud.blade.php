<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>CRUD Query Builder</title>
</head>

<body>
    <h1>CRUD dengan Query Builder</h1>

    @if (session('pesan'))
        <p style="color:green">{{ session('pesan') }}</p>
    @endif

    @if ($errors->any())
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <h3>Tambah Data (INSERT)</h3>
    <form action="{{ route('qb.crud.simpan') }}" method="POST">
        @csrf
        <input type="text" name="nim" placeholder="NIM" value="{{ old('nim') }}">
        <input type="text" name="nama" placeholder="Nama" value="{{ old('nama') }}">
        <input type="email" name="email" placeholder="Email (opsional)" value="{{ old('email') }}">
        <input type="text" name="prodi" placeholder="Prodi" value="{{ old('prodi') }}">
        <input type="number" name="semester" placeholder="Semester" value="{{ old('semester') }}">
        <button type="submit">Simpan</button>
    </form>

    <h3>15 Data Terbaru</h3>
    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Semester (UPDATE)</th>
                <th>Hapus (DELETE)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $m)
                <tr>
                    <td>{{ $m->id }}</td>
                    <td>{{ $m->nim }}</td>
                    <td>{{ $m->nama }}</td>
                    <td>{{ $m->prodi }}</td>
                    <td>
                        <form action="{{ route('qb.crud.ubah', $m->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="number" name="semester" value="{{ $m->semester }}" style="width:60px">
                            <button type="submit">Ubah</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('qb.crud.hapus', $m->id) }}" method="POST"
                            onsubmit="return confirm('Hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
