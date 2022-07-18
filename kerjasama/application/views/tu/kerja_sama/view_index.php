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
                                <label for="fullname">Jenis Kerja Sama :</label>
                                <select class="form-control" name="jenis_kerjasama">
                                    <option value="">--Pilih Kerja Sama--</option>
                                    <option value="MOU">MOU</option>
                                    <option value="MOA">MOA</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="fullname">Tahun Kerja Sama :</label>
                                <select class="form-control" name="tahun_kerja_sama">
                                    <option value="">--Pilih Tahun--</option>
                                    <?php foreach ($tahun_kerja_sama_result as $key => $value) {
                                        echo '<option value="' . $value->tgl_kerjasama . '">' . $value->tgl_kerjasama . '</option>';
                                    } ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="button" onclick="load_data_kerja_sama()" class="btn btn-secondary"><i class="fa fa-send-o"></i> Filter</button>
                            </div>
                        </div>
                        <hr>
                        <p><b>Keterangan :</b> Peringatan akan tampil H-3 bulan (MoA) dan H-6 (MoU) sebelum akhir masa kerja sama.</p>
                        <button type="button" onclick="btn_tambah_kerja_sama()" class="btn btn-success"> Tambah Kerja Sama</button>
                        <table id="dt_kerja_sama" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th><b>NO</b></th>
                                    <th><b>AKSI</b></th>
                                    <th><b>JENIS KERJASAMA</b></th>
                                    <th><b>LEMBAGA MITRA</b></th>
                                    <th><b>ALAMAT MITRA</b></th>
                                    <th><b>NEGARA</b></th>
                                    <th><b>DURASI KERJASAMA (TAHUN)</b></th>
                                    <th><b>AWAL KERJASAMA</b></th>
                                    <th><b>AKHIR KERJASAMA</b></th>
                                    <th><b>DOKUMEN KERJASAMA</b></th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th><b>NO</b></th>
                                    <th><b>AKSI</b></th>
                                    <th><b>JENIS KERJASAMA</b></th>
                                    <th><b>LEMBAGA MITRA</b></th>
                                    <th><b>ALAMAT MITRA</b></th>
                                    <th><b>NEGARA</b></th>
                                    <th><b>DURASI KERJASAMA (TAHUN)</b></th>
                                    <th><b>AWAL KERJASAMA</b></th>
                                    <th><b>AKHIR KERJASAMA</b></th>
                                    <th><b>DOKUMEN KERJASAMA</b></th>
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