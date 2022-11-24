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
            <label for="mou_id">Pilih MOU</label>
            <select class="form-control" id="mou_id" name="mou_id">
                <option value="">--Pilih MOU--</option>
                <?php foreach ($mou_result as $key => $value) { ?>
                    <option value="<?php echo $value->id ?>" <?php echo $value->id == $mou_id ? "selected" : "" ?>>
                        <?php echo $value->nama_lembaga_mitra ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label>Kategori</label>
            <select class="form-control" name="kategori_moa" id="kategori_moa">
                <option value="">--Pilih kategori--</option>
                <option value="Pendidikan/Pengajaran" <?php echo $kategori_moa == 'Pendidikan/Pengajaran' ? 'selected' : ''; ?>>Pendidikan/Pengajaran</option>
                <option value="Penelitian" <?php echo $kategori_moa == 'Penelitian' ? 'selected' : ''; ?>>Penelitian</option>
                <option value="Pengabdian Masyarakat" <?php echo $kategori_moa == 'Pengabdian Masyarakat' ? 'selected' : ''; ?>>Pengabdian Masyarakat</option>
            </select>
        </div>
        <div class="form-group">
            <label>Tingkatan</label>
            <select class="form-control" name="tingkat_moa" id="tingkat_moa">
                <option value="">--Pilih Tingkatan--</option>
                <option value="Wilayah" <?php echo $tingkat_moa == 'Wilayah' ? 'selected' : ''; ?>>Wilayah</option>
                <option value="Nasional" <?php echo $tingkat_moa == 'Nasional' ? 'selected' : ''; ?>>Nasional</option>
                <option value="Internasional" <?php echo $tingkat_moa == 'Internasional' ? 'selected' : ''; ?>>Internasional</option>
            </select>
        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $tanggal ?>" placeholder="Masukan Tanggal ...">
        </div>
        <div class="form-group">
            <label for="nama_lembaga_mitra_moa">Nama Lembaga Mitra</label>
            <div class="tambah_mitra_wrap">
                <button class="btn btn-success tambah_mitra">Tambah</button>
                <div class="pb-1 pt-1"><input type="text" name="nama_lembaga_mitra_moa[]" class="form-control"  placeholder="Nama Lembaga Mitra ..."></div>
            </div>           
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
            <label for="alamat_moa">Alamat</label>
            <textarea class="form-control" name="alamat_moa" id="alamat_moa" cols="30" rows="5" placeholder="Masukan Alamat ..."><?= $alamat_moa ?></textarea>
        </div>
        <div class="form-group">
            <label for="durasi">Durasi</label>
            <input type="number" class="form-control" id="durasi" name="durasi" value="<?= $durasi ?>" placeholder="Masukan Durasi ...">
        </div>
        <div class="form-group">
            <label for="dokumen1">Dokumen 1</label>
            <input type="file" class="form-control" id="dokumen1" name="dokumen1">
        </div>
        <div class="form-group">
            <label for="dokumen2">Dokumen 2</label>
            <input type="file" class="form-control" id="dokumen2" name="dokumen2">
        </div>
        <div class="form-group">
            <label for="dokumen3">Dokumen 3</label>
            <input type="file" class="form-control" id="dokumen3" name="dokumen3">
        </div>
        <div class="form-group">
            <label for="kode_prodi">Pilih Prodi</label>
            <div class="form-check">
                <?php foreach ($prodi_result as $key => $value) { ?>
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="kode_prodi[]" value="<?php echo $value->kode_prodi ?>">
                        <span class="form-check-sign"><?php echo $value->nama_prodi ?></span>
                    </label>
                <?php } ?>
            </div>
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

        $(".tambah_mitra").click(function(e) {
            e.preventDefault();
            $(".tambah_mitra_wrap").append('<div class="input-group pb-1"><input type="text" name="nama_lembaga_mitra_moa[]" class="form-control" placeholder="Nama Lembaga Mitra"><span><a href="#" class="btn_hapus_mitra"> Hapus</a></span></div>');
        });

        $(".tambah_mitra_wrap").on("click", ".btn_hapus_mitra", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })

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
                url: '<?php echo base_url('wilayah_indonesia/get_kota_kabupaten') ?>',
                data: {
                    master_provinsi_id: provinsi_id
                },
                type: "GET",
                dataType: "JSON",
                success: function(respon) {
                    Swal.close();
                    if (respon.status) {
                        $('#kota_kabupaten_id').html(respon.kota_kabupaten_html);
                        if (provinsi_id == "") {
                            $('#kota_kabupaten_id').html('<option value="">Pilih Kota Kabupaten</option>');
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
        $("#kota_kabupaten_id").change(function() {
            let kabupaten_kota_id = $('#kota_kabupaten_id').val();
            $.ajax({
                url: '<?php echo base_url('wilayah_indonesia/get_kecamatan') ?>',
                data: {
                    master_kota_kabupaten_id: kabupaten_kota_id
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
                url: '<?php echo base_url('wilayah_indonesia/get_kelurahan') ?>',
                data: {
                    master_kecamatan_id: kecamatan_id
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