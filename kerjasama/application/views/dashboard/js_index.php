<script>
    $(document).ready(function() {
        count_mou("");
        count_moa("");
        count_kegiatan_perprodi("", "");
    });

    function count_mou(tahun = "") {
        $.ajax({
            url: '<?php echo base_url('dashboard/count_mou') ?>',
            data: {
                tahun: tahun
            },
            type: "GET",
            dataType: "JSON",
            success: function(respon) {
                Swal.close();
                if (respon.status) {
                    $('#mou').text(respon.count_mou);
                } else {
                    Swal.fire({
                        title: "Ooops..",
                        icon: 'warning',
                        html: "Error get count MOU",
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

    function count_moa(tahun = "", tingkat_moa = "") {
        $.ajax({
            url: '<?php echo base_url('dashboard/count_moa') ?>',
            data: {
                tahun: tahun,
                tingkat_moa: tingkat_moa
            },
            type: "GET",
            dataType: "JSON",
            success: function(respon) {
                Swal.close();
                if (respon.status) {
                    $('#moa').text(respon.count_moa);
                } else {
                    Swal.fire({
                        title: "Ooops..",
                        icon: 'warning',
                        html: "Error get count MOU",
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

    function count_kegiatan_perprodi(tahun = "", tingkat_moa = "") {
        $.ajax({
            url: '<?php echo base_url('dashboard/count_kegiatan_perprodi') ?>',
            data: {
                tahun: tahun,
                tingkat_moa: tingkat_moa
            },
            type: "GET",
            dataType: "JSON",
            success: function(respon) {
                Swal.close();
                if (respon.status) {
                    if (respon.data_count_kegiatan.length > 0) {
                        for (i = 0; i < respon.data_count_kegiatan.length; i++) {
                            $("#kode_prodi" + respon.data_count_kegiatan[i].kode_prodi).text(respon.data_count_kegiatan[i].count_prodi);
                        }
                    } else {
                        <?php foreach ($prodi_result as $key => $value) { ?>
                            $('#kode_prodi<?php echo $value->kode_prodi ?>').text("0");
                        <?php } ?>
                    }
                } else {
                    Swal.fire({
                        title: "Ooops..",
                        icon: 'warning',
                        html: "Error get count MOU",
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

    function btn_load_moa_mou() {
        let tahun = $("#tahun_moa").val();
        let tingkat_moa = $("#tingkat_moa").val();
        count_mou(tahun);
        count_moa(tahun, tingkat_moa);
    }

    function btn_load_moa_mou2() {
        let tahun = $("#tahun_moa2").val();
        let tingkat_moa = $("#tingkat_moa2").val();
        count_kegiatan_perprodi(tahun, tingkat_moa);
    }
</script>