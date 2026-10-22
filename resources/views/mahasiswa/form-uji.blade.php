<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Form Uji Mahasiswa</title>
</head>

<body>
    <h1>Form Uji Penerimaan Data</h1>
    <form action="/mahasiswa-uji" method="POST">
        @csrf
        <input type="text" name="nim" placeholder="NIM"><br>
        <input type="text" name="nama" placeholder="Nama"><br>
        <button type="submit">Kirim</button>
    </form>
</body>

</html>
