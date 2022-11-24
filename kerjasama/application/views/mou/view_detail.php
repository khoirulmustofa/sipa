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
                                <td><button onclick="btn_lihat_dokumen()" class="btn btn-info"><i class="fas fa-eye"></i> Lihat</button></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td><?php
                                    $tanggal_sekarang = date('Y-m-d');
                                    $tanggal_akhir    = date('Y-m-d', strtotime($tanggal_akhir));
                                    $tanggal_6lagi =  date('Y-m-d', strtotime('+6 months'));

                                    if ($tanggal_akhir > $tanggal_sekarang && $tanggal_akhir < $tanggal_6lagi) { ?>
                                        <button class="btn btn-warning">
                                            <span class="btn-label">
                                                <i class="fa fa-exclamation-circle"></i>
                                            </span>
                                            Akan Berakhir
                                        </button>
                                        <a href="<?php echo base_url('mou/perpanjang?mou_id=' . $id) ?>" class="btn btn-success">
                                            <span class="btn-label">
                                                <i class="fa fa-check"></i>
                                            </span>
                                            Perpanjang
                                        </a>
                                    <?php   } else if ($tanggal_akhir > $tanggal_sekarang) { ?>
                                        <button class="btn btn-default">
                                            <span class="btn-label">
                                                <i class="fas fa-ban"></i>
                                            </span>
                                            Berakhir
                                        </button>
                                       
                                    <?php  } else { ?>
                                        <button class="btn btn-success">
                                            <span class="btn-label">
                                                <i class="fa fa-check"></i>
                                            </span>
                                            Aktif
                                        </button>
                                    <?php } ?>
                                </td>
                            </tr>
                           
                        </table>
                    </div>
                    <div class="card-action">
                        <a href="<?php echo base_url('mou') ?>" class="btn btn-default"><i class="far fa-window-close"></i> Batal</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal_dok_mou" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="far fa-file-alt"></i> Detail Dokumen MOU</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe src="<?php echo base_url('assets/doc_mou/' . $dokumen) ?>" title="description" style="width: 100%; height: 720px;"></iframe>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="far fa-times-circle"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>