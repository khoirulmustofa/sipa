<div class="col-lg-12 mb-1">
  <?php echo $this->session->flashdata('messege'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">DAFTAR MAHASISWA YANG TERKENA SANKSI</h5>
    </div><br>
    <div class="content">
      <div class="container-fluid">
        <div class="card shadow mb-4">
          <div class="card-body">
           <a class="btn btn-primary text-white border-white custom-btn btn-sm" data-toggle="modal" data-target="#ModalTambahSanksi">Tambah Sanksi</a>
           <div class="modal fade" id="ModalTambahSanksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><b class="text-info">TAMBAH DATA SANKSI</b></h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                 <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/prodi/sanksi/tambah_sanksi')?>">
                  <div class="form-group">
                    <label>MAHASISWA</label>
                    <input list="browsers" name="npm" id="browser" class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label>Penyebab</label>
                    <textarea class="form-control" name="penyebab"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Sanksi</label>
                    <textarea class="form-control" name="sanksi"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Tanggal Mulai Sanksi</label>
                    <div class="row">
                      <div class="col-md-6">
                        <input type="date" name="tanggal_mulai_sanksi" class="form-control" required=""></input>
                      </div>
                      <div class="col-md-6">
                        <input type="time" name="jam_mulai_sanksi" class="form-control" required=""></input>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Tanggal Selesai Sanksi</label>
                    <div class="row">
                      <div class="col-md-6">
                        <input type="date" name="tanggal_selesai_sanksi" class="form-control" required=""></input>
                      </div>
                      <div class="col-md-6">
                        <input type="time" name="jam_selesai_sanksi" class="form-control" required=""></input>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-danger" type="reset" data-dismiss="modal">Tutup</button>
                    <button class="btn btn-primary" type="submit" name="tombolSanksi">Submit</button>
                  </div>
                </form>  
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class="table table-primary">
              <tr>
                <td align="center"><b>NO.</b></td>
                <td align="center"><b>NPM</b></td>
                <td align="center"><b>NAMA</b></td>
                <td align="center"><b>PENYEBAB</b></td>
                <td align="center"><b>SANKSI</b></td>
                <td align="center"><b>WAKTU MULAI SANKSI</b></td>
                <td align="center"><b>WAKTU SELESAI SANKSI</b></td>
                <td align="center"><b>KETERANGAN</b></td>
                <td align="center"><b>AKSI</b></td>
              </tr>
            </thead>
            <tbody>
              <?php 
              
              $no = 1;
              date_default_timezone_set('Asia/Jakarta');
              $waktu_sekarang = date('Y-m-d H:i:s');
              foreach ($data_sanksi as $i):
                $id_sanksi            = $i['id_sanksi'];
              $npm                  = $i['npm'];
              $nama_mahasiswa       = $i['nama_mahasiswa'];
              $penyebab             = $i['penyebab'];
              $sanksi               = $i['sanksi'];
              $waktu_mulai_sanksi   = $i['waktu_mulai_sanksi'];
              $waktu_selesai_sanksi = $i['waktu_selesai_sanksi'];
              ?>
              <tr>
                <td><?php echo $no++;?></td>
                <td><?php echo $npm;?></td>
                <td><?php echo ucwords($nama_mahasiswa); ?></td>
                <td><?php echo $penyebab;?></td>
                <td><?php echo $sanksi;?></td>
                <td>
                  <?= $this->m_sanksi->format_tanggal(date('Y-m-d', strtotime($waktu_mulai_sanksi))); ?> 
                </td>
                <td>
                  <?= $this->m_sanksi->format_tanggal(date('Y-m-d', strtotime($waktu_selesai_sanksi))); ?> 
                </td>
                <td>
                  <?php
                  if($waktu_sekarang < $waktu_mulai_sanksi){
                    echo '<b class="text-warning">Sanksi Belum Berlaku</b>';
                  }elseif($waktu_sekarang > $waktu_selesai_sanksi){
                    echo '<b class="text-success">Sanksi Sudah Berakhir</b>';
                  }else{
                    echo '<b class="text-danger">Sanksi Masih Berlaku</b>';
                  }
                  ?>
                </td>
                <td>
                  <a class="btn btn-primary text-white border-white custom-btn btn-sm" data-toggle="modal" data-target="#ModalEditSanksi<?= $id_sanksi ?>">Edit</a> 
                  <div class="modal fade" id="ModalEditSanksi<?= $id_sanksi ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                   <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><b class="text-info">EDIT DATA SANKSI</b></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">
                       <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/prodi/sanksi/tambah_sanksi')?>">
                        <div class="form-group">
                          <label>MAHASISWA</label>
                          <input list="browsers" name="npm" id="browser" class="form-control" required="">
                          <datalist id="browsers">
                            <option selected value="00">
                              00
                            </option>
                            <?php 
                            foreach ($combobox_mahasiswa as $mhs){

                             ?>
                             <option value="<?php echo $mhs['npm'] ?>" id="<?php echo $mhs['npm'] ?>" ><?php echo $mhs['nama_mahasiswa'] ?></option>
                             <?php } ?>
                           </datalist>
                           <script type="text/javascript">
                          //  var x = "<?php echo"$npm"?>";
                          //  document.write(x)
                          
                          //  $("#SelectColor").change(function(){
                          //   var el=$("#browser")[0];  //used [0] is to get HTML DOM not jquery Object
                          //   var dl=$("#browsers")[0];
                          //   if(el.value.trim() != ''){
                          //   var opSelected = dl.querySelector(`[value="${el.value}"]`);
                          //   alert(opSelected.getAttribute('id'));
                          //  }
                          // });
                        </script>
                      </div>
                      <div class="form-group">
                        <label>Penyebab</label>
                        <textarea class="form-control" name="penyebab"><?= $penyebab ?></textarea>
                      </div>
                      <div class="form-group">
                        <label>Sanksi</label>
                        <textarea class="form-control" name="sanksi"><?= $sanksi ?></textarea>
                      </div>
                      <div class="form-group">
                        <label>Tanggal Mulai Sanksi</label>
                        <div class="row">
                          <div class="col-md-6">
                            <input type="date" name="tanggal_mulai_sanksi" class="form-control" value="<?= date('Y-m-d', strtotime($waktu_mulai_sanksi))  ?>" required=""></input>
                          </div>
                          <div class="col-md-6">
                            <input type="time" name="jam_mulai_sanksi" class="form-control" value="<?= date('H:i:s', strtotime($waktu_mulai_sanksi)) ?>" required=""></input>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Tanggal Selesai Sanksi</label>
                        <div class="row">
                          <div class="col-md-6">
                            <input type="date" name="tanggal_selesai_sanksi" class="form-control" value="<?= date('Y-m-d', strtotime($waktu_selesai_sanksi))  ?>" required=""></input>
                          </div>
                          <div class="col-md-6">
                            <input type="time" name="jam_selesai_sanksi" class="form-control" value="<?= date('H:i:s', strtotime($waktu_selesai_sanksi)) ?>" required=""></input>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-danger" type="reset" data-dismiss="modal">Tutup</button>
                        <button class="btn btn-primary" type="submit" name="tombolSanksi">Submit</button>
                      </div>
                    </form>  
                  </div>
                </div>
              </div>
            </div>

            <a class="btn btn-danger text-white border-white custom-btn btn-sm" data-toggle="modal" data-target="#ModalHapusSanksi<?= $id_sanksi ?>">Hapus</a> 
            <div class="modal fade" id="ModalHapusSanksi<?= $id_sanksi ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Sanksi Mahasiswa</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form class="form-horizontal" method="post" action="<?php echo site_url('/prodi/sanksi/hapus_data')?>">
                      <div class="modal-body">
                        <p>Anda yakin mau menghapus data sanksi mahasiswa?</p>
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" name="id_sanksi" value="<?php echo $id_sanksi;?>">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                        <button class="btn btn-danger" name="tombolHapus">Ya</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

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