<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?php echo $title ?></h3>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="fullname">Jenis Kegiatan :</label>
                                <select class="form-control" name="jenis_kerjasama">
                                    <option value="">--Pilih Kerja Sama--</option>
                                    <option value="Pendidikan/Pengajaran">Pendidikan/Pengajaran</option>
                                    <option value="Penelitian">Penelitian</option>
                                    <option value="Pengabdian Masyarakat">Pengabdian Masyarakat</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <button type="button" onclick="load_data_kerja_sama()" class="btn btn-secondary"><i class="fa fa-send-o"></i> Filter</button>
                            </div>
                        </div>
                        <hr>
                        <p><b>Keterangan :</b> Peringatan akan tampil H-3 bulan (MoA) dan H-6 (MoU) sebelum akhir masa kerja sama.</p>
                        <button type="button" onclick="btn_add_kegiatan()" class="btn btn-success"> Tambah Kegiatan</button>
                        <table id="dt_kegiatan" class="table table-striped table-bordered" style="width:100%">
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

                            <tfoot>
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
                            </tfoot>
                        </table>
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