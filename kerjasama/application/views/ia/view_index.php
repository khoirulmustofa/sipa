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
                    <?php if (($_SESSION['status_login'] == "Prodi")) { ?>
                        <button type="button" class="btn btn-success" onclick="btn_create()"><i class="far fa-plus-square"></i> Tambah IA</button>
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tahun IA :</label>
                                    <select class="form-control" id="tahun_ia" name="tahun_ia">
                                        <option value="">--Pilih Tahun--</option>
                                        <?php foreach ($tahun_ia_result as $key => $value) {
                                            echo '<option value="' . $value->tahun_ia . '">' . $value->tahun_ia . '</option>';
                                        } ?>
                                        <option value="5">> 5 Tahun</option>
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
                            <table id="myDatatables" class="display table table-striped table-hover text-nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Action</th>
                                        <th>Prodi</th>
                                        <th>Tingkatan</th>
                                        <th>Judul Kegiatan</th>
                                        <th>Awal Kegiatan</th>
                                        <th>Akhir Kegiatan</th>
                                        <th>Durasi Kegiatan(Hari)</th>
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