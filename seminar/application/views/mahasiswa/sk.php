<div class="col-lg-12 mb-1">
  <div class="card shadow mb-4">
    <div class="card-header">
      <h5 class="m-0 font-weight-bold text-primary">Pengajuan SK Pembimbing KP</h5>
    </div>
    <div class="card-body">
      <?php echo $this->session->flashdata('messege'); ?>
      <div class="ml-md-auto py-2 py-md-0">
        <h1 align="right">

        </h1>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
          <thead class="table table-primary">
            <tr>
              <td align="center" width="30"><b>SYARAT SK</b></td>
              <td align="center" width="130"><b>BERKAS PENERIMAAN LAPANGAN</b></td>  
              <td align="center" width="130"><b>BERKAS SPP DASAR</b></td>  
              <td align="center" width="130"><b>BERKAS TRANSKIP NILAI SEMENTARA</b></td>  
              <td align="center" width="130"><b>FILE PROPOSAL KP</b></td>  
              <td align="center"><b>STATUS VALIDASI</b></td>  
              <td align="center"><b>DURASI</b></td>  
              <td align="center"><b>BERKAS SK</b></td>
              <td align="center"><b>NILAI DOSEN PEMBIMBING</b></td>
              <td align="center"><b>NILAI PEMBIMBING LAPANGAN</b></td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <?php
                $cekSyaratSK = $this->m_sk->cekSyaratSK($_SESSION['npm']);
                if($cekSyaratSK->num_rows()<1){
                  echo '<i class="fas fa-plus text-primary"data-toggle="modal" data-target="#Modalpengajuan"> Tambah</i>';
                }else{
                  $baris = $cekSyaratSK->row();
                  if ($baris) {
                    $id_syarat_sk         = $baris->id_syarat_sk;
                    $npm                  = $baris->npm;
                    $nama_file_syarat_sk  = $baris->nama_file_syarat_sk;
                    $file_spp_dasar       = $baris->file_spp_dasar;
                    $file_transkrip       = $baris->file_transkrip;
                    $file_laporan         = $baris->file_laporan;
                    $waktu_selesai_kp     = $baris->waktu_selesai_kp;
                    $tgl_upload_syarat_sk     = $baris->tgl_upload_syarat_sk;
                  }  
                  if($this->m_sk->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Disetujui','Pengecekan Berkas Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha')>0){
                    ?> 
                    <i class="fas fa-eye text-success" data-toggle="modal" data-target="#ModalLihat"></i>

                    <?php
                  } elseif($this->m_sk->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Disetujui', '')<=0){
                    echo '<i class="fa fa-pen" data-toggle="modal" data-target="#ModalpengajuanEdit"> Edit</i>';
                    // echo '<a class="fa fa-trash text-danger" data-toggle="modal" data-target="#ModalpengajuanHapus"> Hapus</a>';       
                  }
                  else{
                    // echo '<a class="btn btn-danger text-white border-white custom-btn btn-sm" data-toggle="modal" data-target="#ModalpengajuanHapus"><i class="fa fa-trash"></i> Hapus Syarat SK</a>';
                  }
                }
                ?>
                <td class="text-left">
                  <?php
                  $cekSyaratSK = $this->m_sk->cekSyaratSK($_SESSION['npm']);
                  $tema1= 'Pengecekan Berkas Bukti Penerimaan Lapangan untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha';
                  if($this->m_sk->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Disetujui', $tema1)>0){
                    echo '<b class="text-success">Berkas Tervalidasi</b>';
                  }elseif($this->m_sk->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Ditolak', $tema1)>0){
                    ?>
                    <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/sk/upload_file')?>">
                      <div class="form-group">

                        <b class="btn text-danger" data-toggle="modal" data-target="#Modal"><i class="fas fa-eye">Data ditolak </i></b>;
                        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"><b class="text-danger">Data ditolak</b></h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">
                             <?php 
                             echo $this->m_sk->alasan_ditolak($id_syarat_sk, $tema1) ?>
                           </div>
                         </div>
                       </div>
                     </div>                    
                     <a target="_BLANK" href="<?php echo base_url("templates/file/mahasiswa/syarat_sk/sk/".$nama_file_syarat_sk) ?>">(Lihat File)</a><br>
                     <input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>            
                     <input type="hidden" value="<?php echo $nama_file_syarat_sk ?>" name="file_lama"></input> 
                     <input type="hidden" value="<?php echo $id_syarat_sk ?>" name="id_syarat_sk"></input><br> 
                     <button class="btn btn-primary" type="submit" name="tombol_upload_file1">Submit</button>
                   </div>
                 </form>  
                 <?php
               }elseif($cekSyaratSK->num_rows()==0){
                echo '-';
              }else{
                ?>
                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/sk/upload_file')?>">
                  <div class="form-group">
                   <b class="text-warning">Menunggu Validasi</b>
                   <a target="_BLANK" href="<?php echo base_url("templates/file/mahasiswa/syarat_sk/sk/".$nama_file_syarat_sk) ?>">(Lihat File)</a><br>
                   <input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>            
                   <input type="hidden" value="<?php echo $nama_file_syarat_sk ?>" name="file_lama"></input> 
                   <input type="hidden" value="<?php echo $id_syarat_sk ?>" name="id_syarat_sk"></input><br> 
                   <center><button class="btn btn-primary " type="submit" name="tombol_upload_file1">Submit</button></center>
                 </div>
               </form>  
               <?php
             }
             ?>
           </td>
           <td class="text-left">
            <?php
            $cekSyaratSK = $this->m_sk->cekSyaratSK($_SESSION['npm']);
            $tema2= 'Pengecekan Berkas SPP dasar untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha';
            if($this->m_sk->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Disetujui', $tema2)>0){
              echo '<b class="text-success">Berkas Tervalidasi</b>';
            }elseif($this->m_sk->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Ditolak', $tema2)>0){
              ?>
              <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/sk/upload_file')?>">
                <div class="form-group">
                 <b class="btn text-danger" data-toggle="modal" data-target="#Modal2"><i class="fas fa-eye">Data ditolak </i></b>;     
                 <div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                 <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><b class="text-danger">Data ditolak</b></h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">
                     <?php 
                     echo $this->m_sk->alasan_ditolak($id_syarat_sk, $tema2) ?>
                   </div>
                 </div>
               </div>
             </div>        
             <a target="_BLANK" href="<?php echo base_url("templates/file/mahasiswa/syarat_sk/sk/spp/".$file_spp_dasar) ?>">(Lihat File)</a><br>
             <input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>   
             <input type="hidden" value="<?php echo $nama_file_syarat_sk ?>" name="file_lama"></input> 
             <input type="hidden" value="<?php echo $id_syarat_sk ?>" name="id_syarat_sk"></input><br>
             <button class="btn btn-primary" type="submit" name="tombol_upload_file2">Submit</button>
           </div>
         </form>  
         <?php
       }elseif($cekSyaratSK->num_rows()==0){
        echo '-';
      }else{
        ?>
        <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/sk/upload_file')?>">
          <div class="form-group">
           <b class="text-warning">Menunggu Validasi</b>
           <a target="_BLANK" href="<?php echo base_url("templates/file/mahasiswa/syarat_sk/sk/spp/".$file_spp_dasar) ?>"><br>(Lihat File)</a><br>
           <input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>     
           <input type="hidden" value="<?php echo $nama_file_syarat_sk ?>" name="file_lama"></input> 
           <input type="hidden" value="<?php echo $id_syarat_sk ?>" name="id_syarat_sk"></input><br>
           <center><button class="btn btn-primary" type="submit" name="tombol_upload_file2">Submit</button></center>
         </div>
       </form>  
       <?php
     }
     ?>
   </td>
   <td class="text-left">
    <?php
    $cekSyaratSK = $this->m_sk->cekSyaratSK($_SESSION['npm']);
    $tema3= 'Pengecekan Berkas Transkip Nilai Sementara untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha';
    if($this->m_sk->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Disetujui', $tema3)>0){
      echo '<b class="text-success">Berkas Tervalidasi</b>';
    }elseif($this->m_sk->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Ditolak', $tema3)>0){
      ?>
      <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/sk/upload_file')?>">
        <div class="form-group">
         <b class="btn text-danger" data-toggle="modal" data-target="#Modal3"><i class="fas fa-eye">Data ditolak </i></b>;     
         <div class="modal fade" id="Modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
         <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><b class="text-danger">Data ditolak</b></h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
             <?php 
             echo $this->m_sk->alasan_ditolak($id_syarat_sk, $tema3) ?>
           </div>
         </div>
       </div>
     </div>              
     <a target="_BLANK" href="<?php echo base_url("templates/file/mahasiswa/syarat_sk/sk/transkrip/".$file_transkrip) ?>">(Lihat File)</a><br>
     <input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>       
     <input type="hidden" value="<?php echo $nama_file_syarat_sk ?>" name="file_lama"></input> 
     <input type="hidden" value="<?php echo $id_syarat_sk ?>" name="id_syarat_sk"></input><br> 
     <button class="btn btn-primary" type="submit" name="tombol_upload_file3">Submit</button>
   </div>
 </form>  
 <?php
}elseif($cekSyaratSK->num_rows()==0){
  echo '-';
}else{
  ?>
  <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/sk/upload_file')?>">
    <div class="form-group">
     <b class="text-warning">Menunggu Validasi</b>
     <a target="_BLANK" href="<?php echo base_url("templates/file/mahasiswa/syarat_sk/sk/transkrip/".$file_transkrip) ?>"><br>(Lihat File)</a><br>
     <input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>         
     <input type="hidden" value="<?php echo $nama_file_syarat_sk ?>" name="file_lama"></input> 
     <input type="hidden" value="<?php echo $id_syarat_sk ?>" name="id_syarat_sk"></input><br>
     <center><button class="btn btn-primary" type="submit" name="tombol_upload_file3">Submit</button></center>
   </div>
 </form>  
 <?php
}
?>
</td> 
<td class="text-left">
  <?php
  $cekSyaratSK = $this->m_sk->cekSyaratSK($_SESSION['npm']);
  $tema4= 'Pengecekan File Laporan KP untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha';
  if($this->m_sk->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Disetujui', $tema4)>0){
    echo '<b class="text-success">Berkas Tervalidasi</b>';
  }elseif($this->m_sk->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Ditolak', $tema4)>0){
    ?>
    <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/sk/upload_file')?>">
      <div class="form-group">
       <b class="btn text-danger" data-toggle="modal" data-target="#Modal4"><i class="fas fa-eye">Data ditolak </i></b>;    
       <div class="modal fade" id="Modal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
       aria-hidden="true">
       <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><b class="text-danger">Data ditolak</b></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
           <?php 
           echo $this->m_sk->alasan_ditolak($id_syarat_sk, $tema4) ?>
         </div>
       </div>
     </div>
   </div>               
   <a target="_BLANK" href="<?php echo base_url("templates/file/mahasiswa/syarat_sk/sk/laporan/".$file_laporan) ?>">(Lihat File)</a><br>
   <input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>       
   <input type="hidden" value="<?php echo $nama_file_syarat_sk ?>" name="file_lama"></input> 
   <input type="hidden" value="<?php echo $id_syarat_sk ?>" name="id_syarat_sk"></input><br> 
   <button class="btn btn-primary" type="submit" name="tombol_upload_file4">Submit</button>
 </div>
</form>  
<?php
}elseif($cekSyaratSK->num_rows()==0){
  echo '-';
}else{
  ?>
  <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/sk/upload_file')?>">
    <div class="form-group">
     <b class="text-warning">Menunggu Validasi</b>
     <a target="_BLANK" href="<?php echo base_url("templates/file/mahasiswa/syarat_sk/sk/laporan/".$file_laporan) ?>"><br>(Lihat File)</a><br>
     <input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>         
     <input type="hidden" value="<?php echo $nama_file_syarat_sk ?>" name="file_lama"></input> 
     <input type="hidden" value="<?php echo $id_syarat_sk ?>" name="id_syarat_sk"></input><br>
     <center><button class="btn btn-primary" type="submit" name="tombol_upload_file4">Submit</button></center>
   </div>
 </form>  
 <?php
}
?>
</td>           
<td>
  <?php
  $cekSyaratSK = $this->m_sk->cekSyaratSK($_SESSION['npm']);
  if($this->m_sk->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Disetujui','Pengecekan Berkas Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha')>0){
    echo '<b class="text-success">Berkas Disetujui, Silahkan tunggu sampai SK diterbitkan</b>';
  }elseif($this->m_sk->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Ditolak','Pengecekan Berkas Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha')>0){
    echo '<b class="btn text-danger" data-toggle="modal" data-target="#ModalAlasanDitolakTU4'.$id_syarat_sk.'"><i class="fas fa-eye">Data ditolak </i></b>';
    ?>
    <!-- MODAL ALASAN DITOLAK TU -->
    <div class="modal fade" id="ModalAlasanDitolakTU4<?= $id_syarat_sk ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><b class="text-danger">Data ditolak</b></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <?php 
            foreach ($this->m_sk->alasan_ditolak_semua($npm, $id_syarat_sk) as $n): ?>
            <?php echo $n['alasan_ditolak'];?>
          <?php endforeach ?>
        </div>
      </div>
    </div>
  </div>
  <?php 
}elseif($cekSyaratSK->num_rows()>0){
  echo '<b class="text-warning">Menunggu Validasi Berkas</b>';
}elseif($cekSyaratSK->num_rows()==0){
  echo '-';
}else{
  echo '-';
}
?>
</td>
<td>
   <?php
                      // $waktustart=date("2022-07-04");
                      $waktustart = date('Y-m-d', strtotime($tgl_upload_syarat_sk)); 

                      $waktuend=date("Y-m-d");

                      $datetime1 = new DateTime($waktustart);//start time
                      $datetime2 = new DateTime($waktuend);//end time
                      $durasi = $datetime1->diff($datetime2);
                      echo $durasi->format('%d hari');
