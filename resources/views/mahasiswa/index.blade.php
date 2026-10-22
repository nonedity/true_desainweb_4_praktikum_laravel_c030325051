<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Mahasiswa</title>
</head>

<body>
    <h1>Daftar Mahasiswa</h1>
    <ul>
        @foreach ($mahasiswa as $m)
            <li><a href="{{ route('mahasiswa.show', $m) }}">{{ $m->nim }} - {{ $m->nama }}</a></li>
        @endforeach
    </ul>
</body>

</html>
