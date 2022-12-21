<script>
    function btn_lihat_dokumen() {
        $('.modal-dialog').addClass('modal-xl');
        let dokumen = `<embed src="<?php echo base_url('assets/doc_mou/' . $dokumen) ?>" type="" style="width: 100%;" height="720px">`;
        $('#preview_dokumen').html(dokumen);
        $('#modal_dok').modal('show');
    }

    function btn_detail_ia(ia_id,kode_prodi) {
        $.ajax({
            url: '<?php echo base_url('mou/detail_list') ?>',
            data: {
                ia_id: ia_id,
                kode_prodi: kode_prodi
            },
            type: "GET",
            dataType: "JSON",
            success: function(respon) {
                Swal.close();
                if (respon.status) {
                    $('.modal-dialog').addClass('modal-xl');
                    $('#view_modal_form').html(respon.view_modal_form);
                    $('#modal_form').modal('show');
                } else {
                    messegeWarning(respon.messege);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                Swal.close();
                alert("Code Status : " + xhr.status + "\nMessege Error :" + thrownError);
            }
        });
    }


    function btn_perpanjang_moa(id) {
        $.ajax({
            url: '<?php echo base_url('moa/perpanjang') ?>',
            data: {
                id: id
            },
            type: "GET",
            dataType: "JSON",
            success: function(respon) {
                Swal.close();
                if (respon.status) {
                    $('.modal-dialog').addClass('modal-xl');
                    $('#view_modal_form').html(respon.view_modal_form);
                    $('#modal_form').modal('show');
                } else {
                    messegeWarning(respon.messege);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                Swal.close();
                alert("Code Status : " + xhr.status + "\nMessege Error :" + thrownError);
            }
        });
    }
</script>