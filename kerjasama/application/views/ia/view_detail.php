<?php $CI = &get_instance(); ?>
<div class="content">
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h1 class="text-white pb-2 fw-bold"><?= $title ?></h1>
                    <h5 class="text-white op-7 mb-2">
                        Fakultas Teknik Universitas Islam Riau</h5>
                </div>

            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table">
                                    <tr>
                                        <th>Kategori</th>
                                        <td>:</td>
                                        <td>
                                            <?php foreach ($ia_kategori_result as $key => $value) {
                                                echo $value->kategori . "<br>";
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tingkat</th>
                                        <td>:</td>
                                        <td><?php echo $tingkat_ia ?></td>
                                    </tr>
                                    <tr>
                                        <th>Judul Kegiatan</th>
                                        <td>:</td>
                                        <td><?php echo $judul_kegiatan_ia ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Awal</th>
                                        <td>:</td>
                                        <td><?php echo tgl_indo($tanggal_awal_ia) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Akhir</th>
                                        <td>:</td>
                                        <td><?php echo tgl_indo($tanggal_akhir_ia) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Durasi</th>
                                        <td>:</td>
                                        <td><?php echo $selisih_hari ?></td>
                                    </tr>                                    
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table">
                                    <tr>
                                        <th>Dosen Yang Terlibat</th>
                                        <td>:</td>
                                        <td><?php foreach ($ia_dosen_result as $key => $value) { ?>
                                                <?php echo $value->nama_dosen ?><br>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Dosen Luar Biasa</th>
                                        <td>:</td>
                                        <td><?php foreach ($ia_dosen_luar_biasa_result as $key => $value) { ?>
                                                <?php echo $value->nama_dosen_luar_biasa ?><br>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Mahasiswa</th>
                                        <td>:</td>
                                        <td><?php foreach ($ia_mahasiswa_result as $key => $value) { ?>
                                                <?php echo $value->nama_mahasiswa ?><br>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Dokumen Pendukung</th>
                                        <td>:</td>
                                        <td><?php foreach ($ia_dokumen_result as $key => $value) { ?>
                                                <?php echo $value->jenis_dokumen ?><br>
                                                <?php echo $value->nama_file ?><br>
                                                <button type="button" onclick="btn_show_dok_pendukung('<?php echo $value->file_dokumen ?>')" class="btn btn-info btn-sm">Lihat</button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
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

<div class="modal fade" id="modal_dok" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="far fa-file-alt"></i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="preview_dokumen">

            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="far fa-times-circle"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>


<script>
    function btn_show_dok_pendukung(btn_show_dok_pendukung) {
        let dokumen = `<embed src="<?php echo base_url('assets/doc_ia/') ?>${btn_show_dok_pendukung}" type="" style="width: 100%;" height="720px">`;
        $('#preview_dokumen').html(dokumen);
        $('#modal_dok').modal('show');
    }
</script>