<?php 

class M_monitoring_kompre extends CI_Model
{
	function combobox_prodi()
	{
		return $this->db->query("SELECT * FROM tb_prodi WHERE status='Tersedia'")->result_array();
	}

	function return_kondisi(){
		if (isset($_SESSION['kode_prodi'])) {
			$kode_prodi = $_SESSION['kode_prodi'];
			$qr = "AND tb_prodi.kode_prodi 		= '$kode_prodi' ";
		}else{
			$qr = "";
		}
		return $qr;
	}

	function show_data_kompre()
	{
		$kondisi = $this->return_kondisi();
		$query =
		"SELECT * FROM 
		tbl_mahasiswa, 
		tbl_seminar, 
		tbl_syarat_kompre,
		tb_prodi
		WHERE 
		tbl_mahasiswa.npm 			= tbl_syarat_kompre.npm AND
		tbl_seminar.id_seminar 		= tbl_syarat_kompre.id_seminar AND
		tb_prodi.kode_prodi 		= tbl_mahasiswa.kode_prodi AND

		tb_prodi.status 			!= 'Dihapus' AND
		tbl_syarat_kompre.status 	= 'Tersedia' AND
		tbl_seminar.status 			= 'Tersedia' AND
		tbl_mahasiswa.status 		!= 'Dihapus'
		$kondisi

		";
		$hasil=$this->db->query($query)->result_array();
		return $hasil;
	}

	function show_persetujuan()
	{
		$kondisi = $this->return_kondisi();
		$query =
		"SELECT * FROM 
		tbl_mahasiswa, 
		tbl_seminar, 
		tbl_syarat_kompre,
		tbl_persetujuan_kompre,
		tb_prodi
		WHERE 
		tbl_mahasiswa.npm 			= tbl_syarat_kompre.npm AND
		tbl_seminar.id_seminar 		= tbl_syarat_kompre.id_seminar AND
		tb_prodi.kode_prodi 		= tbl_mahasiswa.kode_prodi AND

		tb_prodi.status 			!= 'Dihapus' AND
		tbl_syarat_kompre.status 	= 'Tersedia' AND
		tbl_persetujuan_kompre.status 	= 'Tersedia' AND
		tbl_seminar.status 			= 'Tersedia' AND
		tbl_persetujuan_kompre.id_syarat_kompre 		= tbl_syarat_kompre.id_syarat_kompre AND
		tbl_persetujuan_kompre.status_persetujuan 	= 'Berkas Disetujui' AND
		tbl_persetujuan_kompre.tema_persetujuan = 'Pengecekan Berkas Persyaratan Sidang Skripsi Mahasiswa oleh Tata Usaha' AND
		tbl_mahasiswa.status 		!= 'Dihapus'
		$kondisi

		";
		$hasil=$this->db->query($query)->result_array();
		return $hasil;
	}

	function cekResponTU($id_syarat_kompre, $tema){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_syarat_kompre, 
			tbl_skripsi, 
			tbl_persetujuan_kompre,
			tbl_seminar
			WHERE 
			tbl_mahasiswa.npm 						= tbl_skripsi.npm AND
			tbl_syarat_kompre.id_seminar 			= tbl_seminar.id_seminar AND
			tbl_persetujuan_kompre.id_syarat_kompre = tbl_syarat_kompre.id_syarat_kompre AND
			
			tbl_mahasiswa.status 					!= 'Dihapus' AND
			tbl_skripsi.status 						= 'Tersedia' AND
			tbl_seminar.status 						= 'Tersedia' AND
			tbl_syarat_kompre.status 				= 'Tersedia' AND
			tbl_persetujuan_kompre.status 			= 'Tersedia' AND
			tbl_persetujuan_kompre.tema_persetujuan ='$tema' AND
			tbl_persetujuan_kompre.id_syarat_kompre = '$id_syarat_kompre'
			")->num_rows();
		return $hasil;
	}

	function cekOpenFile($id_syarat_kompre, $file_open){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_seminar, 
			tbl_syarat_kompre, 
			tbl_open_file_kompre
			WHERE 
			tbl_mahasiswa.npm 						= tbl_syarat_kompre.npm AND
			tbl_seminar.id_seminar 					= tbl_syarat_kompre.id_seminar AND
			tbl_open_file_kompre.id_syarat_kompre 	= tbl_syarat_kompre.id_syarat_kompre AND
			
			tbl_mahasiswa.status 					!= 'Dihapus' AND
			tbl_syarat_kompre.status 				= 'Tersedia' AND
			tbl_seminar.status 						= 'Tersedia' AND
			tbl_open_file_kompre.status 			= 'Tersedia' AND
			tbl_open_file_kompre.file_open 			='$file_open' AND
			tbl_open_file_kompre.id_syarat_kompre 	= '$id_syarat_kompre'
			")->num_rows();
		return $hasil;
	}

