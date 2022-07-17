<div class="col-lg-12 mb-1">
  <div class="card shadow mb-4">
    <div class="card-header">
     <h5 class="m-0 font-weight-bold text-primary">Pengajuan Sidang Skripsi</h5>
   </div>
   <div class="card-body">
    <?php if($this->m_kompre->cekPersetujuan_kompre($_SESSION['npm'])>0){ ?>
    <?php echo $this->session->flashdata('messege'); ?>
    <div class="ml-md-auto py-2 py-md-0">
      <h1 align="right">

      </h1>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
        <thead class="table table-primary">
          <tr>
            <td align="center" width="30"><b>SYARAT</b></td>
            <td align="center" width="130"><b>BERKAS SPP DASAR</b></td>  
            <td align="center" width="130"><b>BERKAS TRANSKIP NILAI SEMENTARA</b></td>  
            <td align="center" width="130"><b>BERKAS KRS</b></td>  
            <td align="center" width="130"><b>SETIFIKAT AL-QUR'AN</b></td>  
            <td align="center" width="130"><b>SETIFIKAT TOELF/IELTS</b></td>  
            <td align="center" width="130"><b>FILE LAPORAN SKRIPSI</b></td>  
            <td align="center"><b>STATUS VALIDASI</b></td>  
            <td align="center"><b>NILAI</b></td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <?php
              $cekSyaratkompre = $this->m_kompre->cekSyaratkompre($_SESSION['npm']);
              if($cekSyaratkompre->num_rows()<1){
                echo '<i class="fas fa-plus text-primary"data-toggle="modal" data-target="#Modalpengajuan"> Tambah</i>';
              }else{
                $baris = $cekSyaratkompre->row();
                if ($baris) {
                  $id_syarat_kompre     = $baris->id_syarat_kompre;
                  $id_syarat_sempro     = $baris->id_syarat_sempro;
                  $npm                  = $baris->npm;
                  $usulan_tanggal       = $baris->usulan_tanggal;
                  $usulan_jam       = $baris->usulan_jam;
                  $file_spp             = $baris->file_spp;
                  $file_krs             = $baris->file_krs;
                  $file_laporan         = $baris->file_laporan;
                  $file_transkrip       = $baris->file_transkrip;
                  $sertifikat_alquran   = $baris->sertifikat_alquran;
                  $sertifikat_inggris   = $baris->sertifikat_inggris;
                }  
                if($this->m_kompre->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Disetujui','Pengecekan Berkas Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha')>0){
                  ?> 
                  <i class="fas fa-eye text-success" data-toggle="modal" data-target="#ModalLihat"></i>

                  <?php
                } elseif($this->m_kompre->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Disetujui', '')<=0){
                  echo '<i class="fas fa-eye text-success" data-toggle="modal" data-target="#ModalLihat"></i>';
                  // echo '<i class="fa fa-pen" data-toggle="modal" data-target="#ModalpengajuanEdit"> Edit</i>';       
                }
                else{
                  echo '<a class="btn btn-danger text-white border-white custom-btn btn-sm" data-toggle="modal" data-target="#ModalpengajuanHapus"><i class="fa fa-trash"></i> Hapus Syarat SK</a>';
                }
              }
              ?>
            </td>
            <td>
              <?php
              $cekSyaratKompre = $this->m_kompre->cekSyaratKompre($_SESSION['npm']);
              $tema1= 'Pengecekan Berkas SPP untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha';
              if($this->m_kompre->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Disetujui', $tema1)>0){
                echo '<b class="text-success">Berkas Tervalidasi</b>';
              }elseif($this->m_kompre->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Ditolak', $tema1)>0){
                ?>
                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/kompre/upload_file')?>">
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
                       echo $this->m_kompre->alasan_ditolakk($id_syarat_kompre, $tema1) ?>
                     </div>
                   </div>
                 </div>
               </div>                        
               <a target="_BLANK" href="<?php echo base_url("templates/file/mahasiswa/syarat_kompre/spp/".$file_spp) ?>">(Lihat File)</a><br>
               <input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>            
               <input type="hidden" value="<?php echo $file_spp ?>" name="file_lama"></input> 
               <input type="hidden" value="<?php echo $id_syarat_kompre ?>" name="id_syarat_kompre"></input><br> 
               <button class="btn btn-primary" type="submit" name="tombol_upload_file1">Submit</button>
             </div>
           </form>  
           <?php
         }elseif($cekSyaratKompre->num_rows()==0){
          echo '-';
        }else{
          ?>
          <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/kompre/upload_file')?>">
            <div class="form-group">
             <b class="text-warning">Menunggu Validasi</b>
             <a target="_BLANK" href="<?php echo base_url("templates/file/mahasiswa/syarat_kompre/spp/".$file_spp) ?>">(Lihat File)</a><br>
             <input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>            
             <input type="hidden" value="<?php echo $file_spp ?>" name="file_lama"></input> 
             <input type="hidden" value="<?php echo $id_syarat_kompre ?>" name="id_syarat_kompre"></input><br> 
             <center><button class="btn btn-primary " type="submit" name="tombol_upload_file1">Submit</button></center>
           </div>
         </form>  
         <?php
       }
       ?>
     </td>
     <td>
       <?php
       $cekSyaratKompre = $this->m_kompre->cekSyaratKompre($_SESSION['npm']);
       $tema2= 'Pengecekan Berkas Transkip untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha';
       if($this->m_kompre->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Disetujui', $tema2)>0){
        echo '<b class="text-success">Berkas Tervalidasi</b>';
      }elseif($this->m_kompre->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Ditolak', $tema2)>0){
        ?>
        <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/kompre/upload_file')?>">
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
                 echo $this->m_kompre->alasan_ditolakk($id_syarat_kompre, $tema2) ?>
               </div>
             </div>
           </div>
         </div>   
         <a target="_BLANK" href="<?php echo base_url("templates/file/mahasiswa/syarat_kompre/transkip/".$file_transkrip) ?>">(Lihat File)</a><br>
         <input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>            
         <input type="hidden" value="<?php echo $file_transkrip ?>" name="file_lama"></input> 
         <input type="hidden" value="<?php echo $id_syarat_kompre ?>" name="id_syarat_kompre"></input><br> 
         <button class="btn btn-primary" type="submit" name="tombol_upload_file2">Submit</button>
       </div>
     </form>  
     <?php
   }elseif($cekSyaratKompre->num_rows()==0){
    echo '-';
  }else{
    ?>
    <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/kompre/upload_file')?>">
      <div class="form-group">
       <b class="text-warning">Menunggu Validasi</b>
       <a target="_BLANK" href="<?php echo base_url("templates/file/mahasiswa/syarat_kompre/transkip/".$file_transkrip) ?>">(Lihat File)</a><br>
       <input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>            
       <input type="hidden" value="<?php echo $file_transkrip ?>" name="file_lama"></input> 
       <input type="hidden" value="<?php echo $id_syarat_kompre ?>" name="id_syarat_kompre"></input><br> 
       <center><button class="btn btn-primary " type="submit" name="tombol_upload_file2">Submit</button></center>
     </div>
   </form>  
   <?php
 }
 ?>
</td>
<td>
 <?php
 $cekSyaratKompre = $this->m_kompre->cekSyaratKompre($_SESSION['npm']);
 $tema3= 'Pengecekan Berkas KRS untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha';
 if($this->m_kompre->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Disetujui', $tema3)>0){
  echo '<b class="text-success">Berkas Tervalidasi</b>';
}elseif($this->m_kompre->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Ditolak', $tema3)>0){
  ?>
  <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/kompre/upload_file')?>">
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
           echo $this->m_kompre->alasan_ditolakk($id_syarat_kompre, $tema3) ?>
         </div>
       </div>
     </div>
   </div>         <a target="_BLANK" href="<?php echo base_url("templates/file/mahasiswa/syarat_kompre/krs/".$file_krs) ?>">(Lihat File)</a><br>
   <input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>            
   <input type="hidden" value="<?php echo $file_krs ?>" name="file_lama"></input> 
   <input type="hidden" value="<?php echo $id_syarat_kompre ?>" name="id_syarat_kompre"></input><br> 
   <button class="btn btn-primary" type="submit" name="tombol_upload_file3">Submit</button>
 </div>
</form>  
<?php
}elseif($cekSyaratKompre->num_rows()==0){
  echo '-';
}else{
  ?>
  <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/kompre/upload_file')?>">
    <div class="form-group">
     <b class="text-warning">Menunggu Validasi</b>
     <a target="_BLANK" href="<?php echo base_url("templates/file/mahasiswa/syarat_kompre/krs/".$file_krs) ?>">(Lihat File)</a><br>
     <input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>            
     <input type="hidden" value="<?php echo $file_krs ?>" name="file_lama"></input> 
     <input type="hidden" value="<?php echo $id_syarat_kompre ?>" name="id_syarat_kompre"></input><br> 
     <center><button class="btn btn-primary " type="submit" name="tombol_upload_file3">Submit</button></center>
   </div>
 </form>  
 <?php
}
?>
</td>
<td>
 <?php
 $cekSyaratKompre = $this->m_kompre->cekSyaratKompre($_SESSION['npm']);
 $tema4= 'Pengecekan Berkas Sertifikat Alquran untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha';
 if($this->m_kompre->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Disetujui', $tema4)>0){
  echo '<b class="text-success">Berkas Tervalidasi</b>';
}elseif($this->m_kompre->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Ditolak', $tema4)>0){
  ?>
  <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/kompre/upload_file')?>">
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
           echo $this->m_kompre->alasan_ditolakk($id_syarat_kompre, $tema4) ?>
         </div>
       </div>
     </div>
   </div>         <a target="_BLANK" href="<?php echo base_url("templates/file/mahasiswa/syarat_kompre/sertifikat_alquran/".$sertifikat_alquran) ?>">(Lihat File)</a><br>
   <input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>            
   <input type="hidden" value="<?php echo $sertifikat_alquran ?>" name="file_lama"></input> 
   <input type="hidden" value="<?php echo $id_syarat_kompre ?>" name="id_syarat_kompre"></input><br> 
   <button class="btn btn-primary" type="submit" name="tombol_upload_file4">Submit</button>
 </div>
</form>  
<?php
}elseif($cekSyaratKompre->num_rows()==0){
  echo '-';
}else{
  ?>
  <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/kompre/upload_file')?>">
    <div class="form-group">
     <b class="text-warning">Menunggu Validasi</b>
     <a target="_BLANK" href="<?php echo base_url("templates/file/mahasiswa/syarat_kompre/sertifikat_alquran/".$sertifikat_alquran) ?>">(Lihat File)</a><br>
     <input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>            
     <input type="hidden" value="<?php echo $sertifikat_alquran ?>" name="file_lama"></input> 
     <input type="hidden" value="<?php echo $id_syarat_kompre ?>" name="id_syarat_kompre"></input><br> 
     <center><button class="btn btn-primary " type="submit" name="tombol_upload_file4">Submit</button></center>
   </div>
 </form>  
 <?php
}
?>
</td>
<td>
 <?php
 $cekSyaratKompre = $this->m_kompre->cekSyaratKompre($_SESSION['npm']);
 $tema5= 'Pengecekan Berkas Sertifikat Inggris untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha';
 if($this->m_kompre->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Disetujui', $tema5)>0){
  echo '<b class="text-success">Berkas Tervalidasi</b>';
}elseif($this->m_kompre->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Ditolak', $tema5)>0){
  ?>
  <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/kompre/upload_file')?>">
    <div class="form-group">
      <b class="btn text-danger" data-toggle="modal" data-target="#Modal5"><i class="fas fa-eye">Data ditolak </i></b>;
      <div class="modal fade" id="Modal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
           echo $this->m_kompre->alasan_ditolakk($id_syarat_kompre, $tema5) ?>
         </div>
       </div>
     </div>
   </div>         <a target="_BLANK" href="<?php echo base_url("templates/file/mahasiswa/syarat_kompre/sertifikat_inggris/".$sertifikat_inggris) ?>">(Lihat File)</a><br>
   <input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>            
   <input type="hidden" value="<?php echo $sertifikat_inggris ?>" name="file_lama"></input> 
   <input type="hidden" value="<?php echo $id_syarat_kompre ?>" name="id_syarat_kompre"></input><br> 
   <button class="btn btn-primary" type="submit" name="tombol_upload_file5">Submit</button>
 </div>
</form>  
<?php
}elseif($cekSyaratKompre->num_rows()==0){
  echo '-';
}else{
  ?>
  <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/kompre/upload_file')?>">
    <div class="form-group">
     <b class="text-warning">Menunggu Validasi</b>
     <a target="_BLANK" href="<?php echo base_url("templates/file/mahasiswa/syarat_kompre/sertifikat_inggris/".$sertifikat_inggris) ?>">(Lihat File)</a><br>
     <input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>            
     <input type="hidden" value="<?php echo $sertifikat_inggris ?>" name="file_lama"></input> 
     <input type="hidden" value="<?php echo $id_syarat_kompre ?>" name="id_syarat_kompre"></input><br> 
     <center><button class="btn btn-primary " type="submit" name="tombol_upload_file5">Submit</button></center>
   </div>
 </form>  
 <?php
}
?>
</td>
<td>
  <?php
  $cekSyaratKompre = $this->m_kompre->cekSyaratKompre($_SESSION['npm']);
  $tema6= 'Pengecekan Berkas Laporan Lengkap untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha';
  if($this->m_kompre->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Disetujui', $tema6)>0){
    echo '<b class="text-success">Berkas Tervalidasi</b>';
  }elseif($this->m_kompre->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Ditolak', $tema6)>0){
    ?>
    <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/kompre/upload_file')?>">
      <div class="form-group">
        <b class="btn text-danger" data-toggle="modal" data-target="#Modal6"><i class="fas fa-eye">Data ditolak </i></b>;
        <div class="modal fade" id="Modal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
             echo $this->m_kompre->alasan_ditolakk($id_syarat_kompre, $tema6) ?>
           </div>
         </div>
       </div>
     </div>           <a target="_BLANK" href="<?php echo base_url("templates/file/mahasiswa/syarat_kompre/laporan_lengkap/".$file_laporan) ?>">(Lihat File)</a><br>
     <input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>            
     <input type="hidden" value="<?php echo $file_laporan ?>" name="file_lama"></input> 
     <input type="hidden" value="<?php echo $id_syarat_kompre ?>" name="id_syarat_kompre"></input><br> 
     <button class="btn btn-primary" type="submit" name="tombol_upload_file6">Submit</button>
   </div>
 </form>  
 <?php
}elseif($cekSyaratKompre->num_rows()==0){
  echo '-';
}else{
  ?>
  <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/kompre/upload_file')?>">
    <div class="form-group">
     <b class="text-warning">Menunggu Validasi</b>
     <a target="_BLANK" href="<?php echo base_url("templates/file/mahasiswa/syarat_kompre/laporan_lengkap/".$file_laporan) ?>">(Lihat File)</a><br>
     <input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>            
     <input type="hidden" value="<?php echo $file_laporan ?>" name="file_lama"></input> 
     <input type="hidden" value="<?php echo $id_syarat_kompre ?>" name="id_syarat_kompre"></input><br> 
     <center><button class="btn btn-primary " type="submit" name="tombol_upload_file6">Submit</button></center>
   </div>
 </form>  
 <?php
}
?>
</td>
<td>
 <?php
 $cekSyaratKompre = $this->m_kompre->cekSyaratKompre($_SESSION['npm']);
 if($this->m_kompre->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Disetujui','Pengecekan Berkas Persyaratan Sidang Skripsi Mahasiswa oleh Tata Usaha')>0){
  echo '<b class="text-success">Persyaratan Sidang Skripsi di Setujui Tata Usaha, Silahkan Tunggu Jadwal Ujian</b>';
}elseif($this->m_kompre->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Ditolak','Pengecekan Berkas Persyaratan Sidang Skripsi Mahasiswa oleh Tata Usaha')>0){
  echo '<b class="btn text-danger" data-toggle="modal" data-target="#ModalAlasanDitolakTU4'.$id_syarat_kompre.'"><i class="fas fa-eye">Data ditolak </i></b>';
  ?>
  <!-- MODAL ALASAN DITOLAK TU -->
  <div class="modal fade" id="ModalAlasanDitolakTU4<?= $id_syarat_kompre ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
          foreach ($this->m_kompre->alasan_ditolak($npm, $id_syarat_kompre) as $n): ?>
          <?php echo $n['alasan_ditolak'];?>
        <?php endforeach ?>
      </div>
    </div>
  </div>
</div>
<?php 
}elseif($cekSyaratKompre->num_rows()>0){
  echo '<b class="text-warning">Menunggu Validasi Berkas</b>';
}elseif($cekSyaratKompre->num_rows()==0){
  echo '-';
}else{
  echo '-';
}
?>
</td>
<td>
  <?php 
  if (isset($id_syarat_kompre)) {
    $cekKonfirmasi = $this->m_penilaian->cekKonfirmasi($id_syarat_kompre);
    if($cekKonfirmasi<=0){
      echo '-';
    }else{
    // echo round($this->m_penilaian->NilaiSkripsi($id_syarat_sempro, $id_syarat_kompre)); 
      echo $this->m_penilaian->Konversi($id_syarat_sempro, $id_syarat_kompre); 
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
<?php }else{ echo '<marquee><h3 class="text-danger">Belum disetujui Dosen Pembimbing untuk Daftar Sidang Skripsi..</h3></marquee>'; } ?>
</div>
</div>

<!-- MODAL TAMBAH DATA PENGAJUAN SK -->
<div class="modal fade" id="Modalpengajuan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel"><b class="text-primary">Pengajuan Sidang Skripsi</b></h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    <div class="modal-body">
      <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/kompre/tambah_data')?>">
       <div class="form-group">
        <label>Usulan Tanggal Ujian</label>
        <input type="hidden" value="<?= "2" ?>" name="id_seminar" class="form-control"></input>
        <input type="date" name="usulan_tanggal" class="form-control" required=""></input>
      </div>
      <div class="form-group">
        <label>Usulan Jam Ujian</label>
        <input type="time" name="usulan_jam" class="form-control" required=""></input>
      </div>
      <div class="form-group">
        <label class="bmd-label-floating">Upload Bukti Pembayaran SPP Dasar Semester yang sedang Berjalan (Upload yang dari SIKAD)<small class="text-primary"> *Format PDF</small></label>
        <input type="file" accept="application/pdf"  class="form-control-file" name="file_spp" id="file_spp" required>
      </div>
      <div class="form-group">
        <label class="bmd-label-floating">Upload Bukti Transkrip Nilai Sementara<small class="text-primary"> *Format PDF</small></label>
        <input type="file" accept="application/pdf"  class="form-control-file" name="file_transkrip" id="file_transkrip" required>
      </div>
      <div class="form-group">
        <label class="bmd-label-floating">Upload Bukti KRS Cap Lunas<small class="text-primary"> *Format PDF</small></label>
        <input type="file" accept="application/pdf"  class="form-control-file" name="file_krs" id="file_krs" required>
      </div>
      <div class="form-group">
        <label class="bmd-label-floating">Sertifikat Kemampuan Baca Al-Quran<small class="text-primary"> *Format PDF</small></label>
        <input type="file" accept="application/pdf"  class="form-control-file" name="sertifikat_alquran" id="sertifikat_alquran" required>
      </div>
      <div class="form-group">
        <label class="bmd-label-floating">Sertifikat Kemampuan Bahasa Inggris (TOEFL/IELTS)<small class="text-primary"> *Format PDF</small></label>
        <input type="file" accept="application/pdf"  class="form-control-file" name="sertifikat_inggris" id="sertifikat_inggris" required>
      </div>
      <div class="form-group">
        <label class="bmd-label-floating">File Laporan Lengkap<small class="text-primary"> *Format PDF</small></label>
        <input type="file" accept="application/pdf"  class="form-control-file" name="file_laporan" id="file_laporan" required>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="reset" data-dismiss="modal">Tutup</button>
        <button class="btn btn-primary" type="submit" name="tombolInputSyaratKompre">Submit</button>
      </div>
    </form>  
  </div>
</div>
</div>
</div>


<!-- MODAL LIHAT DATA PENGAJUAN SK -->
<div class="modal fade" id="ModalLihat" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel"><b class="text-success">Detail Usulan Jadwal Ujian</b></h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    <div class="modal-body">
      <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/sk/edit_data')?>">
        <div class="form-group">
          <label class="text-primary"><b class="text-warning">Usulan Tanggal Ujian : </b></label>
          <?= $this->m_kompre->format_tanggal(date('Y-m-d', strtotime($usulan_tanggal))); ?>
          <br>
          <label class="text-primary"><b class="text-warning">Usulan Jam Ujian : </b></label>
          <?php echo date("H:i:s", strtotime($usulan_jam));?>
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

?>
