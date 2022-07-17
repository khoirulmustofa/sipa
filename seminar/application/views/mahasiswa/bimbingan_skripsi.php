<div class="col-lg-12 mb-1">
  <div class="card shadow mb-4">
    <div class="card-header">
      <h5 class="m-0 font-weight-bold text-primary">Bimbingan Skripsi</h5>
    </div>
    <div class="card-body">
      <?php echo $this->session->flashdata('messege'); ?>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead class="table table-primary">
            <tr>
              <td align="center"><b>LAPORAN P1</b></td>
              <td align="center"><b>P1</b></td>
              <td align="center"><b>LAPORAN P2</b></td>
              <td align="center"><b>P2</b></td>
              <td align="center"><b>LAPORAN P3</b></td>
              <td align="center"><b>P3</b></td>
              <td align="center"><b>LAPORAN P4</b></td>
              <td align="center"><b>P4</b></td>
              <td align="center"><b>LAPORAN LENGKAP</b></td>
              <td align="center"><b>KARTU BIMBINGAN</b></td>
            </thead>
            <tbody>
              <?php  
              foreach ($data_bimbingan as $i):
                $id_skripsi    = $i['id_skripsi'];
              ?>
              <tr>
               <?php
               $jumlah = 4;
               for ($j=0; $j < $jumlah; $j++) { 
                ?>
                <td>
                  <?php if($this->m_bimbingan_skripsi->cek_pertemuan_sebelum($id_skripsi, $j)>0){ ?>
                  <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/bimbingan_skripsi/tambah_laporan_lengkap')?>">
                    <div class="form-group">
                      <label class="bmd-label-floating">Upload Laporan </label>
                      <?php
                      $cekLaporanLengkap = $this->m_bimbingan_skripsi->cekLaporanLengkap($id_skripsi, $j+1);
                      if($cekLaporanLengkap->num_rows()<1){ 
                        echo '<br>';
                        echo '<b class="text-danger"> (Belum ada file)</b>';
                        ?>
                        <?php

                      }else{
                       if ($baris = $cekLaporanLengkap->row()) {
                        $file = $baris->file;
                      } else{
                        $file = '';
                      }
                      echo '<br>';
                      echo '<a target="_BLANK" class="text-primary" href="'.base_url('templates/file/mahasiswa/syarat_sk/skripsi/laporan_acc/').$file.'">(Lihat File)</a>' ; 
                    }
                    ?>
                    <input type="hidden" name="nama_file_lama" value="<?php if(isset($file)){
                      echo $file;
                    }?>"></input>
                    <input name="nama_jenis_file" value="Laporan P<?= ($j+1) ?>" type="hidden"></input>
                    <input type="file" accept=".pdf, .docx, doc"  class="form-control-file" name="file" id="file" required>
                    <input type="hidden" name="id_skripsi" value="<?php echo $i['id_skripsi']  ?>"></input>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" name="tombolUploadLaporan">Submit</button>
                  </div>
                </form>
                <?php } ?>
              </td>
              <td>
                <?php
                $cekHasil = $this->m_bimbingan_skripsi->cekPertemuanBimbingan($id_skripsi, $j+1);
                if($cekHasil>0){ 
                  ?>     
                  <center>
                    <i class="fas fa-eye text-success" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#ModalLihatBimbingan<?php echo $id_skripsi.($j+1) ?>" ></i>
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
                <?php } else{
                  echo '';
                }
                ?>             
              </td>
              <?php } ?>
              <td>
                <?php if ($this->m_bimbingan_skripsi->cekPertemuanBimbingan($id_skripsi, 4)>0){ ?>
                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/bimbingan_skripsi/tambah_laporan_lengkap')?>">
                  <div class="form-group">
                    <label class="bmd-label-floating">Upload Laporan lengkap yang telah di ACC<small class="text-primary"> *Format PDF</small></label>
                    <?php
                    $cekLaporanLengkap = $this->m_bimbingan_skripsi->cekLaporanLengkap($id_skripsi, "Laporan Lengkap");
                    if($cekLaporanLengkap->num_rows()<1){ 
                      echo '<br>';
                      echo '<b class="text-danger"> (Belum ada file)</b>';
                      ?>
                      <?php

                    }else{
                     if ($baris = $cekLaporanLengkap->row()) {
                      $file = $baris->file;
                    } else{
                      $file = '';
                    }
                    echo '<br>';
                    echo '<a target="_BLANK" class="text-primary" href="'.base_url('templates/file/mahasiswa/syarat_sk/skripsi/laporan_acc/').$file.'">(Lihat File)</a>' ; 
                  }
                  ?>
                  <input type="hidden" name="nama_file_lama" value="<?php if(isset($file)){
                    echo $file;
                  }?>"></input>
                  <input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>
                  <input type="hidden" name="id_skripsi" value="<?php echo $i['id_skripsi']  ?>"></input>
                  <input name="nama_jenis_file" value="Laporan Lengkap" type="hidden"></input>
                </div>
                <div class="modal-footer">
                  <center><button class="btn btn-primary" type="submit" name="tombolUploadLaporan">Submit</button></center>
                </div>
              </form>
              <?php }else{
                // echo '<i class="text-danger">Pertemuan P3 belum terisi</i>';
              } ?>
            </td>
            <td align="center">  
              <?php if ($this->m_monitoring_skripsi->cekTtdProdi($id_skripsi)>0){ ?>
              <a target="_BLANK" href="<?php echo site_url('/mahasiswa/bimbingan_skripsi/cetak_kartu_bimbingan_skripsi/').$id_skripsi ?>"><i class="fas fa-download text-success"></i></a>
              <?php }else{
                echo 'Tidak ada kartu bimbingan';
              } ?>
            </td>
          </tr>
          <?php 
          endforeach; 
          ?> 
        </tbody>
      </table><br>
    </div>               
  </div>
