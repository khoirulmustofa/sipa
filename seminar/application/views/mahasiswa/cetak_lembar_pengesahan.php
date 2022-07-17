<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Lembar Pengesahan</title>
	<style>  </style>
</head>
<body>

	<?php
	if($id_syarat_sk!=null){
		$row = $this->m_sk->get_row_data_syarat_sk($id_syarat_sk);
		if ($row) {
			$nomor_surat            = $row->nomor_surat;
			$tahun                  = $row->tahun;
			$kodemax                = str_pad(($nomor_surat), 4, "0", STR_PAD_LEFT);
			$nomor_surat_full       = ($kodemax).'/KPTS/FT-UIR/KP/'.$tahun;
			$nama_mahasiswa         = $row->nama_mahasiswa;
			$nama_penanda_tangan    = $row->nama_penanda_tangan;
			$npk_penanda_tangan     = $row->npk_penanda_tangan;
			$nama_dosen             = $row->nama_dosen;
			$jabatan_fungsional     = $row->jabatan_fungsional;
			$jabatan_penanda_tangan = $row->jabatan_penanda_tangan;
			$npm                    = $row->npm;
			$nama_prodi             = $row->nama_prodi;
			$judul_kerja_praktik    = $row->judul_kerja_praktik;
			$waktu_input_ttd        = $row->waktu_input_ttd;
			$id_random              = $row->id_random;
			$nama_tempat_kp         = $row->nama_tempat_kp;
			$waktu_mulai_kp         = $row->waktu_mulai_kp;
			$waktu_selesai_kp       = $row->waktu_selesai_kp;

			?>
			<div style="padding: 5;">
				<img src="<?php echo base_url('assets/img/kop_teknik.png') ?>" width="100%"><hr>
			</div>
			<div style="padding: 5;">
				<p align="center"><b>LEMBAR PENGESAHAN PEMBIMBING <br>KERJA PRAKTEK (KP)</b></p>
			</div>
			<table border="1" cellpadding="1">
				<tbody>
					<tr>
						<td colspan="2" align="justify">
							<table border="0" width="100%">
								<tbody>
									<tr>           
										<td width="80">Nama</td>           
										<td width="5">:</td>           
										<td><?= ucwords($nama_mahasiswa) ?></td>         
									</tr>
									<tr>           
										<td>NPM</td>           
										<td>:</td>           
										<td><?= $npm ?></td>         
									</tr>
									<tr>           
										<td>Tempat KP</td>           
										<td>:</td>           
										<td><?= $nama_tempat_kp ?></td>         
									</tr>
									<tr>           
										<td>Mulai KP</td>    
										<td>:</td>           
										<td>
											<?= $this->m_sk->format_tanggal(date('Y-m-d', strtotime($waktu_mulai_kp))); ?> 
											s/d                       
											<?= $this->m_monitoring_sk->format_tanggal(date('Y-m-d', strtotime($waktu_selesai_kp))); ?> 
										</td>          
									</tr>
									<tr>           
										<td style="vertical-align: top; text-align: left;">Judul KP</td>  
										<td style="vertical-align: top; text-align: left;">:</td>           
										<td align="justify"><?= $judul_kerja_praktik ?></td>          
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="justify">
							<p>Benar telah disusun dan ditulis sesuai kaidah penulisan karya ilmiah dan data serta informasi yang dianalisis diperoleh dari pengalaman praktis selama kerja praktek. Disamping itu penyusunan laporan ini diketahui juga telah mengacu kepada ketentuan umum dan sistematika yang telah ditetapkan oleh fakultas. </p>
						</td>
					</tr>
					<tr>     
						<td></td>
						<td width="50%">
							Pekanbaru, 
							<?= $this->m_sk->format_tanggal(date('Y-m-d', strtotime($waktu_input_ttd))); ?>
							<br>Pembimbing KP<br>
							<?php 
							QRcode::png(base_url("Validasi_ttd_digital/cek_fakultas/".$id_random),"templates/img/qrcode/barcode_sk_pembimbing_kp_".$id_random.".png");
							?>
							<img src="<?php echo base_url("templates/img/qrcode/barcode_sk_pembimbing_kp_".$id_random.".png") ?>" width="100px"><br>
							<u><b><?= $nama_penanda_tangan ?></b></u><br>
							NPK. <?= $npk_penanda_tangan?>
						</td>   
					</tr>
				</tbody>
			</table>

			<?php
		}else{
			echo '<div class="text-warning"><h1>Maaf, Tidak ditemukan data yang valid!</h1></div>';
		}
	}else{
		echo '<div class="text-warning"><h1>Maaf, Tidak ditemukan data yang valid!</h1></div>';
	}

	?>

</body>
</html>