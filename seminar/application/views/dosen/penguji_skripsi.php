<div class="col-lg-12 mb-1">
  <?php echo $this->session->flashdata('messege'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">Penunjukan Sebagai Penguji Skripsi</h5>
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
                      <td align="center"><b>JADWAL UJIAN</b></td>
                      <td align="center"><b>BERKAS PROPOSAL</b></td>
                      <td align="center"><b>STATUS</b></td>
                      <td align="center"><b>AKSI</b></td>
                      <td align="center"><b>Berkas SK</b></td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php  
                    $no = 1;
                    foreach ($pencarian_data as $i):
                      $id_syarat_sempro = $i['id_syarat_sempro'];
                    $id_penguji_skripsi = $i['id_penguji_skripsi'];
                    $nama_mahasiswa     = $i['nama_mahasiswa'];
                    $nama_seminar       = $i['nama_seminar'];
                    $npm                = $i['npm'];
                    $npk                = $i['npk'];
                    $usulan_tanggal     = $i['usulan_tanggal'];
                    $usulan_jam         = $i['usulan_jam'];
                    ?>
                    <tr>
                      <td><?php echo $no++;?></td>
                      <td><?php echo $npm;?></td>
                      <td><?php echo ucwords($nama_mahasiswa); ?></td>
                      <td><?php echo $nama_seminar;?></td>
                      <td align="center">
                        <?= $this->m_penguji_skripsi->format_tanggal(date('Y-m-d', strtotime($usulan_tanggal))); ?><br><b class="text-danger">Pukul :</b><?php echo date("H:i:s", strtotime($usulan_jam));?></td>
                        <td align="center">
                          <a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sempro/proposal/'.$i['file_proposal']) ?>"><i class="fas fa-eye text-primary"></i></a> 
                        </td>
                        <td align="center">
                          <?php
                          $cekPenunjukan = $this->m_penguji_skripsi->cekPenunjukan($i['id_syarat_sempro']);
                          if($this->m_penguji_skripsi->cekStatusPenunjukan($i['id_syarat_sempro'], 'Usulan Disetujui', $npk)>0){
                            echo '<b class="text-success">Penunjukan Sudah disetujui</b>';
                          }elseif($this->m_penguji_skripsi->cekStatusPenunjukan($i['id_syarat_sempro'], 'Usulan Ditolak', $npk)>0){
                            echo '<b class="btn text-danger" data-toggle="modal" data-target="#ModalAlasanDitolak'.$id_syarat_sempro.'"><i class="fas fa-eye">Penunjukan ditolak </i></b>';
                            ?>
                            <!-- MODAL ALASAN DITOLAK TU -->
                            <div class="modal fade" id="ModalAlasanDitolak<?= $id_syarat_sempro ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                    
                                    <?php echo $this->m_penguji_skripsi->get_alasan($id_penguji_skripsi);?>
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
                         if ($this->m_penguji_skripsi->cekResponPenguji($id_penguji_skripsi)<=0) {      
                          ?>
                          <input type="submit" name="tombol_setuju" value="Terima" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modalsetuju<?php echo $id_syarat_sempro  ?>">

                          <div class="modal fade" id="Modalsetuju<?php echo $i['id_syarat_sempro']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel" >Persetujuan Penguji Skripsi</h5>
                                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <form action="<?php echo site_url('/dosen/penguji_skripsi/persetujuan') ?>" method ="post">
                                  <div class="modal-body"> 
                                    <input type="hidden" name="id_penguji_skripsi" value="<?php echo $i['id_penguji_skripsi']  ?>"></input>
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
                          <input type="submit" name="tombol_tolak" value="Tolak" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modaltolak<?php echo $id_syarat_sempro  ?>">

                          <div class="modal fade" id="Modaltolak<?php echo $id_syarat_sempro  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel" >Persetujuan Penguji Skripsi</h5>
                                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/dosen/penguji_skripsi/persetujuan')?>">
                                    <div class="form-group">
                                      <input type="hidden" name="id_penguji_skripsi" value="<?php echo $i['id_penguji_skripsi'] ?>" class="form-control"></input>
                                      <input type="hidden" name="npk" value="<?php echo $i['npk'] ?>" class="form-control"></input>

                                      <label>Alasan Validasi Ditolak</label><br>
                                      <input type="text" name="alasan_ditolak" class="form-control" placeholder="Inputkan Alasan Lain" required=""></input>
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
                          if (isset($id_syarat_sempro)) {
                            $cekSK = $this->m_penguji_skripsi->cekResponSKFakultas($id_syarat_sempro);
                            if($cekSK>0){
                              ?> 
                              <a target="_BLANK" href="<?php echo site_url('/dosen/penguji_skripsi/cetak_sk_penguji_skripsi/').$id_syarat_sempro ?>"><i class="fas fa-download text-success"> Unduh</i></a>
                              <?php
                            } else {
                              echo 'Tidak Ada Berkas';
                            }              
                          } else{
                            echo '-';
                          }
                          ?>
                        </td>
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
      $id_syarat_sempro   = $i['id_syarat_sempro'];
    $nama_mahasiswa   = $i['nama_mahasiswa'];
    $nama_seminar     = $i['nama_seminar'];
    $npm              = $i['npm'];
    ?>
    <div class="modal fade" id="Modallihat<?php echo $i['id_syarat_sempro']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Data Pengajuan Seminar Proposal</h5>
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
              <label class="bmd-label-floating">Lihat Berkas</label><br>
              
              <a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sempro/proposal/'.$i['file_proposal']) ?>">Berkas Proposal</a><br>
              
            </div>
          </div>
        </div>
      </div> 
    </div>
  <?php endforeach;  ?> 