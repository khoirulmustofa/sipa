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
                    <?php if ($_SESSION['status_login'] == "Tata Usaha") { ?>
                        <button type="button" class="btn btn-success" onclick="btn_add()"><i class="far fa-plus-square"></i> Tambah MOA</button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tingkatan :</label>
                                    <select class="form-control" id="tingkat_ia" name="tingkat_ia">
                                        <option value="">--Pilih Tingkatan--</option>
                                        <option value="Wilayah">Wilayah</option>
                                        <option value="Nasional">Nasional</option>
                                        <option value="Internasional">Internasional</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                           

                            <table id="myDatatables" class="table table-bordered table-head-bg-primary table-striped table-hover text-nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Prodi</th>
                                        <th rowspan="2">Lembaga Mitra</th>
                                        <th colspan="3" style="text-align: center;">Tingkatan</th>
                                        <th rowspan="2">Judul Kerjasama</th>
                                        <th rowspan="2">Manfaat Bagi PS yang Diakreditasi</th>
                                        <th rowspan="2">Waktu dan Durasi</th>
                                        <th rowspan="2">Bukti Kerja sama</th>
                                    </tr>
                                    <tr>
                                        <th>International</th>
                                        <th>Nasional</th>
                                        <th>Lokasi Wilayah</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>