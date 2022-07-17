<div class="col-lg-12 mb-1">
  <?php echo $this->session->flashdata('messege'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">PENGAJUAN SURAT PENGANTAR INSTANSI</h5>
    </div><br>
    <div class="content"><br>
      <div class="container-fluid">
        <div class="card shadow mb-4">
          <div class="card-body">         
           <form action="<?php echo site_url().'/fakultas/surat_pengantar'; ?>" method="post" enctype="multipart/form-data">
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
                  <label>AKSI</label>
                  <br>
                  <input type="submit" name="tombol_cari" value="Tampilkan Data" class="btn btn-primary">
                </div>
              </div>
            </div>
          </form><hr>
          <div class="table-responsive">
            <div class="scroll">
              <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead class="table table-primary">
                  <tr>
                    <td align="center"><b>NO.</b></td>
                    <td align="center"><b>NPM</b></td>
                    <td align="center"><b>PRODI</b></td>
                    <td align="center"><b>NAMA MAHASISWA</b></td>
                    <td align="center"><b>NAMA INSTANSI</b></td>
                    <td align="center"><b>ALAMAT INSTANSI</b></td>
                    <td align="center"><b>LOKASI</b></td>
                    <td align="center"><b>DETAIL</b></td>
                    <td align="center"><b>AKSI</b></td>
                  </tr>
                </thead>
                <tbody>

                  <?php 
                  $no = 1;
                  foreach ($pencarian_data as $i):
                    $id_surat_pengantar  = $i['id_surat_pengantar'];
                  $npm                 = $i['npm'];
                  $nama_prodi          = $i['nama_prodi'];
                  $nama_mahasiswa      = $i['nama_mahasiswa'];
                  $nama_instansi       = $i['nama_instansi'];
                  $alamat_instansi     = $i['alamat_instansi'];
                  $lokasi     = $i['lokasi'];
                  ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $npm;?></td>
                    <td><?php echo $nama_prodi;?></td>
                    <td><?php echo ucwords($nama_mahasiswa);?></td>
                    <td><?php echo $nama_instansi;?></td>
                    <td><?php echo $alamat_instansi;?></td>
                    <td><?php echo $lokasi;?></td>
                    <td align="center">
                      <a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/surat_pengantar/'.$i['nama_file_surat_pengantar']) ?>"><i class="fas fa-eye text-primary"></i></a> 
                    </td>
                    <td>
                      <?php 
                      if ($this->m_surat_pengantar->cekResponSuratPengantarFakultas($id_surat_pengantar)<=0 AND $_SESSION['jabatan']=='Dekan') {      
                        ?>
                        <i class="btn btn-primary" data-toggle="modal" data-target="#ModalTandaTangan<?php echo $i['id_surat_pengantar'] ?>">Setuju?</i>
                        <div class="modal fade" id="ModalTandaTangan<?php echo $i['id_surat_pengantar'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel" >Tanda tangan Surat Pengantar Instansi</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                              </div>
                              <form action="<?php echo site_url('/fakultas/surat_pengantar/tandatangandekan') ?>" method ="post">
                                <div class="modal-body"> 
                                  <input type="hidden" name="id_surat_pengantar" value="<?php echo $i['id_surat_pengantar']  ?>"></input>
                                  <input type="hidden" name="nama_instansi" value="<?php echo $i['nama_instansi']  ?>"></input>
                                  <input type="hidden" name="alamat_instansi" value="<?php echo $i['alamat_instansi']  ?>"></input>
                                  <input type="hidden" name="npm" value="<?php echo $i['npm']  ?>"></input>
                                  <input type="hidden" name="nama_mahasiswa" value="<?php echo $i['nama_mahasiswa']  ?>"></input>
                                  <input type="hidden" name="waktu_mulai" value="<?php echo $i['waktu_mulai']  ?>"></input>
                                  <input type="hidden" name="waktu_selesai" value="<?php echo $i['waktu_selesai']  ?>"></input>
                                  <input type="hidden" name="tgl_upload_surat_pengantar" value="<?php echo $i['tgl_upload_surat_pengantar']  ?>"></input>
                                  <label>Apakah anda yakin menandatangani surat ini? <br>
                                    <small class="text-danger">(Jika sudah disetujui, maka tidak dapat dibatalkan)</small></label>
                                  </div>
                                  <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                                    <button class="btn btn-primary" type="submit" name="tombolSetuju">Ya</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                          <?php }elseif ($this->m_surat_pengantar->cekResponSuratPengantarFakultas($id_surat_pengantar)<=0 AND $_SESSION['jabatan']!='Dekan'){ ?>
                          <i class="text-danger"> Belum di TandaTangani Dekan</i>
                          <?php }else{ ?>
                          <a target="_BLANK" href="<?php echo site_url('/fakultas/surat_pengantar/cetak/').$id_surat_pengantar ?>"><i class="fas fa-download text-success"> Unduh</i></a>
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