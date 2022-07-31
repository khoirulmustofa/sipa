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
            "ajax": {
                //panggil method ajax list dengan ajax
                "url": '<?php echo base_url('tu/Kerja_sama/get_datatable_kerja_sama') ?>',
                "data": {
                    jenis_kerjasama: $("[name='jenis_kerjasama']").val(),
                    tahun_kerja_sama: $("[name='tahun_kerja_sama']").val()
                },
                "type": "POST"
            },
            columns: [{
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: "id_kerjasama",
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        let button = `<div class="btn-group" role="group" aria-label="Basic example">                                      
                                        <button type="button" title="Detail" onclick="btn_detail('${data}')" class="btn btn-info btn-xs"><i class="fas fa-info-circle"></i></button>
                                        <button type="button" title="Edit" onclick="btn_edit('${data}')" class="btn btn-warning btn-xs"><i class="far fa-edit"></i></button>
                                        <button type="button" title="Delete" onclick="btn_delete('${data}')" class="btn btn-danger btn-xs"><i class="far fa-trash-alt"></i></button>
                                    </div>`;
                        return button;
                    }
                }, {
                    data: "jenis_kerjasama",
                },
                {
                    data: "lembaga_mitra",
                }, {
                    data: "periode",
                    searchable: false
                }, {
                    data: "alamat_mitra",
                    orderable: false,
                    searchable: false
                }, {
                    data: "nama_negara",
                }, {
                    data: "durasi_kerjasama",
                    orderable: false,
                    searchable: false
                }, {
                    data: "tgl_kerjasama",
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        let date = new Date(data);
                        return getFormattedDate(date);
                    }
                }, {
                    data: "akhir_kerjasama",
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        let result = '';
                        if (data != null || data != '') {
                            let date_now = new Date();
                            let date_actual = new Date(data);
                            if (row['jenis_kerjasama'] == 'MOU') {
                                date_actual.setDate(date_actual.getMonth() - 6);
                                if (date_now >= date_actual) {
                                    result = '<span class="badge badge-danger berkedip">' + getFormattedDate(data) + '</span>';
                                } else {
                                    result = '<span class="badge badge-success">' + getFormattedDate(data) + '</span>';
                                }
                            } else {
                                date_actual.setDate(date_actual.getMonth() - 3);
                                if (date_now >= date_actual) {
                                    result = '<span class="badge badge-danger berkedip">' + getFormattedDate(data) + '</span>';
                                } else {
                                    result = '<span class="badge badge-success">' + getFormattedDate(data) + '</span>';
                                }
                            }

                        } else {
                            result = "-"
                        }

                        return result;
                    }
                }, {
                    data: "dokumen_kerjasama",
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        let button = `<button class="btn btn-info btn-xs" onclick="btn_preview('${data}')"><i class="far fa-eye"></i> Preview</button>`;
                        return button;
                    }
                }
            ],
            order: [
                [8, 'asc'],
            ],
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
            url: '<?php echo base_url('tu/kerja_sama/detail_kerja_sama') ?>',
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
            url: '<?php echo base_url('tu/kerja_sama/buat_kerja_sama') ?>',
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
            url: '<?php echo base_url('tu/kerja_sama/edit_kerja_sama') ?>',
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
                    url: '<?php echo base_url('tu/kerja_sama/hapus_action') ?>',
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