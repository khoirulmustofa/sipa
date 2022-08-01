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
                    orderable: false,
                    searchable: false
                }, {
                    data: "akhir_kegiatan",
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
</script>