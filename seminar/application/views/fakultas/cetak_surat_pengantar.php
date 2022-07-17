<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Surat Pengantar Instansi Kerja Praktek</title>
  <style>  </style>
</head>
<body>

  <?php

  if($id_surat_pengantar!=null){
    $row = $this->m_surat_pengantar->get_row_data_surat_pengantar($id_surat_pengantar);
    if ($row) {
     $nomor_surat            = $row->nomor_surat;
     $tahun                  = $row->tahun;
     $kodemax                = str_pad(($nomor_surat), 4, "0", STR_PAD_LEFT);
     $nomor_surat_full       = ($kodemax).'/E-UIR/27-T/'.$tahun;
     $nama_mahasiswa         = $row->nama_mahasiswa;
     $nama_penanda_tangan    = $row->nama_penanda_tangan;
     $npm                    = $row->npm;
     $email_student          = $row->email_student;
     $kode_prodi             = $row->kode_prodi;
     $no_hp                  = $row->no_hp;
     $judul_kp               = $row->judul_kp;
     $nama_prodi             = $row->nama_prodi;
     $nama_instansi          = $row->nama_instansi;
     $alamat_instansi        = $row->alamat_instansi;
     $ditujukan              = $row->ditujukan;
     $lokasi              = $row->lokasi;
     $lampiran               = $row->lampiran;
     $waktu_mulai         = $row->waktu_mulai;
     $waktu_selesai       = $row->waktu_selesai;
     $waktu_input_ttd        = $row->waktu_input_ttd;
     $id_random              = $row->id_random;
     $npk_penanda_tangan     = $row->npk_penanda_tangan;
     $jabatan_penanda_tangan = $row->jabatan_penanda_tangan;
     ?>
     <div style="padding: 5;">
      <img src="<?php echo base_url('assets/img/kop_teknik.png') ?>" width="100%"><hr>
    </div>
    <table border="0" cellpadding="1" style="width: 700px;">
      <tbody>
        <tr>     
          <td colspan="2">
            <table border="0" cellpadding="1" style="width: 400px;">
              <tbody>
                <tr>         
                  <td width="93">No</td>         
                  <td width="8">:</td>         
                  <td width="300"><?= $nomor_surat_full  ?></td>   
                  <td width="100" align="right">
                    <div>
                      <!-- <u>28 Rabiul Awal 1443 H</u><br> -->
                      <?= $this->m_surat_pengantar->format_tanggal(date('Y-m-d', strtotime($waktu_input_ttd))); ?>
                    </div>
                  </td>      
                </tr>
                <tr>         
                  <td>Lampiran</td>         
                  <td>:</td>         
                  <td>
                    <?php 
                    if ($lampiran!='') {
                      echo '1 (satu) berkas';
                    }else{
                      echo '-';
                    }
                    ?>
                  </td>  
                  <td></td>     
                </tr>
                <tr>         
                  <td>Hal</td>         
                  <td>:</td>         
                  <td>Permohonan Izin Praktek Kerja Lapangan</td>       
                  <td></td>
                </tr>
              </tbody>
            </table>
          </td>  
        </tr>
        <tr>     
         <td colspan="2">
       <table border="0">
              <tr>
                <td width="10" >Yth.</td>
                <td colspan="2" width="100"> <?= $ditujukan ?> <?= $nama_instansi ?></td>
              </tr>
              <tr>
                <td ></td>
                <td width="60%"><?= $alamat_instansi  ?></td>   
                <td></td>
              </tr>
              <tr>
                <td ></td>
                <td >Di -</td>   
                <td></td>
              </tr>
              <tr>
                <td width="50"></td>
                <td colspan="2" width="100" > &nbsp; &nbsp;<?= $lokasi ?></td>
              </tr>
            </table><br>
        </td>           
      </tr>
      <tr>
        <br><td colspan="2">Assalamu'alaikum Warahmatullahi Wabarakatuh</td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td colspan="2">Teriring salam dan Doa semoga Bapak/Ibu selalu dalam keadaan sehat walafiat dan sukses menjalankan aktifitas sehari-hari, Aamin ya Rabbal Alamin.</td>
      </tr>
      <tr>
        <td colspan="3" height="250" valign="top">
          <br><div>
          Bersama ini Kami mohon dengan hormat, kiranya Bapak/Ibu berkenan memberikan izin bagi:
          <table border="0" style="width: 100%;">
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
               <td>No. HP</td>           
               <td>:</td>           
               <td><?= $no_hp ?></td>          
             </tr>
             <tr>           
               <td>Email Mahasiswa</td>           
               <td>:</td>           
               <td><?= $email_student ?></td>          
             </tr>
             <tr>           
               <td>Rencana Waktu Pelaksanaan</td>           
               <td>:</td>           
               <td><?= $this->m_surat_pengantar->format_tanggal(date('Y-m-d', strtotime($waktu_mulai))); ?> s.d <?= $this->m_surat_pengantar->format_tanggal(date('Y-m-d', strtotime($waktu_selesai))); ?></td>         
             </tr>
             <tr>           
               <td>Email Program Studi</td>           
               <td>:</td>           
               <td><?= $this->m_surat_pengantar->get_email_prodi($kode_prodi) ?></td>          
             </tr>
             <?php if ($kode_prodi=='1'){ ?>
               <tr>           
                 <td>Judul Proyek</td>           
                 <td>:</td>           
                 <td><?= $judul_kp ?></td>          
               </tr>
               <?php }?>
           </tbody>
         </table><br>
         <div>                             
           Untuk dapat melaksanakan Praktek Kerja Lapangan (PKL) di Instansi/Perusahaan yang Bapak/Ibu pimpin saat ini.<br>
         </div><br>
         <div>                             
          Demikian kami sampaikan, atas perhatian kerjasama dan bantuan yang diberikan, kami ucapkan terima kasih.
        </div>
      </div>
    </td>   
  </tr>
  <tr>    
    <td width="60%"></td>
    <td width="40%">
      <table>
        <tr>
          <td >
            <div>
              <u><?= $jabatan_penanda_tangan?>,</u>
              <br>
              <br>
              <?php 
              QRcode::png(site_url("/Validasi_ttd_digital/cek_fakultas/".$id_random),"templates/img/qrcode/barcode_surat_pengantar_".$id_random.".png");
              ?>
              <img src="<?php echo base_url("templates/img/qrcode/barcode_surat_pengantar_".$id_random.".png") ?>" width="100px">
              <br>
              <u><b><?= $nama_penanda_tangan?></b></u><br>
              NPK. <?= $npk_penanda_tangan?>
            </div>
          </td>  
        </tr>
      </table>
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