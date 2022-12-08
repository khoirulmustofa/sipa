<script type="text/javascript">
    var status_login = '<?php echo $_SESSION['status_login'] ?>';

    setInterval(function() {
        $(".berkedip").toggle();
    }, 300);

    $(document).ready(function() {
        dataTablesIA();
    });

    $(function() {
        // fungsi untuk cek negara indonesia atau tidak
        $("#tahun_kerja_sama").change(function() {
            let tahunKerjaSama = $("#tahun_kerja_sama").val();
            if (tahunKerjaSama == "") {
                messegeWarning("Pilih Tahun Kerja Sama");
                $("#tahun_kerja_sama").focus();
                return false;
            }
            dataTablesIA();
        });
    });

    // fungsi untuk load data MOU
    function dataTablesIA() {
        api_data_table();
        $("#myDatatables").DataTable({
            initComplete: function() {
                var api = this.api();
                $('#myDatatables_filter input')
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
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            scrollX: true,
            lengthMenu: [
                [10, 25, 50, 100, 200, -1],
                [10, 25, 50, 100, 200, "All"]
            ],
            buttons: [{
                    extend: "copy",
                    exportOptions: {
                        columns: [1, 2, 3]
                    }
                }, {
                    extend: "csv",
                    exportOptions: {
                        columns: [1, 2, 3]
                    }
                },
                {
                    extend: "excel",
                    exportOptions: {
                        columns: [1, 2, 3]
                    }
                },
                {
                    extend: "pdf",
                    exportOptions: {
                        columns: [1, 2, 3]
                    }
                },
                {
                    extend: "print",
                    exportOptions: {
                        columns: [1, 2, 3]
                    }
                },
                {
                    extend: "colvis",
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                }
            ],
            ajax: {
                url: '<?php echo base_url('ia/list'); ?>',
                type: "POST",
                dataType: "JSON",
            },
            columns: [{
                    data: "no",
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }, {
                    data: 'id',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        let btn_detail = ``;
                        let btn_update = ``;
                        let btn_delete = ``;
                        if (status_login == 'Fakultas') {
                            btn_detail = `<button type="button" onclick="btn_detail('${data}')" title="Detail" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </button>`;

                        }

                        if (status_login == 'Tata Usaha') {
                            btn_detail = `<button type="button" onclick="btn_detail('${data}')" title="Detail" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </button>`;
                        }

                        if (status_login == 'Prodi') {
                            btn_detail = `<button type="button" onclick="btn_detail('${data}')" title="Detail" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </button>`;
                            btn_update = ` <button type="button" onclick="btn_edit('${data}')" title="Edit" class="btn btn-warning btn-sm">
                                            <i class="far fa-edit"></i>
                                        </button>`;
                            btn_delete = `<button type="button" onclick="btn_delete('${data}')" title="Delete" class="btn btn-danger btn-sm">
                                            <i class="far fa-trash-alt"></i>
                                        </button>`;
                        }

                        return `<div class="btn-group" role="group" aria-label="Basic example">
                        ${btn_detail}
                                       ${btn_update}
                                       ${btn_delete}
                                    </div>`;
                    }
                },
                {
                    data: "nama_prodi",
                },
                {
                    data: "tingkat_ia",
                },
                {
                    data: "judul_kegiatan",
                }, {
                    data: "tanggal_awal",
                    render: function(data, type, row, meta) {
                        return getFormattedDate(data);
                    }
                },
                {
                    data: "tanggal_akhir",
                    render: function(data, type, row, meta) {
                        return getFormattedDate(data);
                    }
                },
                {
                    data: "selisih_hari",
                },
            ],
            order: [
                [2, 'asc']
            ],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });
    }

    function getFormattedDate(date) {
        var dt = new Date(date);
        var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        var mmddyyyy = dt.getDate() + ' ' + months[dt.getMonth()] + ' ' + dt.getFullYear();
        return mmddyyyy;
    }

    function explodeLembagaMitra(data) {
        let nama = data.split("#");
        let result = ``;

        for (const element of nama) {
            result += element + "<br>";
        }

        return result;
    }

    function addMonths(isoDate, numberMonths) {
        var dateObject = new Date(isoDate),
            day = dateObject.getDate(); // returns day of the month number

        // avoid date calculation errors
        dateObject.setHours(20);

        // add months and set date to last day of the correct month
        dateObject.setMonth(dateObject.getMonth() + numberMonths + 1, 0);

        // set day number to min of either the original one or last day of month
        dateObject.setDate(Math.min(day, dateObject.getDate()));

        return dateObject.toISOString().split('T')[0];
    };

    function btn_create() {
        $.ajax({
            url: '<?php echo base_url('ia/create') ?>',
            type: "GET",
            dataType: "JSON",
            success: function(respon) {
                Swal.close();
                if (respon.status) {
                    $(".modal-dialog").addClass("modal-xl");
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

    function btn_detail(id) {
        $.ajax({
            url: '<?php echo base_url('ia/detail') ?>',
            data: {
                id: id
            },
            type: "GET",
            dataType: "JSON",
            success: function(respon) {
                Swal.close();
                if (respon.status) {
                    $(".modal-dialog").addClass("modal-xl");
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

    function btn_edit(id) {
        $.ajax({
            url: '<?php echo base_url('ia/update') ?>',
            data: {
                id: id
            },
            type: "GET",
            dataType: "JSON",
            success: function(respon) {
                Swal.close();
                if (respon.status) {
                    $(".modal-dialog").addClass("modal-xl");
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
                    url: '<?php echo base_url('ia/delete_action') ?>',
                    data: {
                        id: id
                    },
                    type: "POST",
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
                                $("#myDatatables").DataTable().ajax.reload(null, false);
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

    function btn_test() {
        swalLoading();
        Swal.close();
    }

    function btn_preview(file) {
        Swal.fire({
            title: 'Processing ...',
            html: 'Please wait...',
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading()
            }
        });
        Swal.close();
        if (file != null || file != '') {
            let html = `<embed src="<?php echo base_url('assets/file_dok') ?>/${file}" width=100% height="720"></embed>`;
            let button = `<a class="btn btn-info btn-block" href="<?php echo base_url('assets/file_dok') ?>/${file}" download><i class="fas fa-cloud-download-alt"></i> Dowload</a>`;
            $('#view_modal_preview').html(html);
            $('#view_modal_button').html(button);
            $('#modal_preview').modal('show');
        } else {
            Swal.fire({
                title: "Ooops..",
                icon: 'warning',
                html: 'File tidak ditemukan',
                allowEscapeKey: false,
                allowOutsideClick: false,
            });
        }

    }
</script>