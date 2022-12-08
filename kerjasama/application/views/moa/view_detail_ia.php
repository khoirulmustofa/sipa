<table class="table">
    <tr>
        <td>Kategori Ia</td>
        <td><?php echo $kategori_ia; ?></td>
    </tr>
    <tr>
        <td>Tingkat Ia</td>
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
        <td><?php echo $tanggal_awal; ?></td>
    </tr>
    <tr>
        <td>Tanggal Akhir</td>
        <td><?php echo $tanggal_akhir; ?></td>
    </tr>
    <tr>
        <td>Dosen Terlibat</td>
        <td><?php
            foreach ($dosen_terlibat_result as $key5 => $value5) {
                echo $value5->nama_dosen . "<br>";
            } ?>
        </td>
    </tr>
    <tr>
        <td>Dokumen1</td>
        <td><?php
            if ($dokumen1 != "") {
                echo '<br>';
                echo '<button type="button" onclick="btn_show_dok_ia1()"  class="btn btn-info btn-sm"> Lihat</button>';
            } ?>
            <div id="show_doc1">
                <embed src="<?php echo base_url('assets/doc_ia/') . $dokumen1 ?>" type="" style="width: 100%;" height="720px">
                <button type="button" class="btn btn-default btn-sm" onclick="btn_hide_dok_ia1()">Tutup Dokumen</button>
            </div>
        </td>
    </tr>
    <tr>
        <td>Dokumen2</td>
        <td><?php
            if ($dokumen2 != "") {
                echo '<br>';
                echo '<button type="button" onclick="btn_show_dok_ia2()"  class="btn btn-info btn-sm"> Lihat</button>';
            } ?>
            <div id="show_doc2">
                <embed src="<?php echo base_url('assets/doc_ia/') . $dokumen2 ?>" type="" style="width: 100%;" height="720px">
                <button type="button" class="btn btn-default btn-sm" onclick="btn_hide_dok_ia2()">Tutup Dokumen</button>
            </div>
        </td>
    </tr>
    <tr>
        <td>Dokumen3</td>
        <td><?php
            if ($dokumen3 != "") {
                echo '<br>';
                echo '<button type="button" onclick="btn_show_dok_ia3()"  class="btn btn-info btn-sm"> Lihat</button>';
            } ?>
            <div id="show_doc3">
                <embed src="<?php echo base_url('assets/doc_ia/') . $dokumen3 ?>" type="" style="width: 100%;" height="720px">
                <button type="button" class="btn btn-default btn-sm" onclick="btn_hide_dok_ia3()">Tutup Dokumen</button>
            </div>
        </td>
    </tr>
</table>

<script>
    $(document).ready(function() {
        btn_hide_dok_ia1();
        btn_hide_dok_ia2();
        btn_hide_dok_ia3();
    });

    function btn_show_dok_ia1() {
        $('#show_doc1').show();
    }

    function btn_hide_dok_ia1() {
        $('#show_doc1').hide();
    }

    function btn_show_dok_ia2() {
        $('#show_doc2').show();
    }

    function btn_hide_dok_ia2() {
        $('#show_doc2').hide();
    }

    function btn_show_dok_ia3() {
        $('#show_doc3').show();
    }

    function btn_hide_dok_ia3() {
        $('#show_doc3').hide();
    }
</script>