?>
</td>
<td>
  <?php
  if (isset($id_syarat_sk)) {
    $cekSyaratSK = $this->m_sk->cekResponSKPembimbingKP($id_syarat_sk);
    if($cekSyaratSK>0){
      ?> 
      <a target="_BLANK" href="<?php echo site_url('/mahasiswa/sk/cetak_sk_pembimbing_kp/').$id_syarat_sk ?>"><i class="fas fa-download text-success"> Unduh</i></a>
      <?php
    } else {
      echo 'Tidak Ada Berkas';
    }              
  } else{
    echo '-';
  }
  ?>
</td>
<td>
  <?php
  if (isset($id_syarat_sk)) {
    $cekNilaiDospem = $this->m_monitoring_sk->cekNilaiDospem($id_syarat_sk);
    if($cekNilaiDospem>0){
      ?> 
      <i class="fas fa-check text-success"> Sudah dinilai</i>
      <?php
    } else {
      echo 'Belum dinilai';
    }  
  } else{
    echo '-';
  }               
  ?>
</td>
<td>
  <?php
  if (isset($id_syarat_sk)) {
    $cekNilaiPembimbingLapangan = $this->m_monitoring_sk->cekNilaiPembimbingLapangan($id_syarat_sk);
    if($cekNilaiPembimbingLapangan>0){
      ?> 
      <i class="fas fa-check text-success"> Sudah dinilai</i>
      <?php
    } else {
      echo 'Belum dinilai';
    }  
  } else{
    echo '-';
  }                
  ?>
