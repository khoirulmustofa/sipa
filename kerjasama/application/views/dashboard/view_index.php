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
                    <div class="card-body">
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
                                            <button type="button" onclick="load_data_kerja_sama()" class="btn btn-primary rounded ml-3"><i class="fas fa-filter"></i> Filter</button>
                                        </div>
                                    </div>

                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-primary card-round">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="fas fa-address-book"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 col-stats">
                                                <div class="numbers">
                                                    <p class="card-category">MOU</p>
                                                    <h4 class="card-title" id="mou">0</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-secondary card-round">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="far fa-address-book"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 col-stats">
                                                <div class="numbers">
                                                    <p class="card-category">MOA</p>
                                                    <h4 class="card-title" id="moa">0</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>