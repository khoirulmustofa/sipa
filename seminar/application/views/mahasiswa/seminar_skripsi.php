<div class="col-lg-12 mb-1">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">SEMINAR SKRIPSI</h5>
    </div><br><br>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">Upload Berkas Seminar</h4>
              </div>
              <div class="card-body">
                <form action="<?php echo base_url().'mahasiswa/sk/tambah_aksi'; ?>" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>JENIS SK</label>
                        <select name="id_jenis_sk" class="form-control" required>
                          <option value="">
                            --Pilih--
                          </option>
                          <?php foreach ($combobox_jenis_sk as $item): ?>
                            <option value="<?php echo $item['id_jenis_sk'] ?>"><?php echo $item['nama_jenis_sk']  ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="bmd-label-floating">UPLOAD FILE BERKAS</label><input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    
                  </div>
                  
                  <button type="submit" class="btn btn-primary pull-right">Upload Berkas</button>
                  <div class="clearfix"></div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-profile">
              <div class="card-body">
                <h6 class="card-category text-gray">Syarat Daftar Seminar</h6>
                <ol>
                  <li>Bukti Asli Pembayaran SPP Dasar Semester yang sedang Berjalan(UPLOAD YANG DARI <a target="_blank" href="https://sikad.uir.ac.id">SIKAD</a>)</li>
                  <li>Transkip Nilai Sementara</li>
                  <li>KRS yang Telah Dicap Lunas</li>
                  <li><a target="_blank" href="https://drive.google.com/open?id=1VQlPLgj4AJ_IuhF-hkrkD-evO0cMAQIh">Lembar Pengesahan KP</a>. 
                  </li>
                  <li><a target="_blank" href="https://drive.google.com/open?id=1kgbt40Q-vFGLNKwAi1mkPoNeaD_JABjq">Berita Acara Seminar KP</a>. </li>
                  <li>File Proposal Kerja Praktek(PDF)</li>
                  <li><font color='#ff0000'>Semua syarat digabungkan dan dijadikan 1 file PDF</font></li>
                </ol>
              </div>
            </div>
          </div>
        </div><br>
      </div>
    </div>
  </div>
</div>