</td>
</tr>                       
</tbody>
</table>
</div>
</div>
</div>

<!-- MODAL TAMBAH DATA PENGAJUAN SK -->
<div class="modal fade" id="Modalpengajuan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel"><b class="text-primary">Pengajuan SK Pembimbing KP</b></h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    <div class="modal-body">
      <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/sk/tambah_data')?>">
        <div class="form-group">
          <label>
            <i class="text-danger">Jika Nama Instansi Tidak Tersedia, Maka Pastikan Anda Sudah Mengurus Surat Pengantar Pada Menu Surat Pengantar Instansi dan Surat tersebut Sudah Terbit</i>
          </label>
          <label>Nama Instansi/ Perusahaan</label>
          <input type="hidden" value="<?= "1" ?>" name="id_jenis_sk" class="form-control"></input>
          <select class="form-control" name="id_surat_pengantar" required=""> 
            <?php 
            foreach ($combobox_nama_tempat_kp as $tmp){

             ?>
             <option value="<?php echo $tmp['id_surat_pengantar'] ?>"><?php echo $tmp['nama_instansi'] ?></option>
             <?php } ?>
           </select>
         </div>
         <div class="form-group">
          <label>Judul Kerja Praktik</label>
          <input type="text" name="judul_kerja_praktik" class="form-control" required=""></input>
        </div>
        <div class="form-group">
          <label>Nama Pembimbing Lapangan</label>
          <input type="text" name="nama_pembimbing_lapangan" class="form-control" required=""></input>
        </div>
        <div class="form-group">
          <label>No. HP Pembimbing</label>
          <input type="number" name="no_hp_pembimbing_lapangan" class="form-control" required=""></input>
        </div>
        <div class="form-group">
          <label>Email Pembimbing Lapangan</label>
          <input type="text" class="form-control" id="email_pembimbing_lapangan" name="email_pembimbing_lapangan" required="">
        </div>
        <div class="form-group">
          <label>Waktu Mulai KP</label>
          <input type="date" name="waktu_mulai_kp" class="form-control" required=""></input>
        </div>
        <div class="form-group">
          <label>Waktu Selesai KP</label>
          <input type="date" name="waktu_selesai_kp" class="form-control" required=""></input>
        </div>
        <div class="form-group">
          <label class="bmd-label-floating">Upload Bukti Penerimaan Kerja Praktek Lapangan di Perusahaan/Instansi Terkait<small class="text-primary"> *Format PDF</small></label>
          <input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>
        </div>
        <div class="form-group">
          <label class="bmd-label-floating">Upload Bukti Pembayaran SPP Dasar Semester yang sedang Berjalan (Upload yang dari SIKAD)<small class="text-primary"> *Format PDF</small></label>
          <input type="file" accept="application/pdf"  class="form-control-file" name="file_spp_dasar" id="file_spp_dasar" required>
        </div>
        <div class="form-group">
          <label class="bmd-label-floating">Upload  Transkip Nilai Sementara<small class="text-primary"> *Format PDF</small></label>
          <input type="file" accept="application/pdf"  class="form-control-file" name="file_transkrip" id="file_transkrip" required>
        </div>
        <div class="form-group">
          <label class="bmd-label-floating">Upload Proposal KP<small class="text-primary"> *Format PDF</small></label>
          <input type="file" accept="application/pdf"  class="form-control-file" name="file_laporan" id="file_laporan" required>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="reset" data-dismiss="modal">Tutup</button>
          <button class="btn btn-primary" type="submit" name="tombolInputSyaratSK">Submit</button>
        </div>
      </form>  
    </div>
  </div>
