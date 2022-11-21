<?php $CI = &get_instance(); ?>
<div class="content">
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h1 class="text-white pb-2 fw-bold"><?= $title ?></h1>
                    <h5 class="text-white op-7 mb-2">
                        Fakultas Teknik Universitas Islam Riau</h5>
                </div>

            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table">
                                    <tr>
                                        <th>Dokumen MUO</th>
                                        <td>:</td>
                                        <td>
                                            <?php
                                            $CI->load->model('Mou_model');
                                            $mou_row =  $CI->Mou_model->getMouById($moa_row->mou_id)->row();
                                            ?>
                                            <button onclick="btnShowMOA()" class="btn btn-info">Lihat</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Kategori</th>
                                        <td>:</td>
                                        <td><?= $moa_row->kategori_moa ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggak MOA</th>
                                        <td>:</td>
                                        <td><?= tgl_indo($moa_row->tanggal) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal MOA Berakhir</th>
                                        <td>:</td>
                                        <td><?= tgl_indo($moa_row->tanggal_akhir) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Kecamata</th>
                                        <td>:</td>
                                        <td><?= $moa_row->kecamatan_nama ?></td>
                                    </tr>
                                    <tr>
                                        <th>Kabupaten/Kota</th>
                                        <td>:</td>
                                        <td><?= $moa_row->kota_kabupaten_nama ?></td>
                                    </tr>
                                    <tr>
                                        <th>Provinsi</th>
                                        <td>:</td>
                                        <td><?= $moa_row->province_name ?></td>
                                    </tr>
                                    <tr>
                                        <th>Negara</th>
                                        <td>:</td>
                                        <td><?= $moa_row->nama_negara ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table">
                                    <tr>
                                        <th>Lembaga Mitra</th>
                                        <td>:</td>
                                        <td>
                                            <?php $arr_nama_lembaga_mitra = explode("#", $moa_row->nama_lembaga_mitra_moa);

                                            $result = "";
                                            $no = 1;
                                            foreach ($arr_nama_lembaga_mitra as $key => $value) {
                                                $result = $result . $no++ . ". " . $value . "<br>";
                                            }
                                            echo $result;
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>:</td>
                                        <td><?= $moa_row->alamat_moa ?></td>
                                    </tr>
                                    <tr>
                                        <th>Dokumen Pendukung 1</th>
                                        <td>:</td>
                                        <td><?= $moa_row->dokumen1 ?></td>
                                    </tr>
                                    <tr>
                                        <th>Dokumen Pendukung 2</th>
                                        <td>:</td>
                                        <td><?= $moa_row->dokumen2 ?></td>
                                    </tr>
                                    <tr>
                                        <th>Dokumen Pendukung 3</th>
                                        <td>:</td>
                                        <td><?= $moa_row->dokumen3 ?></td>
                                    </tr>
                                    <tr>
                                        <th>Ditujukan Kepada Prodi</th>
                                        <td>:</td>
                                        <td>
                                            <?php

                                            $CI->load->model('Prodi_model');
                                            $prodi_result =  $CI->Prodi_model->getProdiByIdArr(explode("#", $moa_row->kode_prodi))->result();

                                            $result1 = "";
                                            $no1 = 1;
                                            foreach ($prodi_result as $key => $value) {
                                                $result1 = $result1 . $no1++ . ". " . $value->nama_prodi . "<br>";
                                            }
                                            echo $result1;
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal_dok_mou" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="far fa-file-alt"></i> Detail Dok MOU</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <iframe src="<?php echo base_url('assets/doc_mou/'.$mou_row->dokumen)?>" title="description" style="width: 100%; height: 720px;"></iframe>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="far fa-times-circle"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    function btnShowMOA() {
        $('#modal_dok_mou').modal('show');
    }
</script>