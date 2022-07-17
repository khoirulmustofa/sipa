<div class="col-lg-12 mb-1">
  <?php echo $this->session->flashdata('messege'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">Pengurusan SK Penguji Skripsi</h5>
    </div><br>
    <div class="content"><br>
      <div class="container-fluid">
        <div class="card shadow mb-4">
          <div class="card-body">         
            <form action="<?php echo site_url().'/fakultas/penguji_skripsi'; ?>" method="post" enctype="multipart/form-data">
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
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                  <thead class="table table-primary">
                    <tr>
                      <td align="center"><b>NO.</b></td>
                      <td align="center"><b>NPM</b></td>
                      <td align="center"><b>NAMA MAHASISWA</b></td>
                      <td align="center"><b>AKSI</b></td>
                    </tr>
                  </thead>
                  <tbody>
                   <?php  
                   $no = 1;
                   foreach ($pencarian_data as $i):
                    $id_syarat_sempro = $i['id_syarat_sempro'];
                  $npm            = $i['npm'];
                  $nama_mahasiswa = $i['nama_mahasiswa'];
                  ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $npm;?></td>
                    <td><?php echo ucwords($nama_mahasiswa); ?></td>
                    <td>
                      <?php 
                      if ($this->m_penguji_skripsi->cekResponSKFakultas($id_syarat_sempro)<=0 AND $_SESSION['jabatan']=='Dekan') {      
                        ?>
                        <i class="btn btn-primary" data-toggle="modal" data-target="#ModalTandaTangan<?php echo $i['id_syarat_sempro'] ?>">Setuju?</i>
                        <div class="modal fade" id="ModalTandaTangan<?php echo $i['id_syarat_sempro'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel" >Tanda tangan SK Pembimbing KP</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                              </div>
                              <form action="<?php echo site_url('/fakultas/penguji_skripsi/tandatangandekan') ?>" method ="post">
                                <div class="modal-body"> 
                                  <input type="hidden" name="id_syarat_sempro" value="<?php echo $i['id_syarat_sempro']  ?>"></input>
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
                          <?php }elseif ($this->m_penguji_skripsi->cekResponSKFakultas($id_syarat_sempro)<=0 AND $_SESSION['jabatan']!='Dekan'){ ?>
                          <i class="text-danger"> Belum di TandaTangani Dekan</i>
                          <?php }else{  ?>

                          <a target="_BLANK" href="<?php echo site_url('/fakultas/penguji_skripsi/cetak_sk_penguji_skripsi/').$id_syarat_sempro ?>"><i class="fas fa-download text-success"> Unduh</i></a>
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
