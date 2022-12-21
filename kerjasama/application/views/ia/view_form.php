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
            <label for="negara_id">Pilih MOA</label>
            <select class="form-control" id="moa_lembaga_mitra_id" name="moa_lembaga_mitra_id">
                <option value="">--Pilih MOA--</option>
                <?php foreach ($moa_result as $key => $value) { ?>
                    <option value="<?php echo $value->moa_lembaga_mitra_id ?>" <?php echo $value->moa_lembaga_mitra_id == $moa_lembaga_mitra_id ? "selected":"" ?>> <?php echo $value->nama_lembaga_mitra . " (" . set_bulan_tahun($value->tanggal_moa) . "~" . set_bulan_tahun($value->tanggal_akhir_moa) . ")" ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <?php
            $array_ketegori = array();
            foreach ($ia_kategori_result as $key => $value) {
                $array_ketegori[] = $value->kategori;
            } ?>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="kategori_ia[]" value="Pendidikan/Pengajaran" <?= in_array("Pendidikan/Pengajaran", $array_ketegori) ? "checked" : "" ?>>
                    <span class="form-check-sign">Pendidikan/Pengajaran</span>
                </label>
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="kategori_ia[]" value="Penelitian" <?= in_array("Penelitian", $array_ketegori) ? "checked" : "" ?>>
                    <span class="form-check-sign">Penelitian</span>
                </label>
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="kategori_ia[]" value="Pengabdian Masyarakat" <?= in_array("Pengabdian Masyarakat", $array_ketegori) ? "checked" : "" ?>>
                    <span class="form-check-sign">Pengabdian Masyarakat</span>
                </label>
            </div>
        </div>

        <div class="form-group">
            <label>Tingkatan</label>
            <select class="form-control" name="tingkat_ia" id="tingkat_ia">
                <option value="">--Pilih Tingkatan--</option>
                <option value="Wilayah" <?php echo $tingkat_ia == 'Wilayah' ? 'selected' : ''; ?>>Wilayah</option>
                <option value="Nasional" <?php echo $tingkat_ia == 'Nasional' ? 'selected' : ''; ?>>Nasional</option>
                <option value="Internasional" <?php echo $tingkat_ia == 'Internasional' ? 'selected' : ''; ?>>Internasional</option>
            </select>
        </div>

        <div class="form-group">
            <label for="judul_kegiatan_ia">Judul Kegiatan</label>
            <input type="text" class="form-control" id="judul_kegiatan_ia" name="judul_kegiatan_ia" value="<?= $judul_kegiatan_ia ?>" placeholder="...">
        </div>

        <div class="form-group">
            <label for="manfaat_kegiatan_ia">Manfaat Kegiatan</label>
            <input type="text" class="form-control" id="manfaat_kegiatan_ia" name="manfaat_kegiatan_ia" value="<?= $manfaat_kegiatan_ia ?>" placeholder="...">
        </div>

        <div class="form-group">
            <label for="tanggal_awal_ia">Awal Kegiatan</label>
            <input type="date" class="form-control" id="tanggal_awal_ia" name="tanggal_awal_ia" value="<?= $tanggal_awal_ia ?>" placeholder="...">
        </div>

        <div class="form-group">
            <label for="tanggal_akhir_ia">Akhir Kegiatan</label>
            <input type="date" class="form-control" id="tanggal_akhir_ia" name="tanggal_akhir_ia" value="<?= $tanggal_akhir_ia ?>" placeholder="...">
        </div>

        <div class="form-group">
            <label>Dosen Yang Terlibat</label>
            <div class="tambah_dosen_wrap">
                <?php
                if (count($ia_dosen_result) > 0) {
                    foreach ($ia_dosen_result as $key => $value) { ?>
                        <?php if ($key == 0) { ?>
                            <div class="pb-1 pt-1">
                                <select class="form-control" name="npk[]">
                                    <option value="">--Pilih Dosen--</option>
                                    <?php foreach ($dosen_result as $key3 => $value3) { ?>
                                        <option value="<?php echo $value3->npk ?>" <?php echo $value3->npk == $value->npk ? "selected" : "" ?>>
                                            <?php echo $value3->nama_dosen ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php } else { ?>
                            <div class="input-group pb-1">
                                <select class="form-control" name="npk[]">
                                    <option value="">--Pilih Dosen--</option>
                                    <?php foreach ($dosen_result as $key2 => $value2) { ?>
                                        <option value="<?php echo $value2->npk ?>" <?php echo $value2->npk == $value->npk ? "selected" : "" ?>>
                                            <?php echo $value2->nama_dosen ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <span><a href="#" class="btn_hapus_mitra"> Hapus</a></span>
                            </div>
                        <?php } ?>
                    <?php  } ?>
                <?php } else { ?>
                    <div class="input-group pb-1 pt-1">
                        <select class="form-control" name="npk[]">
                            <option value="">--Pilih Dosen--</option>
                            <?php foreach ($dosen_result as $key => $value) { ?>
                                <option value="<?php echo $value->npk ?>">
                                    <?php echo $value->nama_dosen ?>
                                </option>
                            <?php } ?>
                        </select>
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-success tambah_dosen">Tambah Dosen</button>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>

        <div class="form-group">
            <label for="nama_dosen_luar_biasa">Dosen Luar Biasa</label>
            <div class="nama_dosen_luar_biasa_wrap">
                <?php if (count($ia_dosen_luar_biasa_result) > 0) { ?>
                    <?php foreach ($ia_dosen_luar_biasa_result as $key => $value) {
                        if ($key == 0) { ?>
                            <div class="input-group">
                                <input type="text" class="form-control" name="nama_dosen_luar_biasa[]" value="<?php echo $value->nama_dosen_luar_biasa ?>" placeholder="Masukan Nama Dosen ...">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-success tambah_nama_dosen_luar_biasa">Tambah Dosen Luar Biasa</button>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="input-group pb-1 pt-1">
                                <input type="text" class="form-control" name="nama_dosen_luar_biasa[]" value="<?php echo $value->nama_dosen_luar_biasa ?>" placeholder="Masukan Nama Dosen ...">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-danger btn_hapus_nama_dosen_luar_biasa">Hapus</button>
                                </div>
                            </div>
                    <?php   }
                    }
                    ?>

                <?php } else { ?>
                    <div class="input-group">
                        <input type="text" class="form-control" name="nama_dosen_luar_biasa[]" placeholder="Masukan Nama Dosen ...">
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-success tambah_nama_dosen_luar_biasa">Tambah Dosen Luar Biasa</button>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>

        <div class="form-group">
            <label for="nama_mahasiswa">Mahasiswa</label>
            <div class="nama_mahasiswa_wrap">
                <?php if (count($ia_mahasiswa_result) > 0) { ?>
                    <?php foreach ($ia_mahasiswa_result as $key => $value) {
                        if ($key == 0) { ?>
                            <div class="input-group">
                                <input type="text" class="form-control" name="nama_mahasiswa[]" value="<?php echo $value->nama_mahasiswa ?>" placeholder="Masukan Nama Mahasiswa ...">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-success tambah_nama_mahasiswa">Tambah Mahasiswa</button>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="input-group pb-1 pt-1">
                                <input type="text" class="form-control" name="nama_mahasiswa[]" value="<?php echo $value->nama_mahasiswa ?>" placeholder="Masukan Nama Mahasiswa ...">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-danger btn_hapus_nama_mahasiswa">Hapus</button>
                                </div>
                            </div>
                    <?php }
                    } ?>
                <?php } else { ?>
                    <div class="input-group">
                        <input type="text" class="form-control" name="nama_mahasiswa[]" placeholder="Masukan Nama Mahasiswa ...">
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-success tambah_nama_mahasiswa">Tambah Mahasiswa</button>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>

        <div class="form-group">
            <label for="dokumen1_moa">Dokumen Pendukung</label>
            <div class="wrap_dokumen_pendukung">
                <?php if (count($ia_dokumen_result) > 0) { ?>
                    <?php foreach ($ia_dokumen_result as $key => $value) { ?>
                        <?php if ($key == 0) { ?>
                            <div class="card shadow-lg">
                                <div class="card-body p-1">
                                    <select class="form-control form-control mb-2 " name="jenis_dokumen[]">
                                        <option value="">--Pilih Jenis Dokumen--</option>
                                        <option value="Absensi" <?php echo $value->jenis_dokumen == 'Absensi' ? "selected" : "" ?>>Absensi</option>
                                        <option value="Materi" <?php echo $value->jenis_dokumen == 'Materi' ? "selected" : "" ?>>Materi</option>
                                        <option value="Foto" <?php echo $value->jenis_dokumen == 'Foto' ? "selected" : "" ?>>Foto</option>
                                        <option value="Jurnal" <?php echo $value->jenis_dokumen == 'Jurnal' ? "selected" : "" ?>>Jurnal</option>
                                        <option value="Surat" <?php echo $value->jenis_dokumen == 'Surat' ? "selected" : "" ?>>Surat</option>
                                        <option value="Lainnya" <?php echo $value->jenis_dokumen == 'Lainnya' ? "selected" : "" ?>>Lainnya</option>
                                    </select>
                                    <input type="file" class="form-control mb-2" name="files[]">
                                    <a href="<?php echo base_url('assets/doc_moa/' . $value->file_dokumen)  ?>" target="_blank" rel="noopener noreferrer">Link Dokumen</a>
                                    <input type="text" class="form-control mb-2 nama_file" name="nama_file[]" value="<?php echo $value->nama_file ?>" placeholder="Nomor Surat">
                                </div>
                            </div>
                        <?php  } else { ?>
                            <div class="card shadow-lg">
                                <div class="card-body p-1">
                                    <button class="btn btn-default btn-sm float-right mb-1 hapus_dokumen_pendukung">Hapus</button>
                                    <select class="form-control form-control mb-2 " name="jenis_dokumen[]">
                                        <option value="">--Pilih Jenis Dokumen--</option>
                                        <option value="Absensi" <?php echo $value->jenis_dokumen == 'Absensi' ? "selected" : "" ?>>Absensi</option>
                                        <option value="Materi" <?php echo $value->jenis_dokumen == 'Materi' ? "selected" : "" ?>>Materi</option>
                                        <option value="Foto" <?php echo $value->jenis_dokumen == 'Foto' ? "selected" : "" ?>>Foto</option>
                                        <option value="Jurnal" <?php echo $value->jenis_dokumen == 'Jurnal' ? "selected" : "" ?>>Jurnal</option>
                                        <option value="Surat" <?php echo $value->jenis_dokumen == 'Surat' ? "selected" : "" ?>>Surat</option>
                                        <option value="Lainnya" <?php echo $value->jenis_dokumen == 'Lainnya' ? "selected" : "" ?>>Lainnya</option>
                                    </select>
                                    <input type="file" class="form-control mb-2" name="files[]">
                                    <a href="<?php echo base_url('assets/doc_moa/' . $value->file_dokumen)  ?>" target="_blank" rel="noopener noreferrer">Link Dokumen</a>
                                    <input type="text" class="form-control mb-2 nama_file" name="nama_file[]" value="<?php echo $value->nama_file ?>" placeholder="Nomor Surat">
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                <?php } else { ?>
                    <div class="card shadow-lg">
                        <div class="card-body p-1">
                            <select class="form-control form-control mb-2 " name="jenis_dokumen[]">
                                <option value="">--Pilih Jenis Dokumen--</option>
                                <option value="Absensi">Absensi</option>
                                <option value="Materi">Materi</option>
                                <option value="Foto">Foto</option>
                                <option value="Jurnal">Jurnal</option>
                                <option value="Surat">Surat</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            <input type="file" class="form-control mb-2" name="files[]">
                            <input type="text" class="form-control mb-2 nama_file" name="nama_file[]" placeholder="Nomor Surat">
                        </div>
                    </div>
                <?php } ?>
            </div>

            <button type="button" id="tambah_dokumen_pendukung" class="btn btn-success float-right">Tambah Dokumen</button>
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
    $(function() {

        $(".tambah_dosen").click(function(e) {
            let select = `<div class="input-group pb-1 pt-1">
                            <select class="form-control" name="npk[]">
                                <option value="">--Pilih Dosen--</option>
                                <?php foreach ($dosen_result as $key => $value) { ?>
                                    <option value="<?php echo $value->npk ?>">
                                        <?php echo $value->nama_dosen ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-danger btn_hapus_mitra">Hapus</button>
                            </div>
                        </div>`;
            e.preventDefault();
            $(".tambah_dosen_wrap").append(select);
        });

        $(".tambah_dosen_wrap").on("click", ".btn_hapus_mitra", function(e) {
            // console.log($(this));
            e.preventDefault();
            // console.log("Paren ", $(this).parent().parent());
            $(this).parent().parent().remove();
            xx--;

        });


        $(".tambah_nama_dosen_luar_biasa").click(function(e) {
            let input = `<div class="input-group pb-1 pt-1">
                            <input type="text" class="form-control" name="nama_dosen_luar_biasa[]" placeholder="Masukan Nama Dosen ...">
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-danger btn_hapus_nama_dosen_luar_biasa">Hapus</button>
                            </div>
                        </div>`;
            e.preventDefault();
            $(".nama_dosen_luar_biasa_wrap").append(input);
        });

        $(".nama_dosen_luar_biasa_wrap").on("click", ".btn_hapus_nama_dosen_luar_biasa", function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
            xx--;

        });

        $(".tambah_nama_mahasiswa").click(function(e) {
            let input = `<div class="input-group pb-1 pt-1">
                            <input type="text" class="form-control" name="nama_mahasiswa[]" placeholder="Masukan Nama Mahasiswa ...">
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-danger btn_hapus_nama_mahasiswa">Hapus</button>
                            </div>
                        </div>`;
            e.preventDefault();
            $(".nama_mahasiswa_wrap").append(input);
        });

        $(".nama_mahasiswa_wrap").on("click", ".btn_hapus_nama_mahasiswa", function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
            xx--;

        });

        $("#tambah_dokumen_pendukung").click(function(e) {
            e.preventDefault();
            $(".wrap_dokumen_pendukung").append(`<div class="card shadow-lg">                                                    
                                                    <div class="card-body p-1"> 
                                                        <button type="button" class="btn btn-danger btn-sm float-right mb-1 hapus_dokumen_pendukung">Hapus</button>                                                        
                                                        <select class="form-control form-control mb-2 " name="jenis_dokumen[]">
                                                            <option value="">--Pilih Jenis Dokumen--</option>
                                                            <option value="Absensi">Absensi</option>
                                                            <option value="Materi">Materi</option>
                                                            <option value="Foto">Foto</option>
                                                            <option value="Jurnal">Jurnal</option>
                                                            <option value="Surat">Surat</option>
                                                            <option value="Lainnya">Lainnya</option>
                                                        </select>
                                                        <input type="file" class="form-control mb-2" name="files[]">
                                                        <input type="text" class="form-control mb-2 nama_file" name="nama_file[]" placeholder="Nomor Surat">
                                                    </div>
                                            </div>`);
        });

        $(".wrap_dokumen_pendukung").on("click", ".hapus_dokumen_pendukung", function(e) {
            e.preventDefault();
            $(this).parent().parent('div').remove();
        })

        $('form#my_form').on('submit', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            // swalLoading();
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