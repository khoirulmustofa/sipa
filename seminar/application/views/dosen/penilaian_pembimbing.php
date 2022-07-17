<div class="col-lg-12 mb-1">
  <?php echo $this->session->flashdata('messege'); ?>
  <div class="card shadow mb-4">
    <div class="content"><br>
      <div class="container-fluid">
        <div class="card shadow mb-4">
          <div class="card-body">
           <div class="table-responsive">
            <div class="scroll">
             <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead class="table table-primary">
                <tr>
                  <td align="center"><b>NO.</b></td>
                  <!-- <td align="center"><b>NPM</b></td> -->
                  <td align="center"><b>NAMA MAHASISWA</b></td>
                  <td align="center"><b>JADWAL UJIAN</b></td>
                  <td align="center"><b>SEMINAR PROPOSAL</b></td>
                  <td align="center"><b>SIDANG AKHIR</b></td>
                </tr>
              </thead>
              <tbody>
                <?php  
                $no = 1;
                foreach ($pencarian_data as $i):
                  $id_syarat_sempro = $i['id_syarat_sempro'];
                $id_syarat_kompre = $i['id_syarat_kompre'];
                $nama_mahasiswa   = $i['nama_mahasiswa'];
                // $nama_seminar     = $i['nama_seminar'];
                $npm              = $i['npm'];
                $npk              = $i['npk'];
                $usulan_tanggal   = $i['usulan_tanggal'];
                $usulan_jam       = $i['usulan_jam'];
                ?>
                <tr>
                  <td><?php echo $no++;?></td>
                  <!-- <td><?php echo $npm;?></td> -->
                  <td><?php echo ucwords($nama_mahasiswa); ?></td>
                  <td align="center">
                    <?= $this->m_penguji_skripsi->format_tanggal(date('Y-m-d', strtotime($usulan_tanggal))); ?><br><b class="text-danger">Pukul :</b><?php echo date("H:i:s", strtotime($usulan_jam));?>
                  </td>
                  <td>
                    <?php 
                    if ($this->m_penilaian->cekResponNilai($id_syarat_sempro, $npk)<=0) {      
                      ?>
                      <center>
                        <!-- <?php echo $id_syarat_sempro; ?> -->
                        <a data-toggle="modal" data-target="#ModalPenilaianSempro<?php echo $id_syarat_sempro ?>"><i class="fas fa-plus-circle text-primary"></i></a>
                      </center>
                      <div class="modal fade" id="ModalPenilaianSempro<?php echo $id_syarat_sempro ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                       <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><b class="text-primary">Form Penilaian Proposal<small>(Bobot Nilai 25%)</small> </b></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                          </div>
                          <div class="modal-body" >
                            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/dosen/penilaian_pembimbing/nilai_sempro')?>">
                              <div class="form-group">
                                <input type="hidden" name="npk" value="<?php echo $i['npk']  ?>"></input>
                                <input type="hidden" name="posisi" value="Pembimbing"></input>
                                <label>Pendahuluan<small class="text-primary"> (Nilai 0-100)</small></label>
                                <input type="number" name="pendahuluan" class="form-control" data-toggle="tooltip" data-placement="right" placeholder="Inputkan nilai" required=""></input>
                                <textarea type="text" name="saran_pendahuluan" class="form-control" placeholder="Inputkan saran jika diperlukan"></textarea>
                                <small class="text-primary">Bobot 20%</small>
                                <input type="hidden" value="<?= $id_syarat_sempro ?>" name="id_syarat_sempro" class="form-control" >
                              </div>
                              <div class="form-group">
                                <label>Tinjauan Pustaka<small class="text-primary"> (Nilai 0-100)</small></label>
                                <input type="number" name="tinjauan" class="form-control" data-toggle="tooltip" data-placement="right" placeholder="Inputkan nilai" required=""></input>
                                <textarea type="text" name="saran_tinjauan" class="form-control" placeholder="Inputkan saran jika diperlukan"></textarea>

                                <small class="text-primary">Bobot 15%</small>
                              </div>           
                              <div class="form-group">
                                <label>Metodologi Penelitian<small class="text-primary"> (Nilai 0-100)</small></label>
                                <input type="number" name="metodologi" class="form-control" data-toggle="tooltip" data-placement="right" placeholder="Inputkan nilai" required=""></input>                              
                                <textarea type="text" name="saran_metodologi" class="form-control" placeholder="Inputkan saran jika diperlukan"></textarea>
                                <small class="text-primary">Bobot 25%</small>                        
                              </div>
                              <div class="form-group">
                                <label>Referensi atau Daftar Pustaka<small class="text-primary"> (Nilai 0-100)</small></label>
                                <input type="number" name="referensi" class="form-control" data-toggle="tooltip" data-placement="right" placeholder="Inputkan nilai" required=""></input>
                                <textarea type="text" name="saran_referensi" class="form-control" placeholder="Inputkan saran jika diperlukan"></textarea>
                                <small class="text-primary">Bobot 10%</small>                        
                              </div>
                              <div class="form-group">
                                <label>Sistematika Tulisan<small class="text-primary"> (Nilai 0-100)</small></label>
                                <input type="number" name="sistematika" class="form-control" data-toggle="tooltip" data-placement="right" placeholder="Inputkan nilai" required=""></input>
                                <textarea type="text" name="saran_sistematika" class="form-control" placeholder="Inputkan saran jika diperlukan"></textarea>

                                <small class="text-primary">Bobot 5%</small>                        
                              </div>
                              <div class="form-group">
                                <label>Presentasi (penampilan, sikap, penyajian, dan pemahaman materi)<small class="text-primary"> (Nilai 0-100)</small></label>
                                <input type="number" name="presentasi" class="form-control" data-toggle="tooltip" data-placement="right" placeholder="Inputkan nilai" required=""></input>
                                <textarea type="text" name="saran_presentasi" class="form-control" placeholder="Inputkan saran jika diperlukan"></textarea>

                                <small class="text-primary">Bobot 25%</small>                        
                              </div>
                              <div class="modal-footer">
                                <button class="btn btn-danger" type="reset" data-dismiss="modal">Tutup</button>
                                <button class="btn btn-primary" type="submit" name="tombolNilaiSempro">Submit</button>
                              </div>
                            </form>  
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php }else{ ?>
                    <center>
                      <!-- <?php echo $id_syarat_sempro; ?> -->
                      <i class="fas fa-eye text-primary" data-toggle="modal" data-target="#ModalLihatNilaiPembimbing<?php echo $id_syarat_sempro  ?>"></i>
                    </center>

                    <?php } ?>
                  </td>
                  <td>
                    <?php if ($this->m_monitoring_kompre->cekPersetujuan_kompre($id_syarat_kompre)>0){ 
                      if ($this->m_penilaian->cekResponNilaiKompre($id_syarat_kompre, $npk)<=0) {      
                        ?>
                        <center><a data-toggle="modal" data-target="#ModalPenilaianKompre<?php echo $id_syarat_sempro ?>"><i class="fas fa-plus-circle text-primary"></i></a></center>
                        <div class="modal fade" id="ModalPenilaianKompre<?php echo $id_syarat_sempro ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                         <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"><b class="text-primary">Penilaian Sidang Akhir <small>(Bobot Nilai 25%)</small> </b></h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body" >
                              <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/dosen/penilaian_pembimbing/nilai_kompre')?>">
                                <div class="form-group">
                                  <label>Abstrak<small class="text-primary"> (Nilai 0-100)</small></label>
                                  <input type="number" name="abstrak" class="form-control" data-toggle="tooltip" data-placement="right" placeholder="Inputkan nilai" ></input>
                                  <textarea type="text" name="saran_abstrak" class="form-control" placeholder="Inputkan saran jika diperlukan"></textarea>
                                  <small class="text-primary">Bobot 5%</small>
                                  <input type="hidden" value="<?= $id_syarat_kompre ?>" name="id_syarat_kompre" class="form-control" >
                                  <input type="hidden" name="npk" value="<?php echo $i['npk']  ?>"></input>
                                  <input type="hidden" name="posisi" value="Pembimbing"></input>
                                </div>
                                <div class="form-group">
                                  <label>Pendahuluan<small class="text-primary"> (Nilai 0-100)</small></label>
                                  <input type="number" name="pendahuluan" class="form-control" data-toggle="tooltip" data-placement="right" placeholder="Inputkan nilai" ></input>
                                  <textarea type="text" name="saran_pendahuluan" class="form-control" placeholder="Inputkan saran jika diperlukan"></textarea>
                                  <small class="text-primary">Bobot 10%</small>
                                </div>
                                <div class="form-group">
                                  <label>Tinjauan Pustaka<small class="text-primary"> (Nilai 0-100)</small></label>
                                  <input type="number" name="tinjauan" class="form-control" data-toggle="tooltip" data-placement="right" placeholder="Inputkan nilai" ></input>
                                  <textarea type="text" name="saran_tinjauan" class="form-control" placeholder="Inputkan saran jika diperlukan"></textarea>

                                  <small class="text-primary">Bobot 5%</small>
                                </div>           
                                <div class="form-group">
                                  <label>Metodologi Penelitian<small class="text-primary"> (Nilai 0-100)</small></label>
                                  <input type="number" name="metodologi" class="form-control" data-toggle="tooltip" data-placement="right" placeholder="Inputkan nilai" ></input>                              
                                  <textarea type="text" name="saran_metodologi" class="form-control" placeholder="Inputkan saran jika diperlukan"></textarea>
                                  <small class="text-primary">Bobot 15%</small>                        
                                </div>
                                <div class="form-group">
                                  <label>Hasil dan Pembahasan<small class="text-primary"> (Nilai 0-100)</small></label>
                                  <input type="number" name="hasil" class="form-control" data-toggle="tooltip" data-placement="right" placeholder="Inputkan nilai" ></input>                              
                                  <textarea type="text" name="saran_hasil" class="form-control" placeholder="Inputkan saran jika diperlukan"></textarea>
                                  <small class="text-primary">Bobot 25%</small>                        
                                </div>
                                <div class="form-group">
                                  <label>Kesimpulan dan Saran<small class="text-primary"> (Nilai 0-100)</small></label>
                                  <input type="number" name="kesimpulan" class="form-control" data-toggle="tooltip" data-placement="right" placeholder="Inputkan nilai" ></input>                              
                                  <textarea type="text" name="saran_kesimpulan" class="form-control" placeholder="Inputkan saran jika diperlukan"></textarea>
                                  <small class="text-primary">Bobot 10%</small>                        
                                </div>
                                <div class="form-group">
                                  <label>Referensi atau Daftar Pustaka<small class="text-primary"> (Nilai 0-100)</small></label>
                                  <input type="number" name="referensi" class="form-control" data-toggle="tooltip" data-placement="right" placeholder="Inputkan nilai" ></input>
                                  <textarea type="text" name="saran_referensi" class="form-control" placeholder="Inputkan saran jika diperlukan"></textarea>
                                  <small class="text-primary">Bobot 5%</small>                        
                                </div>
                                <div class="form-group">
                                  <label>Sistematika Tulisan<small class="text-primary"> (Nilai 0-100)</small></label>
                                  <input type="number" name="sistematika" class="form-control" data-toggle="tooltip" data-placement="right" placeholder="Inputkan nilai" ></input>
                                  <textarea type="text" name="saran_sistematika" class="form-control" placeholder="Inputkan saran jika diperlukan"></textarea>

                                  <small class="text-primary">Bobot 5%</small>                        
                                </div>
                                <div class="form-group">
                                  <label>Presentasi (penampilan, sikap, penyajian, dan pemahaman materi)<small class="text-primary"> (Nilai 0-100)</small></label>
                                  <input type="number" name="presentasi" class="form-control" data-toggle="tooltip" data-placement="right" placeholder="Inputkan nilai" ></input>
                                  <textarea type="text" name="saran_metodologi" class="form-control" placeholder="Inputkan saran jika diperlukan"></textarea>

                                  <small class="text-primary">Bobot 20%</small>                        
                                </div>
                                <div class="modal-footer">
                                  <button class="btn btn-danger" type="reset" data-dismiss="modal">Tutup</button>
                                  <button class="btn btn-primary" type="submit" name="tombolNilaiKompre">Submit</button>
                                </div>
                              </form>  
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php }else{ ?>
                      <center>
                        <!-- <?php echo $id_syarat_sempro; ?> -->
                        <i class="fas fa-eye text-primary" data-toggle="modal" data-target="#ModalLihatNilaiPembimbingKompre<?php echo $id_syarat_kompre  ?>"></i>
                      </center>

                      <?php } ?>
                      <?php }else{ 
                        echo '<center>-</center>';
                      } ?>
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


