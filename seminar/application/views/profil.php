<div class="col-lg-12 mb-1">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<?php echo $this->session->flashdata('messege'); ?>
			<h5 class="m-0 font-weight-bold text-primary">PROFIL</h5>
		</div>
		<div class="content">
			<div class="row">        
				<div class="card-body">
					<form  action="<?php echo site_url().'/profil/editProfil'?>" method="post" class="contact-form" enctype="multipart/form-data">    
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label class="bmd-label-floating">NPM</label>
									<input type="text" class="form-control" name="npm" value="<?php echo $_SESSION['npm'];?>" readonly>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="bmd-label-floating">Prodi</label>
									<input type="text" class="form-control" name="nama_prodi" value="<?php echo $_SESSION['nama_prodi'];?>" readonly>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="bmd-label-floating">Nama Mahasiswa</label>
									<input type="text" class="form-control" name="nama" value="<?php echo ucwords( $_SESSION['nama']);?>"required>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="bmd-label-floating">Jenis Kelamin</label>
									<select class="form-control" name="jk" required>
										<option value="">--Pilih--</option>
										<option value="Laki-laki" <?php if($_SESSION['jk']=="Laki-laki"){ echo "selected";}?>>Laki-laki</option>
										<option value="Perempuan" <?php if($_SESSION['jk']=="Perempuan"){ echo "selected";}?>>Perempuan</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label class="bmd-label-floating">Agama</label>
									<input type="text" class="form-control" name="agama" value="<?php echo $_SESSION['agama'];?>"required>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="bmd-label-floating">Tempat Lahir</label>
									<input type="text" class="form-control" name="tempat_lahir" value="<?php echo ucwords($_SESSION['tempat_lahir']); ?>"required>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="bmd-label-floating">Tanggal Lahir</label>
									<input type="date" class="form-control" name="tgl_lahir" value="<?php echo $_SESSION['tgl_lahir'];?>"required>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="bmd-label-floating">Alamat</label>
									<input type="text" class="form-control" name="alamat" value="<?php echo ucwords($_SESSION['alamat']); ?>"required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label class="bmd-label-floating">No. WhatsApp</label>
									<input type="text" class="form-control" name="no_hp" value="<?php echo $_SESSION['no_hp'];?>">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="bmd-label-floating">No. KTP</label>
									<input type="text" class="form-control" name="no_ktp" value="<?php echo $_SESSION['no_ktp'];?>">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="bmd-label-floating">Email Student</label>
									<input type="text" class="form-control" name="email_student" value="<?php echo $_SESSION['email_student'];?>">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="bmd-label-floating">Email Umum</label>
									<input type="text" class="form-control" name="email_umum" value="<?php echo $_SESSION['email_umum'];?>">
								</div>
							</div>
						</div>
						<hr>
						<div class="col-md-3">
							<?php if($_SESSION['foto']==""){?>
							<center><img width="200" src="<?php echo base_url('templates')?>/img/inisial/<?php echo $_SESSION['jk'];?>.jpg" alt="foto profil" class="text-center rounded"></center>
							<?php }else{?>
							<img width="200" src="<?php echo base_url('templates')?>/img/mahasiswa/<?php echo $_SESSION['foto'];?>" alt="foto profil" class="text-center rounded">
							<?php }?>
							<div class="form-group">
								<label class="control-label col-xs-3" >Ganti Foto<br><i class="text-danger">1. Ekstensi file : jpg / jpeg / png <br>2. Ukuran maksimal 200 kb)</i></label>
								<div class="col-xs-8">
									<input type="file" name="gambar" >
								</div>
							</div>
						</div>
						<div class="form-group">
							<input type="submit" value="Simpan Perubahan" name="editProfil" class="btn btn-primary">
						</div>					
					</form>
					<hr>
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h5 class="m-0 font-weight-bold text-primary">GANTI PASSWORD</h5>
						</div>
						<div class="content">
							<div class="row">        
								<div class="card-body">
									<div class="col-md-12">
										<?php echo $this->session->flashdata('messege'); ?>
										<div class="card-body text-center">
											<form  action="<?php echo site_url().'/profil/ganti_password'?>" method="post" class="contact-form">
												<div class="row text-left">
													<div class="col-md-4">
														<div class="form-group bg-light">
															<label>Password Lama</label>
															<input type="password" name="password_lama" class="form-control" placeholder="Password lama" required>
														</div>									
													</div>
													<div class="col-md-4">
														<div class="form-group bg-light">
															<label>Password Baru</label>
															<input type="password" name="password_baru" class="form-control" placeholder="Password baru" required>
														</div>
													</div>
													<div class="col-md-4 rounded">
														<div class="form-group bg-light">
															<label>Konfirmasi Password Baru</label>
															<input type="password" name="konfirmasi_password_baru" class="form-control" placeholder="Konfirmasi password baru" required>
														</div>
														<!-- <hr> -->
														<input type="submit" value="Ganti Password" name="ganti_password" class="btn btn-primary">
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
