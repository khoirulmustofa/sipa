<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SK Penguji Skripsi</title>
  <style> }

            #table td, #table th {
                /*border: 1px solid #ddd;*/
                padding: 1px;
                font-size: 11;
            }

            /*#table tr:nth-child(even){}*/

            /*#table tr:hover {background-color: #ddd;}*/

            #table th {
                padding-top: 1px;
                padding-bottom: 1px;
                text-align: center;
                /*background-color: #4CAF5;*/
                /*color: white;*/
            }

            #table td {
                padding-top: 1px;
                padding-bottom: 1px;
                /*text-align: center;*/
                /*background-color: #4CAF50;*/
                /*color: white;*/
            } </style>
</head>
<body>

  <?php
  if($id_syarat_sempro!=null){
    $row = $this->m_penguji_skripsi->get_row_data_skripsi($id_syarat_sempro);
    if ($row) {
      $nomor_surat            = $row->nomor_surat;
      $id_syarat_sempro       = $row->id_syarat_sempro;
      $id_skripsi             = $row->id_skripsi;
      $tahun                  = $row->tahun;
      $kodemax                = str_pad(($nomor_surat), 4, "0", STR_PAD_LEFT);
      $nomor_surat_full       = ($kodemax).'/KPTS/FT-UIR/SI/'.$tahun;
      $nama_mahasiswa         = $row->nama_mahasiswa;
      $nama_penanda_tangan    = $row->nama_penanda_tangan;
      $npk_penanda_tangan     = $row->npk_penanda_tangan;
      $nama_dosen             = $row->nama_dosen;
      $jabatan_fungsional     = $row->jabatan_fungsional;
      $jabatan_penanda_tangan = $row->jabatan_penanda_tangan;
      $npm                    = $row->npm;
      $nama_prodi             = $row->nama_prodi;
      $judul                  = $row->judul;
      $waktu_input_ttd        = $row->waktu_input_ttd;
      $id_random              = $row->id_random;

      ?>
      <div style="padding: 5;">
        <p align="center">SURAT KEPUTUSAN DEKAN FAKULTAS TEKNIK UNIVERSITAS ISLAM RIAU <br> NOMOR : <?= $nomor_surat_full ?>
          <br>TENTANG PENETAPAN DOSEN PENGUJI SKRIPSI MAHASISWA <br>FAK. TEKNIK UNIV. ISLAM RIAU</p>
          <hr>
          <p align="center"><b>DEKAN FAKULTAS TEKNIK</b></p>
        </div>
        <table border="0" cellpadding="1" id="table">
          <tbody>
            <tr>     
              <td colspan="2" align="justify">
                Menimbang : 
                <ol>
                  <li>Bahwa untuk menyelesaikan studi S.1 bagi mahasiswa Fakultas Teknik Univ. Islam Riau dilaksanakan Ujian Skripsi/Komprehensif sebagai tugas akhir. Untuk itu perlu ditetapkan mahasiswa yang telah memenuhi syarat untuk ujian dimaksud serta dosen penguji.</li>
                  <li>Bahwa penetapan mahasiswa yang memenuhi syarat dan dosen penguji yang bersangkutan perlu ditetapkan dengan Surat Keputusan Dekan.</li>
                </ol>
              </td>  
            </tr>
            <tr>     
              <td colspan="2" align="justify">
                Mengingat : 
                <ol>
                  <li>Undang-Undang Nomor 12 Tahun 2012 Tentang Pendidikan Tinggi.</li>
                  <li>Peraturan Presiden Republik Indonesia Nomor 8 Tahun 2012 Tentang Kerangka Kualifikasi Nasional Indonesia.</li>
                  <li>Peraturan Pemerintah Republik Indonesia Nomor 37 Tahun 2009 Tentang Dosen.</li>
                  <li>Peraturan Pemerintah Republik Indonesia Nomor 66 Tahun 2010 Tentang Pengelolaan dan Penyelenggaraan Pendidikan.</li>
                  <li>Peraturan Menteri Pendidikan Nasional Nomor 63 Tahun 2009 Tentang Sistem Penjaminan Mutu Pendidikan.</li>
                  <li>Peraturan Menteri Pendidikan dan Kebudayaan Republik Indonesia Nomor 49 Tahun 2014 Tentang Standar Nasional Pendidikan Tinggi</li>
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
                  <li>Mahasiswa Fakultas Teknik Universitas Islam Riau yang tersebut namanya di bawah ini :
                   <table border="0" width="100%">
                    <tbody>
                      <tr>           
                        <td width="70">Nama</td>           
                        <td width="2">:</td>           
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
                       <td style="vertical-align: top; text-align: left;">Judul Skripsi</td>  
                       <td style="vertical-align: top; text-align: left;">:</td>           
                       <td align="justify"><?= $judul ?></td>          
                     </tr>
                   </tbody>
                 </table>
               </li>
               <li>Penguji Seminar Proposal dan Sidang Skripsi mahasiswa tersebut terdiri dari :
                 <table> 
                   <tr>
                     <td>1. </b> <?php echo $this->m_monitoring_skripsi->get_nama_pembimbing($id_skripsi); ?></td>
                     echo
                     <td>Sebagai Ketua Merangkap Penguji</td>
                   </tr>
                   <tr>
                     <td>2. <?php echo $this->m_penguji_skripsi->get_nama_penguji($id_syarat_sempro, 'Penguji 1'); ?></td>
                     <td>Sebagai Anggota Merangkap Penguji</td>
                   </tr>
                   <tr>
                     <td>3. <?php echo $this->m_penguji_skripsi->get_nama_penguji($id_syarat_sempro, 'Penguji 2');?></td>
                     <td>Sebagai Anggota Merangkap Penguji</td>
                   </tr>
                 </table>
               </li>
               <li>Laporan hasil ujian serta berita acara telah sampai kepada Pimpinan Fakultas selambat-lambatnya 1(satu) bulan setelah ujian dilaksanakan.</li>
               <li>Keputusan ini mulai berlaku pada tanggal ditetapkannya dengan ketentuan bila terdapat kekeliruan dikemudian hari segera ditinjau kembali.</li>
               <br>
               <br>
               KUTIPAN : Disampaikan kepada yang bersangkutan untuk dapat dilaksanakan dengan sebaik-baiknya.
             </ol>
           </td>
         </tr>
         <tr>     
           <td></td>
           <td width="50%">
            Ditetapkan di : Pekanbaru<br>
            <u>Pada tanggal : 
              <?= $this->m_penguji_skripsi->format_tanggal(date('Y-m-d', strtotime($waktu_input_ttd))); ?>
            </u><br>
            <?= $jabatan_penanda_tangan?>,<br>
            <?php 
            QRcode::png(site_url("/Validasi_ttd_digital/cek_fakultas/".$id_random),"templates/img/qrcode/barcode_sk_penguji_skripsi_".$id_random.".png");
            ?>
            <img src="<?php echo base_url("templates/img/qrcode/barcode_sk_penguji_skripsi_".$id_random.".png") ?>" width="100px"><br>
            <u><b><?= $nama_penanda_tangan ?></b></u><br>
            NPK. <?= $npk_penanda_tangan?>
          </td>   
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