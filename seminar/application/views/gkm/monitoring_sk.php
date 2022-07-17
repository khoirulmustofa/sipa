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
            <div class="table-responsive">
              <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead class="table table-primary">
                  <tr>
                    <td align="center"><b>NO.</b></td>
                    <td align="center"><b>NPM</b></td>
                    <td align="center"><b>NAMA</b></td>
                    <td align="center"><b>KEPERLUAN</b></td>
                    <td align="center"><b>BERKAS SK</b></td>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no = 1;
                  foreach ($pencarian_data->result_array() as $i):
                    $id_syarat_sk      = $i['id_syarat_sk'];
                  $nama_mahasiswa    = $i['nama_mahasiswa'];
                  $nama_jenis_sk     = $i['nama_jenis_sk'];
                  $npm               = $i['npm'];
                  ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $npm;?></td>
                    <td><?php echo $nama_mahasiswa;?></td>
                    <td><?php echo $nama_jenis_sk;?></td>
                    <td>
                      <?php
                      if (isset($id_syarat_sk)) {
                        $cekSK = $this->m_monitoring_sk->cekResponSKFakultas($id_syarat_sk);
                        if($cekSK>0){
                          ?> 
                          <a target="_BLANK"  href="<?php echo site_url('/gkm/monitoring_sk/cetak_sk_pembimbing_kp/').$id_syarat_sk ?>"><i class="fas fa-download text-success"></i></a>
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