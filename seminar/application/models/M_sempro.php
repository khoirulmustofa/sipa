<?php 

class M_sempro extends CI_Model
{

	function combobox_jenis_seminar()
	{
		return $this->db->query("SELECT * FROM tbl_seminar WHERE status='Tersedia'")->result_array();
	}

	function cekSyaratSempro($npm){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_seminar, 
			tbl_syarat_sempro 
			WHERE 
			tbl_mahasiswa.npm 		 = tbl_syarat_sempro.npm AND
			tbl_seminar.id_seminar 	 = tbl_syarat_sempro.id_seminar AND
			tbl_mahasiswa.npm 		 = '$npm' AND
			tbl_mahasiswa.status 	 != 'Dihapus' AND
			tbl_syarat_sempro.status = 'Tersedia' AND
			tbl_seminar.status 		 = 'Tersedia'
			");
		return $hasil;
	}

	function tambah_data($id_seminar, $npm, $usulan_tanggal, $usulan_jam, $nama_file_full_spp, $nama_file_full_krs, $nama_file_full_proposal){
		$hasil=$this->db->query("INSERT INTO tbl_syarat_sempro ( id_seminar, 
			npm, 
			usulan_tanggal, 
			usulan_jam, 
			file_spp, 
			file_krs, 
			file_proposal, 
			status) 
			VALUES ( '$id_seminar', 
			'$npm', 
			'$usulan_tanggal', 
			'$usulan_jam', 
			'$nama_file_full_spp', 
			'$nama_file_full_krs', 
			'$nama_file_full_proposal', 
			'Tersedia')");
		return $hasil;
	}

	function cekStatusPersetujuanTU($npm, $status_persetujuan, $tema_persetujuan){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_seminar, 
			tbl_syarat_sempro, 
			tbl_persetujuan_sempro
			WHERE 
			tbl_mahasiswa.npm 							= tbl_syarat_sempro.npm AND
			tbl_seminar.id_seminar						= tbl_syarat_sempro.id_seminar AND
			tbl_persetujuan_sempro.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND
			tbl_mahasiswa.npm 							= '$npm' AND
			tbl_mahasiswa.status						!= 'Dihapus' AND
			tbl_syarat_sempro.status 					= 'Tersedia' AND
			tbl_seminar.status 							= 'Tersedia' AND
			tbl_persetujuan_sempro.status 				= 'Tersedia' AND
			tbl_persetujuan_sempro.status_persetujuan 	= '$status_persetujuan' AND
			tbl_persetujuan_sempro.tema_persetujuan 	= '$tema_persetujuan'
			")->num_rows();
		return $hasil;
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

	function cekPersetujuan_sempro($npm){
		$query = $this->db->query(
			"SELECT * FROM tbl_skripsi, tbl_file_skripsi, tbl_mahasiswa
			WHERE 
			tbl_file_skripsi.id_skripsi 	= tbl_skripsi.id_skripsi AND
			tbl_skripsi.npm 				= tbl_mahasiswa.npm AND 
			tbl_file_skripsi.status 		= 'Tersedia' AND
			tbl_file_skripsi.nama_file 		= 'Laporan Lengkap' AND
			tbl_skripsi.status 				= 'Tersedia' AND
			tbl_file_skripsi.status 		= 'Tersedia' AND
			tbl_file_skripsi.status_sempro  = 'Disetujui Sempro' AND
			tbl_mahasiswa.npm				= '$npm'");
		return $query->num_rows();
	}

	function upload_file($id_syarat_sempro, $nama_field, $nama_file_full, $tema_persetujuan){
		date_default_timezone_set('Asia/Jakarta');
		$tgl_sekarang = date('Y-m-d H:i:s');
		$hasil = $this->db->query("UPDATE tbl_syarat_sempro 
			SET $nama_field 		='$nama_file_full'
			WHERE id_syarat_sempro 	='$id_syarat_sempro'");
		if($hasil){
			$this->db->query("UPDATE tbl_persetujuan_sempro 
				SET status ='Dihapus' WHERE id_syarat_sempro ='$id_syarat_sempro' AND tema_persetujuan = '$tema_persetujuan' ");
		}
		return $hasil;
	}


	function alasan_ditolak($id_syarat_sempro, $tema_persetujuan)
	{
		$baris=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_seminar, 
			tbl_syarat_sempro, 
			tbl_persetujuan_sempro
			WHERE 
			tbl_mahasiswa.npm 						= tbl_syarat_sempro.npm AND
			tbl_seminar.id_seminar 					= tbl_syarat_sempro.id_seminar AND
			tbl_persetujuan_sempro.id_syarat_sempro = tbl_syarat_sempro.id_syarat_sempro AND
			tbl_persetujuan_sempro.id_syarat_sempro = '$id_syarat_sempro' AND
			tbl_persetujuan_sempro.tema_persetujuan = '$tema_persetujuan' AND
			tbl_mahasiswa.status 					!= 'Dihapus' AND
			tbl_syarat_sempro.status 				= 'Tersedia' AND
			tbl_seminar.status 						= 'Tersedia' AND
			tbl_persetujuan_sempro.status 			= 'Tersedia'
			")->row();
		if ($baris) {
			return $baris->alasan_ditolak;
		}else{
			return '';
		}
	}
}
?>