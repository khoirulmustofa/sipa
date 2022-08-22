<?php
$attribute = array('role' => 'form', 'id' => 'form_kerja_sama');
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
        <div class="form-group">
            <label for="varchar">Jenis Kerjasama </label>
            <select class="form-control" name="jenis_kerjasama" id="jenis_kerjasama">
                <option value="">Pilih Jenis Kerjasama</option>
                <option value="MOU" <?php echo $jenis_kerjasama == "MOU" ? "selected" : "" ?>>MOU</option>
                <option value="MOA" <?php echo $jenis_kerjasama == "MOA" ? "selected" : "" ?>>MOA</option>
            </select>
        </div>
        <div class="form-group" id="ketegori_moa_group">
            <label for="varchar">Kategori </label>
            <select class="form-control" name="ketegori_moa" id="ketegori_moa">
                <option value="">Pilih Jenis Kerjasama</option>
                <option value="Pendidikan/Pengajaran" <?php echo $ketegori_moa == "Pendidikan/Pengajaran" ? "selected" : "" ?>>Pendidikan/Pengajaran</option>
                <option value="Penelitian" <?php echo $ketegori_moa == "Penelitian" ? "selected" : "" ?>>Penelitian</option>
                <option value="Pengabdian Masyarakat" <?php echo $ketegori_moa == "Pengabdian Masyarakat" ? "selected" : "" ?>>Pengabdian Masyarakat</option>
            </select>
        </div>
        <div class="form-group">
            <label for="date">Tanggal Kerjasama </label>
            <input type="Date" class="form-control" name="tgl_kerjasama" id="tgl_kerjasama" placeholder="Tgl Kerjasama" value="<?php echo $tgl_kerjasama; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Lembaga Mitra </label>
            <input type="text" class="form-control" name="lembaga_mitra" id="lembaga_mitra" placeholder="Lembaga Mitra" value="<?php echo $lembaga_mitra; ?>" />
        </div>

        <div class="form-group">
            <label for="varchar">Negara </label>
            <select class="form-control" name="negara_id" id="negara_id">
                <option value="">Pilih Negara</option>
                <?php foreach ($negara_result as $key => $value) { ?>
                    <option value="<?php echo $value->id ?>" <?php echo $value->id == $negara_id ? "selected" : "" ?>><?php echo $value->nama_negara ?></option>
                <?php } ?>
            </select>
        </div>

        <div id="provinsi_desa_group">
            <div class="form-group">
                <label for="varchar">Provinsi</label>
                <select class="form-control" name="provinsi_id" id="provinsi_id">
                    <option value="">Pilih provinsi</option>
                    <?php foreach ($provinsi_result as $key1 => $value1) { ?>
                        <option value="<?php echo $value1->master_provinsi_id ?>" <?php echo $value1->master_provinsi_id == $provinsi_id ? "selected" : "" ?>><?php echo $value1->province_name ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="varchar">Kota Kabupaten</label>
                <select class="form-control" name="kabupaten_kota_id" id="kabupaten_kota_id">
                    <option value="">Pilih Kota Kabupaten</option>
                    <?php if (count($kota_kabupaten_result) > 0) {
                        foreach ($kota_kabupaten_result as $key2 => $value2) { ?>
                            <option value="<?php echo $value2->master_kota_kabupaten_id ?>" <?php echo $value2->master_kota_kabupaten_id == $kabupaten_kota_id ? "selected" : "" ?>><?php echo $value2->kota_kabupaten_nama ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="varchar">Kota Kecamatan</label>
                <select class="form-control" name="kecamatan_id" id="kecamatan_id">
                    <option value="">Pilih Kecamatan</option>
                    <?php foreach ($kecamatan_result as $key2 => $value3) { ?>
                        <option value="<?php echo $value3->master_kecamatan_id ?>" <?php echo $value3->master_kecamatan_id == $kecamatan_id ? "selected" : "" ?>><?php echo $value3->kecamatan_nama ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="varchar">Kelurhan / Desa</label>
                <select class="form-control" name="kelurahan_id" id="kelurahan_id">
                    <option value="">Pilih Kelurhan / Desa</option>
                    <?php foreach ($kelurahan_result as $key4 => $value4) { ?>
                        <option value="<?php echo $value4->master_kelurahan_id ?>" <?php echo $value4->master_kelurahan_id == $kelurahan_id ? "selected" : "" ?>><?php echo $value4->kelurahan_nama ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="alamat_mitra">Alamat Mitra </label>
            <textarea class="form-control" rows="3" name="alamat_mitra" id="alamat_mitra" placeholder="Alamat Mitra"><?php echo $alamat_mitra; ?></textarea>
        </div>
        <div class="form-group">
            <label for="int">Durasi Kerjasama (Dalam Tahun)</label>
            <input type="number" class="form-control" name="durasi_kerjasama" id="durasi_kerjasama" placeholder="Durasi Kerjasama (Dalam Tahun) contoh : 2" value="<?php echo $durasi_kerjasama; ?>" />
        </div>

        <div class="form-group">
            <label for="varchar">Dokumen Kerjasama</label>
            <input type="file" class="form-control" name="dokumen_kerjasama" accept="image/jpeg,image/png,application/pdf">
        </div>
        <div class="form-group" id="dok_pendukung_group">
            <label for="varchar">Dokumen Pendukukung</label>
            <input type="file" class="form-control" name="dokumen_pendukung_1" accept="image/jpeg,image/png,application/pdf">
            <input type="file" class="form-control" name="dokumen_pendukung_2" accept="image/jpeg,image/png,application/pdf">
            <input type="file" class="form-control" name="dokumen_pendukung_3" accept="image/jpeg,image/png,application/pdf">
            <input type="file" class="form-control" name="dokumen_pendukung_4" accept="image/jpeg,image/png,application/pdf">
        </div>
    </div>
    <div class="card-footer">
        <input type="hidden" name="id_kerjasama" value="<?php echo $id_kerjasama?>">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="far fa-times-circle"></i> Tutup</button>
        <button type="submit" class="btn btn-primary float-right"><i class="far fa-save"></i> Simpan</button>
    </div>
</div>
<?php echo form_close() ?>

<script>
    $(document).ready(function() {
        // pertama kali load hidden ketegori_moa_group
        let jenis_kerjasama = '<?php echo $jenis_kerjasama ?>';
        if (jenis_kerjasama == "MOA") {
            $('#ketegori_moa_group').show();
            $('#dok_pendukung_group').show();
        } else {
            $('#ketegori_moa_group').hide();
            $('#dok_pendukung_group').hide();
        }

        // pertama kali load hidden provinsi_desa_group
        let load_negara_id = '<?php echo $negara_id ?>';
        if (load_negara_id == "") {
            $('#provinsi_desa_group').hide();
        }

        // petama kali load hidden provinsi_desa_group jika negara_id = Indonesia
        if (load_negara_id != "102") {
            $('#provinsi_desa_group').hide();
        } else {
            $('#provinsi_desa_group').show();
        }

    })
    $(function() {

        $("#jenis_kerjasama").change(function() {
            let jenis_kerjasama = $('#jenis_kerjasama').val();
            if (jenis_kerjasama == "MOA") {
                $('#ketegori_moa_group').show();
                $('#dok_pendukung_group').show();
            } else {
                $('#ketegori_moa_group').hide();
                $('#dok_pendukung_group').hide();
            }
        });

        // Setting negara indo
        $("#negara_id").change(function() {
            let negara_id = $('#negara_id').val();
            if (negara_id == "102") {
                $('#provinsi_desa_group').show();
            } else {
                $('#provinsi_desa_group').hide();
            }
            $.ajax({
                url: '<?php echo base_url('tu/kerja_sama/get_kota_kabupaten') ?>',
                data: {
                    provinsi_id: provinsi_id
                },
                type: "GET",
                dataType: "JSON",
                success: function(respon) {
                    Swal.close();
                    if (respon.status) {
                        $('#kabupaten_kota_id').html(respon.kota_kabupaten_html);
                        if (provinsi_id == "") {
                            $('#kabupaten_kota_id').html('<option value="">Pilih Kota Kabupaten</option>');
                        }
                    } else {
                        Swal.fire({
                            title: "Ooops..",
                            icon: 'warning',
                            html: respon.messege,
                            allowEscapeKey: false,
                            allowOutsideClick: false,
                        });
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    Swal.close();
                    alert("Code Status : " + xhr.status + "\nMessege Error :" + thrownError);
                }
            });
        });

        // Load Kabupaten
        $("#provinsi_id").change(function() {
            let provinsi_id = $('#provinsi_id').val();
            $.ajax({
                url: '<?php echo base_url('tu/kerja_sama/get_kota_kabupaten') ?>',
                data: {
                    provinsi_id: provinsi_id
                },
                type: "GET",
                dataType: "JSON",
                success: function(respon) {
                    Swal.close();
                    if (respon.status) {
                        $('#kabupaten_kota_id').html(respon.kota_kabupaten_html);
                        if (provinsi_id == "") {
                            $('#kabupaten_kota_id').html('<option value="">Pilih Kota Kabupaten</option>');
                        }
                    } else {
                        Swal.fire({
                            title: "Ooops..",
                            icon: 'warning',
                            html: respon.messege,
                            allowEscapeKey: false,
                            allowOutsideClick: false,
                        });
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    Swal.close();
                    alert("Code Status : " + xhr.status + "\nMessege Error :" + thrownError);
                }
            });
        });

        // Load Kecamatan
        $("#kabupaten_kota_id").change(function() {
            let kabupaten_kota_id = $('#kabupaten_kota_id').val();
            $.ajax({
                url: '<?php echo base_url('tu/kerja_sama/get_kecamatan') ?>',
                data: {
                    kabupaten_kota_id: kabupaten_kota_id
                },
                type: "GET",
                dataType: "JSON",
                success: function(respon) {
                    Swal.close();
                    if (respon.status) {
                        $('#kecamatan_id').html(respon.kecamatan_html);
                        if (kabupaten_kota_id == "") {
                            $('#kecamatan_id').html('<option value="">Pilih Kecamatan</option>');
                        }
                    } else {
                        Swal.fire({
                            title: "Ooops..",
                            icon: 'warning',
                            html: respon.messege,
                            allowEscapeKey: false,
                            allowOutsideClick: false,
                        });
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    Swal.close();
                    alert("Code Status : " + xhr.status + "\nMessege Error :" + thrownError);
                }
            });
        });


        // Load Kelurahan
        $("#kecamatan_id").change(function() {
            let kecamatan_id = $('#kecamatan_id').val();
            $.ajax({
                url: '<?php echo base_url('tu/kerja_sama/get_kelurahan') ?>',
                data: {
                    kecamatan_id: kecamatan_id
                },
                type: "GET",
                dataType: "JSON",
                success: function(respon) {
                    Swal.close();
                    if (respon.status) {
                        $('#kelurahan_id').html(respon.kelurahan_html);
                        if (kabupaten_kota_id == "") {
                            $('#kecamatan_id').html('<option value="">Pilih Kelurhan / Desa</option>');
                        }
                    } else {
                        Swal.fire({
                            title: "Ooops..",
                            icon: 'warning',
                            html: respon.messege,
                            allowEscapeKey: false,
                            allowOutsideClick: false,
                        });
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    Swal.close();
                    alert("Code Status : " + xhr.status + "\nMessege Error :" + thrownError);
                }
            });
        });

        // Simpan Form
        $('form#form_kerja_sama').on('submit', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $('#submit').prop('disabled', true);
            $.ajax({
                url: $(this).attr('action'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                type: 'POST',
                dataType: "JSON",
                success: function(respon) {
                    $('#submit').prop('disabled', false);
                    if (respon.status) {
                        Swal.fire({
                            title: "Success",
                            icon: "success",
                            html: respon.messege,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,
                            timer: 1000,
                        }).then((result) => {
                            $("#dt_kerja_sama").DataTable().ajax.reload(null, false);
                            $('#modal_form').modal('hide');
                        });
                    } else {
                        Swal.fire({
                            title: "Ooops..",
                            icon: "warning",
                            html: respon.messege,
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        })
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    Swal.close();
                    alert("Code Status : " + xhr.status + "\nMessege Error :" + thrownError);
                }
            });
        });
    });
</script>