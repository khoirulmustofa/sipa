<script>
    $(document).ready(function() {
        load_data_keiatan();
    });

    function load_data_keiatan() {
        $('#dt_kegiatan').DataTable({
            processing: true,
            serverSide: true,
            bDestroy: true,
            scrollX: true,
            ajax: {
                //panggil method ajax list dengan ajax
                "url": '<?php echo base_url('prodi/kegiatan/get_datatable_kegiatan') ?>',
                "data": {
                    jenis_kegiatan: $("[name='jenis_kegiatan']").val(),
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
                    data: "id_kegiatan",
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
                    data: "jenis_kegiatan",
                },
                {
                    data: "judul_kegiatan",
                }, {
                    data: "manfaat_kegiatan",
                    orderable: false,
                    searchable: false
                }, {
                    data: "awal_kegiatan",
                    searchable: false,
                    render: function(data, type, row, meta) {
                        return getFormattedDate(data);
                    }
                }, {
                    data: "akhir_kegiatan",
                    searchable: false,
                    render: function(data, type, row, meta) {
                        return getFormattedDate(data);
                    }
                }, {
                    data: "selisih_hari",
                    searchable: false
                }
            ],
            order: [
                [3, 'asc'],
            ],
        });
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
            url: '<?php echo base_url('prodi/kegiatan/detail') ?>',
            data: {
                id_kegiatan: id
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

    function getFormattedDate(date) {
        var dt = new Date(date);
        var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        var mmddyyyy = dt.getDate() + ' ' + months[dt.getMonth()] + ' ' + dt.getFullYear();
        return mmddyyyy;
    }

    function btn_tambah_kegiatan() {
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
</script>