<?php 

class M_sanksi extends CI_Model
{
	function combobox_mahasiswa($kode_prodi)
	{
		return $this->db->query("SELECT * FROM tbl_mahasiswa WHERE kode_prodi='$kode_prodi' AND status='Aktif'")->result_array();
	}

	function tambah_sanksi($npm, $penyebab, $sanksi, $waktu_mulai_sanksi, $waktu_selesai_sanksi){
		$hasil=$this->db->query("INSERT INTO tbl_sanksi (
											npm, 
											penyebab, 
											sanksi, 
											waktu_mulai_sanksi,
											waktu_selesai_sanksi,
											status) 
									VALUES ( 
											'$npm', 
											'$penyebab', 
											'$sanksi', 
											'$waktu_mulai_sanksi', 
											'$waktu_selesai_sanksi',
											'Tersedia')");
		return $hasil;
	}

	function data_sanksi($kode_prodi){
		return $this->db->query("SELECT * FROM tbl_sanksi, tbl_mahasiswa
										 where tbl_sanksi.npm 		= tbl_mahasiswa.npm AND
										 tbl_sanksi.status 			='Tersedia' AND
										 tbl_mahasiswa.kode_prodi 	= '$kode_prodi' AND
										 tbl_mahasiswa.status 		!='Dihapus'
										 ORDER BY tbl_sanksi.id_sanksi DESC")->result_array();
	}

	function hapus_data($id_sanksi){
		$hasil = $this->db->query("UPDATE tbl_sanksi SET status = 'Dihapus' WHERE id_sanksi ='$id_sanksi';");
		return $hasil;
	}

	function row_data($npm)
	{
		$hasil=$this->db->query("SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_syarat_sk 
			WHERE 
			tbl_mahasiswa.npm 			= tbl_syarat_sk.npm AND
			tbl_jenis_sk.id_jenis_sk 	= tbl_syarat_sk.id_jenis_sk AND
			tbl_mahasiswa.npm 			= '$npm' AND
			tbl_mahasiswa.status 		!= 'Dihapus' AND
			tbl_syarat_sk.status 		= 'Tersedia' AND
			tbl_jenis_sk.status 		= 'Tersedia' ");
		return $hasil->row();
	}

	function cekSyaratSK($npm){
		$hasil=$this->db->query(
		"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_syarat_sk 
		WHERE 
			tbl_mahasiswa.npm 			= tbl_syarat_sk.npm AND
			tbl_jenis_sk.id_jenis_sk 	= tbl_syarat_sk.id_jenis_sk AND
			tbl_mahasiswa.npm 			= '$npm' AND
			tbl_mahasiswa.status 		!= 'Dihapus' AND
			tbl_syarat_sk.status 		= 'Tersedia' AND
			tbl_jenis_sk.status 		= 'Tersedia'
			")->num_rows();
		return $hasil;
	}

	function edit_data_nofile($id_syarat_sk, 
		$npm, 
		$nama_tempat_kp, 
		$judul_kp, 
		$nama_pembimbing_lapangan, 
		$no_hp_pembimbing_lapangan, 
		$waktu_mulai_kp, 
		$waktu_selesai_kp){
		date_default_timezone_set('Asia/Jakarta');
		$tgl_sekarang = date('Y-m-d H:i:s');
		$hasil = $this->db->query("UPDATE tbl_syarat_sk 
			SET nama_tempat_kp 			='$nama_tempat_kp', 
			judul_kp 					='$judul_kp', 
			nama_pembimbing_lapangan 	='$nama_pembimbing_lapangan', 
			no_hp_pembimbing_lapangan 	='$no_hp_pembimbing_lapangan' , 
			waktu_mulai_kp 				='$waktu_mulai_kp' , 
			waktu_selesai_kp 			='$waktu_selesai_kp',
			tgl_upload_syarat_sk		='$tgl_sekarang'
			WHERE id_syarat_sk ='$id_syarat_sk'");
		return $hasil;
	}

	function edit_data($id_syarat_sk, 
		$npm, 
		$nama_tempat_kp, 
		$judul_kp, 
		$nama_pembimbing_lapangan, 
		$no_hp_pembimbing_lapangan, 
		$waktu_mulai_kp, 
		$waktu_selesai_kp, 
		$nama_file_syarat_sk_baru){
		date_default_timezone_set('Asia/Jakarta');
		$tgl_sekarang = date('Y-m-d H:i:s');
		$hasil = $this->db->query("UPDATE tbl_syarat_sk 
			SET nama_tempat_kp 			='$nama_tempat_kp', 
			judul_kp 					='$judul_kp', 
			nama_pembimbing_lapangan 	='$nama_pembimbing_lapangan', 
			no_hp_pembimbing_lapangan 	='$no_hp_pembimbing_lapangan' , 
			waktu_mulai_kp 				='$waktu_mulai_kp' , 
			waktu_selesai_kp 			='$waktu_selesai_kp' , 
			nama_file_syarat_sk 		='$nama_file_syarat_sk_baru',
			tgl_upload_syarat_sk		='$tgl_sekarang' 
			WHERE id_syarat_sk ='$id_syarat_sk'");
		return $hasil;
	}
	function hapus_respon_tu($id_syarat_sk){
		$hasil = $this->db->query("UPDATE tbl_persetujuan_sk 
			SET status 			= 'Dihapus'
			WHERE id_syarat_sk 	='$id_syarat_sk'");
		return $hasil;
	}

	

	function cekStatusPersetujuanTU($npm, $status_persetujuan){
		$hasil=$this->db->query(
		"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_syarat_sk, 
			tbl_persetujuan_sk
		WHERE 
			tbl_mahasiswa.npm 						= tbl_syarat_sk.npm AND
			tbl_jenis_sk.id_jenis_sk 				= tbl_syarat_sk.id_jenis_sk AND
			tbl_persetujuan_sk.id_syarat_sk 		= tbl_syarat_sk.id_syarat_sk AND
			tbl_mahasiswa.npm 						= '$npm' AND
			tbl_mahasiswa.status 					!= 'Dihapus' AND
			tbl_syarat_sk.status 					= 'Tersedia' AND
			tbl_jenis_sk.status 					= 'Tersedia' AND
			tbl_persetujuan_sk.status 				= 'Tersedia' AND
			tbl_persetujuan_sk.status_persetujuan 	= '$status_persetujuan'
			")->num_rows();
		return $hasil;
	}

	function cekResponPembimbing($id_dospem, $status_respon){
		$hasil=$this->db->query(
		"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_syarat_sk, 
			tbl_dospem
		WHERE 
			tbl_mahasiswa.npm 			= tbl_syarat_sk.npm AND
			tbl_jenis_sk.id_jenis_sk 	= tbl_syarat_sk.id_jenis_sk AND
			tbl_dospem.id_syarat_sk 	= tbl_syarat_sk.id_syarat_sk AND
			
			tbl_mahasiswa.status 		!= 'Dihapus' AND
			tbl_syarat_sk.status 		= 'Tersedia' AND
			tbl_jenis_sk.status 		= 'Tersedia' AND
			tbl_dospem.status 			= 'Tersedia' AND
			tbl_dospem.id_dospem 		= '$id_dospem' AND
			tbl_dospem.respon 			= '$status_respon'
			");
		return $hasil->num_rows();
	}

	function alasan_ditolak($npm, $id_syarat_sk)
	{
		$hasil=$this->db->query(
		"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_syarat_sk, 
			tbl_persetujuan_sk
		WHERE 
			tbl_mahasiswa.npm 				= tbl_syarat_sk.npm AND
			tbl_jenis_sk.id_jenis_sk 		= tbl_syarat_sk.id_jenis_sk AND
			tbl_persetujuan_sk.id_syarat_sk = tbl_syarat_sk.id_syarat_sk AND
			tbl_mahasiswa.npm 				= '$npm' AND
			tbl_mahasiswa.status 			!= 'Dihapus' AND
			tbl_syarat_sk.status 			= 'Tersedia' AND
			tbl_jenis_sk.status 			= 'Tersedia' AND
			tbl_persetujuan_sk.status 		= 'Tersedia'
			");
		return $hasil->result_array();
	}

	// FORMAT TANGGAL INDONESIA
	function format_tanggal($tanggal){
		if(substr($tanggal, 5,2)=='01'){
			$tanggal = substr($tanggal, 8).' Januari '.substr($tanggal,0,4);
		}
		else if(substr($tanggal, 5,2)=='02'){
			$tanggal = substr($tanggal, 8).' Februari '.substr($tanggal,0,4);
		}
		else if(substr($tanggal, 5,2)=='03'){
			$tanggal = substr($tanggal, 8).' Maret '.substr($tanggal,0,4);
		}
		else if(substr($tanggal, 5,2)=='04'){
			$tanggal = substr($tanggal, 8).' April '.substr($tanggal,0,4);
		}
		else if(substr($tanggal, 5,2)=='05'){
			$tanggal = substr($tanggal, 8).' Mei '.substr($tanggal,0,4);
		}
		else if(substr($tanggal, 5,2)=='06'){
			$tanggal = substr($tanggal, 8).' Juni '.substr($tanggal,0,4);
		}
		else if(substr($tanggal, 5,2)=='07'){
			$tanggal = substr($tanggal, 8).' Juli '.substr($tanggal,0,4);
		}
		else if(substr($tanggal, 5,2)=='08'){
			$tanggal = substr($tanggal, 8).' Agustus '.substr($tanggal,0,4);
		}
		else if(substr($tanggal, 5,2)=='09'){
			$tanggal = substr($tanggal, 8).' September '.substr($tanggal,0,4);
		}
		else if(substr($tanggal, 5,2)=='10'){
			$tanggal = substr($tanggal, 8).' Oktober '.substr($tanggal,0,4);
		}
		else if(substr($tanggal, 5,2)=='11'){
			$tanggal = substr($tanggal, 8).' November '.substr($tanggal,0,4);
		}
		else{
			$tanggal = substr($tanggal, 8).' Desember '.substr($tanggal,0,4);
		}
		return $tanggal;
	}

}
?>