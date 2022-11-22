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
        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $tanggal ?>" placeholder="Masukan Tanggal ...">
        </div>
        <div class="form-group">
            <label for="nama_lembaga_mitra">Nama Lembaga</label>
            <input type="text" class="form-control" id="nama_lembaga_mitra" name="nama_lembaga_mitra" value="<?php echo $nama_lembaga_mitra ?>" placeholder="Masukan Nama Lembaga ...">
        </div>

        <div class="form-group">
            <label for="negara_id">Negara</label>
            <select class="form-control" id="negara_id" name="negara_id">
                <option value="">--Pilih Negara--</option>
                <?php foreach ($negara_result as $key => $value) { ?>
                    <option value="<?php echo $value->id ?>" <?php echo $value->id == $negara_id ? "selected" : "" ?>>
                        <?php echo $value->nama_negara ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div id="indonesia">
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
                <select class="form-control" name="kota_kabupaten_id" id="kota_kabupaten_id">
                    <option value="">Pilih Kota Kabupaten</option>
                    <?php if (count($kota_kabupaten_result) > 0) {
                        foreach ($kota_kabupaten_result as $key2 => $value2) { ?>
                            <option value="<?php echo $value2->master_kota_kabupaten_id ?>" <?php echo $value2->master_kota_kabupaten_id == $kota_kabupaten_id ? "selected" : "" ?>><?php echo $value2->kota_kabupaten_nama ?></option>
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
            <label for="alamat">Alamat</label>
            <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="5" placeholder="Masukan Alamat ..."><?= $alamat ?></textarea>
        </div>
        <div class="form-group">
            <label for="durasi">Durasi</label>
            <input type="number" class="form-control" id="durasi" name="durasi" value="<?= $durasi ?>" placeholder="Masukan Durasi ...">
        </div>    
        <div class="form-group">
            <label for="durasi">Dokumen</label>
            <input type="file" class="form-control" id="dokumen" name="dokumen" placeholder="Masukan Dokumen ...">
        </div>

    </div>
    <div class="card-footer">
        <input type="hidden" name="id" value="<?= $id ?>">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="far fa-times-circle"></i> Tutup</button>
        <button type="submit" class="btn btn-primary float-right"><i class="far fa-save"></i> Simpan</button>
    </div>
</div>
<?php echo form_close() ?>



<script>
    $(document).ready(function() {

        // pertama kali load hidden provinsi_desa_group
        let load_negara_id = '<?php echo $negara_id ?>';
        if (load_negara_id == "") {
            $('#indonesia').hide();
        }

        // petama kali load hidden indonesia jika negara_id = Indonesia
        if (load_negara_id != "102") {
            $('#indonesia').hide();
        } else {
            $('#indonesia').show();
        }

    });

    $(function() {
        // Setting negara indo
        $("#negara_id").change(function() {
            let negara_id = $('#negara_id').val();
            if (negara_id == "102") {
                $('#indonesia').show();
            } else {
                $('#indonesia').hide();
            }
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

        // simpan from 

        $('form#my_form').on('submit', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            swalLoading();
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
                    Swal.close();
                    if (respon.status) {
                        messegeSuccess(respon.messege);
                        $("#myDatatables").DataTable().ajax.reload(null, false);
                        $('#modal_form').modal('hide');
                    } else {
                        messegeWarning(respon.messege);
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