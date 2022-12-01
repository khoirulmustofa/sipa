<?php
$attribute = array('role' => 'form', 'id' => 'my_form');
echo form_open_multipart($action, $attribute);
?>
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
                <td>MOU</td>
                <td><?php echo $moa_row->nama_lembaga_mitra; ?></td>
            </tr>
            <tr>
                <td>Kategori Moa</td>
                <td><?php $arr_kategori_moa = explode('#', $moa_row->kategori_moa);
                    foreach ($arr_kategori_moa as $key => $value) {
                        echo  $value . "<br>";
                    }
                    ?></td>
            </tr>
            <tr>
                <td>Tingkat Moa</td>
                <td><?php echo $moa_row->tingkat_moa; ?></td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td><?php echo tgl_indo($moa_row->tanggal) ?></td>
            </tr>
            <tr>
                <td>Nama Lembaga Mitra Moa</td>
                <td>
                    <?php $arr_nama_lembaga_mitra_moa = explode('#', $moa_row->nama_lembaga_mitra_moa);
                    foreach ($arr_nama_lembaga_mitra_moa as $key => $value) {
                        echo  $value . "<br>";
                    }
                    ?></td>
            </tr>
            <tr>
                <td>Negara Id</td>
                <td><?php echo $moa_row->nama_negara; ?></td>
            </tr>
            <tr>
                <td>Provinsi Id</td>
                <td><?php echo $moa_row->province_name; ?></td>
            </tr>
            <tr>
                <td>Kota Kabupaten Id</td>
                <td><?php echo $moa_row->kota_kabupaten_nama; ?></td>
            </tr>
            <tr>
                <td>Kecamatan Id</td>
                <td><?php echo $moa_row->kecamatan_nama; ?></td>
            </tr>
            <tr>
                <td>Kelurahan Id</td>
                <td><?php echo $moa_row->kelurahan_nama; ?></td>
            </tr>
            <tr>
                <td>Alamat Moa</td>
                <td><?php echo $moa_row->alamat_moa; ?></td>
            </tr>
            <tr>
                <td>Durasi</td>
                <td><?php echo $moa_row->durasi; ?></td>
            </tr>
            <tr>
                <td>Tanggal Akhir</td>
                <td><?php echo tgl_indo($moa_row->tanggal_akhir_moa); ?></td>
            </tr>
            <tr>
                <td>Dokumen1</td>
                <td><?php
                    if ($moa_row->dokumen1 != "") { ?>
                        <embed src="<?php echo base_url('assets/doc_moa/' . $moa_row->dokumen1) ?>" type="" style="width: 100%;" height="720px">
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td>Dokumen2</td>
                <td><?php
                    if ($moa_row->dokumen2 != "") { ?>
                        <embed src="<?php echo base_url('assets/doc_moa/' . $moa_row->dokumen2) ?>" type="" style="width: 100%;" height="720px">
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td>Dokumen3</td>
                <td><?php
                    if ($moa_row->dokumen3 != "") { ?>
                        <embed src="<?php echo base_url('assets/doc_moa/' . $moa_row->dokumen3) ?>" type="" style="width: 100%;" height="720px">
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td>Nama Dokumen1</td>
                <td><?php echo $moa_row->nama_dokumen1; ?></td>
            </tr>
            <tr>
                <td>Nama Dokumen2</td>
                <td><?php echo $moa_row->nama_dokumen2; ?></td>
            </tr>
            <tr>
                <td>Nama Dokumen3</td>
                <td><?php echo $moa_row->nama_dokumen3; ?></td>
            </tr>
            <tr>
                <td>Kode Prodi</td>
                <td><?php $arr_kode_prodi = explode('#', $moa_row->kode_prodi);
                    foreach ($prodi_result as $key => $value) {
                        echo in_array($value->kode_prodi, $arr_kode_prodi) ? $value->nama_prodi : " ";
                        echo "<br>";
                    }
                    ?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td id="status_moa"></td>
            </tr>
        </table>
    </div>
    <div class="card-footer">
        <input type="hidden" name="id" value="<?= $id ?>">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="far fa-times-circle"></i> Tutup</button>
        <button type="submit" class="btn btn-primary float-right"><i class="far fa-save"></i> Simpan</button>
    </div>
</div>
<embed src="" type="">
<?php echo form_close() ?>



<script>
    $(document).ready(function() {

        load_status();


    });

    function load_status() {
        let date_sekarang = new Date();
        let tanggal_akhir = new Date('<?php echo $moa_row->tanggal_akhir_moa ?>');
        let taggal_6_bulan = addMonths(date_sekarang, 3);
        let result = ``;
        if (tanggal_akhir > date_sekarang && tanggal_akhir <
            new Date(taggal_6_bulan)) {
            result = "<div class='berkedip'>Akan Berakhir</div>";
        } else if (tanggal_akhir < date_sekarang) {
            result = "Berakhir";
        } else {
            result = "Aktif";
        }
        $('#status_moa').html(result);
    }
</script>