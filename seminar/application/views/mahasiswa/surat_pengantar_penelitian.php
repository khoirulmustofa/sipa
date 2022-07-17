<div class="col-lg-12 mb-1">
  <?php echo $this->session->flashdata('messege'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">Pengajuan Surat Pengantar Penelitian</h5>
    </div>
    <div class="content">
      <div class="container-fluid"><br>
        <div class="card shadow mb-4">
          <div class="card-body">
            <i class="fas fa-plus text-primary" data-toggle="modal" data-target="#ModalTambahSuratPengantarPenelitian"> Tambah </i>
            <div class="modal fade" id="ModalTambahSuratPengantarPenelitian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><b class="text-primary">Pengajuan Surat Pengantar Penelitian</b></h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                 <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/surat_pengantar_penelitian/tambah_surat_pengantar_penelitian')?>">
                  <div class="form-group">
                    <label>Nama Instansi/ Perusahaan</label>
                    <input type="text" name="nama_instansi" class="form-control" required=""></input>
                  </div>
                  <div class="form-group">
                    <label>Alamat Instansi/ Perusahaan</label>
                    <input type="text" name="alamat_instansi" class="form-control" required=""></input>
                  </div>
                  <div class="form-group">
                    <label>Ditujukan ke</label>
                    <select class="form-control" name="ditujukan">
                      <option  value="Pimpinan">Pimpinan</option>
                      <option  value="Manager ">Manager </option>
                      <option  value="HRD">HRD</option>
                      <option  value="Direktur">Direktur</option>
                      <option  value="Kepala">Kepala</option>
                      <option  value="Rektor">Rektor</option>
                      <option  value="Dekan">Dekan</option>
                      <option  value="Camat">Camat</option>
                      <option  value="Lurah">Lurah</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Judul Penelitian</label>
                    <input type="text" name="judul_penelitian" class="form-control" required=""></input>
                  </div>
                  <div class="form-group">
                    <label class="bmd-label-floating">Upload Bukti Asli Pembayaran SPP Dasar Semester yang sedang Berjalan (Print yang dari SIKAD)<small class="text-primary"> *Format PDF</small></label>
                    <input type="file" accept="application/pdf"  class="form-control-file" name="file_spp" id="file_spp" required>
                  </div>
                  <div class="form-group">
                    <label class="bmd-label-floating">Upload KTM<small class="text-primary"> *Format PDF</small></label>
                    <input type="file" accept="application/pdf"  class="form-control-file" name="file_ktm" id="file_ktm" required>
                  </div>
                  <div class="form-group">
                    <label class="bmd-label-floating">SK Pembimbing (Khusus Skripsi)<small class="text-primary"> *Format PDF</small></label>
                    <input type="file" accept="application/pdf"  class="form-control-file" name="file_sk" id="file_sk" required>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-danger" type="reset" data-dismiss="modal">Tutup</button>
                    <button class="btn btn-primary" type="submit" name="tombolTambahSuratPengantarPenelitian">Submit</button>
                  </div>
                </form>  
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class="table table-primary">
              <tr>
                <td align="center"><b>NO.</b></td>
                <td align="center"><b>NAMA INSTANSI</b></td>
                <td align="center"><b>ALAMAT INSTANSI</b></td>
                <td align="center"><b>JUDUL PENELITIAN</b></td>
                <td align="center"><b>DETAIL</b></td>
                <td align="center"><b>STATUS BERKAS</b></td>
                <td align="center"><b>STATUS PENERBITAN</b></td>
              </tr>
            </thead>
            <tbody>
              <?php             
              $no = 1;
              foreach ($data_surat_pengantar_penelitian as $i):
                $id_surat_pengantar_penelitian  = $i['id_surat_pengantar_penelitian'];
              $npm              = $i['npm'];
              $nama_instansi    = $i['nama_instansi'];
              $alamat_instansi  = $i['alamat_instansi'];
              $judul_penelitian = $i['judul_penelitian'];
              $file_spp         = $i['file_spp'];
              $file_ktm         = $i['file_ktm'];
              $file_sk          = $i['judul_penelitian'];
              ?>
              <tr>
                <td align="center"><?php echo $no++;?></td>
                <td align="center"><?php echo ucwords($nama_instansi);?></td>
                <td align="center"><?php echo ucwords($alamat_instansi);?></td>
                <td align="center"><?php echo ucwords($judul_penelitian);?></td>
                <td align="center">
                  <i class="fas fa-eye text-primary" data-toggle="modal" data-target="#Modallihat<?php echo $id_surat_pengantar_penelitian  ?>"></i>
                  <div class="modal fade" id="Modallihat<?php echo $i['id_surat_pengantar_penelitian']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Berkas</h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body"> 
                          <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/surat_pengantar_penelitian/row_data')?>">
                            <div class="form-group">
                              <a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/surat_pengantar_penelitian/spp/'.$i['file_spp']) ?>" ><i class="fas fa-eye text-primary">Berkas SPP</i></a><br>
                              <a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/surat_pengantar_penelitian/ktm/'.$i['file_ktm']) ?>" ><i class="fas fa-eye text-primary">Berkas KTM</i></a><br> 
                              <?php 
                              if($i['file_sk']!='') { ?>
                              <a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/surat_pengantar_penelitian/sk/'.$i['file_sk']) ?>" ><i class="fas fa-eye text-primary">Berkas SK Pembimbing</i></a>
                              <?php } else{
                                echo 'Tidak ada lampiran';
                              } ?>
                            </div>
                            <div class="modal-footer">
                              <button class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
                <td align="center">
                  <?php
                  $cekSuratPengantarPenelitian = $this->m_surat_pengantar_penelitian->cekSuratPengantarPenelitian($i['id_surat_pengantar_penelitian']);
                  if($this->m_surat_pengantar_penelitian->cekStatusPersetujuanSuratPengantarPenelitian($i['id_surat_pengantar_penelitian'], 'Berkas Disetujui', 'Staff Prodi Teknik')>0){
                    echo '<b class="text-success">Berkas disetujui Prodi <br><br></b>';
                  }
                  elseif($this->m_surat_pengantar_penelitian->cekStatusPersetujuanSuratPengantarPenelitian($i['id_surat_pengantar_penelitian'], 'Berkas Ditolak', 'Staff Prodi Teknik')>0){
                    echo '<b class="btn text-danger" data-toggle="modal" data-target="#ModalAlasanDitolakTU'.$id_surat_pengantar_penelitian.'"><i class="fas fa-eye">Berkas ditolak prodi<br><br></i></b>';
                    ?>
                    <!-- MODAL ALASAN DITOLAK TU -->
                    <div class="modal fade" id="ModalAlasanDitolakTU<?= $id_surat_pengantar_penelitian ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                      aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><b class="text-danger">PENGAJUAN DITOLAK OLEH PRODI</b></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <?php 
                            foreach ($this->m_surat_pengantar_penelitian->alasan_ditolak($npm, $id_surat_pengantar_penelitian) as $n): ?>
                            <?php echo $n['alasan_ditolak'];?>
                          <?php endforeach ?>
                          <br>
                          <small class="text-danger text-center">Harap upload ulang pengurusan !</small>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php 
                }
                elseif($this->m_surat_pengantar_penelitian->cekStatusPersetujuanSuratPengantarPenelitian($i['id_surat_pengantar_penelitian'], 'Berkas Disetujui', 'Staff Tata Usaha Teknik')>0){
                  echo '<b class="text-success">Berkas disetujui Tata Usaha <br><br></b>';
                }elseif($this->m_surat_pengantar_penelitian->cekStatusPersetujuanSuratPengantarPenelitian($i['id_surat_pengantar_penelitian'], 'Berkas Ditolak', 'Staff Tata Usaha Teknik')>0){
                  echo '<b class="btn text-danger" data-toggle="modal" data-target="#ModalAlasanDitolakTU'.$id_surat_pengantar_penelitian.'"><i class="fas fa-eye">Berkas ditolak  Tatausaha<br><br></i></b>';
                  ?>
                  <!-- MODAL ALASAN DITOLAK TU -->
                  <div class="modal fade" id="ModalAlasanDitolakTU<?= $id_surat_pengantar_penelitian ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><b class="text-danger">PENGAJUAN DITOLAK OLEH TATAUSAHA</b></h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <?php 
                          foreach ($this->m_surat_pengantar_penelitian->alasan_ditolak($npm, $id_surat_pengantar_penelitian) as $n): ?>
                          <?php echo $n['alasan_ditolak'];?>
                        <?php endforeach ?>
                        <br>
                        <small class="text-danger text-center">Harap upload ulang pengurusan !</small>
                      </div>
                    </div>
                  </div>
                </div>
                <?php 
              }elseif($cekSuratPengantarPenelitian>0){
                echo '<b class="text-warning">Meminta Validasi Berkas<br><br></b>';
              }elseif($cekSuratPengantarPenelitian==0){
                echo '-';
              }else{
                echo '-';
              }
              ?>
            </td>
                <td align="center">
                 <?php 
                 if ($this->m_surat_pengantar_penelitian->cekResponSuratTU($id_surat_pengantar_penelitian)<=0) {      
                  ?>
                  <i class="fas fa-trash text-danger" data-toggle="modal" data-target="#Modalhapus<?php echo $id_surat_pengantar_penelitian?>"> Hapus Pengajuan</i>
                  <div class="modal fade" id="Modalhapus<?php echo $id_surat_pengantar_penelitian?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Pengajuan Surat Pengantar</h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form class="form-horizontal" method="post" action="<?php echo site_url('/mahasiswa/surat_pengantar_penelitian/hapus_surat_pengantar_penelitian')?>">
                            <div class="modal-body">
                              <p>Anda yakin mau menghapus data?</p>
                            </div>
                            <div class="modal-footer">
                              <input type="hidden" name="id_surat_pengantar_penelitian" value="<?php echo $id_surat_pengantar_penelitian;?>">
                              <button class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Tutup</button>
                              <button class="btn btn-primary" name="tombolHapus">Ya</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php 
                }elseif($this->m_surat_pengantar_penelitian->cekStatusPersetujuanTU($i['id_surat_pengantar_penelitian'], 'Berkas Ditolak')>0){ 
                  echo 'Tidak Ada Berkas';
                }elseif($this->m_surat_pengantar_penelitian->cekResponSuratPengantarPenelitianFakultas($i['id_surat_pengantar_penelitian'], 'Berkas Disetujui')<1){ 
                  echo 'Tunggu Surat diTerbitkan';
                }else{ ?>
                <a target="_BLANK"href="<?php echo site_url('/mahasiswa/surat_pengantar_penelitian/cetak/').$id_surat_pengantar_penelitian ?>"><i class="fas fa-download text-success"> Unduh</i></a>
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


<!-- MODAL ALASAN DITOLAK TU -->
<div class="modal fade" id="ModalAlasanDitolakTU" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel"><b class="text-danger">PENGAJUAN DITOLAK OLEH TATAUSAHA</b></h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    <div class="modal-body">
      <?php 
      foreach ($this->m_surat_pengantar_penelitian->alasan_ditolak($npm, $id_surat_pengantar_penelitian) as $n): ?>
      <?php echo $n['alasan_ditolak'];?>
    <?php endforeach ?>
    <br>
    <small class="text-danger text-center">Harap upload ulang pengurusan !</small>
  </div>
</div>
</div>
</div>