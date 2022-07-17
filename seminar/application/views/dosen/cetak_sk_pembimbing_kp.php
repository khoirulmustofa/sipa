<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SK Pembimbing KP</title>
  <style>  </style>
</head>
<body>

  <?php
  if($id_syarat_sk!=null){
    $row = $this->m_sk->get_row_data_syarat_sk($id_syarat_sk);
    if ($row) {
      $nomor_surat            = $row->nomor_surat;
      $tahun                  = $row->tahun;
      $kodemax                = str_pad(($nomor_surat), 4, "0", STR_PAD_LEFT);
      $nomor_surat_full       = ($kodemax).'/KPTS/FT-UIR/KP/'.$tahun;
      $nama_mahasiswa         = $row->nama_mahasiswa;
      $nama_penanda_tangan    = $row->nama_penanda_tangan;
      $npk_penanda_tangan     = $row->npk_penanda_tangan;
      $nama_dosen             = $row->nama_dosen;
      $jabatan_fungsional     = $row->jabatan_fungsional;
      $jabatan_penanda_tangan = $row->jabatan_penanda_tangan;
      $npm                    = $row->npm;
      $nama_prodi             = $row->nama_prodi;
      $judul_kerja_praktik    = $row->judul_kerja_praktik;
      $waktu_input_ttd        = $row->waktu_input_ttd;
      $id_random              = $row->id_random;

      ?>
      <div style="padding: 5;">
        <p align="center">SURAT KEPUTUSAN DEKAN FAKULTAS TEKNIK UNIVERSITAS ISLAM RIAU <br> NOMOR : <?= $nomor_surat_full ?>
          <BR>TENTANG PENGANGKATAN TIM PEMBIMBING KERJA PRAKTEK</p>
            <hr>
            <p align="center"><b>DEKAN FAKULTAS TEKNIK</b></p>
          </div>
          <table border="0" cellpadding="1">
            <tbody>
              <tr>     
                <td colspan="2" align="justify">
                  Menimbang : 
                  <ol>
                    <li>Bahwa untuk menyelesaikan Perkuliahan Bagi Mahasiswa Fakultas Teknik Perlu Melaksanakan Kerja Praktek</li>
                    <li>Untuk itu perlu ditunjuk Pembimbing Kerja Praktek yang diangkat dengan Surat Keputusan Dekan</li>
                  </ol>
                </td>  
              </tr>
              <tr>     
                <td colspan="2" align="justify">
                  Mengingat : 
                  <ol>
                    <li>Undang-Undang Nomor 12 Tahun 2012 Tentang Pendidikan Tinggi</li>
                    <li>Peraturan Presiden Republik Indonesia Nomor 8 Tahun 2012 Tentang Kerangka Kualifikasi Nasional Indonesia</li>
                    <li>Peraturan Pemerintah Republik Indonesia Nomor 37 Tahun 2009 Tentang Dosen</li>
                    <li>Peraturan Pemerintah Republik Indonesia Nomor 66 Tahun 2010 Tentang Pengelolaan dan Penyelenggaraan Pendidikan</li>
                    <li>Peraturan Menteri Pendidikan dan Kebudayaan Republik Indonesia Nomor 3 Tahun 2020 Tentang Standar Nasional Pendidikan Tinggi </li>
                    <li>Statuta Universitas Islam Riau Tahun 2018</li>
                    <li>Peraturan Universitas Islam Riau Nomor 001 Tahun 2018 Tentang Ketentuan Akademik Bidang Pendidikan Universitas Islam Riau</li>
                  </ol>
                </td>  
              </tr>
              <tr>
                <td colspan="2" align="center">
                  <b>MEMUTUSKAN</b>
                </td>
              </tr>
              <tr>
                <td colspan="2" align="justify">
                  Menetapkan :
                  <ol>
                    <li>Mengangkat saudara-saudara yang namanya tersebut dibawah ini Sebagai Pembimbing Kerja Praktek Mahasiswa/i Fakultas Teknik Program Studi <?php echo $nama_prodi ?>
                      <br><br>
                      <table border="1" cellpadding="5" cellspacing="0" width="94%">
                        <thead>
                          <tr bgcolor='#DCDCDC' >
                            <th align="center">No</th>
                            <th align="center">Nama</th>
                            <th align="center">Pangkat</th>
                            <th align="center">Jabatan</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1.</td>
                            <td width="60%"><?= $nama_dosen ?></td>
                            <td width="30%"><?= $jabatan_fungsional  ?></td>
                            <td>Pembimbing</td>
                          </tr>
                        </tbody>
                      </table><br>
                    </li>
                    <li>Mahasiswa yang akan dibimbing :
                     <table border="0" width="100%">
                      <tbody>
                        <tr>           
                          <td width="100">Nama</td>           
                          <td width="10">:</td>           
                          <td width="248"><?= ucwords($nama_mahasiswa); ?></td>         
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
                         <td>Jenjang Pendidikan</td>
                         <td>:</td>           
                         <td>Strata Satu (S1) </td>          
                       </tr>
                       <tr>           
                         <td style="vertical-align: top; text-align: left;">Judul KP</td>  
                         <td style="vertical-align: top; text-align: left;">:</td>           
                         <td align="justify"><?= $judul_kerja_praktik ?></td>          
                       </tr>
                     </tbody>
                   </table>
                 </li>
                 <li>Keputusan ini berlaku pada tanggal ditetapkannya dengan ketentuan bila terdapat kekeliruan dikemudian hari segera ditinjau kembali.</li>
               </ol>
             </td>
           </tr>
           <tr>     
             <td></td>
             <td width="50%">
              Ditetapkan di : Pekanbaru<br>
              <u>Pada tanggal : 
                <?= $this->m_sk->format_tanggal(date('Y-m-d', strtotime($waktu_input_ttd))); ?>
              </u><br>
              <?= $jabatan_penanda_tangan?>,<br>
              <?php 
              QRcode::png(site_url("/Validasi_ttd_digital/cek_fakultas/".$id_random),"templates/img/qrcode/barcode_sk_pembimbing_kp_".$id_random.".png");
              ?>
              <img src="<?php echo base_url("templates/img/qrcode/barcode_sk_pembimbing_kp_".$id_random.".png") ?>" width="100px"><br>
              <u><b><?= $nama_penanda_tangan ?></b></u><br>
              NPK. <?= $npk_penanda_tangan?>
            </td>   
          </tr>
          <tr>
            <small>
              <i>*Surat ini ditandatangani secara elektronik</i>
            </small>
          </tr>
        </tbody>
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