<div class="col-lg-12 mb-1">
	<div class="card shadow mb-4">
		<div class="card-header">
			<h5 class="m-0 font-weight-bold text-primary">Pengajuan SK Pembimbing Skripsi</h5>
		</div>
		<div class="card-body">
			<?php if($this->m_skripsi->cekNilaiKP($_SESSION['npm'])>0){ ?>
			<?php echo $this->session->flashdata('messege'); ?>
			<div class="ml-md-auto py-2 py-md-0">
			</div>
			<div class="table-responsive">
				<table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
					<thead class="table table-primary">
						<tr>
							<td align="center" width="30"><b>SYARAT SK</b></td>
							<td align="center" width="130"><b>JUDUL</b></td>  	
							<td align="center" width="130"><b>BERKAS SPP</b></td>  
							<td align="center" width="130"><b>BERKAS TRANSKIP</b></td>  
							<td align="center" width="130"><b>BERKAS KRS</b></td>  
							<td align="center" width="130"><b>BERKAS PROPOSAL</b></td>   
							<td align="center" width="130"><b>STATUS VALIDASI</b></td>
							<td align="center" width="50"><b>USULAN PEMBIMBING</b></td>  
							<td align="center" width="130"><b>BERKAS SK</b></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>

								<?php
							// 	if (isset($_SESSION['kode_prodi'])) {
							// 	echo 'cwvw'; die();
							// }else{
							// 	echo 'qqqqqq';
							// }
								$cekSkripsi = $this->m_skripsi->cekSkripsi($_SESSION['npm']);
								if($cekSkripsi->num_rows()<1){
									echo '<i class="fas fa-plus text-primary"data-toggle="modal" data-target="#ModalTambahSkripsi"> Tambah</i>';
								}else{
									$baris = $cekSkripsi->row();
									if ($baris) {
										$id_skripsi 		= $baris->id_skripsi;
										$npm        		= $baris->npm;
										$judul      		= $baris->judul;
										$file_spp      		= $baris->file_spp;
										$file_transkrip     = $baris->file_transkrip;
										$file_krs     		= $baris->file_krs;
										$file_laporan      	= $baris->file_laporan;
										?>

										<div class="modal fade" id="ModalPilihDospem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
										aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel"><b class="text-success">Pilih Pembimbing</b></h5>
													<button class="close" type="button" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
												</div>
												<div class="modal-body"> 
													<form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/skripsi/usulan_dospem')?>">          
														<div class="form-group">
															<select name="npk" class="form-control" required>
																<option value="">
																	--Pilih Dosen--
																</option>
																<?php 
																$kode_prodi = $_SESSION['kode_prodi'];			
																foreach ($pencarian_dospem as $item): 
																	?>
																<option value="<?php echo $item['npk']  ?>"><?php echo $item['nama_dosen'].' ('.$item['jabatan_fungsional'].') - '.$this->m_skripsi->hitung_jumlah_dibimbing($item['npk']).' Mahasiswa' ?></option>
																<?php 
																endforeach; 
																?>	
															</select>
														</div>
														<div class="modal-footer">
															<input type="hidden" name="id_skripsi" value="<?php echo $id_skripsi ?>"></input>
															<button class="btn btn-secondary" type="reset" data-dismiss="modal">Tutup</button>
															<button class="btn btn-primary" type="submit" name="tombolPilihPembimbing">Simpan</button>
														</div>
													</form>  
												</div>
											</div>
										</div>
									</div>
									<?php 
								}          
								if($this->m_skripsi->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Disetujui', '')<=0){
									echo '<i class="fa fa-eye" data-toggle="modal" data-target="#ModalLihatSkripsi"> </i>';       
								}
								else{
									echo '<a class="btn btn-danger text-white border-white custom-btn btn-sm" data-toggle="modal" data-target="#ModalHapusSkripsi"><i class="fa fa-trash"></i> Hapus Syarat SK</a>';
								}
							}
							?>
						</td>
						<td>
							<?php if (isset($judul)) {
								echo $judul;
							} ?>
						</td>
						<td class="text-left">
							<?php
							$cekSkripsi = $this->m_skripsi->cekSkripsi($_SESSION['npm']);
							$tema1= 'Pengecekan Berkas SPP dasar untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha';
							if($this->m_skripsi->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Disetujui', $tema1)>0){
								echo '<b class="text-success">Berkas Tervalidasi</b>';
							}elseif($this->m_skripsi->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Ditolak', $tema1)>0){
								?>
								<form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/skripsi/upload_file')?>">
									<div class="form-group">
										<b class="btn text-danger" data-toggle="modal" data-target="#Modal"><i class="fas fa-eye">Data ditolak </i></b>;
										<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
										aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel"><b class="text-danger">Data ditolak</b></h5>
													<button class="close" type="button" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
												</div>
												<div class="modal-body">
													<?php 
													echo $this->m_skripsi->alasan_ditolak($id_skripsi, $tema1) ?>
												</div>
											</div>
										</div>
									</div> 										
									<a target="_BLANK" href="<?php echo base_url("templates/file/mahasiswa/syarat_sk/skripsi/spp/".$file_spp) ?>">(Lihat File)</a><br>
									<input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>            
									<input type="hidden" value="<?php echo $file_spp ?>" name="file_lama"></input> 
									<input type="hidden" value="<?php echo $id_skripsi ?>" name="id_skripsi"></input><br> 
									<button class="btn btn-primary" type="submit" name="tombol_upload_file1">Submit</button>
								</div>
							</form>  
							<?php
						}elseif($cekSkripsi->num_rows()==0){
								// echo '-';
							echo '';
						}else{
							?>
							<form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/skripsi/upload_file')?>">
								<div class="form-group">
									<b class="text-warning">Menunggu Validasi</b>
									<a target="_BLANK" href="<?php echo base_url("templates/file/mahasiswa/syarat_sk/skripsi/spp/".$file_spp) ?>"><br>(Lihat File)</a><br>
									<input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>            
									<input type="hidden" value="<?php echo $file_spp ?>" name="file_lama"></input> 
									<input type="hidden" value="<?php echo $id_skripsi ?>" name="id_skripsi"></input><br> 
									<center><button class="btn btn-primary" type="submit" name="tombol_upload_file1">Submit</button></center>
								</div>
							</form>  
							<?php
						}
						?>
					</td>							
					<td class="text-left">
						<?php
						$cekSkripsi = $this->m_skripsi->cekSkripsi($_SESSION['npm']);
						$tema2= 'Pengecekan Berkas Transkrip Nilai untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha';
						if($this->m_skripsi->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Disetujui', $tema2)>0){
							echo '<b class="text-success">Berkas Tervalidasi</b>';
						}elseif($this->m_skripsi->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Ditolak', $tema2)>0){
							?>
							<form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/skripsi/upload_file')?>">
								<div class="form-group">
									<b class="btn text-danger" data-toggle="modal" data-target="#Modal2"><i class="fas fa-eye">Data ditolak </i></b>;
									<div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
									aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel"><b class="text-danger">Data ditolak</b></h5>
												<button class="close" type="button" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">×</span>
												</button>
											</div>
											<div class="modal-body">
												<?php 
												echo $this->m_skripsi->alasan_ditolak($id_skripsi, $tema2) ?>
											</div>
										</div>
									</div>
								</div> 											
								<a target="_BLANK" href="<?php echo base_url("templates/file/mahasiswa/syarat_sk/skripsi/transkrip/".$file_transkrip) ?>">(Lihat File)</a><br>
								<input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>            
								<input type="hidden" value="<?php echo $file_transkrip ?>" name="file_lama"></input> 
								<input type="hidden" value="<?php echo $id_skripsi ?>" name="id_skripsi"></input><br> 
								<button class="btn btn-primary" type="submit" name="tombol_upload_file2">Submit</button>
							</div>
						</form>  
						<?php
					}elseif($cekSkripsi->num_rows()==0){
								// echo '-';
						echo '';
					}else{
						?>
						<form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/skripsi/upload_file')?>">
							<div class="form-group">
								<b class="text-warning">Menunggu Validasi</b>
								<a target="_BLANK" href="<?php echo base_url("templates/file/mahasiswa/syarat_sk/skripsi/transkrip/".$file_transkrip) ?>"><br>(Lihat File)</a><br>
								<input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>            
								<input type="hidden" value="<?php echo $file_transkrip ?>" name="file_lama"></input> 
								<input type="hidden" value="<?php echo $id_skripsi ?>" name="id_skripsi"></input><br> 
								<center><button class="btn btn-primary" type="submit" name="tombol_upload_file2">Submit</button></center>
							</div>
						</form>  
						<?php
					}
					?>
				</td>				
				<td class="text-left">
					<?php
					$cekSkripsi = $this->m_skripsi->cekSkripsi($_SESSION['npm']);
					$tema3= 'Pengecekan Berkas KRS untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha';
					if($this->m_skripsi->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Disetujui', $tema3)>0){
						echo '<b class="text-success">Berkas Tervalidasi</b>';
					}elseif($this->m_skripsi->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Ditolak', $tema3)>0){
						?>
						<form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/skripsi/upload_file')?>">
							<div class="form-group">
								<b class="btn text-danger" data-toggle="modal" data-target="#Modal3"><i class="fas fa-eye">Data ditolak </i></b>;
								<div class="modal fade" id="Modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
								aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel"><b class="text-danger">Data ditolak</b></h5>
											<button class="close" type="button" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">×</span>
											</button>
										</div>
										<div class="modal-body">
											<?php 
											echo $this->m_skripsi->alasan_ditolak($id_skripsi, $tema3) ?>
										</div>
									</div>
								</div>
							</div> 										
							<a target="_BLANK" href="<?php echo base_url("templates/file/mahasiswa/syarat_sk/skripsi/krs/".$file_krs) ?>">(Lihat File)</a><br>
							<input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>            
							<input type="hidden" value="<?php echo $file_krs ?>" name="file_lama"></input> 
							<input type="hidden" value="<?php echo $id_skripsi ?>" name="id_skripsi"></input><br> 
							<button class="btn btn-primary" type="submit" name="tombol_upload_file3">Submit</button>
						</div>
					</form>  
					<?php
				}elseif($cekSkripsi->num_rows()==0){
								// echo '-';
					echo '';
				}else{
					?>
					<form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/skripsi/upload_file')?>">
						<div class="form-group">
							<b class="text-warning">Menunggu Validasi</b>
							<a target="_BLANK" href="<?php echo base_url("templates/file/mahasiswa/syarat_sk/skripsi/krs/".$file_krs) ?>"><br>(Lihat File)</a><br>
							<input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>            
							<input type="hidden" value="<?php echo $file_krs ?>" name="file_lama"></input> 
							<input type="hidden" value="<?php echo $id_skripsi ?>" name="id_skripsi"></input><br> 
							<center><button class="btn btn-primary" type="submit" name="tombol_upload_file3">Submit</button></center>
						</div>
					</form>  
					<?php
				}
				?>
			</td>	
			<td class="text-left">
				<?php
				$cekSkripsi = $this->m_skripsi->cekSkripsi($_SESSION['npm']);
				$tema4= 'Pengecekan File Proposal Skripsi untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha';
				if($this->m_skripsi->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Disetujui', $tema4)>0){
					echo '<b class="text-success">Berkas Tervalidasi</b>';
				}elseif($this->m_skripsi->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Ditolak', $tema4)>0){
					?>
					<form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/skripsi/upload_file')?>">
						<div class="form-group">
							<b class="btn text-danger" data-toggle="modal" data-target="#Modal4"><i class="fas fa-eye">Data ditolak </i></b>;
							<div class="modal fade" id="Modal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
							aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel"><b class="text-danger">Data ditolak</b></h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										<?php 
										echo $this->m_skripsi->alasan_ditolak($id_skripsi, $tema4) ?>
									</div>
								</div>
							</div>
						</div> 									
						<a target="_BLANK" href="<?php echo base_url("templates/file/mahasiswa/syarat_sk/skripsi/laporan/".$file_laporan) ?>">(Lihat File)</a><br>
						<input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>            
						<input type="hidden" value="<?php echo $file_laporan ?>" name="file_lama"></input> 
						<input type="hidden" value="<?php echo $id_skripsi ?>" name="id_skripsi"></input><br> 
						<button class="btn btn-primary" type="submit" name="tombol_upload_file4">Submit</button>
					</div>
				</form>  
				<?php
			}elseif($cekSkripsi->num_rows()==0){
								// echo '-';
				echo '';
			}else{
				?>
				<form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/skripsi/upload_file')?>">
					<div class="form-group">
						<b class="text-warning">Menunggu Validasi</b>
						<a target="_BLANK" href="<?php echo base_url("templates/file/mahasiswa/syarat_sk/skripsi/laporan/".$file_laporan) ?>"><br>(Lihat File)</a><br>
						<input type="file" accept="application/pdf"  class="form-control-file" name="file" id="file" required>            
						<input type="hidden" value="<?php echo $file_laporan ?>" name="file_lama"></input> 
						<input type="hidden" value="<?php echo $id_skripsi ?>" name="id_skripsi"></input><br> 
						<center><button class="btn btn-primary" type="submit" name="tombol_upload_file4">Submit</button></center>
					</div>
				</form>  
				<?php
			}
			?>
		</td>								
		<td>
			<?php
			$cekSkripsi = $this->m_skripsi->cekSkripsi($_SESSION['npm']);
			if($this->m_skripsi->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Disetujui','Pengecekan Berkas Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha')>0){
				echo '<b class="text-success">Berkas disetujui, Silahkan tunggu hingga Proses Selesai</b>';
			}elseif($this->m_skripsi->cekStatusPersetujuanTU($_SESSION['npm'], 'Berkas Ditolak','Pengecekan Berkas Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha')>0){
				echo '<b class="btn text-danger" data-toggle="modal" data-target="#ModalAlasanDitolakTU4'.$id_skripsi.'"><i class="fas fa-eye">Data ditolak </i></b>';
				?>
				<!-- MODAL ALASAN DITOLAK TU -->
				<div class="modal fade" id="ModalAlasanDitolakTU4<?= $id_skripsi ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
					aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"><b class="text-danger">Data ditolak</b></h5>
								<button class="close" type="button" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
							<div class="modal-body">
								<?php 
								foreach ($this->m_skripsi->alasan_ditolak($npm, $id_skripsi) as $n): ?>
								<?php echo $n['alasan_ditolak'];?>
							<?php endforeach ?>
						</div>
					</div>
				</div>
			</div>

			<?php 
		}elseif($cekSkripsi->num_rows()>0){
			echo '<b class="text-warning">Menunggu Validasi Berkas</b>';
		}elseif($cekSkripsi->num_rows()==0){
								// echo '-';
			echo '';
		}else{
								// echo '-';
			echo '';
		}
		?>
	</td>							
	<td>
		<?php if (isset($id_skripsi)){
			if ($this->m_monitoring_skripsi->cekUsulanDospem($id_skripsi)<=0) {      
				?>
				<a class="btn btn-success text-white border-white custom-btn btn-sm" data-toggle="modal" data-target="#ModalPilihDospem">Pilih Pembimbing</a>
				<?php } elseif ($this->m_monitoring_skripsi->cekSetujuTolak($id_skripsi, "Usulan Disetujui")>0) {
					echo '<b class="text-success">Usulan disetujui Prodi, tunggu konfirmasi lebih lanjut</b>';


				} elseif ($this->m_monitoring_skripsi->cekSetujuTolak($id_skripsi, "")>0) {
					echo '<b class="text-warning">Menunggu Persetujuan Usulan</b>';
				} elseif ($this->m_monitoring_skripsi->cekSetujuTolak($id_skripsi, "Usulan Ditolak")>0) {
					echo '<b class="btn text-danger" data-toggle="modal" data-target="#ModalAlasanDitolakTU'.$id_skripsi.'"><i class="fas fa-eye">Usulan ditolak </i></b>';
					?>
					<!-- MODAL ALASAN DITOLAK TU -->
					<div class="modal fade" id="ModalAlasanDitolakTU<?= $id_skripsi ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
						aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel"><b class="text-danger">KETERANGAN PENOLAKAN USULAN</b></h5>
									<button class="close" type="button" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
								</div>
								<div class="modal-body">
									<?php 
									foreach ($this->m_skripsi->alasan_ditolak_usulan($id_skripsi) as $n): ?>
									<?php echo $n['alasan_ditolak'];?>
								<?php endforeach ?>
							</div>
						</div>
					</div>
				</div> 
				<!-- <a class="btn btn-success text-white border-white custom-btn btn-sm" data-toggle="modal" data-target="#ModalPilihDospem">Pilih Pembimbing</a> -->

				<?php }else{ ?>
				<b class="text-warning">Tunggu Respon Prodi</b>
				<?php } }?>
			</td>
			<td>
				<?php
				if (isset($id_skripsi)) {
					$cekSK = $this->m_monitoring_skripsi->cekResponSKFakultas($id_skripsi);
					if($cekSK>0){
						?> 
						<a target="_BLANK" href="<?php echo site_url('/mahasiswa/skripsi/cetak_sk_pembimbing_skripsi/').$id_skripsi ?>"><i class="fas fa-download text-success"> Unduh</i></a>
						<?php
					} else {
						echo 'Tidak Ada Berkas';
					}              
				} else{
					echo '';
				}
				?>
			</td>
		</tr>
	</tbody>
</table>
</div>
<?php }else{ echo '<marquee><h3 class="text-danger">Silahkan selesaikan KP terlebih dahulu ..</h3></marquee>'; } ?>
</div>

