<div class="col-lg-12 mb-1">
  <?php echo $this->session->flashdata('messege'); ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">Penunjukan Dosen Pembimbing</h5>
    </div><br>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-body">
                <form action="<?php echo base_url().'prodi/penunjukan_pembimbing/tambah_aksi'; ?>" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>PILIH DOSEN</label>
                        <select name="npk" class="form-control" required>
                          <option value="">
                            --Pilih--
                          </option>
                          <?php foreach ($combobox_dosen as $item): ?>
                            <option value=""><?php echo $item['nama_dosen']  ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                      <!-- <div class="form-group">
                        <label class="bmd-label-floating">UPLOAD FILE BERKAS</label><input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>
                      </div> -->
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><br>
  </div>
</div>