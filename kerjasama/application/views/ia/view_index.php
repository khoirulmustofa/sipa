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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tahun IA :</label>
                                    <select class="form-control" id="tahun_kerja_sama" name="tahun_kerja_sama">
                                        <option value="">--Pilih Tahun--</option>

                                        <option value="5">> 5 Tahun</option>
                                    </select>
                                </div>
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