<div class="col-lg-12 mb-1">
  <?php echo $this->session->flashdata('messege'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">Penunjukan Sebagai Pembimbing KP</h5>
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
                      <td align="center"><b>NO. WHATSAPP</b></td>
                      <td align="center"><b>NAMA</b></td>
                      <td align="center"><b>KEPERLUAN</b></td>
                      <td align="center"><b>DETAIL</b></td>
                      <td align="center"><b>BERKAS SK</b></td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php  
                    $no = 1;
                    foreach ($pencarian_data->result_array() as $i):
                      $id_syarat_sk    = $i['id_syarat_sk'];
                    $id_dospem       = $i['id_dospem'];
                    $no_hp                = $i['no_hp'];
                    $nama_mahasiswa  = $i['nama_mahasiswa'];
                    $nama_jenis_sk   = $i['nama_jenis_sk'];
                    $npm             = $i['npm'];
                    ?>
                    <tr>
                      <td><?php echo $no++;?></td>
                      <td><?php echo $npm;?></td>
                      <td>                 
                        <a href="whatsapp://send?text=Assalamu'alaikum.Wr.Wb...&phone=+62<?php echo $no_hp;?>" >
                          <?php echo $no_hp;?>
                        </a>
                      </td> 
                      <td><?php echo ucwords($nama_mahasiswa); ?></td>
                      <td><?php echo $nama_jenis_sk;?></td>
                      <td>
                        <i class="fas fa-eye text-primary" data-toggle="modal" data-target="#Modallihat<?php echo $id_syarat_sk ?>"></i>
                      </td>
                      <td>
                        <?php
                        if (isset($id_syarat_sk)) {
                          $cekSK = $this->m_dospem->cekResponSKFakultas($id_syarat_sk);
                          if($cekSK>0){
                            ?> 
                            <a target="_BLANK" href="<?php echo site_url('/dosen/dospem/cetak_sk_pembimbing_kp/').$id_syarat_sk ?>"><i class="fas fa-download text-success"> Unduh</i></a>
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

<!-- MODAL LIHAT DATA PENGAJUAN SK -->
<?php 
foreach ($pencarian_data->result_array() as $i):
  ?>
<div class="modal fade" id="Modallihat<?php echo $i['id_syarat_sk']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Pengajuan Tempat Praktek Kerja Lapangan Mahasiswa</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"> 
        <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/prodi/monitoring_sk/row_data')?>">
          <div class="form-group">
            <label>Email Student</label>
            <input type="text" class="form-control" value="<?php echo $i['email_student']; ?>" readonly></input>
          </div>
          <div class="form-group">
            <label>Nama Tempat Praktek</label>
            <input type="text" name="nama_tempat_kp" class="form-control" value="<?php echo $i['nama_instansi']?>" readonly></input>
          </div>
          <div class="form-group">
            <label>Judul</label>
            <input type="text" name="judul_kerja_praktik" class="form-control" value="<?php echo $i['judul_kerja_praktik']?>"readonly></input>
          </div>
          <div class="form-group">
            <label>Nama Pembimbing Lapangan</label>
            <input type="text" name="nama_pembimbing_lapangan" class="form-control" value="<?php echo $i['nama_pembimbing_lapangan']?>" readonly></input>
          </div>
          <div class="form-group">
            <label>No. HP Pembimbing</label>
            <input type="number" name="no_hp_pembimbing_lapangan" class="form-control" value="<?php echo $i['no_hp_pembimbing_lapangan']?>" readonly></input>
          </div>
          <div class="form-group">
            <label>Waktu Mulai</label>
            <input type="date" name="waktu_mulai_kp" class="form-control" value="<?php echo $i['waktu_mulai_kp']?>" readonly></input>
          </div>
          <div class="form-group">
            <label>Waktu Selesai</label>
            <input type="date" name="waktu_selesai_kp" class="form-control" value="<?php echo $i['waktu_selesai_kp']?>" readonly></input>
          </div>
          <div class="form-group">
            <label>Lihat Berkas</label><br>
            <a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/sk/'.$i['nama_file_syarat_sk']) ?>">Bukti Penerimaan Kerja Praktek Lapangan di Perusahaan/Instansi Terkait</a><br>
            <a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/sk/spp/'.$i['file_spp_dasar']) ?>">Bukti Pembayaran SPP Dasar</a><br>
            <a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/sk/transkrip/'.$i['file_transkrip']) ?>">Bukti Transkip Nilai Sementara</a><br>
            <a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/sk/laporan/'.$i['file_laporan']) ?>">File Laporan KP</a>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Tutup</button>
          </div>
        </form> 
      </div>
    </div>
  </div>
</div>
<?php endforeach; 
// }
?> 
