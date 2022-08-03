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
                    <td>Jenis Kegiatan</td>
                    <td><?php echo $jenis_kegiatan; ?></td>
                </tr>
                <tr>
                    <td>Judul Kegiatan</td>
                    <td><?php echo $judul_kegiatan; ?></td>
                </tr>
                <tr>
                    <td>Manfaat Kegiatan</td>
                    <td><?php echo $manfaat_kegiatan; ?></td>
                </tr>
                <tr>
                    <td>Awal Pelaksanaan</td>
                    <td><?php echo date('d F Y', strtotime($awal_kegiatan)); ?></td>
                </tr>
                <tr>
                    <td>Akhir Pelaksanaan</td>
                    <td><?php echo date('d F Y', strtotime($akhir_kegiatan)); ?></td>
                </tr>

                <tr>
                    <td>Dokumen Udangan</td>
                    <td><?php echo $doc_undangan != "" ? '<a href="' . base_url('assets/file_kegiatan/' . $doc_undangan) . '" class="btn btn-info btn-xs" download><i class="fas fa-cloud-download-alt"></i> Download</a>' : '-' ?></td>
                </tr>
                <tr>
                    <td>Dokumen Absensi</td>
                    <td><?php echo $doc_absensi != "" ? '<a href="' . base_url('assets/file_kegiatan/' . $doc_absensi) . '" class="btn btn-info btn-xs" download><i class="fas fa-cloud-download-alt"></i> Download</a>' : '-' ?></td>
                </tr>
                <tr>
                    <td>Dokumen Materi</td>
                    <td><?php echo $doc_materi != "" ? '<a href="' . base_url('assets/file_kegiatan/' . $doc_materi) . '" class="btn btn-info btn-xs" download><i class="fas fa-cloud-download-alt"></i> Download</a>' : '-' ?></td>
                </tr>
                <tr>
                    <td>Dokumen Foto</td>
                    <td><?php echo $doc_foto != "" ? '<a href="' . base_url('assets/file_kegiatan/' . $doc_foto) . '" class="btn btn-info btn-xs" download><i class="fas fa-cloud-download-alt"></i> Download</a>' : '-' ?></td>
                </tr>

                <?php if ($doc_1 != "") { ?>
                    <tr>
                        <td>Dokumen 1</td>
                        <td><?php echo $doc_1 != "" ? '<a href="' . base_url('assets/file_kegiatan/' . $doc_1) . '" class="btn btn-info btn-xs" download><i class="fas fa-cloud-download-alt"></i> Download</a>' : '-' ?></td>
                    </tr>
                <?php } ?>

                <?php if ($doc_2 != "") { ?>
                    <tr>
                        <td>Dokumen 2</td>
                        <td><?php echo $doc_2 != "" ? '<a href="' . base_url('assets/file_kegiatan/' . $doc_2) . '" class="btn btn-info btn-xs" download><i class="fas fa-cloud-download-alt"></i> Download</a>' : '-' ?></td>
                    </tr>
                <?php } ?>

                <?php if ($doc_3 != "") { ?>
                    <tr>
                        <td>Dokumen 3</td>
                        <td><?php echo $doc_3 != "" ? '<a href="' . base_url('assets/file_kegiatan/' . $doc_3) . '" class="btn btn-info btn-xs" download><i class="fas fa-cloud-download-alt"></i> Download</a>' : '-' ?></td>
                    </tr>
                <?php } ?>

                <?php if ($doc_4 != "") { ?>
                    <tr>
                        <td>Dokumen 4</td>
                        <td><?php echo $doc_4 != "" ? '<a href="' . base_url('assets/file_kegiatan/' . $doc_4) . '" class="btn btn-info btn-xs" download><i class="fas fa-cloud-download-alt"></i> Download</a>' : '-' ?></td>
                    </tr>
                <?php } ?>

                <?php if ($doc_5 != "") { ?>
                    <tr>
                        <td>Dokumen 5</td>
                        <td><?php echo $doc_5 != "" ? '<a href="' . base_url('assets/file_kegiatan/' . $doc_5) . '" class="btn btn-info btn-xs" download><i class="fas fa-cloud-download-alt"></i> Download</a>' : '-' ?></td>
                    </tr>
                <?php } ?>

                <?php if ($doc_6 != "") { ?>
                    <tr>
                        <td>Dokumen 6</td>
                        <td><?php echo $doc_6 != "" ? '<a href="' . base_url('assets/file_kegiatan/' . $doc_6) . '" class="btn btn-info btn-xs" download><i class="fas fa-cloud-download-alt"></i> Download</a>' : '-' ?></td>
                    </tr>
                <?php } ?>

            </table>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="far fa-times-circle"></i> Tutup</button>
        </div>
    </div>
</div>