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
                    <button type="button" class="btn btn-success" onclick="btn_tambah_kegiatan()"><i class="far fa-plus-square"></i> Tambah Kegiatan</button>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pilih Kerja Sama:</label>
                                    <div class="input-group">
                                        <select class="form-control" name="jenis_kegiatan">
                                            <option value="">--Pilih Kerja Sama--</option>
                                            <option value="Pendidikan/Pengajaran">Pendidikan/Pengajaran</option>
                                            <option value="Penelitian">Penelitian</option>
                                            <option value="Pengabdian Masyarakat">Pengabdian Masyarakat</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button type="button" onclick="load_data_keiatan()" class="btn btn-primary rounded ml-3"><i class="fas fa-filter"></i> Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dt_kegiatan" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th><b>NO</b></th>
                                        <th><b>AKSI</b></th>
                                        <th><b>JENIS KEGIATAN</b></th>
                                        <th><b>JUDUL KEGIATAN</b></th>
                                        <th><b>MANFAAT KEGIATAN</b></th>
                                        <th><b>AWAL PELAKSANA</b></th>
                                        <th><b>AKHIR PELAKSANA</b></th>
                                        <th><b>LAMA PELAKSANA (HARI)</b></th>
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