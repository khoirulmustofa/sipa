<!-- tesss -->
<div class="col-lg-12 mb-1">
  <?php echo $this->session->flashdata('messege'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">Pengajuan Surat Pengantar Penelitian</h5>
    </div><br>
    <div class="content">
      <div class="container-fluid">
        <div class="card shadow mb-4">
          <div class="card-body">
            <div class="table-responsive">
              <div class="scroll">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead class="table table-primary">
                    <tr>
                      <td align="center"><b>NO.</b></td>
                      <td align="center"><b>NPM</b></td>
                      <td align="center"><b>NAMA MAHASISWA</b></td>
                      <td align="center"><b>NAMA INSTANSI</b></td>
                      <td align="center"><b>ALAMAT INSTANSI</b></td>
                      <td align="center"><b>DETAIL</b></td>
                      <td align="center"><b>STATUS</b></td>
                      <td align="center"><b>AKSI</b></td>
                      <td align="center"><b>BERKAS</b></td>
                    </tr>
                  </thead>
                  <tbody>
                   <?php 
                   $no = 1;
                   foreach ($pencarian_data as $i):
                     $id_surat_pengantar_penelitian  = $i['id_surat_pengantar_penelitian'];
                   $npm                 = $i['npm'];
                   $nama_mahasiswa      = $i['nama_mahasiswa'];
                   $nama_instansi       = $i['nama_instansi'];
                   $alamat_instansi     = $i['alamat_instansi'];
                   ?>
                   <tr>
                    <td align="center"><?php echo $no++;?></td>
                    <td align="center"><?php echo $npm;?></td>
                    <td align="center"><?php echo ucwords($nama_mahasiswa); ?></td>
                    <td align="center"><?php echo $nama_instansi;?></td>
                    <td align="center"><?php echo $alamat_instansi;?></td>
                    <td>
                     <center>
                      <i class="fas fa-eye text-primary" data-toggle="modal" data-target="#Modallihat<?php echo $id_surat_pengantar_penelitian  ?>"></i>
                    </center>
                    <div class="modal fade" id="Modallihat<?php echo $i['id_surat_pengantar_penelitian']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Berkas Pengajuan Surat Pengantar Penelitian</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                          </div>
                          <div class="modal-body"> 
                            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/fakultas/surat_pengantar_penelitian/row_data')?>">
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
                    $cekSuratPengantar = $this->m_surat_pengantar_penelitian->cekSuratPengantarProdi($i['id_surat_pengantar_penelitian']);
                    if($this->m_surat_pengantar_penelitian->cekStatusPersetujuanSuratPengantar($i['id_surat_pengantar_penelitian'], 'Berkas Disetujui', 'Staff Prodi Teknik')>0){
                      echo '<b class="text-success">Berkas disetujui</b>';
                    }elseif($this->m_surat_pengantar_penelitian->cekStatusPersetujuanSuratPengantar($i['id_surat_pengantar_penelitian'], 'Berkas Ditolak', 'Staff Prodi Teknik')>0){
                      echo '<b class="btn text-danger" data-toggle="modal" data-target="#ModalAlasanDitolakTU'.$id_surat_pengantar_penelitian.'"><i class="fas fa-eye">Berkas ditolak </i></b>';
                      ?>
                      <!-- MODAL ALASAN DITOLAK TU -->
                      <div class="modal fade" id="ModalAlasanDitolakTU<?= $id_surat_pengantar_penelitian ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"><b class="text-danger">KETERANGAN PENOLAKAN BERKAS</b></h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <?php 
                              foreach ($this->m_surat_pengantar_penelitian->alasan_ditolak($npm, $id_surat_pengantar_penelitian) as $n): ?>
                              <?php echo $n['alasan_ditolak'];?>
                            <?php endforeach ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php 
                  }elseif($cekSuratPengantar>0){
                    echo '<b class="text-warning">Meminta Validasi Berkas</b>';
                  }elseif($cekSuratPengantar==0){
                    echo '-';
                  }else{
                    echo '-';
                  }
                  ?>
                </td>
                <td align="center">
                  <?php 
                  if ($this->m_surat_pengantar_penelitian->cekResponSuratPengantarProdi($id_surat_pengantar_penelitian)<=0) {      
                    ?>
                    <input type="submit" name="tombol_setuju" value="Setujui" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modalsetuju<?php echo $id_surat_pengantar_penelitian  ?>">
                    <div class="modal fade" id="Modalsetuju<?php echo $i['id_surat_pengantar_penelitian']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" >Persetujuan Berkas Surat Pengantar Penelitian</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                          </div>
                          <form action="<?php echo site_url('/prodi/surat_pengantar_penelitian/persetujuan') ?>" method ="post">
                            <div class="modal-body"> 
                              <input type="hidden" name="id_surat_pengantar_penelitian" value="<?php echo $i['id_surat_pengantar_penelitian']  ?>"></input>
                              <label>Apakah berkas ini disetujui ?</label>
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
                    <input type="submit" name="tombol_tolak" value="Tolak" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modaltolak<?php echo $id_surat_pengantar_penelitian  ?>">
                    <div class="modal fade" id="Modaltolak<?php echo $id_surat_pengantar_penelitian  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" >Persetujuan Berkas Surat Pengantar Instansi</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/prodi/surat_pengantar_penelitian/persetujuan')?>">
                              <div class="form-group">
                                <input type="hidden" name="id_surat_pengantar_penelitian" value="<?php echo $i['id_surat_pengantar_penelitian'] ?>" class="form-control"></input>
                                <label>Alasan Validasi Ditolak</label><br>
                                <input type="checkbox" id="checkItem" name="alasan_ditolak[]" value="Perusahaan/Instansi yang diajukan Tidak Sesuai" > Perusahaan/Instansi yang diajukan Tidak Sesuai<br>
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
                  </td>
                  <td align="center">
                    <?php
                    if (isset($id_surat_pengantar_penelitian)) {
                      $cekSK = $this->m_surat_pengantar_penelitian->cekResponSuratPengantarPenelitianFakultas($id_surat_pengantar_penelitian);
                      if($cekSK>0){
                        ?> 
                        <a target="_BLANK" href="<?php echo site_url('/prodi/surat_pengantar_penelitian/cetak/').$id_surat_pengantar_penelitian ?>"><i class="fas fa-download text-success"> Unduh</i></a>
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
