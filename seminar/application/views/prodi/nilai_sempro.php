<div class="col-lg-12 mb-1">
  <?php echo $this->session->flashdata('messege'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">Penilaian Seminar Proposal</h5>
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
                      <td align="center"><b>NILAI PEMBIMBING</b></td>
                      <td align="center"><b>NILAI PENGUJI 1</b></td>
                      <td align="center"><b>NILAI PENGUJI 2</b></td>
                      <td align="center"><b>NILAI KALKULASI</b></td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    foreach ($pencarian_data as $i):
                      $id_syarat_sempro   = $i['id_syarat_sempro'];
                    $nama_mahasiswa     = $i['nama_mahasiswa'];
                    $npm                = $i['npm'];
                    $usulan_tanggal     = $i['usulan_tanggal'];
                    $usulan_jam         = $i['usulan_jam'];
                    ?>
                    <tr>
                      <td><?php echo $no++;?></td>
                      <td><?php echo $npm;?></td>
                      <td><?php echo ucwords($nama_mahasiswa); ?></td>
                      <td>
                       <?php
                       $cekNilaiSempro = $this->m_penilaian->cekNilaiSempro($id_syarat_sempro, 'Pembimbing');
                       if($cekNilaiSempro>0){
                        ?> 
                        <i class="fas fa-eye text-primary" data-toggle="modal" data-target="#ModalLihatNilaiPembimbing<?php echo $id_syarat_sempro  ?>"></i> 
                        <div class="modal fade" id="ModalLihatNilaiPembimbing<?php echo $i['id_syarat_sempro']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                          aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content text-left">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><b class="text-secondary">Penilaian Seminar Proposal (Pembimbing)</b></h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                              </div>
                              <div class="modal-body"> 
                                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/prodi/penguji_skripsi/row_data')?>">
                                  <div class="form-group">
                                    <label >Pendahuluan</label>
                                    <input type="number" name="kepribadian" class="form-control" value="<?php echo $this->m_penilaian->get_nilai($id_syarat_sempro, "pendahuluan", 'Pembimbing') ?>" readonly></input>
                                    <small class="text-primary">Bobot 10%</small>
                                  </div>
                                  <div class="form-group">
                                    <label >Tinjauan</label>
                                    <input type="number" name="kepribadian" class="form-control" value="<?php echo $this->m_penilaian->get_nilai($id_syarat_sempro, "tinjauan", 'Pembimbing') ?>" readonly></input>
                                    <small class="text-primary">Bobot 10%</small>
                                  </div>
                                  <div class="form-group">
                                    <label >Metodologi</label>
                                    <input type="number" name="kepribadian" class="form-control" value="<?php echo $this->m_penilaian->get_nilai($id_syarat_sempro, "metodologi", 'Pembimbing') ?>" readonly></input>
                                    <small class="text-primary">Bobot 10%</small>
                                  </div>
                                  <div class="form-group">
                                    <label >Referensi</label>
                                    <input type="number" name="kepribadian" class="form-control" value="<?php echo $this->m_penilaian->get_nilai($id_syarat_sempro, "referensi", 'Pembimbing') ?>" readonly></input>
                                    <small class="text-primary">Bobot 10%</small>
                                  </div>
                                  <div class="form-group">
                                    <label >Sistematika</label>
                                    <input type="number" name="kepribadian" class="form-control" value="<?php echo $this->m_penilaian->get_nilai($id_syarat_sempro, "sistematika", 'Pembimbing') ?>" readonly></input>
                                    <small class="text-primary">Bobot 10%</small>
                                  </div>
                                  <div class="form-group">
                                    <label >Presentasi</label>
                                    <input type="number" name="kepribadian" class="form-control" value="<?php echo $this->m_penilaian->get_nilai($id_syarat_sempro, "presentasi", 'Pembimbing') ?>" readonly></input>
                                    <small class="text-primary">Bobot 10%</small>
                                  </div>
                                  <div class="form-group">
                                    <label>Total Nilai</label> 
                                    <input class="form-control" value="<?php echo $this->m_penilaian->NilaiSemproPembimbing($i['id_syarat_sempro']); 
                                    ?>" readonly=""></input>
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
                     $cekNilaiSempro = $this->m_penilaian->cekNilaiSempro($id_syarat_sempro, 'Penguji 1');
                     if($cekNilaiSempro>0){
                      ?> 
                      <i class="fas fa-eye text-primary" data-toggle="modal" data-target="#ModalLihatNilaiPenguji1<?php echo $id_syarat_sempro  ?>"></i> 
                      <div class="modal fade" id="ModalLihatNilaiPenguji1<?php echo $i['id_syarat_sempro']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content text-left">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"><b class="text-secondary">Penilaian Penguji 1</b></h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body"> 
                              <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/prodi/penguji_skripsi/row_data')?>">
                                <div class="form-group">
                                  <label >Pendahuluan</label>
                                  <input type="number" name="kepribadian" class="form-control" value="<?php echo $this->m_penilaian->get_nilai($id_syarat_sempro, "pendahuluan", 'Penguji 1') ?>" readonly></input>
                                  <small class="text-primary">Bobot 10%</small>
                                </div>
                                <div class="form-group">
                                  <label >Tinjauan</label>
                                  <input type="number" name="kepribadian" class="form-control" value="<?php echo $this->m_penilaian->get_nilai($id_syarat_sempro, "tinjauan", 'Penguji 1') ?>" readonly></input>
                                  <small class="text-primary">Bobot 10%</small>
                                </div>
                                <div class="form-group">
                                  <label >Metodologi</label>
                                  <input type="number" name="kepribadian" class="form-control" value="<?php echo $this->m_penilaian->get_nilai($id_syarat_sempro, "metodologi", 'Penguji 1') ?>" readonly></input>
                                  <small class="text-primary">Bobot 10%</small>
                                </div>
                                <div class="form-group">
                                  <label >Referensi</label>
                                  <input type="number" name="kepribadian" class="form-control" value="<?php echo $this->m_penilaian->get_nilai($id_syarat_sempro, "referensi", 'Penguji 1') ?>" readonly></input>
                                  <small class="text-primary">Bobot 10%</small>
                                </div>
                                <div class="form-group">
                                  <label >Sistematika</label>
                                  <input type="number" name="kepribadian" class="form-control" value="<?php echo $this->m_penilaian->get_nilai($id_syarat_sempro, "sistematika", 'Penguji 1') ?>" readonly></input>
                                  <small class="text-primary">Bobot 10%</small>
                                </div>
                                <div class="form-group">
                                  <label >Presentasi</label>
                                  <input type="number" name="kepribadian" class="form-control" value="<?php echo $this->m_penilaian->get_nilai($id_syarat_sempro, "presentasi", 'Penguji 1') ?>" readonly></input>
                                  <small class="text-primary">Bobot 10%</small>
                                </div>
                                <div class="form-group">
                                  <label>Total Nilai</label> 
                                  <input class="form-control" value="<?php echo $this->m_penilaian->NilaiSemproPenguji1($i['id_syarat_sempro']); 
                                  ?>" readonly=""></input>
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
                    $cekNilaiSempro = $this->m_penilaian->cekNilaiSempro($id_syarat_sempro, 'Penguji 2');
                    if($cekNilaiSempro>0){
                      ?> 
                      <i class="fas fa-eye text-primary" data-toggle="modal" data-target="#ModalLihatNilaiPenguji2<?php echo $id_syarat_sempro  ?>"></i>
                      <div class="modal fade" id="ModalLihatNilaiPenguji2<?php echo $i['id_syarat_sempro']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content text-left">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"><b class="text-secondary">Penilaian Penguji 2</b></h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body"> 
                              <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/prodi/penguji_skripsi/row_data')?>">
                                <div class="form-group">
                                  <label >Pendahuluan</label>
                                  <input type="number" name="kepribadian" class="form-control" value="<?php echo $this->m_penilaian->get_nilai($id_syarat_sempro, "pendahuluan", 'Penguji 2') ?>" readonly></input>
                                  <small class="text-primary">Bobot 10%</small>
                                </div>
                                <div class="form-group">
                                  <label >Tinjauan</label>
                                  <input type="number" name="kepribadian" class="form-control" value="<?php echo $this->m_penilaian->get_nilai($id_syarat_sempro, "tinjauan", 'Penguji 2') ?>" readonly></input>
                                  <small class="text-primary">Bobot 10%</small>
                                </div>
                                <div class="form-group">
                                  <label >Metodologi</label>
                                  <input type="number" name="kepribadian" class="form-control" value="<?php echo $this->m_penilaian->get_nilai($id_syarat_sempro, "metodologi", 'Penguji 2') ?>" readonly></input>
                                  <small class="text-primary">Bobot 10%</small>
                                </div>
                                <div class="form-group">
                                  <label >Referensi</label>
                                  <input type="number" name="kepribadian" class="form-control" value="<?php echo $this->m_penilaian->get_nilai($id_syarat_sempro, "referensi", 'Penguji 2') ?>" readonly></input>
                                  <small class="text-primary">Bobot 10%</small>
                                </div>
                                <div class="form-group">
                                  <label >Sistematika</label>
                                  <input type="number" name="kepribadian" class="form-control" value="<?php echo $this->m_penilaian->get_nilai($id_syarat_sempro, "sistematika", 'Penguji 2') ?>" readonly></input>
                                  <small class="text-primary">Bobot 10%</small>
                                </div>
                                <div class="form-group">
                                  <label >Presentasi</label>
                                  <input type="number" name="kepribadian" class="form-control" value="<?php echo $this->m_penilaian->get_nilai($id_syarat_sempro, "presentasi", 'Penguji 2') ?>" readonly></input>
                                  <small class="text-primary">Bobot 10%</small>
                                </div>
                                <div class="form-group">
                                  <label>Total Nilai</label> 
                                  <input class="form-control" value="<?php echo $this->m_penilaian->NilaiSemproPenguji2($i['id_syarat_sempro']); 
                                  ?>" readonly=""></input>
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
                    $cekNilai1 = $this->m_penilaian->cekResponPembimbingSempro($id_syarat_sempro);
                    $cekNilai2 = $this->m_penilaian->cekResponPenguji1Sempro($id_syarat_sempro);
                    $cekNilai3 = $this->m_penilaian->cekResponPenguji2Sempro($id_syarat_sempro);
                    if($cekNilai1>0 && $cekNilai2 && $cekNilai3){
                      // echo $this->m_penilaian->kalkulasiNilaiSempro($id_syarat_sempro); 
                      ?>
                      <!-- <br> -->
                      <?php 
                      echo round($this->m_penilaian->kalkulasiNilaiSempro($id_syarat_sempro)); 

                    }else{
                      echo "Nilai belum tersedia";
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