<div class="col-lg-12 mb-1">
  <?php echo $this->session->flashdata('messege'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">Pengajuan SK</h5>
    </div><br>
    <div class="content"><br>
      <div class="container-fluid">
        <div class="card shadow mb-4">
          <div class="card-body">         
           <form action="<?php echo site_url().'/fakultas/monitoring_skripsi'; ?>" method="post" enctype="multipart/form-data">
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
                    <td align="center"><b>KEPERLUAN</b></td>
                    <td align="center"><b>DETAIL</b></td>
                    <!-- <td align="center"><b>WAKTU UPLOAD</b></td> -->
                    <td align="center"><b>AKSI</b></td>
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
                ?>
                <tr>
                  <td><?php echo $no++;?></td>
                  <td><?php echo $npm;?></td>
                  <td><?php echo ucwords($nama_mahasiswa); ?></td>
                  <td><?php echo $nama_jenis_sk;?></td>
                    <!-- <td>
                      <?= $this->m_monitoring_skripsi->format_tanggal(date('Y-m-d', strtotime($tgl_upload))); ?>
                    </td> -->
                    <td>
                      <i class="fas fa-eye text-primary" data-toggle="modal" data-target="#Modallihat<?php echo $id_skripsi  ?>"></i>
                    </td>
                    <td>
                      <?php 
                      if ($this->m_monitoring_skripsi->cekResponSKFakultas($id_skripsi)<=0 AND $_SESSION['jabatan']=='Dekan') {      
                        ?>
                        <i class="btn btn-primary" data-toggle="modal" data-target="#ModalTandaTangan<?php echo $i['id_skripsi'] ?>">Setuju?</i>
                        <div class="modal fade" id="ModalTandaTangan<?php echo $i['id_skripsi'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel" >Tanda tangan SK Pembimbing Skripsi</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                              </div>
                              <form action="<?php echo site_url('/fakultas/monitoring_skripsi/tandatangandekan') ?>" method ="post">
                                <div class="modal-body"> 
                                  <input type="hidden" name="id_skripsi" value="<?php echo $i['id_skripsi']  ?>"></input>
                                  <label>Apakah anda yakin menandatangani surat ini? <br>
                                    <small class="text-danger">(Jika sudah disetujui, maka tidak dapat dibatalkan)</small></label>
                                  </div>
                                  <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                                    <button class="btn btn-primary" type="submit" name="tombolSetuju">Ya</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                          <?php }elseif ($this->m_monitoring_skripsi->cekResponSKFakultas($id_skripsi)<=0 AND $_SESSION['jabatan']!='Dekan'){ ?>
                          <i class="text-danger"> Belum di TandaTangani Dekan</i>
                          <?php }else{ ?>                          
                          <a target="_BLANK" href="<?php echo site_url('/fakultas/monitoring_skripsi/cetak_sk_pembimbing_skripsi/').$id_skripsi ?>"><i class="fas fa-download text-success"> Unduh</i></a>
                          <?php } ?>
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
              </tr>
              <tr>
                <td>
                  <a target="_BLANK" id="open_file2<?= $id_skripsi ?>" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/skripsi/transkrip/'.$i['file_transkrip']) ?>">Bukti Transkrip Nilai Sementara</a><br>
                </td>
              </tr>
              <tr>
                <td>
                  <a target="_BLANK" id="open_file3<?= $id_skripsi ?>" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/skripsi/krs/'.$i['file_krs']) ?>">Bukti KRS</a><br>
                </td>
              </tr>
              <tr>
                <td>
                  <a target="_BLANK" id="open_file4<?= $id_skripsi ?>" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/skripsi/laporan/'.$i['file_laporan']) ?>">Bukti Proposal Skripsi</a><br>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endforeach;  ?> 