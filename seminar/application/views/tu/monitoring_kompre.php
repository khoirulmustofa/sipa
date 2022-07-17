<div class="col-lg-12 mb-1">
	<?php echo $this->session->flashdata('messege'); ?>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h5 class="m-0 font-weight-bold text-primary">PENGAJUAN SIDANG SKRIPSI</h5>
		</div><br>
		<div class="content">
			<div class="container-fluid">
				<div class="card shadow mb-4">
					<div class="card-body">
						<form action="<?php echo site_url().'/tu/monitoring_kompre'; ?>" method="post" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>PILIH PRODI</label>
										<select name="kode_prodi" class="form-control" required>
											<option value="">
												--Pilih--
											</option>
											<option value="0" <?php if(!isset($_SESSION['kode_prodi'])){ echo 'selected'; } ?>>
												Semua
											</option>
											<?php foreach ($combobox_prodi as $item): ?>
												<option value="<?php echo $item['kode_prodi']  ?>" <?php if(isset($_SESSION['kode_prodi'])){ if($_SESSION['kode_prodi']==$item['kode_prodi']){ echo 'selected'; } } ?> ><?php echo $item['nama_prodi']  ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label>AKSI</label><br>
										<input type="submit" name="tombol_cari" value="Tampilkan Data" class="btn btn-primary">
									</div>
								</div>
							</div>
						</form><hr>
						<div class="table-responsive">
							<div class="scroll">
								<table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
									<thead class="table table-primary">
										<tr>
											<td align="center"><b>NO.</b></td>
											<td align="center"><b>NPM</b></td>
											<td align="center"><b>NAMA</b></td>
											<td align="center"><b>KEPERLUAN</b></td>
											<!-- <td align="center"><b>USULAN UJIAN</b></td> -->
											<td align="center"><b>DETAIL</b></td>
											<td align="center"><b>STATUS  DATA</b></td>
											<td align="center"><b>AKSI</b></td>
										</tr>
									</thead>
									<tbody>
										<?php 
										$no = 1;
										foreach ($pencarian_data as $i):
											$id_syarat_kompre	= $i['id_syarat_kompre'];
										$nama_mahasiswa = $i['nama_mahasiswa'];
										$nama_seminar   = $i['nama_seminar'];
										$npm            = $i['npm'];
										// $usulan_tanggal = $i['usulan_tanggal'];
										?>
										<tr>
											<td><?php echo $no++;?></td>
											<td><?php echo $npm;?></td>
											<td><?php echo ucwords($nama_mahasiswa); ?></td>
											<td><?php echo $nama_seminar;?></td>
											<!-- <td><?php echo $usulan_tanggal;?></td> -->
											<td>
												<i class="fas fa-eye text-primary" data-toggle="modal" data-target="#Modallihat<?php echo $id_syarat_kompre  ?>"></i>
											</td>
											<td>
												<?php
												$tema = "Pengecekan Berkas Persyaratan Sidang Skripsi Mahasiswa oleh Tata Usaha";
												$cekkompre = $this->m_monitoring_kompre->cekResponTU($id_syarat_kompre, $tema);
												if($this->m_monitoring_kompre->cekStatusPersetujuanTU($id_syarat_kompre, $tema, 'Berkas Disetujui')>0){
													echo '<b class="text-primary">Berkas Disetujui</b>';
												}elseif($this->m_monitoring_kompre->cekStatusPersetujuanTU($id_syarat_kompre, $tema, 'Berkas Ditolak')>0){
													echo '<b class="text-danger">Berkas Ditolak</b>';
												}elseif($cekkompre>0){
													echo '<b class="text-warning">Meminta Validasi Berkas</b>';
												}elseif($cekkompre==0){
													echo '<b class="text-warning">Meminta Validasi Berkas</b>';
												}else{
													echo '<b class="text-warning">Meminta Validasi Berkas</b>';
												}
												?>
											</td>
											<td>
												<?php 
												$tema = "Pengecekan Berkas Persyaratan Sidang Skripsi Mahasiswa oleh Tata Usaha";
												if ($this->m_monitoring_kompre->cekResponTU($id_syarat_kompre, $tema)<=0) {  
													if($this->m_monitoring_kompre->cekPersetujuanSemuaBerkas2($id_syarat_kompre)==1){    
														?>
														<input type="submit" id="setuju_final<?= $id_syarat_kompre ?>" name="tombol_setuju" value="Setujui" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modalsetuju<?php echo $id_syarat_kompre ?>">
														<input type="submit" id="tolak_final<?= $id_syarat_kompre ?>" name="tombol_tolak" value="Tolak" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modaltolak<?php echo $id_syarat_kompre ?>">

														<?php 
													}else{
														echo '<div id="text_final'.$id_syarat_kompre.'">Semua berkas belum disetujui</div>';
														?>
														<div id="tombol_final<?= $id_syarat_kompre ?>" hidden>
															<input type="submit" id="setuju_final<?= $id_syarat_kompre ?>" name="tombol_setuju" value="Setujui" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modalsetuju<?php echo $id_syarat_kompre ?>">
															<input type="submit" id="tolak_final<?= $id_syarat_kompre ?>" name="tombol_tolak" value="Tolak" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modaltolak<?php echo $id_syarat_kompre ?>">
														</div>
														<?php
													}
												}else{ 
													?>
													<i class="text-primary">Sudah Direspon</i>
													<?php } ?>
												</td>
											</tr>

											<?php 
											endforeach; 
											?> 
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- MODAL LIHAT DATA PENGAJUAN SK -->
	<?php 
	$no = 1;
	foreach ($pencarian_data as $i):
		$id_syarat_kompre	= $i['id_syarat_kompre'];
	$nama_mahasiswa = $i['nama_mahasiswa'];
	$nama_seminar   = $i['nama_seminar'];
	$npm            = $i['npm'];
	?>
	<div class="modal fade" id="Modallihat<?php echo $i['id_syarat_kompre']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Data Pengajuan Sidang Skripsi</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body"> 
					<div class="form-group">
						<label>Nama Mahasiswa</label>
						<input type="text" class="form-control" value="<?php echo ucwords($i['nama_mahasiswa']).' ('.$i['npm'].')'; ?>" readonly></input>
					</div>
					<div class="form-group">
						<label class="bmd-label-floating">Lihat Berkas</label><br>
						<table border="0" width="100%" cellspacing="1" cellpadding="2">
							<tr>
								<td>
									<a target="_BLANK" id="open_file1<?= $id_syarat_kompre ?>" href="<?php echo base_url('templates/file/mahasiswa/syarat_kompre/spp/'.$i['file_spp']) ?>">Bukti Pembayaran SPP</a><br>
								</td>
								<td class="text-center">
									<?php 
									$tema = "Pengecekan Berkas SPP untuk Persyaratan kompre Mahasiswa oleh Tata Usaha";
									if ($this->m_monitoring_kompre->cekResponTU($id_syarat_kompre, $tema)>0) { 
										?>
										<div>Sudah Direspon</div>
										<?php 
									}else{ 
										$open_file = "Pengecekan Berkas SPP untuk Persyaratan kompre Mahasiswa oleh Tata Usaha";
										if ($this->m_monitoring_kompre->cekOpenFile($id_syarat_kompre, $open_file)>0) {
											$hidden = "";
										}else{
											$hidden = "hidden";
										}
										?>
										<input type="submit" name="tombol_setuju" id="tombol_setuju_1<?= $id_syarat_kompre ?>" value="Setujui" class="btn btn-primary btn-sm" <?= $hidden ?> >
										<input data-toggle="modal" data-target="#ModaltolakSatuan1<?php echo $i['id_syarat_kompre'] ?>" type="button" id="tombol_tolak_1<?= $id_syarat_kompre ?>" value="Tolak" class="btn btn-danger btn-sm" <?= $hidden ?> >
										<div id="success_text_1<?= $id_syarat_kompre ?>"></div>
										<?php  } ?>
									</td>     
									<script>
										$(document).ready(function() {
											$('#open_file1<?= $id_syarat_kompre ?>').on('click', function() {
												var id_syarat_kompre = "<?= $id_syarat_kompre ?>";
												$.ajax({
													url: "<?php echo site_url("/tu/monitoring_kompre/open_file");?>",
													type: "POST",
													data: {
														id_syarat_kompre: id_syarat_kompre,
														file_open: 'Pengecekan Berkas SPP untuk Persyaratan kompre Mahasiswa oleh Tata Usaha',
													},
													cache: false,
													success: function(response){

														document.getElementById("tombol_setuju_1<?= $id_syarat_kompre ?>").hidden = false;
														document.getElementById("tombol_tolak_1<?= $id_syarat_kompre ?>").hidden = false;
													},
													error: function(XMLHttpRequest, textStatus, errorThrown) { 
														alert("Status: " + textStatus); alert("Error: " + errorThrown); 
													}  
												});
											});
										});

										$(document).ready(function() {
											$('#tombol_setuju_1<?= $id_syarat_kompre ?>').on('click', function() {
												var id_syarat_kompre = "<?= $id_syarat_kompre ?>";
												$.ajax({
													url: "<?php echo site_url("/tu/monitoring_kompre/setuju_berkas");?>",
													type: "POST",
													data: {
														id_syarat_kompre: id_syarat_kompre,
														status_persetujuan: 'Berkas Disetujui',
														tema_persetujuan: 'Pengecekan Berkas SPP untuk Persyaratan kompre Mahasiswa oleh Tata Usaha'
													},
													cache: false,
													success: function(response){  
														const jsonObject = JSON.parse(response);
														var hasil1 = jsonObject[0].hasil1;
														var hasil2 = jsonObject[0].hasil2;
														var hasil3 = jsonObject[0].hasil3;
														var hasil4 = jsonObject[0].hasil4;
														var hasil5 = jsonObject[0].hasil5;
														var hasil6 = jsonObject[0].hasil6;
														if(hasil1==1 && hasil2==1 && hasil3==1 && hasil4==1 && hasil5==1 && hasil6==1){
															document.getElementById("tombol_final<?= $id_syarat_kompre ?>").hidden = false;
															document.getElementById("text_final<?= $id_syarat_kompre ?>").hidden = true;
														}
														document.getElementById("success_text_1<?= $id_syarat_kompre ?>").innerText = "Sudah direspon";
														document.getElementById("tombol_setuju_1<?= $id_syarat_kompre ?>").hidden = true;
														document.getElementById("tombol_tolak_1<?= $id_syarat_kompre ?>").hidden = true;
													},
													error: function(XMLHttpRequest, textStatus, errorThrown) { 
														alert("Status: " + textStatus); alert("Error: " + errorThrown); 
													}   
												});
											});
										});

									</script>         
								</tr>

								<tr>
									<td>
										<a target="_BLANK" id="open_file2<?= $id_syarat_kompre ?>" href="<?php echo base_url('templates/file/mahasiswa/syarat_kompre/transkip/'.$i['file_transkrip']) ?>">Bukti Pembayaran Transkip</a><br>

									</td>
									<td class="text-center">
										<?php 
										$tema = "Pengecekan Berkas Transkip untuk Persyaratan kompre Mahasiswa oleh Tata Usaha";
										if ($this->m_monitoring_kompre->cekResponTU($id_syarat_kompre, $tema)>0) { 
											?>
											<div>Sudah Direspon</div>
											<?php 
										}else{ 
											$open_file = "Pengecekan Berkas Transkip untuk Persyaratan kompre Mahasiswa oleh Tata Usaha";
											if ($this->m_monitoring_kompre->cekOpenFile($id_syarat_kompre, $open_file)>0) {
												$hidden = "";
											}else{
												$hidden = "hidden";
											}
											?>
											<input type="submit" name="tombol_setuju" id="tombol_setuju_2<?= $id_syarat_kompre ?>" value="Setujui" class="btn btn-primary btn-sm" <?= $hidden ?> >
											<input data-toggle="modal" data-target="#ModaltolakSatuan2<?php echo $i['id_syarat_kompre'] ?>" type="button" id="tombol_tolak_2<?= $id_syarat_kompre ?>" value="Tolak" class="btn btn-danger btn-sm" <?= $hidden ?> >
											<div id="success_text_2<?= $id_syarat_kompre ?>"></div>
											<?php  } ?>
										</td>     
										<script>
											$(document).ready(function() {
												$('#open_file2<?= $id_syarat_kompre ?>').on('click', function() {
													var id_syarat_kompre = "<?= $id_syarat_kompre ?>";
													$.ajax({
														url: "<?php echo site_url("/tu/monitoring_kompre/open_file");?>",
														type: "POST",
														data: {
															id_syarat_kompre: id_syarat_kompre,
															file_open: 'Pengecekan Berkas Transkip untuk Persyaratan kompre Mahasiswa oleh Tata Usaha',
														},
														cache: false,
														success: function(response){

															document.getElementById("tombol_setuju_2<?= $id_syarat_kompre ?>").hidden = false;
															document.getElementById("tombol_tolak_2<?= $id_syarat_kompre ?>").hidden = false;
														},
														error: function(XMLHttpRequest, textStatus, errorThrown) { 
															alert("Status: " + textStatus); alert("Error: " + errorThrown); 
														}  
													});
												});
											});

											$(document).ready(function() {
												$('#tombol_setuju_2<?= $id_syarat_kompre ?>').on('click', function() {
													var id_syarat_kompre = "<?= $id_syarat_kompre ?>";
													$.ajax({
														url: "<?php echo site_url("/tu/monitoring_kompre/setuju_berkas");?>",
														type: "POST",
														data: {
															id_syarat_kompre: id_syarat_kompre,
															status_persetujuan: 'Berkas Disetujui',
															tema_persetujuan: 'Pengecekan Berkas Transkip untuk Persyaratan kompre Mahasiswa oleh Tata Usaha'
														},
														cache: false,
														success: function(response){  
															const jsonObject = JSON.parse(response);
															var hasil1 = jsonObject[0].hasil1;
															var hasil2 = jsonObject[0].hasil2;
															var hasil3 = jsonObject[0].hasil3;
															var hasil4 = jsonObject[0].hasil4;
															var hasil5 = jsonObject[0].hasil5;
															var hasil6 = jsonObject[0].hasil6;
															if(hasil1==1 && hasil2==1 && hasil3==1 && hasil4==1 && hasil5==1 && hasil6==1){
																document.getElementById("tombol_final<?= $id_syarat_kompre ?>").hidden = false;
																document.getElementById("text_final<?= $id_syarat_kompre ?>").hidden = true;
															}
															document.getElementById("success_text_2<?= $id_syarat_kompre ?>").innerText = "Sudah direspon";
															document.getElementById("tombol_setuju_2<?= $id_syarat_kompre ?>").hidden = true;
															document.getElementById("tombol_tolak_2<?= $id_syarat_kompre ?>").hidden = true;
														},
														error: function(XMLHttpRequest, textStatus, errorThrown) { 
															alert("Status: " + textStatus); alert("Error: " + errorThrown); 
														}   
													});
												});
											});
										</script>         
									</tr>

									<tr>
										<td>
											<a target="_BLANK" id="open_file3<?= $id_syarat_kompre ?>" href="<?php echo base_url('templates/file/mahasiswa/syarat_kompre/krs/'.$i['file_krs']) ?>">Bukti KRS Cap Lunas</a><br>
										</td>
										<td class="text-center">
											<?php 
											$tema = "Pengecekan Berkas KRS untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha";
											if ($this->m_monitoring_kompre->cekResponTU($id_syarat_kompre, $tema)>0) { 
												?>
												<div>Sudah Direspon</div>
												<?php 
											}else{ 
												$open_file = "Pengecekan Berkas KRS untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha";
												if ($this->m_monitoring_kompre->cekOpenFile($id_syarat_kompre, $open_file)>0) {
													$hidden = "";
												}else{
													$hidden = "hidden";
												}
												?>
												<input type="submit" name="tombol_setuju" id="tombol_setuju_3<?= $id_syarat_kompre ?>" value="Setujui" class="btn btn-primary btn-sm" <?= $hidden ?> >
												<input data-toggle="modal" data-target="#ModaltolakSatuan3<?php echo $i['id_syarat_kompre'] ?>" type="button" id="tombol_tolak_3<?= $id_syarat_kompre ?>" value="Tolak" class="btn btn-danger btn-sm" <?= $hidden ?> >
												<div id="success_text_3<?= $id_syarat_kompre ?>"></div>
												<?php  } ?>
											</td>     
											<script>
												$(document).ready(function() {
													$('#open_file3<?= $id_syarat_kompre ?>').on('click', function() {
														var id_syarat_kompre = "<?= $id_syarat_kompre ?>";
														$.ajax({
															url: "<?php echo site_url("/tu/monitoring_kompre/open_file");?>",
															type: "POST",
															data: {
																id_syarat_kompre: id_syarat_kompre,
																file_open: 'Pengecekan Berkas KRS untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha',
															},
															cache: false,
															success: function(response){

																document.getElementById("tombol_setuju_3<?= $id_syarat_kompre ?>").hidden = false;
																document.getElementById("tombol_tolak_3<?= $id_syarat_kompre ?>").hidden = false;
															},
															error: function(XMLHttpRequest, textStatus, errorThrown) { 
																alert("Status: " + textStatus); alert("Error: " + errorThrown); 
															}  
														});
													});
												});

												$(document).ready(function() {
													$('#tombol_setuju_3<?= $id_syarat_kompre ?>').on('click', function() {
														var id_syarat_kompre = "<?= $id_syarat_kompre ?>";
														$.ajax({
															url: "<?php echo site_url("/tu/monitoring_kompre/setuju_berkas");?>",
															type: "POST",
															data: {
																id_syarat_kompre: id_syarat_kompre,
																status_persetujuan: 'Berkas Disetujui',
																tema_persetujuan: 'Pengecekan Berkas KRS untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha'
															},
															cache: false,
															success: function(response){  
																const jsonObject = JSON.parse(response);
																var hasil1 = jsonObject[0].hasil1;
																var hasil2 = jsonObject[0].hasil2;
																var hasil3 = jsonObject[0].hasil3;
																var hasil4 = jsonObject[0].hasil4;
																var hasil5 = jsonObject[0].hasil5;
																var hasil6 = jsonObject[0].hasil6;
																if(hasil1==1 && hasil2==1 && hasil3==1 && hasil4==1 && hasil5==1 && hasil6==1){
																	document.getElementById("tombol_final<?= $id_syarat_kompre ?>").hidden = false;
																	document.getElementById("text_final<?= $id_syarat_kompre ?>").hidden = true;
																}
																document.getElementById("success_text_3<?= $id_syarat_kompre ?>").innerText = "Sudah direspon";
																document.getElementById("tombol_setuju_3<?= $id_syarat_kompre ?>").hidden = true;
																document.getElementById("tombol_tolak_3<?= $id_syarat_kompre ?>").hidden = true;
															},
															error: function(XMLHttpRequest, textStatus, errorThrown) { 
																alert("Status: " + textStatus); alert("Error: " + errorThrown); 
															}   
														});
													});
												});
											</script>         
										</tr>

										<tr>
											<td>
												<a target="_BLANK" id="open_file4<?= $id_syarat_kompre ?>" href="<?php echo base_url('templates/file/mahasiswa/syarat_kompre/sertifikat_alquran/'.$i['sertifikat_alquran']) ?>">Sertifikat Kemampuan Baca Alquran</a><br>
											</td>
											<td class="text-center">
												<?php 
												$tema = "Pengecekan Berkas Sertifikat Alquran untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha";
												if ($this->m_monitoring_kompre->cekResponTU($id_syarat_kompre, $tema)>0) { 
													?>
													<div>Sudah Direspon</div>
													<?php 
												}else{ 
													$open_file = "Pengecekan Berkas Sertifikat Alquran untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha";
													if ($this->m_monitoring_kompre->cekOpenFile($id_syarat_kompre, $open_file)>0) {
														$hidden = "";
													}else{
														$hidden = "hidden";
													}
													?>
													<input type="submit" name="tombol_setuju" id="tombol_setuju_4<?= $id_syarat_kompre ?>" value="Setujui" class="btn btn-primary btn-sm" <?= $hidden ?> >
													<input data-toggle="modal" data-target="#ModaltolakSatuan4<?php echo $i['id_syarat_kompre'] ?>" type="button" id="tombol_tolak_4<?= $id_syarat_kompre ?>" value="Tolak" class="btn btn-danger btn-sm" <?= $hidden ?> >
													<div id="success_text_4<?= $id_syarat_kompre ?>"></div>
													<?php  } ?>
												</td>     
												<script>
													$(document).ready(function() {
														$('#open_file4<?= $id_syarat_kompre ?>').on('click', function() {
															var id_syarat_kompre = "<?= $id_syarat_kompre ?>";
															$.ajax({
																url: "<?php echo site_url("/tu/monitoring_kompre/open_file");?>",
																type: "POST",
																data: {
																	id_syarat_kompre: id_syarat_kompre,
																	file_open: 'Pengecekan Berkas Sertifikat Alquran untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha',
																},
																cache: false,
																success: function(response){

																	document.getElementById("tombol_setuju_4<?= $id_syarat_kompre ?>").hidden = false;
																	document.getElementById("tombol_tolak_4<?= $id_syarat_kompre ?>").hidden = false;
																},
																error: function(XMLHttpRequest, textStatus, errorThrown) { 
																	alert("Status: " + textStatus); alert("Error: " + errorThrown); 
																}  
															});
														});
													});

													$(document).ready(function() {
														$('#tombol_setuju_4<?= $id_syarat_kompre ?>').on('click', function() {
															var id_syarat_kompre = "<?= $id_syarat_kompre ?>";
															$.ajax({
																url: "<?php echo site_url("/tu/monitoring_kompre/setuju_berkas");?>",
																type: "POST",
																data: {
																	id_syarat_kompre: id_syarat_kompre,
																	status_persetujuan: 'Berkas Disetujui',
																	tema_persetujuan: 'Pengecekan Berkas Sertifikat Alquran untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha'
																},
																cache: false,
																success: function(response){  
																	const jsonObject = JSON.parse(response);
																	var hasil1 = jsonObject[0].hasil1;
																	var hasil2 = jsonObject[0].hasil2;
																	var hasil3 = jsonObject[0].hasil3;
																	var hasil4 = jsonObject[0].hasil4;
																	var hasil5 = jsonObject[0].hasil5;
																	var hasil6 = jsonObject[0].hasil6;
																	if(hasil1==1 && hasil2==1 && hasil3==1 && hasil4==1 && hasil5==1 && hasil6==1){
																		document.getElementById("tombol_final<?= $id_syarat_kompre ?>").hidden = false;
																		document.getElementById("text_final<?= $id_syarat_kompre ?>").hidden = true;
																	}
																	document.getElementById("success_text_4<?= $id_syarat_kompre ?>").innerText = "Sudah direspon";
																	document.getElementById("tombol_setuju_4<?= $id_syarat_kompre ?>").hidden = true;
																	document.getElementById("tombol_tolak_4<?= $id_syarat_kompre ?>").hidden = true;
																},
																error: function(XMLHttpRequest, textStatus, errorThrown) { 
																	alert("Status: " + textStatus); alert("Error: " + errorThrown); 
																}   
															});
														});
													});
												</script>         
											</tr>

											<tr>
												<td>
													<a target="_BLANK" id="open_file5<?= $id_syarat_kompre ?>" href="<?php echo base_url('templates/file/mahasiswa/syarat_kompre/sertifikat_inggris/'.$i['sertifikat_inggris']) ?>">Sertifikat Kemampuan Bahasa Inggris (TOEFL/IELTS)</a><br>
												</td>
												<td class="text-center">
													<?php 
													$tema = "Pengecekan Berkas Sertifikat Inggris untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha";
													if ($this->m_monitoring_kompre->cekResponTU($id_syarat_kompre, $tema)>0) { 
														?>
														<div>Sudah Direspon</div>
														<?php 
													}else{ 
														$open_file = "Pengecekan Berkas Sertifikat Inggris untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha";
														if ($this->m_monitoring_kompre->cekOpenFile($id_syarat_kompre, $open_file)>0) {
															$hidden = "";
														}else{
															$hidden = "hidden";
														}
														?>
														<input type="submit" name="tombol_setuju" id="tombol_setuju_5<?= $id_syarat_kompre ?>" value="Setujui" class="btn btn-primary btn-sm" <?= $hidden ?> >
														<input data-toggle="modal" data-target="#ModaltolakSatuan5<?php echo $i['id_syarat_kompre'] ?>" type="button" id="tombol_tolak_5<?= $id_syarat_kompre ?>" value="Tolak" class="btn btn-danger btn-sm" <?= $hidden ?> >
														<div id="success_text_5<?= $id_syarat_kompre ?>"></div>
														<?php  } ?>
													</td>     
													<script>
														$(document).ready(function() {
															$('#open_file5<?= $id_syarat_kompre ?>').on('click', function() {
																var id_syarat_kompre = "<?= $id_syarat_kompre ?>";
																$.ajax({
																	url: "<?php echo site_url("/tu/monitoring_kompre/open_file");?>",
																	type: "POST",
																	data: {
																		id_syarat_kompre: id_syarat_kompre,
																		file_open: 'Pengecekan Berkas Sertifikat Inggris untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha',
																	},
																	cache: false,
																	success: function(response){

																		document.getElementById("tombol_setuju_5<?= $id_syarat_kompre ?>").hidden = false;
																		document.getElementById("tombol_tolak_5<?= $id_syarat_kompre ?>").hidden = false;
																	},
																	error: function(XMLHttpRequest, textStatus, errorThrown) { 
																		alert("Status: " + textStatus); alert("Error: " + errorThrown); 
																	}  
																});
															});
														});

														$(document).ready(function() {
															$('#tombol_setuju_5<?= $id_syarat_kompre ?>').on('click', function() {
																var id_syarat_kompre = "<?= $id_syarat_kompre ?>";
																$.ajax({
																	url: "<?php echo site_url("/tu/monitoring_kompre/setuju_berkas");?>",
																	type: "POST",
																	data: {
																		id_syarat_kompre: id_syarat_kompre,
																		status_persetujuan: 'Berkas Disetujui',
																		tema_persetujuan: 'Pengecekan Berkas Sertifikat Inggris untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha'
																	},
																	cache: false,
																	success: function(response){  
																		const jsonObject = JSON.parse(response);
																		var hasil1 = jsonObject[0].hasil1;
																		var hasil2 = jsonObject[0].hasil2;
																		var hasil3 = jsonObject[0].hasil3;
																		var hasil4 = jsonObject[0].hasil4;
																		var hasil5 = jsonObject[0].hasil5;
																		var hasil6 = jsonObject[0].hasil6;
																		if(hasil1==1 && hasil2==1 && hasil3==1 && hasil4==1 && hasil5==1 && hasil6==1){
																			document.getElementById("tombol_final<?= $id_syarat_kompre ?>").hidden = false;
																			document.getElementById("text_final<?= $id_syarat_kompre ?>").hidden = true;
																		}
																		document.getElementById("success_text_5<?= $id_syarat_kompre ?>").innerText = "Sudah direspon";
																		document.getElementById("tombol_setuju_5<?= $id_syarat_kompre ?>").hidden = true;
																		document.getElementById("tombol_tolak_5<?= $id_syarat_kompre ?>").hidden = true;
																	},
																	error: function(XMLHttpRequest, textStatus, errorThrown) { 
																		alert("Status: " + textStatus); alert("Error: " + errorThrown); 
																	}   
																});
															});
														});
													</script>         
												</tr>
												<tr>
													<td>
														<a target="_BLANK" id="open_file6<?= $id_syarat_kompre ?>" href="<?php echo base_url('templates/file/mahasiswa/syarat_kompre/laporan_lengkap/'.$i['file_laporan']) ?>">File Laporan Lengkap</a><br>
													</td>
													<td class="text-center">
														<?php 
														$tema = "Pengecekan Berkas Laporan Lengkap untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha";
														if ($this->m_monitoring_kompre->cekResponTU($id_syarat_kompre, $tema)>0) { 
															?>
															<div>Sudah Direspon</div>
															<?php 
														}else{ 
															$open_file = "Pengecekan Berkas Laporan Lengkap untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha";
															if ($this->m_monitoring_kompre->cekOpenFile($id_syarat_kompre, $open_file)>0) {
																$hidden = "";
															}else{
																$hidden = "hidden";
															}
															?>
															<input type="submit" name="tombol_setuju" id="tombol_setuju_6<?= $id_syarat_kompre ?>" value="Setujui" class="btn btn-primary btn-sm" <?= $hidden ?> >
															<input data-toggle="modal" data-target="#ModaltolakSatuan6<?php echo $i['id_syarat_kompre'] ?>" type="button" id="tombol_tolak_6<?= $id_syarat_kompre ?>" value="Tolak" class="btn btn-danger btn-sm" <?= $hidden ?> >
															<div id="success_text_6<?= $id_syarat_kompre ?>"></div>
															<?php  } ?>
														</td>     
														<script>
															$(document).ready(function() {
																$('#open_file6<?= $id_syarat_kompre ?>').on('click', function() {
																	var id_syarat_kompre = "<?= $id_syarat_kompre ?>";
																	$.ajax({
																		url: "<?php echo site_url("/tu/monitoring_kompre/open_file");?>",
																		type: "POST",
																		data: {
																			id_syarat_kompre: id_syarat_kompre,
																			file_open: 'Pengecekan Berkas Laporan Lengkap untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha',
																		},
																		cache: false,
																		success: function(response){

																			document.getElementById("tombol_setuju_6<?= $id_syarat_kompre ?>").hidden = false;
																			document.getElementById("tombol_tolak_6<?= $id_syarat_kompre ?>").hidden = false;
																		},
																		error: function(XMLHttpRequest, textStatus, errorThrown) { 
																			alert("Status: " + textStatus); alert("Error: " + errorThrown); 
																		}  
																	});
																});
															});

															$(document).ready(function() {
																$('#tombol_setuju_6<?= $id_syarat_kompre ?>').on('click', function() {
																	var id_syarat_kompre = "<?= $id_syarat_kompre ?>";
																	$.ajax({
																		url: "<?php echo site_url("/tu/monitoring_kompre/setuju_berkas");?>",
																		type: "POST",
																		data: {
																			id_syarat_kompre: id_syarat_kompre,
																			status_persetujuan: 'Berkas Disetujui',
																			tema_persetujuan: 'Pengecekan Berkas Laporan Lengkap untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha'
																		},
																		cache: false,
																		success: function(response){  
																			const jsonObject = JSON.parse(response);
																			var hasil1 = jsonObject[0].hasil1;
																			var hasil2 = jsonObject[0].hasil2;
																			var hasil3 = jsonObject[0].hasil3;
																			var hasil4 = jsonObject[0].hasil4;
																			var hasil5 = jsonObject[0].hasil5;
																			var hasil6 = jsonObject[0].hasil6;
																			if(hasil1==1 && hasil2==1 && hasil3==1 && hasil4==1 && hasil5==1 && hasil6==1){
																				document.getElementById("tombol_final<?= $id_syarat_kompre ?>").hidden = false;
																				document.getElementById("text_final<?= $id_syarat_kompre ?>").hidden = true;
																			}
																			document.getElementById("success_text_6<?= $id_syarat_kompre ?>").innerText = "Sudah direspon";
																			document.getElementById("tombol_setuju_6<?= $id_syarat_kompre ?>").hidden = true;
																			document.getElementById("tombol_tolak_6<?= $id_syarat_kompre ?>").hidden = true;
																		},
																		error: function(XMLHttpRequest, textStatus, errorThrown) { 
																			alert("Status: " + textStatus); alert("Error: " + errorThrown); 
																		}   
																	});
																});
															});
														</script>         
													</tr>

												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php 
							endforeach; 
							?> 

							<!-- MODAL DISETUJUI DATA PENGAJUAN SK -->
							<?php 
							$no = 1;
							foreach ($pencarian_data as $i):

								?>
							<div class="modal fade" id="Modalsetuju<?php echo $i['id_syarat_kompre']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
								aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel"><b class="text-primary">DATA DISETUJUI</b></h5>
											<button class="close" type="button" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">×</span>
											</button>
										</div>
										<form action="<?php echo site_url('/tu/monitoring_kompre/persetujuan') ?>" method ="post">
											<div class="modal-body"> 
												<label>Apakah semua persyaratan disetujui ?</label>
											</div>
											<input type="hidden" name="id_syarat_kompre" value="<?php echo $i['id_syarat_kompre']  ?>"></input>
											<div class="modal-footer">
												<button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
												<button class="btn btn-primary" type="submit" name="tombolSetuju">Ya</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						<?php endforeach;  
						?> 

						<!-- MODAL TOLAK DATA PENGAJUAN SK -->
						<?php 
						$no = 1;
						foreach ($pencarian_data as $i):

							?>
						<div class="modal fade" id="Modaltolak<?php echo $i['id_syarat_kompre']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
							aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel"><b class="text-danger">Alasan Data ditolak</b></h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body"> 
										<form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/tu/monitoring_kompre/persetujuan')?>">
											<div class="form-group">
												<input type="hidden" name="id_syarat_kompre" value="<?php echo $i['id_syarat_kompre'] ?>" class="form-control"></input>
												<input type="text" name="alasan_ditolak[]" class="form-control" placeholder="Inputkan Alasan Lain"></input>
											</div>
											<div class="modal-footer">
												<button class="btn btn-danger" type="reset" data-dismiss="modal">Tutup</button>
												<button class="btn btn-primary" type="submit" name="tombolTolak">Submit</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; 

					?> 

					<?php 
					$no = 1;
					foreach ($pencarian_data as $i):

						?>
					<!-- Modal Tolak -->
					<div class="modal fade" id="ModaltolakSatuan1<?php echo $i['id_syarat_kompre'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel" >Penolakan Berkas</h5>
									<button class="close" type="button" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
								</div>
								<div class="modal-body">
									<form class="form-horizontal">
										<div class="form-group">
											<label>Alasan Validasi Ditolak</label><br>
											<input type="checkbox" id="checkItem1<?php echo $i['id_syarat_kompre'] ?>" name="alasan_ditolak[]" value="Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas.." > Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas..<br>
											<input type="text" name="alasan_ditolak1<?php echo $i['id_syarat_kompre'] ?>" class="form-control" placeholder="Inputkan Alasan Lain"></input>
										</div>
										<div class="modal-footer">
											<button class="btn btn-danger" type="reset" data-dismiss="modal">Tutup</button>
											<button class="btn btn-primary" type="button" id="btn-tolak1<?php echo $i['id_syarat_kompre'] ?>" onclick="btn_tolak1(<?php echo $i['id_syarat_kompre'] ?>)">Submit</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<script>
						function btn_tolak1(x){
							var id = x;
							str = $("[name='alasan_ditolak1"+x+"']").val();

							var als = str.replace(/'/g, "\\'");;
							if (document.getElementById("checkItem1"+x).checked){
								var alasan = 'Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas, ' + als;
							}
							else{
								var alasan = als;
							}
							var tema = 'Pengecekan Berkas SPP untuk Persyaratan kompre Mahasiswa oleh Tata Usaha';
							$.ajax({
								url:"<?php echo site_url('/tu/monitoring_kompre/tolak_berkas')?>",
								type:"POST",
								data:{
									id : id,
									als : alasan,
									tema : tema,
								},
								cache: false,
								success: function(response){  
									const jsonObject = JSON.parse(response);
									var hasil1 = jsonObject[0].hasil1;
									var hasil2 = jsonObject[0].hasil2;
									var hasil3 = jsonObject[0].hasil3;
									var hasil4 = jsonObject[0].hasil4;
									var hasil5 = jsonObject[0].hasil5;
									var hasil6 = jsonObject[0].hasil6;
									if(hasil1==1 && hasil2==1 && hasil3 && hasil4==1 && hasil5==1 && hasil6==1){            document.getElementById("tombol_final<?= $id_syarat_kompre ?>").hidden = false;
									document.getElementById("text_final<?= $id_syarat_kompre ?>").hidden = true;
								}

								$('#success_text_1'+x).text("Sudah direspon");
								$('#ModaltolakSatuan1'+x).hide();
								$('#tombol_setuju_1'+x).hide();
								$('#tombol_tolak_1'+x).hide();

								console.log(jsonObject);
							},
							error: function(XMLHttpRequest, textStatus, errorThrown) { 
								alert("Status: " + textStatus); alert("Error: " + errorThrown); 
							}   
						});
						}
					</script>
				<?php endforeach; 
				?> 

				<?php 
				$no = 1;
				foreach ($pencarian_data as $i):

					?>
				<!-- Modal Tolak -->
				<div class="modal fade" id="ModaltolakSatuan2<?php echo $i['id_syarat_kompre'] ?>" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel" >Penolakan Berkas</h5>
								<button class="close" type="button" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
							<div class="modal-body">
								<form class="form-horizontal">
									<div class="form-group">
										<label>Alasan Validasi Ditolak</label><br>
										<input type="checkbox" id="checkItem2<?php echo $i['id_syarat_kompre'] ?>" name="alasan_ditolak[]" value="Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas.." > Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas..<br>
										<input type="text" name="alasan_ditolak2<?php echo $i['id_syarat_kompre'] ?>" class="form-control" placeholder="Inputkan Alasan Lain"></input>
									</div>
									<div class="modal-footer">
										<button class="btn btn-danger" type="reset" data-dismiss="modal">Tutup</button>
										<button class="btn btn-primary" type="button" id="btn-tolak2<?php echo $i['id_syarat_kompre'] ?>" onclick="btn_tolak2(<?php echo $i['id_syarat_kompre'] ?>)">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<script>
					function btn_tolak2(x){
						var id = x;
						str = $("[name='alasan_ditolak2"+x+"']").val();

						var als = str.replace(/'/g, "\\'");;
						if (document.getElementById("checkItem2"+x).checked){
							var alasan = 'Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas, ' + als;
						}
						else{
							var alasan = als;
						}
						var tema = 'Pengecekan Berkas Transkip untuk Persyaratan kompre Mahasiswa oleh Tata Usaha';
						$.ajax({
							url:"<?php echo site_url('/tu/monitoring_kompre/tolak_berkas')?>",
							type:"POST",
							data:{
								id : id,
								als : alasan,
								tema : tema,
							},
							cache: false,
							success: function(response){  
								const jsonObject = JSON.parse(response);
								var hasil1 = jsonObject[0].hasil1;
								var hasil2 = jsonObject[0].hasil2;
								var hasil3 = jsonObject[0].hasil3;
								var hasil4 = jsonObject[0].hasil4;
								var hasil5 = jsonObject[0].hasil5;
								var hasil6 = jsonObject[0].hasil6;
								if(hasil1==1 && hasil2==1 && hasil3 && hasil4==1 && hasil5==1 && hasil6==1){            
									document.getElementById("tombol_final<?= $id_syarat_kompre ?>").hidden = false;
								document.getElementById("text_final<?= $id_syarat_kompre ?>").hidden = true;
							}

							$('#success_text_2'+x).text("Sudah direspon");
							$('#ModaltolakSatuan2'+x).hide();
							$('#tombol_setuju_2'+x).hide();
							$('#tombol_tolak_2'+x).hide();

							console.log(jsonObject);
						},
						error: function(XMLHttpRequest, textStatus, errorThrown) { 
							alert("Status: " + textStatus); alert("Error: " + errorThrown); 
						}   
					});
					}
				</script>
			<?php endforeach; 
			?> 

			<?php 
			$no = 1;
			foreach ($pencarian_data as $i):

				?>
			<!-- Modal Tolak -->
			<div class="modal fade" id="ModaltolakSatuan3<?php echo $i['id_syarat_kompre'] ?>" tabindex="-3" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel" >Penolakan Berkas</h5>
							<button class="close" type="button" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							<form class="form-horizontal">
								<div class="form-group">
									<label>Alasan Validasi Ditolak</label><br>
									<input type="checkbox" id="checkItem3<?php echo $i['id_syarat_kompre'] ?>" name="alasan_ditolak[]" value="Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas.." > Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas..<br>
									<input type="text" name="alasan_ditolak3<?php echo $i['id_syarat_kompre'] ?>" class="form-control" placeholder="Inputkan Alasan Lain"></input>
								</div>
								<div class="modal-footer">
									<button class="btn btn-danger" type="reset" data-dismiss="modal">Tutup</button>
									<button class="btn btn-primary" type="button" id="btn-tolak3<?php echo $i['id_syarat_kompre'] ?>" onclick="btn_tolak3(<?php echo $i['id_syarat_kompre'] ?>)">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<script>
				function btn_tolak3(x){
					var id = x;
					str = $("[name='alasan_ditolak3"+x+"']").val();

					var als = str.replace(/'/g, "\\'");;
					if (document.getElementById("checkItem3"+x).checked){
						var alasan = 'Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas, ' + als;
					}
					else{
						var alasan = als;
					}
					var tema = 'Pengecekan Berkas KRS untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha';
					$.ajax({
						url:"<?php echo site_url('/tu/monitoring_kompre/tolak_berkas')?>",
						type:"POST",
						data:{
							id : id,
							als : alasan,
							tema : tema,
						},
						cache: false,
						success: function(response){  
							const jsonObject = JSON.parse(response);
							var hasil1 = jsonObject[0].hasil1;
							var hasil2 = jsonObject[0].hasil2;
							var hasil3 = jsonObject[0].hasil3;
							var hasil4 = jsonObject[0].hasil4;
							var hasil5 = jsonObject[0].hasil5;
							var hasil6 = jsonObject[0].hasil6;
							if(hasil1==1 && hasil2==1 && hasil3 && hasil4==1 && hasil5==1 && hasil6==1){    document.getElementById("tombol_final<?= $id_syarat_kompre ?>").hidden = false;
							document.getElementById("text_final<?= $id_syarat_kompre ?>").hidden = true;
						}

						$('#success_text_3'+x).text("Sudah direspon");
						$('#ModaltolakSatuan3'+x).hide();
						$('#tombol_setuju_3'+x).hide();
						$('#tombol_tolak_3'+x).hide();

						console.log(jsonObject);
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) { 
						alert("Status: " + textStatus); alert("Error: " + errorThrown); 
					}   
				});
				}
			</script>
		<?php endforeach; 
		?> 

		<?php 
		$no = 1;
		foreach ($pencarian_data as $i):

			?>
		<!-- Modal Tolak -->
		<div class="modal fade" id="ModaltolakSatuan4<?php echo $i['id_syarat_kompre'] ?>" tabindex="-4" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel" >Penolakan Berkas</h5>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<form class="form-horizontal">
							<div class="form-group">
								<label>Alasan Validasi Ditolak</label><br>
								<input type="checkbox" id="checkItem4<?php echo $i['id_syarat_kompre'] ?>" name="alasan_ditolak[]" value="Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas.." > Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas..<br>
								<input type="text" name="alasan_ditolak4<?php echo $i['id_syarat_kompre'] ?>" class="form-control" placeholder="Inputkan Alasan Lain"></input>
							</div>
							<div class="modal-footer">
								<button class="btn btn-danger" type="reset" data-dismiss="modal">Tutup</button>
								<button class="btn btn-primary" type="button" id="btn-tolak4<?php echo $i['id_syarat_kompre'] ?>" onclick="btn_tolak4(<?php echo $i['id_syarat_kompre'] ?>)">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<script>
			function btn_tolak4(x){
				var id = x;
				str = $("[name='alasan_ditolak4"+x+"']").val();

				var als = str.replace(/'/g, "\\'");;
				if (document.getElementById("checkItem4"+x).checked){
					var alasan = 'Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas, ' + als;
				}
				else{
					var alasan = als;
				}
				var tema = 'Pengecekan Berkas Sertifikat Alquran untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha';
				$.ajax({
					url:"<?php echo site_url('/tu/monitoring_kompre/tolak_berkas')?>",
					type:"POST",
					data:{
						id : id,
						als : alasan,
						tema : tema,
					},
					cache: false,
					success: function(response){  
						const jsonObject = JSON.parse(response);
						var hasil1 = jsonObject[0].hasil1;
						var hasil2 = jsonObject[0].hasil2;
						var hasil3 = jsonObject[0].hasil3;
						var hasil4 = jsonObject[0].hasil4;
						var hasil5 = jsonObject[0].hasil5;
						var hasil6 = jsonObject[0].hasil6;
						if(hasil1==1 && hasil2==1 && hasil3 && hasil4==1 && hasil5==1 && hasil6==1){            document.getElementById("tombol_final<?= $id_syarat_kompre ?>").hidden = false;
						document.getElementById("text_final<?= $id_syarat_kompre ?>").hidden = true;
					}

					$('#success_text_4'+x).text("Sudah direspon");
					$('#ModaltolakSatuan4'+x).hide();
					$('#tombol_setuju_4'+x).hide();
					$('#tombol_tolak_4'+x).hide();

					console.log(jsonObject);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) { 
					alert("Status: " + textStatus); alert("Error: " + errorThrown); 
				}   
			});
			}
		</script>
	<?php endforeach; 
	?> 

	<?php 
	$no = 1;
	foreach ($pencarian_data as $i):

		?>
	<!-- Modal Tolak -->
	<div class="modal fade" id="ModaltolakSatuan5<?php echo $i['id_syarat_kompre'] ?>" tabindex="-5" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel" >Penolakan Berkas</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<form class="form-horizontal">
						<div class="form-group">
							<label>Alasan Validasi Ditolak</label><br>
							<input type="checkbox" id="checkItem5<?php echo $i['id_syarat_kompre'] ?>" name="alasan_ditolak[]" value="Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas.." > Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas..<br>
							<input type="text" name="alasan_ditolak5<?php echo $i['id_syarat_kompre'] ?>" class="form-control" placeholder="Inputkan Alasan Lain"></input>
						</div>
						<div class="modal-footer">
							<button class="btn btn-danger" type="reset" data-dismiss="modal">Tutup</button>
							<button class="btn btn-primary" type="button" id="btn-tolak5<?php echo $i['id_syarat_kompre'] ?>" onclick="btn_tolak5(<?php echo $i['id_syarat_kompre'] ?>)">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script>
		function btn_tolak5(x){
			var id = x;
			str = $("[name='alasan_ditolak5"+x+"']").val();

			var als = str.replace(/'/g, "\\'");;
			if (document.getElementById("checkItem5"+x).checked){
				var alasan = 'Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas, ' + als;
			}
			else{
				var alasan = als;
			}
			var tema = 'Pengecekan Berkas Sertifikat Alquran untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha';
			$.ajax({
				url:"<?php echo site_url('/tu/monitoring_kompre/tolak_berkas')?>",
				type:"POST",
				data:{
					id : id,
					als : alasan,
					tema : tema,
				},
				cache: false,
				success: function(response){  
					const jsonObject = JSON.parse(response);
					var hasil1 = jsonObject[0].hasil1;
					var hasil2 = jsonObject[0].hasil2;
					var hasil3 = jsonObject[0].hasil3;
					var hasil4 = jsonObject[0].hasil4;
					var hasil5 = jsonObject[0].hasil5;
					var hasil6 = jsonObject[0].hasil6;
					if(hasil1==1 && hasil2==1 && hasil3 && hasil4==1 && hasil5==1 && hasil6==1){            document.getElementById("tombol_final<?= $id_syarat_kompre ?>").hidden = false;
					document.getElementById("text_final<?= $id_syarat_kompre ?>").hidden = true;
				}

				$('#success_text_5'+x).text("Sudah direspon");
				$('#ModaltolakSatuan5'+x).hide();
				$('#tombol_setuju_5'+x).hide();
				$('#tombol_tolak_5'+x).hide();

				console.log(jsonObject);
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
				alert("Status: " + textStatus); alert("Error: " + errorThrown); 
			}   
		});
		}
	</script>
<?php endforeach; 
?> 

<?php 
$no = 1;
foreach ($pencarian_data as $i):

	?>
<!-- Modal Tolak -->
<div class="modal fade" id="ModaltolakSatuan6<?php echo $i['id_syarat_kompre'] ?>" tabindex="-5" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel" >Penolakan Berkas</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
					<div class="form-group">
						<label>Alasan Validasi Ditolak</label><br>
						<input type="checkbox" id="checkItem6<?php echo $i['id_syarat_kompre'] ?>" name="alasan_ditolak[]" value="Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas.." > Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas..<br>
						<input type="text" name="alasan_ditolak6<?php echo $i['id_syarat_kompre'] ?>" class="form-control" placeholder="Inputkan Alasan Lain"></input>
					</div>
					<div class="modal-footer">
						<button class="btn btn-danger" type="reset" data-dismiss="modal">Tutup</button>
						<button class="btn btn-primary" type="button" id="btn-tolak6<?php echo $i['id_syarat_kompre'] ?>" onclick="btn_tolak6(<?php echo $i['id_syarat_kompre'] ?>)">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	function btn_tolak6(x){
		var id = x;
		str = $("[name='alasan_ditolak6"+x+"']").val();

		var als = str.replace(/'/g, "\\'");;
		if (document.getElementById("checkItem6"+x).checked){
			var alasan = 'Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas, ' + als;
		}
		else{
			var alasan = als;
		}
		var tema = 'Pengecekan Berkas Sertifikat Alquran untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha';
		$.ajax({
			url:"<?php echo site_url('/tu/monitoring_kompre/tolak_berkas')?>",
			type:"POST",
			data:{
				id : id,
				als : alasan,
				tema : tema,
			},
			cache: false,
			success: function(response){  
				const jsonObject = JSON.parse(response);
				var hasil1 = jsonObject[0].hasil1;
				var hasil2 = jsonObject[0].hasil2;
				var hasil3 = jsonObject[0].hasil3;
				var hasil4 = jsonObject[0].hasil4;
				var hasil5 = jsonObject[0].hasil5;
				var hasil6 = jsonObject[0].hasil6;
				if(hasil1==1 && hasil2==1 && hasil3 && hasil4==1 && hasil5==1 && hasil6==1){
					document.getElementById("tombol_final<?= $id_syarat_kompre ?>").hidden = false;
					document.getElementById("text_final<?= $id_syarat_kompre ?>").hidden = true;
				}

				$('#success_text_6'+x).text("Sudah direspon");
				$('#ModaltolakSatuan6'+x).hide();
				$('#tombol_setuju_6'+x).hide();
				$('#tombol_tolak_6'+x).hide();

				console.log(jsonObject);
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
				alert("Status: " + textStatus); alert("Error: " + errorThrown); 
			}   
		});
	}
</script>
<?php endforeach; 
?> 