</div>
</div>

<div class="col-lg-12 mb-1">
  <div class="card shadow mb-4">
    <div class="card-header">
      <h5 class="m-0 font-weight-bold text-primary">Bimbingan Sesudah Seminar Proposal</h5>
    </div>
    <div class="card-body">
      <?php echo $this->session->flashdata('messege'); ?>
      <div class="table-responsive">
       <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class="table table-primary">
          <tr>
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
            <td align="center"><b>KARTU BIMBINGAN</b></td>
          </thead>
          <tbody>
            <?php  
            foreach ($data_bimbingan as $i):
              $id_skripsi    = $i['id_skripsi'];
            ?>
            <tr>
             <?php
             $jumlah_lanjutan = 10;
             for ($jj=4; $jj < $jumlah_lanjutan; $jj++) { 
              ?>
              <td>
                <?php 
                $cekLL = 1;
                if (($jj+1) == 5) {
                  $a = "Laporan Lengkap";
                  // $a = "Laporan Lengkap Kompre";
                  if($this->m_bimbingan_skripsi->cekLaporanLengkap($id_skripsi, $a)->num_rows()<1){
                    $cekLL = 0;
                  }
                }else{
                  $a = $jj+1;

                }
                if($this->m_bimbingan_skripsi->cek_pertemuan_sebelum($id_skripsi, $jj)>0 && $cekLL == 1){
                 ?>
                 <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/bimbingan_skripsi/tambah_laporan_lengkap')?>">
                  <div class="form-group">
                    <label class="bmd-label-floating">Upload Laporan </label>
                    <?php
                    $cekLaporanLengkap = $this->m_bimbingan_skripsi->cekLaporanLengkap($id_skripsi, $jj+1 );
                    if($cekLaporanLengkap->num_rows()<1){ 
                      echo '<br>';
                      echo '<b class="text-danger"> (Belum ada file)</b>';
                      ?>
                      <?php
                    }else{
                     if ($baris = $cekLaporanLengkap->row()) {
                      $file = $baris->file;
                    } else{
                      $file = '';
                    }
                    echo '<br>';
                    echo '<a target="_BLANK" class="text-primary" href="'.base_url('templates/file/mahasiswa/syarat_sk/skripsi/laporan_acc/').$file.'">(Lihat File)</a>' ; 
                  }
                  ?>
                  <input type="hidden" name="nama_file_lama" value="<?php if(isset($file)){
                    echo $file;
                  }?>"></input>
                  <input name="nama_jenis_file" value="Laporan P<?= ($jj+1) ?>" type="hidden"></input>
                  <input type="file" accept=".pdf, .docx, doc"  class="form-control-file" name="file" id="file" required>
                  <input type="hidden" name="id_skripsi" value="<?php echo $i['id_skripsi']  ?>"></input>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-primary" type="submit" name="tombolUploadLaporan">Submit</button>
                </div>
              </form>
              <?php } ?>
            </td>
            <td>
              <?php
              $cekHasil = $this->m_bimbingan_skripsi->cekPertemuanBimbingan($id_skripsi, $jj+1);
              if($cekHasil>0){ 
                ?>     
                <center>
                  <i class="fas fa-eye text-success" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#ModalLihatBimbingan<?php echo $id_skripsi.($jj+1) ?>" ></i>
                </center>
                <div class="modal fade" id="ModalLihatBimbingan<?php echo $id_skripsi.($jj+1) ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                          <input type="text" name="waktu_input_bimbingan" class="form-control" value="<?php echo $this->m_sk->format_tanggal(date('Y-m-d', strtotime($this->m_bimbingan_skripsi->ambilItem($id_skripsi, ($jj+1), "waktu_input_bimbingan")))); ?>" readonly></input>
                        </div>
                        <div class="form-group">
                          <label>Jenis Bimbingan</label>
                          <input type="text" name="jenis_pertemuan_bimbingan" class="form-control" value="<?php echo $this->m_bimbingan_skripsi->ambilItem($id_skripsi, ($jj+1), "jenis_pertemuan_bimbingan") ?>" readonly></input>
                        </div>
                        <div class="form-group">
                          <label>Materi Bimbingan</label>
                          <input type="text" name="materi_bimbingan" class="form-control" value="<?php echo $this->m_bimbingan_skripsi->ambilItem($id_skripsi, ($jj+1), "materi_bimbingan") ?>"readonly></input>
                        </div>
                        <div class="form-group">
                          <label>Hasil Bimbingan</label>
                          <input type="text" name="hasil_bimbingan" class="form-control" value="<?php echo $this->m_bimbingan_skripsi->ambilItem($id_skripsi, ($jj+1), "hasil_bimbingan") ?>" readonly></input>
                        </div>
                        <div class="form-group">
                          <label>Lampiran</label><br>
                          <?php 
                          $file_bimbingan = $this->m_bimbingan_skripsi->get_file_lampiran_bimbingan($id_skripsi, ($jj+1));
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
              <?php } else{
                echo '';
              }
              ?>             
            </td>
            <?php } ?>
            <td>
              <?php if ($this->m_bimbingan_skripsi->cekPertemuanBimbingan($id_skripsi, 10)>0){ ?>
              <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/bimbingan_skripsi/tambah_laporan_lengkap')?>">
                <div class="form-group">
                  <label class="bmd-label-floating">Upload Laporan lengkap yang telah di ACC<small class="text-primary"> *Format PDF</small></label>
                  <?php
                  $cekLaporanLengkap = $this->m_bimbingan_skripsi->cekLaporanLengkap($id_skripsi, "Laporan Lengkap Kompre");
                  if($cekLaporanLengkap->num_rows()<1){ 
                    echo '<br>';
                    echo '<b class="text-danger"> (Belum ada file)</b>';
                    ?>
                    <?php

                  }else{
                   if ($baris = $cekLaporanLengkap->row()) {
                    $file = $baris->file;
                  } else{
                    $file = '';
                  }
                  echo '<br>';
                  echo '<a target="_BLANK" class="text-primary" href="'.base_url('templates/file/mahasiswa/syarat_sk/skripsi/laporan_acc/').$file.'">(Lihat File)</a>' ; 
                }
                ?>
                <input type="hidden" name="nama_file_lama" value="<?php if(isset($file)){
                  echo $file;
                }?>"></input>
                <input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>
                <input type="hidden" name="id_skripsi" value="<?php echo $i['id_skripsi']  ?>"></input>
                <input name="nama_jenis_file" value="Laporan Lengkap Kompre" type="hidden"></input>
              </div>
              <div class="modal-footer">
                <center><button class="btn btn-primary" type="submit" name="tombolUploadLaporan">Submit</button></center>
              </div>
            </form>
            <?php }else{
                // echo '<i class="text-danger">Pertemuan P3 belum terisi</i>';
            } ?>
          </td>
          <td align="center">  
            <?php if ($this->m_monitoring_skripsi->cekTtdProdi($id_skripsi)>0){ ?>
            <a target="_BLANK" href="<?php echo site_url('/mahasiswa/bimbingan_skripsi/cetak_kartu_bimbingan_skripsi/').$id_skripsi ?>"><i class="fas fa-download text-success"></i></a>
            <?php }else{
              echo 'Tidak ada kartu bimbingan';
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