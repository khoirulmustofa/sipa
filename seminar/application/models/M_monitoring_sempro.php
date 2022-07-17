<?php 

class M_monitoring_sempro extends CI_Model
{
	function combobox_prodi()
	{
		return $this->db->query("SELECT * FROM tb_prodi WHERE status='Tersedia'")->result_array();
	}

	function return_kondisi(){
		if (isset($_SESSION['kode_prodi'])) {
			$kode_prodi = $_SESSION['kode_prodi'];
			$qr = "AND tb_prodi.kode_prodi = '$kode_prodi' ";
		}else{
			$qr = "";
		}
		return $qr;
	}

	function show_data_sempro()
	{
		$kondisi = $this->return_kondisi();
		$query =
		"SELECT * FROM 
		tbl_mahasiswa, 
		tbl_seminar, 
		tbl_syarat_sempro,
		tb_prodi
		WHERE 
		tbl_mahasiswa.npm 			= tbl_syarat_sempro.npm AND
		tbl_seminar.id_seminar 		= tbl_syarat_sempro.id_seminar AND
		tb_prodi.kode_prodi 		= tbl_mahasiswa.kode_prodi AND

		tb_prodi.status 			!= 'Dihapus' AND
		tbl_syarat_sempro.status 	= 'Tersedia' AND
		tbl_seminar.status 			= 'Tersedia' AND
		tbl_mahasiswa.status 		!= 'Dihapus'
		$kondisi
		ORDER BY tbl_syarat_sempro.id_syarat_sempro DESC
		";
		$hasil=$this->db->query($query)->result_array();
		return $hasil;
	}

	function cekResponTU($id_syarat_sempro, $tema){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_syarat_sempro, 
			tbl_skripsi, 
			tbl_persetujuan_sempro,
			tbl_seminar
			WHERE 
			tbl_mahasiswa.npm 						= tbl_skripsi.npm AND
			tbl_syarat_sempro.id_seminar 			= tbl_seminar.id_seminar AND
			tbl_persetujuan_sempro.id_syarat_sempro = tbl_syarat_sempro.id_syarat_sempro AND
			
			tbl_mahasiswa.status 					!= 'Dihapus' AND
			tbl_skripsi.status 						= 'Tersedia' AND
			tbl_seminar.status 						= 'Tersedia' AND
			tbl_syarat_sempro.status 				= 'Tersedia' AND
			tbl_persetujuan_sempro.status 			= 'Tersedia' AND
			tbl_persetujuan_sempro.tema_persetujuan ='$tema' AND
			tbl_persetujuan_sempro.id_syarat_sempro = '$id_syarat_sempro'
			")->num_rows();
		return $hasil;
	}

	function cekStatusPersetujuanTU($id_syarat_sempro, $tema_persetujuan, $status_persetujuan){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_seminar, 
			tbl_skripsi, 
			tbl_persetujuan_sempro, 
			tbl_syarat_sempro
			WHERE 
			tbl_mahasiswa.npm 							= tbl_skripsi.npm AND
			tbl_persetujuan_sempro.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND

			tbl_mahasiswa.status 						!= 'Dihapus' AND
			tbl_skripsi.status 							= 'Tersedia' AND
			tbl_seminar.status 							= 'Tersedia' AND
			tbl_persetujuan_sempro.status 				= 'Tersedia' AND
			tbl_syarat_sempro.id_syarat_sempro 			='$id_syarat_sempro' AND
			tbl_persetujuan_sempro.tema_persetujuan 	= '$tema_persetujuan' AND
			tbl_persetujuan_sempro.status_persetujuan 	= '$status_persetujuan'
			")->num_rows();
		return $hasil;
	}

