<table width="500%" border="0">
	<center>
		<div>
			<div class="col-lg-13 mb-2">
				<tr>
					<td>
						<img src="<?php echo base_url('assets/img/blank.PNG') ?>" width="200%">
					</td>
					<td>
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<marquee><h3 class="m-0 font-weight-bold text-primary">Selamat Datang  di Sistem Pelaporan Akademik Ujian Fakultas Teknik (SiPA-FT) Universitas Islam Riau..</h3></marquee>
							</div>
							<?php echo $this->session->flashdata('messege'); ?>
							<div class="card-body " >
								<?php 
								if($this->m_pembimbing_lapangan->cekResponNilai_pembimbing_lapangan($_SESSION['id_syarat_sk'])>0){
									echo '<h5 class="modal-title" id="exampleModalLabel"><b class="text-primary">Terima kasih telah menginputkan nilai mahasiswa Kerja Praktek..</b></h5>';
									echo '<br>' ?>
									<center><a class="btn btn-success" href="<?php echo site_url().'/logout'?>">Keluar</a></center>
									<?php
								}else{
									?>
									<center>
									<h5 class="modal-title" id="exampleModalLabel"><b class="text-primary">Silahkan Inputkan Nilai Mahasiswa..<br><small class="text-primary">Bobot Nilai 60%</small></b></h5></center>
									<form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/pembimbing_lapangan_kp/penilaian_kp/nilai_pembimbing_lapangan')?>">
										<div class="form-group text-left">
											<label>Kepribadian<small class="text-primary"> (Nilai 0-100)</small></label>
											<input type="number" required="" name="kepribadian" class="form-control" data-toggle="tooltip" data-placement="right" title="
											===== (Nilai<=60) ===== 
											Tidak mampu menunjukkan Kepribadian yang baik, sopan santun selama pelaksanaan KP
											Tidak mampu berkomunikasi dengan baik sering acuh tak acuh selama proses Pelaksanaan KP ---

											== (Nilai>60 & Nilai<=70) ==
											Kurang mampu menunjukkan Kepribadian yang baik, sopan santun selama pelaksanaan KP
											Kurang mampu berkomunikasi dengan baik sering acuh tak acuh selama proses Pelaksanaan KP ---

											== (Nilai>70 & Nilai<=80) ==
											Mampu menunjukkan Kepribadian yang baik, sopan santun selama pelaksanaan KP
											Mampu berkomunikasi dengan baik selama proses Pelaksanaan KP -------------

											===== (Nilai>80) =====
											Mampu menunjukkan sikap dan kedisiplinan yang sangat baik selama pengerjaan laporan KP, 
											Mampu berkomunikasi dengan sangat baik selama proses  Pelaksanaan KP"></input>
											<script>
												$(document).ready(function(){
													$('[data-toggle="tooltip"] ').tooltip();
												})
											</script>
											<small class="text-primary">Bobot 10%</small>
										</div>
										<div class="form-group text-left">
											<label>Kedisiplinan,Kehadiran<small class="text-primary"> (Nilai 0-100)</small></label>
											<input type="number" required="" name="kedisiplinan" class="form-control" data-toggle="tooltip" data-placement="right" title="
											===== (Nilai<=60) =====
											Tidak mampu menunjukkan sikap dan kedisiplinan yang baik Selama pelaksanaan KP, 
											Sering tidak hadir selama masa pelaksanaan KP atau kehadiran kurang dari 50% waktu KP ------------------

											== (Nilai>60 & Nilai<=70) ==
											Kurang mampu menunjukkan sikap dan kedisiplinan yang baik Selama pelaksanaan KP 
											Sering tidak hadir selama masa pelaksanaan KP atau kehadiran 50-70% waktu Pelaksanaan KP -------------

											== (Nilai>70 & Nilai<=80) ==
											Mampu menunjukkan sikap dan kedisiplinan yang baik selama pelaksanaan KP,
											Tingkat kehadiran 70–80%

											===== (Nilai>80) =====
											Mampu menunjukkan sikap dan kedisiplinan yang sangat baik selama pelaksanaan KP
											Tingkat kehadiran > 80 %"></input>
											<small class="text-primary">Bobot 10%</small>
										</div>
										<div class="form-group text-left">
											<label>Motivasi/Inisiatif<small class="text-primary"> (Nilai 0-100)</small></label>
											<input type="number" required="" name="motivasi" class="form-control" data-toggle="tooltip" data-placement="right" title="
											===== (Nilai<=60) ===== 
											Tidak memiliki motivasi dan inisiatif dalam melaksanakan pekerjaan pada saat pelaksanaan KP -------------

											== (Nilai>60 & Nilai<=70) ==
											Kurang  memiliki motivasi dan inisiatif dalam melaksanakan pekerjaan pada saat pelaksanaan KP

											== (Nilai>70 & Nilai<=80) ==
											Memiliki motivasi dan inisiatif dalam melaksanakan pekerjaan pada saat pelaksanaan KP -------------

											===== (Nilai>80) ===== 
											Sangat memiliki jiwa motivasi dan inisiatif dalam melaksanakan pekerjaan pada saat pelaksanaan KP"></input>
											<small class="text-primary">Bobot 10%</small>
										</div>
										<div class="form-group text-left">
											<label>Tanggung Jawab<small class="text-primary"> (Nilai 0-100)</small></label>
											<input type="number" required="" name="tanggung_jawab" class="form-control" data-toggle="tooltip" data-placement="right" title="
											===== (Nilai<=60) =====
											Tidak memiliki rasa tanggung jawab terhdapa pekerjaan yang diberikan pada saat pelaksanaan KP

											== (Nilai>60 & Nilai<=70) ==
											Kurang  memiliki rasa tanggung jawab terhdapa pekerjaan yang diberikan pada saat pelaksanaan KP

											== (Nilai>70 & Nilai<=80) ==
											Memiliki rasa tanggung jawab terhdapa pekerjaan yang diberikan pada saat pelaksanaan KP -------------

											===== (Nilai>80) =====
											Sangat memiliki rasa tanggung jawab terhdapa pekerjaan yang diberikan pada saat pelaksanaan KP" ></input>
											<small class="text-primary">Bobot 20%</small>
										</div> 
										<div class="form-group text-left">
											<label>Komitmen<small class="text-primary"> (Nilai 0-100)</small></label>
											<input type="number" required="" name="komitmen" class="form-control" data-toggle="tooltip" data-placement="right" title="
											===== (Nilai<=60) =====
											Tidak memiliki komitmen yang tinggi terhadap segala hal dalam pelaksanaan KP baik yang diperintahkan oleh pembimbing lapangan maupun hal – hal yang menjadi inisiatif sendiri -----

											== (Nilai>60 & Nilai<=70) ==
											Kurang memiliki komitmen yang tinggi terhadap segala hal dalam pelaksanaan KP baik yang diperintahkan oleh pembimbing lapangan maupun hal – hal yang menjadi inisiatif sendiri -----

											== (Nilai>70 & Nilai<=80) ==
											Memiliki komitmen yang tinggi terhadap segala hal dalam pelaksanaan KP baik yang diperintahkan oleh pembimbing lapangan maupun hal – hal yang menjadi inisiatif sendiri -----

											===== (Nilai>80) =====
											Sangat memiliki komitmen yang tinggi terhadap segala hal dalam pelaksanaan KP baik yang diperintahkan oleh pembimbing lapangan maupun hal – hal yang menjadi inisiatif sendiri"></input>
											<small class="text-primary">Bobot 10%</small>
										</div> 
										<div class="form-group text-left">
											<label>Kerja sama (Termasuk hubungan dengan Staff Setempat)<small class="text-primary"> (Nilai 0-100)</small></label>
											<input type="number" required="" name="kerjasama" class="form-control" data-toggle="tooltip" data-placement="right" title="
											===== (Nilai<=60) =====
											Tidak mampu bekerjasama baik dengan rekan sesama KP maupun rekanan di tempat pelaksanaan KP ----

											== (Nilai>60 & Nilai<=70) ==
											Kurang mampu bekerjasama baik dengan rekan sesama KP maupun rekanan di tempat pelaksanaan KP ----

											== (Nilai>70 & Nilai<=80) ==
											Mampu bekerjasama baik dengan rekan sesama KP maupun rekanan di tempat pelaksanaan KP ------------

											===== (Nilai>80) =====
											Sangat mampu dan senang untuk bekerjasama baik dengan rekan sesama KP maupun rekanan di tempat pelaksanaan KP"></input>
											<small class="text-primary">Bobot 10%</small>
										</div>
										<div class="form-group text-left">
											<label>Keselamatan Kerja<small class="text-primary"> (Nilai 0-100)</small></label>
											<input type="number" required="" name="keselamatan" class="form-control"  data-toggle="tooltip" data-placement="right" title="
											===== (Nilai<=60) =====
											Tidak mampu menerapkan hal-hal yang menjadi standar dalam keselamatan kerja pada lokasi pelaksnaan KP,
											Tidak Pernah menggunakan alat-alat pelaksanaan keselamatan kerja pada lokasi KP seperti helm, sepatu safety dan lainnya ---

											== (Nilai>60 & Nilai<=70) ==
											Kurang mampu menerapkan hal-hal yang menjadi standar dalam keselamatan kerja pada lokasi pelaksnaan KP,
											Kurang dalam menggunakan alat-alat pelaksanaan keselamatan kerja pada lokasi KP seperti helm, sepatu safety dan lainnya ---

											== (Nilai>70 & Nilai<=80) ==
											Mampu menerapkan hal-hal yang menjadi standar dalam keselamatan kerja pada lokasi pelaksnaan KP,
											Sering menggunakan alat-alat pelaksanaan keselamatan kerja pada lokasi KP seperti helm, sepatu safety dan lainnya ----------------

											===== (Nilai>80) =====
											Sangat mampu menerapkan hal-hal yang menjadi standar dalam keselamatan kerja pada lokasi pelaksnaan KP,
											Selalu menggunakan alat-alat pelaksanaan keselamatan kerja pada lokasi KP seperti helm, sepatu safety dan lainnya
											"></input>
											<small class="text-primary">Bobot 10%</small>
										</div> 
										<div class="form-group text-left">
											<label>Laporan<small class="text-primary"> (Nilai 0-100)</small></label>
											<input type="number" required="" name="laporan" class="form-control" data-toggle="tooltip" data-placement="right" title="
											===== (Nilai<=60) =====
											Tidak mampu mengerjakan dan berkomunikasi terkait laporan pada masa pelaksanaan KP ------------

											== (Nilai>60 & Nilai<=70) ==
											Kurang mampu mengerjakan dan berkomunikasi terkait laporan pada masa pelaksanaan KP ------------

											== (Nilai>70 & Nilai<=80) ==
											Mampu mengerjakan dan berkomunikasi terkait laporan pada masa pelaksanaan KP ------------

											===== (Nilai>80) =====
											Sangat mampu mengerjakan dan berkomunikasi terkait laporan pada masa pelaksanaan KP serta laporan yang dibuat sangat bagus
											"></input>
											<small class="text-primary">Bobot 20%</small>
										</div>                                  
										<div class="modal-footer">
											<a class="btn btn-danger" href="<?php echo site_url().'/logout'?>">Keluar</a>
											<button class="btn btn-primary" type="submit" name="tombolNilaiPembimbingLapangan">Simpan</button>
										</div>
									</form>   
									<?php } ?>                  
								</div>
							</div>
						</td>
						<td>
						<img src="<?php echo base_url('assets/img/blank.PNG') ?>" width="200%">
						</td>
					</tr>
				</div>
			</div>
		</center>
	</table>

