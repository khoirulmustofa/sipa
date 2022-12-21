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
                <td>Prodi</td>
                <td>:</td>
                <td><?php echo $ia_row->nama_prodi ?></td>
            </tr>
            <tr>
                <td>Tingkatan</td>
                <td>:</td>
                <td><?php echo $ia_row->tingkat_ia ?></td>
            </tr>
            <tr>
                <td>Judul Kegiatan</td>
                <td>:</td>
                <td><?php echo $ia_row->judul_kegiatan_ia ?></td>
            </tr>
        </table>

    </div>
    <div class="card-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="far fa-times-circle"></i> Tutup</button>
    </div>
</div>