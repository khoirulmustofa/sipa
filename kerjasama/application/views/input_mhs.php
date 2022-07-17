<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post" action="<?php echo base_url() . 'hello/tambah_aksi'; ?>">
        <label for="npm">NPM Mahasiswa</label>
        <input type="text" name="npm"><br>
        <label for="nama_mhs">Nama Mahasiswa</label>
        <input type="text" name="nama_mhs"><br>
        <label for="jk_mhs">JK</label>
        <input type="text" name="jk_mhs"><br>
        <label for="tgl_lahir">Tgl Lahir</label>
        <input type="date" name="tgl_lahir"><br>
        <label for="alamats">Alamat</label>
        <input type="text" name="alamat"><br>
        <button type="submit">Simpan</button>
    </form>
</body>

</html>