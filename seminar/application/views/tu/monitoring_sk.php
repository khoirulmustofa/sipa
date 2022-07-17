<div class="col-lg-12 mb-1">
  <?php echo $this->session->flashdata('messege'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">PENGAJUAN SK MAHASISWA</h5>
    </div><br>
    <div class="content">
      <div class="container-fluid">
        <div class="card shadow mb-4">
          <div class="card-body">
           <form action="<?php echo site_url().'/tu/monitoring_sk'; ?>" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>PILIH PRODI</label>
                  <select name="kode_prodi" class="form-control" required>
                    <option value="">
                      --Pilih--
                    </option>
                    <option value="0" <?php if(!isset($_SESSION['kode_prodi'])){ echo 'selected'; } ?>>
                      Semua
                    </option>
                    <?php foreach ($combobox_prodi as $item): ?>
                      <option value="<?php echo $item['kode_prodi']  ?>" <?php if(isset($_SESSION['kode_prodi'])){ if($_SESSION['kode_prodi']==$item['kode_prodi']){ echo 'selected'; } } ?> ><?php echo $item['nama_prodi']  ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>AKSI</label><br>
                  <input type="submit" name="tombol_cari" value="Tampilkan Data" class="btn btn-primary">
                </div>
              </div>
            </div>
          </form><hr>
          <div class="table-responsive">
            <div class="scroll">
              <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead class="table table-primary">
                  <tr>
                    <td align="center"><b>NO.</b></td>
                    <td align="center"><b>NPM</b></td>
                    <td align="center"><b>PRODI</b></td>
                    <td align="center"><b>NAMA</b></td>
                    <td align="center"><b>NO. WHATSAPP</b></td>
                    <td align="center"><b>KEPERLUAN</b></td>
                    <td align="center"><b>WAKTU UPLOAD</b></td>
                    <td align="center"><b>STATUS  DATA</b></td>
                    <td align="center"><b>DETAIL</b></td>
                    <td align="center"><b>AKSI</b></td>
                    <td align="center"><b>DURASI</b></td>
                    <td align="center"><b>BERKAS SK</b></td>
                    <td align="center"><b>AKUN PEMBIMBING LAPANGAN</b></td>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no = 1;
                  foreach ($pencarian_data as $i):
                    $id_syarat_sk             = $i['id_syarat_sk'];
                  $nama_prodi                 = $i['nama_prodi'];
                  $no_hp                      = $i['no_hp'];
                  $nama_mahasiswa             = $i['nama_mahasiswa'];
                  $nama_pembimbing_lapangan             = $i['nama_pembimbing_lapangan'];
                  $email_pembimbing_lapangan  = $i['email_pembimbing_lapangan'];
                  $nama_jenis_sk              = $i['nama_jenis_sk'];
                  $npm                        = $i['npm'];
                  $tgl_upload_syarat_sk       = $i['tgl_upload_syarat_sk'];
                  $tema_persetujuan           = $i['tgl_upload_syarat_sk'];
                  ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $npm;?></td>
                    <td><?php echo $nama_prodi;?></td>
                    <td><?php echo ucwords($nama_mahasiswa);?></td>
                    <td>                 
                      <a href="whatsapp://send?text=Assalamu'alaikum.Wr.Wb...&phone=+62<?php echo $no_hp;?>" >
                        <?php echo $no_hp;?>
                      </a>
                    </td>

                    <td><?php echo $nama_jenis_sk;?></td>
                    <td>
                      <?= $this->m_monitoring_sk->format_tanggal(date('Y-m-d', strtotime($tgl_upload_syarat_sk))); ?>
                    </td>
                    <td>
                     <?php
                     $tema = "Pengecekan Berkas Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha";
                     $cekSyaratSK = $this->m_monitoring_sk->cekResponTU($id_syarat_sk, $tema);
                     if($this->m_monitoring_sk->cekStatusPersetujuanTU($id_syarat_sk, $tema, 'Berkas Disetujui')>0){
                      echo '<b class="text-success">Berkas Disetujui</b>';
                    }elseif($this->m_monitoring_sk->cekStatusPersetujuanTU($id_syarat_sk, $tema, 'Berkas Ditolak')>0){
                      echo '<b class="text-danger">Berkas Ditolak</b>';
                    }elseif($cekSyaratSK>0){
                      echo '<b class="text-warning">Meminta Validasi Berkas</b>';
                    }elseif($cekSyaratSK==0){
                      echo '<b class="text-warning">Meminta Validasi Berkas</b>';
                    }else{
                      echo '<b class="text-warning">Meminta Validasi Berkas</b>';
                    }
                    ?>
                  </td>
                  <td>
                    <i class="fas fa-eye text-primary" data-toggle="modal" data-target="#Modallihat<?php echo $id_syarat_sk  ?>"></i>
                  </td>
                  <td>
                    <?php 
                    $tema = "Pengecekan Berkas Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha";
                    if ($this->m_monitoring_sk->cekResponTU($id_syarat_sk, $tema)<=0) {  
                      if($this->m_monitoring_sk->cekPersetujuanSemuaBerkas2($id_syarat_sk)==1){    
                        ?>
                        <input type="submit" id="setuju_final<?= $id_syarat_sk ?>" name="tombol_setuju" value="Setujui" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modalsetuju<?php echo $id_syarat_sk  ?>">
                        <input type="submit" id="tolak_final<?= $id_syarat_sk ?>" name="tombol_tolak" value="Tolak" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modaltolak<?php echo $id_syarat_sk  ?>">
                        <?php 
                      }else{
                        echo '<div id="text_final'.$id_syarat_sk.'">Semua berkas belum disetujui</div>';
                        ?>
                        <div id="tombol_final<?= $id_syarat_sk ?>" hidden>
                          <input type="submit" id="setuju_final<?= $id_syarat_sk ?>" name="tombol_setuju" value="Setujui" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modalsetuju<?php echo $id_syarat_sk  ?>">
                          <input type="submit" id="tolak_final<?= $id_syarat_sk ?>" name="tombol_tolak" value="Tolak" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modaltolak<?php echo $id_syarat_sk  ?>">
                        </div>
                        <?php
                      }
                    }else{ 
                      ?>
                      <i class="text-primary">Sudah Direspon</i>
                      <?php } ?>
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
                        $cekSK = $this->m_monitoring_sk->cekResponSKFakultas($id_syarat_sk);
                        if($cekSK>0){
                          ?> 
                          <a target="_BLANK" href="<?php echo site_url('/tu/monitoring_sk/cetak_sk_pembimbing_kp/').$id_syarat_sk ?>"><i class="fas fa-download text-success"> Unduh</i></a>
                          <?php
                        } else {
                          echo 'Tidak Ada Berkas';
                        }              
                      } else{
                        echo '-';
                      }
                      ?>
                    </td>
                    <td align="left">
                      <input type="submit" name="tombol_setuju" value="Kirim Ulang" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalUlang<?php echo $id_syarat_sk  ?>">
                      <div class="modal fade" id="ModalUlang<?php echo $i['id_syarat_sk']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel" >Kirim Ulang Akun Pembimbing lapangan</h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <form action="<?php echo site_url('/tu/monitoring_sk/akun_pembimbing_lapangan') ?>" method ="post">
                              <div class="modal-body"> 
                                <label>Email Pembimbing Lapangan</label>
                                <input type="text" name="email_pembimbing_lapangan" class="form-control" value="<?php echo ucwords($i['email_pembimbing_lapangan']) ?>" ></input>
                                <input type="hidden" value="<?= $id_syarat_sk ?>" name="id_syarat_sk" class="form-control"></input>
                                <input type="hidden" value="<?= $nama_mahasiswa ?>" name="nama_mahasiswa" class="form-control"></input>
                                <input type="hidden" value="<?= $nama_pembimbing_lapangan ?>" name="nama_pembimbing_lapangan" class="form-control"></input>
                              </div>
                              <div class="modal-footer">
                                <button class="btn btn-primary" type="submit" name="tombolKirim">Kirim</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <?php 
                  endforeach; 
                  ?>                                 
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- MODAL LIHAT DATA PENGAJUAN SK -->
<?php 
$no = 1;
foreach ($pencarian_data as $i):
  $id_syarat_sk         = $i['id_syarat_sk'];
