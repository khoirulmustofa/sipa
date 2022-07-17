<div class="col-lg-12 mb-1">
  <?php echo $this->session->flashdata('messege'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">Monitoring Skripsi</h5>
    </div><br>
    <div class="content">
      <div class="container-fluid">
        <div class="card shadow mb-4">
          <div class="card-body">
           <form action="<?php echo site_url().'/upm/monitoring_skripsi'; ?>" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>PILIH PRODI</label>
                  <select name="kode_prodi" class="form-control" required>
                    <option value="">
                      --Pilih--
                    </option>
                    <option value="0" <?php if(!isset($_SESSION['kode_prodi'])){ echo 'selected'; } ?>>
                      Semua
                    </option>
                    <?php foreach ($combobox_prodi as $item): ?>
                      <option value="<?php echo $item['kode_prodi']  ?>" <?php if(isset($_SESSION['kode_prodi'])){ if($_SESSION['kode_prodi']==$item['kode_prodi']){ echo 'selected'; } } ?> ><?php echo $item['nama_prodi']  ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>AKSI</label><br>
                  <input type="submit" name="tombol_cari" value="Tampilkan Data" class="btn btn-primary">
                </div>
              </div> 
              <!-- <div align="right" class="ml-md-auto m-2">
                <button type="submit" name="print" class="btn btn-warning  text-white "><i class="fa fa-print"></i> Print Rekapitulasi</button>
              </div> -->
            </div>
          </form><hr>
          <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
              <thead class="table table-primary">
                <tr>
                  <td align="center"><b>NO.</b></td>
                  <td align="center"><b>NPM</b></td>
                  <td align="center"><b>NAMA</b></td>
                  <td align="center"><b>KEPERLUAN</b></td>
                  <td align="center"><b>JUDUL</b></td>
                  <td align="center"><b>BERKAS SK</b></td>
                </tr>
              </thead>
              <tbody>
                <?php 
                // if(isset($_SESSION['date_mulai']) && isset($_SESSION['date_selesai'])){
                  $no = 1;
                  foreach ($pencarian_data as $i):
                    $id_skripsi     = $i['id_skripsi'];
                  $nama_mahasiswa = $i['nama_mahasiswa'];
                  $nama_jenis_sk  = $i['nama_jenis_sk'];
                  $npm            = $i['npm'];
                  $judul     = $i['judul'];
                  ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $npm;?></td>
                    <td><?php echo ucwords($nama_mahasiswa); ?></td>
                    <td><?php echo $nama_jenis_sk;?></td>
                    <td><?php echo $judul;?></td>
                    <td>
                       <?php
                    if (isset($id_skripsi)) {
                      $cekSK = $this->m_monitoring_skripsi->cekResponSKFakultas($id_skripsi);
                      if($cekSK>0){
                        ?> 
                        <a target="_BLANK" href="<?php echo site_url('/upm/monitoring_skripsi/cetak_sk_pembimbing_skripsi/').$id_skripsi ?>"><i class="fas fa-download text-success"> Unduh</i></a>
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

<!-- MODAL LIHAT DATA PENGAJUAN SK -->
<?php 
if(isset($_SESSION['date_mulai']) && isset($_SESSION['date_selesai'])){
  $no = 1;
  foreach ($pencarian_data->result_array() as $i):
    $id_skripsi           = $i['id_skripsi'];
  $nama_mahasiswa       = $i['nama_mahasiswa'];
  $nama_jenis_sk        = $i['nama_jenis_sk'];
  $npm                  = $i['npm'];
  $judul                = $i['judul'];
  $tgl_upload_syarat_sk = $i['tgl_upload'];
  ?>
  <div class="modal fade" id="Modallihat<?php echo $i['id_skripsi']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Data Pengajuan SK Skripsi</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"> 
          <div class="form-group">
            <label>Nama Mahasiswa</label>
            <input type="text" class="form-control" value="<?php echo $i['nama_mahasiswa'].' ('.$i['npm'].')'; ?>" readonly></input>
          </div>
          <div class="form-group">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="<?php echo $i['judul']?>" readonly></input>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>

<?php endforeach; } ?> 