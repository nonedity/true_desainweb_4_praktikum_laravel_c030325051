<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SIAKAD Mini')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<div class="navbar-nav flex-row gap-3">
    <a class="nav-link" href="{{ route('mahasiswa.index') }}">Mahasiswa</a>
    <a class="nav-link" href="{{ route('matakuliah.index') }}">Mata Kuliah</a>
    <a class="nav-link" href="{{ url('/laporan') }}">Laporan</a>
    <a class="nav-link" href="{{ url('/demo/eager-loading') }}">Query Log</a>
</div>
<div class="container">
    @if (session('pesan'))
        <div class="alert alert-success">{{ session('pesan') }}</div>
    @endif
    @yield('content')
</div>
</body>

</html>
