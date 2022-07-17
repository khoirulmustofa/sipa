<div class="col-lg-12 mb-1">
  <?php echo $this->session->flashdata('messege'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">PENGAJUAN SK SKRIPSI</h5>
    </div><br>
    <div class="content">
      <div class="container-fluid">
        <div class="card shadow mb-4">
          <div class="card-body">
           <form action="<?php echo site_url().'/tu/monitoring_skripsi'; ?>" method="post" enctype="multipart/form-data">
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
                    <td align="center"><b>NAMA</b></td>
                    <td align="center"><b>NO. WHATSAPP</b></td>
                    <td align="center"><b>KEPERLUAN</b></td>
                    <td align="center"><b>DETAIL</b></td>
                    <td align="center"><b>STATUS  DATA</b></td>
                    <td align="center"><b>AKSI</b></td>
                    <td align="center"><b>BERKAS SK</b></td>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no = 1;
                  foreach ($pencarian_data as $i):
                    $id_skripsi     = $i['id_skripsi'];
                  $nama_mahasiswa = $i['nama_mahasiswa'];
                  $nama_jenis_sk  = $i['nama_jenis_sk'];
                  $npm            = $i['npm'];
                  $tgl_upload     = $i['tgl_upload'];
                  $no_hp     = $i['no_hp'];
                  ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $npm;?></td>
                    <td><?php echo ucwords($nama_mahasiswa); ?></td>
                    <td>                 
                      <a href="whatsapp://send?text=Assalamu'alaikum.Wr.Wb...&phone=+62<?php echo $no_hp;?>" >
                        <?php echo $no_hp;?>
                      </a>
                    </td>                    
                    <td><?php echo $nama_jenis_sk;?></td>
                    <td>
                      <i class="fas fa-eye text-primary" data-toggle="modal" data-target="#Modallihat<?php echo $id_skripsi  ?>"></i>
                    </td>
                    <td>
                      <?php
                      $tema = "Pengecekan Berkas Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha";
                      $cekSkripsi = $this->m_monitoring_skripsi->cekResponTU($id_skripsi, $tema);
                      if($this->m_monitoring_skripsi->cekStatusPersetujuanTU($id_skripsi, $tema, 'Berkas Disetujui')>0){
                        echo '<b class="text-primary">Berkas Disetujui</b>';
                      }elseif($this->m_monitoring_skripsi->cekStatusPersetujuanTU($id_skripsi, $tema, 'Berkas Ditolak')>0){
                        echo '<b class="text-danger">Berkas Ditolak</b>';
                      }elseif($cekSkripsi>0){
                        echo '<b class="text-warning">Meminta Validasi Berkas</b>';
                      }elseif($cekSkripsi==0){
                        echo '<b class="text-warning">Meminta Validasi Berkas</b>';
                      }else{
                        echo '<b class="text-warning">Meminta Validasi Berkas</b>';
                      }
                      ?>
                    </td>
                    <td>
                     <?php 
                     $tema = "Pengecekan Berkas Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha";
                     if ($this->m_monitoring_skripsi->cekResponTU($id_skripsi, $tema)<=0) {  
                      if($this->m_monitoring_skripsi->cekPersetujuanSemuaBerkas2($id_skripsi)==1){    
                        ?>
                        <input type="submit" id="setuju_final<?= $id_skripsi ?>" name="tombol_setuju" value="Setujui" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modalsetuju<?php echo $id_skripsi ?>">
                        <input type="submit" id="tolak_final<?= $id_skripsi ?>" name="tombol_tolak" value="Tolak" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modaltolak<?php echo $id_skripsi ?>">

                        <?php 
                      }else{
                        echo '<div id="text_final'.$id_skripsi.'">Semua berkas belum disetujui</div>';
                        ?>
                        <div id="tombol_final<?= $id_skripsi ?>" hidden>
                          <input type="submit" id="setuju_final<?= $id_skripsi ?>" name="tombol_setuju" value="Setujui" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modalsetuju<?php echo $id_skripsi ?>">
                          <input type="submit" id="tolak_final<?= $id_skripsi ?>" name="tombol_tolak" value="Tolak" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modaltolak<?php echo $id_skripsi ?>">
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
                      if (isset($id_skripsi)) {
                        $cekSK = $this->m_monitoring_skripsi->cekResponSKFakultas($id_skripsi);
                        if($cekSK>0){
                          ?> 
                          <a target="_BLANK" href="<?php echo site_url('/tu/monitoring_skripsi/cetak_sk_pembimbing_skripsi/').$id_skripsi ?>"><i class="fas fa-download text-success"> Unduh</i></a>
                          <?php
                        } else {
                          echo 'Tidak Ada Berkas';
                        }              
                      } else{
                        echo '-';
                      }
                      ?>
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
  $id_skripsi         = $i['id_skripsi'];
$nama_mahasiswa       = $i['nama_mahasiswa'];
$nama_jenis_sk        = $i['nama_jenis_sk'];
$npm                  = $i['npm'];
$judul                = $i['judul'];
$tgl_upload_syarat_sk = $i['tgl_upload'];
?>
<div class="modal fade" id="Modallihat<?php echo $i['id_skripsi']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Pengajuan SK Skripsi</h5>
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
          <label>Judul</label>
          <input type="text" name="judul" class="form-control" value="<?php echo $i['judul']?>" readonly></input>
        </div>
        <div class="form-group">
          <label class="bmd-label-floating">Lihat Berkas</label><br>
          <table border="0" width="100%" cellspacing="1" cellpadding="2">
            <tr>
              <td>
                <a target="_BLANK" id="open_file1<?= $id_skripsi ?>" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/skripsi/spp/'.$i['file_spp']) ?>">Bukti Pembayaran SPP Dasar</a><br>
              </td>
              <td class="text-center">
               <?php 
               $tema = "Pengecekan Berkas SPP dasar untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha";
               if ($this->m_monitoring_skripsi->cekResponTU($id_skripsi, $tema)>0) { 
                ?>
                <div>Sudah Direspon</div>
                <?php 
              }else{ 
                $open_file = "Pengecekan Berkas SPP dasar untuk Pengajuan SK Skripsi Mahasiswa";
                if ($this->m_monitoring_skripsi->cekOpenFile($id_skripsi, $open_file)>0) {
                  $hidden = "";
                }else{
                  $hidden = "hidden";
                }
                ?>
                <input type="submit" name="tombol_setuju" id="tombol_setuju_1<?= $id_skripsi ?>" value="Setujui" class="btn btn-primary btn-sm" <?= $hidden ?> >
                <input data-toggle="modal" data-target="#ModaltolakSatuan1<?php echo $i['id_skripsi'] ?>" type="button" id="tombol_tolak_1<?= $id_skripsi ?>" value="Tolak" class="btn btn-danger btn-sm" <?= $hidden ?> >
                <div id="success_text_1<?= $id_skripsi ?>"></div>
                <?php  } ?>
              </td>      
              <script>
                $(document).ready(function() {
                  $('#open_file1<?= $id_skripsi ?>').on('click', function() {
                    var id_skripsi = "<?= $id_skripsi ?>";
                    $.ajax({
                      url: "<?php echo site_url("/tu/monitoring_skripsi/open_file");?>",
                      type: "POST",
                      data: {
                        id_skripsi: id_skripsi,
                        file_open: 'Pengecekan Berkas SPP dasar untuk Pengajuan SK Skripsi Mahasiswa',
                      },
                      cache: false,
                      success: function(response){

                        document.getElementById("tombol_setuju_1<?= $id_skripsi ?>").hidden = false;
                        document.getElementById("tombol_tolak_1<?= $id_skripsi ?>").hidden = false;
                      },
                      error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                      }  
                    });
                  });
                });

                $(document).ready(function() {
                  $('#tombol_setuju_1<?= $id_skripsi ?>').on('click', function() {
                    var id_skripsi = "<?= $id_skripsi ?>";
                    $.ajax({
                      url: "<?php echo site_url("/tu/monitoring_skripsi/setuju_berkas");?>",
                      type: "POST",
                      data: {
                        id_skripsi: id_skripsi,
                        status_persetujuan: 'Berkas Disetujui',
                        tema_persetujuan: 'Pengecekan Berkas SPP dasar untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha'
                      },
                      cache: false,
                      success: function(response){  
                        const jsonObject = JSON.parse(response);
                        var hasil1 = jsonObject[0].hasil1;
                        var hasil2 = jsonObject[0].hasil2;
                        var hasil3 = jsonObject[0].hasil3;
                        var hasil4 = jsonObject[0].hasil4;
                        if(hasil1==1 && hasil2==1 && hasil3 && hasil4==1){
                          document.getElementById("tombol_final<?= $id_skripsi ?>").hidden = false;
                          document.getElementById("text_final<?= $id_skripsi ?>").hidden = true;
                        }
                        document.getElementById("success_text_1<?= $id_skripsi ?>").innerText = "Sudah direspon";
                        document.getElementById("tombol_setuju_1<?= $id_skripsi ?>").hidden = true;
                        document.getElementById("tombol_tolak_1<?= $id_skripsi ?>").hidden = true;
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
                <a target="_BLANK" id="open_file2<?= $id_skripsi ?>" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/skripsi/transkrip/'.$i['file_transkrip']) ?>">Bukti Transkrip Nilai Sementara</a><br>
              </td>
              <td class="text-center">
               <?php 
               $tema = "Pengecekan Berkas Transkrip Nilai untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha";
               if ($this->m_monitoring_skripsi->cekResponTU($id_skripsi, $tema)>0) { 
                ?>
                <div>Sudah Direspon</div>
                <?php 
              }else{ 
                $open_file = "Pengecekan Berkas Transkrip Nilai untuk Pengajuan SK Skripsi Mahasiswa";
                if ($this->m_monitoring_skripsi->cekOpenFile($id_skripsi, $open_file)>0) {
                  $hidden = "";
                }else{
                  $hidden = "hidden";
                }
                ?>
                <input type="submit" name="tombol_setuju" id="tombol_setuju_2<?= $id_skripsi ?>" value="Setujui" class="btn btn-primary btn-sm" <?= $hidden ?> >
                <input data-toggle="modal" data-target="#ModaltolakSatuan2<?php echo $i['id_skripsi'] ?>" type="button" id="tombol_tolak_2<?= $id_skripsi ?>" value="Tolak" class="btn btn-danger btn-sm" <?= $hidden ?> >
                <div id="success_text_2<?= $id_skripsi ?>"></div>
                <?php  } ?>
              </td>      
              <script>
                $(document).ready(function() {
                  $('#open_file2<?= $id_skripsi ?>').on('click', function() {
                    var id_skripsi = "<?= $id_skripsi ?>";
                    $.ajax({
                      url: "<?php echo site_url("/tu/monitoring_skripsi/open_file");?>",
                      type: "POST",
                      data: {
                        id_skripsi: id_skripsi,
                        file_open: 'Pengecekan Berkas Transkrip Nilai untuk Pengajuan SK Skripsi Mahasiswa',
                      },
                      cache: false,
                      success: function(response){

                        document.getElementById("tombol_setuju_2<?= $id_skripsi ?>").hidden = false;
                        document.getElementById("tombol_tolak_2<?= $id_skripsi ?>").hidden = false;
                      },
                      error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                      }  
                    });
                  });
                });

                $(document).ready(function() {
                  $('#tombol_setuju_2<?= $id_skripsi ?>').on('click', function() {
                    var id_skripsi = "<?= $id_skripsi ?>";
                    $.ajax({
                      url: "<?php echo site_url("/tu/monitoring_skripsi/setuju_berkas");?>",
                      type: "POST",
                      data: {
                        id_skripsi: id_skripsi,
                        status_persetujuan: 'Berkas Disetujui',
                        tema_persetujuan: 'Pengecekan Berkas Transkrip Nilai untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha'
                      },
                      cache: false,
                      success: function(response){  
                        const jsonObject = JSON.parse(response);
                        var hasil1 = jsonObject[0].hasil1;
                        var hasil2 = jsonObject[0].hasil2;
                        var hasil3 = jsonObject[0].hasil3;
                        var hasil4 = jsonObject[0].hasil4;
                        if(hasil1==1 && hasil2==1 && hasil3 && hasil4==1){
                          document.getElementById("tombol_final<?= $id_skripsi ?>").hidden = false;
                          document.getElementById("text_final<?= $id_skripsi ?>").hidden = true;
                        }
                        document.getElementById("success_text_2<?= $id_skripsi ?>").innerText = "Sudah direspon";
                        document.getElementById("tombol_setuju_2<?= $id_skripsi ?>").hidden = true;
                        document.getElementById("tombol_tolak_2<?= $id_skripsi ?>").hidden = true;
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
                <a target="_BLANK" id="open_file3<?= $id_skripsi ?>" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/skripsi/krs/'.$i['file_krs']) ?>">Bukti KRS</a><br>
              </td>
              <td class="text-center">
               <?php 
               $tema = "Pengecekan Berkas KRS untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha";
               if ($this->m_monitoring_skripsi->cekResponTU($id_skripsi, $tema)>0) { 
                ?>
                <div>Sudah Direspon</div>
                <?php 
              }else{ 
                $open_file = "Pengecekan Berkas KRS untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha";
                if ($this->m_monitoring_skripsi->cekOpenFile($id_skripsi, $open_file)>0) {
                  $hidden = "";
                }else{
                  $hidden = "hidden";
                }
                ?>
                <input type="submit" name="tombol_setuju" id="tombol_setuju_3<?= $id_skripsi ?>" value="Setujui" class="btn btn-primary btn-sm" <?= $hidden ?> >
                <input data-toggle="modal" data-target="#ModaltolakSatuan3<?php echo $i['id_skripsi'] ?>" type="button" id="tombol_tolak_3<?= $id_skripsi ?>" value="Tolak" class="btn btn-danger btn-sm" <?= $hidden ?> >
                <div id="success_text_3<?= $id_skripsi ?>"></div>
                <?php  } ?>
              </td>      
              <script>
                $(document).ready(function() {
                  $('#open_file3<?= $id_skripsi ?>').on('click', function() {
                    var id_skripsi = "<?= $id_skripsi ?>";
                    $.ajax({
                      url: "<?php echo site_url("/tu/monitoring_skripsi/open_file");?>",
                      type: "POST",
                      data: {
                        id_skripsi: id_skripsi,
                        file_open: 'Pengecekan Berkas KRS untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha',
                      },
                      cache: false,
                      success: function(response){

                        document.getElementById("tombol_setuju_3<?= $id_skripsi ?>").hidden = false;
                        document.getElementById("tombol_tolak_3<?= $id_skripsi ?>").hidden = false;
                      },
                      error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                      }  
                    });
                  });
                });

                $(document).ready(function() {
                  $('#tombol_setuju_3<?= $id_skripsi ?>').on('click', function() {
                    var id_skripsi = "<?= $id_skripsi ?>";
                    $.ajax({
                      url: "<?php echo site_url("/tu/monitoring_skripsi/setuju_berkas");?>",
                      type: "POST",
                      data: {
                        id_skripsi: id_skripsi,
                        status_persetujuan: 'Berkas Disetujui',
                        tema_persetujuan: 'Pengecekan Berkas KRS untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha'
                      },
                      cache: false,
                      success: function(response){  
                        const jsonObject = JSON.parse(response);
                        var hasil1 = jsonObject[0].hasil1;
                        var hasil2 = jsonObject[0].hasil2;
                        var hasil3 = jsonObject[0].hasil3;
                        var hasil4 = jsonObject[0].hasil4;
                        if(hasil1==1 && hasil2==1 && hasil3 && hasil4==1){
                          document.getElementById("tombol_final<?= $id_skripsi ?>").hidden = false;
                          document.getElementById("text_final<?= $id_skripsi ?>").hidden = true;
                        }
                        document.getElementById("success_text_3<?= $id_skripsi ?>").innerText = "Sudah direspon";
                        document.getElementById("tombol_setuju_3<?= $id_skripsi ?>").hidden = true;
                        document.getElementById("tombol_tolak_3<?= $id_skripsi ?>").hidden = true;
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
                <a target="_BLANK" id="open_file4<?= $id_skripsi ?>" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/skripsi/laporan/'.$i['file_laporan']) ?>">Bukti Proposal Skripsi</a><br>
              </td>
              <td class="text-center">
                <?php 
                $tema = "Pengecekan File Proposal Skripsi untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha";
                if ($this->m_monitoring_skripsi->cekResponTU($id_skripsi, $tema)>0) { 
                  ?>
                  <div>Sudah Direspon</div>
                  <?php 
                }else{ 
                  $open_file = "Pengecekan File Proposal Skripsi untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha";
                  if ($this->m_monitoring_skripsi->cekOpenFile($id_skripsi, $open_file)>0) {
                    $hidden = "";
                  }else{
                    $hidden = "hidden";
                  }
                  ?>
                  <input type="submit" name="tombol_setuju" id="tombol_setuju_4<?= $id_skripsi ?>" value="Setujui" class="btn btn-primary btn-sm" <?= $hidden ?> >
                  <input data-toggle="modal" data-target="#ModaltolakSatuan4<?php echo $i['id_skripsi'] ?>" type="button" id="tombol_tolak_4<?= $id_skripsi ?>" value="Tolak" class="btn btn-danger btn-sm" <?= $hidden ?> >
                  <div id="success_text_4<?= $id_skripsi ?>"></div>
                  <?php  } ?>
                </td>      
                <script>
                  $(document).ready(function() {
                    $('#open_file4<?= $id_skripsi ?>').on('click', function() {
                      var id_skripsi = "<?= $id_skripsi ?>";
                      $.ajax({
                        url: "<?php echo site_url("/tu/monitoring_skripsi/open_file");?>",
                        type: "POST",
                        data: {
                          id_skripsi: id_skripsi,
                          file_open: 'Pengecekan File Proposal Skripsi untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha',
                        },
                        cache: false,
                        success: function(response){

                          document.getElementById("tombol_setuju_4<?= $id_skripsi ?>").hidden = false;
                          document.getElementById("tombol_tolak_4<?= $id_skripsi ?>").hidden = false;
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                          alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                        }  
                      });
                    });
                  });
                  $(document).ready(function() {
                    $('#tombol_setuju_4<?= $id_skripsi ?>').on('click', function() {
                      var id_skripsi = "<?= $id_skripsi ?>";
                      $.ajax({
                        url: "<?php echo site_url("/tu/monitoring_skripsi/setuju_berkas");?>",
                        type: "POST",
                        data: {
                          id_skripsi: id_skripsi,
                          status_persetujuan: 'Berkas Disetujui',
                          tema_persetujuan: 'Pengecekan File Proposal Skripsi untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha'
                        },
                        cache: false,
                        success: function(response){  
                          const jsonObject = JSON.parse(response);
                          var hasil1 = jsonObject[0].hasil1;
                          var hasil2 = jsonObject[0].hasil2;
                          var hasil3 = jsonObject[0].hasil3;
                          var hasil4 = jsonObject[0].hasil4;
                          if(hasil1==1 && hasil2==1 && hasil3 && hasil4==1){
                            document.getElementById("tombol_final<?= $id_skripsi ?>").hidden = false;
                            document.getElementById("text_final<?= $id_skripsi ?>").hidden = true;
                          }
                          document.getElementById("success_text_4<?= $id_skripsi ?>").innerText = "Sudah direspon";
                          document.getElementById("tombol_setuju_4<?= $id_skripsi ?>").hidden = true;
                          document.getElementById("tombol_tolak_4<?= $id_skripsi ?>").hidden = true;
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
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>

<?php endforeach;  ?> 

<!-- MODAL DISETUJUI DATA PENGAJUAN SK -->
<?php 
$no = 1;
foreach ($pencarian_data as $i):

  ?>
<div class="modal fade" id="Modalsetuju<?php echo $i['id_skripsi']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b class="text-primary">DATA DISETUJUI</b></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form action="<?php echo site_url('/tu/monitoring_skripsi/persetujuan') ?>" method ="post">
        <div class="modal-body"> 
          <label>Apakah semua persyaratan disetujui ?</label>
        </div>
        <input type="hidden" name="id_skripsi" value="<?php echo $i['id_skripsi']  ?>"></input>
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
<div class="modal fade" id="Modaltolak<?php echo $i['id_skripsi']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
        <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/tu/monitoring_skripsi/persetujuan')?>">
          <div class="form-group">
            <input type="hidden" name="id_skripsi" value="<?php echo $i['id_skripsi'] ?>" class="form-control"></input>
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
<div class="modal fade" id="ModaltolakSatuan1<?php echo $i['id_skripsi'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <input type="checkbox" id="checkItem1<?php echo $i['id_skripsi'] ?>" name="alasan_ditolak[]" value="Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas.." > Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas..<br>
            <input type="text" name="alasan_ditolak1<?php echo $i['id_skripsi'] ?>" class="form-control" placeholder="Inputkan Alasan Lain"></input>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" type="reset" data-dismiss="modal">Tutup</button>
            <button class="btn btn-primary" type="button" id="btn-tolak1<?php echo $i['id_skripsi'] ?>" onclick="btn_tolak1(<?php echo $i['id_skripsi'] ?>)">Submit</button>
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
    var tema = 'Pengecekan Berkas SPP dasar untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha';
    $.ajax({
      url:"<?php echo site_url('/tu/monitoring_skripsi/tolak_berkas')?>",
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
          document.getElementById("tombol_final<?= $id_skripsi ?>").hidden = false;
          document.getElementById("text_final<?= $id_skripsi ?>").hidden = true;
        }
          // document.getElementById("success_text_2<?= $id_skripsi ?>").innerText = "Sudah direspon";
          // document.getElementById("tombol_setuju_2<?= $id_skripsi ?>").hidden = true;
          // document.getElementById("tombol_tolak_2<?= $id_skripsi ?>").hidden = true;
          $('#success_text_1'+x).text("Sudah direspon");
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
<div class="modal fade" id="ModaltolakSatuan2<?php echo $i['id_skripsi'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <input type="checkbox" id="checkItem2<?php echo $i['id_skripsi'] ?>" name="alasan_ditolak[]" value="Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas.." > Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas..<br>
            <input type="text" name="alasan_ditolak2<?php echo $i['id_skripsi'] ?>" class="form-control" placeholder="Inputkan Alasan Lain"></input>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" type="reset" data-dismiss="modal">Tutup</button>
            <button class="btn btn-primary" type="button" id="btn-tolak2<?php echo $i['id_skripsi'] ?>" onclick="btn_tolak2(<?php echo $i['id_skripsi'] ?>)">Submit</button>
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
    var tema = 'Pengecekan Berkas Transkrip Nilai untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha';
    $.ajax({
      url:"<?php echo site_url('/tu/monitoring_skripsi/tolak_berkas')?>",
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
          document.getElementById("tombol_final<?= $id_skripsi ?>").hidden = false;
          document.getElementById("text_final<?= $id_skripsi ?>").hidden = true;
        }
          // document.getElementById("success_text_2<?= $id_skripsi ?>").innerText = "Sudah direspon";
          // document.getElementById("tombol_setuju_2<?= $id_skripsi ?>").hidden = true;
          // document.getElementById("tombol_tolak_2<?= $id_skripsi ?>").hidden = true;
          $('#success_text_2'+x).text("Sudah direspon");
          $('#ModaltolakSatuan2'+x).hide();
          $('#tombol_setuju_2'+x).hide();
          $('#tombol_tolak_2'+x).hide();

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
<div class="modal fade" id="ModaltolakSatuan3<?php echo $i['id_skripsi'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <input type="checkbox" id="checkItem3<?php echo $i['id_skripsi'] ?>" name="alasan_ditolak[]" value="Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas.." > Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas..<br>
            <input type="text" name="alasan_ditolak3<?php echo $i['id_skripsi'] ?>" class="form-control" placeholder="Inputkan Alasan Lain"></input>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" type="reset" data-dismiss="modal">Tutup</button>
            <button class="btn btn-primary" type="button" id="btn-tolak3<?php echo $i['id_skripsi'] ?>" onclick="btn_tolak3(<?php echo $i['id_skripsi'] ?>)">Submit</button>
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
    var tema = 'Pengecekan Berkas KRS untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha';
    $.ajax({
      url:"<?php echo site_url('/tu/monitoring_skripsi/tolak_berkas')?>",
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
          document.getElementById("tombol_final<?= $id_skripsi ?>").hidden = false;
          document.getElementById("text_final<?= $id_skripsi ?>").hidden = true;
        }
          // document.getElementById("success_text_2<?= $id_skripsi ?>").innerText = "Sudah direspon";
          // document.getElementById("tombol_setuju_2<?= $id_skripsi ?>").hidden = true;
          // document.getElementById("tombol_tolak_2<?= $id_skripsi ?>").hidden = true;
          $('#success_text_3'+x).text("Sudah direspon");
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
<div class="modal fade" id="ModaltolakSatuan4<?php echo $i['id_skripsi'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <input type="checkbox" id="checkItem4<?php echo $i['id_skripsi'] ?>" name="alasan_ditolak[]" value="Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas.." > Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas..<br>
            <input type="text" name="alasan_ditolak4<?php echo $i['id_skripsi'] ?>" class="form-control" placeholder="Inputkan Alasan Lain"></input>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" type="reset" data-dismiss="modal">Tutup</button>
            <button class="btn btn-primary" type="button" id="btn-tolak4<?php echo $i['id_skripsi'] ?>" onclick="btn_tolak4(<?php echo $i['id_skripsi'] ?>)">Submit</button>
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
    var tema = 'Pengecekan File Proposal Skripsi untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha';
    $.ajax({
      url:"<?php echo site_url('/tu/monitoring_skripsi/tolak_berkas')?>",
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
          document.getElementById("tombol_final<?= $id_skripsi ?>").hidden = false;
          document.getElementById("text_final<?= $id_skripsi ?>").hidden = true;
        }
          // document.getElementById("success_text_2<?= $id_skripsi ?>").innerText = "Sudah direspon";
          // document.getElementById("tombol_setuju_2<?= $id_skripsi ?>").hidden = true;
          // document.getElementById("tombol_tolak_2<?= $id_skripsi ?>").hidden = true;
          $('#success_text_4'+x).text("Sudah direspon");
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