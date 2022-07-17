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
                  <td align="center"><b>NPM</b></td>
                  <td align="center"><b>NAMA MAHASISWA</b></td>
                  <td align="center"><b>LAPORAN P1</b></td>
                  <td align="center"><b>P1</b></td>
                  <td align="center"><b>LAPORAN P2</b></td>
                  <td align="center"><b>P2</b></td>
                  <td align="center"><b>LAPORAN P3</b></td>
                  <td align="center"><b>P3</b></td>
                  <td align="center"><b>LAPORAN LENGKAP</b></td>
                  <td align="center"><b>PENILAIAN</td>
                  <td align="center"><b>KARTU BIMBINGAN</td>
                </tr>
              </thead>
              <tbody>
                <?php  
                $no = 1;
                foreach ($pencarian_data->result_array() as $i):
                  $id_syarat_sk    = $i['id_syarat_sk'];
                $npm             = $i['npm'];
                $nama_mahasiswa  = $i['nama_mahasiswa'];
                ?>
                <tr>
                  <td align="center"><?php echo $no++;?></td>
                  <td align="center"><?php echo $npm;?></td>
                  <td align="center"><?php echo ucwords($nama_mahasiswa);?></td>
                  <?php
                  $jumlah = 3;
                  for ($j=0; $j < $jumlah; $j++) { 
                    ?>
                    <td>
                     <?php
                     $cekLaporanLengkap = $this->m_bimbingan->cekLaporanLengkap($id_syarat_sk, ($j+1));
                     if($cekLaporanLengkap->num_rows()<1){ 
                       echo '<b class="text-danger"> (Belum ada file)</b>';
                       ?>
                       <?php

                     }else{
                       if ($baris = $cekLaporanLengkap->row()) {
                        $file = $baris->file;
                      } else{
                        $file = '';
                      }
                      echo '<a target="_BLANK" class="text-primary" href="'.base_url('templates/file/mahasiswa/syarat_sk/sk/laporan_acc/').$file.'">(Lihat File)</a>' ; 
                    }
                    ?>
                  </td>
                  <td>
                    <?php
                    $cekHasil = $this->m_bimbingan->cekPertemuanBimbingan($id_syarat_sk, $j+1);
                    if($cekHasil>0){ 
                      ?>                
                      <center>
                        <i class="fas fa-check-circle text-success" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#ModalLihatBimbingan<?php echo $id_syarat_sk.($j+1) ?>" ></i>
                      </center>
                      <div class="modal fade" id="ModalLihatBimbingan<?php echo $id_syarat_sk.($j+1) ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                       <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><b class="text-success">Data Bimbingan Mahasiswa</b></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                          </div>
                          <div class="modal-body"> 
                            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/dosen/bimbingan/row_data')?>">
                              <div class="form-group">
                                <label>Tanggal Bimbingan</label>
                                <input type="text" name="waktu_input_bimbingan" class="form-control" value="<?php echo $this->m_sk->format_tanggal(date('Y-m-d', strtotime($this->m_bimbingan->ambilItem($id_syarat_sk, ($j+1), "waktu_input_bimbingan")))); ?>" readonly></input>
                              </div>
                              <div class="form-group">
                                <label>Jenis Bimbingan</label>
                                <input type="text" name="jenis_pertemuan_bimbingan" class="form-control" value="<?php echo $this->m_bimbingan->ambilItem($id_syarat_sk, ($j+1), "jenis_pertemuan_bimbingan") ?>" readonly></input>
                              </div>
                              <div class="form-group">
                                <label>Materi Bimbingan</label>
                                <input type="text" name="materi_bimbingan" class="form-control" value="<?php echo $this->m_bimbingan->ambilItem($id_syarat_sk, ($j+1), "materi_bimbingan") ?>"readonly></input>
                              </div>
                              <div class="form-group">
                                <label>Hasil Bimbingan</label>
                                <input type="text" name="hasil_bimbingan" class="form-control" value="<?php echo $this->m_bimbingan->ambilItem($id_syarat_sk, ($j+1), "hasil_bimbingan") ?>" readonly></input>
                              </div>
                              <div class="form-group">
                                <label>Lampiran</label><br>
                                <?php 
                                $file_bimbingan = $this->m_bimbingan->get_file_lampiran_bimbingan($id_syarat_sk, ($j+1));
                                if ($file_bimbingan!="") {
                                  ?>
                                  <a target="_BLANK" href="<?php echo base_url('templates/file/dosen/lampiran_bimbingan/'.$file_bimbingan) ?>">Berkas Lampiran</a>
                                  <?php   
                                }else{
                                  echo '<i class="text-danger">Tidak ada data lampiran</i>';
                                }
                                ?>
                              </div>
                              <div class="modal-footer">
                                <button class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Tutup</button>
                              </div>
                            </form> 
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php }else{
                      if($this->m_bimbingan->cek_laporan_pertemuan($id_syarat_sk, $j+1)>0){
                        ?>
                        <a data-toggle="modal" data-target="#ModalTambahBimbingan<?php echo $id_syarat_sk.($j+1) ?>"><i class="fas fa-plus-circle text-primary"></i></a>
                        <!-- TAMBAH DATA BIMBINGAN -->
                        <div class="modal fade" id="ModalTambahBimbingan<?php echo $id_syarat_sk.($j+1) ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                         <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"><b class="text-primary">Tambah Data Bimbingan</b></h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/dosen/bimbingan/tambah_bimbingan')?>">
                                <div class="form-group">
                                  <label>Bimbingan Ke-</label>
                                  <input type="text" name="bimbingan_ke" value="<?= ($j+1) ?>" class="form-control" readonly>
                                  <input type="hidden" value="<?= $id_syarat_sk ?>" name="id_syarat_sk" class="form-control" >
                                  <input type="hidden" value="<?= $npm ?>" name="npm" class="form-control" >
                                  <input type="hidden" value="<?= $nama_mahasiswa ?>" name="nama_mahasiswa" class="form-control" >
                                </div>
                                <div class="form-group">
                                  <label>Jenis Bimbingan</label>
                                  <select class="form-control user text-dark" id="jenis_pertemuan_bimbingan" name="jenis_pertemuan_bimbingan" required="">
                                    <option value="">--Jenis Bimbingan--</option>
                                    <option value="Offline">Offline</option>
                                    <option value="Online">Online</option>
                                  </select>
                                </div>           
                                <div class="form-group">
                                  <label>Materi Bimbingan</label>
                                  <textarea class="form-control" name="materi_bimbingan"></textarea>
                                </div>
                                <div class="form-group">
                                  <label>Revisi Bimbingan</label>
                                  <textarea class="form-control" name="hasil_bimbingan"></textarea>
                                </div>
                                <div class="form-group">
                                  <label class="bmd-label-floating">Lampiran </label><small class="text-primary"> *Opsional</small>
                                  <input type="file"   class="form-control-file" name="file_lampiran" id="file_lampiran">
                                </div>
                                <div class="modal-footer">
                                  <button class="btn btn-danger" type="reset" data-dismiss="modal">Tutup</button>
                                  <button class="btn btn-primary" type="submit" name="tombolBimbingan">Submit</button>
                                </div>
                              </form>  
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php
                    }else{
                      echo '<i class="text-danger">Materi bimbingan belum diupload oleh mahasiswa</i>';
                    }
                  }
                }
                ?>
              </td>
              <td align="center">
                <?php
                $cekLaporanLengkap = $this->m_bimbingan->cekLaporanLengkap($id_syarat_sk, 'Laporan Lengkap');
                if($cekLaporanLengkap->num_rows()<1){ 
                 echo '<b class="text-danger"> (Belum ada file)</b>';
                 ?>
                 <?php

               }else{
                 if ($baris = $cekLaporanLengkap->row()) {
                  $file = $baris->file;
                } else{
                  $file = '';
                }
                echo '<a target="_BLANK" class="text-primary" href="'.base_url('templates/file/mahasiswa/syarat_sk/sk/laporan_acc/').$file.'">(Lihat File)</a>' ; 
              }
              ?>
            </td>
            <td>
              <?php
              $cekTigaBimbingan = $this->m_bimbingan->cekTigaBimbingan($id_syarat_sk); 
              $cekLaporanLengkap = $this->m_bimbingan->cekLaporanLengkap($id_syarat_sk, 'Laporan Lengkap')->num_rows();
              if(($cekTigaBimbingan==0 || ($cekTigaBimbingan == 0)==null) && ($cekLaporanLengkap<=0) ) {
                echo 'Maaf, Nilai belum bisa diinputkan..';
              }else{
                $cekNilai = $this->m_bimbingan->cekResponNilai($id_syarat_sk);
                if($cekNilai>0){ ?> 
                <center>
                  <i class="fas fa-check-circle text-success" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#ModalLihat<?php echo $id_syarat_sk ?>" ></i> 
                </center>
                <?php
              } else { ?>
              <center><a data-toggle="modal" data-target="#ModalPenilaian<?php echo $id_syarat_sk ?>"><i class="fas fa-plus-circle text-primary"></i></a></center>
              <!-- PENILAIAN BIMBINGAN -->
              <div class="modal fade" id="ModalPenilaian<?php echo $id_syarat_sk ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b class="text-primary">Silahkan Input Nilai Mahasiswa</b></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body" >
                    <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/dosen/bimbingan/nilai_bimbingan')?>">
                      <div class="form-group">
                        <label>Sikap, kedisiplinan, kehadiran, kemampuan berkomunikasi, kerjasama<small class="text-primary"> (Nilai 0-100)</small></label>
                        <input type="number" name="sikap" class="form-control" data-toggle="tooltip" data-placement="right" title="
                        ===== (Nilai>80) =====
                        Mampu menunjukkan sikap dan kedisiplinan yang sangat baik selama pengerjaan laporan KP,
                        Mampu berkomunikasi dengan sangat baik selama proses pembimbingan -------------

                        == (Nilai>70 & Nilai<=80) ==
                        Mampu menunjukkan sikap dan kedisiplinan yang baik selama pengerjaan laporan KP,
                        Mampu berkomunikasi dengan baik selama proses pembimbingan -------------
                        
                        == (Nilai>60 & Nilai<=70) ==
                        Kurang mampu menunjukkan sikap dan kedisiplinan yang baik selama pengerjaan laporan KP,
                        Kurang mampu berkomunikasi dengan baik selama proses pembimbingan -------------

                        ===== (Nilai<=60) =====
                        Tidak mampu menunjukkan sikap dan kedisiplinan yang baik dalam pengerjaan laporan KP,
                        Tidak mampu berkomunikasi dengan baik selama proses pembimbingan -------------
                        "></input>
                        <script>
                          $(document).ready(function(){
                            $('[data-toggle="tooltip"] ').tooltip();
                          })
                        </script>
                        <small class="text-primary">Bobot 25%</small>
                        <input type="hidden" value="<?= $id_syarat_sk ?>" name="id_syarat_sk" class="form-control" >
                      </div>
                      <div class="form-group">
                        <label>Kemampuan/Pemahaman terhadap topik/project KP<small class="text-primary"> (Nilai 0-100)</small></label>
                        <input type="number" name="pemahaman" class="form-control" data-toggle="tooltip" data-placement="right" title="
                        ===== (Nilai>80) =====
                        Mampu memahami dan menjelaskan dengan sangat baik tentang topik KP yang telah dilakukan,
                        Mampu mendeskripsikan dengan sangat baik keadaan di lapangan secara lisan dan tulisan ---------------------

                         == (Nilai>70 & Nilai<=80) ==
                        Mampu memahami dan menjelaskan dengan baik tentang topik KP yang telah dilakukan,
                        Mampu mendeskripsikan dengan baik keadaan di lapangan secara lisan dan tulisan ----

                         == (Nilai>60 & Nilai<=70) ==
                        Kurang mampu memahami dan menjelaskan tentang topik KP yang telah dilakukan,
                        Kurang mampu mendeskripsikan keadaan di lapangan secara lisan dan tulisan ---------------------

                        ===== (Nilai<=60)=====
                        Tidak mampu memahami dan menjelaskan tentang topik KP yang telah dilakukan,
                        Tidak mampu mendeskripsikan keadaan di lapangan secara lisan dan tulisan 
                        " ></input>
                        <small class="text-primary">Bobot 50%</small>
                      </div>           
                      <div class="form-group">
                        <label>Kelengkapan isi laporan, kesesuaian dengan format penulisan laporan<small class="text-primary"> (Nilai 0-100)</small></label>
                        <input type="number" name="kelengkapan" class="form-control" data-toggle="tooltip" data-placement="right" title="
                         ======= (N>80) =======
                        Isi laporan lengkap dan format penulisan sesuai

                         == (Nilai>70 & Nilai<=80) ==
                        Isi laporan kurang lengkap dan format penulisan kurang sesuai ----------------------

                        == (Nilai>60 & Nilai<=70) ==
                        Isi laporan kurang lengkap dan format penulisan tidak sesuai ----------------------

                        ====== (Nilai<=60) ======
                        Isi laporan tidak lengkap dan format penulisan tidak sesuai "></input>
                        <small class="text-primary">Bobot 25%</small>                        
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-danger" type="reset" data-dismiss="modal">Tutup</button>
                        <button class="btn btn-primary" type="submit" name="tombolNilai">Submit</button>
                      </div>
                    </form>  
                  </div>
                </div>
              </div>
            </div>
            <?php
          }
        }
        ?>
      </td>
      <td align="center">  
       <?php
       $cekTigaBimbingan = $this->m_bimbingan->cekTigaBimbingan($id_syarat_sk); 
       $cekLaporanLengkap = $this->m_bimbingan->cekLaporanLengkap($id_syarat_sk, 'Laporan Lengkap')->num_rows();
       if(($cekTigaBimbingan==0 || ($cekTigaBimbingan == 0)==null) && ($cekLaporanLengkap<=0) ) {
        echo 'Tidak ada kartu bimbingan';
      }else{
       $cekNilai = $this->m_bimbingan->cekResponkk($id_syarat_sk);
       if($cekNilai>0){ ?> 
       <a target="_BLANK" href="<?php echo site_url('/dosen/bimbingan/cetak_kartu_bimbingan/').$id_syarat_sk ?>"><i class="fas fa-download text-success"></i></a>
       <?php
     }else{
       echo 'Tidak ada kartu bimbingan';
     } }
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

<!-- LIHAT DATA BIMBINGAN -->
<?php 
$no = 1;
foreach ($pencarian->result_array() as $i):
  $id_syarat_sk         = $i['id_syarat_sk'];

?>

<?php endforeach;  ?> 

<!-- LIHAT NILAI -->
<?php 
$no = 1;
foreach ($pencarian_nilai->result_array() as $i):
  $id_syarat_sk         = $i['id_syarat_sk'];

?>
<div class="modal fade" id="ModalLihat<?php echo $id_syarat_sk ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel"><b class="text-success">Penilaian Dosen Pembimbing </b></h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    <div class="modal-body"> 
      <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/dosen/bimbingan/row_data')?>">
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
          <input class="form-control" value="<?php echo $this->m_bimbingan->kalkulasiNilaiDospem($id_syarat_sk); 
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
<?php endforeach;  ?> 

