<div class="col-lg-12 mb-1">
  <?php echo $this->session->flashdata('messege'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">Persetujuan Sidang Akhir</h5>
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
                      <td align="center"><b>BERKAS PERSYARATAN</b></td>
                      <td align="center"><b>PERSETUJUAN</b></td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    foreach ($pencarian_data as $i):
                      $id_syarat_kompre      = $i['id_syarat_kompre'];
                    $nama_mahasiswa    = $i['nama_mahasiswa'];
                    $npm               = $i['npm'];
                    ?>
                    <tr>
                      <td><?php echo $no++;?></td>
                      <td><?php echo ucwords($nama_mahasiswa); ?></td>
                      <td><?php echo $npm;?></td>

                      <td>
                        <i class="fas fa-eye text-primary" data-toggle="modal" data-target="#Modallihat<?php echo $id_syarat_kompre  ?>"></i>
                      </td>
                      <td>
                       <?php if ($this->m_monitoring_kompre->cekPersetujuan_kompre($id_syarat_kompre)>0){ 
                        echo '<b class="text-success">Sudah disetujui Daftar Sidang Akhir</b>';

                        ?>
                        <?php }else{ ?>
                        <input type="submit" name="tombol_setuju" value="Setujui" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modalsetuju<?php echo $id_syarat_kompre  ?>">
                        <div class="modal fade" id="Modalsetuju<?php echo $i['id_syarat_kompre']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel" >Persetujuan Sidang Akhir</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                              </div>
                              <form action="<?php echo site_url('/prodi/persetujuan_kompre/persetujuan') ?>" method ="post">
                                <div class="modal-body"> 
                                  <input type="hidden" name="id_syarat_kompre" value="<?php echo $i['id_syarat_kompre']  ?>"></input>
                                  <label>Apakah yakin ingin memberikan persetujuan ?</label>
                                </div>
                                <div class="modal-footer">
                                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                                  <button class="btn btn-primary" type="submit" name="tombolSetuju">Ya</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                         <?php } ?>
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
$no = 1;
foreach ($pencarian_data as $i):
  $id_syarat_kompre = $i['id_syarat_kompre'];
$nama_mahasiswa = $i['nama_mahasiswa'];
$npm            = $i['npm'];
?>
<div class="modal fade" id="Modallihat<?php echo $i['id_syarat_kompre']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Lihat Berkas Persyaratan</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"> 
        <div class="form-group">
          <table border="0" width="100%" cellspacing="1" cellpadding="2">
            <tr>
              <td>
                <a target="_BLANK" id="open_file1<?= $id_syarat_kompre ?>" href="<?php echo base_url('templates/file/mahasiswa/syarat_kompre/spp/'.$i['file_spp']) ?>">Bukti Pembayaran SPP</a><br>
              </td>
            </tr>
            <tr>
              <td>
                <a target="_BLANK" id="open_file2<?= $id_syarat_kompre ?>" href="<?php echo base_url('templates/file/mahasiswa/syarat_kompre/transkip/'.$i['file_transkrip']) ?>">Bukti Pembayaran Transkip</a><br>

              </td>
            </tr>
            <tr>
              <td>
                <a target="_BLANK" id="open_file3<?= $id_syarat_kompre ?>" href="<?php echo base_url('templates/file/mahasiswa/syarat_kompre/krs/'.$i['file_krs']) ?>">Bukti KRS Cap Lunas</a><br>
              </td>
            </tr>
            <tr>
              <td>
                <a target="_BLANK" id="open_file4<?= $id_syarat_kompre ?>" href="<?php echo base_url('templates/file/mahasiswa/syarat_kompre/sertifikat_alquran/'.$i['sertifikat_alquran']) ?>">Sertifikat Kemampuan Baca Alquran</a><br>
              </td>
            </tr>
            <tr>
              <td>
                <a target="_BLANK" id="open_file5<?= $id_syarat_kompre ?>" href="<?php echo base_url('templates/file/mahasiswa/syarat_kompre/sertifikat_inggris/'.$i['sertifikat_inggris']) ?>">Sertifikat Kemampuan Bahasa Inggris (TOEFL/IELTS)</a><br>
              </td>
            </tr>
            <tr>
              <td>
                <a target="_BLANK" id="open_file6<?= $id_syarat_kompre ?>" href="<?php echo base_url('templates/file/mahasiswa/syarat_kompre/laporan_lengkap/'.$i['file_laporan']) ?>">File Laporan Lengkap</a><br>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php 
endforeach; 
?> 
