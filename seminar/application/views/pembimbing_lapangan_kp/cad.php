	<?php echo $this->session->flashdata('messege'); ?>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<marquee><h3 class="m-0 font-weight-bold text-primary">Selamat Datang  di Sistem Pelaporan Akademik Ujian Fakultas Teknik (SiPA-FT) Universitas Islam Riau</h3></marquee>
		</div>
		<div class="content">
			<table border="0">
				<tr>
					<td width="25%">
						<div class="card shadow mb-4">
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
										<h5 class="modal-title"><b class="text-primary">Silahkan Input Nilai Mahasiswa<br></b></h5></center>
										<form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/pembimbing_lapangan_kp/penilaian_kp/nilai_pembimbing_lapangan')?>">
											<div class="form-group text-left">
												<label>Kepribadian<small class="text-primary"> (Nilai 0-100)</small></label>
												<input type="number" name="kepribadian" class="form-control"></input><small class="text-primary">Bobot 10%</small>
											</div>
											<div class="form-group text-left">
												<label>Kedisiplinan,Kehadiran<small class="text-primary"> (Nilai 0-100)</small></label>
												<input type="number" name="kedisiplinan" class="form-control"></input>
												<small class="text-primary">Bobot 10%</small>
											</div>
											<div class="form-group text-left">
												<label>Motivasi/Inisiatif<small class="text-primary"> (Nilai 0-100)</small></label>
												<input type="number" name="motivasi" class="form-control" ></input>
												<small class="text-primary">Bobot 10%</small>
											</div>
											<div class="form-group text-left">
												<label>Tanggung Jawab<small class="text-primary"> (Nilai 0-100)</small></label>
												<input type="number" name="tanggung_jawab" class="form-control"></input>
												<small class="text-primary">Bobot 20%</small>
											</div> 
											<div class="form-group text-left">
												<label>Komitmen<small class="text-primary"> (Nilai 0-100)</small></label>
												<input type="number" name="komitmen" class="form-control" ></input>
												<small class="text-primary">Bobot 10%</small>
											</div> 
											<div class="form-group text-left">
												<label>Kerja sama (Termasuk hubungan dengan Staff Setempat)<small class="text-primary"> (Nilai 0-100)</small></label>
												<input type="number" name="kerjasama" class="form-control"></input>
												<small class="text-primary">Bobot 10%</small>
											</div>
											<div class="form-group text-left">
												<label>Keselamatan Kerja<small class="text-primary"> (Nilai 0-100)</small></label>
												<input type="number" name="keselamatan" class="form-control" ></input>
												<small class="text-primary">Bobot 10%</small>
											</div> 
											<div class="form-group text-left">
												<label>Laporan<small class="text-primary"> (Nilai 0-100)</small></label>
												<input type="number" name="laporan" class="form-control" ></input>
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
								
								<div class="table-responsive">Kepribadian
									<table class="table table-bordered" cellspacing="0">
										<thead class="table table-primary">
											<tr>
												<td align="center"><b>Nilai>80</b></td>
												<td align="center"><b>70 < Nilai <= 80</b></td>
												<td align="center"><b>60 < Nilai <= 70</b></td>
												<td align="center"><b>Nilai <= 60</b></td>
											</tr>
										</thead>
										<tbody>
											<td>
												<ol>
													<li>Mampu menunjukkan sikap dan kedisiplinan yang sangat baik selama pengerjaan laporan KP</li>
													<li>Mampu berkomunikasi dengan sangat baik selama proses  Pelaksanaan KP</li>
												</ol>
											</td>
											<td>
												<ol>
													<li>Mampu menunjukkan Kepribadian yang baik, sopan santun selama pelaksanaan KP</li>
													<li>Mampu berrkomunikasi dengan baik selama proses Pelaksanaan KP</li>
												</ol>	
											</td>
											<td>
												<ol>
													<li>Kurang mampu menunjukkan Kepribadian yang baik, sopan santun selama pelaksanaan KP</li>
													<li>Kurang mampu berkomunikasi dengan baik sering acuh tak acuh selama proses Pelaksanaan KP</li>
												</ol>
											</td>
											<td>
												<ol>
													<li>Tidak mampu menunjukkan Kepribadian yang baik, sopan santun selama pelaksanaan KP</li>
													<li>Tidak mampu berkomunikasi dengan baik sering acuh tak acuh selama proses Pelaksanaan KP</li>
												</ol>
											</td>
										</tbody>
									</table>
								</div>
							</td>
						</tr>	
					</table>								
				</div>
			</div>