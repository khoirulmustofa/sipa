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

        api_data_table();
        $("#dt_kerja_sama").DataTable({
            initComplete: function() {
                var api = this.api();
                $('#dt_kerja_sama_filter input')
                    .off(".DT")
                    .on("keyup.DT", function(e) {
                        if (e.keyCode == 13) {
                            api.search(this.value).draw();
                        }
                    });
            },
            oLanguage: {
                sProcessing: '<i class="fas fa-circle-notch"></i><span>Loading...</span> '
            },
            dom: "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            bDestroy: true,
            processing: true,
            serverSide: true,
            responsive: false,
            lengthChange: true,
            autoWidth: false,
            lengthMenu: [
                [10, 25, 50, 100, 200, -1],
                [10, 25, 50, 100, 200, "All"]
            ],
            buttons: [{
                    extend: "copy",
                    exportOptions: {
                        columns: [1, 2, 3, 4]
                    }
                }, {
                    extend: "csv",
                    exportOptions: {
                        columns: [1, 2, 3, 4]
                    }
                },
                {
                    extend: "excel",
                    exportOptions: {
                        columns: [1, 2, 3, 4]
                    }
                },
                {
                    extend: "pdf",
                    exportOptions: {
                        columns: [1, 2, 3, 4]
                    }
                },
                {
                    extend: "print",
                    exportOptions: {
                        columns: [1, 2, 3, 4]
                    }
                },

            ],
            ajax: {
                url: "<?php echo base_url('Kerja_sama/get_kerja_sama_json') ?>",
                type: "GET",
                dataType: "JSON",
            },
            columns: [{
                    data: "id_kerjasama",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "id_kerjasama",
                    orderable: false,
                    searchable: false
                }, {
                    data: "jenis_kerjasama",
                    orderable: false,
                    searchable: false
                }, {
                    data: "lembaga_mitra",
                    orderable: false,
                    searchable: false
                }, {
                    data: "nama_negara",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "alamat_mitra",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "durasi_kerjasama",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "tgl_kerjasama",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "akhir_kerjasama",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "dokumen_kerjasama",
                    orderable: false,
                    searchable: false
                },
            ],
            columnDefs: [{
                    targets: 1,
                    render: function(data, type, row, meta) {
                        let result = `<button type="button" onclick="btn_detail('${data}')" class="btn btn-round btn-info btn-sm"><i class="fa fa-eye"></i> Detail</button>
                    <button type="button" onclick="btn_edit('${data}')" class="btn btn-round btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</button>
                    <button type="button" onclick="btn_delete('${data}')" class="btn btn-round btn-danger btn-sm"><i class="fa fa-trash-o"></i> Delete</button>`;
                        return result;
                    }
                },
                {
                    targets: 7,
                    render: function(data, type, row, meta) {
                        return getFormattedDate(data);
                    }
                },
                {
                    targets: 8,
                    render: function(data, type, row, meta) {
                        let specific_date = new Date(row['tgl_peringatan']);
                        let current_date = new Date();
                        let result = "";
                        if (Date.parse(specific_date) > Date.parse(current_date)) {
                            result = `<button type="button" class="btn btn-success btn-sm">${getFormattedDate(data)}</button>`;
                        } else {
                            result = `<button type="button" class="btn btn-danger btn-sm berkedip">${getFormattedDate(data)}</button>`;
                        }
                        return result;
                    }
                },
                {
                    targets: 9,
                    render: function(data, type, row, meta) {
                        let result = "";
                        if (data) {
                            result = `-`;
                        } else {
                            result = `<a href="<?php echo base_url('kerjasama/assets/file_dok/') ?>${data}" class="btn btn-default btn-sm" download ><i class="fa fa-cloud-download"></i> Download</a>`;
                        }
                        return result;
                    }
                },
            ],
            order: [
                // [1, 'asc']
            ],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });
    });

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
            title: 'Question ?',
            text: "Apakah kamu ingin Menhapus data ini?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#00a65a',
            cancelButtonColor: '#dd4b39',
            confirmButtonText: 'Yes, Yakin!',
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