$nama_mahasiswa       = $i['nama_mahasiswa'];
$nama_jenis_sk        = $i['nama_jenis_sk'];
$npm                  = $i['npm'];
$judul_kerja_praktik  = $i['judul_kerja_praktik'];
$tgl_upload_syarat_sk = $i['tgl_upload_syarat_sk'];
$no_hp = $i['no_hp'];
?>
<div class="modal fade" id="Modallihat<?php echo $i['id_syarat_sk']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Pengajuan Tempat Praktek Kerja Lapangan Mahasiswa</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"> 
        <div class="form-group">
          <label>Nama Mahasiswa</label>
          <input type="text" class="form-control" value="<?php echo ucwords($i['nama_mahasiswa']).' ('.$i['npm'].')'; ?>" readonly></input>
        </div>
        <div class="form-group">
          <label>No. HP</label>
          <input type="text" name="nama_tempat_kp" class="form-control" value="<?php echo $i['no_hp']?>" readonly></input>
        </div>
        <div class="form-group">
          <label>Nama Tempat Praktek</label>
          <input type="text" name="nama_tempat_kp" class="form-control" value="<?php echo ucwords($i['nama_instansi'])?>" readonly></input>
        </div>
        <div class="form-group">
          <label>Judul</label>
          <input type="text" name="judul_kerja_praktik" class="form-control" value="<?= ucwords($i['judul_kerja_praktik']) ?>"readonly></input>
        </div>
        <div class="form-group">
          <label>Nama Pembimbing Lapangan</label>
          <input type="text" name="nama_pembimbing_lapangan" class="form-control" value="<?php echo ucwords($i['nama_pembimbing_lapangan']) ?>" readonly></input>
        </div>
        <div class="form-group">
          <label>No. HP Pembimbing</label>
          <input type="number" name="no_hp_pembimbing_lapangan" class="form-control" value="<?php echo $i['no_hp_pembimbing_lapangan']?>" readonly></input>
        </div>
        <div class="form-group">
          <label>Email Pembimbing Lapangan</label>
          <input type="text" name="email_pembimbing_lapangan" class="form-control" value="<?php echo $i['email_pembimbing_lapangan']?>" readonly></input>
        </div>
        <div class="form-group">
          <label>Waktu Mulai</label>
          <input type="date" name="waktu_mulai_kp" class="form-control" value="<?php echo $i['waktu_mulai_kp']?>" readonly></input>
        </div>
        <div class="form-group">
          <label>Waktu Selesai</label>
          <input type="date" name="waktu_selesai_kp" class="form-control" value="<?php echo $i['waktu_selesai_kp']?>" readonly></input>
        </div>
        <div class="form-group">
          <label class="bmd-label-floating">Lihat Berkas</label><br>
          <table border="1" width="100%" cellspacing="1" cellpadding="2">
            <tr>
              <td>
                <a target="_BLANK" id="open_file1<?= $id_syarat_sk ?>" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/sk/'.$i['nama_file_syarat_sk']) ?>">Bukti Penerimaan Kerja Praktek Lapangan di Perusahaan/Instansi Terkait</a><br>
              </td>
              <td class="text-center">
               <?php 
               $tema = "Pengecekan Berkas Bukti Penerimaan Lapangan untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha";
               if ($this->m_monitoring_sk->cekResponTU($id_syarat_sk, $tema)>0) { 
                $cekSyaratSK = $this->m_monitoring_sk->cekResponTU($id_syarat_sk, $tema);
                if($this->m_monitoring_sk->cekStatusPersetujuanTU($id_syarat_sk, $tema, 'Berkas Disetujui')>0){
                  echo '<b class="text-success">Berkas Disetujui</b>';
                }else{
                  echo '<b class="text-danger">Berkas Ditolak</b>';}
                  ?>
                  <!-- <div>Sudah Direspon</div> -->
                  <?php 
                }else{ 
                  $open_file = "Bukti Penerimaan Lapangan untuk Pengajuan SK Kerja Praktik Mahasiswa";
                  if ($this->m_monitoring_sk->cekOpenFile($id_syarat_sk, $open_file)>0) {
                    $hidden = "";
                  }else{
                    $hidden = "hidden";
                  }
                  ?>
                  <input type="submit" name="tombol_setuju" id="tombol_setuju_1<?= $id_syarat_sk ?>" value="Setujui" class="btn btn-primary btn-sm" <?= $hidden ?> >

                  <input data-toggle="modal" data-target="#ModaltolakSatuan1<?php echo $i['id_syarat_sk'] ?>" type="button" id="tombol_tolak_1<?= $id_syarat_sk ?>" value="Tolak" class="btn btn-danger btn-sm" <?= $hidden ?> >

                  <div id="success_text_1<?= $id_syarat_sk ?>"></div>
                  <?php  } ?>
                </td>   
                <td>
                  <input type="submit" name="tombol_reset" value="Reset" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#resetberkas1<?php echo $id_syarat_sk  ?>">
                  <div class="modal fade" id="resetberkas1<?php echo $i['id_syarat_sk']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel" >Reset Persetujuan Berkas</h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <form action="<?php echo site_url('/tu/monitoring_sk/reset_persetujuan1') ?>" method ="post">
                          <div class="modal-body"> 
                            <input type="hidden" name="id_syarat_sk" value="<?php echo $i['id_syarat_sk']  ?>"></input>
                            <label>Apakah yakin ingin mereset persetujuan berkas ?</label>
                          </div>
                          <div class="modal-footer">
                            <!-- <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button> -->
                            <button class="btn btn-secondary" type="submit" name="tombolReset">Reset</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </td>   
                <script>
                 $(document).ready(function() {
                  $('#open_file1<?= $id_syarat_sk ?>').on('click', function() {
                    var id_syarat_sk = "<?= $id_syarat_sk ?>";
                    $.ajax({
                      url: "<?php echo site_url("/tu/monitoring_sk/open_file");?>",
                      type: "POST",
                      data: {
                        id_syarat_sk: id_syarat_sk,
                        file_open: 'Bukti Penerimaan Lapangan untuk Pengajuan SK Kerja Praktik Mahasiswa',
                      },
                      cache: false,
                      success: function(response){
                        document.getElementById("tombol_setuju_1<?= $id_syarat_sk ?>").hidden = false;
                        document.getElementById("tombol_tolak_1<?= $id_syarat_sk ?>").hidden = false;
                      },
                      error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                      }  
                    });
                  });
                });

                 $(document).ready(function() {
                  $('#tombol_setuju_1<?= $id_syarat_sk ?>').on('click', function() {
                    var id_syarat_sk = "<?= $id_syarat_sk ?>";
                    $.ajax({
                      url: "<?php echo site_url("/tu/monitoring_sk/setuju_berkas");?>",
                      type: "POST",
                      data: {
                        id_syarat_sk: id_syarat_sk,
                        status_persetujuan: 'Berkas Disetujui',
                        tema_persetujuan: 'Pengecekan Berkas Bukti Penerimaan Lapangan untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha'
                      },
                      cache: false,
                      success: function(response){

                        const jsonObject = JSON.parse(response);
                        var hasil1 = jsonObject[0].hasil1;
                        var hasil2 = jsonObject[0].hasil2;
                        var hasil3 = jsonObject[0].hasil3;
                        var hasil4 = jsonObject[0].hasil4;
                        if(hasil1==1 && hasil2==1 && hasil3 && hasil4==1){
                          document.getElementById("tombol_final<?= $id_syarat_sk ?>").hidden = false;
                          document.getElementById("text_final<?= $id_syarat_sk ?>").hidden = true;
                        }
                        document.getElementById("success_text_1<?= $id_syarat_sk ?>").innerText = "Berkas disetujui";
                        document.getElementById("tombol_setuju_1<?= $id_syarat_sk ?>").hidden = true;
                        document.getElementById("tombol_tolak_1<?= $id_syarat_sk ?>").hidden = true;
                      },
                      error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                      }  
                    });
                  });
                });


              </script>                   
            </tr>
            <tr>
              <td>
                <a target="_BLANK" id="open_file2<?= $id_syarat_sk ?>" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/sk/spp/'.$i['file_spp_dasar']) ?>">Bukti Pembayaran SPP Dasar</a><br>
              </td>
              <td class="text-center">
               <?php 
               $tema = "Pengecekan Berkas SPP dasar untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha";
               if ($this->m_monitoring_sk->cekResponTU($id_syarat_sk, $tema)>0) { 

                $cekSyaratSK = $this->m_monitoring_sk->cekResponTU($id_syarat_sk, $tema);
                if($this->m_monitoring_sk->cekStatusPersetujuanTU($id_syarat_sk, $tema, 'Berkas Disetujui')>0){
                  echo '<b class="text-success">Berkas Disetujui</b>';
                }else{
                  echo '<b class="text-danger">Berkas Ditolak</b>';}
                  ?>
                  <!-- <div>Sudah Direspon</div> -->

                  <?php 
                }else{ 
                  $open_file = "Pengecekan Berkas SPP dasar untuk Pengajuan SK Kerja Praktik Mahasiswa";
                  if ($this->m_monitoring_sk->cekOpenFile($id_syarat_sk, $open_file)>0) {
                    $hidden = "";
                  }else{
                    $hidden = "hidden";
                  }
                  ?>
                  <input type="submit" name="tombol_setuju" id="tombol_setuju_2<?= $id_syarat_sk ?>" value="Setujui" class="btn btn-primary btn-sm" <?= $hidden ?> >
                  <!-- <input type="submit" name="tombol_tolak" value="Tolak" class="btn btn-danger btn-sm" id="tombol_tolak_2<?= $id_syarat_sk ?>" <?= $hidden ?> > -->
                  <input data-toggle="modal" data-target="#ModaltolakSatuan2<?php echo $i['id_syarat_sk'] ?>" type="button" id="tombol_tolak_2<?= $id_syarat_sk ?>" value="Tolak" class="btn btn-danger btn-sm" <?= $hidden ?> >

                  <div id="success_text_2<?= $id_syarat_sk ?>"></div>
                  <?php  } ?>
                </td>    
                <td>
                  <input type="submit" name="tombol_reset" value="Reset" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#resetberkas2<?php echo $id_syarat_sk  ?>">
                  <div class="modal fade" id="resetberkas2<?php echo $i['id_syarat_sk']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel" >Reset Persetujuan Berkas</h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <form action="<?php echo site_url('/tu/monitoring_sk/reset_persetujuan2') ?>" method ="post">
                          <div class="modal-body"> 
                            <input type="hidden" name="id_syarat_sk" value="<?php echo $i['id_syarat_sk']  ?>"></input>
                            <label>Apakah yakin ingin mereset persetujuan berkas ?</label>
                          </div>
                          <div class="modal-footer">
                            <!-- <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button> -->
                            <button class="btn btn-secondary" type="submit" name="tombolReset">Reset</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </td>     
                <script>
                  $(document).ready(function() {
                    $('#open_file2<?= $id_syarat_sk ?>').on('click', function() {
                      var id_syarat_sk = "<?= $id_syarat_sk ?>";
                      $.ajax({
                        url: "<?php echo site_url("/tu/monitoring_sk/open_file");?>",
                        type: "POST",
                        data: {
                          id_syarat_sk: id_syarat_sk,
                          file_open: 'Pengecekan Berkas SPP dasar untuk Pengajuan SK Kerja Praktik Mahasiswa',
                        },
                        cache: false,
                        success: function(response){

                          document.getElementById("tombol_setuju_2<?= $id_syarat_sk ?>").hidden = false;
                          document.getElementById("tombol_tolak_2<?= $id_syarat_sk ?>").hidden = false;
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                          alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                        }  
                      });
                    });
                  });

                  $(document).ready(function() {
                    $('#tombol_setuju_2<?= $id_syarat_sk ?>').on('click', function() {
                      var id_syarat_sk = "<?= $id_syarat_sk ?>";
                      $.ajax({
                        url: "<?php echo site_url("/tu/monitoring_sk/setuju_berkas");?>",
                        type: "POST",
                        data: {
                          id_syarat_sk: id_syarat_sk,
                          status_persetujuan: 'Berkas Disetujui',
                          tema_persetujuan: 'Pengecekan Berkas SPP dasar untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha'
                        },
                        cache: false,
                        success: function(response){  
                          const jsonObject = JSON.parse(response);
                          var hasil1 = jsonObject[0].hasil1;
                          var hasil2 = jsonObject[0].hasil2;
                          var hasil3 = jsonObject[0].hasil3;
                          var hasil4 = jsonObject[0].hasil4;
                          if(hasil1==1 && hasil2==1 && hasil3 && hasil4==1){
                            document.getElementById("tombol_final<?= $id_syarat_sk ?>").hidden = false;
                            document.getElementById("text_final<?= $id_syarat_sk ?>").hidden = true;
                          }
                          document.getElementById("success_text_2<?= $id_syarat_sk ?>").innerText = "Berkas disetujui";
                          document.getElementById("tombol_setuju_2<?= $id_syarat_sk ?>").hidden = true;
                          document.getElementById("tombol_tolak_2<?= $id_syarat_sk ?>").hidden = true;
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                          alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                        }   
                      });
                    });
                  });


                </script>         
              </tr>
              <tr>
                <td>
                  <a target="_BLANK" id="open_file3<?= $id_syarat_sk ?>" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/sk/transkrip/'.$i['file_transkrip']) ?>">Bukti Transkip Nilai Sementara</a>
                </td>

                <td class="text-center">
                  <?php 
                  $tema = "Pengecekan Berkas Transkip Nilai Sementara untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha";
                  if ($this->m_monitoring_sk->cekResponTU($id_syarat_sk, $tema)>0) { 
                    $cekSyaratSK = $this->m_monitoring_sk->cekResponTU($id_syarat_sk, $tema);
                    if($this->m_monitoring_sk->cekStatusPersetujuanTU($id_syarat_sk, $tema, 'Berkas Disetujui')>0){
                      echo '<b class="text-success">Berkas Disetujui</b>';
                    }else{
                      echo '<b class="text-danger">Berkas Ditolak</b>';}
                      ?>
                      <!-- <div>Sudah Direspon</div> -->
                      <?php 
                    }else{ 
                      $open_file = "Pengecekan Berkas Transkip Nilai Sementara untuk Pengajuan SK Kerja Praktik Mahasiswa";
                      if ($this->m_monitoring_sk->cekOpenFile($id_syarat_sk, $open_file)>0) {
                        $hidden = "";
                      }else{
                        $hidden = "hidden";
                      }
                      ?>
                      <input type="submit" name="tombol_setuju" id="tombol_setuju_3<?= $id_syarat_sk ?>" value="Setujui" class="btn btn-primary btn-sm" <?= $hidden ?> >

                      <input data-toggle="modal" data-target="#ModaltolakSatuan3<?php echo $i['id_syarat_sk'] ?>" type="button" id="tombol_tolak_3<?= $id_syarat_sk ?>" value="Tolak" class="btn btn-danger btn-sm" <?= $hidden ?> >

                      <div id="success_text_3<?= $id_syarat_sk ?>"></div>
                      <?php  } ?>
                    </td> 
                    <td>
                      <input type="submit" name="tombol_reset" value="Reset" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#resetberkas3<?php echo $id_syarat_sk  ?>">
                      <div class="modal fade" id="resetberkas3<?php echo $i['id_syarat_sk']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel" >Reset Persetujuan Berkas</h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <form action="<?php echo site_url('/tu/monitoring_sk/reset_persetujuan3') ?>" method ="post">
                              <div class="modal-body"> 
                                <input type="hidden" name="id_syarat_sk" value="<?php echo $i['id_syarat_sk']  ?>"></input>
                                <label>Apakah yakin ingin mereset persetujuan berkas ?</label>
                              </div>
                              <div class="modal-footer">
                                <!-- <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button> -->
                                <button class="btn btn-secondary" type="submit" name="tombolReset">Reset</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </td>        
                    <script>
                      $(document).ready(function() {
                        $('#open_file3<?= $id_syarat_sk ?>').on('click', function() {
                          var id_syarat_sk = "<?= $id_syarat_sk ?>";
                          $.ajax({
                            url: "<?php echo site_url("/tu/monitoring_sk/open_file");?>",
                            type: "POST",
                            data: {
                              id_syarat_sk: id_syarat_sk,
                              file_open: 'Pengecekan Berkas Transkip Nilai Sementara untuk Pengajuan SK Kerja Praktik Mahasiswa',
                            },
                            cache: false,
                            success: function(response){

                              document.getElementById("tombol_setuju_3<?= $id_syarat_sk ?>").hidden = false;
                              document.getElementById("tombol_tolak_3<?= $id_syarat_sk ?>").hidden = false;
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                              alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                            }  
                          });
                        });
                      });
                      $(document).ready(function() {
                        $('#tombol_setuju_3<?= $id_syarat_sk ?>').on('click', function() {
                          var id_syarat_sk = "<?= $id_syarat_sk ?>";
                          $.ajax({
                            url: "<?php echo site_url("/tu/monitoring_sk/setuju_berkas");?>",
                            type: "POST",
                            data: {
                              id_syarat_sk: id_syarat_sk,
                              status_persetujuan: 'Berkas Disetujui',
                              tema_persetujuan: 'Pengecekan Berkas Transkip Nilai Sementara untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha'
                            },
                            cache: false,
                            success: function(response){  
                              const jsonObject = JSON.parse(response);
                              var hasil1 = jsonObject[0].hasil1;
                              var hasil2 = jsonObject[0].hasil2;
                              var hasil3 = jsonObject[0].hasil3;
                              var hasil4 = jsonObject[0].hasil4;
                              if(hasil1==1 && hasil2==1 && hasil3 && hasil4==1){
                                document.getElementById("tombol_final<?= $id_syarat_sk ?>").hidden = false;
                                document.getElementById("text_final<?= $id_syarat_sk ?>").hidden = true;
                              }
                              document.getElementById("success_text_3<?= $id_syarat_sk ?>").innerText = "Berkas disetujui";
                              document.getElementById("tombol_setuju_3<?= $id_syarat_sk ?>").hidden = true;
                              document.getElementById("tombol_tolak_3<?= $id_syarat_sk ?>").hidden = true;
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                              alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                            }   
                          });
                        });
                      });

                    </script>     
                  </tr>
                  <tr>
                    <td>
                      <a target="_BLANK" id="open_file4<?= $id_syarat_sk ?>" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/sk/laporan/'.$i['file_laporan']) ?>">File Laporan KP</a>
                    </td>

                    <td class="text-center">
                      <?php 
                      $tema = "Pengecekan File Laporan KP untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha";
                      if ($this->m_monitoring_sk->cekResponTU($id_syarat_sk, $tema)>0) { 
                       $cekSyaratSK = $this->m_monitoring_sk->cekResponTU($id_syarat_sk, $tema);
                       if($this->m_monitoring_sk->cekStatusPersetujuanTU($id_syarat_sk, $tema, 'Berkas Disetujui')>0){
                        echo '<b class="text-success">Berkas Disetujui</b>';
                      }else{
                        echo '<b class="text-danger">Berkas Ditolak</b>';
                      }
                      ?>
                      <!-- <div>Sudah Direspon</div> -->
                      <?php 
                    }else{ 
                      $open_file = "Pengecekan File Laporan KP untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha";
                      if ($this->m_monitoring_sk->cekOpenFile($id_syarat_sk, $open_file)>0) {
                        $hidden = "";
                      }else{
                        $hidden = "hidden";
                      }
                      ?>
                      <input type="submit" name="tombol_setuju" id="tombol_setuju_4<?= $id_syarat_sk ?>" value="Setujui" class="btn btn-primary btn-sm" <?= $hidden ?> >

                      <input data-toggle="modal" data-target="#ModaltolakSatuan4<?php echo $i['id_syarat_sk'] ?>" type="button" id="tombol_tolak_4<?= $id_syarat_sk ?>" value="Tolak" class="btn btn-danger btn-sm" <?= $hidden ?> >

                      <div id="success_text_4<?= $id_syarat_sk ?>"></div>
                      <?php  } ?>
                    </td>    
                    <td>
                      <input type="submit" name="tombol_reset" value="Reset" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#resetberkas4<?php echo $id_syarat_sk  ?>">
                      <div class="modal fade" id="resetberkas4<?php echo $i['id_syarat_sk']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel" >Reset Persetujuan Berkas</h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <form action="<?php echo site_url('/tu/monitoring_sk/reset_persetujuan4') ?>" method ="post">
                              <div class="modal-body"> 
                                <input type="hidden" name="id_syarat_sk" value="<?php echo $i['id_syarat_sk']  ?>"></input>
                                <label>Apakah yakin ingin mereset persetujuan berkas ?</label>
                              </div>
                              <div class="modal-footer">
                                <!-- <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button> -->
                                <button class="btn btn-secondary" type="submit" name="tombolReset">Reset</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </td>     
                    <script>
                      $(document).ready(function() {
                        $('#open_file4<?= $id_syarat_sk ?>').on('click', function() {
                          var id_syarat_sk = "<?= $id_syarat_sk ?>";
                          $.ajax({
                            url: "<?php echo site_url("/tu/monitoring_sk/open_file");?>",
                            type: "POST",
                            data: {
                              id_syarat_sk: id_syarat_sk,
                              file_open: 'Pengecekan File Laporan KP untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha',
                            },
                            cache: false,
                            success: function(response){

                              document.getElementById("tombol_setuju_4<?= $id_syarat_sk ?>").hidden = false;
                              document.getElementById("tombol_tolak_4<?= $id_syarat_sk ?>").hidden = false;
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                              alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                            }  
                          });
                        });
                      });
                      $(document).ready(function() {
                        $('#tombol_setuju_4<?= $id_syarat_sk ?>').on('click', function() {
                          var id_syarat_sk = "<?= $id_syarat_sk ?>";
                          $.ajax({
                            url: "<?php echo site_url("/tu/monitoring_sk/setuju_berkas");?>",
                            type: "POST",
                            data: {
                              id_syarat_sk: id_syarat_sk,
                              status_persetujuan: 'Berkas Disetujui',
                              tema_persetujuan: 'Pengecekan File Laporan KP untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha'
                            },
                            cache: false,
                            success: function(response){  
                              const jsonObject = JSON.parse(response);
                              var hasil1 = jsonObject[0].hasil1;
                              var hasil2 = jsonObject[0].hasil2;
                              var hasil3 = jsonObject[0].hasil3;
                              var hasil4 = jsonObject[0].hasil4;
                              if(hasil1==1 && hasil2==1 && hasil3 && hasil4==1){
                                document.getElementById("tombol_final<?= $id_syarat_sk ?>").hidden = false;
                                document.getElementById("text_final<?= $id_syarat_sk ?>").hidden = true;
                              }
                              document.getElementById("success_text_4<?= $id_syarat_sk ?>").innerText = "Berkas disetujui";
                              document.getElementById("tombol_setuju_4<?= $id_syarat_sk ?>").hidden = true;
                              document.getElementById("tombol_tolak_4<?= $id_syarat_sk ?>").hidden = true;
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                              alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                            }   
                          });
                        });
                      });

                    </script>     
                  </tr>
                </table>
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Tutup</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; 
    ?> 

    <!-- MODAL DISETUJUI DATA PENGAJUAN SK -->
    <?php 
    $no = 1;
    foreach ($pencarian_data as $i):

      ?>
    <div class="modal fade" id="Modalsetuju<?php echo $i['id_syarat_sk']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><b class="text-primary">DATA DISETUJUI</b></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form action="<?php echo site_url('/tu/monitoring_sk/persetujuan') ?>" method ="post">
            <div class="modal-body"> 
              <label>Apakah semua persyaratan disetujui ?</label>
            </div>
            <input type="hidden" name="id_syarat_sk" value="<?php echo $i['id_syarat_sk']  ?>"></input>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
              <button class="btn btn-primary" type="submit" name="tombolSetuju">Ya</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  <?php endforeach; 
  ?> 

  <!-- MODAL TOLAK DATA PENGAJUAN SK -->
  <?php 
  $no = 1;
  foreach ($pencarian_data as $i):

    ?>
  <div class="modal fade" id="Modaltolak<?php echo $i['id_syarat_sk']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b class="text-danger">Alasan Data ditolak</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"> 
          <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/tu/monitoring_sk/persetujuan')?>">
            <div class="form-group">
              <input type="hidden" name="id_syarat_sk" value="<?php echo $i['id_syarat_sk'] ?>" class="form-control"></input>
              <input type="checkbox" id="checkItem" name="alasan_ditolak[]" value="Nama Instansi/ Perusahaan Tidak Sesuai" > Nama Instansi/ Perusahaan Tidak Sesuai<br>
              <input type="checkbox" id="checkItem" name="alasan_ditolak[]" value="Nama Pembimbing Lapangan Tidak Sesuai" > Nama Pembimbing Lapangan Tidak Sesuai<br>
            </div>
            <div class="modal-footer">
              <button class="btn btn-danger" type="reset" data-dismiss="modal">Tutup</button>
              <button class="btn btn-primary" type="submit" name="tombolTolak">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; 