	public function cekPersetujuanSemuaBerkas2($id_syarat_sempro){
		$tema1 = "Pengecekan Berkas KRS untuk Persyaratan Sempro Mahasiswa oleh Tata Usaha";
		$hasil1 = $this->db->query("SELECT * FROM tbl_persetujuan_sempro WHERE id_syarat_sempro='$id_syarat_sempro' AND tema_persetujuan='$tema1' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();
		$tema2 = "Pengecekan Berkas SPP untuk Persyaratan Sempro Mahasiswa oleh Tata Usaha";
		$hasil2 = $this->db->query("SELECT * FROM tbl_persetujuan_sempro WHERE id_syarat_sempro='$id_syarat_sempro' AND tema_persetujuan='$tema2' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();
		$tema3 = "Pengecekan Berkas Proposal untuk Persyaratan Sempro Mahasiswa oleh Tata Usaha";
		$hasil3 = $this->db->query("SELECT * FROM tbl_persetujuan_sempro WHERE id_syarat_sempro='$id_syarat_sempro' AND tema_persetujuan='$tema3' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();
		
		if($hasil1>0 && $hasil2>0 && $hasil3>0){
			return 1;
		}else{
			return 0;
		}
	}

	function cekOpenFile($id_syarat_sempro, $file_open){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_seminar, 
			tbl_syarat_sempro, 
			tbl_open_file_sempro
			WHERE 
			tbl_mahasiswa.npm 						= tbl_syarat_sempro.npm AND
			tbl_seminar.id_seminar 					= tbl_syarat_sempro.id_seminar AND
			tbl_open_file_sempro.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND
			
			tbl_mahasiswa.status 					!= 'Dihapus' AND
			tbl_syarat_sempro.status 				= 'Tersedia' AND
			tbl_seminar.status 						= 'Tersedia' AND
			tbl_open_file_sempro.status 			= 'Tersedia' AND
			tbl_open_file_sempro.file_open 			='$file_open' AND
			tbl_open_file_sempro.id_syarat_sempro 	= '$id_syarat_sempro'
			")->num_rows();
		return $hasil;
	}

	public function open_file($id_syarat_sempro, $pelaku, $jabatan, $file_open){
		$cek = $this->db->query("SELECT * FROM tbl_open_file_sempro WHERE id_syarat_sempro='$id_syarat_sempro' AND file_open='$file_open' AND status='Tersedia'")->num_rows();

		if($cek<1){
			$hasil=$this->db->query(
				"INSERT INTO tbl_open_file_sempro (id_syarat_sempro, 
				pelaku, 
				jabatan, 
				file_open, 
				status) 
				VALUES ($id_syarat_sempro, 
				'$pelaku', 
				'$jabatan', 
				'$file_open',
				'Tersedia')");
		}
		else{
			$hasil = '';
		}
		return $hasil;
	}

	public function setuju_berkas($id_syarat_sempro, $pelaku, $jabatan, $tema_persetujuan, $alasan_ditolak, $status_persetujuan){
		$cek = $this->db->query("SELECT * FROM tbl_persetujuan_sempro WHERE id_syarat_sempro='$id_syarat_sempro' AND tema_persetujuan='$tema_persetujuan' AND status='Tersedia'")->num_rows();

		if($cek<1){
			$hasil=$this->db->query(
				"INSERT INTO tbl_persetujuan_sempro (id_syarat_sempro, 
				pelaku, 
				jabatan, 
				status_persetujuan,
				tema_persetujuan, 
				alasan_ditolak,  
				status) 
				VALUES ($id_syarat_sempro, 
				'$pelaku', 
				'$jabatan', 
				'$status_persetujuan', 
				'$tema_persetujuan', 
				'$alasan_ditolak', 
				'Tersedia')");
		}
		else{
			$hasil = '';
		}
		$this->cekPersetujuanSemuaBerkas($id_syarat_sempro);
	}

	public function cekPersetujuanSemuaBerkas($id_syarat_sempro){
		$tema1 = "Pengecekan Berkas KRS untuk Persyaratan Sempro Mahasiswa oleh Tata Usaha";
		$hasil1 = $this->db->query("SELECT * FROM tbl_persetujuan_sempro WHERE id_syarat_sempro='$id_syarat_sempro' AND tema_persetujuan='$tema1' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();
		$tema2 = "Pengecekan Berkas SPP untuk Persyaratan Sempro Mahasiswa oleh Tata Usaha";
		$hasil2 = $this->db->query("SELECT * FROM tbl_persetujuan_sempro WHERE id_syarat_sempro='$id_syarat_sempro' AND tema_persetujuan='$tema2' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();
		$tema3 = "Pengecekan Berkas Proposal untuk Persyaratan Sempro Mahasiswa oleh Tata Usaha";
		$hasil3 = $this->db->query("SELECT * FROM tbl_persetujuan_sempro WHERE id_syarat_sempro='$id_syarat_sempro' AND tema_persetujuan='$tema3' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();
		$return_arr[] = array(
			'hasil1' => $hasil1,
			'hasil2' => $hasil2,
			'hasil3' => $hasil3);
		echo json_encode($return_arr);
	}

	function persetujuan($id_syarat_sempro, $pelaku, $jabatan, $status_persetujuan, $tema_persetujuan, $alasan_ditolak){
		$hasil=$this->db->query(
			"INSERT INTO tbl_persetujuan_sempro (id_syarat_sempro, 
			pelaku, 
			jabatan, 
			status_persetujuan,
			tema_persetujuan, 
			alasan_ditolak,  
			status) 
			VALUES ($id_syarat_sempro, 
			'$pelaku', 
			'$jabatan', 
			'$status_persetujuan', 
			'$tema_persetujuan', 
			'$alasan_ditolak', 
			'Tersedia')");
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

	function show_pilihan_penguji()
	{
		$kondisi = $this->return_kondisi();
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_seminar, 
			tbl_skripsi,
			tb_prodi,
			tbl_persetujuan_sempro,
			tbl_syarat_sempro
			WHERE 
			tbl_mahasiswa.npm 		= tbl_skripsi.npm AND
			tb_prodi.kode_prodi 	= tbl_mahasiswa.kode_prodi AND
			tbl_seminar.id_seminar 	= tbl_syarat_sempro.id_seminar AND


			tb_prodi.status 		!= 'Dihapus' AND
			tbl_skripsi.status 		= 'Tersedia' AND
			tbl_seminar.status 		= 'Tersedia' AND
			tbl_mahasiswa.status 	!= 'Dihapus' AND

			tbl_persetujuan_sempro.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND
			tbl_persetujuan_sempro.status_persetujuan 	= 'Berkas Disetujui' AND
			tbl_persetujuan_sempro.tema_persetujuan = 'Pengecekan Berkas Persyaratan Sempro Mahasiswa oleh Tata Usaha' 
			$kondisi
			");
		return $hasil;
	}

	function combobox_dosen($kode_prodi)
	{
		$query = $this->db->query("SELECT * FROM tb_prodi, tb_dosen 
			WHERE tb_dosen.kode_jurusan = tb_prodi.kode_prodi AND 
			tb_prodi.status 			= 'Tersedia' AND
			tb_dosen.status 			= 'Aktif' AND
			tb_dosen.status_dosen 		= 'Dosen Tetap Program Studi' AND
			tb_prodi.kode_prodi			='$kode_prodi'
			ORDER BY pendidikan DESC, jabatan_fungsional");
		return $query->result_array();
	}
}
?>