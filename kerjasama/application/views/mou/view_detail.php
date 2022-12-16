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
                        <table class="table">
                            <tr>
                                <td>Periode</td>
                                <td><?php echo $periode; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td><?php echo tgl_indo($tanggal); ?></td>
                            </tr>
                            <tr>
                                <td>Nama Lembaga Mitra</td>
                                <td><?php echo $nama_lembaga_mitra; ?></td>
                            </tr>
                            <tr>
                                <td>Negara</td>
                                <td><?php echo $nama_negara; ?></td>
                            </tr>
                            <tr>
                                <td>Provinsi</td>
                                <td><?php echo $province_name; ?></td>
                            </tr>
                            <tr>
                                <td>Kota Kabupaten</td>
                                <td><?php echo $kota_kabupaten_nama; ?></td>
                            </tr>
                            <tr>
                                <td>Kecamatan</td>
                                <td><?php echo $kecamatan_nama; ?></td>
                            </tr>
                            <tr>
                                <td>Kelurahan</td>
                                <td><?php echo $kelurahan_nama; ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td><?php echo $alamat; ?></td>
                            </tr>
                            <tr>
                                <td>Durasi</td>
                                <td><?php echo $durasi; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Akhir</td>
                                <td><?php echo tgl_indo($tanggal_akhir); ?></td>
                            </tr>
                            <tr>
                                <td>Dokumen</td>
                                <td>
                                    <?php if ($dokumen != "") { ?>
                                        <button type="button" onclick="btn_lihat_dokumen()" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Lihat</button>
                                    <?php } ?>

                                </td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td><?php
                                    $tanggal_sekarang = date('Y-m-d');
                                    $tanggal_akhir    = date('Y-m-d', strtotime($tanggal_akhir));
                                    $tanggal_6lagi =  date('Y-m-d', strtotime('+6 months'));

                                    if ($tanggal_akhir > $tanggal_sekarang && $tanggal_akhir < $tanggal_6lagi) { ?>
                                        <button type="button" class="btn btn-warning btn-sm"> Akan Berakhir</button>
                                        <a href="<?php echo base_url('mou/perpanjang?mou_id=' . $id) ?>" class="btn btn-success">
                                            <span class="btn-label">
                                                <i class="fa fa-check"></i>
                                            </span>
                                            Perpanjang
                                        </a>
                                    <?php } else if ($tanggal_akhir < $tanggal_sekarang) { ?>
                                        <button type="button" class="btn btn-danger btn-sm"> Berakhir</button>
                                    <?php  } else { ?>
                                        <button type="button" class="btn btn-success btn-sm">Aktif</button>
                                    <?php } ?>
                                </td>
                            </tr>

                        </table>

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
                                            <td><?php echo $value->judul_kegiatan_ia ?></td>
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

<script>
    function btn_lihat_dokumen() {
        $('.modal-dialog').addClass('modal-xl');
        let dokumen = `<embed src="<?php echo base_url('assets/doc_mou/' . $dokumen) ?>" type="" style="width: 100%;" height="720px">`;
        $('#preview_dokumen').html(dokumen);
        $('#modal_dok').modal('show');
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