<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?php echo $title ?></h3>

            </div>
        </div>
        <p><?php echo $this->session->login_smpu; ?>
            <br>
            <?php echo $this->session->status_login; ?>
        </p>
        <i class="fa fa-edit"></i>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">
                        <button type="button" onclick="btn_tambah_kerja_sama()" class="btn btn-success"> Tambah Kerja Sama</button>
                        <table id="dt_kerja_sama" class="table table-striped table-bordered">
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