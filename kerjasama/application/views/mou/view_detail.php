<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="far fa-file-alt"></i> <?php echo $title ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
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
                        <button type="button" onclick="btn_lihat_dokumen('<?php echo $dokumen ?>')" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Lihat</button>
                        <div id="preview_dokumen"></div>
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
    <div class="card-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="far fa-times-circle"></i> Tutup</button>
    </div>
</div>

<script>
    function btn_lihat_dokumen(doc) {
        console.log(doc);
        let dokumen = `<embed src="<?php echo base_url('assets/doc_mou/' . $dokumen) ?>" type="" style="width: 100%;" height="720px">`;
        $('#preview_dokumen').html(dokumen);
    }
</script>