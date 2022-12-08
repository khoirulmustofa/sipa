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
            }, {
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
                render: function(data, type, row, meta) {
                    let btn_dok_1 = ``;
                    let btn_dok_2 = ``;
                    let btn_dok_3 = ``;

                    if (row['dokumen'] != '' || row['dokumen'] != null) {
                        // btn_dok_1 = `<button type="button" class="btn btn-info btn-sm mr-2" > Lihat Dokumen 1</button>`;
                    } else {

                        if (row['dokumen1_moa'] != "" || row['dokumen1_moa'] == null) {
                            btn_dok_1 = `<button type="button" onclick="btn_preview('${row['dokumen1_moa']}')"  class="btn btn-info btn-sm mr-2" > Lihat Dokumen 1</button>`;
                        }

                        if (row['dokumen2_moa'] != "" || row['dokumen2_moa'] == null) {
                            btn_dok_2 = `<button type="button" onclick="btn_preview('${row['dokumen2_moa']}')" class="btn btn-info btn-sm mr-2" > Lihat Dokumen 2</button>`;
                        }

                        if (row['dokumen3_moa'] != "" || row['dokumen3_moa'] == null) {
                            btn_dok_3 = `<button type="button" onclick="btn_preview('${row['dokumen3_moa']}')" class="btn btn-info btn-sm" > Lihat Dokumen 3</button>`;
                        }
                    }

                    return `<div>
                            ${btn_dok_1}
                            ${btn_dok_2}
                            ${btn_dok_3}
                            </div>`;
                }
            }, ],
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

    function btn_cetak_rekap() {
        let tanggal_awal = $('#tanggal_awal').val();
        let tanggal_akhir = $('#tanggal_akhir').val();

        window.open(`<?php echo base_url('rekapitulasi_kerja_sama/cetak_pdf?') ?>tanggal_awal=${tanggal_awal}&tanggal_akhir=${tanggal_akhir}`, "_blank");
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
            let html = `<embed src="<?php echo base_url('assets/doc_moa') ?>/${file}" width=100% height="720"></embed>`;
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