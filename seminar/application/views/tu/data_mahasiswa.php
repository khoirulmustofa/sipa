<div class="col-lg-12 mb-1">
	<?php echo $this->session->flashdata('messege'); ?>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h5 class="m-0 font-weight-bold text-primary">PENGAJUAN SK MAHASISWA</h5>
		</div><br>
		<div class="content">
			<div class="container-fluid">
				<div class="card shadow mb-4">
					<div class="card-body">
						<form action="<?php echo site_url().'/tu/data_mahasiswa'; ?>" method="post" enctype="multipart/form-data">
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
											<td align="center"><b>AKSI</b></td>
										</tr>
									</thead>
									<tbody>
										<?php 
										$no = 1;
										foreach ($pencarian_data as $i):
											$npm       		= $i['npm'];
										$nama_mahasiswa = $i['nama_mahasiswa'];
										?>
										<tr>
											<td><?php echo $no++;?></td>
											<td><?php echo $npm;?></td>
											<td><?php echo ucwords($nama_mahasiswa);?></td>
											<td>		
												<button class="btn btn-warning" data-toggle="modal" data-target="#ModalEdit<?php echo $npm ?>">Edit</button>
												<button class="btn btn-primary" data-toggle="modal" data-target="#ModalResetPW<?php echo $npm ?>">Reset PW</button>

											</td>
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
	$npm            = $i['npm'];
	$nama_mahasiswa = $i['nama_mahasiswa'];
	$no_hp       	= $i['no_hp'];
	$no_ktp       	= $i['no_ktp'];
	$email_student  = $i['email_student'];
	$email_umum     = $i['email_umum'];
	$alamat       	= $i['alamat'];
	$nama_prodi     = $i['nama_prodi'];
	?>
	<div class="modal fade" id="ModalEdit<?php echo $i['npm']  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><b class="text-warning">Data Mahasiswa</b></h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body"> 
					<form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/tu/data_mahasiswa/edit_nama')?>">
						<div class="form-group">
							<label>NPM</label>
							<input type="hidden" value="<?= $npm ?>" name="npm" class="form-control"></input>
							<input type="text" name="npm" class="form-control" value="<?php echo $i['npm'] ?>" readonly></input>
						</div>
						<div class="form-group">
							<label>Nama Mahasiswa</label>
							<input type="text" name="nama_mahasiswa" class="form-control" value="<?php echo $i['nama_mahasiswa'] ?>" ></input>
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<input type="text" name="alamat" class="form-control" value="<?php echo $i['alamat'] ?>" ></input>
						</div>
						<div class="form-group">
							<label>Program Studi</label>
							<input type="text" name="nama_prodi" class="form-control" value="<?php echo $i['nama_prodi'] ?>" readonly></input>
						</div>
						<div class="form-group">
							<label>No HP</label>
							<input type="text" name="no_hp" class="form-control" value="<?php echo $i['no_hp'] ?>" ></input>
						</div>
						<div class="form-group">
							<label>No KTP</label>
							<input type="text" name="no_ktp" class="form-control" value="<?php echo $i['no_ktp'] ?>" ></input>
						</div>
						<div class="form-group">
							<label>Email Student</label>
							<input type="text" name="email_student" class="form-control" value="<?php echo $i['email_student'] ?>" ></input>
						</div>
						<div class="form-group">
							<label>Email Pribadi</label>
							<input type="text" name="email_umum" class="form-control" value="<?php echo $i['email_umum'] ?>" ></input>
						</div>
						<div class="modal-footer">
							<button class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Tutup</button>
							<button class="btn btn-primary" name="tombolSimpan">Simpan</button>
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
	$npm                  = $i['npm'];
	$nama_mahasiswa       = $i['nama_mahasiswa'];
	?>

<!-- ============ MODAL RESET PASSWORD =============== -->
<div class="modal fade" id="ModalResetPW<?php echo $npm;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title text-primary" id="myModalLabel"><b>Reset Password</b></h3>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			</div>
			<form class="form-horizontal" method="post" action="<?php echo site_url().'/tu/data_mahasiswa/reset_password'?>">
				<div class="modal-body">
					<div class="form-group">
						<label>Password Baru</label>
						<input type="password" name="password_baru" class="form-control" placeholder="Password Baru" required>
					</div>
					<div class="form-group">
						<label>Konfirmasi Password Baru</label>
						<input type="password" name="konfirmasi_password_baru" class="form-control" placeholder="Konfirmasi Password Baru" required>
					</div>

				</div>
				<div class="modal-footer">
					<input type="hidden" name="npm" value="<?php echo $npm;?>">
					<button class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Tutup</button>
					<button class="btn btn-primary" name="reset_password">Reset Sekarang</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php endforeach;?>