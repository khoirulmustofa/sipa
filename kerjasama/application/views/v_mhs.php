<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table border="1">
        <tr>
            <td>NPM</td>
            <td>NAMA</td>
            <td>JENIS KELAMIN</td>
            <td>TANGGAL LAHIR</td>
            <td>ALAMAT</td>
            <td>Aksi</td>
        </tr>
        <?php foreach ($mahasiswa as $mhs) : ?>
            <tr>
                <td><?php echo $mhs->npm; ?></td>
                <td><?php echo $mhs->nama_mhs; ?></td>
                <td><?php echo $mhs->jk_mhs; ?></td>
                <td><?php echo $mhs->tgl_lahir; ?></td>
                <td><?php echo $mhs->alamat; ?></td>
                <td>
                    <form action="<?php site_url('hello/hapus') ?>" method="post">
                        <input type="hidden" value="<?php $mhs->npm ?>">
                        <button>
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
    <a href="<?php echo base_url() . 'hello/tambah' ?>">Tambah Data</a>
</body>

</html>