<?php 
$no = 1;
foreach ($pencarian_data as $i):
  $id_syarat_sempro         = $i['id_syarat_sempro'];

?>
<div class="modal fade" id="ModalLihatNilaiPembimbing<?php echo $i['id_syarat_sempro']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content text-left">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b class="text-secondary">Penilaian Seminar Proposal</b></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"> 
        <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/prodi/penguji_skripsi/row_data')?>">
          <div class="form-group">
            <label >Pendahuluan</label>
            <input type="number" name="pendahuluan" class="form-control" value="<?php echo $this->m_penilaian->get_nilai($id_syarat_sempro, "pendahuluan", 'Pembimbing') ?>" readonly></input>
            <small class="text-primary">Bobot 20%</small>
          </div>
          <div class="form-group">
            <label >Tinjauan Pustaka</label>
            <input type="number" name="tinjauan" class="form-control" value="<?php echo $this->m_penilaian->get_nilai($id_syarat_sempro, "tinjauan", 'Pembimbing') ?>" readonly></input>
            <small class="text-primary">Bobot 15%</small>
          </div>
          <div class="form-group">
            <label >Metodologi Penelitian</label>
            <input type="number" name="metodologi" class="form-control" value="<?php echo $this->m_penilaian->get_nilai($id_syarat_sempro, "metodologi", 'Pembimbing') ?>" readonly></input>
            <small class="text-primary">Bobot 25%</small>
          </div>
          <div class="form-group">
            <label >Referensi atau Daftar Pustaka</label>
            <input type="number" name="referensi" class="form-control" value="<?php echo $this->m_penilaian->get_nilai($id_syarat_sempro, "referensi", 'Pembimbing') ?>" readonly></input>
            <small class="text-primary">Bobot 10%</small>
          </div>
          <div class="form-group">
            <label >Sistematika Tulisan</label>
            <input type="number" name="sistematika" class="form-control" value="<?php echo $this->m_penilaian->get_nilai($id_syarat_sempro, "sistematika", 'Pembimbing') ?>" readonly></input>
            <small class="text-primary">Bobot 5%</small>
          </div>
          <div class="form-group">
            <label >Presentasi (penampilan, sikap, penyajian, dan pemahaman materi)</label>
            <input type="number" name="presentasi" class="form-control" value="<?php echo $this->m_penilaian->get_nilai($id_syarat_sempro, "presentasi", 'Pembimbing') ?>" readonly></input>
            <small class="text-primary">Bobot 25%</small>
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
endforeach; 
?>

<?php 
$no = 1;
foreach ($pencarian_data as $i):
  $id_syarat_kompre         = $i['id_syarat_kompre'];

?>
<div class="modal fade" id="ModalLihatNilaiPembimbingKompre<?php echo $i['id_syarat_kompre']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content text-left">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b class="text-secondary">Penilaian Sidang Akhir</b></h5>
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
          <div class="modal-footer">
            <button class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Tutup</button>
          </div>
        </form> 
      </div>
    </div>
  </div>
</div>
<?php 
endforeach; 
?>