?> 


<?php 
$no = 1;
foreach ($pencarian_data as $i):

  ?>
<!-- Modal Tolak -->
<div class="modal fade" id="ModaltolakSatuan1<?php echo $i['id_syarat_sk'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" >Penolakan Berkas</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="form-group">
            <label>Alasan Validasi Ditolak</label><br>
            <input type="checkbox" id="checkItem1<?php echo $i['id_syarat_sk'] ?>" name="alasan_ditolak[]" value="Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas.." > Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas..<br>
            <input type="text" name="alasan_ditolak1<?php echo $i['id_syarat_sk'] ?>" class="form-control" placeholder="Inputkan Alasan Lain"></input>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" type="reset" data-dismiss="modal">Tutup</button>
            <button class="btn btn-primary" type="button" id="btn-tolak1<?php echo $i['id_syarat_sk'] ?>" onclick="btn_tolak1(<?php echo $i['id_syarat_sk'] ?>)">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  function btn_tolak1(x){
    var id = x;
    str = $("[name='alasan_ditolak1"+x+"']").val();

    var als = str.replace(/'/g, "\\'");;
    if (document.getElementById("checkItem1"+x).checked){
      var alasan = 'Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas, ' + als;
    }
    else{
      var alasan = als;
    }
    var tema = 'Pengecekan Berkas Bukti Penerimaan Lapangan untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha';
    $.ajax({
      url:"<?php echo site_url('/tu/monitoring_sk/tolak_berkas')?>",
      type:"POST",
      data:{
        id : id,
        als : alasan,
        tema : tema,
      },
      cache: false,
      success: function(response){  
        const jsonObject = JSON.parse(response);
        var hasil1 = jsonObject[0].hasil1;
        var hasil2 = jsonObject[0].hasil2;
        var hasil3 = jsonObject[0].hasil3;
        var hasil4 = jsonObject[0].hasil4;
        if(hasil1==1 && hasil2==1 && hasil3 && hasil4==1){
          document.getElementById("tombol_final<?= $id_syarat_sk ?>").hidden = false;
          document.getElementById("text_final<?= $id_syarat_sk ?>").hidden = true;
        }

        $('#success_text_1'+x).text("Berkas ditolak");
        $('#ModaltolakSatuan1'+x).hide();
        $('#tombol_setuju_1'+x).hide();
        $('#tombol_tolak_1'+x).hide();

        console.log(jsonObject);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
      }   
    });
  }
</script>
<?php endforeach; 
?> 

<?php 
$no = 1;
foreach ($pencarian_data as $i):

  ?>
<!-- Modal Tolak -->
<div class="modal fade" id="ModaltolakSatuan2<?php echo $i['id_syarat_sk'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" >Penolakan Berkas</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="form-group">
            <label>Alasan Validasi Ditolak</label><br>
            <input type="checkbox" id="checkItem2<?php echo $i['id_syarat_sk'] ?>" name="alasan_ditolak[]" value="Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas.." > Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas..<br>
            <input type="text" name="alasan_ditolak2<?php echo $i['id_syarat_sk'] ?>" class="form-control" placeholder="Inputkan Alasan Lain"></input>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" type="reset" data-dismiss="modal">Tutup</button>
            <button class="btn btn-primary" type="button" id="btn-tolak2<?php echo $i['id_syarat_sk'] ?>" onclick="btn_tolak2(<?php echo $i['id_syarat_sk'] ?>)">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  function btn_tolak2(x){
    var id = x;
    str = $("[name='alasan_ditolak2"+x+"']").val();
    
    var als = str.replace(/'/g, "\\'");;
    if (document.getElementById("checkItem2"+x).checked){
      var alasan = 'Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas, ' + als;
    }
    else{
      var alasan = als;
    }
    var tema = 'Pengecekan Berkas SPP dasar untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha';
    $.ajax({
      url:"<?php echo site_url('/tu/monitoring_sk/tolak_berkas')?>",
      type:"POST",
      data:{
        id : id,
        als : alasan,
        tema : tema,
      },
      cache: false,
      success: function(response){  
        const jsonObject = JSON.parse(response);
        var hasil1 = jsonObject[0].hasil1;
        var hasil2 = jsonObject[0].hasil2;
        var hasil3 = jsonObject[0].hasil3;
        var hasil4 = jsonObject[0].hasil4;
        if(hasil1==1 && hasil2==1 && hasil3 && hasil4==1){
          document.getElementById("tombol_final<?= $id_syarat_sk ?>").hidden = false;
          document.getElementById("text_final<?= $id_syarat_sk ?>").hidden = true;
        }

        $('#success_text_2'+x).text("Berkas ditolak");
        $('#ModaltolakSatuan2'+x).hide();
        $('#tombol_setuju_2'+x).hide();
        $('#tombol_tolak_2'+x).hide();

        console.log(jsonObject);
      },
      error: function(Xsuccess_text_1MLHttpRequest, textStatus, errorThrown) { 
        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
      }   
    });
  }
</script>
<?php endforeach; 
?> 


<?php 
$no = 1;
foreach ($pencarian_data as $i):

  ?>
<!-- Modal Tolak -->
<div class="modal fade" id="ModaltolakSatuan3<?php echo $i['id_syarat_sk'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" >Penolakan Berkas</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="form-group">
            <label>Alasan Validasi Ditolak</label><br>
            <input type="checkbox" id="checkItem3<?php echo $i['id_syarat_sk'] ?>" name="alasan_ditolak[]" value="Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas.." > Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas..<br>
            <input type="text" name="alasan_ditolak3<?php echo $i['id_syarat_sk'] ?>" class="form-control" placeholder="Inputkan Alasan Lain"></input>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" type="reset" data-dismiss="modal">Tutup</button>
            <button class="btn btn-primary" type="button" id="btn-tolak3<?php echo $i['id_syarat_sk'] ?>" onclick="btn_tolak3(<?php echo $i['id_syarat_sk'] ?>)">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>

  function btn_tolak3(x){
    var id = x;
    str = $("[name='alasan_ditolak3"+x+"']").val();
    
    var als = str.replace(/'/g, "\\'");;
    if (document.getElementById("checkItem3"+x).checked){
      var alasan = 'Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas, ' + als;
    }
    else{
      var alasan = als;
    }
    var tema = 'Pengecekan Berkas Transkip Nilai Sementara untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha';
    $.ajax({
      url:"<?php echo site_url('/tu/monitoring_sk/tolak_berkas')?>",
      type:"POST",
      data:{
        id : id,
        als : alasan,
        tema : tema,
      },
      cache: false,
      success: function(response){  
        const jsonObject = JSON.parse(response);
        var hasil1 = jsonObject[0].hasil1;
        var hasil2 = jsonObject[0].hasil2;
        var hasil3 = jsonObject[0].hasil3;
        var hasil4 = jsonObject[0].hasil4;
        if(hasil1==1 && hasil2==1 && hasil3 && hasil4==1){
          document.getElementById("tombol_final<?= $id_syarat_sk ?>").hidden = false;
          document.getElementById("text_final<?= $id_syarat_sk ?>").hidden = true;
        }

        $('#success_text_3'+x).text("Berkas ditolak");
        $('#ModaltolakSatuan3'+x).hide();
        $('#tombol_setuju_3'+x).hide();
        $('#tombol_tolak_3'+x).hide();

        console.log(jsonObject);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
      }   
    });
  }
</script>
<?php endforeach; 
?> 



<?php 
$no = 1;
foreach ($pencarian_data as $i):

  ?>
<!-- Modal Tolak -->
<div class="modal fade" id="ModaltolakSatuan4<?php echo $i['id_syarat_sk'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" >Penolakan Berkas</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="form-group">
            <label>Alasan Validasi Ditolak</label><br>
            <input type="checkbox" id="checkItem4<?php echo $i['id_syarat_sk'] ?>" name="alasan_ditolak[]" value="Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas.." > Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas..<br>
            <input type="text" name="alasan_ditolak4<?php echo $i['id_syarat_sk'] ?>" class="form-control" placeholder="Inputkan Alasan Lain"></input>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" type="reset" data-dismiss="modal">Tutup</button>
            <button class="btn btn-primary" type="button" id="btn-tolak4<?php echo $i['id_syarat_sk'] ?>" onclick="btn_tolak4(<?php echo $i['id_syarat_sk'] ?>)">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>

  function btn_tolak4(x){
    var id = x;
    str = $("[name='alasan_ditolak4"+x+"']").val();
    
    var als = str.replace(/'/g, "\\'");;
    if (document.getElementById("checkItem4"+x).checked){
      var alasan = 'Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas, ' + als;
    }
    else{
      var alasan = als;
    }
    var tema = 'Pengecekan File Laporan KP untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha';
    $.ajax({
      url:"<?php echo site_url('/tu/monitoring_sk/tolak_berkas')?>",
      type:"POST",
      data:{
        id : id,
        als : alasan,
        tema : tema,
      },
      cache: false,
      success: function(response){  
        const jsonObject = JSON.parse(response);
        var hasil1 = jsonObject[0].hasil1;
        var hasil2 = jsonObject[0].hasil2;
        var hasil3 = jsonObject[0].hasil3;
        var hasil4 = jsonObject[0].hasil4;
        if(hasil1==1 && hasil2==1 && hasil3 && hasil4==1){
          document.getElementById("tombol_final<?= $id_syarat_sk ?>").hidden = false;
          document.getElementById("text_final<?= $id_syarat_sk ?>").hidden = true;
        }

        $('#success_text_4'+x).text("Berkas ditolak");
        $('#ModaltolakSatuan4'+x).hide();
        $('#tombol_setuju_4'+x).hide();
        $('#tombol_tolak_4'+x).hide();

        console.log(jsonObject);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
      }   
    });
  }
</script>
<?php endforeach; 
?> 
