		
		<div class="main-panel">
          <div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h1 class="text-white pb-2 fw-bold">MONITORING PENGAWAS</h1>
								<h5 class="text-white op-7 mb-2">Fakultas Teknik Universitas Islam Riau</h5>
							</div>
							<div class="ml-md-auto py-2 py-md-0">
								<h1 align="right">
									
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
									
									<div class="row">
										
										<div class="col-md-12 bg-light rounded">
											<form action="<?php echo base_url('fakultas/monitoring_pengawas')?>" method="post">
												<div class="row">
													<div class="col-md-5">
														<div class="form-group text-left">
															<label class="control-label col-xs-3" >PROGRAM STUDI</label>
															<select name="kode_prodi" class="form-control" required>
																<option value="">--Pilih--</option>
																<?php
																	foreach($combobox_prodi->result_array() as $i):
																		$kode_prodi_combo=$i['kode_prodi'];
																		$nama_prodi_combo=$i['nama_prodi'];
																?>
																<option  value="<?php echo $kode_prodi_combo ?>" <?php if(isset($_SESSION['kode_prodi'])){if($_SESSION['kode_prodi']==$kode_prodi_combo){ echo 'selected';}}?>>
																	<?php echo $nama_prodi_combo; ?>
																</option>
																<?php endforeach;?>
															</select>
														</div>
													</div>
													<div class="col-md-5">
														<div class="form-group text-left">
															<label class="control-label col-xs-3" >UJIAN</label>
															<select name="id_ujian" class="form-control" required>
																<option value="">--Pilih--</option>
																<?php
																	foreach($combobox_ujian->result_array() as $i):
																		$id_ujian_combo=$i['id_ujian'];
																		$tahun_ajaran_combo=$i['tahun_ajaran'];
																		$nama_ujian_combo=$i['nama_ujian'];
																		$jenis_ujian_combo=$i['ket_ujian'];
																		$semester_combo=$i['semester'];
																?>
																<option  value="<?php echo $id_ujian_combo ?>" <?php if(isset($_SESSION['id_ujian_search'])){if($_SESSION['id_ujian_search']==$id_ujian_combo){ echo 'selected';}}?>>
																	<?php echo $tahun_ajaran_combo.'->'.$semester_combo.'->'.$nama_ujian_combo.'('.$jenis_ujian_combo.')'; ?>
																</option>
																<?php endforeach;?>
															</select>
														</div>
														
													</div>
													<div class="col-md-2">
														
														<div class="form-group text-left">
															<label class="control-label col-xs-3">AKSI</label>
															<input type="submit" name="tombol_cari" value="Cari Sekarang" class="btn btn-primary">
														</div>
														
													</div>
												</div>
											</form>
											<hr>
											<?php if(isset($_SESSION['kode_prodi']) && isset($_SESSION['id_ujian_search'])){ 

												$nilai1 = $this->m_permintaan_verifikasi->count_total_semua($_SESSION['kode_prodi'], $_SESSION['id_ujian_search']);
												$nilai2 = $this->m_permintaan_verifikasi->count_total_ujian($_SESSION['kode_prodi'], $_SESSION['id_ujian_search']);
												$nilai3 = $this->m_permintaan_verifikasi->count_total_sudah_submit($_SESSION['kode_prodi'], $_SESSION['id_ujian_search']);
												$nilai4 = $this->m_permintaan_verifikasi->count_total_belum_submit($_SESSION['kode_prodi'], $_SESSION['id_ujian_search']);
												$nilai5 = $this->m_permintaan_verifikasi->count_total_terverifikasi($_SESSION['kode_prodi'], $_SESSION['id_ujian_search']);
											?>
											
											<div class="row">
												<div class="col-md-3">
													<div class="card">
														<div class="card-header bg-info rounded text-center text-white">
															TOTAL PENGAWAS SEMUA KELAS
														</div>
														<div class="card-body bg-light rounded text-center">
															<h2><b>
																<?php
																	
																	if($nilai1 <= 0){
																		echo '0'.' ('.round(0).'%)';
																	}else{
																		echo $nilai1.' ('.round(($nilai1/$nilai1*100)).'%)';	
																	}
																?>
															</b></h2>
															
														</div>
													</div>
												</div>
												<div class="col-md-3">
													<div class="card">
														<div class="card-header bg-warning rounded text-center text-white">
															TOTAL SUDAH UJIAN
														</div>
														<div class="card-body bg-light rounded text-center">
															<h2><b>
																<?php
																	if($nilai2 <= 0){
																		echo '0'.' ('.round(0).'%)';
																	}else{
																		echo $nilai2.' ('.round(($nilai2/$nilai1*100)).'%)';	
																	}
																?>
															</b></h2>
															
														</div>
													</div>
												</div>
												<div class="col-md-3">
													<div class="card">
														<div class="card-header bg-primary rounded text-center text-white">
															TOTAL SUDAH SUBMIT
														</div>
														<div class="card-body bg-light rounded text-center">
															<h2><b>
																<?php
																	if($nilai3 <= 0){
																		echo '0'.' ('.round(0).'%)';
																	}else{
																		echo $nilai3.' ('.round(($nilai3/$nilai1*100)).'%)';	
																	}
																	
																?>
															</b></h2>
															
														</div>
													</div>
												</div>
												<div class="col-md-3">
													<div class="card">
														<div class="card-header bg-danger rounded text-center text-white">
															TOTAL BELUM SUBMIT
														</div>
														<div class="card-body bg-light rounded text-center">
															<h2><b>
																<?php
																	if($nilai4 <= 0){
																		echo '0'.' ('.round(0).'%)';
																	}else{
																		echo $nilai4.' ('.round(($nilai4/$nilai1*100)).'%)';	
																	}
																	
																?>
															</b></h2>
															
														</div>
													</div>
												</div>
												<div class="col-md-3">
													<div class="card">
														<div class="card-header bg-success rounded text-center text-white">
															TOTAL TERVERIFIKASI
														</div>
														<div class="card-body bg-light rounded text-center">
															<h2><b>
																<?php
																	
																	if($nilai5 <= 0){
																		echo '0'.' ('.round(0).'%)';
																	}else{
																		echo $nilai5.' ('.round(($nilai5/$nilai1*100)).'%)';	
																	}
																	
																?>
															</b></h2>
															
														</div>
													</div>
												</div>
											</div>
											<?php } ?>
										</div>
									</div>
																		
									<!-- <hr> -->
									<?php if(isset($_SESSION['kode_prodi']) && isset($_SESSION['id_ujian_search'])){ ?>
									<?php echo $this->session->flashdata('messege'); ?>
									<div class="table-responsive">
										<table class="table table-bordered table-striped" id="mydata" cellspacing="0" cellpadding="3" width="100%" style="width: 0px">
										<thead>
											<tr  class="bg-info">
												<td align="center"><b>NO</b></td>
												
																						
												<td align="center"><b>NAMA MATAKULIAH</b></td>
												<td align="center"><b>PENGAWAS 1</b></td>
												<td align="center"><b>STATUS PENGAWAS 1</b></td>
												<td align="center"><b>AKSI PENGAWAS 1</b></td>
												<td align="center"><b>PENGAWAS 2</b></td>	
												<td align="center"><b>STATUS PENGAWAS 2</b></td>
												<td align="center"><b>AKSI PENGAWAS 2</b></td>
											</tr>
										</thead>
										<tbody>
										<?php 
												$no = 1;
												foreach($data->result_array() as $i):
													$id_jadwal_lanjutan=$i['id_jadwal_lanjutan'];
													$npk_pengawas1=$i['npk_pengawas1'];
													$npk_pengawas2=$i['npk_pengawas2'];
													
													$nama_ujian=$i['nama_ujian'];
													$jenis_ujian=$i['ket_ujian'];
													$semester=$i['semester'];
													$kode_mk=$i['kode_matkul'];
													$tanggal_ujian=$i['tanggal_ujian'];
													$jam_mulai=$i['jam_mulai'];
													$jam_selesai=$i['jam_selesai'];
													

													$row = $this->m_permintaan_verifikasi->ambil_matkul($kode_mk);
													if(isset($row)){
														$nama_mk = $row->nama_mk;
													}
													else{
														$nama_mk = "Tidak diketahui";
													}
													$row = $this->m_permintaan_verifikasi->ambil_dosen1($npk_pengawas1);
													if(isset($row)){
														$nama_dosen1 = $row->nama_dosen;
													}
													else{
														$nama_dosen1 ="Tidak diketahui";
													}

													$row = $this->m_permintaan_verifikasi->ambil_dosen2($npk_pengawas2);
													if(isset($row)){
														$nama_dosen2 = $row->nama_dosen;
													}
													else{
														$nama_dosen2 ="Tidak diketahui";
													}

													$kode_ruang=$i['kode_ruang'];
													if($kode_ruang==""){
														$kode_ruang = "ONLINE";
													}
													
													$nama_kelas=$i['nama_kelas'];
													$jumlah_mahasiswa=$i['jumlah_mahasiswa'];
													$jam_absen_pengawas1=$i['jam_absen_pengawas1'];
													$jam_absen_pengawas2=$i['jam_absen_pengawas2'];
													$jam_submit_pengawas1=$i['jam_submit_pengawas1'];
													$jam_submit_pengawas2=$i['jam_submit_pengawas2'];
													$status_verifikasi_pengawas1=$i['status_verifikasi_pengawas1'];
													$status_verifikasi_pengawas2=$i['status_verifikasi_pengawas2'];
													$foto_bukti_pengawas1=$i['foto_bukti_pengawas1'];
													$foto_bukti_pengawas2=$i['foto_bukti_pengawas2'];
													$jenis_soal=$i['jenis_soal'];
													$media=$i['media'];
													$jumlah_mahasiswa_hadir=$i['jumlah_mahasiswa_hadir'];
													$ket_pelaksanaan=$i['ket_pelaksanaan'];													
													// $status=$i['status'];
													
													// mengurangi menit
													if(function_exists('date_default_timezone_set')) date_default_timezone_set('Asia/Jakarta');
													$date = date_create($jam_mulai);
													date_add($date, date_interval_create_from_date_string('-15 minutes'));
													$coming = date_format($date, 'H:i:s');
													
											?>
											<tr>
												<td><?php echo $no++;?></td>
												
												<td><?php echo $nama_mk;?></td>
												<td class="text-primary"><?php echo $nama_dosen1;?></td>
												<td>
													<?php
													if($npk_pengawas1!=""){
														if($jam_submit_pengawas1!="00:00:00" && $status_verifikasi_pengawas1=="Minta Verifikasi"){
															echo '<div class="button text-danger">Minta verifikasi</div>';
														}elseif($jam_submit_pengawas1!="00:00:00" && $status_verifikasi_pengawas1=="Terverifikasi"){
															echo '<div class="text-success text-center">Terverifikasi</div>';
														}elseif($jam_submit_pengawas1!="00:00:00" && $status_verifikasi_pengawas1=="Permintaan verifikasi ditolak"){
															echo '<div class="text-danger text-center">Permintaan verifikasi ditolak</div>';
														}else{
															echo '<div class="text-danger text-center">Belum melakukan submit</div>';
														}
													}
													else{
														echo '<div class="text-danger text-center">Pengawas 1 tidak tersedia</div>';
													}
													?>
												</td>
												<td>
													<?php
													if($npk_pengawas1!=""){
													?>
														<a class="btn btn-sm btn-info text-white" data-toggle="modal" data-target="#modal_detail_pengawas1<?php echo $id_jadwal_lanjutan;?>"><i class="fa fa-book"></i> Rincian</a>
														
													<?php 
													}
													else{
														echo '<div class="text-danger text-center">Pengawas 1 tidak tersedia</div>';
													}
													?>
													
												</td>

												<td class="text-primary"><?php echo $nama_dosen2;?></td>
												<td>
													<?php
													if($npk_pengawas2!=""){
														if($jam_submit_pengawas2!="00:00:00" && $status_verifikasi_pengawas2=="Minta Verifikasi"){
															echo '<div class="button text-danger">Minta verifikasi</div>';
														}elseif($jam_submit_pengawas2!="00:00:00" && $status_verifikasi_pengawas2=="Terverifikasi"){
															echo '<div class="text-success text-center">Terverifikasi</div>';
														}elseif($jam_submit_pengawas2!="00:00:00" && $status_verifikasi_pengawas2=="Permintaan verifikasi ditolak"){
															echo '<div class="text-danger text-center">Permintaan verifikasi ditolak</div>';
														}else{
															 echo '<div class="text-danger text-center">Belum melakukan submit</div>'; 
														}
													}
													else{
														echo '<div class="text-danger text-center">Pengawas 2 tidak tersedia</div>';
													}
													?>
												</td>
												<td>
													<?php
													if($npk_pengawas2!=""){
													?>
														<a class="btn btn-sm btn-info text-white" data-toggle="modal" data-target="#modal_detail_pengawas2<?php echo $id_jadwal_lanjutan;?>"><i class="fa fa-book"></i> Rincian</a>
													<?php 
													}
													else{
														echo '<div class="text-danger text-center">Pengawas 2 tidak tersedia</div>';
													}
													?>
													
												</td>
												
												
											</tr>
											<?php endforeach;?>
										</tbody>
									</table>
									</div>
									<?php }else{ ?>
										<h1 class="text-danger">SILAHKAN PILIH TERLEBIH DAHULU PRODI DAN TAHUN AJARAN...</h1>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>                    
			</div>
			


			<?php if(isset($_SESSION['kode_prodi']) && isset($_SESSION['id_ujian_search'])){ ?>
							<!-- ============ MODAL DETAIL 2 =============== -->
								<?php 
									foreach($data->result_array() as $i):
										$id_jadwal_lanjutan=$i['id_jadwal_lanjutan'];
										$npk_pengawas1=$i['npk_pengawas1'];
										$npk_pengawas2=$i['npk_pengawas2'];
										
										$nama_ujian=$i['nama_ujian'];
										$jenis_ujian=$i['ket_ujian'];
										$semester=$i['semester'];
										$kode_mk=$i['kode_matkul'];
										$row = $this->m_permintaan_verifikasi->ambil_matkul($kode_mk);
										if(isset($row)){
											$nama_mk = $row->nama_mk;
										}
										else{
											$nama_mk = "Tidak diketahui";
										}

										$row = $this->m_permintaan_verifikasi->ambil_dosen1($npk_pengawas1);
										if(isset($row)){
											$nama_dosen1 = $row->nama_dosen;
										}
										else{
											$nama_dosen1 ="Tidak diketahui";
										}

										$row = $this->m_permintaan_verifikasi->ambil_dosen2($npk_pengawas2);
										if(isset($row)){
											$nama_dosen2 = $row->nama_dosen;
										}
										else{
											$nama_dosen2 ="Tidak diketahui";
										}

										$tanggal_ujian=$i['tanggal_ujian'];
										$jam_mulai=$i['jam_mulai'];
										$jam_selesai=$i['jam_selesai'];
										

										$kode_ruang=$i['kode_ruang'];
										if($kode_ruang==""){
											$kode_ruang = "ONLINE";
										}

										$nama_kelas=$i['nama_kelas'];
										$jumlah_mahasiswa=$i['jumlah_mahasiswa'];
										$tanggal_absen_pengawas1=$i['tanggal_absen_pengawas1'];
										$tanggal_absen_pengawas2=$i['tanggal_absen_pengawas2'];
										$tanggal_submit_pengawas1=$i['tanggal_submit_pengawas1'];
										$tanggal_submit_pengawas2=$i['tanggal_submit_pengawas2'];

										$jam_absen_pengawas1=$i['jam_absen_pengawas1'];
										$jam_absen_pengawas2=$i['jam_absen_pengawas2'];
										$jam_submit_pengawas1=$i['jam_submit_pengawas1'];
										$jam_submit_pengawas2=$i['jam_submit_pengawas2'];
										$foto_bukti_pengawas1=$i['foto_bukti_pengawas1'];
										$foto_bukti_pengawas2=$i['foto_bukti_pengawas2'];
										$jenis_soal=$i['jenis_soal'];
										$media=$i['media'];
										$jumlah_mahasiswa_hadir=$i['jumlah_mahasiswa_hadir'];
										$ket_pelaksanaan=$i['ket_pelaksanaan'];
										
										// $status=$i['status'];

									?>
									<div class="modal fade" id="modal_detail_pengawas2<?php echo $id_jadwal_lanjutan;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
										<div class="modal-dialog">
										<div class="modal-content">
										<div class="modal-header bg-info text-white">
											<h3 class="modal-title" id="myModalLabel">Detail Pengawas 2</h3>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
										</div>
										<form class="form-horizontal" method="post" action="<?php echo base_url().'dosen/permintaan_verifikasi/batal_submit'?>">
											<div class="modal-body">
												<table class="table">
													<tr>
														<td colspan="3" class="text-center bg-warning"><h1><?php echo $nama_dosen2?></h1></td>
													</tr>

													<tr class="text-primary">
														<td>Jadwal Ujian</td>
														<td>:</td>
														<td><?php echo $tanggal_ujian.' '.$jam_mulai ?></td>
													</tr>
													
													<tr class="text-primary">
														<td>Waktu hadir</td>
														<td>:</td>
														<td><?php echo $tanggal_absen_pengawas2.' '.$jam_absen_pengawas2?></td>
													</tr>
													<tr class="text-primary">
														<td>Waktu submit</td>
														<td>:</td>
														<td><?php echo $tanggal_submit_pengawas2.' '.$jam_submit_pengawas2?></td>
													</tr>
												
													<tr>
														<td>Matakuliah</td>
														<td>:</td>
														<td><?php echo $nama_mk?></td>
													</tr>
													<tr>
														<td>Kode ruang</td>
														<td>:</td>
														<td><?php echo $kode_ruang?></td>
													</tr>
													<tr>
														<td>Nama kelas</td>
														<td>:</td>
														<td><?php echo $nama_kelas?></td>
													</tr>
													<tr>
														<td>Total mahasiswa</td>
														<td>:</td>
														<td><?php echo $jumlah_mahasiswa?> orang</td>
													</tr>
													
													<tr>
														<td colspan="3"><b>Data yang diinpukan pengawas</b></td>
													</tr>
													<tr>
														<td>Jenis soal</td>
														<td>:</td>
														<td><?php echo $jenis_soal?></td>
													</tr>
													<tr>
														<td>Media</td>
														<td>:</td>
														<td><?php echo $media?></td>
													</tr>
													<tr>
														<td>Jumlah mahasiswa hadir</td>
														<td>:</td>
														<td><?php echo $jumlah_mahasiswa_hadir?> orang</td>
													</tr>
													<tr>
														<td>Jumlah mahasiswa alfa</td>
														<td>:</td>
														<td><?php echo max(($jumlah_mahasiswa-$jumlah_mahasiswa_hadir),0) ?> orang</td>
													</tr>
													<tr>
														<td>Hasil pelaksanaan</td>
														<td>:</td>
														<td><?php echo $ket_pelaksanaan?></td>
													</tr>
													<tr>
														<td colspan="3">Foto bukti mengawas</td>
													</tr>
													<?php
															 if($foto_bukti_pengawas2==""){
													?>
														<tr>
															<td colspan="3"><p class="text-danger">Maaf, Foto bukti belum tersedia!</p></td>
														</tr>
													<?php
															 }else{
													?>
														<tr>
															<td colspan="3"><img width="100%" src="<?php echo base_url('templates/img/bukti-mengawas/').$foto_bukti_pengawas2?>" alt=""></td>
														</tr>
													<?php
															 }
													?>											

												</table>
											</div>
											<div class="modal-footer">
												<button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
											</div>
										</form>
										</div>
										</div>
									</div>

								<?php endforeach;?>
								<!--END MODAL DETAIL 2-->

								<!-- ============ MODAL DETAIL 1 =============== -->
								<?php 
									foreach($data->result_array() as $i):
										$id_jadwal_lanjutan=$i['id_jadwal_lanjutan'];
										$npk_pengawas1=$i['npk_pengawas1'];
										$npk_pengawas2=$i['npk_pengawas2'];
										
										$nama_ujian=$i['nama_ujian'];
										$jenis_ujian=$i['ket_ujian'];
										$semester=$i['semester'];
										$kode_mk=$i['kode_matkul'];
										$row = $this->m_permintaan_verifikasi->ambil_matkul($kode_mk);
										if(isset($row)){
											$nama_mk = $row->nama_mk;
										}
										else{
											$nama_mk = "Tidak diketahui";
										}

										$row = $this->m_permintaan_verifikasi->ambil_dosen1($npk_pengawas1);
										if(isset($row)){
											$nama_dosen1 = $row->nama_dosen;
										}
										else{
											$nama_dosen1 ="Tidak diketahui";
										}

										$row = $this->m_permintaan_verifikasi->ambil_dosen2($npk_pengawas2);
										if(isset($row)){
											$nama_dosen2 = $row->nama_dosen;
										}
										else{
											$nama_dosen2 ="Tidak diketahui";
										}

										$tanggal_ujian=$i['tanggal_ujian'];
										$jam_mulai=$i['jam_mulai'];
										$jam_selesai=$i['jam_selesai'];
										
										$kode_ruang=$i['kode_ruang'];
										if($kode_ruang==""){
											$kode_ruang = "ONLINE";
										}

										$nama_kelas=$i['nama_kelas'];
										$jumlah_mahasiswa=$i['jumlah_mahasiswa'];
										$tanggal_absen_pengawas1=$i['tanggal_absen_pengawas1'];
										$tanggal_absen_pengawas2=$i['tanggal_absen_pengawas2'];
										$tanggal_submit_pengawas1=$i['tanggal_submit_pengawas1'];
										$tanggal_submit_pengawas2=$i['tanggal_submit_pengawas2'];

										$jam_absen_pengawas1=$i['jam_absen_pengawas1'];
										$jam_absen_pengawas2=$i['jam_absen_pengawas2'];
										$jam_submit_pengawas1=$i['jam_submit_pengawas1'];
										$jam_submit_pengawas2=$i['jam_submit_pengawas2'];
										$foto_bukti_pengawas1=$i['foto_bukti_pengawas1'];
										$foto_bukti_pengawas2=$i['foto_bukti_pengawas2'];
										$jenis_soal=$i['jenis_soal'];
										$media=$i['media'];
										$jumlah_mahasiswa_hadir=$i['jumlah_mahasiswa_hadir'];
										$ket_pelaksanaan=$i['ket_pelaksanaan'];
										
										// $status=$i['status'];

									?>
									<div class="modal fade" id="modal_detail_pengawas1<?php echo $id_jadwal_lanjutan;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
										<div class="modal-dialog">
										<div class="modal-content">
										<div class="modal-header bg-info text-white">
											<h3 class="modal-title" id="myModalLabel">Detail Pengawas 1</h3>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
										</div>
										<form class="form-horizontal" method="post" action="<?php echo base_url().'dosen/permintaan_verifikasi/batal_submit'?>">
											<div class="modal-body">
												<table class="table">
													<tr>
														<td colspan="3" class="text-center bg-warning"><h1><?php echo $nama_dosen1?></h1></td>
													</tr>
													<tr class="text-primary">
														<td>Jadwal Ujian</td>
														<td>:</td>
														<td><?php echo $tanggal_ujian.' '.$jam_mulai ?></td>
													</tr>
													<tr class="text-primary">
														<td>Waktu hadir</td>
														<td>:</td>
														<td><?php echo $tanggal_absen_pengawas1.' '.$jam_absen_pengawas1?></td>
													</tr>
													<tr class="text-primary">
														<td>Waktu submit</td>
														<td>:</td>
														<td><?php echo $tanggal_submit_pengawas1.' '.$jam_submit_pengawas1?></td>
													</tr>
												
													<tr>
														<td>Matakuliah</td>
														<td>:</td>
														<td><?php echo $nama_mk?></td>
													</tr>
													<tr>
														<td>Kode ruang</td>
														<td>:</td>
														<td><?php echo $kode_ruang?></td>
													</tr>
													<tr>
														<td>Nama kelas</td>
														<td>:</td>
														<td><?php echo $nama_kelas?></td>
													</tr>
													<tr>
														<td>Total mahasiswa</td>
														<td>:</td>
														<td><?php echo $jumlah_mahasiswa?> orang</td>
													</tr>
													
													<tr>
														<td colspan="3"><b>Data yang diinpukan pengawas</b></td>
													</tr>
													<tr>
														<td>Jenis soal</td>
														<td>:</td>
														<td><?php echo $jenis_soal?></td>
													</tr>
													<tr>
														<td>Media</td>
														<td>:</td>
														<td><?php echo $media?></td>
													</tr>
													<tr>
														<td>Jumlah mahasiswa hadir</td>
														<td>:</td>
														<td><?php echo $jumlah_mahasiswa_hadir?> orang</td>
													</tr>
													<tr>
														<td>Jumlah mahasiswa alfa</td>
														<td>:</td>
														<td><?php echo max(($jumlah_mahasiswa-$jumlah_mahasiswa_hadir),0) ?> orang</td>
													</tr>
													<tr>
														<td>Hasil pelaksanaan</td>
														<td>:</td>
														<td><?php echo $ket_pelaksanaan?></td>
													</tr>
													<tr>
														<td colspan="3">Foto bukti mengawas</td>
													</tr>
													<?php
															 if($foto_bukti_pengawas1==""){
													?>
														<tr>
															<td colspan="3"><p class="text-danger">Maaf, Foto bukti belum tersedia!</p></td>
														</tr>
													<?php
															 }else{
													?>
														<tr>
															<td colspan="3"><img width="100%" src="<?php echo base_url('templates/img/bukti-mengawas/').$foto_bukti_pengawas1?>" alt=""></td>
														</tr>
													<?php
															 }
													?>
													
												</table>
											</div>
											<div class="modal-footer">
												<button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
											</div>
										</form>
										</div>
										</div>
									</div>

								<?php endforeach;?>
								<!--END MODAL DETAIL 1-->

								
		<?php } ?>
							
										
									