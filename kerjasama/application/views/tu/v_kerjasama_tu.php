<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h1 class="text-white pb-2 fw-bold">DAFTAR KERJASAMA</h1>
                        <h5 class="text-white op-7 mb-2">Fakultas Teknik Universitas Islam Riau</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <h1 align="right">
                            <a class="text-white border-white custom-btn bg-primary btn mt-3" data-toggle="modal" data-target="#modal_add_new"><i class="fa fa-plus"></i> Tambah Kerjasama</a>
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- selamat datang -->
        <div class="page-inner mt--5">
            <div class="row mt--2">
                <div class="col-md-12">
                    <div class="card full-height">
                        <div class="card-body">
                            <?php echo $this->session->flashdata('messege'); ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="mydata" cellspacing="0" cellpadding="3" width="100%" style="width: 0px">
                                    <thead>
                                        <tr class="bg-info">
                                            <td align="center"><b>NO</b></td>
                                            <td align="center"><b>JENIS KERJASAMA</b></td>
                                            <td align="center"><b>LEMBAGA MITRA</b></td>
                                            <td align="center"><b>ALAMAT MITRA</b></td>
                                            <td align="center"><b>NEGARA</b></td>
                                            <td align="center"><b>PROVINSI</b></td>
                                            <td align="center"><b>KOTA/KABUPATEN</b></td>
                                            <td align="center"><b>DURASI KERJASAMA (TAHUN)</b></td>
                                            <td align="center"><b>AWAL KERJASAMA</b></td>
                                            <td align="center"><b>AKHIR KERJASAMA</b></td>
                                            <td align="center"><b>AKSI</b></td>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($kerjasama as $krjsm) : ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $krjsm->jenis_kerjasama; ?></td>
                                                <td><?php echo $krjsm->lembaga_mitra; ?></td>
                                                <td><?php echo $krjsm->alamat_mitra; ?></td>
                                                <td><?php echo $krjsm->negara; ?></td>
                                                <td><?php echo $krjsm->provinsi; ?></td>
                                                <td><?php echo $krjsm->kota_kab; ?></td>
                                                <td><?php echo $krjsm->durasi_kerjasama; ?></td>
                                                <td><?php echo $krjsm->tgl_kerjasama; ?></td>
                                                <td><?php echo $krjsm->akhir_kerjasama; ?></td>
                                                <td style="width: 330px;" class="text-white" align="center">
                                                    <a class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#modal_edit-<?php echo $krjsm->id_kerjasama; ?>"><i class="fa fa-pen"></i> Edit</a>
                                                    <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal_edit-<?php echo $krjsm->id_kerjasama; ?>"><i class="fa fa-pen"></i> Detail</a>
                                                    <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_hapus-<?php echo $krjsm->id_kerjasama; ?>"><i class="fa fa-trash"></i> Hapus</a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- ============ MODAL ADD =============== -->
                            <?php

                            $curl = curl_init();

                            curl_setopt_array($curl, array(
                                CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => "",
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 30,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => "GET",
                                CURLOPT_HTTPHEADER => array(
                                    "key: 21f84155b3b634dd01992c59564facfc"
                                ),
                            ));

                            $response = curl_exec($curl);
                            $err = curl_error($curl);

                            curl_close($curl);

                            if ($err) {
                                echo "cURL Error #:" . $err;
                            } else {
                                $provinsi = json_decode($response, true);
                            }
                            ?>
                            <div class="modal fade" id="modal_add_new" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h3 class="modal-title" id="myModalLabel">Tambah Kerjasama</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                        </div>
                                        <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url('tu/kerjasama/tambah_kerjasama') ?>">
                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label class="control-label col-xs-3">Jenis Kerjasama</label>
                                                    <select name="jenis_kerjasama" class="form-control" required>
                                                        <option value="">--Pilih--</option>
                                                        <option value="MOU">MOU</option>
                                                        <option value="MOA">MOA</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-xs-3">Tanggal Kerjasama</label>
                                                    <div class="col-xs-8">
                                                        <input name="tgl_kerjasama" class="form-control" type="date" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-xs-3">Lembaga Mitra</label>
                                                    <div class="col-xs-8">
                                                        <input name="lembaga_mitra" class="form-control" type="text" placeholder="Lembaga Mitra..." required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-xs-3">Alamat</label>
                                                    <div class="col-xs-8">
                                                        <input name="alamat_mitra" class="form-control" type="text" placeholder="Alamat..." required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-xs-3">Negara</label>
                                                    <div class="col-xs-8">
                                                        <input name="negara" class="form-control" type="text" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlSelect1">Pilih Provinsi</label>
                                                    <select class="form-control" id="provinsi" name="provinsi">
                                                        <option value="">-Pilih Provinsi-</option>
                                                        <?php
                                                        if ($provinsi['rajaongkir']['status']['code'] == '200') {
                                                            foreach ($provinsi['rajaongkir']['results'] as $pv) {
                                                                echo "<option value = '$pv[province_id]'> $pv[province] </option>";
                                                            }
                                                        }

                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlSelect1">Pilih Kota</label>
                                                    <select class="form-control" id="kota_kab" name="kota_kab">
                                                        <option>-Pilih Provinsi Dulu-</option>

                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-xs-3">Durasi Kerjasama (Tahun)</label>
                                                    <div class="col-xs-8">
                                                        <input name="durasi_kerjasama" class="form-control" type="text" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-xs-3">Dokumen Kerjasama</label>
                                                    <div class="col-xs-8">
                                                        <input name="file_dok" class="form-control" type="file" accept=".pdf , .doc , .docx , .png , .jpeg , .jpg , .pptx" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                                                <button class="btn btn-info">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--END MODAL ADD-->

                            <!-- ============ MODAL EDIT =============== -->
                            <?php
                            $no++;
                            foreach ($kerjasama as $krjsm) : $no++; ?>
                                <div class="modal fade" id="modal_edit-<?php echo $krjsm->id_kerjasama;  ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-secondary text-white">
                                                <h3 class="modal-title" id="myModalLabel">Edit Kerjasama</h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                            </div>
                                            <form class="form-horizontal" method="post" action="<?php echo base_url('tu/kerjasama/edit_kerjasama') ?>">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-3">Jenis Kerjasama</label>
                                                        <select name="jenis_kerjasama" class="form-control" required>
                                                            <option value="">--Pilih--</option>
                                                            <option <?php if ($krjsm->jenis_kerjasama == "MOU") {
                                                                        echo "selected";
                                                                    } ?> value="MOU">MOU</option>
                                                            <option <?php if ($krjsm->jenis_kerjasama == "MOA") {
                                                                        echo "selected";
                                                                    } ?> value="MOA">MOA</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-3">Tanggal Kerjasama</label>
                                                        <div class="col-xs-8">
                                                            <input name="tgl_kerjasama" value="<?php echo $krjsm->tgl_kerjasama ?>" class="form-control" type="date" required>
                                                            <input name="id_kerjasama" value="<?php echo $krjsm->id_kerjasama;  ?>" class="form-control" type="hidden">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-3">Lembaga Mitra</label>
                                                        <div class="col-xs-8">
                                                            <input name="lembaga_mitra" class="form-control" type="text" value="<?php echo $krjsm->lembaga_mitra ?>" placeholder="Lembaga Mitra..." required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-3">Alamat</label>
                                                        <div class="col-xs-8">
                                                            <input name="alamat_mitra" class="form-control" type="text" value="<?php echo $krjsm->alamat_mitra ?>" placeholder="Alamat..." required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-3">Negara</label>
                                                        <div class="col-xs-8">
                                                            <input name="negara" class="form-control" type="text" value="<?php echo $krjsm->negara ?>" placeholder="Alamat..." required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-3">Provinsi</label>
                                                        <div class="col-xs-8">
                                                            <input id="provinsi" name="provinsi" class="form-control" type="text" value="<?php echo $krjsm->provinsi ?>" placeholder="Alamat..." required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-3">Kota/Kabupaten</label>
                                                        <div class="col-xs-8">
                                                            <input id="kota_kab" name="kota_kab" class="form-control" type="text" value="<?php echo $krjsm->kota_kab ?>" placeholder="Alamat..." required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-3">Durasi Kerjasama (Tahun)</label>
                                                        <div class="col-xs-8">
                                                            <input name="durasi_kerjasama" value="<?php echo $krjsm->durasi_kerjasama ?>" class="form-control" type="text" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                                                    <button class="btn btn-secondary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                            <!--END MODAL ADD-->

                            <!-- ============ MODAL HAPUS =============== -->
                            <?php
                            foreach ($kerjasama as $krjsm) : ?>
                                <div class="modal fade" id="modal_hapus-<?php echo $krjsm->id_kerjasama; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h3 class="modal-title" id="myModalLabel">Hapus Kerjasama</h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                            </div>
                                            <form class="form-horizontal" method="post" action="<?php echo base_url() . 'tu/kerjasama/hapus_kerjasama' ?>">
                                                <div class="modal-body">
                                                    <p>Anda yakin ingin menghapus kerjasama dengan <b><?php echo $krjsm->lembaga_mitra; ?></b>?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="id_kerjasama" value="<?php echo $krjsm->id_kerjasama; ?>">
                                                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                                                    <button class="btn btn-danger">Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <!--END MODAL HAPUS -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('provinsi').addEventListener('change', function() {
            fetch("<?= base_url('tu/kerjasama/kota/') ?>" + this.value, {
                    method: 'GET',
                }).then((response) => response.text())
                .then((data) => {
                    console.log(data)
                    document.getElementById('kota_kab').innerHTML = data
                })
        })
    </script>