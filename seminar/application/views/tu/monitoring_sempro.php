<div class="col-lg-12 mb-1">
	<?php echo $this->session->flashdata('messege'); ?>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h5 class="m-0 font-weight-bold text-primary">PENGAJUAN SEMINAR PROPOSAL</h5>
		</div><br>
		<div class="content">
			<div class="container-fluid">
				<div class="card shadow mb-4">
					<div class="card-body">
						<form action="<?php echo site_url().'/tu/monitoring_sempro'; ?>" method="post" enctype="multipart/form-data">
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
											<td align="center"><b>NO. WHATSAPP</b></td>
											<td align="center"><b>KEPERLUAN</b></td>
											<td align="center"><b>USULAN UJIAN</b></td>
											<td align="center"><b>DETAIL</b></td>
											<td align="center"><b>STATUS  DATA</b></td>
											<td align="center"><b>AKSI</b></td>
										</tr>
									</thead>
									<tbody>
										<?php 
										$no = 1;
										foreach ($pencarian_data as $i):
											$id_syarat_sempro     = $i['id_syarat_sempro'];
										$nama_mahasiswa 		= $i['nama_mahasiswa'];
										$nama_seminar  			= $i['nama_seminar'];
										$npm            		= $i['npm'];
										$usulan_tanggal         = $i['usulan_tanggal'];
										$usulan_jam            	= $i['usulan_jam'];
										$no_hp            		= $i['no_hp'];
										?>
										<tr>
											<td><?php echo $no++;?></td>
											<td><?php echo $npm;?></td>
											<td><?php echo ucwords($nama_mahasiswa); ?></td>
											<td>                 
												<a href="whatsapp://send?text=Assalamu'alaikum.Wr.Wb...&phone=+62<?php echo $no_hp;?>" >
													<?php echo $no_hp;?>
												</a>
											</td> 
											<td><?php echo $nama_seminar;?></td>
											<td align="center">
												<?= $this->m_monitoring_sempro->format_tanggal(date('Y-m-d', strtotime($usulan_tanggal))); ?><br><b class="text-danger">Pukul :</b><?php echo date("H:i:s", strtotime($usulan_jam));?></td>
												<td>
													<i class="fas fa-eye text-primary" data-toggle="modal" data-target="#Modallihat<?php echo $id_syarat_sempro  ?>"></i>
												</td>
												<td>
													<?php
													$tema = "Pengecekan Berkas Persyaratan Sempro Mahasiswa oleh Tata Usaha";
													$cekSempro = $this->m_monitoring_sempro->cekResponTU($id_syarat_sempro, $tema);
													if($this->m_monitoring_sempro->cekStatusPersetujuanTU($id_syarat_sempro, $tema, 'Berkas Disetujui')>0){
														echo '<b class="text-primary">Berkas Disetujui</b>';
													}elseif($this->m_monitoring_sempro->cekStatusPersetujuanTU($id_syarat_sempro, $tema, 'Berkas Ditolak')>0){
														echo '<b class="text-danger">Berkas Ditolak</b>';
													}elseif($cekSempro>0){
														echo '<b class="text-warning">Meminta Validasi Berkas</b>';
													}elseif($cekSempro==0){
														echo '<b class="text-warning">Meminta Validasi Berkas</b>';
													}else{
														echo '<b class="text-warning">Meminta Validasi Berkas</b>';
													}
													?>
												</td>
												<td>
													<?php 
													$tema = "Pengecekan Berkas Persyaratan Sempro Mahasiswa oleh Tata Usaha";
													if ($this->m_monitoring_sempro->cekResponTU($id_syarat_sempro, $tema)<=0) {  
														if($this->m_monitoring_sempro->cekPersetujuanSemuaBerkas2($id_syarat_sempro)==1){    
															?>
															<input type="submit" id="setuju_final<?= $id_syarat_sempro ?>" name="tombol_setuju" value="Setujui" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modalsetuju<?php echo $id_syarat_sempro ?>">
															<input type="submit" id="tolak_final<?= $id_syarat_sempro ?>" name="tombol_tolak" value="Tolak" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modaltolak<?php echo $id_syarat_sempro ?>">

															<?php 
														}else{
															echo '<div id="text_final'.$id_syarat_sempro.'">Semua berkas belum disetujui</div>';
															?>
															<div id="tombol_final<?= $id_syarat_sempro ?>" hidden>
																<input type="submit" id="setuju_final<?= $id_syarat_sempro ?>" name="tombol_setuju" value="Setujui" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modalsetuju<?php echo $id_syarat_sempro ?>">
																<input type="submit" id="tolak_final<?= $id_syarat_sempro ?>" name="tombol_tolak" value="Tolak" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modaltolak<?php echo $id_syarat_sempro ?>">
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
			$id_syarat_sempro   = $i['id_syarat_sempro'];
		$nama_mahasiswa 	= $i['nama_mahasiswa'];
		$nama_seminar  		= $i['nama_seminar'];
		$npm            	= $i['npm'];
		?>
		<div class="modal fade" id="Modallihat<?php echo $i['id_syarat_sempro']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Data Pengajuan Seminar Proposal</h5>
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
										<a target="_BLANK" id="open_file1<?= $id_syarat_sempro ?>" href="<?php echo base_url('templates/file/mahasiswa/syarat_sempro/krs/'.$i['file_krs']) ?>">Bukti KRS</a><br>
									</td>
									<td class="text-center">
										<?php 
										$tema = "Pengecekan Berkas KRS untuk Persyaratan Sempro Mahasiswa oleh Tata Usaha";
										if ($this->m_monitoring_sempro->cekResponTU($id_syarat_sempro, $tema)>0) { 
											?>
											<div>Sudah Direspon</div>
											<?php 
										}else{ 
											$open_file = "Pengecekan Berkas KRS untuk Persyaratan Sempro Mahasiswa oleh Tata Usaha";
											if ($this->m_monitoring_sempro->cekOpenFile($id_syarat_sempro, $open_file)>0) {
												$hidden = "";
											}else{
												$hidden = "hidden";
											}
											?>
											<input type="submit" name="tombol_setuju" id="tombol_setuju_1<?= $id_syarat_sempro ?>" value="Setujui" class="btn btn-primary btn-sm" <?= $hidden ?> >

											<input data-toggle="modal" data-target="#ModaltolakSatuan1<?php echo $i['id_syarat_sempro'] ?>" type="button" id="tombol_tolak_1<?= $id_syarat_sempro ?>" value="Tolak" class="btn btn-danger btn-sm" <?= $hidden ?> >

											<div id="success_text_1<?= $id_syarat_sempro ?>"></div>
											<?php  } ?>
										</td>     
										<script>
											$(document).ready(function() {
												$('#open_file1<?= $id_syarat_sempro ?>').on('click', function() {
													var id_syarat_sempro = "<?= $id_syarat_sempro ?>";
													$.ajax({
														url: "<?php echo site_url("/tu/monitoring_sempro/open_file");?>",
														type: "POST",
														data: {
															id_syarat_sempro: id_syarat_sempro,
															file_open: 'Pengecekan Berkas KRS untuk Persyaratan Sempro Mahasiswa oleh Tata Usaha',
														},
														cache: false,
														success: function(response){

															document.getElementById("tombol_setuju_1<?= $id_syarat_sempro ?>").hidden = false;
															document.getElementById("tombol_tolak_1<?= $id_syarat_sempro ?>").hidden = false;
														},
														error: function(XMLHttpRequest, textStatus, errorThrown) { 
															alert("Status: " + textStatus); alert("Error: " + errorThrown); 
														}  
													});
												});
											});

											$(document).ready(function() {
												$('#tombol_setuju_1<?= $id_syarat_sempro ?>').on('click', function() {
													var id_syarat_sempro = "<?= $id_syarat_sempro ?>";
													$.ajax({
														url: "<?php echo site_url("/tu/monitoring_sempro/setuju_berkas");?>",
														type: "POST",
														data: {
															id_syarat_sempro: id_syarat_sempro,
															status_persetujuan: 'Berkas Disetujui',
															tema_persetujuan: 'Pengecekan Berkas KRS untuk Persyaratan Sempro Mahasiswa oleh Tata Usaha'
														},
														cache: false,
														success: function(response){

															const jsonObject = JSON.parse(response);
															var hasil1 = jsonObject[0].hasil1;
															var hasil2 = jsonObject[0].hasil2;
															var hasil3 = jsonObject[0].hasil3;
															if(hasil1==1 && hasil2==1 && hasil3==1){
																document.getElementById("tombol_final<?= $id_syarat_sempro ?>").hidden = false;
																document.getElementById("text_final<?= $id_syarat_sempro ?>").hidden = true;
															}
															document.getElementById("success_text_1<?= $id_syarat_sempro ?>").innerText = "Sudah direspon";
															document.getElementById("tombol_setuju_1<?= $id_syarat_sempro ?>").hidden = true;
															document.getElementById("tombol_tolak_1<?= $id_syarat_sempro ?>").hidden = true;
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
											<a target="_BLANK" id="open_file2<?= $id_syarat_sempro ?>" href="<?php echo base_url('templates/file/mahasiswa/syarat_sempro/spp/'.$i['file_spp']) ?>">Bukti SPP Dasar</a><br>
										</td>
										<td class="text-center">
											<?php 
											$tema = "Pengecekan Berkas SPP untuk Persyaratan Sempro Mahasiswa oleh Tata Usaha";
											if ($this->m_monitoring_sempro->cekResponTU($id_syarat_sempro, $tema)>0) { 
												?>
												<div>Sudah Direspon</div>
												<?php 
											}else{ 
												$open_file = "Pengecekan Berkas SPP untuk Persyaratan Sempro Mahasiswa oleh Tata Usaha";
												if ($this->m_monitoring_sempro->cekOpenFile($id_syarat_sempro, $open_file)>0) {
													$hidden = "";
												}else{
													$hidden = "hidden";
												}
												?>
												<input type="submit" name="tombol_setuju" id="tombol_setuju_2<?= $id_syarat_sempro ?>" value="Setujui" class="btn btn-primary btn-sm" <?= $hidden ?> >
												<input data-toggle="modal" data-target="#ModaltolakSatuan2<?php echo $i['id_syarat_sempro'] ?>" type="button" id="tombol_tolak_2<?= $id_syarat_sempro ?>" value="Tolak" class="btn btn-danger btn-sm" <?= $hidden ?> >
												<div id="success_text_2<?= $id_syarat_sempro ?>"></div>
												<?php  } ?>
											</td>      
											<script>
												$(document).ready(function() {
													$('#open_file2<?= $id_syarat_sempro ?>').on('click', function() {
														var id_syarat_sempro = "<?= $id_syarat_sempro ?>";
														$.ajax({
															url: "<?php echo site_url("/tu/monitoring_sempro/open_file");?>",
															type: "POST",
															data: {
																id_syarat_sempro: id_syarat_sempro,
																file_open: 'Pengecekan Berkas SPP untuk Persyaratan Sempro Mahasiswa oleh Tata Usaha',
															},
															cache: false,
															success: function(response){

																document.getElementById("tombol_setuju_2<?= $id_syarat_sempro ?>").hidden = false;
																document.getElementById("tombol_tolak_2<?= $id_syarat_sempro ?>").hidden = false;
															},
															error: function(XMLHttpRequest, textStatus, errorThrown) { 
																alert("Status: " + textStatus); alert("Error: " + errorThrown); 
															}  
														});
													});
												});

												$(document).ready(function() {
													$('#tombol_setuju_2<?= $id_syarat_sempro ?>').on('click', function() {
														var id_syarat_sempro = "<?= $id_syarat_sempro ?>";
														$.ajax({
															url: "<?php echo site_url("/tu/monitoring_sempro/setuju_berkas");?>",
															type: "POST",
															data: {
																id_syarat_sempro: id_syarat_sempro,
																status_persetujuan: 'Berkas Disetujui',
																tema_persetujuan: 'Pengecekan Berkas SPP untuk Persyaratan Sempro Mahasiswa oleh Tata Usaha'
															},
															cache: false,
															success: function(response){  
																const jsonObject = JSON.parse(response);
																var hasil1 = jsonObject[0].hasil1;
																var hasil2 = jsonObject[0].hasil2;
																var hasil3 = jsonObject[0].hasil3;
																if(hasil1==1 && hasil2==1 && hasil3==1){
																	document.getElementById("tombol_final<?= $id_syarat_sempro ?>").hidden = false;
																	document.getElementById("text_final<?= $id_syarat_sempro ?>").hidden = true;
																}
																document.getElementById("success_text_2<?= $id_syarat_sempro ?>").innerText = "Sudah direspon";
																document.getElementById("tombol_setuju_2<?= $id_syarat_sempro ?>").hidden = true;
																document.getElementById("tombol_tolak_2<?= $id_syarat_sempro ?>").hidden = true;
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
												<a target="_BLANK" id="open_file3<?= $id_syarat_sempro ?>" href="<?php echo base_url('templates/file/mahasiswa/syarat_sempro/proposal/'.$i['file_proposal']) ?>">Berkas Proposal</a><br>
											</td>
											<td class="text-center">
												<?php 
												$tema = "Pengecekan Berkas Proposal untuk Persyaratan Sempro Mahasiswa oleh Tata Usaha";
												if ($this->m_monitoring_sempro->cekResponTU($id_syarat_sempro, $tema)>0) { 
													?>
													<div>Sudah Direspon</div>
													<?php 
												}else{ 
													$open_file = "Pengecekan Berkas Proposal untuk Persyaratan Sempro Mahasiswa oleh Tata Usaha";
													if ($this->m_monitoring_sempro->cekOpenFile($id_syarat_sempro, $open_file)>0) {
														$hidden = "";
													}else{
														$hidden = "hidden";
													}
													?>
													<input type="submit" name="tombol_setuju" id="tombol_setuju_3<?= $id_syarat_sempro ?>" value="Setujui" class="btn btn-primary btn-sm" <?= $hidden ?> >
													<input data-toggle="modal" data-target="#ModaltolakSatuan3<?php echo $i['id_syarat_sempro'] ?>" type="button" id="tombol_tolak_3<?= $id_syarat_sempro ?>" value="Tolak" class="btn btn-danger btn-sm" <?= $hidden ?> >
													<div id="success_text_3<?= $id_syarat_sempro ?>"></div>
													<?php  } ?>
												</td>      
												<script>
													$(document).ready(function() {
														$('#open_file3<?= $id_syarat_sempro ?>').on('click', function() {
															var id_syarat_sempro = "<?= $id_syarat_sempro ?>";
															$.ajax({
																url: "<?php echo site_url("/tu/monitoring_sempro/open_file");?>",
																type: "POST",
																data: {
																	id_syarat_sempro: id_syarat_sempro,
																	file_open: 'Pengecekan Berkas Proposal untuk Persyaratan Sempro Mahasiswa oleh Tata Usaha',
																},
																cache: false,
																success: function(response){

																	document.getElementById("tombol_setuju_3<?= $id_syarat_sempro ?>").hidden = false;
																	document.getElementById("tombol_tolak_3<?= $id_syarat_sempro ?>").hidden = false;
																},
																error: function(XMLHttpRequest, textStatus, errorThrown) { 
																	alert("Status: " + textStatus); alert("Error: " + errorThrown); 
																}  
															});
														});
													});

													$(document).ready(function() {
														$('#tombol_setuju_3<?= $id_syarat_sempro ?>').on('click', function() {
															var id_syarat_sempro = "<?= $id_syarat_sempro ?>";
															$.ajax({
																url: "<?php echo site_url("/tu/monitoring_sempro/setuju_berkas");?>",
																type: "POST",
																data: {
																	id_syarat_sempro: id_syarat_sempro,
																	status_persetujuan: 'Berkas Disetujui',
																	tema_persetujuan: 'Pengecekan Berkas Proposal untuk Persyaratan Sempro Mahasiswa oleh Tata Usaha'
																},
																cache: false,
																success: function(response){  
																	const jsonObject = JSON.parse(response);
																	var hasil1 = jsonObject[0].hasil1;
																	var hasil2 = jsonObject[0].hasil2;
																	var hasil3 = jsonObject[0].hasil3;
																	if(hasil1==1 && hasil2==1 && hasil3==1){
																		document.getElementById("tombol_final<?= $id_syarat_sempro ?>").hidden = false;
																		document.getElementById("text_final<?= $id_syarat_sempro ?>").hidden = true;
																	}
																	document.getElementById("success_text_3<?= $id_syarat_sempro ?>").innerText = "Sudah direspon";
																	document.getElementById("tombol_setuju_3<?= $id_syarat_sempro ?>").hidden = true;
																	document.getElementById("tombol_tolak_3<?= $id_syarat_sempro ?>").hidden = true;
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
				</div>
			</div>
		</div>
	</div>

<?php endforeach;  ?> 


<!-- MODAL DISETUJUI DATA PENGAJUAN SK -->
<?php 
$no = 1;
foreach ($pencarian_data as $i):

	?>
<div class="modal fade" id="Modalsetuju<?php echo $i['id_syarat_sempro']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><b class="text-primary">DATA DISETUJUI</b></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form action="<?php echo site_url('/tu/monitoring_sempro/persetujuan') ?>" method ="post">
				<div class="modal-body"> 
					<label>Apakah semua persyaratan disetujui ?</label>
				</div>
				<input type="hidden" name="id_syarat_sempro" value="<?php echo $i['id_syarat_sempro']  ?>"></input>
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
<div class="modal fade" id="Modaltolak<?php echo $i['id_syarat_sempro']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
				<form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/tu/monitoring_sempro/persetujuan')?>">
					<div class="form-group">
						<input type="hidden" name="id_syarat_sempro" value="<?php echo $i['id_syarat_sempro'] ?>" class="form-control"></input>
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
<div class="modal fade" id="ModaltolakSatuan1<?php echo $i['id_syarat_sempro'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
						<input type="checkbox" id="checkItem1<?php echo $i['id_syarat_sempro'] ?>" name="alasan_ditolak[]" value="Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas.." > Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas..<br>
						<input type="text" name="alasan_ditolak1<?php echo $i['id_syarat_sempro'] ?>" class="form-control" placeholder="Inputkan Alasan Lain"></input>
					</div>
					<div class="modal-footer">
						<button class="btn btn-danger" type="reset" data-dismiss="modal">Tutup</button>
						<button class="btn btn-primary" type="button" id="btn-tolak1<?php echo $i['id_syarat_sempro'] ?>" onclick="btn_tolak1(<?php echo $i['id_syarat_sempro'] ?>)">Submit</button>
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
		var tema = 'Pengecekan Berkas KRS untuk Persyaratan Sempro Mahasiswa oleh Tata Usaha';
		$.ajax({
			url:"<?php echo site_url('/tu/monitoring_sempro/tolak_berkas')?>",
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
				if(hasil1==1 && hasil2==1 && hasil3==1){
					document.getElementById("tombol_final<?= $id_syarat_sempro ?>").hidden = false;
					document.getElementById("text_final<?= $id_syarat_sempro ?>").hidden = true;
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
<div class="modal fade" id="ModaltolakSatuan2<?php echo $i['id_syarat_sempro'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
						<input type="checkbox" id="checkItem2<?php echo $i['id_syarat_sempro'] ?>" name="alasan_ditolak[]" value="Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas.." > Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas..<br>
						<input type="text" name="alasan_ditolak2<?php echo $i['id_syarat_sempro'] ?>" class="form-control" placeholder="Inputkan Alasan Lain"></input>
					</div>
					<div class="modal-footer">
						<button class="btn btn-danger" type="reset" data-dismiss="modal">Tutup</button>
						<button class="btn btn-primary" type="button" id="btn-tolak2<?php echo $i['id_syarat_sempro'] ?>" onclick="btn_tolak2(<?php echo $i['id_syarat_sempro'] ?>)">Submit</button>
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
		var tema = 'Pengecekan Berkas SPP untuk Persyaratan Sempro Mahasiswa oleh Tata Usaha';
		$.ajax({
			url:"<?php echo site_url('/tu/monitoring_sempro/tolak_berkas')?>",
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
				if(hasil1==1 && hasil2==1 && hasil3==1){
					document.getElementById("tombol_final<?= $id_syarat_sempro ?>").hidden = false;
					document.getElementById("text_final<?= $id_syarat_sempro ?>").hidden = true;
				}
          // document.getElementById("success_text_2<?= $id_syarat_sempro ?>").innerText = "Sudah direspon";
          // document.getElementById("tombol_setuju_2<?= $id_syarat_sempro ?>").hidden = true;
          // document.getElementById("tombol_tolak_2<?= $id_syarat_sempro ?>").hidden = true;
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
<div class="modal fade" id="ModaltolakSatuan3<?php echo $i['id_syarat_sempro'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
						<input type="checkbox" id="checkItem3<?php echo $i['id_syarat_sempro'] ?>" name="alasan_ditolak[]" value="Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas.." > Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas..<br>
						<input type="text" name="alasan_ditolak3<?php echo $i['id_syarat_sempro'] ?>" class="form-control" placeholder="Inputkan Alasan Lain"></input>
					</div>
					<div class="modal-footer">
						<button class="btn btn-danger" type="reset" data-dismiss="modal">Tutup</button>
						<button class="btn btn-primary" type="button" id="btn-tolak3<?php echo $i['id_syarat_sempro'] ?>" onclick="btn_tolak3(<?php echo $i['id_syarat_sempro'] ?>)">Submit</button>
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
		var tema = 'Pengecekan Berkas Proposal untuk Persyaratan Sempro Mahasiswa oleh Tata Usaha';
		$.ajax({
			url:"<?php echo site_url('/tu/monitoring_sempro/tolak_berkas')?>",
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
				if(hasil1==1 && hasil2==1 && hasil3==1){
					document.getElementById("tombol_final<?= $id_syarat_sempro ?>").hidden = false;
					document.getElementById("text_final<?= $id_syarat_sempro ?>").hidden = true;
				}
          // document.getElementById("success_text_2<?= $id_syarat_sempro ?>").innerText = "Sudah direspon";
          // document.getElementById("tombol_setuju_2<?= $id_syarat_sempro ?>").hidden = true;
          // document.getElementById("tombol_tolak_2<?= $id_syarat_sempro ?>").hidden = true;
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