</div>
</div>

<!-- MODAL EDIT DATA PENGAJUAN SK -->
<?php 
if ($row_data) {
  $id_syarat_sk               = $row_data->id_syarat_sk;
  $id_surat_pengantar         = $row_data->id_surat_pengantar;
  $id_jenis_sk                = $row_data->id_jenis_sk;
  $npm                        = $row_data->npm;
  $nama_tempat_kp             = $row_data->nama_instansi;
  $judul_kerja_praktik        = $row_data->judul_kerja_praktik;
  $nama_pembimbing_lapangan   = $row_data->nama_pembimbing_lapangan;
  $no_hp_pembimbing_lapangan  = $row_data->no_hp_pembimbing_lapangan;
  $email_pembimbing_lapangan  = $row_data->email_pembimbing_lapangan;
  $waktu_mulai_kp             = $row_data->waktu_mulai_kp;
  $waktu_selesai_kp           = $row_data->waktu_selesai_kp;
  $tgl_upload_syarat_sk       = $row_data->tgl_upload_syarat_sk;
  $nama_file_syarat_sk        = $row_data->nama_file_syarat_sk;
  $file_spp_dasar             = $row_data->file_spp_dasar;
  $file_transkrip             = $row_data->file_transkrip;
  $file_laporan               = $row_data->file_laporan;
  ?>
  <div class="modal fade" id="ModalpengajuanEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Pengajuan Tempat Praktek Kerja Lapangan</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/sk/edit_data')?>">
          <div class="form-group">
            <input type="hidden" value="<?= $id_syarat_sk ?>" name="id_syarat_sk" class="form-control"></input>
          </div>
          <div class="form-group">
            <label>Nama Tempat Praktek</label>
            <select class="form-control" name="id_surat_pengantar"> 
              <?php 
              foreach ($combobox_nama_tempat_kp as $tmp){

               ?>
               <option value="<?php echo $tmp['id_surat_pengantar'] ?>" 
                 <?php if ($tmp['id_surat_pengantar']== $id_surat_pengantar) {
                   echo 'selected';
                 } ?> ><?php echo $tmp['nama_instansi'] ?></option>
                 <?php } ?>
               </select>
             </div>
             <div class="form-group">
              <label>Judul Kerja Praktik</label>
              <input type="text" name="judul_kerja_praktik" class="form-control" value="<?php echo $judul_kerja_praktik ?>"required=""></input>
            </div>
            <div class="form-group">
              <label>Nama Pembimbing Lapangan</label>
              <input type="text" name="nama_pembimbing_lapangan" class="form-control" value="<?php echo $nama_pembimbing_lapangan?>" required=""></input>
            </div>
            <div class="form-group">
              <label>No. HP Pembimbing</label>
              <input type="number" name="no_hp_pembimbing_lapangan" class="form-control" value="<?php echo $no_hp_pembimbing_lapangan?>" required=""></input>
            </div>
            <div class="form-group">
              <label>Email Pembimbing Lapangan</label>
              <input type="text" name="email_pembimbing_lapangan" class="form-control" value="<?php echo $email_pembimbing_lapangan?>" required=""></input>
            </div>
            <div class="form-group">
              <label>Waktu Mulai</label>
              <input type="date" name="waktu_mulai_kp" class="form-control" value="<?php echo $waktu_mulai_kp?>" required=""></input>
            </div>
            <div class="form-group">
              <label>Waktu Selesai</label>
              <input type="date" name="waktu_selesai_kp" class="form-control" value="<?php echo $waktu_selesai_kp?>" required=""></input>
            </div>
            <div class="form-group">
              <label class="bmd-label-floating">LIHAT FILE BERKAS</label><br>
              <a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/sk/'.$nama_file_syarat_sk) ?>">Bukti Penerimaan Kerja Praktek Lapangan</a><br>
              <a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/sk/spp/'.$file_spp_dasar) ?>">Bukti Pembayaran SPP Dasar</a><br>
              <a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/sk/transkrip/'.$file_transkrip) ?>">Bukti Transkip Nilai Sementara</a><br>
              <a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/sk/laporan/'.$file_laporan) ?>">File Laporan KP</a>
              <input type="hidden" name="nama_file_syarat_sk" id="file" value="<?php echo $nama_file_syarat_sk?>">
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Tutup</button>
              <button class="btn btn-primary" name="tombolSimpan">Simpan</button>
            </div>
          </form>  
        </div>
      </div>
    </div>
  </div>
  <?php 
}
?>


