<div class="col-lg-12 mb-1">
  <?php echo $this->session->flashdata('messege'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">Pengajuan SK Mahasiswa</h5>
    </div><br>
    <div class="content">
      <div class="container-fluid">
        <div class="card shadow mb-4">
          <div class="card-body">
            <div class="table-responsive">
              <div class="scroll">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                  <thead class="table table-primary">
                    <tr>
                      <td align="center"><b>NO.</b></td>
                      <td align="center"><b>NPM</b></td>
                      <td align="center"><b>NAMA</b></td>
                      <td align="center"><b>KEPERLUAN</b></td>
                      <td align="center"><b>WAKTU VALIDASI BERKAS</b></td>
                      <td align="center"><b>DETAIL</b></td>
                      <td align="center"><b>DOSEN PEMBIMBING</b></td>
                      <td align="center"><b>RESET PEMBIMBING</b></td>
                      <td align="center"><b>BERKAS SK</b></td>
                      <td align="center"><b>KARTU BIMBINGAN</b></td>
                      <td align="center"><b>NILAI DOSEN PEMBIMBING</b></td>
                      <td align="center"><b>NILAI PEMBIMBING LAPANGAN</b></td>
                      <td align="center"><b>NILAI AKHIR</b></td>
                      <td align="center"><b>AKSI</b></td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    foreach ($pencarian_data->result_array() as $i):
                      $id_syarat_sk      = $i['id_syarat_sk'];
                    $nama_mahasiswa    = $i['nama_mahasiswa'];
                    $nama_jenis_sk     = $i['nama_jenis_sk'];
                    $npm               = $i['npm'];
                    $waktu_persetujuan = $i['waktu_persetujuan'];
                    ?>
                    <tr>
                      <td><?php echo $no++;?></td>
                      <td><?php echo $npm;?></td>
                      <td><?php echo ucwords($nama_mahasiswa); ?></td>
                      <td><?php echo $nama_jenis_sk;?></td>
                      <td>
                        <?= $this->m_monitoring_sk->format_tanggal(date('Y-m-d', strtotime($waktu_persetujuan))); ?> 
                      </td>
                      <td>
                        <i class="fas fa-eye text-primary" data-toggle="modal" data-target="#Modallihat<?php echo $id_syarat_sk  ?>"></i>
                      </td>
                      <td>
                        <?php
                        if($this->m_monitoring_sk->cekResponPembimbing($i['id_syarat_sk'], 'Penunjukan Diterima Pembimbing')){
                        }elseif($this->m_monitoring_sk->cekResponPembimbing($i['id_syarat_sk'], 'Menunggu Respon Pembimbing')){
                          ?>
                          <?php 
                        }else{
                          ?>
                          <a class="btn btn-success text-white border-white custom-btn btn-sm" data-toggle="modal" data-target="#ModalPilihDospem<?php echo $id_syarat_sk ?>">Pilih Pembimbing</a>
                          <?php 
                        }
                        ?>
                        <?php 
                        echo $this->m_monitoring_sk->show_histori($id_syarat_sk) ?>
                    </td>
                    <td>
                        <input type="submit" name="tombol_reset" value="Reset" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modalreset<?php echo $id_syarat_sk  ?>">
                         <div class="modal fade" id="Modalreset<?php echo $i['id_syarat_sk']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel" >Reset Akun Pembimbing</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                              </div>
                              <form action="<?php echo site_url('/prodi/monitoring_sk/reset_dospem') ?>" method ="post">
                                <div class="modal-body"> 
                                  <input type="hidden" name="id_syarat_sk" value="<?php echo $i['id_syarat_sk']  ?>"></input>
                                  <label>Apakah yakin ingin menghapus pembimbing yang telah dipilih ?</label>
                                </div>
                                <div class="modal-footer">
                                  <!-- <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button> -->
                                  <button class="btn btn-primary" type="submit" name="tombolReset">Reset</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                    </td>
                    <td>
                      <?php
                      if (isset($id_syarat_sk)) {
                        $cekSK = $this->m_monitoring_sk->cekResponSKFakultas($id_syarat_sk);
                        if($cekSK>0){
                          ?> 
                          <a target="_BLANK"  href="<?php echo site_url('/prodi/monitoring_sk/cetak_sk_pembimbing_kp/').$id_syarat_sk ?>"><i class="fas fa-download text-success"> Unduh</i></a>
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
                      $cekTigaBimbingan = $this->m_bimbingan->cekTigaBimbingan($id_syarat_sk); 
                      $cekLaporanLengkap = $this->m_bimbingan->cekLaporanLengkap($id_syarat_sk, "Laporan Lengkap")->num_rows();
                      if(($cekTigaBimbingan==0 || ($cekTigaBimbingan == 0)==null) && ($cekLaporanLengkap<=0) ) {
                        echo 'Tidak ada kartu bimbingan';
                      }else{
                       $cekNilai = $this->m_bimbingan->cekResponNilai($id_syarat_sk);
                       if($cekNilai>0){ ?> 
                       <?php if ($this->m_monitoring_sk->cekTtdProdi($id_syarat_sk)>0) {?>
                       <a target="_BLANK" href="<?php echo site_url('/prodi/monitoring_sk/cetak_kartu_bimbingan/').$id_syarat_sk ?>"><i class="fas fa-download text-success"> Unduh</i></a>
                       <?php }else{ ?>
                       <i class="fas fa-signature text-warning" data-toggle="modal" data-target="#ModalTandaTangan<?php echo $i['id_syarat_sk'] ?>"></i>
                       <div class="modal fade" id="ModalTandaTangan<?php echo $i['id_syarat_sk'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel" >Tanda tangan Kartu Bimbingan</h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <form action="<?php echo site_url('/prodi/monitoring_sk/tandatanganprodi') ?>" method ="post">
                              <div class="modal-body"> 
                                <input type="hidden" name="id_syarat_sk" value="<?php echo $i['id_syarat_sk']  ?>"></input>
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
                        <?php } ?>                  
                        <?php
                      }else{
                       echo 'Tidak ada kartu bimbingan';
                     } }
                     ?>
                   </td>
                   <td>
                     <?php
                     $cekNilaiDospem = $this->m_monitoring_sk->cekNilaiDospem($id_syarat_sk);
                     if($cekNilaiDospem>0){
                      ?> 
                      <i class="fas fa-eye text-primary" data-toggle="modal" data-target="#ModalLihatNilaiDospem<?php echo $id_syarat_sk  ?>"></i> <?php
                    } else {
                      echo 'Belum dinilai';
                    }                 
                    ?>
                  </td>
                  <td>
                    <?php
                    $cekNilaiPembimbingLapangan = $this->m_monitoring_sk->cekNilaiPembimbingLapangan($id_syarat_sk);
                    if($cekNilaiPembimbingLapangan>0){
                      ?> 
                      <i class="fas fa-eye text-primary" data-toggle="modal" data-target="#ModalLihatPembimbingLapangan<?php echo $id_syarat_sk  ?>"></i>
                      <div class="modal fade" id="ModalLihatPembimbingLapangan<?php echo $i['id_syarat_sk']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content text-left">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"><b class="text-secondary">Penilaian Pembimbing Lapangan</b></h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body"> 
                              <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/prodi/monitoring_sk/row_data')?>">
                               <div class="form-group">
                                <label >Kepribadian</label>
                                <input type="number" name="kepribadian" class="form-control" value="<?php echo $this->m_bimbingan->get_nilai($id_syarat_sk, "kepribadian") ?>" readonly></input>
                                <small class="text-primary">Bobot 10%</small>
                              </div>
                              <div class="form-group">
                                <label>Kedisiplinan,Kehadiran</label>
                                <input type="number" name="kedisiplinan" class="form-control" value="<?php echo $this->m_bimbingan->get_nilai($id_syarat_sk, "kedisiplinan") ?>"readonly></input>
                                <small class="text-primary">Bobot 10%</small>   
                              </div>
                              <div class="form-group">
                                <label>Motivasi/Inisiatif</label>
                                <input type="number" name="motivasi" class="form-control" value="<?php echo $this->m_bimbingan->get_nilai($id_syarat_sk, "motivasi") ?>" readonly></input>
                                <small class="text-primary">Bobot 10%</small>
                              </div>
                              <div class="form-group">
                                <label>Tanggung Jawab</label>
                                <input type="number" name="tanggung_jawab" class="form-control" value="<?php echo $this->m_bimbingan->get_nilai($id_syarat_sk, "tanggung_jawab") ?>" readonly></input>
                                <small class="text-primary">Bobot 20%</small>
                              </div>
                              <div class="form-group">
                                <label>Komitmen</label>
                                <input type="number" name="komitmen" class="form-control" value="<?php echo $this->m_bimbingan->get_nilai($id_syarat_sk, "komitmen") ?>" readonly></input>
                                <small class="text-primary">Bobot 10%</small>
                              </div>
                              <div class="form-group">
                                <label>Kerja sama (Termasuk hubungan dengan Staff Setempat)</label>
                                <input type="number" name="kerjasama" class="form-control" value="<?php echo $this->m_bimbingan->get_nilai($id_syarat_sk, "kerjasama") ?>" readonly></input>
                                <small class="text-primary">Bobot 10%</small>
                              </div>
                              <div class="form-group">
                                <label>Keselamatan Kerja</label>
                                <input type="number" name="keselamatan" class="form-control" value="<?php echo $this->m_bimbingan->get_nilai($id_syarat_sk, "keselamatan") ?>" readonly></input>
                                <small class="text-primary">Bobot 10%</small>
                              </div>
                              <div class="form-group">
                                <label>Laporan</label>
                                <input type="number" name="laporan" class="form-control" value="<?php echo $this->m_bimbingan->get_nilai($id_syarat_sk, "laporan") ?>" readonly></input>
                                <small class="text-primary">Bobot 20%</small>
                              </div>
                              <div class="form-group">
                                <label>Total Nilai</label>
                                <input class="form-control" value="<?php echo $this->m_bimbingan->kalkulasiNilaiLapangan($id_syarat_sk); ?>" readonly=""></input>
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
                  } else {
                    echo 'Belum dinilai';
                  }                 
                  ?>
                </td>
                <td>
                  <?php 
                  $cekNilai1 = $this->m_bimbingan->cekResponNilai($id_syarat_sk);
                  $cekNilai2 = $this->m_bimbingan->cekResponNilai_pembimbing_lapangan($id_syarat_sk);
                  if($cekNilai1>0 && $cekNilai2){
                    echo $this->m_bimbingan->kalkulasiNilai($id_syarat_sk); 

                  }else{
                    echo "Nilai belum tersedia";
                  }
                  ?>
                </td>
                <td>
                  <?php
                  $cekTigaBimbingan = $this->m_bimbingan->cekTigaBimbingan($id_syarat_sk); 
                  $cekLaporanLengkap = $this->m_bimbingan->cekLaporanLengkap($id_syarat_sk, "Laporan Lengkap")->num_rows();
                  $cekNilaiPembimbingLapangan = $this->m_monitoring_sk->cekNilaiPembimbingLapangan($id_syarat_sk);
                  $cekNilaiDospem = $this->m_monitoring_sk->cekNilaiDospem($id_syarat_sk);
                  if(($cekTigaBimbingan==0 || ($cekTigaBimbingan == 0)==null) && ($cekLaporanLengkap<=0) ) {
                    echo '-';
                  }else{
                   $cekNilai = $this->m_bimbingan->cekResponNilai($id_syarat_sk);
                   $cekNilaiPembimbingLapangan = $this->m_monitoring_sk->cekNilaiPembimbingLapangan($id_syarat_sk);
                   $cekNilaiDospem = $this->m_monitoring_sk->cekNilaiDospem($id_syarat_sk);
                   if(($cekNilai>0) && ($cekNilai>0) && ($cekNilaiPembimbingLapangan>0)){ ?> 
                   <?php if ($this->m_bimbingan->cekKonfirmasi($id_syarat_sk)>0){ ?>
                   <i class="text-success">Nilai sudah diinput</i>
                   <?php }else{ ?>
                   <a class="btn btn-danger text-white border-white custom-btn btn-sm" data-toggle="modal" data-target="#ModalKonfirmasi<?php echo $id_syarat_sk ?>">Input Nilai</a>
                   <div class="modal fade" id="ModalKonfirmasi<?php echo $id_syarat_sk ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><b class="text-success">Konfirmasi Nilai</b></h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">Apakah yakin ingin konfirmasi nilai ? </div>
                        <form action="<?php echo site_url('/prodi/monitoring_sk/konfirmasi') ?>" method ="post">
                          <input type="hidden" name="id_syarat_sk" value="<?php echo $i['id_syarat_sk']  ?>"></input>
                          <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                            <button class="btn btn-primary" type="submit" name="tombolKonfirmasi">Ya</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <?php } ?>

                  <?php
                }else{
                  echo '-';
                } 
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
if(isset($_SESSION['kode_prodi'])){
  $no = 1;
  foreach ($pencarian_data->result_array() as $i):

    ?>
  <div class="modal fade" id="Modallihat<?php echo $i['id_syarat_sk']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
          <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/prodi/monitoring_sk/row_data')?>">
            <div class="form-group">
              <label>Nama Mahasiswa</label>
              <input type="text" class="form-control" value="<?php echo ucwords($i['nama_mahasiswa']).' ('.$i['npm'].')'; ?>" readonly></input>
            </div>
            <div class="form-group">
              <label>Nama Instansi/ Perusahaan</label>
              <input type="text" name="nama_tempat_kp" class="form-control" value="<?php echo $i['nama_instansi']?>" readonly></input>
            </div>
            <div class="form-group">
              <label>Judul</label>
              <input type="text" name="judul_kerja_praktik" class="form-control" value="<?php echo $i['judul_kerja_praktik']?>"readonly></input>
            </div>
            <div class="form-group">
              <label>Nama Pembimbing Lapangan</label>
              <input type="text" name="nama_pembimbing_lapangan" class="form-control" value="<?php echo $i['nama_pembimbing_lapangan']?>" readonly></input>
            </div>
            <div class="form-group">
              <label>No. HP Pembimbing Lapangan</label>
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
              <label>Lihat Berkas</label><br>
              <a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/sk/'.$i['nama_file_syarat_sk']) ?>">Bukti Penerimaan Kerja Praktek Lapangan di Perusahaan/Instansi Terkait</a><br>
              <a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/sk/spp/'.$i['file_spp_dasar']) ?>">Bukti Pembayaran SPP Dasar</a><br>
              <a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/sk/transkrip/'.$i['file_transkrip']) ?>">Bukti Transkip Nilai Sementara</a><br>
              <a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/sk/laporan/'.$i['file_laporan']) ?>">File Proposal KP</a>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Tutup</button>
            </div>
          </form> 
        </div>
      </div>
    </div>
  </div>
<?php endforeach; } ?> 

<!-- MODAL LIHAT NILAI DOSPEM -->
<?php 
if(isset($_SESSION['kode_prodi'])){
  $no = 1;
  foreach ($pencarian_nilai->result_array() as $i):

    ?>
  <div class="modal fade" id="ModalLihatNilaiDospem<?php echo $i['id_syarat_sk']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b class="text-secondary">Penilaian Dosen Pembimbing</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"> 
          <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/prodi/monitoring_sk/row_data')?>">
           <div class="form-group">
            <label>Sikap, kedisiplinan, kehadiran, kemampuan berkomunikasi, kerjasama</label>
            <input type="number" name="sikap" class="form-control" value="<?php echo $i['sikap']?>" readonly></input><small class="text-primary">Bobot 25%</small>
          </div>
          <div class="form-group">
            <label>Kemampuan/Pemahaman terhadap topik/project KP</label>
            <input type="number" name="pemahaman" class="form-control" value="<?php echo $i['pemahaman']?>"readonly></input>
            <small class="text-primary">Bobot 50%</small>
          </div> 
          <div class="form-group">
            <label>Kelengkapan isi laporan, kesesuaian dengan format penulisan laporan</label>
            <input type="number" name="kelengkapan" class="form-control" value="<?php echo $i['kelengkapan']?>" readonly></input>
            <small class="text-primary">Bobot 25%</small>
          </div>
          <div class="form-group">
            <label>Total Nilai</label> 
            <input class="form-control" value="<?php echo $this->m_bimbingan->kalkulasiNilaiDospem($i['id_syarat_sk']); 
            ?>" readonly=""></input>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Tutup</button>
            <!-- <button class="btn btn-success" type="submit" name="tombolVerifikasi">Verifikasi</button> -->
          </div>
        </form> 
      </div>
    </div>
  </div>
</div>
<?php endforeach; } ?> 

<!-- MODAL DISETUJUI DATA PENGAJUAN SK -->
<?php 
if(isset($_SESSION['kode_prodi']) ){
  $no = 1;
  foreach ($pencarian_data->result_array() as $i):

    ?>
  <div class="modal fade" id="Modalsetuju<?php echo $i['id_syarat_sk']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Persetujuan Validasi Berkas</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Apakah berkas ini disetujui ? </div>
        <br>
        <form action="<?php echo site_url('/prodi/monitoring_sk/persetujuan') ?>" method ="post">
          <input type="hidden" name="id_syarat_sk" value="<?php echo $i['id_syarat_sk']  ?>"></input>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
            <button class="btn btn-success" type="submit" name="tombolSetuju">Ya</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; 
} 
?> 

<!-- MODAL PILIH DOSPEM -->
<?php 
if(isset($_SESSION['kode_prodi'])){
  $no = 1;
  foreach ($pencarian_data->result_array() as $i):

    ?>
  <div class="modal fade" id="ModalPilihDospem<?php echo $i['id_syarat_sk']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b class="text-success">Pilih Pembimbing</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"> 
          <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/prodi/monitoring_sk/simpan_dospem')?>">          
           <div class="form-group">
            <select name="npk" class="form-control" required>
              <option value="">
                --Pilih Dosen--
              </option>
              <?php 
              foreach ($combobox_dosen as $item): 
                $cek_dospem = $this->m_monitoring_sk->cek_jumlah_dibimbing($item['npk']);
              if ($cek_dospem==0) {
                ?>
                <option value="<?php echo $item['npk']  ?>"><?php echo $item['nama_dosen'].' ('.$item['jabatan_fungsional'].') - '.$this->m_monitoring_sk->hitung_jumlah_dibimbing($item['npk']).' Mahasiswa' ?></option>
                <?php 
              }
              endforeach; ?>
            </select>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="id_syarat_sk" value="<?php echo $i['id_syarat_sk']?>"></input>
            <button class="btn btn-secondary" type="reset" data-dismiss="modal">Tutup</button>
            <button class="btn btn-primary" type="submit" name="tombolPilihPembimbing">Simpan</button>
          </div>
        </form>  
      </div>
    </div>
  </div>
</div>
<?php endforeach; 
} 
?> 