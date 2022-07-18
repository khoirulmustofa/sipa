<!-- Datatables -->
<script src="<?php echo base_url('templates/gentelella') ?>/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('templates/gentelella') ?>/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url('templates/gentelella') ?>/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url('templates/gentelella') ?>/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?php echo base_url('templates/gentelella') ?>/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url('templates/gentelella') ?>/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url('templates/gentelella') ?>/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url('templates/gentelella') ?>/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?php echo base_url('templates/gentelella') ?>/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?php echo base_url('templates/gentelella') ?>/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url('templates/gentelella') ?>/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="<?php echo base_url('templates/gentelella') ?>/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="<?php echo base_url('templates/gentelella') ?>/vendors/jszip/dist/jszip.min.js"></script>
<script src="<?php echo base_url('templates/gentelella') ?>/vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="<?php echo base_url('templates/gentelella') ?>/vendors/pdfmake/build/vfs_fonts.js"></script>

<script type="text/javascript">
    setInterval(function() {
        $(".berkedip").toggle();
    }, 300);

    $(document).ready(function() {
        load_data_kerja_sama();
    });

    function load_data_kerja_sama() {
        $('#dt_kerja_sama').DataTable({
            "processing": true,
            "serverSide": true,
            "bDestroy": true,
            "order": [],
            "ajax": {
                //panggil method ajax list dengan ajax
                "url": '<?php echo base_url('Kerja_sama/get_kerja_sama_json') ?>',
                "data": {
                    jenis_kerjasama: $("[name='jenis_kerjasama']").val(),
                    tahun_kerja_sama: $("[name='tahun_kerja_sama']").val()
                },
                "type": "POST"
            },
        });
    }

    function getFormattedDate(date) {
        var dt = new Date(date);
        var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        var mmddyyyy = dt.getDate() + ' ' + months[dt.getMonth()] + ' ' + dt.getFullYear();
        return mmddyyyy;
    }

    function btn_detail(id) {
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
            url: '<?php echo base_url('kerja_sama/detail_kerja_sama') ?>',
            data: {
                id_kerjasama: id
            },
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

    function btn_tambah_kerja_sama() {
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
            url: '<?php echo base_url('kerja_sama/buat_kerja_sama') ?>',
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

    function btn_edit(id) {
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
            url: '<?php echo base_url('kerja_sama/edit_kerja_sama') ?>',
            data: {
                id_kerjasama: id
            },
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

    function btn_delete(id) {
        Swal.fire({
            title: 'Question?',
            text: "Apakah anda ingin menghapus data ini?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#00a65a',
            cancelButtonColor: '#dd4b39',
            confirmButtonText: 'Ya, Yakin!',
            allowOutsideClick: false,
            allowEscapeKey: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url('kerja_sama/hapus_action') ?>',
                    data: {
                        id_kerjasama: id
                    },
                    type: "GET",
                    dataType: "JSON",
                    success: function(respon) {
                        if (respon.status) {
                            Swal.fire({
                                title: "Berhasil",
                                icon: 'success',
                                html: respon.messege,
                                allowEscapeKey: false,
                                allowOutsideClick: false,
                                showConfirmButton: false,
                                timer: 1000,
                            }).then((result) => {
                                $("#dt_kerja_sama").DataTable().ajax.reload(null, false);
                            });
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
        });
    }
</script>