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
            <select class="form-control" id="moa_id" name="moa_id">
                <option value="">--Pilih MOA--</option>
                <?php foreach ($moa_result as $key => $value) { ?>
                    <option value="<?php echo $value->id ?>" <?php echo $value->id == $moa_id ? "selected" : "" ?>>
                        <?php $nama_lembaga_array = explode("#", $value->nama_lembaga_mitra_moa); ?>
                        <?php echo  $nama_lembaga_array[0] . ", dll (" . set_bulan_tahun($value->tanggal) . " - " . set_bulan_tahun($value->tanggal_akhir) . ")" ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label>Kategori</label>
            <select class="form-control" name="kategori_ia" id="kategori_ia">
                <option value="">--Pilih kategori--</option>
                <option value="Pendidikan/Pengajaran" <?php echo $kategori_ia == 'Pendidikan/Pengajaran' ? 'selected' : ''; ?>>Pendidikan/Pengajaran</option>
                <option value="Penelitian" <?php echo $kategori_ia == 'Penelitian' ? 'selected' : ''; ?>>Penelitian</option>
                <option value="Pengabdian Masyarakat" <?php echo $kategori_ia == 'Pengabdian Masyarakat' ? 'selected' : ''; ?>>Pengabdian Masyarakat</option>
            </select>
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
            <label for="judul_kegiatan">Judul Kegiatan</label>
            <input type="text" class="form-control" id="judul_kegiatan" name="judul_kegiatan" value="<?= $judul_kegiatan ?>" placeholder="...">
        </div>
        <div class="form-group">
            <label for="manfaat_kegiatan">Manfaat Kegiatan</label>
            <input type="text" class="form-control" id="manfaat_kegiatan" name="manfaat_kegiatan" value="<?= $manfaat_kegiatan ?>" placeholder="...">
        </div>
        <div class="form-group">
            <label for="tanggal_awal">Awal Kegiatan</label>
            <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" value="<?= $tanggal_awal ?>" placeholder="...">
        </div>
        <div class="form-group">
            <label for="tanggal_akhir">Akhir Kegiatan</label>
            <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" value="<?= $tanggal_akhir ?>" placeholder="...">
        </div>
        <div class="form-group">
            <label for="dosen_terlibat[]">Dosen Yang Terlibat</label>
            <div class="tambah_dosen_wrap">
                <button class="btn btn-success tambah_dosen">Tambah</button>
                <div class="pb-1 pt-1">
                    <select class="form-control" name="dosen_terlibat[]">
                        <option value="">--Pilih Dosen--</option>
                        <?php foreach ($dosen_result as $key => $value) { ?>
                            <option value="<?php echo $value->npk ?>">
                                <?php echo $value->nama_dosen ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
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
            let select = `<div class="input-group pb-1">
                            <select class="form-control" name="dosen_terlibat[]">
                                <option value="">--Pilih Dosen--</option>
                                <?php foreach ($dosen_result as $key => $value) { ?>
                                    <option value="<?php echo $value->npk ?>">
                                        <?php echo $value->nama_dosen ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <span><a href="#" class="btn_hapus_mitra"> Hapus</a></span>
                        </div>`;
            e.preventDefault();
            $(".tambah_dosen_wrap").append(select);
        });

        $(".tambah_dosen_wrap").on("click", ".btn_hapus_mitra", function(e) {
            console.log($(this));
            e.preventDefault();
            console.log("Paren ", $(this).parent().parent());
            $(this).parent().parent().remove();
            xx--;

        });

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