<div class="col-lg-12 mb-1">
  <?php echo $this->session->flashdata('messege'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">Pengajuan Surat Pengantar Instansi</h5>
    </div>
    <div class="content">
      <div class="container-fluid"><br>
        <div class="card shadow mb-4">
          <div class="card-body">
            <i class="fas fa-plus text-primary" data-toggle="modal" data-target="#ModalTambahSuratPengantar"> Tambah </i>
            <div class="modal fade" id="ModalTambahSuratPengantar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><b class="text-primary">Pengajuan Surat Pengantar</b></h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                 <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/surat_pengantar/tambah_surat_pengantar')?>">
                  <div class="form-group">
                    <label>Nama Instansi/ Perusahaan</label>
                    <input type="text" name="nama_instansi" class="form-control" required="" placeholder="Ex : PT. RAPP | Dinas Komunikasi Informatika Provinsi Riau | Universitas Islam Riau"></input>
                  </div>
                  <div class="form-group">
                    <label>Alamat Instansi/ Perusahaan</label>
                    <textarea type="text" name="alamat_instansi" class="form-control" required="" placeholder=" Ex : Jalan Kaharuddin Nasution No.113, Marpoyan"></textarea>
                  </div> 
                  <div class="form-group">
                    <label>Lokasi</label>
                    <select class="form-control" name="lokasi">
                      <option value="" >--Pilih Lokasi--</option>
                      <option  value="Pekanbaru">Pekanbaru</option>
                      <option  value="Duri ">Duri </option>
                      <option  value="Dumai">Dumai</option>
                      <input name="lokasi1" class="form-control" placeholder="Input Lokasi Lainnya"></input>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Ditujukan ke</label>
                    <select class="form-control" name="ditujukan">
                      <option value="" >--Pilih Tujuan--</option>
                      <option  value="Pimpinan">Pimpinan</option>
                      <option  value="Manager ">Manager </option>
                      <option  value="HRD">HRD</option>
                      <option  value="Direktur">Direktur</option>
                      <option  value="Kepala">Kepala</option>
                      <option  value="Rektor">Rektor</option>
                      <option  value="Dekan">Dekan</option>
                      <option  value="Camat">Camat</option>
                      <option  value="Lurah">Lurah</option>
                      <input  name="ditujukan1" class="form-control" placeholder="Input Tujuan Lainnya"></input>
                    </select>
                  </div>
                  <?php if ($_SESSION['kode_prodi']=='1'){ ?>
                  <div class="form-group">
                    <label>Judul Proyek</label>
                    <input type="text" name="judul_kp" class="form-control" required=""></input>
                  </div>
                  <?php }?>
                  <div class="form-group">
                    <label>Waktu Mulai KP</label>
                    <input type="date" name="waktu_mulai" class="form-control" required=""></input>
                  </div>
                  <div class="form-group">
                    <label>Waktu Selesai KP</label>
                    <input type="date" name="waktu_selesai" class="form-control" required=""></input>
                  </div>
                  <div class="form-group">
                    <label class="bmd-label-floating">Upload Bukti Asli Pembayaran SPP Dasar Semester yang sedang Berjalan (Print yang dari SIKAD)<small class="text-primary"> *Format PDF</small></label>
                    <input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-danger" type="reset" data-dismiss="modal">Tutup</button>
                    <button class="btn btn-primary" type="submit" name="tombolTambahSuratPengantar">Submit</button>
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
                <?php if ($_SESSION['kode_prodi']=='1'){ ?>
                <td align="center"><b>JUDUL PROYEK</b></td>
                <?php }?>
                <td align="center"><b>DITUJUKAN KU</b></td>
                <td align="center"><b>ALAMAT INSTANSI</b></td>
                <td align="center"><b>LOKASI</b></td>
                <td align="center"><b>WAKTU KP</b></td>
                <td align="center"><b>BUKTI PEMBAYARAN SPP</b></td>
                <td align="center"><b>STATUS BERKAS</b></td>
                <td align="center"><b>STATUS PENERBITAN</b></td>
              </tr>
            </thead>
            <tbody>
              <?php             
              $no = 1;
              foreach ($data_surat_pengantar as $i):
                $id_surat_pengantar  = $i['id_surat_pengantar'];
              $npm                 = $i['npm'];
              $nama_instansi       = $i['nama_instansi'];
              $alamat_instansi     = $i['alamat_instansi'];
              $lampiran            = $i['lampiran'];
              $waktu_mulai      = $i['waktu_mulai'];
              $waktu_selesai    = $i['waktu_selesai'];
              $lokasi              = $i['lokasi'];
              $ditujukan           = $i['ditujukan'];
              $judul_kp           = $i['judul_kp'];
              ?>
              <tr>
                <td align="center"><?php echo $no++;?></td>
                <td align="center"><?php echo $nama_instansi;?></td>
                <?php if ($_SESSION['kode_prodi']=='1'){ ?>
                <td align="center"><?php echo $judul_kp;?></td>
                <?php }?>
                <td align="center"><?php echo $ditujukan;?></td>
                <td align="center"><?php echo $alamat_instansi;?></td>
                <td align="center"><?php echo $lokasi;?></td>
                <td align="center"><?= $this->m_surat_pengantar->format_tanggal(date('Y-m-d', strtotime($waktu_mulai))); ?> s.d. <?= $this->m_surat_pengantar->format_tanggal(date('Y-m-d', strtotime($waktu_selesai))); ?></td>
                <td align="center">
                  <a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/surat_pengantar/'.$i['nama_file_surat_pengantar']) ?>"><i class="fas fa-eye text-primary"></i></a> 
                </td>
                <td align="center">
                  <?php
                  $cekSuratPengantar = $this->m_surat_pengantar->cekSuratPengantar($i['id_surat_pengantar']);
                  if($this->m_surat_pengantar->cekStatusPersetujuanSuratPengantar($i['id_surat_pengantar'], 'Berkas Disetujui', 'Staff Prodi Teknik')>0){
                    echo '<b class="text-success">Berkas disetujui Prodi <br><br></b>';
                  }
                  elseif($this->m_surat_pengantar->cekStatusPersetujuanSuratPengantar($i['id_surat_pengantar'], 'Berkas Ditolak', 'Staff Prodi Teknik')>0){
                    echo '<b class="btn text-danger" data-toggle="modal" data-target="#ModalAlasanDitolakTU'.$id_surat_pengantar.'"><i class="fas fa-eye">Berkas ditolak prodi<br><br></i></b>';
                    ?>
                    <!-- MODAL ALASAN DITOLAK TU -->
                    <div class="modal fade" id="ModalAlasanDitolakTU<?= $id_surat_pengantar ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                            foreach ($this->m_surat_pengantar->alasan_ditolak($npm, $id_surat_pengantar) as $n): ?>
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
                elseif($this->m_surat_pengantar->cekStatusPersetujuanSuratPengantar($i['id_surat_pengantar'], 'Berkas Disetujui', 'Staff Tata Usaha Teknik')>0){
                  echo '<b class="text-success">Berkas disetujui Tata Usaha <br><br></b>';
                }elseif($this->m_surat_pengantar->cekStatusPersetujuanSuratPengantar($i['id_surat_pengantar'], 'Berkas Ditolak', 'Staff Tata Usaha Teknik')>0){
                  echo '<b class="btn text-danger" data-toggle="modal" data-target="#ModalAlasanDitolakTU'.$id_surat_pengantar.'"><i class="fas fa-eye">Berkas ditolak  Tatausaha<br><br></i></b>';
                  ?>
                  <!-- MODAL ALASAN DITOLAK TU -->
                  <div class="modal fade" id="ModalAlasanDitolakTU<?= $id_surat_pengantar ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                          foreach ($this->m_surat_pengantar->alasan_ditolak($npm, $id_surat_pengantar) as $n): ?>
                          <?php echo $n['alasan_ditolak'];?>
                        <?php endforeach ?>
                        <br>
                        <small class="text-danger text-center">Harap upload ulang pengurusan !</small>
                      </div>
                    </div>
                  </div>
                </div>
                <?php 
              }elseif($cekSuratPengantar>0){
                echo '<b class="text-warning">Meminta Validasi Berkas<br><br></b>';
              }elseif($cekSuratPengantar==0){
                echo '-';
              }else{
                echo '-';
              }
              ?>
            </td>
            <td align="center">
             <?php 
             if ($this->m_surat_pengantar->cekResponSuratPengantarMhs($id_surat_pengantar)<=0) {      
              ?>
              <i class="fas fa-trash text-danger" data-toggle="modal" data-target="#Modalhapus<?php echo $id_surat_pengantar?>"> Hapus Pengajuan</i>
              <div class="modal fade" id="Modalhapus<?php echo $id_surat_pengantar?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Pengajuan Surat Pengantar</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal" method="post" action="<?php echo site_url('/mahasiswa/surat_pengantar/hapus_surat_pengantar')?>">
                        <div class="modal-body">
                          <p>Anda yakin mau menghapus data?</p>
                        </div>
                        <div class="modal-footer">
                          <input type="hidden" name="id_surat_pengantar" value="<?php echo $id_surat_pengantar;?>">
                          <button class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Tutup</button>
                          <button class="btn btn-primary" name="tombolHapus">Ya</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <?php }elseif($this->m_surat_pengantar->cekStatusPersetujuanSuratPengantarMhsProdi($i['id_surat_pengantar'], 'Berkas Ditolak', 'Staff Prodi Teknik')>0){ 
                echo 'Tidak Ada Berkas';
              }elseif($this->m_surat_pengantar->cekResponSuratPengantarFakultas($i['id_surat_pengantar'], 'Berkas Disetujui')<1){ 
                echo 'Tunggu Surat diTerbitkan';
              }else{ ?>
              <a target="_BLANK"href="<?php echo site_url('/mahasiswa/surat_pengantar/cetak/').$id_surat_pengantar ?>"><i class="fas fa-download text-success"> Unduh</i></a>
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