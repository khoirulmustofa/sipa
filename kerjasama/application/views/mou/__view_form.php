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
        <?php
        $attribute = array('role' => 'form', 'id' => 'my_form');
        echo form_open_multipart($action, $attribute);
        ?>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">                      
                        <div class="form-group">
                            <label for="date">Tanggal </label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" value="<?php echo $tanggal; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="varchar">Nama Lembaga Mitra </label>
                            <input type="text" class="form-control" name="nama_lembaga_mitra" id="nama_lembaga_mitra" placeholder="Nama Lembaga Mitra" value="<?php echo $nama_lembaga_mitra; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="int">Durasi </label>
                            <input type="text" class="form-control" name="durasi" id="durasi" placeholder="Durasi" value="<?php echo $durasi; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="varchar">Dokumen </label>
                            <input type="file" class="form-control" name="dokumen" id="dokumen" placeholder="Dokumen" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="negara_id">Negara</label>
                            <select class="form-control" id="negara_id" name="negara_id">
                                <option value="">--Pilih Negara--</option>
                                <?php foreach ($negara_result as $key => $value) { ?>
                                    <option value="<?php echo $value->id ?>" <?php echo $value->id == $negara_id ? "selected" : "" ?>>
                                        <?php echo $value->nama_negara ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div id="indonesia">
                            <div class="form-group">
                                <label for="varchar">Provinsi</label>
                                <select class="form-control" name="provinsi_id" id="provinsi_id">
                                    <option value="">Pilih provinsi</option>
                                    <?php foreach ($provinsi_result as $key1 => $value1) { ?>
                                        <option value="<?php echo $value1->master_provinsi_id ?>" <?php echo $value1->master_provinsi_id == $provinsi_id ? "selected" : "" ?>><?php echo $value1->province_name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="varchar">Kota Kabupaten</label>
                                <select class="form-control" name="kota_kabupaten_id" id="kota_kabupaten_id">
                                    <option value="">Pilih Kota Kabupaten</option>
                                    <?php if (count($kota_kabupaten_result) > 0) {
                                        foreach ($kota_kabupaten_result as $key2 => $value2) { ?>
                                            <option value="<?php echo $value2->master_kota_kabupaten_id ?>" <?php echo $value2->master_kota_kabupaten_id == $kota_kabupaten_id ? "selected" : "" ?>><?php echo $value2->kota_kabupaten_nama ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="varchar">Kota Kecamatan</label>
                                <select class="form-control" name="kecamatan_id" id="kecamatan_id">
                                    <option value="">Pilih Kecamatan</option>
                                    <?php foreach ($kecamatan_result as $key2 => $value3) { ?>
                                        <option value="<?php echo $value3->master_kecamatan_id ?>" <?php echo $value3->master_kecamatan_id == $kecamatan_id ? "selected" : "" ?>><?php echo $value3->kecamatan_nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="varchar">Kelurhan / Desa</label>
                                <select class="form-control" name="kelurahan_id" id="kelurahan_id">
                                    <option value="">Pilih Kelurhan / Desa</option>
                                    <?php foreach ($kelurahan_result as $key4 => $value4) { ?>
                                        <option value="<?php echo $value4->master_kelurahan_id ?>" <?php echo $value4->master_kelurahan_id == $kelurahan_id ? "selected" : "" ?>><?php echo $value4->kelurahan_nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat </label>
                            <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-action">
                <input type="hidden" name="id" value="<?= $id ?>">
                <a href="<?php echo base_url('mou') ?>" class="btn btn-default"><i class="far fa-window-close"></i> Batal</a>
                <button type="submit" class="btn btn-success float-right"><i class="far fa-save"></i> Simpan</button>
            </div>
        </div>
        <?php echo form_close() ?>
    </div>
</div>