	public function open_file($id_syarat_kompre, $pelaku, $jabatan, $file_open){
		$cek = $this->db->query("SELECT * FROM tbl_open_file_kompre WHERE id_syarat_kompre='$id_syarat_kompre' AND file_open='$file_open' AND status='Tersedia'")->num_rows();

		if($cek<1){
			$hasil=$this->db->query(
				"INSERT INTO tbl_open_file_kompre (id_syarat_kompre, 
				pelaku, 
				jabatan, 
				file_open, 
				status) 
				VALUES ($id_syarat_kompre, 
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

	public function setuju_berkas($id_syarat_kompre, $pelaku, $jabatan, $tema_persetujuan, $alasan_ditolak, $status_persetujuan){
		$cek = $this->db->query("SELECT * FROM tbl_persetujuan_kompre WHERE id_syarat_kompre='$id_syarat_kompre' AND tema_persetujuan='$tema_persetujuan' AND status='Tersedia'")->num_rows();

		if($cek<1){
			$hasil=$this->db->query(
				"INSERT INTO tbl_persetujuan_kompre (id_syarat_kompre, 
				pelaku, 
				jabatan, 
				status_persetujuan,
				tema_persetujuan, 
				alasan_ditolak,  
				status) 
				VALUES ($id_syarat_kompre, 
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
		$this->cekPersetujuanSemuaBerkas($id_syarat_kompre);
	}

	public function cekPersetujuanSemuaBerkas($id_syarat_kompre){
		$tema1 = "Pengecekan Berkas SPP untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha";
		$hasil1 = $this->db->query("SELECT * FROM tbl_persetujuan_kompre WHERE id_syarat_kompre='$id_syarat_kompre' AND tema_persetujuan='$tema1' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();

		$tema2 = "Pengecekan Berkas Transkip untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha";
		$hasil2 = $this->db->query("SELECT * FROM tbl_persetujuan_kompre WHERE id_syarat_kompre='$id_syarat_kompre' AND tema_persetujuan='$tema2' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();

		$tema3 = "Pengecekan Berkas KRS untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha";
		$hasil3 = $this->db->query("SELECT * FROM tbl_persetujuan_kompre WHERE id_syarat_kompre='$id_syarat_kompre' AND tema_persetujuan='$tema3' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();

		$tema4 = "Pengecekan Berkas Sertifikat Alquran untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha";
		$hasil4 = $this->db->query("SELECT * FROM tbl_persetujuan_kompre WHERE id_syarat_kompre='$id_syarat_kompre' AND tema_persetujuan='$tema3' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();

		$tema5 = "Pengecekan Berkas Sertifikat Inggris untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha";
		$hasil5 = $this->db->query("SELECT * FROM tbl_persetujuan_kompre WHERE id_syarat_kompre='$id_syarat_kompre' AND tema_persetujuan='$tema3' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();

		$tema6 = "Pengecekan Berkas Laporan Lengkap untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha";
		$hasil6 = $this->db->query("SELECT * FROM tbl_persetujuan_kompre WHERE id_syarat_kompre='$id_syarat_kompre' AND tema_persetujuan='$tema3' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();
		$return_arr[] = array(
			'hasil1' => $hasil1,
			'hasil2' => $hasil2,
			'hasil3' => $hasil3,
			'hasil4' => $hasil4,
			'hasil5' => $hasil5,
			'hasil6' => $hasil6);
		echo json_encode($return_arr);
	}

	public function cekPersetujuanSemuaBerkas2($id_syarat_kompre){
		$tema1 = "Pengecekan Berkas SPP untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha";
		$hasil1 = $this->db->query("SELECT * FROM tbl_persetujuan_kompre WHERE id_syarat_kompre='$id_syarat_kompre' AND tema_persetujuan='$tema1' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();

		$tema2 = "Pengecekan Berkas Transkip untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha";
		$hasil2 = $this->db->query("SELECT * FROM tbl_persetujuan_kompre WHERE id_syarat_kompre='$id_syarat_kompre' AND tema_persetujuan='$tema2' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();

		$tema3 = "Pengecekan Berkas KRS untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha";
		$hasil3 = $this->db->query("SELECT * FROM tbl_persetujuan_kompre WHERE id_syarat_kompre='$id_syarat_kompre' AND tema_persetujuan='$tema3' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();

		$tema4 = "Pengecekan Berkas Sertifikat Alquran untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha";
		$hasil4 = $this->db->query("SELECT * FROM tbl_persetujuan_kompre WHERE id_syarat_kompre='$id_syarat_kompre' AND tema_persetujuan='$tema3' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();

		$tema5 = "Pengecekan Berkas Sertifikat Inggris untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha";
		$hasil5 = $this->db->query("SELECT * FROM tbl_persetujuan_kompre WHERE id_syarat_kompre='$id_syarat_kompre' AND tema_persetujuan='$tema3' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();

		$tema6 = "Pengecekan Berkas Laporan Lengkap untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha";
		$hasil6 = $this->db->query("SELECT * FROM tbl_persetujuan_kompre WHERE id_syarat_kompre='$id_syarat_kompre' AND tema_persetujuan='$tema3' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();
		
		if($hasil1>0 && $hasil2>0 && $hasil3>0 && $hasil4>0 && $hasil5>0 && $hasil6>0){
			return 1;
		}else{
			return 0;
		}
	}

	function cekStatusPersetujuanTU($id_syarat_kompre, $tema_persetujuan, $status_persetujuan){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_seminar, 
			tbl_skripsi, 
			tbl_persetujuan_kompre, 
			tbl_syarat_kompre
			WHERE 
			tbl_mahasiswa.npm 							= tbl_skripsi.npm AND
			tbl_persetujuan_kompre.id_syarat_kompre 	= tbl_syarat_kompre.id_syarat_kompre AND

			tbl_mahasiswa.status 						!= 'Dihapus' AND
			tbl_skripsi.status 							= 'Tersedia' AND
			tbl_seminar.status 							= 'Tersedia' AND
			tbl_persetujuan_kompre.status 				= 'Tersedia' AND
			tbl_syarat_kompre.id_syarat_kompre 			='$id_syarat_kompre' AND
			tbl_persetujuan_kompre.tema_persetujuan 	= '$tema_persetujuan' AND
			tbl_persetujuan_kompre.status_persetujuan 	= '$status_persetujuan'
			")->num_rows();
		return $hasil;
	}

	function persetujuan($id_syarat_kompre, $pelaku, $jabatan, $status_persetujuan, $tema_persetujuan, $alasan_ditolak){
		$hasil=$this->db->query(
			"INSERT INTO tbl_persetujuan_kompre (id_syarat_kompre, 
			pelaku, 
			jabatan, 
			status_persetujuan,
			tema_persetujuan, 
			alasan_ditolak,  
			status) 
			VALUES ($id_syarat_kompre, 
			'$pelaku', 
			'$jabatan', 
			'$status_persetujuan', 
			'$tema_persetujuan', 
			'$alasan_ditolak', 
			'Tersedia')");
		return $hasil;
	}	

	function persetujuan_kompre($id_syarat_kompre){
		$hasil=$this->db-> $query 	= $this->db->query(
			"UPDATE tbl_persetujuan_kompre 
			SET persetujuan_prodi 	= 'Disetujui Kompre' 
			WHERE id_syarat_kompre 	='$id_syarat_kompre' 
			AND tema_persetujuan 	= 'Pengecekan Berkas Persyaratan Sidang Skripsi Mahasiswa oleh Tata Usaha' ;" );

		return $hasil;
	}

	function cekPersetujuan_kompre($id_syarat_kompre){
		$hasil=$this->db->query(
			"SELECT * FROM  
			tbl_syarat_kompre,
			tbl_persetujuan_kompre
			WHERE 
			tbl_persetujuan_kompre.id_syarat_kompre  = tbl_syarat_kompre.id_syarat_kompre AND
			tbl_syarat_kompre.status 				 = 'Tersedia' AND
			tbl_persetujuan_kompre.status 			 = 'Tersedia' AND
			tbl_syarat_kompre.id_syarat_kompre 		 = '$id_syarat_kompre' AND
			tbl_persetujuan_kompre.persetujuan_prodi = 'Disetujui Kompre'
			")->num_rows();
		return $hasil;
	}
}
?>