<!-- MODAL LIHAT DATA PENGAJUAN SK -->
<?php 
if ($row_data) {
  $id_syarat_sk               = $row_data->id_syarat_sk;
  $id_surat_pengantar         = $row_data->id_surat_pengantar;
  $id_jenis_sk                = $row_data->id_jenis_sk;
  $npm                        = $row_data->npm;
  $nama_tempat_kp             = $row_data->nama_instansi;
  $judul_kerja_praktik        = $row_data->judul_kerja_praktik;
  $nama_pembimbing_lapangan   = $row_data->nama_pembimbing_lapangan;
  $no_hp_pembimbing_lapangan  = $row_data->no_hp_pembimbing_lapangan;
  $email_pembimbing_lapangan  = $row_data->email_pembimbing_lapangan;
  $waktu_mulai_kp             = $row_data->waktu_mulai_kp;
  $waktu_selesai_kp           = $row_data->waktu_selesai_kp;
  $tgl_upload_syarat_sk       = $row_data->tgl_upload_syarat_sk;
  $nama_file_syarat_sk        = $row_data->nama_file_syarat_sk;
  $file_spp_dasar             = $row_data->file_spp_dasar;
  $file_transkrip             = $row_data->file_transkrip;
  $file_laporan               = $row_data->file_laporan;
  ?>
  <div class="modal fade" id="ModalLihat" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Pengajuan Tempat Praktek Kerja Lapangan</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/sk/edit_data')?>">
          <div class="form-group">
            <label>Nama Tempat Praktek</label>
            <input type="hidden" value="<?= $id_syarat_sk ?>" name="id_syarat_sk" class="form-control"></input>
            <select class="form-control" name="id_surat_pengantar" readonly> 
              <?php 
              foreach ($combobox_nama_tempat_kp as $tmp){

               ?>
               <option value="<?php echo $tmp['id_surat_pengantar'] ?>" 
                 <?php if ($tmp['id_surat_pengantar']== $id_surat_pengantar) {
                   echo 'selected';
                 } ?> ><?php echo $tmp['nama_instansi'] ?></option>
                 <?php } ?>
               </select>
             </div>
             <div class="form-group">
              <label>Judul Kerja Praktik</label>
              <input type="text" name="judul_kerja_praktik" class="form-control" value="<?php echo $judul_kerja_praktik ?>" readonly ></input>
            </div>
            <div class="form-group">
              <label>Nama Pembimbing Lapangan</label>
              <input type="text" name="nama_pembimbing_lapangan" class="form-control" value="<?php echo $nama_pembimbing_lapangan?>" readonly></input>
            </div>
            <div class="form-group">
              <label>No. HP Pembimbing</label>
              <input type="number" name="no_hp_pembimbing_lapangan" class="form-control" value="<?php echo $no_hp_pembimbing_lapangan?>" readonly></input>
            </div>
            <div class="form-group">
              <label>Email Pembimbing Lapangan</label>
              <input type="text" name="email_pembimbing_lapangan" class="form-control" value="<?php echo $email_pembimbing_lapangan?>" readonly></input>
            </div>
            <div class="form-group">
              <label>Waktu Mulai</label>
              <input type="date" name="waktu_mulai_kp" class="form-control" value="<?php echo $waktu_mulai_kp?>" readonly></input>
            </div>
            <div class="form-group">
              <label>Waktu Selesai</label>
              <input type="date" name="waktu_selesai_kp" class="form-control" value="<?php echo $waktu_selesai_kp?>" readonly></input>
            </div>
            <div class="form-group">
              <label class="bmd-label-floating">LIHAT FILE BERKAS</label><br>
              <a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/sk/'.$nama_file_syarat_sk) ?>">Bukti Penerimaan Kerja Praktek Lapangan</a><br>
              <a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/sk/spp/'.$file_spp_dasar) ?>">Bukti Pembayaran SPP Dasar</a><br>
              <a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/sk/transkrip/'.$file_transkrip) ?>">Bukti Transkip Nilai Sementara</a><br>
              <a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/sk/laporan/'.$file_laporan) ?>">File Laporan KP</a>
              <input type="hidden" name="nama_file_syarat_sk" id="file" value="<?php echo $nama_file_syarat_sk?>">
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Tutup</button>
            </div>
          </form>  
        </div>
      </div>
    </div>
  </div>
  <?php 
}
?>

<!-- MODAL HAPUS DATA PENGAJUAN SK -->
<div class="modal fade" id="ModalpengajuanHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Hapus Data Pengajuan Tempat Praktek Kerja Lapangan</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    <div class="modal-body">
      <form class="form-horizontal" method="post" action="<?php echo site_url('/mahasiswa/sk/hapus_data')?>">
        <div class="modal-body">
          <p>Anda yakin mau menghapus data?</p>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id_syarat_sk" value="<?php echo $id_syarat_sk;?>">
          <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
          <button class="btn btn-danger" name="tombolHapus">Ya</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>

<?php 

?>

<!-- MODAL ALASAN DITOLAK TU -->
<?php 
$no = 1;
foreach ($pencarian_data->result_array() as $i):
  $id_persetujuan_sk      = $i['id_persetujuan_sk'];

?>
<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel"><b class="text-danger">Data ditolak</b></h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    <div class="modal-body">
     <?php 
     foreach ($this->m_sk->alasan_ditolak($id_syarat_sk, $tema_persetujuan) as $n): ?>
     <?php echo $n['alasan_ditolak'];?>
   <?php endforeach ?>
 </div>
</div>
</div>
</div>
<?php endforeach ?>
