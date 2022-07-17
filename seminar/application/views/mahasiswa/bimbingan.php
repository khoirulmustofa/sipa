<div class="col-lg-12 mb-1">
  <div class="card shadow mb-4">
    <div class="card-header">
      <h5 class="m-0 font-weight-bold text-primary">Data Bimbingan</h5>
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
              <td align="center"><b>LAPORAN LENGKAP</b></td>
              <td align="center"><b>KARTU BIMBINGAN</b></td>
              <!-- <td align="center"><b>LEMBAR PENGESAHAN</b></td> -->
              <td align="center"><b>NILAI</b></td>              
            </tr>
          </thead>
          <tbody>
            <?php  
            foreach ($data_bimbingan as $i):
              $id_syarat_sk    = $i['id_syarat_sk'];
            ?>
            <tr>
             <?php
             $jumlah = 3;
             for ($j=0; $j < $jumlah; $j++) { 
              ?>
              <td>
                <?php if($this->m_bimbingan->cek_pertemuan_sebelum($id_syarat_sk, $j)>0){ ?>
                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/bimbingan/tambah_laporan_lengkap')?>">
                  <div class="form-group">
                    <label class="bmd-label-floating">Upload Laporan </label>
                    <?php
                    $cekLaporanLengkap = $this->m_bimbingan->cekLaporanLengkap($id_syarat_sk, $j+1);
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
                    echo '<a target="_BLANK" class="text-primary" href="'.base_url('templates/file/mahasiswa/syarat_sk/sk/laporan_acc/').$file.'">(Lihat File)</a>' ; 
                  }
                  ?>
                  <input type="hidden" name="nama_file_lama" value="<?php if(isset($file)){
                    echo $file;
                  }?>"></input>
                  <input name="nama_jenis_file" value="Laporan P<?= ($j+1) ?>" type="hidden"></input>
                  <input type="file" accept=".pdf, .docx, doc"  class="form-control-file" name="file" id="file" required>
                  <input type="hidden" name="id_syarat_sk" value="<?php echo $i['id_syarat_sk']  ?>"></input>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-primary" type="submit" name="tombolUploadLaporan">Submit</button>
                </div>
              </form>
              <?php } ?>
            </td>
            <td>
              <?php
              $cekHasil = $this->m_bimbingan->cekPertemuanBimbingan($id_syarat_sk, $j+1);
              if($cekHasil>0){ 
                ?>     
                <center>
                  <i class="fas fa-eye text-success" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#ModalLihatBimbingan<?php echo $id_syarat_sk.($j+1) ?>" ></i>
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
              <?php } else{
                echo '';
              }
              ?>             
            </td>
            <?php } ?>
            <td>
              <?php if ($this->m_bimbingan->cekPertemuanBimbingan($id_syarat_sk, 3)>0){ ?>
              <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/bimbingan/tambah_laporan_lengkap')?>">
                <div class="form-group">
                  <label class="bmd-label-floating">Upload Laporan lengkap yang telah di ACC<small class="text-primary"> *Format PDF</small></label>
                  <?php
                  $cekLaporanLengkap = $this->m_bimbingan->cekLaporanLengkap($id_syarat_sk, "Laporan Lengkap");
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
                  echo '<a target="_BLANK" class="text-primary" href="'.base_url('templates/file/mahasiswa/syarat_sk/sk/laporan_acc/').$file.'">(Lihat File)</a>' ; 
                }
                ?>
                <input type="hidden" name="nama_file_lama" value="<?php if(isset($file)){
                  echo $file;
                }?>"></input>
                <input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>
                <input type="hidden" name="id_syarat_sk" value="<?php echo $i['id_syarat_sk']  ?>"></input>
                <input name="nama_jenis_file" value="Laporan Lengkap" type="hidden"></input>
              </div>
              <div class="modal-footer">
                <center><button class="btn btn-primary" type="submit" name="tombolUploadLaporan">Submit</button></center>
              </div>
            </form>
            <?php }else{
              echo '<i class="text-danger">Pertemuan P3 belum terisi</i>';
            } ?>
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
             <a target="_BLANK" href="<?php echo site_url('/mahasiswa/bimbingan/cetak_kartu_bimbingan/').$id_syarat_sk ?>"><i class="fas fa-download text-success"></i></a>
             <?php
           }else{
             echo 'Tidak ada kartu bimbingan';
           } }
           ?> 
         </td>
         <!-- <td align="center">
          <a target="_BLANK" href="<?php echo site_url('/mahasiswa/bimbingan/cetak_lembar_pengesahan/').$id_syarat_sk ?>"><i class="fas fa-download text-success"></i></a>
        </td> -->
        <td align="center">
          <?php 
          $cekKonfirmasi = $this->m_bimbingan->cekKonfirmasi($id_syarat_sk);
          if($cekKonfirmasi==1){
            echo $this->m_bimbingan->kalkulasiNilai($id_syarat_sk); 
          }else{
            echo "Menunggu Konfirmasi Prodi";
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