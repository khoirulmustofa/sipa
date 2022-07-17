<div class="col-lg-12 mb-1">
  <?php echo $this->session->flashdata('messege'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">Monitoring KP</h5>
    </div><br>
    <div class="content">
      <div class="container-fluid">
        <div class="card shadow mb-4">
          <div class="card-body">
           <form action="<?php echo site_url().'/gkm/monitoring_sk'; ?>" method="post" enctype="multipart/form-data">
           <div class="row">
              <div class="col-md-4">
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
              <div align="right" class="ml-md-auto m-2">
              <button type="submit" name="print" class="btn btn-warning  text-white "><i class="fa fa-print"></i> Print Rekapitulasi</button>
            </div>
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
                <td align="center"><b>WAKTU VALIDASI BERKAS</b></td>
                <td align="center"><b>BERKAS SK</b></td>
              </tr>
            </thead>
            <tbody>
              <?php 
                $no = 1;
                foreach ($pencarian_data as $i):
                  $id_syarat_sk      = $i['id_syarat_sk'];
                $nama_mahasiswa    = $i['nama_mahasiswa'];
                $nama_jenis_sk     = $i['nama_jenis_sk'];
                $npm               = $i['npm'];
                $waktu_persetujuan = $i['waktu_persetujuan'];
                ?>
                <tr>
                  <td><?php echo $no++;?></td>
                  <td><?php echo $npm;?></td>
                  <td><?php echo ucwords($nama_mahasiswa);?></td>
                  <td><?php echo $nama_jenis_sk;?></td>
                  <td>
                    <?= $this->m_monitoring_sk->format_tanggal(date('Y-m-d', strtotime($waktu_persetujuan))); ?> 
                  </td>
                  <td>
                    <?php
                    if (isset($id_syarat_sk)) {
                      $cekSK = $this->m_monitoring_sk->cekResponSKFakultas($id_syarat_sk);
                      if($cekSK>0){
                        ?> 
                        <a target="_BLANK"  href="<?php echo site_url('/gkm/monitoring_sk/cetak_sk_pembimbing_kp/').$id_syarat_sk ?>"><i class="fas fa-download text-success"> Unduh</i></a>
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