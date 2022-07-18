<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $title ?></h4>
    </div>
    <div class="modal-body">
        <table class="table">
            <tr>
                <td>Jenis Kerjasama</td>
                <td><?php echo $jenis_kerjasama; ?></td>
            </tr>
            <tr>
                <td>Tgl Kerjasama</td>
                <td><?php echo date('d F Y', strtotime($tgl_kerjasama)); ?></td>
            </tr>
            <tr>
                <td>Lembaga Mitra</td>
                <td><?php echo $lembaga_mitra; ?></td>
            </tr>
            <tr>
                <td>Alamat Mitra</td>
                <td><?php echo $alamat_mitra; ?></td>
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
                <td>Kabupaten Kota</td>
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
                <td>Durasi Kerjasama</td>
                <td><?php echo $durasi_kerjasama." Tahun"; ?></td>
            </tr>
            <?php
            if (strtotime(date("Y-m-d")) >= strtotime($tgl_peringatan)) {
                $tgl_peringtan = format_tgl_dMY($akhir_kerjasama) ." (Segera berakhir)";
            } else {
                $tgl_peringtan = format_tgl_dMY($akhir_kerjasama);
            }
            ?>
            <tr>
                <td>Akhir Kerjasama</td>
                <td><?php echo $tgl_peringtan; ?></td>
            </tr>
            <tr>
                <td>Dokumen Kerjasama</td>
                <td><a href="<?php echo base_url('kerjasama/assets/file_dok/'.$dokumen_kerjasama) ?>" class="btn btn-default btn-sm" download ><i class="fa fa-cloud-download"></i> Download</a></td>
            </tr>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-fw fa-close"></i> Close</button>
    </div>
</div>
<?php echo form_close() ?>