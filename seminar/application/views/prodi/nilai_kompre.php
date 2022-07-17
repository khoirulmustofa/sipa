<div class="col-lg-12 mb-1">
  <?php echo $this->session->flashdata('messege'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">Penilaian Sidang Akhir</h5>
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
                     <td align="center"><b>NILAI SKRIPSI</b></td>
                     <td align="center"><b>KONVERSI HURUF</b></td>
                     <td align="center"><b>AKSI</b></td>
                   </tr>
                 </thead>
                 <tbody>
                   <?php 
                   $no = 1;
                   foreach ($pencarian_data as $i):
                    $id_syarat_kompre   = $i['id_syarat_kompre'];
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
                     $cekNilaiKompre = $this->m_penilaian->cekNilaiKompre($id_syarat_kompre, 'Pembimbing');
                     if($cekNilaiKompre>0){
                      ?> 
                      <i class="fas fa-eye text-primary" data-toggle="modal" data-target="#ModalLihatNilaiPembimbing<?php echo $id_syarat_kompre  ?>"></i> 
                      <div class="modal fade" id="ModalLihatNilaiPembimbing<?php echo $i['id_syarat_kompre']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content text-left">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"><b class="text-secondary">Penilaian Sidang Akhir (Pembimbing)</b></h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body"> 
                              <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/prodi/penguji_skripsi/row_data')?>">
                               <div class="form-group">
                                <label >Abstrak</label>
                                <input type="number" name="abstrak" class="form-control" value="<?php echo $this->m_penilaian->get_nilai_kompre($id_syarat_kompre, "abstrak", 'Pembimbing') ?>" readonly></input>
                                <small class="text-primary">Bobot 5%</small>
                              </div>
                              <div class="form-group">
                                <label >Pendahuluan</label>
                                <input type="number" name="pendahuluan" class="form-control" value="<?php echo $this->m_penilaian->get_nilai_kompre($id_syarat_kompre, "pendahuluan", 'Pembimbing') ?>" readonly></input>
                                <small class="text-primary">Bobot 10%</small>
                              </div>
                              <div class="form-group">
                                <label >Tinjauan Pustaka</label>
                                <input type="number" name="tinjauan" class="form-control" value="<?php echo $this->m_penilaian->get_nilai_kompre($id_syarat_kompre, "tinjauan", 'Pembimbing') ?>" readonly></input>
                                <small class="text-primary">Bobot 5%</small>
                              </div>
                              <div class="form-group">
                                <label >Metodologi Penelitian</label>
                                <input type="number" name="metodologi" class="form-control" value="<?php echo $this->m_penilaian->get_nilai_kompre($id_syarat_kompre, "metodologi", 'Pembimbing') ?>" readonly></input>
                                <small class="text-primary">Bobot 15%</small>
                              </div>
                              <div class="form-group">
                                <label >Hasil dan Pembahasan</label>
                                <input type="number" name="hasil" class="form-control" value="<?php echo $this->m_penilaian->get_nilai_kompre($id_syarat_kompre, "hasil", 'Pembimbing') ?>" readonly></input>
                                <small class="text-primary">Bobot 25%</small>
                              </div>
                              <div class="form-group">
                                <label >Kesimpulan dan Saran </label>
                                <input type="number" name="kesimpulan" class="form-control" value="<?php echo $this->m_penilaian->get_nilai_kompre($id_syarat_kompre, "kesimpulan", 'Pembimbing') ?>" readonly></input>
                                <small class="text-primary">Bobot 10%</small>
                              </div>
                              <div class="form-group">
                                <label >Referensi atau Daftar Pustaka</label>
                                <input type="number" name="referensi" class="form-control" value="<?php echo $this->m_penilaian->get_nilai_kompre($id_syarat_kompre, "referensi", 'Pembimbing') ?>" readonly></input>
                                <small class="text-primary">Bobot 5%</small>
                              </div>
                              <div class="form-group">
                                <label >Sistematika Tulisan</label>
                                <input type="number" name="sistematika" class="form-control" value="<?php echo $this->m_penilaian->get_nilai_kompre($id_syarat_kompre, "sistematika", 'Pembimbing') ?>" readonly></input>
                                <small class="text-primary">Bobot 5%</small>
                              </div>
                              <div class="form-group">
                                <label >Presentasi (penampilan, sikap, penyajian, dan pemahaman materi)</label>
                                <input type="number" name="presentasi" class="form-control" value="<?php echo $this->m_penilaian->get_nilai_kompre($id_syarat_kompre, "presentasi", 'Pembimbing') ?>" readonly></input>
                                <small class="text-primary">Bobot 20%</small>
                              </div>
                              <div class="form-group">
                                <label>Total Nilai</label> 
                                <input class="form-control" value="<?php echo $this->m_penilaian->NilaiKomprePembimbing($i['id_syarat_kompre']); 
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
                 $cekNilaiKompre = $this->m_penilaian->cekNilaiKompre($id_syarat_kompre, 'Penguji 1');
                 if($cekNilaiKompre>0){
                  ?> 
                  <i class="fas fa-eye text-primary" data-toggle="modal" data-target="#ModalLihatNilaiPenguji1<?php echo $id_syarat_kompre  ?>"></i> 
                  <div class="modal fade" id="ModalLihatNilaiPenguji1<?php echo $i['id_syarat_kompre']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content text-left">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><b class="text-secondary">Penilaian Sidang Akhir (Penguji 1)</b></h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body"> 
                          <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/prodi/penguji_skripsi/row_data')?>">
                            <div class="form-group">
                              <label >Abstrak</label>
                              <input type="number" name="abstrak" class="form-control" value="<?php echo $this->m_penilaian->get_nilai_kompre($id_syarat_kompre, "abstrak", 'Penguji 1') ?>" readonly></input>
                              <small class="text-primary">Bobot 5%</small>
                            </div>
                            <div class="form-group">
                              <label >Pendahuluan</label>
                              <input type="number" name="pendahuluan" class="form-control" value="<?php echo $this->m_penilaian->get_nilai_kompre($id_syarat_kompre, "pendahuluan", 'Penguji 1') ?>" readonly></input>
                              <small class="text-primary">Bobot 10%</small>
                            </div>
                            <div class="form-group">
                              <label >Tinjauan Pustaka</label>
                              <input type="number" name="tinjauan" class="form-control" value="<?php echo $this->m_penilaian->get_nilai_kompre($id_syarat_kompre, "tinjauan", 'Penguji 1') ?>" readonly></input>
                              <small class="text-primary">Bobot 5%</small>
                            </div>
                            <div class="form-group">
                              <label >Metodologi Penelitian</label>
                              <input type="number" name="metodologi" class="form-control" value="<?php echo $this->m_penilaian->get_nilai_kompre($id_syarat_kompre, "metodologi", 'Penguji 1') ?>" readonly></input>
                              <small class="text-primary">Bobot 15%</small>
                            </div>
                            <div class="form-group">
                              <label >Hasil dan Pembahasan</label>
                              <input type="number" name="hasil" class="form-control" value="<?php echo $this->m_penilaian->get_nilai_kompre($id_syarat_kompre, "hasil", 'Penguji 1') ?>" readonly></input>
                              <small class="text-primary">Bobot 25%</small>
                            </div>
                            <div class="form-group">
                              <label >Kesimpulan dan Saran </label>
                              <input type="number" name="kesimpulan" class="form-control" value="<?php echo $this->m_penilaian->get_nilai_kompre($id_syarat_kompre, "kesimpulan", 'Penguji 1') ?>" readonly></input>
                              <small class="text-primary">Bobot 10%</small>
                            </div>
                            <div class="form-group">
                              <label >Referensi atau Daftar Pustaka</label>
                              <input type="number" name="referensi" class="form-control" value="<?php echo $this->m_penilaian->get_nilai_kompre($id_syarat_kompre, "referensi", 'Penguji 1') ?>" readonly></input>
                              <small class="text-primary">Bobot 5%</small>
                            </div>
                            <div class="form-group">
                              <label >Sistematika Tulisan</label>
                              <input type="number" name="sistematika" class="form-control" value="<?php echo $this->m_penilaian->get_nilai_kompre($id_syarat_kompre, "sistematika", 'Penguji 1') ?>" readonly></input>
                              <small class="text-primary">Bobot 5%</small>
                            </div>
                            <div class="form-group">
                              <label >Presentasi (penampilan, sikap, penyajian, dan pemahaman materi)</label>
                              <input type="number" name="presentasi" class="form-control" value="<?php echo $this->m_penilaian->get_nilai_kompre($id_syarat_kompre, "presentasi", 'Penguji 1') ?>" readonly></input>
                              <small class="text-primary">Bobot 20%</small>
                            </div>
                            <div class="form-group">
                              <label>Total Nilai</label> 
                              <input class="form-control" value="<?php echo $this->m_penilaian->NilaiKomprePenguji1($i['id_syarat_kompre']); 
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
               $cekNilaiKompre = $this->m_penilaian->cekNilaiKompre($id_syarat_kompre, 'Penguji 2');
               if($cekNilaiKompre>0){
                ?> 
                <i class="fas fa-eye text-primary" data-toggle="modal" data-target="#ModalLihatNilaiPenguji2<?php echo $id_syarat_kompre  ?>"></i> 
                <div class="modal fade" id="ModalLihatNilaiPenguji2<?php echo $i['id_syarat_kompre']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content text-left">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><b class="text-secondary">Penilaian Sidang Akhir (Penguji 2)</b></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body"> 
                        <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/prodi/penguji_skripsi/row_data')?>">
                          <div class="form-group">
                            <label >Abstrak</label>
                            <input type="number" name="abstrak" class="form-control" value="<?php echo $this->m_penilaian->get_nilai_kompre($id_syarat_kompre, "abstrak", 'Penguji 2') ?>" readonly></input>
                            <small class="text-primary">Bobot 5%</small>
                          </div>
                          <div class="form-group">
                            <label >Pendahuluan</label>
                            <input type="number" name="pendahuluan" class="form-control" value="<?php echo $this->m_penilaian->get_nilai_kompre($id_syarat_kompre, "pendahuluan", 'Penguji 2') ?>" readonly></input>
                            <small class="text-primary">Bobot 10%</small>
                          </div>
                          <div class="form-group">
                            <label >Tinjauan Pustaka</label>
                            <input type="number" name="tinjauan" class="form-control" value="<?php echo $this->m_penilaian->get_nilai_kompre($id_syarat_kompre, "tinjauan", 'Penguji 2') ?>" readonly></input>
                            <small class="text-primary">Bobot 5%</small>
                          </div>
                          <div class="form-group">
                            <label >Metodologi Penelitian</label>
                            <input type="number" name="metodologi" class="form-control" value="<?php echo $this->m_penilaian->get_nilai_kompre($id_syarat_kompre, "metodologi", 'Penguji 2') ?>" readonly></input>
                            <small class="text-primary">Bobot 15%</small>
                          </div>
                          <div class="form-group">
                            <label >Hasil dan Pembahasan</label>
                            <input type="number" name="hasil" class="form-control" value="<?php echo $this->m_penilaian->get_nilai_kompre($id_syarat_kompre, "hasil", 'Penguji 2') ?>" readonly></input>
                            <small class="text-primary">Bobot 25%</small>
                          </div>
                          <div class="form-group">
                            <label >Kesimpulan dan Saran</label>
                            <input type="number" name="kesimpulan" class="form-control" value="<?php echo $this->m_penilaian->get_nilai_kompre($id_syarat_kompre, "kesimpulan", 'Penguji 2') ?>" readonly></input>
                            <small class="text-primary">Bobot 10%</small>
                          </div>
                          <div class="form-group">
                            <label >Referensi atau Daftar Pustaka</label>
                            <input type="number" name="referensi" class="form-control" value="<?php echo $this->m_penilaian->get_nilai_kompre($id_syarat_kompre, "referensi", 'Penguji 2') ?>" readonly></input>
                            <small class="text-primary">Bobot 5%</small>
                          </div>
                          <div class="form-group">
                            <label >Sistematika Tulisan</label>
                            <input type="number" name="sistematika" class="form-control" value="<?php echo $this->m_penilaian->get_nilai_kompre($id_syarat_kompre, "sistematika", 'Penguji 2') ?>" readonly></input>
                            <small class="text-primary">Bobot 5%</small>
                          </div>
                          <div class="form-group">
                            <label >Presentasi (penampilan, sikap, penyajian, dan pemahaman materi)</label>
                            <input type="number" name="presentasi" class="form-control" value="<?php echo $this->m_penilaian->get_nilai_kompre($id_syarat_kompre, "presentasi", 'Penguji 2') ?>" readonly></input>
                            <small class="text-primary">Bobot 20%</small>
                          </div>
                          <div class="form-group">
                            <label>Total Nilai</label> 
                            <input class="form-control" value="<?php echo $this->m_penilaian->NilaiKomprePenguji2($i['id_syarat_kompre']); 
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
              $cekNilai11 = $this->m_penilaian->cekResponPembimbingKompre($id_syarat_kompre);
              $cekNilai22 = $this->m_penilaian->cekResponPenguji1Kompre($id_syarat_kompre);
              $cekNilai33 = $this->m_penilaian->cekResponPenguji2Kompre($id_syarat_kompre);
              if($cekNilai11>0 && $cekNilai22 && $cekNilai33){
                // echo $this->m_penilaian->kalkulasiNilaiKompre($id_syarat_kompre); ?>
                <!-- <br> -->
                <?php 
                echo round($this->m_penilaian->kalkulasiNilaiKompre($id_syarat_kompre)); 

              }else{
                echo "Nilai belum tersedia";
              }
              ?>
            </td>
            <td>
              <!-- MENAMPILKAN NILAI DENGAN KOME -->
              <!-- <?php echo $this->m_penilaian->NilaiSkripsi($id_syarat_sempro, $id_syarat_kompre); ?> <br> -->
              <?php 
              $cekNilai11 = $this->m_penilaian->cekResponPembimbingKompre($id_syarat_kompre);
              $cekNilai22 = $this->m_penilaian->cekResponPenguji1Kompre($id_syarat_kompre);
              $cekNilai33 = $this->m_penilaian->cekResponPenguji2Kompre($id_syarat_kompre);
              if($cekNilai11>0 && $cekNilai22 && $cekNilai33){
                // ROUND : MEMBULATKAN BILANGAN BERKOMA
                echo round($this->m_penilaian->NilaiSkripsi($id_syarat_sempro, $id_syarat_kompre)); 
              }else{
                echo "Nilai belum tersedia";
              }
              ?>
            </td>
            <td>
              <?php 
              $cekNilai11 = $this->m_penilaian->cekResponPembimbingKompre($id_syarat_kompre);
              $cekNilai22 = $this->m_penilaian->cekResponPenguji1Kompre($id_syarat_kompre);
              $cekNilai33 = $this->m_penilaian->cekResponPenguji2Kompre($id_syarat_kompre);
              if($cekNilai11>0 && $cekNilai22 && $cekNilai33){
                echo $this->m_penilaian->Konversi($id_syarat_sempro, $id_syarat_kompre); 

              }else{
                echo "-";
              }?>
            </td>
            <td>
              <?php 
              $cekNilai11 = $this->m_penilaian->cekResponPembimbingKompre($id_syarat_kompre);
              $cekNilai22 = $this->m_penilaian->cekResponPenguji1Kompre($id_syarat_kompre);
              $cekNilai33 = $this->m_penilaian->cekResponPenguji2Kompre($id_syarat_kompre);
              if($cekNilai11>0 && $cekNilai22 && $cekNilai33){
                if ($this->m_penilaian->cekKonfirmasi($id_syarat_kompre)>0) { ?>
                <i class="text-success">Nilai sudah diinput</i> 
                <?php }else{ ?>
                <a class="btn btn-danger text-white border-white custom-btn btn-sm" data-toggle="modal" data-target="#ModalKonfirmasi<?php echo $id_syarat_kompre ?>">Input Nilai</a>
                <div class="modal fade" id="ModalKonfirmasi<?php echo $id_syarat_kompre ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><b class="text-success">Konfirmasi Nilai</b></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">Apakah yakin ingin konfirmasi nilai ? </div>
                      <form action="<?php echo site_url('/prodi/nilai_kompre/konfirmasi') ?>" method ="post">
                        <input type="hidden" name="id_syarat_kompre" value="<?php echo $i['id_syarat_kompre']  ?>"></input>
                        <div class="modal-footer">
                          <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                          <button class="btn btn-primary" type="submit" name="tombolKonfirmasi">Ya</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              
              <?php } } else{
                echo '-';
              } ?>
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