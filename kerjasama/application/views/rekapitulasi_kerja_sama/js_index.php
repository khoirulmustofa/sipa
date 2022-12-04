<script type="text/javascript">
    var status_login = '<?php echo $_SESSION['status_login'] ?>';
    setInterval(function() {
        $(".berkedip").toggle();
    }, 300);

    $(document).ready(function() {
        load_data_tables();
    });

    $(function() {
        // fungsi untuk cek negara indonesia atau tidak
        $("#tingkat_ia").change(function() {
            let tingkat_ia = $("#tingkat_ia").val();
            if (tingkat_ia == "") {
                messegeWarning("Pilih Tingkatan");
                $("#tingkat_ia").focus();
                return false;
            }
            load_data_tables(tingkat_ia);
        });
    });

    // fungsi untuk load data MOU
    function load_data_tables(tingkat_ia = "") {
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
                url: '<?php echo base_url('rekapitulasi_kerja_sama/list'); ?>',
                data: {
                    tingkat_ia: tingkat_ia
                },
                type: "POST",
                dataType: "JSON",
            },
            columns: [{
                    data: "id",
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },{
                    data: "nama_prodi",
                }, {
                    data: "nama_lembaga_mitra_moa",
                    render: function(data, type, row, meta) {
                        return explodeLembagaMitra(data);
                    }

                }, {
                    data: "internasional",
                }, {
                    data: "nasional",
                }, {
                    data: "wilayah",
                }, {
                    data: "judul_kegiatan",
                }, {
                    data: "manfaat_kegiatan",
                }, {
                    data: "tanggal_awal",
                }, {
                    data: "dokumen1",
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
</script>