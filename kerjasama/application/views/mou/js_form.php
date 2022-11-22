<script>
    $(document).ready(function() {
        // pertama kali load hidden provinsi_desa_group
        let load_negara_id = '<?php echo $negara_id ?>';
        if (load_negara_id == "") {
            $('#indonesia').hide();
        }

        // petama kali load hidden indonesia jika negara_id = Indonesia
        if (load_negara_id != "102") {
            $('#indonesia').hide();
        } else {
            $('#indonesia').show();
        }
    });

    $(function() {
        // Setting negara indo
        $("#negara_id").change(function() {
            let negara_id = $('#negara_id').val();
            if (negara_id == "102") {
                $('#indonesia').show();
            } else {
                $('#indonesia').hide();
            }
        });

        // Load Kabupaten
        $("#provinsi_id").change(function() {
            let provinsi_id = $('#provinsi_id').val();
            $.ajax({
                url: '<?php echo base_url('tu/kerja_sama/get_kota_kabupaten') ?>',
                data: {
                    provinsi_id: provinsi_id
                },
                type: "GET",
                dataType: "JSON",
                success: function(respon) {
                    Swal.close();
                    if (respon.status) {
                        $('#kabupaten_kota_id').html(respon.kota_kabupaten_html);
                        if (provinsi_id == "") {
                            $('#kabupaten_kota_id').html('<option value="">Pilih Kota Kabupaten</option>');
                        }
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
        });

        // Load Kecamatan
        $("#kabupaten_kota_id").change(function() {
            let kabupaten_kota_id = $('#kabupaten_kota_id').val();
            $.ajax({
                url: '<?php echo base_url('tu/kerja_sama/get_kecamatan') ?>',
                data: {
                    kabupaten_kota_id: kabupaten_kota_id
                },
                type: "GET",
                dataType: "JSON",
                success: function(respon) {
                    Swal.close();
                    if (respon.status) {
                        $('#kecamatan_id').html(respon.kecamatan_html);
                        if (kabupaten_kota_id == "") {
                            $('#kecamatan_id').html('<option value="">Pilih Kecamatan</option>');
                        }
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
        });

        // Load Kelurahan
        $("#kecamatan_id").change(function() {
            let kecamatan_id = $('#kecamatan_id').val();
            $.ajax({
                url: '<?php echo base_url('tu/kerja_sama/get_kelurahan') ?>',
                data: {
                    kecamatan_id: kecamatan_id
                },
                type: "GET",
                dataType: "JSON",
                success: function(respon) {
                    Swal.close();
                    if (respon.status) {
                        $('#kelurahan_id').html(respon.kelurahan_html);
                        if (kabupaten_kota_id == "") {
                            $('#kecamatan_id').html('<option value="">Pilih Kelurhan / Desa</option>');
                        }
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
        });

        // simpan from 

        $('form#my_form').on('submit', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajax({
                url: $(this).attr('action'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                type: 'POST',
                dataType: "JSON",
                success: function(respon) {
                    Swal.close();
                    if (respon.status) {
                        messegeSuccess(respon.messege);
                        setTimeout(function() {
                            window.location.href = "<?php echo base_url('mou') ?>";
                        }, 1000);

                    } else {
                        messegeWarning(respon.messege);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    Swal.close();
                    alert("Code Status : " + xhr.status + "\nMessege Error :" + thrownError);
                }
            });
        });
    });
</script>