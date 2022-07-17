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
                  <td align="center"><b>LAPORAN P4</b></td>
                  <td align="center"><b>P4</b></td>
                  <td align="center"><b>LAPORAN LENGKAP</b></td>
                  <td align="center"><b>KARTU BIMBINGAN</td>
                  <td align="center"><b>STATUS SEMPRO</td>
                  <td align="center"><b>LAPORAN P5</b></td>
                  <td align="center"><b>P5</b></td>
                  <td align="center"><b>LAPORAN P6</b></td>
                  <td align="center"><b>P6</b></td>
                  <td align="center"><b>LAPORAN P7</b></td>
                  <td align="center"><b>P7</b></td>
                  <td align="center"><b>LAPORAN P8</b></td>
                  <td align="center"><b>P8</b></td>
                  <td align="center"><b>LAPORAN P9</b></td>
                  <td align="center"><b>P9</b></td>
                  <td align="center"><b>LAPORAN P10</b></td>
                  <td align="center"><b>P10</b></td>
                  <td align="center"><b>LAPORAN LENGKAP</b></td>
                  <td align="center"><b>KARTU BIMBINGAN</td>
                  <td align="center"><b>STATUS SIDANG SKRIPSI</td>
                </tr>
              </thead>
              <tbody>
               <?php  
               $no = 1;
               foreach ($pencarian_data->result_array() as $i):
                $id_skripsi    = $i['id_skripsi'];
              $npm             = $i['npm'];
              $nama_mahasiswa  = $i['nama_mahasiswa'];
              ?>
              <tr>
                <td align="center"><?php echo $no++;?></td>
                <td align="center"><?php echo $npm;?></td>
                <td align="center"><?php echo ucwords($nama_mahasiswa);?></td>
                <?php
                $jumlah = 4 ;
                for ($j=0; $j < $jumlah; $j++) 
                {

                  ?>
                  <td>
                   <?php
                   $cekLaporanLengkap = $this->m_bimbingan_skripsi->cekLaporanLengkap($id_skripsi, ($j+1));
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
                    echo '<a target="_BLANK" class="text-primary" href="'.base_url('templates/file/mahasiswa/syarat_sk/skripsi/laporan_acc/').$file.'">(Lihat File)</a>' ; 
                  } 
                  
                  ?>
                </td>
                <td>
                  <?php
                  $cekHasil = $this->m_bimbingan_skripsi->cekPertemuanBimbingan($id_skripsi, $j+1);
                  if($cekHasil>0){ 
                    ?>                
                    <center>
                      <i class="fas fa-check-circle text-success" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#ModalLihatBimbingan<?php echo $id_skripsi.($j+1) ?>" ></i>
                    </center>
                    <div class="modal fade" id="ModalLihatBimbingan<?php echo $id_skripsi.($j+1) ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><b class="text-success">Data Bimbingan Mahasiswa</b></h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body"> 
                          <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/dosen/bimbingan_skripsi/row_data')?>">
                            <div class="form-group">
                              <label>Tanggal Bimbingan</label>
                              <input type="text" name="waktu_input_bimbingan" class="form-control" value="<?php echo $this->m_sk->format_tanggal(date('Y-m-d', strtotime($this->m_bimbingan_skripsi->ambilItem($id_skripsi, ($j+1), "waktu_input_bimbingan")))); ?>" readonly></input>
                            </div>
                            <div class="form-group">
                              <label>Jenis Bimbingan</label>
                              <input type="text" name="jenis_pertemuan_bimbingan" class="form-control" value="<?php echo $this->m_bimbingan_skripsi->ambilItem($id_skripsi, ($j+1), "jenis_pertemuan_bimbingan") ?>" readonly></input>
                            </div>
                            <div class="form-group">
                              <label>Materi Bimbingan</label>
                              <input type="text" name="materi_bimbingan" class="form-control" value="<?php echo $this->m_bimbingan_skripsi->ambilItem($id_skripsi, ($j+1), "materi_bimbingan") ?>"readonly></input>
                            </div>
                            <div class="form-group">
                              <label>Hasil Bimbingan</label>
                              <input type="text" name="hasil_bimbingan" class="form-control" value="<?php echo $this->m_bimbingan_skripsi->ambilItem($id_skripsi, ($j+1), "hasil_bimbingan") ?>" readonly></input>
                            </div>
                            <div class="form-group">
                              <label>Lampiran</label><br>
                              <?php 
                              $file_bimbingan = $this->m_bimbingan_skripsi->get_file_lampiran_bimbingan($id_skripsi, ($j+1));
                              if ($file_bimbingan!="") {
                                ?>
                                <a target="_BLANK" href="<?php echo base_url('templates/file/dosen/lampiran_bimbingan_skripsi/'.$file_bimbingan) ?>">Berkas Lampiran</a>
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
                    if($this->m_bimbingan_skripsi->cek_laporan_pertemuan($id_skripsi, $j+1)>0){
                      ?>
                      <a data-toggle="modal" data-target="#ModalTambahBimbingan<?php echo $id_skripsi.($j+1) ?>"><i class="fas fa-plus-circle text-primary"></i></a>
                      <!-- TAMBAH DATA BIMBINGAN -->
                      <div class="modal fade" id="ModalTambahBimbingan<?php echo $id_skripsi.($j+1) ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                       <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><b class="text-primary">Tambah Data Bimbingan</b></h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/dosen/bimbingan_skripsi/tambah_bimbingan_skripsi')?>">
                              <div class="form-group">
                                <label>Bimbingan Ke-</label>
                                <input type="text" name="bimbingan_ke" value="<?= ($j+1) ?>" class="form-control" readonly>
                                <input type="hidden" value="<?= $id_skripsi ?>" name="id_skripsi" class="form-control" >
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
                                <label class="bmd-label-floating">Lampiran </label><small class="text-primary"> (Opsional)</small>
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
                echo '</td>';
              }
              ?>
              
              <td align="center">
                <?php
                $cekLaporanLengkap = $this->m_bimbingan_skripsi->cekLaporanLengkap($id_skripsi, 'Laporan Lengkap');
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
                echo '<a target="_BLANK" class="text-primary" href="'.base_url('templates/file/mahasiswa/syarat_sk/skripsi/laporan_acc/').$file.'">(Lihat File)</a>' ; 
              }
              ?>
            </td>
            <td align="center">  
              <?php if ($this->m_monitoring_skripsi->cekTtdProdi($id_skripsi)>0){ ?>
              <a target="_BLANK" href="<?php echo site_url('/dosen/bimbingan_skripsi/cetak_kartu_bimbingan_skripsi/').$id_skripsi ?>"><i class="fas fa-download text-success"></i></a>
              <?php }else{
                echo 'Tidak ada kartu bimbingan';
              } ?>
            </td>
            <td align="center">  
              <?php if ($this->m_monitoring_skripsi->cekTtdProdi($id_skripsi)>0){ ?>

              <?php if ($this->m_bimbingan_skripsi->cekPersetujuan_sempro($id_skripsi)>0){ 
                echo '<b class="text-success">Sudah disetujui Daftar Sempro</b>';

                ?>
                <?php }else{ ?>
                <input type="submit" name="tombol_setuju" value="Setujui" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modalsetuju<?php echo $id_skripsi  ?>">
                <div class="modal fade" id="Modalsetuju<?php echo $i['id_skripsi']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" ><b class="text-primary">Setuju Daftar Seminar Proposal</b></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <form action="<?php echo site_url('/dosen/bimbingan_skripsi/persetujuan_sempro') ?>" method ="post">
                        <div class="modal-body"> 
                          <input type="hidden" name="id_skripsi" value="<?php echo $i['id_skripsi']  ?>"></input>
                          <label>Apakah yakin ingin menyetujui mahasiswa daftar seminar proposal ?</label>
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                          <button class="btn btn-primary" type="submit" name="tombolSetujuSempro">Ya</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>         
                <?php } ?>
                <?php }else{
                  echo '-';
                } ?>
              </td>




              <?php
              $jumlah = 10 ;
              for ($j=4; $j < $jumlah; $j++) 
              {
                ?>
                <td>
                 <?php
                 $cekLaporanLengkap = $this->m_bimbingan_skripsi->cekLaporanLengkap($id_skripsi, ($j+1));
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
                  echo '<a target="_BLANK" class="text-primary" href="'.base_url('templates/file/mahasiswa/syarat_sk/skripsi/laporan_acc/').$file.'">(Lihat File)</a>' ; 
                } 
                ?>
              </td>
              <td>
                <?php
                $cekHasil = $this->m_bimbingan_skripsi->cekPertemuanBimbingan($id_skripsi, $j+1);
                if($cekHasil>0){ 
                  ?>                
                  <center>
                    <i class="fas fa-check-circle text-success" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#ModalLihatBimbingan<?php echo $id_skripsi.($j+1) ?>" ></i>
                  </center>
                  <div class="modal fade" id="ModalLihatBimbingan<?php echo $id_skripsi.($j+1) ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                   <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><b class="text-success">Data Bimbingan Mahasiswa</b></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body"> 
                        <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/dosen/bimbingan_skripsi/row_data')?>">
                          <div class="form-group">
                            <label>Tanggal Bimbingan</label>
                            <input type="text" name="waktu_input_bimbingan" class="form-control" value="<?php echo $this->m_sk->format_tanggal(date('Y-m-d', strtotime($this->m_bimbingan_skripsi->ambilItem($id_skripsi, ($j+1), "waktu_input_bimbingan")))); ?>" readonly></input>
                          </div>
                          <div class="form-group">
                            <label>Jenis Bimbingan</label>
                            <input type="text" name="jenis_pertemuan_bimbingan" class="form-control" value="<?php echo $this->m_bimbingan_skripsi->ambilItem($id_skripsi, ($j+1), "jenis_pertemuan_bimbingan") ?>" readonly></input>
                          </div>
                          <div class="form-group">
                            <label>Materi Bimbingan</label>
                            <input type="text" name="materi_bimbingan" class="form-control" value="<?php echo $this->m_bimbingan_skripsi->ambilItem($id_skripsi, ($j+1), "materi_bimbingan") ?>"readonly></input>
                          </div>
                          <div class="form-group">
                            <label>Hasil Bimbingan</label>
                            <input type="text" name="hasil_bimbingan" class="form-control" value="<?php echo $this->m_bimbingan_skripsi->ambilItem($id_skripsi, ($j+1), "hasil_bimbingan") ?>" readonly></input>
                          </div>
                          <div class="form-group">
                            <label>Lampiran</label><br>
                            <?php 
                            $file_bimbingan = $this->m_bimbingan_skripsi->get_file_lampiran_bimbingan($id_skripsi, ($j+1));
                            if ($file_bimbingan!="") {
                              ?>
                              <a target="_BLANK" href="<?php echo base_url('templates/file/dosen/lampiran_bimbingan_skripsi/'.$file_bimbingan) ?>">Berkas Lampiran</a>
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
                  if($this->m_bimbingan_skripsi->cek_laporan_pertemuan($id_skripsi, $j+1)>0){
                    ?>
                    <a data-toggle="modal" data-target="#ModalTambahBimbingan<?php echo $id_skripsi.($j+1) ?>"><i class="fas fa-plus-circle text-primary"></i></a>
                    <!-- TAMBAH DATA BIMBINGAN -->
                    <div class="modal fade" id="ModalTambahBimbingan<?php echo $id_skripsi.($j+1) ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><b class="text-primary">Tambah Data Bimbingan</b></h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/dosen/bimbingan_skripsi/tambah_bimbingan_skripsi')?>">
                            <div class="form-group">
                              <label>Bimbingan Ke-</label>
                              <input type="text" name="bimbingan_ke" value="<?= ($j+1) ?>" class="form-control" readonly>
                              <input type="hidden" value="<?= $id_skripsi ?>" name="id_skripsi" class="form-control" >
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
                              <label class="bmd-label-floating">Lampiran </label><small class="text-primary"> (Opsional)</small>
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
              echo '</td>';
            }
            ?>
            <td align="center">
              <?php
              $cekLaporanLengkap = $this->m_bimbingan_skripsi->cekLaporanLengkap($id_skripsi, 'Laporan Lengkap Kompre');
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
              echo '<a target="_BLANK" class="text-primary" href="'.base_url('templates/file/mahasiswa/syarat_sk/skripsi/laporan_acc/').$file.'">(Lihat File)</a>' ; 
            }
            ?>
          </td>
          <td align="center">  
            <?php if ($this->m_monitoring_skripsi->cekTtdProdi($id_skripsi)>0){ ?>
            <a target="_BLANK" href="<?php echo site_url('/dosen/bimbingan_skripsi/cetak_kartu_bimbingan_skripsi/').$id_skripsi ?>"><i class="fas fa-download text-success"></i></a>
            <?php }else{
              echo 'Tidak ada kartu bimbingan';
            } ?>
          </td>
          <td align="center">  
            <?php if ($this->m_monitoring_skripsi->cekTtdProdi($id_skripsi)>0){ ?>

            <?php if ($this->m_bimbingan_skripsi->cekPersetujuan_kompre($id_skripsi)>0){ 
              echo '<b class="text-success">Sudah disetujui Daftar Sidang Skripsi</b>';

              ?>
              <?php }else{ ?>
              <input type="submit" name="tombol_setuju" value="Setujui" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modalsetuju<?php echo $id_skripsi  ?>">
              <div class="modal fade" id="Modalsetuju<?php echo $i['id_skripsi']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel" ><b class="text-primary">Setuju Daftar Sidang Akhir</b></h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <form action="<?php echo site_url('/dosen/bimbingan_skripsi/persetujuan_kompre') ?>" method ="post">
                      <div class="modal-body"> 
                        <input type="hidden" name="id_skripsi" value="<?php echo $i['id_skripsi']  ?>"></input>
                        <label>Apakah yakin ingin menyetujui mahasiswa daftar Sidang Akhir ?</label>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                        <button class="btn btn-primary" type="submit" name="tombolSetujuKompre">Ya</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>         
              <?php } ?>
                <?php }else{
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
