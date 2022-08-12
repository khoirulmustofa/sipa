<div class="content">
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h1 class="text-white pb-2 fw-bold"><?= $title ?></h1>
                    <h5 class="text-white op-7 mb-2">
                        Fakultas Teknik Universitas Islam Riau</h5>
                </div>
                <div class="ml-md-auto py-2 py-md-0">

                </div>
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-header">
                        <h4 class="card-title"><i class="fas fa-bars"></i> Kerja Sama</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tahun Kerja Sama :</label>
                                    <div class="input-group">
                                        <select class="form-control" name="tahun_kerja_sama">
                                            <option value="">--Pilih Tahun--</option>
                                            <?php foreach ($tahun_kerja_sama_result as $key => $value) {
                                                echo '<option value="' . $value->tgl_kerjasama . '">' . $value->tgl_kerjasama . '</option>';
                                            } ?>
                                            <option value="5">> 5 Tahun</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button type="button" onclick="btn_load_kerja_sama()" class="btn btn-primary rounded ml-3"><i class="fas fa-filter"></i> Filter</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-dark bg-primary-gradient">
                                    <div class="card-body bubble-shadow">
                                        <h2 class="py-4 mb-0">MOU</h2>
                                        <h3 class="fw-bold mb-1" id="mou">0</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-dark bg-info-gradient">
                                    <div class="card-body bubble-shadow">
                                        <h2 class="py-4 mb-0">MOA</h2>
                                        <h3 class="fw-bold mb-1" id="moa">0</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-header">
                        <h4 class="card-title"><i class="fas fa-bars"></i> Kegiatan</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pilih Semester:</label>
                                    <div class="input-group">
                                        <select class="form-control" name="tahun_semester">
                                            <option value="">--Pilih Semester--</option>
                                            <?php foreach ($semester_result as $key => $value) { ?>
                                                <option value="<?php echo $value->tahun . "#" . $value->semester ?>"><?php echo $value->tahun . "-" . $value->semester . " (" . $value->tahun . " " . ($value->semester == "1" ? "GANJIL" : "GENAP" . ")") ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button type="button" onclick="btn_load_kegiatan()" class="btn btn-primary rounded ml-3"><i class="fas fa-filter"></i> Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php foreach ($prodi_result as $key => $value) { ?>
                                <div class="col-sm-6 col-md-3">
                                    <div class="card card-dark bg-dark-gradient">
                                        <div class="card-body bubble-shadow">
                                            <h2 class="py-4 mb-0"><?php echo $value->nama_prodi ?></h2>
                                            <h3 class="fw-bold mb-1" id="kode_prodi_<?php echo $value->kode_prodi ?>">0</h3>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>