<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"><i class="far fa-file-alt"></i> <?php echo $title ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table class="table">
                <tr>
                    <td>Jenis Kerjasama</td>
                    <td><?php echo $jenis_kerjasama; ?></td>
                </tr>
                <tr>
                    <td>Tgl Kerjasama</td>
                    <td><?php echo date('d F Y', strtotime($tgl_kerjasama)); ?></td>
                </tr>
                <tr>
                    <td>Lembaga Mitra</td>
                    <td><?php echo $lembaga_mitra; ?></td>
                </tr>
                <tr>
                    <td>Periode</td>
                    <td><?php echo $periode; ?></td>
                </tr>
                <tr>
                    <td>Alamat Mitra</td>
                    <td><?php echo $alamat_mitra; ?></td>
                </tr>

                <!-- jika nama negara bukan indonesia -->
                <?php if ($negara_id == "102") { ?>
                    <tr>
                        <td>Negara</td>
                        <td><?php echo $nama_negara; ?></td>
                    </tr>
                    <tr>
                        <td>Provinsi</td>
                        <td><?php echo $province_name; ?></td>
                    </tr>
                    <tr>
                        <td>Kabupaten Kota</td>
                        <td><?php echo $kota_kabupaten_nama; ?></td>
                    </tr>
                    <tr>
                        <td>Kecamatan</td>
                        <td><?php echo $kecamatan_nama; ?></td>
                    </tr>
                    <tr>
                        <td>Kelurahan</td>
                        <td><?php echo $kelurahan_nama; ?></td>
                    </tr>
                <?php } ?>
                <?php
                // tanggal sekarang
                $tgl_sekarang = date("Y-m-d");
                if ($tgl_sekarang <= $akhir_kerjasama) { ?>
                    <tr>
                        <td>Durasi Kerjasama</td>
                        <td><?php echo $durasi_kerjasama . " Tahun"; ?></td>
                    </tr>
                <?php }  ?>


                <?php

                if ($jenis_kerjasama == "MOA") {
                    // peringatan 3 bulan
                    $tanggal_dikurangi = new DateTime($akhir_kerjasama);
                    $tanggal_dikurangi->sub(new DateInterval('P3M')); // 3 bulan                
                } else {
                    // peringatan 6 bulan
                    $tanggal_dikurangi = new DateTime($akhir_kerjasama);
                    $tanggal_dikurangi->sub(new DateInterval('P6M'));  // 6 bulan                
                }


                if ($tgl_sekarang > $akhir_kerjasama) {
                    if ($perbaharui == "0") {
                        $tgl_peringtan = format_tgl_dMY($akhir_kerjasama) . " (Telah Berakhir) " . '<button type="button" onclick="btn_perbaharui(\'' . $id_kerjasama . '\')" class="btn btn-success btn-block btn-sm"><i class="far fa-file"></i> Perbaharui</button>';
                    } else {
                        $tgl_peringtan = format_tgl_dMY($akhir_kerjasama) . " (Telah Berakhir) ";
                    }
                } else {
                    if (strtotime(date("Y-m-d")) >= strtotime(format_tgl_Ymd($tanggal_dikurangi))) {
                        $tgl_peringtan = format_tgl_dMY($akhir_kerjasama) . " (Segera berakhir)";
                    } else {
                        $tgl_peringtan = format_tgl_dMY($akhir_kerjasama);
                    }
                }
                ?>
                <tr>
                    <td>Akhir Kerjasama</td>
                    <td><?php echo $tgl_peringtan; ?></td>
                </tr>
                <tr>
                    <td>Dokumen Kerjasama</td>
                    <td><a href="<?php echo base_url('kerjasama/assets/file_dok/' . $dokumen_kerjasama) ?>" class="btn btn-info btn-sm" download><i class="fas fa-cloud-download-alt"></i> Download</a></td>
                </tr>
                <?php if ($dokumen_pendukung_1 != "") { ?>
                    <tr>
                        <td>Dokumen Pendukung 1</td>
                        <td><a href="<?php echo base_url('kerjasama/assets/file_dok/' . $dokumen_pendukung_1) ?>" class="btn btn-info btn-sm" download><i class="fas fa-cloud-download-alt"></i> Download</a></td>
                    </tr>
                <?php } ?>

                <?php if ($dokumen_pendukung_2 != "") { ?>
                    <tr>
                        <td>Dokumen Pendukung 2</td>
                        <td><a href="<?php echo base_url('kerjasama/assets/file_dok/' . $dokumen_pendukung_2) ?>" class="btn btn-info btn-sm" download><i class="fas fa-cloud-download-alt"></i> Download</a></td>
                    </tr>
                <?php } ?>

                <?php if ($dokumen_pendukung_3 != "") { ?>
                    <tr>
                        <td>Dokumen Pendukung 3</td>
                        <td><a href="<?php echo base_url('kerjasama/assets/file_dok/' . $dokumen_pendukung_3) ?>" class="btn btn-info btn-sm" download><i class="fas fa-cloud-download-alt"></i> Download</a></td>
                    </tr>
                <?php } ?>

                <?php if ($dokumen_pendukung_4 != "") { ?>
                    <tr>
                        <td>Dokumen Pendukung 4</td>
                        <td><a href="<?php echo base_url('kerjasama/assets/file_dok/' . $dokumen_pendukung_4) ?>" class="btn btn-info btn-sm" download><i class="fas fa-cloud-download-alt"></i> Download</a></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="far fa-times-circle"></i> Tutup</button>
        </div>
    </div>
</div>

<script>
    function btn_perbaharui(id) {
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
            url: '<?php echo base_url('tu/kerja_sama/perbaharui') ?>',
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
</script>