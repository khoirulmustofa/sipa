<div class="col-lg-12 mb-1">
  <?php echo $this->session->flashdata('messege'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">Pengajuan SK Penguji</h5>
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
                      <td align="center"><b>USULAN UJIAN</b></td>
                      <td align="center"><b>DETAIL</b></td>
                      <td align="center"><b>PILIH PENGUJI</b></td>
                      <td align="center"><b>BERKAS SK</b></td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    foreach ($pencarian_data as $i):
                      $id_syarat_sempro   = $i['id_syarat_sempro'];
                    $nama_mahasiswa     = $i['nama_mahasiswa'];
                    $nama_seminar       = $i['nama_seminar'];
                    $npm                = $i['npm'];
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
                        <td>
                          <i class="fas fa-eye text-primary" data-toggle="modal" data-target="#Modallihat<?php echo $id_syarat_sempro  ?>"></i>
                        </td>
                        <td>
                          <?php
                          if($this->m_penguji_skripsi->cekResponPenguji1($i['id_syarat_sempro'], 'Penguji 1')<1){ ?>
                          <a class="btn btn-success text-white border-white custom-btn btn-sm" data-toggle="modal" data-target="#ModalPilihPenguji1">Penguji 1</a>
                          <div class="modal fade" id="ModalPilihPenguji1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                          aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><b class="text-success">Pilih Penguji 1</b></h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                              </div>
                              <div class="modal-body"> 
                                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/prodi/penguji_skripsi/penguji')?>">         
                                  <div class="form-group">
                                    <select name="npk" class="form-control" required>
                                      <option value="">
                                        --Pilih Dosen--
                                      </option>
                                      <?php 
                                      $kode_prodi = $_SESSION['kode_prodi'];      
                                      foreach ($pencarian_dospem as $item): 
                                        ?>
                                      <option value="<?php echo $item['npk']  ?>"><?php echo $item['nama_dosen'] ?></option>
                                      <?php 
                                      endforeach; 
                                      ?>  
                                    </select>
                                  </div>
                                  <div class="modal-footer">
                                    <input type="hidden" name="posisi" value="Penguji 1"></input>
                                    <input type="hidden" name="id_syarat_sempro" value="<?php echo $id_syarat_sempro ?>"></input>
                                    <button class="btn btn-secondary" type="reset" data-dismiss="modal">Tutup</button>
                                    <button class="btn btn-primary" type="submit" name="tombolPilihPenguji">Simpan</button>
                                  </div>
                                </form>  
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <?php 
                      }elseif($this->m_penguji_skripsi->cekResponPenguji11($i['id_syarat_sempro'], 'Penguji 1', '')>0){
                        echo 'Menunggu Respon Penguji 1';

                      }elseif($this->m_penguji_skripsi->cekResponPenguji11($i['id_syarat_sempro'], 'Penguji 1', 'Usulan Ditolak')>0){
                        echo '<b class="btn text-danger" data-toggle="modal" data-target="#ModalAlasanDitolak'.$id_syarat_sempro.'"><i class="fas fa-eye">Penunjukan ditolak Penguji 1</i></b>';
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
                                NAMA PENGUJI 1 : <?php echo $this->m_penguji_skripsi->get_nama_penguji($id_syarat_sempro, 'Penguji 1');?>
                                <br>
                                ALASAN DITOLAK : <?php echo $this->m_penguji_skripsi->get_alasan_penguji($id_syarat_sempro);?>
                              </div>
                            </div>
                          </div>
                        </div>
                        <a class="btn btn-success text-white border-white custom-btn btn-sm" data-toggle="modal" data-target="#ModalPilihPenguji1">Penguji 1</a>
                        <div class="modal fade" id="ModalPilihPenguji1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"><b class="text-success">Pilih Penguji 1</b></h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body"> 
                              <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/prodi/penguji_skripsi/penguji')?>">         
                                <div class="form-group">
                                  <select name="npk" class="form-control" required>
                                    <option value="">
                                      --Pilih Dosen--
                                    </option>
                                    <?php 
                                    $kode_prodi = $_SESSION['kode_prodi'];      
                                    foreach ($pencarian_dospem as $item): 
                                      ?>
                                    <option value="<?php echo $item['npk']  ?>"><?php echo $item['nama_dosen'] ?></option>
                                    <?php 
                                    endforeach; 
                                    ?>  
                                  </select>
                                </div>
                                <div class="modal-footer">
                                  <input type="hidden" name="posisi" value="Penguji 1"></input>
                                  <input type="hidden" name="id_syarat_sempro" value="<?php echo $id_syarat_sempro ?>"></input>
                                  <button class="btn btn-secondary" type="reset" data-dismiss="modal">Tutup</button>
                                  <button class="btn btn-primary" type="submit" name="tombolPilihPenguji">Simpan</button>
                                </div>
                              </form>  
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php 
                    }else{
                      echo '<b class="text-primary">Diterima</b> Penguji 1';
                    }
                    ?>
                    <br>
                    <?php
                    if($this->m_penguji_skripsi->cekResponPenguji1($i['id_syarat_sempro'], 'Penguji 2')<1){ ?>
                    <a class="btn btn-success text-white border-white custom-btn btn-sm" data-toggle="modal" data-target="#ModalPilihPenguji2">Penguji 2</a>
                    <div class="modal fade" id="ModalPilihPenguji2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><b class="text-success">Pilih Penguji 2</b></h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body"> 
                          <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/prodi/penguji_skripsi/penguji')?>">         
                            <div class="form-group">
                              <select name="npk" class="form-control" required>
                                <option value="">
                                  --Pilih Dosen--
                                </option>
                                <?php 
                                $kode_prodi = $_SESSION['kode_prodi'];      
                                foreach ($pencarian_dospem as $item): 
                                  ?>
                                <option value="<?php echo $item['npk']  ?>"><?php echo $item['nama_dosen'] ?></option>
                                <?php 
                                endforeach; 
                                ?>  
                              </select>
                            </div>
                            <div class="modal-footer">
                              <input type="hidden" name="id_syarat_sempro" value="<?php echo $id_syarat_sempro ?>"></input>
                              <!-- <input type="hidden" name="npk" value="<?php echo $npk ?>"></input> -->
                              <input type="hidden" name="posisi" value="Penguji 2"></input>
                              <button class="btn btn-secondary" type="reset" data-dismiss="modal">Tutup</button>
                              <button class="btn btn-primary" type="submit" name="tombolPilihPenguji">Simpan</button>
                            </div>
                          </form>  
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php 
                }elseif($this->m_penguji_skripsi->cekResponPenguji11($i['id_syarat_sempro'], 'Penguji 2', '')>0){
                  echo 'Menunggu Respon Penguji 2';

                }elseif($this->m_penguji_skripsi->cekResponPenguji11($i['id_syarat_sempro'], 'Penguji 2', 'Usulan Ditolak')>0){

                 echo '<b class="btn text-danger" data-toggle="modal" data-target="#ModalAlasanDitolak'.$id_syarat_sempro.'"><i class="fas fa-eye">Penunjukan ditolak Penguji 2</i></b>';
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
                        NAMA PENGUJI 2 : <?php echo $this->m_penguji_skripsi->get_nama_penguji($id_syarat_sempro, 'Penguji 2');?>
                        <br>
                        ALASAN DITOLAK : <?php echo $this->m_penguji_skripsi->get_alasan_penguji($id_syarat_sempro);?>
                      </div>
                    </div>
                  </div>
                </div>
                <a class="btn btn-success text-white border-white custom-btn btn-sm" data-toggle="modal" data-target="#ModalPilihPenguji2">Penguji 2</a>

                <?php 
              }else{
                echo '<b class="text-primary">Diterima</b> Penguji 2';
              }
              ?>
            </td>
            <td>
             <?php
             if (isset($id_syarat_sempro)) {
              $cekSK = $this->m_penguji_skripsi->cekResponSKFakultas($id_syarat_sempro);
              if($cekSK>0){
                ?> 
                <a target="_BLANK" href="<?php echo site_url('/prodi/penguji_skripsi/cetak_sk_penguji_skripsi/').$id_syarat_sempro ?>"><i class="fas fa-download text-success"> Unduh</i></a>
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
  $id_syarat_sempro = $i['id_syarat_sempro'];
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
          <table border="0" width="100%" cellspacing="1" cellpadding="2">
            <tr>
              <td>
                <a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sempro/krs/'.$i['file_krs']) ?>">Berkas KRS</a><br>
              </td>
            </tr>
            <tr>
              <td>
                <a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sempro/spp/'.$i['file_spp']) ?>">Berkas SPP</a><br>
              </td>
            </tr>
            <tr>
              <td>
                <a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sempro/proposal/'.$i['file_proposal']) ?>">Berkas Proposal</a><br>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endforeach;  ?> 