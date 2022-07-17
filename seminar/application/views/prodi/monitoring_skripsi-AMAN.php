<div class="col-lg-12 mb-1">
  <?php echo $this->session->flashdata('messege'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">Pengajuan SK Skripsi</h5>
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
                      <td align="center"><b>DETAIL</b></td>
                      <td align="center"><b>USULAN PEMBIMBING</b></td>
                      <td align="center"><b>STATUS VALIDASI</b></td>
                      <td align="center"><b>AKSI</b></td>
                    <!-- <td align="center"><b>DETAIL</b></td>
                    <td align="center"><b>AKSI</b></td> -->
                    <td align="center"><b>BERKAS SK</b></td>
                    <td align="center"><b>KARTU BIMBINGAN</b></td>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no = 1;
                  foreach ($pencarian_data->result_array() as $i):
                    $id_skripsi           = $i['id_skripsi'];
                  $id_usulan_pembimbing   = $i['id_usulan_pembimbing'];
                  $nama_mahasiswa         = $i['nama_mahasiswa'];
                  $nama_jenis_sk          = $i['nama_jenis_sk'];
                  $npm                    = $i['npm'];
                  $waktu_persetujuan      = $i['waktu_persetujuan'];
                  $status_persetujuan     = $i['status_persetujuan'];
                  $nama_dosen             = $i['nama_dosen'];
                  $alasan_ditolak         = $i['alasan_ditolak'];
                  $id_usulan_pembimbing   = $i['id_usulan_pembimbing'];
                  $npk                    = $i['npk'];
                  ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $npm;?></td>
                    <td><?php echo ucwords($nama_mahasiswa); ?></td>
                    <td><?php echo $nama_jenis_sk;?></td>
                    <td>
                     <i class="fas fa-eye text-primary" data-toggle="modal" data-target="#Modallihat<?php echo $id_skripsi  ?>"></i>
                   </td>
                   <td>
                    <?php 
                    echo $nama_dosen?>
                  </td>
                  <td align="center">
                    <?php
                    $cekPenunjukanProdi = $this->m_monitoring_skripsi->cekPenunjukanProdi($i['id_skripsi'], $i['id_usulan_pembimbing']);
                    if($this->m_monitoring_skripsi->cekStatusPenunjukanProdi($i['id_skripsi'], $i['id_usulan_pembimbing'], 'Usulan Disetujui')>0){
                      echo '<i class="text-success">Proses Sudah dilanjutkan</i>';
                    }elseif($this->m_monitoring_skripsi->cekStatusPenunjukanProdi($i['id_skripsi'], $i['id_usulan_pembimbing'], 'Usulan Ditolak')>0){
                      echo '<b class="btn text-danger" data-toggle="modal" data-target="#ModalAlasanDitolak'.$id_usulan_pembimbing.'"><i class="fas fa-eye">Usulan ditolak </i></b>';
                      ?>
                      <!-- MODAL ALASAN DITOLAK TU -->
                      <div class="modal fade" id="ModalAlasanDitolak<?= $id_usulan_pembimbing ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"><b class="text-danger">KETERANGAN PENOLAKAN USULAN</b></h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <?php 
                              foreach ($this->m_monitoring_skripsi->alasan_ditolak_usulan($id_skripsi) as $n): ?>
                              <?php echo $n['alasan_ditolak'];?>
                            <?php endforeach ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <a class="btn btn-success text-white border-white custom-btn btn-sm" data-toggle="modal" data-target="#ModalPilihDospem">Pilih Pembimbing</a>
                    <div class="modal fade" id="ModalPilihDospem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                          <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/prodi/monitoring_skripsi/usulan_dospem')?>">          
                            <div class="form-group">
                              <select name="npk" class="form-control" required>
                                <option value="">
                                  --Pilih Dosen--
                                </option>
                                <?php 
                                $kode_prodi = $_SESSION['kode_prodi'];      
                                foreach ($pencarian_dospem as $item): 
                                  ?>
                                <option value="<?php echo $item['npk']  ?>"><?php echo $item['nama_dosen'].' ('.$item['jabatan_fungsional'].') - '.$this->m_monitoring_skripsi->hitung_jumlah_dibimbing($item['npk']).' Mahasiswa' ?></option>
                                <?php 
                                endforeach; 
                                ?>  
                              </select>
                            </div>
                            <div class="modal-footer">
                              <input type="hidden" name="id_skripsi" value="<?php echo $id_skripsi ?>"></input>
                              <input type="hidden" name="npk" value="<?php echo $npk ?>"></input>
                              <button class="btn btn-secondary" type="reset" data-dismiss="modal">Tutup</button>
                              <button class="btn btn-primary" type="submit" name="tombolPilihPembimbing">Simpan</button>
                            </div>
                          </form>  
                        </div>
                      </div>
                    </div>
                  </div>

                  
                  <?php                   
                }elseif($cekPenunjukanProdi>0){
                  echo '<b class="text-warning">Menunggu Respon</b>';
                  // echo '<b class="text-warning">Meminta Persetujuan</b>';
                }elseif($cekPenunjukanProdi==0){
                  echo '-';
                }else{
                  echo '-';
                }
                ?>
              </td>
              <td align="center">
                <?php if ($this->m_monitoring_skripsi->show_histori($id_skripsi)): ?>          
                  <?php 
                  if ($this->m_monitoring_skripsi->cekResponUsulan($id_usulan_pembimbing)<=0) {      
                    ?>
                    <input type="submit" name="tombol_setuju" value="Meneruskan" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modalsetuju<?php echo $id_skripsi  ?>">
                    <div class="modal fade" id="Modalsetuju<?php echo $i['id_skripsi']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" >Meneruskan Proses ke Koordinator</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                          </div>
                          <form action="<?php echo site_url('/prodi/monitoring_skripsi/persetujuan') ?>" method ="post">
                            <div class="modal-body"> 
                              <input type="hidden" name="id_usulan_pembimbing" value="<?php echo $i['id_usulan_pembimbing']  ?>"></input>
                              <label>Apakah yakin ingin meneruskan proses ?</label>
                            </div>
                            <div class="modal-footer">
                              <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                              <button class="btn btn-primary" type="submit" name="tombolSetuju">Ya</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                    <!-- Modal Tolak -->
                    <!-- <input type="submit" name="tombol_tolak" value="Tolak" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modaltolak<?php echo $id_skripsi  ?>"> -->
                    <div class="modal fade" id="Modaltolak<?php echo $id_skripsi  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" >Berkas Ditolak TATAUSAHA</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/prodi/monitoring_skripsi/persetujuan')?>">
                              <div class="form-group">
                                <input type="hidden" name="id_usulan_pembimbing" value="<?php echo $i['id_usulan_pembimbing'] ?>" class="form-control"></input>
                                <label>Alasan Validasi Ditolak</label><br>
                                <input type="checkbox" id="checkItem" name="alasan_ditolak[]" value="Judul yang diajukan Tidak Sesuai dengan Kelompok Keahlian Dosen" > Judul yang diajukan Tidak Sesuai dengan Kelompok Keahlian Dosen<br>
                                <input type="text" name="alasan_ditolak[]" class="form-control" placeholder="Inputkan Alasan Lain"></input>
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
                    <?php }else{ ?>
                    <i class="text-primary">Sudah Direspon</i>
                    <?php } ?>
                  <?php endif ?>

                </td>
                <td>
                  <?php
                  if (isset($id_skripsi)) {
                    $cekSK = $this->m_monitoring_skripsi->cekResponSKFakultas($id_skripsi);
                    if($cekSK>0){
                      ?> 
                      <a target="_BLANK" href="<?php echo site_url('/prodi/monitoring_skripsi/cetak_sk_pembimbing_skripsi/').$id_skripsi ?>"><i class="fas fa-check-circle text-success"></i></a>
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
                  $cekEmpatBimbingan = $this->m_bimbingan_skripsi->cekEmpatBimbingan($id_skripsi); 
                  $cekLaporanLengkap = $this->m_bimbingan_skripsi->cekLaporanLengkap($id_skripsi, "Laporan Lengkap")->num_rows();
                  if(($cekEmpatBimbingan==0 || ($cekEmpatBimbingan == 0)==null) && ($cekLaporanLengkap<=0) ) {
                    echo 'Tidak ada kartu bimbingan';
                  }elseif($this->m_monitoring_skripsi->cekTtdProdi($id_skripsi)>0){
                    ?><a target="_BLANK" href="<?php echo site_url('/prodi/monitoring_skripsi/cetak_kartu_bimbingan_skripsi/').$id_skripsi ?>"><i class="fas fa-download text-success"></i></a> <?php
                  }else{
                    ?>
                    <i class="fas fa-signature text-warning" data-toggle="modal" data-target="#ModalTandaTangan<?php echo $i['id_skripsi'] ?>"></i>
                    <div class="modal fade" id="ModalTandaTangan<?php echo $i['id_skripsi'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" >Tanda tangan Kartu Bimbingan</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                          </div>
                          <form action="<?php echo site_url('/prodi/monitoring_skripsi/tandatanganprodi') ?>" method ="post">
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
                      <?php
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
foreach ($pencarian_data->result_array() as $i):
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