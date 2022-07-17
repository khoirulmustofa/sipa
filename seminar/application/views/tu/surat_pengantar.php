<div class="col-lg-12 mb-1">
  <?php echo $this->session->flashdata('messege'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">Pengajuan Surat Pengantar Instansi</h5>
    </div><br>
    <div class="content">
      <div class="container-fluid">
        <div class="card shadow mb-4">
          <div class="card-body">
           <form action="<?php echo site_url().'/tu/surat_pengantar'; ?>" method="post" enctype="multipart/form-data">
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
            </div>
          </form><hr>
          <div class="table-responsive">
            <div class="scroll">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="table table-primary">
                  <tr>
                    <td align="center"><b>NO.</b></td>
                    <td align="center"><b>NPM</b></td>
                    <td align="center"><b>PRODI</b></td>
                    <td align="center"><b>NAMA MAHASISWA</b></td>
                    <td align="center"><b>NO WHATSAPP</b></td>
                    <td align="center"><b>JUDUL PROYEK</b></td>
                    <td align="center"><b>DITUJUKAN KE</b></td>
                    <td align="center"><b>NAMA INSTANSI</b></td>
                    <td align="center"><b>ALAMAT INSTANSI</b></td>
                    <td align="center"><b>LOKASI</b></td>
                    <td align="center"><b>WAKTU KP</b></td>
                    <td align="center"><b>DETAIL</b></td>
                    <td align="center"><b>EDIT</b></td>
                    <td align="center"><b>STATUS</b></td>
                    <td align="center"><b>AKSI</b></td>
                    <td align="center"><b>BERKAS</b></td>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no = 1;
                  foreach ($data_surat_pengantar as $i):
                    $id_surat_pengantar   = $i['id_surat_pengantar'];
                  $npm                  = $i['npm'];
                  $nama_prodi           = $i['nama_prodi'];
                  $kode_prodi           = $i['kode_prodi'];
                  $nama_mahasiswa       = $i['nama_mahasiswa'];
                  $no_hp                = $i['no_hp'];
                  $ditujukan            = $i['ditujukan'];
                  $nama_instansi        = $i['nama_instansi'];
                  $alamat_instansi      = $i['alamat_instansi'];
                  $waktu_mulai       = $i['waktu_mulai'];
                  $waktu_selesai     = $i['waktu_selesai'];
                  $lokasi               = $i['lokasi'];
                  $judul_kp             = $i['judul_kp'];
                  ?>
                  <tr>
                    <td align="center"><?php echo $no++;?></td>
                    <td align="center"><?php echo $npm;?></td>
                    <td align="center"><?php echo $nama_prodi;?></td>
                    <td align="center"><?php echo ucwords($nama_mahasiswa); ?></td>
                    <td>                 
                      <a href="whatsapp://send?text=Assalamu'alaikum.Wr.Wb...&phone=+62<?php echo $no_hp;?>" >
                        <?php echo $no_hp;?>
                      </a>
                    </td> 
                    <?php if ($kode_prodi=='1'){ ?>
                    <td align="center"><?php echo $judul_kp;?></td>
                    <?php }else{ ?>
                    <?php  ?>
                    <td align="center">-</td>
                    <?php  }?>                   
                    <td align="center"><?php echo $ditujukan;?></td>
                    <td align="center"><?php echo $nama_instansi;?></td>
                    <td align="center"><?php echo $alamat_instansi;?></td>
                    <td align="center"><?php echo $lokasi;?></td>
                    <td align="center">
                      <?= $this->m_surat_pengantar->format_tanggal(date('Y-m-d', strtotime($waktu_mulai))); ?>
                      s.d.
                      <?= $this->m_surat_pengantar->format_tanggal(date('Y-m-d', strtotime($waktu_selesai))); ?>
                    </td>
                    <td align="center">
                      <a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/surat_pengantar/'.$i['nama_file_surat_pengantar']) ?>"><i class="fas fa-eye text-primary"></i></a> 
                    </td>
                    <td align="center">
                      <i class="fa fa-pen text-secondary" data-toggle="modal" data-target="#ModalEdit<?php echo $id_surat_pengantar ?>"> Edit</i>
                    </td>
                    <td align="center">
                      <?php
                      $cekSuratPengantar = $this->m_surat_pengantar->cekSuratPengantar($i['id_surat_pengantar']);
                      if($this->m_surat_pengantar->cekStatusPersetujuanSuratPengantar($i['id_surat_pengantar'], 'Berkas Disetujui', 'Staff Tata Usaha Teknik')>0){
                        echo '<b class="text-success">Berkas disetujui</b>';
                      }elseif($this->m_surat_pengantar->cekStatusPersetujuanSuratPengantar($i['id_surat_pengantar'], 'Berkas Ditolak', 'Staff Tata Usaha Teknik')>0){
                        echo '<b class="btn text-danger" data-toggle="modal" data-target="#ModalAlasanDitolakTU'.$id_surat_pengantar.'"><i class="fas fa-eye">Berkas ditolak</i></b>';
                        ?>
                        <!-- MODAL ALASAN DITOLAK TU -->
                        <div class="modal fade" id="ModalAlasanDitolakTU<?= $id_surat_pengantar ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                          aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><b class="text-danger">KETERANGAN PENOLAKAN BERKAS</b></h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <?php 
                                foreach ($this->m_surat_pengantar->alasan_ditolak($npm, $id_surat_pengantar) as $n): ?>
                                <?php echo $n['alasan_ditolak'];?>
                              <?php endforeach ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php 
                    }elseif($cekSuratPengantar>0){
                      echo '<b class="text-warning">Meminta Validasi Berkas</b>';
                    }elseif($cekSuratPengantar==0){
                      echo '-';
                    }else{
                      echo '-';
                    }
                    ?>
                  </td>
                  <td align="center">
                    <?php 
                    if ($this->m_surat_pengantar->cekResponSuratPengantar($id_surat_pengantar)<=0) {      
                      ?>
                      <input type="submit" name="tombol_setuju" value="Setujui" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modalsetuju<?php echo $id_surat_pengantar  ?>">
                      <div class="modal fade" id="Modalsetuju<?php echo $i['id_surat_pengantar']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel" >Persetujuan Berkas Surat Pengantar Instansi</h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <form action="<?php echo site_url('/tu/surat_pengantar/persetujuan') ?>" method ="post">
                              <div class="modal-body"> 
                                <input type="hidden" name="id_surat_pengantar" value="<?php echo $i['id_surat_pengantar']  ?>"></input>
                                <label>Apakah berkas ini disetujui ?</label>
                              </div>
                              <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                                <button class="btn btn-primary" type="submit" name="tombolSetuju">Ya</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>

                      <!-- Modal Tolak -->
                      <input type="submit" name="tombol_tolak" value="Tolak" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modaltolak<?php echo $id_surat_pengantar  ?>">
                      <div class="modal fade" id="Modaltolak<?php echo $id_surat_pengantar  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel" >Persetujuan Berkas Surat Pengantar Instansi</h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/tu/surat_pengantar/persetujuan')?>">
                                <div class="form-group">
                                  <input type="hidden" name="id_surat_pengantar" value="<?php echo $i['id_surat_pengantar'] ?>" class="form-control"></input>
                                  <label>Alasan Validasi Ditolak</label><br>
                                  <input type="checkbox" id="checkItem" name="alasan_ditolak[]" value="Bukti Pembayaran SPP Tidak Valid" > Bukti Pembayaran SPP Tidak Valid<br>
                                  <input type="text" name="alasan_ditolak[]" class="form-control" placeholder="Inputkan Alasan Lain"></input>
                                </div>
                                <div class="modal-footer">
                                  <button class="btn btn-danger" type="reset" data-dismiss="modal">Tutup</button>
                                  <button class="btn btn-primary" type="submit" name="tombolTolak">Submit</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php }else{ ?>
                      <i class="text-primary">Sudah Direspon</i>
                      <?php } ?>
                    </td>
                    <td align="center">
                      <?php
                      if (isset($id_surat_pengantar)) {
                        $cekSK = $this->m_surat_pengantar->cekResponSuratPengantarFakultas($id_surat_pengantar);
                        if($cekSK>0){
                          ?> 
                          <a target="_BLANK" href="<?php echo site_url('/tu/surat_pengantar/cetak/').$id_surat_pengantar ?>"><i class="fas fa-download text-success"> Unduh</i></a>
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
$no = 1;
foreach ($data_surat_pengantar as $i):
  $id_surat_pengantar   = $i['id_surat_pengantar'];
$npm                  = $i['npm'];
$nama_prodi           = $i['nama_prodi'];
$nama_mahasiswa       = $i['nama_mahasiswa'];
$no_hp                = $i['no_hp'];
$nama_instansi        = $i['nama_instansi'];
$alamat_instansi      = $i['alamat_instansi'];
$waktu_mulai       = $i['waktu_mulai'];
$waktu_selesai     = $i['waktu_selesai'];
$lokasi               = $i['lokasi'];
$judul_kp             = $i['judul_kp'];
$ditujukan            = $i['ditujukan'];
?>
<div class="modal fade" id="ModalEdit<?php echo $i['id_surat_pengantar']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Pengajuan Surat Pengantar</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"> 
        <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/tu/surat_pengantar/edit_data_mahasiswa')?>">
          <div class="form-group">
            <label>Nama Instansi</label>
            <input type="text" name="nama_instansi" class="form-control" value="<?php echo $i['nama_instansi']?>" ></input>
            <input type="hidden" value="<?= $id_surat_pengantar ?>" name="id_surat_pengantar" class="form-control"></input>
          </div>
          <div class="form-group">
            <label>Alamat Instansi</label>
            <input type="text" name="alamat_instansi" class="form-control" value="<?php echo $i['alamat_instansi']?>" ></input>
          </div>
          <div class="form-group">
            <label>Lokasi Instansi</label>
            <input type="text" name="lokasi" class="form-control" value="<?php echo $i['lokasi']?>" ></input>
          </div>
          <div class="form-group">
            <label>Judul Proyek</label>
            <input type="text" name="judul_kp" class="form-control" value="<?php echo $i['judul_kp']?>" ></input>
          </div>
           <div class="form-group">
            <label>Ditujukan ke</label>
            <input type="text" name="ditujukan" class="form-control" value="<?php echo $i['ditujukan']?>" ></input>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Tutup</button>
            <button class="btn btn-primary" name="tombolSimpan">Simpan</button>
          </div>
        </form>  
      </div>
    </div>
  </div>
</div>
<?php endforeach; 
?> 