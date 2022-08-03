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
                    <td><?php echo $doc_undangan != "" ? '<a class="btn btn-info btn-xs"><i class="fas fa-cloud-download-alt"></i> Download</a>':'-' ?></td>
                </tr>
                <tr>
                    <td>Dokumen Absensi</td>
                    <td><?php echo $selisih_hari; ?></td>
                </tr>
                <tr>
                    <td>Dokumen Materi</td>
                    <td><?php echo $selisih_hari; ?></td>
                </tr>
                <tr>
                    <td>Dokumen Foto</td>
                    <td><?php echo $selisih_hari; ?></td>
                </tr>

            </table>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="far fa-times-circle"></i> Tutup</button>
        </div>
    </div>
</div>