</div>
</div>

<!-- MODAL TAMBAH DATA SK SKRIPSI -->
<div class="modal fade" id="ModalTambahSkripsi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel"><b class="text-primary">Tambah Data Pengurusan SK Skripsi</b></h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<div class="modal-body">
			<form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/skripsi/tambah_data_skripsi')?>">
				<div class="form-group">
					<label class="bmd-label-floating">Judul</label>
					<input type="hidden" value="<?= "2" ?>" name="id_jenis_sk" class="form-control"></input>
					<input type="text" name="judul" class="form-control" required=""></input>
				</div>
				<div class="form-group">
					<label class="bmd-label-floating">Upload Bukti Pembayaran SPP</label>
					<input type="file" accept="application/pdf"  class="form-control-file" name="file_spp" id="file_spp" required>				
				</div>
				<div class="form-group">
					<label class="bmd-label-floating">Upload Transkip Nilai Sementara</label>
					<input type="file" accept="application/pdf"  class="form-control-file" name="file_transkrip" id="file_transkrip" required>
				</div>
				<div class="form-group">
					<label class="bmd-label-floating">Upload KRS</label>
					<input type="file" accept="application/pdf"  class="form-control-file" name="file_krs" id="file_krs" required>
				</div>
				<div class="form-group">
					<label class="bmd-label-floating">Upload Proposal Skripsi</label>
					<input type="file" accept="application/pdf"  class="form-control-file" name="file_laporan" id="file_laporan" required>
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="reset" data-dismiss="modal">Tutup</button>
					<button class="btn btn-primary" type="submit" name="tombolPengajuanSK">Submit</button>
				</div>
			</form>  
		</div>
	</div>
