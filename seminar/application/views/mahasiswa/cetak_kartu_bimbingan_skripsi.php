<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kartu Bimbingan</title>
  <style>  
  #table2 {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    border: 1px solid #ddd;
    font-size: 10;
  }

  #table2 td, #table2 th {
    border: 1px solid #ddd;
    padding: 8px;
    font-size: 10;
  }

  /*#table2 tr:nth-child(even){background-color: #f2f2f2;}*/

  #table2 tr:hover {background-color: #ddd;}

  #table2 th {
    padding-top: 10px;
    padding-bottom: 10px;
    text-align: center;
    background-color: #4CAF50;
    color: white;
  }

  #table2 td {
    padding-top: 10px;
    padding-bottom: 10px;
    text-align: left;
    /*background-color: #4CAF50;*/
    /*color: white;*/
  }





  #table {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }



  #table td, #table th {
    border: 1px solid #ddd;
    padding: 8px;
    font-size: 10;
  }

  #table tr:nth-child(even){background-color: #f2f2f2;}

  #table tr:hover {background-color: #ddd;}

  #table th {
    padding-top: 10px;
    padding-bottom: 10px;
    text-align: center;
    background-color: #4CAF50;
    color: white;
  }

  #table td {
    padding-top: 10px;
    padding-bottom: 10px;
    text-align: center;
    /*background-color: #4CAF50;*/
    /*color: white;*/
  }
  .img-center {
    display: block;
    margin-left: auto;
    margin-right: auto;
    /*margin-bottom: 20px;*/
    width: 100%;
  }

  #textkecil {
    font-size: 7px;
    color: blue;
  }
</style>
</head>
<body>

  <?php
  if($id_skripsi!=null){
    $row = $this->m_bimbingan_skripsi->get_row_data_bimbingan($id_skripsi);
    if ($row) {

      $nama_mahasiswa     = $row->nama_mahasiswa;
      $id_skripsi         = $row->id_skripsi;
      $nama_dosen         = $row->nama_dosen;
      $jabatan_fungsional = $row->jabatan_fungsional;
      $npm                = $row->npm;
      $nama_prodi         = $row->nama_prodi;
      $nama_lengkap       = $row->nama_lengkap;
      $judul              = $row->judul;
      $waktu_input_ttd    = $row->waktu_input_ttd;

      ?>
      <div style="padding: 5;">
        <img src="<?php echo base_url('assets/img/kop_kartu_bimbingan.png') ?>" width="100%"><hr>
      </div>

      <p align="center"><b>FORMULIR BIMBINGAN KERJA PRAKTEK</b></p>


            <table border="0" id="table2">
              <tr>
                <td width="100">Nama Mahasiswa</td>
                <td width="5">:</td>
                <td><?= ucwords($nama_mahasiswa); ?></td>
              </tr>
              <tr>
                <td>Dosen Pembimbing</td>
                <td>:</td>
                <td><?= $nama_dosen ?></td>
              </tr>
              <tr>
                <td>NPM</td>
                <td>:</td>
                <td><?= $npm ?></td>
              </tr>
              <tr>
                <td>Program Studi</td>
                <td>:</td>
                <td><?= $nama_prodi ?></td>
              </tr>
              <tr>
                <td style="vertical-align: top; text-align: left;">Judul Skripsi</td>
                <td style="vertical-align: top; text-align: left;">:</td>
                <td align="justify"><?= $judul ?></td>
              </tr>
            </table><br>
            <table id="table2"style="border-style: solid; border-color: #ddd;" >

            </table>

            <table border="1" cellpadding="1" cellspacing="0" width="100%" id="table">
              <thead>
                <tr>
                  <td align="center"><b>No</b></td>
                  <td align="center" width="100"><b>Hari/ Tanggal Bimbingan</b></td>
                  <td align="center"width="130"><b>Materi Bimbingan</b></td>
                  <td align="center"width="130"><b>Hasil/ Saran Bimbingan</b></td>
                  <td align="center" width="100"><b>Paraf Dosen Pembimbing</b></td>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no= 1;
                foreach ($this->m_bimbingan_skripsi->getDataBimbingan($id_skripsi) as $key) {

                  ?>
                  <tr>
                    <td align="center"><?php echo $no++ ?></td>
                    <td align="center"><?= $this->m_bimbingan_skripsi->format_tanggal(date('Y-m-d', strtotime($key['waktu_input_ttd']))); ?></td>
                    <td align="center"><?= $key['materi_bimbingan'] ?></td>
                    <td align="center"><?= $key['hasil_bimbingan'] ?></td>
                    <td align="center">
                      <?php 
                      QRcode::png(site_url("/Validasi_ttd_digital/cek/".$key['id_random']),"templates/img/qrcode/barcode_kartu_bimbingan_".$key['id_random'].".png");
                      ?>
                      <img src="<?php echo base_url("templates/img/qrcode/barcode_kartu_bimbingan_".$key['id_random'].".png") ?>" style="width: 50px"><br><i class="text-success"><?= $key['nama_penanda_tangan'] ?></i><br>

                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
          <br>
          <table id="table2">

            <tr>     
             <td></td>
             <td width="50%">
               <?php
               if (isset($id_skripsi)) {
                $cekValidasi = $this->m_monitoring_skripsi->cekTtdProdi($id_skripsi);
                if($cekValidasi>0){
                  ?> 
                  Pekanbaru, <?= $this->m_monitoring_skripsi->format_tanggal(date('Y-m-d', strtotime($key['waktu_input_ttd']))); ?><br>Ketua Program Studi <?= $nama_prodi ?><br>
                  <?php 
                  $id_random_prodi = $this->m_bimbingan_skripsi->getIdRandom($id_skripsi, 'Tandatangan kartu bimbingan Skripsi oleh Prodi');
                  QRcode::png(site_url("/Validasi_ttd_digital/cek_prodi/").$id_random_prodi,"templates/img/qrcode/barcode_prodi".$id_random_prodi.".png");
                  ?>
                  <img src="<?php echo base_url("templates/img/qrcode/barcode_prodi".$id_random_prodi.".png") ?>" width="100px"><br>
                  <u><b><?= $nama_lengkap ?></b></u><br>
                  <?php
                } else {
                  echo '';
                }              
              } else{
                echo '';
              }
              ?>
            </td>    
          </tr>
        </table>

        <?php
      }else{
        echo '<div class="text-warning"><h1>Maaf, Tidak ditemukan data yang valid!</h1></div>';
      }
    }else{
      echo '<div class="text-warning"><h1>Maaf, Tidak ditemukan data yang valid!</h1></div>';
    }

    ?>

  </body>
  </html>