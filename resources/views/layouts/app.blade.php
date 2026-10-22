<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SIAKAD Mini')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('mahasiswa.index') }}">SIAKAD Mini</a>
            <div class="navbar-nav flex-row gap-3">
                <a class="nav-link" href="{{ route('mahasiswa.index') }}">Mahasiswa</a>
                <a class="nav-link" href="{{ route('matakuliah.index') }}">Mata Kuliah</a>
            </div>
        </div>
    </nav>
    <div class="container">
        @if (session('pesan'))
            <div class="alert alert-success">{{ session('pesan') }}</div>
        @endif
        @yield('content')
    </div>
</body>

</html>
