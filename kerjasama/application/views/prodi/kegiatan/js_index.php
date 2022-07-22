<script>
    function btn_add_kegiatan(){
        Swal.fire({
            title: 'Processing ...',
            html: 'Please wait...',
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading()
            }
        });
        $.ajax({
            url: '<?php echo base_url('prodi/kegiatan/create') ?>',
            type: "GET",
            dataType: "JSON",
            success: function(respon) {
                Swal.close();
                if (respon.status) {
                    $('#view_modal_form').html(respon.view_modal_form);
                    $('#modal_form').modal('show');
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
    }

    $(document).ready(function() {
        load_data_kegiatan();
    });

    function load_data_kegiatan() {
        $('#dt_kegiatan').DataTable({
            "processing": true,
            "serverSide": true,
            "bDestroy": true,
            "order": [],
            "ajax": {
                //panggil method ajax list dengan ajax
                "url": '<?php echo base_url('prodi/kegiatan/get_kerja_sama_json') ?>',
                "data": {
                    jenis_kerjasama: $("[name='jenis_kerjasama']").val(),
                    tahun_kerja_sama: $("[name='tahun_kerja_sama']").val()
                },
                "type": "POST"
            },
        });
    }
</script>