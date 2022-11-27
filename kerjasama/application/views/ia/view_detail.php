<?php $CI = &get_instance();
$CI->load->model('Dosen_model');
?>

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
                <td>Kategori</td>
                <td><?php echo $kategori_ia; ?></td>
            </tr>
            <tr>
                <td>Tingkat</td>
                <td><?php echo $tingkat_ia; ?></td>
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
                <td>Tanggal Awal</td>
                <td><?php echo tgl_indo($tanggal_awal); ?></td>
            </tr>
            <tr>
                <td>Tanggal Akhir</td>
                <td><?php echo tgl_indo($tanggal_akhir); ?></td>
            </tr>
            <tr>
                <td>Dosen Terlibat</td>
                <td><?php
                    $dosen_result =   $CI->Dosen_model->get_dosen_by_npk_arr(explode("#", $dosen_terlibat))->result();
                    foreach ($dosen_result as $key => $value) {
                        echo $value->nama_dosen . "<br>";
                    }
                    ?></td>
            </tr>
            <tr>
                <td>Dokumen1</td>
                <td>
                    <?php if ($dokumen1 != "") { ?>
                        <button type="button" onclick="btn_preview_1()" class="btn btn-default">Preview</button>
                        <div class="preview_doc1">
                            <embed src="<?php echo base_url('assets/doc_ia/' . $dokumen1) ?>" width="100%" height="720px" />
                            <a href="#" class="btn_hide btn btn-primary">Tutup Preview</a>
                        </div>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td>Dokumen2</td>
                <td>
                    <?php if ($dokumen2 != "") { ?>
                        <button type="button" onclick="btn_preview_2()" class="btn btn-default">Preview</button>
                        <div class="preview_doc2">
                            <embed src="<?php echo base_url('assets/doc_ia/' . $dokumen2) ?>" width="100%" height="720px" />
                            <a href="#" class="btn_hide btn btn-primary">Tutup Preview</a>
                        </div>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td>Dokumen3</td>
                <td>
                    <?php if ($dokumen3 != "") { ?>
                        <button type="button" onclick="btn_preview_3()" class="btn btn-default">Preview</button>
                        <div class="preview_doc3">
                            <embed src="<?php echo base_url('assets/doc_ia/' . $dokumen3) ?>" width="100%" height="720px" />
                            <a href="#" class="btn_hide btn btn-primary">Tutup Preview</a>
                        </div>
                    <?php } ?>
                </td>
            </tr>
        </table>
    </div>
    <div class="card-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="far fa-times-circle"></i> Tutup</button>
    </div>
</div>





<script>
    $(document).ready(function() {
        $('.preview_doc1').hide();
        $('.preview_doc2').hide();
        $('.preview_doc3').hide();
    });
    $(function() {

        $(".btn_hide").click(function(e) {
            console.log($(this).parent());
            $(this).parent().hide();
        });
    });



    function btn_preview_1() {
        $('.preview_doc1').show();
    }

    function btn_preview_2() {
        $('.preview_doc2').show();
    }

    function btn_preview_3() {
        $('.preview_doc3').show();
    }
</script>