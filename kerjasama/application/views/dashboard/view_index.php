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
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tingkat_moa">Tingkatan</label>
                                    <select class="form-control" id="tingkat_moa" name="tingkat_moa">
                                        <option value="">--Pilih Tingkatan--</option>
                                        <option value="Wilayah">Wilayah</option>
                                        <option value="Nasional">Nasional</option>
                                        <option value="Internasional">Internasional</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tahun Kerja Sama :</label>
                                    <div class="input-group">
                                        <select class="form-control" name="tahun_moa" id="tahun_moa">
                                            <option value="">--Pilih Tahun--</option>
                                            <?php foreach ($tahun_moa_result as $key => $value) {
                                                echo '<option value="' . $value->tahun_moa . '">' . $value->tahun_moa . '</option>';
                                            } ?>

                                        </select>
                                        <div class="input-group-append">
                                            <button type="button" onclick="btn_load_moa_mou()" class="btn btn-primary rounded ml-3"><i class="fas fa-filter"></i> Filter</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
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
                        <hr>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tingkat_moa">Tingkatan</label>
                                        <select class="form-control" id="tingkat_moa2" name="tingkat_moa2">
                                            <option value="">--Pilih Tingkatan--</option>
                                            <option value="Wilayah">Wilayah</option>
                                            <option value="Nasional">Nasional</option>
                                            <option value="Internasional">Internasional</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tahun Kerja Sama :</label>
                                        <div class="input-group">
                                            <select class="form-control" name="tahun_moa2" id="tahun_moa2">
                                                <option value="">--Pilih Tahun--</option>
                                                <?php foreach ($tahun_moa_result as $key => $value) {
                                                    echo '<option value="' . $value->tahun_moa . '">' . $value->tahun_moa . '</option>';
                                                } ?>
                                            </select>
                                            <div class="input-group-append">
                                                <button type="button" onclick="btn_load_moa_mou2()" class="btn btn-primary rounded ml-3"><i class="fas fa-filter"></i> Filter</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php foreach ($prodi_result as $key => $value) { ?>
                                <div class="col-sm-6 col-md-3">
                                    <div class="card card-stats card-info card-round">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="icon-big text-center">
                                                        <i class="flaticon-interface-6"></i>
                                                    </div>
                                                </div>
                                                <div class="col-7 col-stats">
                                                    <div class="numbers">
                                                        <p class="card-category"><?php echo $value->nama_prodi ?></p>
                                                        <h4 class="card-title" id="<?php echo 'kode_prodi' . $value->kode_prodi ?>">0</h4>
                                                    </div>
                                                </div>
                                            </div>
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