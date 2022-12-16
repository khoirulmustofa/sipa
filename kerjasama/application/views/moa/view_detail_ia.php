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
        <td><?php echo $judul_kegiatan_ia; ?></td>
    </tr>
    <tr>
        <td>Manfaat Kegiatan</td>
        <td><?php echo $manfaat_kegiatan_ia; ?></td>
    </tr>
    <tr>
        <td>Tanggal Awal</td>
        <td><?php echo $tanggal_awal_ia; ?></td>
    </tr>
    <tr>
        <td>Tanggal Akhir</td>
        <td><?php echo $tanggal_akhir_ia; ?></td>
    </tr>
    <tr>
        <td>Dosen Terlibat</td>
        <td><?php
            foreach ($dosen_terlibat_result as $key5 => $value5) {
                echo $value5->nama_dosen . "<br>";
            } ?>
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