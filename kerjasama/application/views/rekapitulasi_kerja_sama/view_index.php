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
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Pilih Tahun Awal :</label>
                                    <input type="date" class="form-control" name="tanggal_awal_ia" id="tanggal_awal_ia">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pilih Tahun Akhit :</label>
                                    <div class="input-group mb-3">
                                        <input type="date" class="form-control" name="tanggal_akhir_ia" id="tanggal_akhir_ia">
                                        <div class="input-group-append">
                                            <span><button type="button" onclick="btn_cetak_rekap()" class="btn btn-info ml-2"><i class="far fa-file-pdf"></i> Cetak</button></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Kategori :</label>
                                    <select class="form-control" id="kategori_ia" name="kategori_ia">
                                        <option value="">--Pilih Kategori--</option>
                                        <option value="Pendidikan/Pengajaran">Pendidikan/Pengajaran</option>
                                        <option value="Penelitian">Penelitian</option>
                                        <option value="Pengabdian Masyarakat">Pengabdian Masyarakat</option>
                                    </select>
                                </div>
                            </div>
                            <?php if ($_SESSION['status_login'] != 'Prodi') { ?>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Prodi :</label>
                                        <select class="form-control" id="kode_prodi" name="kode_prodi">
                                            <option value="">--Pilih Prodi--</option>
                                            <?php foreach ($prodi_result as $key => $value) {
                                                echo '<option value="' . $value->kode_prodi . '">' . $value->nama_prodi . '</option>';
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-md-3">
                                <button type="button" onclick="btn_filter()" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
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


<div class="modal fade" id="modal_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div id="view_modal_form"></div>
    </div>
</div>

<div class="modal fade" id="modal_preview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="height: 100%">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Preview Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="view_modal_preview" style="width: 100%; "></div>
                <div id="view_modal_button"></div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="far fa-times-circle"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>