<div class="col-lg-12 mb-1">
  <?php echo $this->session->flashdata('messege'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">Penunjukan Sebagai Pembimbing Skripsi</h5>
    </div>
    <div class="content"><br>
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
                      <td align="center"><b>STATUS</b></td>
                      <td align="center"><b>AKSI</b></td>
                      <td align="center"><b>Berkas SK</b></td>
                    </tr>
                  </thead>
                  <tbody>
                   <?php  
                   $no = 1;
                   foreach ($pencarian_data->result_array() as $i):
                    $id_skripsi    = $i['id_skripsi'];
                  $id_persetujuan_usulan_pembimbing = $i['id_persetujuan_usulan_pembimbing'];
                  $nama_mahasiswa  = $i['nama_mahasiswa'];
                  $nama_jenis_sk   = $i['nama_jenis_sk'];
                  $npm             = $i['npm'];
                  $npk             = $i['npk'];
                  ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $npm;?></td>
                    <td><?php echo ucwords($nama_mahasiswa); ?></td>
                    <td><?php echo $nama_jenis_sk;?></td>
                    <td>
                     <i class="fas fa-eye text-primary" data-toggle="modal" data-target="#Modallihat<?php echo $id_skripsi  ?>"></i>
                   </td>
                   <td align="center">
                    <?php
                    $cekPenunjukan = $this->m_dospem_skripsi->cekPenunjukan($i['id_skripsi'], $i['npk'] );
                    if($this->m_dospem_skripsi->cekStatusPenunjukan($i['id_skripsi'], 'Usulan Disetujui', $i['npk'],)>0){
                      echo '<b class="text-success">Penunjukan Sudah disetujui</b>';
                    }elseif($this->m_dospem_skripsi->cekStatusPenunjukan($i['id_skripsi'], 'Usulan Ditolak', $i['npk'],)>0){
                      echo '<b class="btn text-danger" data-toggle="modal" data-target="#ModalAlasanDitolak'.$id_skripsi.'"><i class="fas fa-eye">Penunjukan ditolak </i></b>';
                      ?>
                      <!-- MODAL ALASAN DITOLAK TU -->
                      <div class="modal fade" id="ModalAlasanDitolak<?= $id_skripsi ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"><b class="text-danger">KETERANGAN PENOLAKAN</b></h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <?php 
                              foreach ($this->m_dospem_skripsi->alasan_ditolak($npm, $id_skripsi) as $n): ?>
                              <?php echo $n['alasan_ditolak'];?>
                            <?php endforeach ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php                   
                  }elseif($cekPenunjukan>0){
                    echo '<b class="text-warning">Meminta Persetujuan</b>';
                  }elseif($cekPenunjukan==0){
                    echo '-';
                  }else{
                    echo '-';
                  }
                  ?>
                </td>
                <td>
                 <?php 
                 if ($this->m_dospem_skripsi->cekResponPembimbing($id_skripsi, $npk)<=0) {      
                  ?>
                  <input type="submit" name="tombol_setuju" value="Terima" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modalsetuju<?php echo $id_skripsi  ?>">

                  <div class="modal fade" id="Modalsetuju<?php echo $i['id_skripsi']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel" >Persetujuan Pembimbing Skripsi</h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <form action="<?php echo site_url('/dosen/dospem_skripsi/persetujuan') ?>" method ="post">
                          <div class="modal-body"> 
                            <input type="hidden" name="id_skripsi" value="<?php echo $i['id_skripsi']  ?>"></input>
                            <input type="hidden" name="npk" value="<?php echo $i['npk']  ?>"></input>
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
                  <input type="submit" name="tombol_tolak" value="Tolak" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modaltolak<?php echo $id_skripsi  ?>">

                  <div class="modal fade" id="Modaltolak<?php echo $id_skripsi  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel" >Persetujuan Pembimbing Skripsi</h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/dosen/dospem_skripsi/persetujuan')?>">
                            <div class="form-group">
                              <input type="hidden" name="id_skripsi" value="<?php echo $i['id_skripsi'] ?>" class="form-control"></input>
                              <input type="hidden" name="npk" value="<?php echo $i['npk'] ?>" class="form-control"></input>
                              <label>Alasan Penolakan</label><br>
                              <input type="text" name="alasan_ditolak[]" class="form-control" placeholder="Inputkan Alasan Lain" required=""></input>
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
                </td>
                <td>
                  <?php
                  if (isset($id_skripsi)) {
                    $cekSK = $this->m_dospem_skripsi->cekResponSKFakultas($id_skripsi);
                    if($cekSK>0){
                      ?> 
                      <a target="_BLANK" href="<?php echo site_url('/dosen/dospem_skripsi/cetak_sk_pembimbing_skripsi/').$id_skripsi ?>"><i class="fas fa-download text-success"> Unduh</i></a>
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