<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="far fa-file-alt"></i> <?php echo $title ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <label><strong>Dokumen MOU</strong></label>
        <ol>
            <?php foreach ($moa_dokumen_result as $key => $value) { ?>
                <li>
                    <p><?php echo "Jenis Dokumen : " . $value->jenis_dokumen ?></p>
                    <span><a href="<?php echo base_url('assets/doc_moa/') . $value->file_dokumen ?>" class="btn btn-info btn-sm" target="_blank" rel="noopener noreferrer">Lihat</a></span>
                </li>
            <?php  } ?>
        </ol>
        <hr>
        <label><strong>Dokumen Kegiatan (IA)</strong></label>
        <ol>
            <?php foreach ($ia_dokumen_result as $key => $value) { ?>
                <li>
                    <p><?php echo "Jenis Dokumen : " . $value->jenis_dokumen ?></p>
                    <span><a href="<?php echo base_url('assets/doc_ia/') . $value->file_dokumen ?>" class="btn btn-info btn-sm" target="_blank" rel="noopener noreferrer">Lihat</a></span>                    
                </li>
            <?php  } ?>
        </ol>
    </div>
    <div class="card-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="far fa-times-circle"></i> Tutup</button>
    </div>
</div>