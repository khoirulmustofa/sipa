<script>
    $(document).ready(function() {
        btn_load_kerja_sama();
    });

    function btn_load_kerja_sama() {
        console.log($("[name='tahun_kerja_sama']").val());
        $.ajax({
            url: '<?php echo base_url('dashboard/index_json') ?>',
            data: {
                tahun_kerja_sama: $("[name='tahun_kerja_sama']").val(),
            },
            type: "GET",
            dataType: "JSON",
            success: function(respon) {
                Swal.close();
                if (respon.status) {
                    $('#moa').text(respon.jumlah_kerja_sama_row.MOA);
                    $('#mou').text(respon.jumlah_kerja_sama_row.MOU);
                    load_kegiatan(respon.jumlah_kegiatan_per_prodi_result);
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

    function load_kegiatan(jumlah_kegiatan_per_prodi) {
        let i;
        for (i = 0; i < jumlah_kegiatan_per_prodi.length; i++) {
            $('#kode_prodi_' + jumlah_kegiatan_per_prodi[i].kode_prodi).text(jumlah_kegiatan_per_prodi[i].jumlah)
        }

    }
</script>