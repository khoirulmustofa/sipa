<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-left: 0.01em solid #ccc;
            border-right: 0;
            border-top: 0.01em solid #ccc;
            border-bottom: 0;
            border-collapse: collapse;
        }

        table td,
        table th {
            border-left: 0;
            border-right: 0.01em solid #ccc;
            border-top: 0;
            border-bottom: 0.01em solid #ccc;
        }
    </style>
</head>

<body>
    <center>
        <h1>Table Kerja Sama Tridarma</h1>
    </center>
    <table id="myDatatables" class="table table-bordered table-head-bg-primary table-striped table-hover text-nowrap dataTable no-footer" cellspacing="0" width="100%" role="grid" aria-describedby="myDatatables_info">
        <thead>
            <tr role="row" style="height: 0px;">
                <th rowspan="2">
                    <div>No</div>
                </th>
                <th rowspan="2">
                    <div>Prodi</div>
                </th>
                <th rowspan="2">
                    <div>Lembaga Mitra</div>
                </th>
                <th colspan="3">
                    <div>Tingkatan</div>
                </th>
                <th rowspan="2">
                    <div>Judul Kerjasama</div>
                </th>
                <th rowspan="2">
                    <div>Manfaat Bagi PS yang Diakreditasi</div>
                </th>
                <th rowspan="2">
                    <div>Waktu dan Durasi</div>
                </th>
            </tr>
            <tr role="row" style="height: 0px;">
                <th>
                    <div>International</div>
                </th>
                <th>
                    <div>Nasional</div>
                </th>
                <th>
                    <div>Lokasi Wilayah</div>
                </th>
            </tr>
        </thead>

        <tbody>
            <?php
            $no = 1;
            foreach ($data_rekap as $key => $value) { ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $value->nama_prodi ?></td>
                    <td><?php echo str_replace("#", "<br>", $value->nama_lembaga_mitra) ?></td>
                    <td><?php echo $value->internasional ?></td>
                    <td><?php echo $value->nasional ?></td>
                    <td><?php echo $value->wilayah ?></td>
                    <td><?php echo $value->judul_kegiatan_ia ?></td>
                    <td><?php echo $value->manfaat_kegiatan_ia ?></td>
                    <td><?php echo tgl_indo($value->tanggal_awal_ia) . " - " . $value->selisih_hari . " Hari" ?></td>
                </tr>
            <?php } ?>


        </tbody>
    </table>
</body>

</html>