</div>
</div>

<!-- MODAL EDIT DATA PENGAJUAN SK -->
<?php 
if ($row_data) {
	$id_skripsi   	= $row_data->id_skripsi;
	$id_jenis_sk    = $row_data->id_jenis_sk;
	$npm            = $row_data->npm;
	// $npk            = $row_data->npk;
	$judul        	= $row_data->judul;
	$file_spp       = $row_data->file_spp;
	$file_transkrip	= $row_data->file_transkrip;
	$file_krs       = $row_data->file_krs;
	$file_laporan   = $row_data->file_laporan;
	?>
	<div class="modal fade" id="ModalLihatSkripsi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Data Pengajuan SK Skripsi</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('/mahasiswa/skripsi/edit_data')?>">
					<!-- <div class="form-group">
						<input type="hidden" value="<?= $id_skripsi ?>" name="id_skripsi" class="form-control"></input>
						<label>Usulan Dosen Pembimbing</label>
						<select name="npk" class="form-control">
							<option value="">
								--Pilih Dosen--
							</option>
							<?php 
							foreach ($this->m_skripsi->combobox_dosen($_SESSION['kode_prodi']) as $a): 
								?>
							<option value="<?php echo $a['npk']  ?>" <?php if (isset($npk)) {
								if ($npk== $a['npk']) {
									echo 'selected';
								}
							} ?>><?php echo $a['nama_dosen']  ?></option>
							<?php 
							endforeach; ?>
						</select>				
					</div> -->
					<div class="form-group">
						<label>Judul</label>
						<input type="text" name="judul" class="form-control" value="<?php echo $judul ?>"readonly></input>
					</div>
					<div class="form-group">
						<label class="bmd-label-floating">LIHAT FILE BERKAS</label><br>
						<a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/skripsi/spp/'.$file_spp) ?>">Bukti Pembayaran SPP Dasar</a><br>
						<a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/skripsi/transkrip/'.$file_transkrip) ?>">Bukti Transkip Nilai Sementara</a><br>
						<a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/skripsi/krs/'.$file_krs) ?>">Bukti KRS</a><br>
						<a target="_BLANK" href="<?php echo base_url('templates/file/mahasiswa/syarat_sk/skripsi/laporan/'.$file_laporan) ?>">File Proposal</a>
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
<?php 
}
?>

<!-- MODAL ALASAN DITOLAK TU -->
<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel"><b class="text-danger">Data ditolak</b></h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<div class="modal-body">
			Berkas Tidak Sesuai Standar, Silahkan Cek Kembali Berkas..
		</div>
	</div>
</div>
</div>


