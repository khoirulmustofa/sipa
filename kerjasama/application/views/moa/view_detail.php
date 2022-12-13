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
                                        <th>Dokumen MUO</th>
                                        <td>:</td>
                                        <td>
                                            <?php
                                            $CI->load->model('Mou_model');
                                            $mou_row =  $CI->Mou_model->getMouById($moa_row->mou_id)->row();
                                            ?>
                                            <button type="button" onclick="btn_show_doc_mou()" class="btn btn-info btn-sm">Lihat</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Kategori</th>
                                        <td>:</td>
                                        <td><?php foreach ($moa_kategori_result as $key => $value) {
                                                echo $value->kategori . "<br>";
                                            } ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggak MOA</th>
                                        <td>:</td>
                                        <td><?= tgl_indo($moa_row->tanggal) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal MOA Berakhir</th>
                                        <td>:</td>
                                        <td><?= tgl_indo($moa_row->tanggal_akhir) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Selisih Waktu</th>
                                        <td>:</td>
                                        <td><?php
                                            echo timespan(strtotime($moa_row->tanggal), strtotime($moa_row->tanggal_akhir), 3);
                                            ?></td>
                                    </tr>
                                    <tr>
                                        <th>Kecamata</th>
                                        <td>:</td>
                                        <td><?= $moa_row->kecamatan_nama ?></td>
                                    </tr>
                                    <tr>
                                        <th>Kabupaten/Kota</th>
                                        <td>:</td>
                                        <td><?= $moa_row->kota_kabupaten_nama ?></td>
                                    </tr>
                                    <tr>
                                        <th>Provinsi</th>
                                        <td>:</td>
                                        <td><?= $moa_row->province_name ?></td>
                                    </tr>
                                    <tr>
                                        <th>Negara</th>
                                        <td>:</td>
                                        <td><?= $moa_row->nama_negara ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table">
                                    <tr>
                                        <th>Lembaga Mitra</th>
                                        <td>:</td>
                                        <td>
                                            <?php
                                            $result = "";
                                            $no = 1;

                                            foreach ($moa_lembaga_mitra_result as $key => $value) {
                                                $result .= $result . $no++ . ". " . $value->nama_lembaga_mitra . "<br>";
                                            }
                                            echo $result;
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>:</td>
                                        <td><?= $moa_row->alamat_moa ?></td>
                                    </tr>
                                    <tr>
                                        <th>Dokumen Pendukung</th>
                                        <td>:</td>
                                        <td><?php
                                            $doc_pendukung = "";
                                            foreach ($moa_dokumen_result as $key => $value) {
                                                $doc_pendukung .= $value->jenis_dokumen;
                                            }
                                            echo $doc_pendukung;
                                            ?></td>
                                    </tr>

                                    <tr>
                                        <th>Ditujukan Kepada Prodi</th>
                                        <td>:</td>
                                        <td>
                                            <?php
                                            foreach ($moa_prodi_result as $key2 => $value2) {
                                                echo $value2->nama_prodi . "<br>";
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>:</td>
                                        <td>
                                            <?php
                                            $tanggal_sekarang = date('Y-m-d');
                                            $tanggal_akhir    = date('Y-m-d', strtotime($moa_row->tanggal_akhir_moa));
                                            $tanggal_6lagi =  date('Y-m-d', strtotime('+3 months'));

                                            if ($tanggal_akhir > $tanggal_sekarang && $tanggal_akhir < $tanggal_6lagi) { ?>
                                                <button type="button" class="btn btn-warning btn-sm"> Akan Berakhir</button>
                                                <button type="button" onclick="btn_perpanjang_moa('<?php echo $id ?>')" class="btn btn-success btn-sm">
                                                    Perpanjang
                                                </button>
                                            <?php } else if ($tanggal_akhir < $tanggal_sekarang) { ?>
                                                <button type="button" class="btn btn-danger btn-sm"> Berakhir</button>
                                                <button type="button" onclick="btn_perpanjang_moa('<?php echo $id ?>')" class="btn btn-success btn-sm">
                                                    Perpanjang
                                                </button>
                                            <?php  } else { ?>
                                                <button type="button" class="btn btn-success btn-sm">Aktif</button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="card-header">
                        <h4 class="card-title">TABLE IMPLEMANTASI ARANGEMENT (AI) PRODI</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="my_table_ia" class="display table table-striped table-hover text-nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Aksi</th>
                                        <th>Prodi</th>
                                        <th>Tingkatan</th>
                                        <th>Judul Kegiatan</th>
                                        <th>Durasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($ia_result as $key => $value) { ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><button type="button" onclick="btn_detail_ia('<?php echo $value->id ?>','<?php echo $value->kode_prodi ?>')" class="btn btn-info btn-sm">Detail</button></td>
                                            <td><?php echo $value->nama_prodi ?></td>
                                            <td><?php echo $value->tingkat_ia ?></td>
                                            <td><?php echo $value->judul_kegiatan ?></td>
                                            <td><?php echo $value->selisih_hari ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
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

<div class="modal fade" id="modal_detail_ia" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="far fa-file-alt"></i>DETAIL IMPLEMANTASI ARANGEMENT (AI) PRODI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="view_modal_detail_ia"></div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="far fa-times-circle"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    function btn_show_doc_mou() {
        let dokumen = `<embed src="<?php echo base_url('assets/doc_mou/' . $mou_row->dokumen) ?>" type="" style="width: 100%;" height="720px">`;
        $('#preview_dokumen').html(dokumen);
        $('#modal_dok').modal('show');
    }

    function btn_show_dok_pendukung(btn_show_dok_pendukung) {
        let dokumen = `<embed src="<?php echo base_url('assets/doc_moa/') ?>${btn_show_dok_pendukung}" type="" style="width: 100%;" height="720px">`;
        $('#preview_dokumen').html(dokumen);
        $('#modal_dok').modal('show');
    }

    function btn_detail_ia(ia_id, kode_prodi) {
        $.ajax({
            url: '<?php echo base_url('moa/detail_ia_by_moa') ?>',
            data: {
                ia_id: ia_id,
                kode_prodi: kode_prodi
            },
            type: "GET",
            dataType: "JSON",
            success: function(respon) {
                Swal.close();
                if (respon.status) {
                    $('#view_modal_detail_ia').html(respon.view_modal_form);
                    $('.modal-dialog').addClass('modal-xl');
                    $('#modal_form').modal('show');
                } else {
                    messegeWarning(respon.messege);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                Swal.close();
                alert("Code Status : " + xhr.status + "\nMessege Error :" + thrownError);
            }
        });
        $('#modal_detail_ia').modal('show');
    }

    function btn_perpanjang_moa(id) {
        $.ajax({
            url: '<?php echo base_url('moa/perpanjang') ?>',
            data: {
                id: id
            },
            type: "GET",
            dataType: "JSON",
            success: function(respon) {
                Swal.close();
                if (respon.status) {
                    $('.modal-dialog').addClass('modal-xl');
                    $('#view_modal_form').html(respon.view_modal_form);
                    $('#modal_form').modal('show');
                } else {
                    messegeWarning(respon.messege);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                Swal.close();
                alert("Code Status : " + xhr.status + "\nMessege Error :" + thrownError);
            }
        });
    }
</script>