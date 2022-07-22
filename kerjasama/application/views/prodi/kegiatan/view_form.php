<?php
$attribute = array('role' => 'form', 'id' => 'form_kegiatan');
echo form_open_multipart($action, $attribute);
?>
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $title ?></h4>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>Jenis Kegiatan</label>
            <select class="form-control" name="jenis_kegiatan" id="jenis_kegiatan">
                <option value="">--Pilih Kegiatan--</option>
                <option value="Pendidikan/Pengajaran" <?php echo $jenis_kegiatan == "Pendidikan/Pengajaran" ? "selected" : "" ?>>Pendidikan/Pengajaran</option>
                <option value="Penelitian">Penelitian</option>
                <option value="Pengabdian Masyarakat">Pengabdian Masyarakat</option>
            </select>
        </div>
        <div class="form-group">
            <label for="date">Awal Pelaksanaan</label>
            <input type="Date" class="form-control" name="awal_kegiatan" id="awal_kegiatan" placeholder="Awal Pelaksanaan ..." value="<?php echo $awal_kegiatan; ?>" />
        </div>
        <div class="form-group">
            <label>Akhir Pelaksanaan</label>
            <input type="date" class="form-control" name="akhir_kegiatan" id="akhir_kegiatan" placeholder="Akhir Pelaksanaan ..." value="<?php echo $akhir_kegiatan; ?>" />
        </div>
        <div class="form-group">
            <label>Judul Kegiatan</label>
            <input type="text" class="form-control" name="judul_kegiatan" id="judul_kegiatan" placeholder="Judul Kegiatan ..." value="<?php echo $judul_kegiatan; ?>" />
        </div>
        <div class="form-group">
            <label>Manfaat Kegiatan</label>
            <textarea class="form-control" rows="3" name="manfaat_kegiatan" id="manfaat_kegiatan" placeholder="Manfaat Kegiatan ..."><?php echo $manfaat_kegiatan; ?></textarea>
        </div>
        <div class="form-group">
            <label>Dokumen Udangan</label>
            <input type="file" class="form-control" name="doc_undangan">
        </div>
        <div class="form-group">
            <label>Dokumen Absensi</label>
            <input type="file" class="form-control" name="doc_absensi">
        </div>
        <div class="form-group">
            <label>Dokumen Materi</label>
            <input type="file" class="form-control" name="doc_materi">
        </div>
        <div class="form-group">
            <label>Dokumen Foto</label>
            <input type="file" class="form-control" name="doc_foto">
        </div>
        <div id="doc_tambahan">
            <hr>
            <div class="form-group">
                <label id="doc_1">P1</label>
                <input type="file" class="form-control" name="doc_1">
            </div>
            <div class="form-group">
                <label id="doc_2">P2</label>
                <input type="file" class="form-control" name="doc_2">
            </div>
            <div class="form-group">
                <label id="doc_3">P3</label>
                <input type="file" class="form-control" name="doc_3">
            </div>
            <div class="form-group">
                <label id="doc_4">P4</label>
                <input type="file" class="form-control" name="doc_4">
            </div>
            <div class="form-group">
                <label id="doc_5">P5</label>
                <input type="file" class="form-control" name="doc_5">
            </div>
            <div class="form-group">
                <label id="doc_6">P6</label>
                <input type="file" class="form-control" name="doc_6">
            </div>
        </div>


    </div>
    <div class="modal-footer">
        <input type="hidden" name="id_kegiatan" value="<?php echo $id_kegiatan ?>">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-fw fa-close"></i> Tutup</button>
        <button type="submit" id="submit" class="btn btn-success"><i class="fa fa-fw fa-send-o"></i> Simpan</button>
    </div>
</div>
<?php echo form_close() ?>

<script>
    $(document).ready(function() {
        $('#doc_tambahan').hide();

        // Simpan Form
        $('form#form_kegiatan').on('submit', function(e) {
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
                            $("#dt_kegiatan").DataTable().ajax.reload(null, false);
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
    $("#jenis_kegiatan").change(function() {
        let jenis_kegiatan = $('#jenis_kegiatan').val();
        $('#doc_tambahan').show();
        if (jenis_kegiatan == "Pendidikan/Pengajaran") {
            $('#doc_1').text("P 1");
            $('#doc_2').text("P 2");
            $('#doc_3').text("P 3");
            $('#doc_4').text("P 4");
            $('#doc_5').text("P 5");
            $('#doc_6').text("P 6");
        } else if (jenis_kegiatan == "Penelitian") {
            $('#doc_1').text("PN 1");
            $('#doc_2').text("PN 2");
            $('#doc_3').text("PN 3");
            $('#doc_4').text("PN 4");
            $('#doc_5').text("PN 5");
            $('#doc_6').text("PN 6");
        } else {
            $('#doc_1').text("PM 1");
            $('#doc_2').text("PM 2");
            $('#doc_3').text("PM 3");
            $('#doc_4').text("PM 4");
            $('#doc_5').text("PM 5");
            $('#doc_6').text("PM 6");
        }
    });
</script>