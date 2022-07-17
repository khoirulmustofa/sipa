<?php 

class M_monitoring_skripsi extends CI_Model
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
	// MENAMPILKAN DATA MAHASISWA YANG MENGURUS SKRIPSI KE DALAM TABEL UNTUK TU
	function show_monitoring_sk_fakultas()
	{
		$kondisi = $this->return_kondisi();
		$query = "SELECT * FROM 
		tbl_mahasiswa, 
		tbl_jenis_sk, 
		tbl_skripsi,
		tb_prodi,
		tbl_persetujuan_skripsi, 
		tbl_usulan_pembimbing,
		tbl_persetujuan_usulan_pembimbing,
		tbl_dospem_skripsi
		WHERE 
		tbl_mahasiswa.npm 					= tbl_skripsi.npm AND
		tbl_mahasiswa.kode_prodi 			= tb_prodi.kode_prodi AND
		tbl_jenis_sk.id_jenis_sk 			= tbl_skripsi.id_jenis_sk AND
		tbl_persetujuan_skripsi.id_skripsi 	= tbl_skripsi.id_skripsi AND
		tbl_dospem_skripsi.id_skripsi 		= tbl_skripsi.id_skripsi AND
		tbl_usulan_pembimbing.id_skripsi 	= tbl_skripsi.id_skripsi AND
		tbl_persetujuan_usulan_pembimbing.id_usulan_pembimbing 		= tbl_usulan_pembimbing.id_usulan_pembimbing AND

		tb_prodi.status 				!= 'Dihapus' AND
		tbl_skripsi.status 				= 'Tersedia' AND
		tbl_jenis_sk.status 			= 'Tersedia' AND
		tbl_mahasiswa.status 			= 'Aktif' AND
		tbl_persetujuan_skripsi.status 	= 'Tersedia' AND
		tbl_persetujuan_skripsi.status_persetujuan 	= 'Berkas Disetujui' AND
		tbl_dospem_skripsi.status 		= 'Tersedia' AND
		tbl_usulan_pembimbing.status 	= 'Tersedia' AND
		tbl_persetujuan_usulan_pembimbing.status = 'Tersedia' AND
		tbl_usulan_pembimbing.status_persetujuan = 'Usulan Disetujui' AND
		tbl_persetujuan_usulan_pembimbing.status_persetujuan = 'Usulan Disetujui' AND
		tbl_dospem_skripsi.respon = 'Usulan Disetujui' AND
		tbl_persetujuan_skripsi.tema_persetujuan = 'Pengecekan Berkas Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha' 
		$kondisi

		ORDER BY tbl_skripsi.tgl_upload DESC
		";
		$hasil=$this->db->query($query)->result_array();
		return $hasil;
	}



	// MENAMPILKAN DATA MAHASISWA YANG MENGURUS SKRIPSI KE DALAM TABEL UNTUK GKM
	function show_skripsi($kode_prodi)
	{
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_skripsi,
			tb_prodi
			WHERE 
			tbl_mahasiswa.npm 			= tbl_skripsi.npm AND
			tbl_jenis_sk.id_jenis_sk 	= tbl_skripsi.id_jenis_sk AND
			tb_prodi.kode_prodi 		= tbl_mahasiswa.kode_prodi AND
			tb_prodi.kode_prodi 		= '$kode_prodi' AND

			tb_prodi.status 			!= 'Dihapus' AND
			tbl_skripsi.status 			= 'Tersedia' AND
			tbl_jenis_sk.status 		= 'Tersedia' AND
			tbl_mahasiswa.status 		= 'Aktif'  
			ORDER BY tbl_skripsi.tgl_upload DESC
			");
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

	// CEK RESPON FAKULTAS TERHADAP SK
	function cekResponSKFakultas($id_skripsi){
		$hasil=$this->db->query(
			"SELECT * FROM  
			tbl_skripsi,
			tbl_persetujuan_skripsi, 
			tbl_ttd_surat, 
			tbl_nomor_surat
			WHERE 
			tbl_persetujuan_skripsi.id_persetujuan_skripsi 	= tbl_persetujuan_skripsi.id_persetujuan_skripsi AND
			tbl_skripsi.status 				= 'Tersedia' AND
			tbl_ttd_surat.topik_relasi 		= 'Tandatangan SK Pembimbing Skripsi oleh Dekan' AND
			tbl_ttd_surat.id_relasi 		= tbl_skripsi.id_skripsi AND
			tbl_nomor_surat.id_relasi 		= tbl_skripsi.id_skripsi AND
			tbl_nomor_surat.relasi_tabel 	= 'tbl_skripsi' AND
			tbl_nomor_surat.fungsi_nomor 	= 'SK Pembimbing Skripsi' AND

			tbl_ttd_surat.status 			= 'Tersedia' AND
			tbl_persetujuan_skripsi.status 	= 'Tersedia' AND
			tbl_nomor_surat.status 			= 'Tersedia' AND
			tbl_skripsi.id_skripsi 			= '$id_skripsi'
			")->num_rows();
		return $hasil;
	}

	function cekResponTU($id_skripsi, $tema){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_skripsi, 
			tbl_persetujuan_skripsi
			WHERE 
			tbl_mahasiswa.npm 						 = tbl_skripsi.npm AND
			tbl_jenis_sk.id_jenis_sk 				 = tbl_skripsi.id_jenis_sk AND
			tbl_persetujuan_skripsi.id_skripsi 		 = tbl_skripsi.id_skripsi AND
			
			tbl_mahasiswa.status 					 != 'Dihapus' AND
			tbl_skripsi.status 						 = 'Tersedia' AND
			tbl_jenis_sk.status 					 = 'Tersedia' AND
			tbl_persetujuan_skripsi.status 			 = 'Tersedia' AND
			tbl_persetujuan_skripsi.tema_persetujuan ='$tema' AND
			tbl_persetujuan_skripsi.id_skripsi 		 = '$id_skripsi'
			")->num_rows();
		return $hasil;
	}

	// function cekResponPembimbing($id_skripsi, $tema){
	// 	$hasil=$this->db->query(
	// 		"SELECT * FROM 
	// 		tbl_mahasiswa, 
	// 		tbl_jenis_sk, 
	// 		tbl_skripsi, 
	// 		tbl_persetujuan_skripsi,
	// 		tbl_dospem_skripsi
	// 		WHERE 
	// 		tbl_mahasiswa.npm 					= tbl_skripsi.npm AND
	// 		tbl_jenis_sk.id_jenis_sk 			= tbl_skripsi.id_jenis_sk AND
	// 		tbl_persetujuan_skripsi.id_skripsi 	= tbl_skripsi.id_skripsi AND
	// 		tbl_dospem_skripsi.id_skripsi 	= tbl_skripsi.id_skripsi AND

	// 		tbl_mahasiswa.status 				!= 'Dihapus' AND
	// 		tbl_skripsi.status 					= 'Tersedia' AND
	// 		tbl_jenis_sk.status 				= 'Tersedia' AND
	// 		tbl_persetujuan_skripsi.status 			= 'Tersedia' AND
	// 		tbl_dospem_skripsi.status 			= 'Tersedia' AND
	// 		tbl_persetujuan_skripsi.tema_persetujuan ='$tema' AND
	// 		tbl_persetujuan_skripsi.id_skripsi 	= '$id_skripsi'
	// 		")->num_rows();
	// 	return $hasil;
	// }

	function cekStatusPersetujuanTU($id_skripsi, $tema_persetujuan, $status_persetujuan){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_skripsi, 
			tbl_persetujuan_skripsi
			WHERE 
			tbl_mahasiswa.npm 					= tbl_skripsi.npm AND
			tbl_jenis_sk.id_jenis_sk 			= tbl_skripsi.id_jenis_sk AND
			tbl_persetujuan_skripsi.id_skripsi 	= tbl_skripsi.id_skripsi AND

			tbl_mahasiswa.status 				!= 'Dihapus' AND
			tbl_skripsi.status 					= 'Tersedia' AND
			tbl_jenis_sk.status 				= 'Tersedia' AND
			tbl_persetujuan_skripsi.status 		= 'Tersedia' AND
			tbl_skripsi.id_skripsi 				='$id_skripsi' AND
			tbl_persetujuan_skripsi.tema_persetujuan 	= '$tema_persetujuan' AND
			tbl_persetujuan_skripsi.status_persetujuan 	= '$status_persetujuan'
			")->num_rows();
		return $hasil;
	}

	// function cekStatusPersetujuanPembimbing($id_skripsi, $tema_persetujuan, $status_persetujuan){
	// 	$hasil=$this->db->query(
	// 		"SELECT * FROM 
	// 		tbl_mahasiswa, 
	// 		tbl_jenis_sk, 
	// 		tbl_skripsi, 
	// 		tbl_persetujuan_skripsi,
	// 		tbl_dospem_skripsi
	// 		WHERE 
	// 		tbl_mahasiswa.npm 					= tbl_skripsi.npm AND
	// 		tbl_jenis_sk.id_jenis_sk 			= tbl_skripsi.id_jenis_sk AND
	// 		tbl_persetujuan_skripsi.id_skripsi 	= tbl_skripsi.id_skripsi AND
	// 		tbl_dospem_skripsi.id_skripsi 	= tbl_skripsi.id_skripsi AND

	// 		tbl_mahasiswa.status 				!= 'Dihapus' AND
	// 		tbl_skripsi.status 					= 'Tersedia' AND
	// 		tbl_jenis_sk.status 				= 'Tersedia' AND
	// 		tbl_persetujuan_skripsi.status 		= 'Tersedia' AND
	// 		tbl_dospem_skripsi.status 		= 'Tersedia' AND
	// 		tbl_skripsi.id_skripsi 				='$id_skripsi' AND
	// 		tbl_persetujuan_skripsi.tema_persetujuan 	= '$tema_persetujuan' AND
	// 		tbl_persetujuan_skripsi.status_persetujuan 	= '$status_persetujuan'
	// 		")->num_rows();
	// 	return $hasil;
	// }
	
	public function cekPersetujuanSemuaBerkas2($id_skripsi){
		$tema1 = "Pengecekan Berkas SPP dasar untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha";
		$hasil1 = $this->db->query("SELECT * FROM tbl_persetujuan_skripsi WHERE id_skripsi='$id_skripsi' AND tema_persetujuan='$tema1' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();
		$tema2 = "Pengecekan Berkas Transkrip Nilai untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha";
		$hasil2 = $this->db->query("SELECT * FROM tbl_persetujuan_skripsi WHERE id_skripsi='$id_skripsi' AND tema_persetujuan='$tema2' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();
		$tema3 = "Pengecekan Berkas KRS untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha";
		$hasil3 = $this->db->query("SELECT * FROM tbl_persetujuan_skripsi WHERE id_skripsi='$id_skripsi' AND tema_persetujuan='$tema3' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();
		$tema4 = "Pengecekan File Proposal Skripsi untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha";
		$hasil4 = $this->db->query("SELECT * FROM tbl_persetujuan_skripsi WHERE id_skripsi='$id_skripsi' AND tema_persetujuan='$tema4' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();

		if($hasil1>0 && $hasil2>0 && $hasil3>0 && $hasil4>0){
			return 1;
		}else{
			return 0;
		}
	}

	public function cekPersetujuanSemuaBerkas($id_skripsi){
		$tema1 = "Pengecekan Berkas SPP dasar untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha";
		$hasil1 = $this->db->query("SELECT * FROM tbl_persetujuan_skripsi WHERE id_skripsi='$id_skripsi' AND tema_persetujuan='$tema1' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();
		$tema2 = "Pengecekan Berkas Transkrip Nilai untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha";
		$hasil2 = $this->db->query("SELECT * FROM tbl_persetujuan_skripsi WHERE id_skripsi='$id_skripsi' AND tema_persetujuan='$tema2' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();
		$tema3 = "Pengecekan Berkas KRS untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha";
		$hasil3 = $this->db->query("SELECT * FROM tbl_persetujuan_skripsi WHERE id_skripsi='$id_skripsi' AND tema_persetujuan='$tema3' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();
		$tema4 = "Pengecekan File Proposal Skripsi untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha";
		$hasil4 = $this->db->query("SELECT * FROM tbl_persetujuan_skripsi WHERE id_skripsi='$id_skripsi' AND tema_persetujuan='$tema4' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();
		$return_arr[] = array(
			'hasil1' => $hasil1,
			'hasil2' => $hasil2,
			'hasil3' => $hasil3,
			'hasil4' => $hasil4);
   				// header('Content-type: application/json');
		echo json_encode($return_arr);
	}

	function cekOpenFile($id_skripsi, $file_open){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_skripsi, 
			tbl_open_file_skripsi
			WHERE 
			tbl_mahasiswa.npm 					= tbl_skripsi.npm AND
			tbl_jenis_sk.id_jenis_sk 			= tbl_skripsi.id_jenis_sk AND
			tbl_open_file_skripsi.id_skripsi 	= tbl_skripsi.id_skripsi AND
			
			tbl_mahasiswa.status 				!= 'Dihapus' AND
			tbl_skripsi.status 					= 'Tersedia' AND
			tbl_jenis_sk.status 				= 'Tersedia' AND
			tbl_open_file_skripsi.status 		= 'Tersedia' AND
			tbl_open_file_skripsi.file_open 	='$file_open' AND
			tbl_open_file_skripsi.id_skripsi 	= '$id_skripsi'
			")->num_rows();
		return $hasil;
	}

	public function open_file($id_skripsi, $pelaku, $jabatan, $file_open){
		$cek = $this->db->query("SELECT * FROM tbl_open_file_skripsi WHERE id_skripsi='$id_skripsi' AND file_open='$file_open' AND status='Tersedia'")->num_rows();

		if($cek<1){
			$hasil=$this->db->query(
				"INSERT INTO tbl_open_file_skripsi (id_skripsi, 
				pelaku, 
				jabatan, 
				file_open, 
				status) 
				VALUES ($id_skripsi, 
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

	public function setuju_berkas($id_skripsi, $pelaku, $jabatan, $tema_persetujuan, $alasan_ditolak, $status_persetujuan){
		$cek = $this->db->query("SELECT * FROM tbl_persetujuan_skripsi WHERE id_skripsi='$id_skripsi' AND tema_persetujuan='$tema_persetujuan' AND status='Tersedia'")->num_rows();

		if($cek<1){
			$hasil=$this->db->query(
				"INSERT INTO tbl_persetujuan_skripsi (id_skripsi, 
				pelaku, 
				jabatan, 
				status_persetujuan,
				tema_persetujuan, 
				alasan_ditolak,  
				status) 
				VALUES ($id_skripsi, 
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
		$this->cekPersetujuanSemuaBerkas($id_skripsi);
	}

	function persetujuan($id_skripsi, $pelaku, $jabatan, $status_persetujuan, $tema_persetujuan, $alasan_ditolak){
		$hasil=$this->db->query(
			"INSERT INTO tbl_persetujuan_skripsi (id_skripsi, 
			pelaku, 
			jabatan, 
			status_persetujuan,
			tema_persetujuan, 
			alasan_ditolak,  
			status) 
			VALUES ($id_skripsi, 
			'$pelaku', 
			'$jabatan', 
			'$status_persetujuan', 
			'$tema_persetujuan', 
			'$alasan_ditolak', 
			'Tersedia')");
		return $hasil;
	}	

	function show_monitoring_sk_tu()
	{
		$kondisi = $this->return_kondisi();
		$query =
		"SELECT * FROM 
		tbl_mahasiswa, 
		tbl_jenis_sk, 
		tbl_skripsi,
		tb_prodi
		WHERE 
		tbl_mahasiswa.npm 			= tbl_skripsi.npm AND
		tbl_jenis_sk.id_jenis_sk 	= tbl_skripsi.id_jenis_sk AND
		tb_prodi.kode_prodi 		= tbl_mahasiswa.kode_prodi AND

		tb_prodi.status 			!= 'Dihapus' AND
		tbl_skripsi.status 			= 'Tersedia' AND
		tbl_jenis_sk.status 		= 'Tersedia' AND
		tbl_mahasiswa.status 		!= 'Dihapus'
		$kondisi

		ORDER BY tbl_skripsi.tgl_upload DESC
		";
		$hasil=$this->db->query($query)->result_array();
		return $hasil;
	}

	function show_monitoring_sk_prodi()
	{
		$kondisi = $this->return_kondisi();
		$hasil=$this->db->query(
			"SELECT *, tbl_usulan_pembimbing.id_usulan_pembimbing as id_usulan_dikirim, tbl_usulan_pembimbing.status_persetujuan as status_persetujuan_usulan,
			tbl_persetujuan_usulan_pembimbing.alasan_ditolak as alasan_ditolak_koordinator, tbl_dospem_skripsi.alasan_ditolak as alasan_ditolak_dosen FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_skripsi
			LEFT JOIN tbl_dospem_skripsi ON tbl_dospem_skripsi.id_skripsi = tbl_skripsi.id_skripsi,
			tb_prodi,
			tb_dosen,
			tbl_persetujuan_skripsi,
			tbl_usulan_pembimbing
			LEFT JOIN tbl_persetujuan_usulan_pembimbing ON 	tbl_persetujuan_usulan_pembimbing.id_usulan_pembimbing 	= tbl_usulan_pembimbing.id_usulan_pembimbing 			
			WHERE 
			tbl_mahasiswa.npm 					= tbl_skripsi.npm AND
			tbl_jenis_sk.id_jenis_sk 			= tbl_skripsi.id_jenis_sk AND
			tb_prodi.kode_prodi 				= tbl_mahasiswa.kode_prodi AND
			tbl_usulan_pembimbing.id_skripsi 	= tbl_skripsi.id_skripsi AND
			tbl_usulan_pembimbing.npk 			= tb_dosen.npk AND

			tb_prodi.status 				!= 'Dihapus' AND
			tbl_skripsi.status 				= 'Tersedia' AND
			tbl_jenis_sk.status 			= 'Tersedia' AND
			tbl_mahasiswa.status 			!= 'Dihapus' AND
			tb_dosen.status 				!= 'Dihapus' AND
			tbl_usulan_pembimbing.status 				!= 'Dihapus' AND
			(tbl_persetujuan_usulan_pembimbing.status != 'Dihapus' OR tbl_persetujuan_usulan_pembimbing.id_persetujuan_usulan_pembimbing IS NULL) AND
			(tbl_dospem_skripsi.status != 'Dihapus' OR tbl_dospem_skripsi.id_dospem_skripsi IS NULL) AND

			tbl_persetujuan_skripsi.id_skripsi = tbl_skripsi.id_skripsi AND
			tbl_persetujuan_skripsi.status_persetujuan 	= 'Berkas Disetujui' AND
			tbl_persetujuan_skripsi.tema_persetujuan = 'Pengecekan Berkas Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha' 
			$kondisi

			ORDER BY tbl_skripsi.tgl_upload DESC
			");
		return $hasil;
	}

	function show_monitoring_sk_koordinator()
	{
		$kondisi = $this->return_kondisi();
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_skripsi,
			tb_prodi,
			tbl_persetujuan_skripsi,
			tbl_usulan_pembimbing,
			tb_dosen
			WHERE 
			tbl_mahasiswa.npm 					= tbl_skripsi.npm AND
			tbl_jenis_sk.id_jenis_sk 			= tbl_skripsi.id_jenis_sk AND
			tb_prodi.kode_prodi 				= tbl_mahasiswa.kode_prodi AND
			tbl_usulan_pembimbing.id_skripsi 	= tbl_skripsi.id_skripsi AND
			tbl_usulan_pembimbing.npk 			= tb_dosen.npk AND

			tb_prodi.status 				!= 'Dihapus' AND
			tbl_skripsi.status 				= 'Tersedia' AND
			tbl_jenis_sk.status 			= 'Tersedia' AND
			tbl_usulan_pembimbing.status 	= 'Tersedia' AND
			tbl_mahasiswa.status 			!= 'Dihapus' AND
			tb_dosen.status 				!= 'Dihapus' AND

			tbl_persetujuan_skripsi.id_skripsi 			= tbl_skripsi.id_skripsi AND
			tbl_persetujuan_skripsi.status_persetujuan 	= 'Berkas Disetujui' AND
			tbl_usulan_pembimbing.status_persetujuan 	= 'Usulan Disetujui' AND
			tbl_persetujuan_skripsi.tema_persetujuan 	= 'Pengecekan Berkas Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha' 
			$kondisi

			ORDER BY tbl_skripsi.tgl_upload DESC
			");
		return $hasil;
	}

	function cekUsulanPembimbing($id_skripsi){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa,
			tbl_skripsi
			WHERE 
			tbl_skripsi.npm 		= tbl_mahasiswa.npm AND
			tbl_skripsi.id_skripsi 	= '$id_skripsi' AND
			tbl_mahasiswa.status 	!= 'Dihapus' AND
			tbl_skripsi.status 		= 'Tersedia'
			")->num_rows();
		return $hasil;
	}

	// function cekResponUsulan($id_skripsi){
	// 	$hasil=$this->db->query(
	// 		"SELECT * FROM  
	// 		tbl_skripsi,
	// 		tbl_persetujuan_skripsi,
	// 		tbl_dospem_skripsi
	// 		WHERE 
	// 		tbl_persetujuan_skripsi.id_skripsi 	= tbl_skripsi.id_skripsi AND
	// 		tbl_dospem_skripsi.id_skripsi 	= tbl_skripsi.id_skripsi AND
	// 		tbl_skripsi.status 							= 'Tersedia' AND
	// 		tbl_persetujuan_skripsi.status 				= 'Tersedia' AND
	// 		tbl_dospem_skripsi.status 				= 'Tersedia' AND
	// 		tbl_skripsi.id_skripsi 				= '$id_skripsi'
	// 		")->num_rows();
	// 	return $hasil;
	// }

	function cekStatusPersetujuanUsulanPembimbing($id_skripsi, $status_persetujuan){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa,
			tbl_skripsi,
			tbl_persetujuan_skripsi
			WHERE 
			tbl_persetujuan_skripsi.id_skripsi 			= tbl_skripsi.id_skripsi AND
			tbl_skripsi.npm 							= tbl_mahasiswa.npm AND
			tbl_skripsi.id_skripsi 						= '$id_skripsi' AND
			tbl_mahasiswa.status 						!= 'Dihapus' AND
			tbl_skripsi.status 							= 'Tersedia' AND
			tbl_persetujuan_skripsi.status 				= 'Tersedia' AND			
			tbl_persetujuan_skripsi.status_persetujuan 	= '$status_persetujuan'
			")->num_rows();
		return $hasil;
	}

	// PERSETUJUAN USULAN PEMBIMBING OLEH PRODI
	function persetujuan_usulan_pembimbing($id_usulan_pembimbing, $status_persetujuan, $alasan_ditolak){
		$hasil=$this->db-> $query = $this->db->query("UPDATE tbl_usulan_pembimbing SET status_persetujuan = '$status_persetujuan' , alasan_ditolak = '$alasan_ditolak' WHERE id_usulan_pembimbing ='$id_usulan_pembimbing' ;" );

		return $hasil;
	}

	// PERSETUJUAN USULAN PEMBIMBING OLEH KOORDINATOR
	function persetujuan_koordinator($npk, $id_usulan_pembimbing,  $status_persetujuan, $alasan_ditolak){
		$hasil=$this->db->query(
			"INSERT INTO tbl_persetujuan_usulan_pembimbing (id_usulan_pembimbing, 
			npk,
			status_persetujuan,
			alasan_ditolak,  
			status) 
			VALUES ($id_usulan_pembimbing,  
			'$npk',
			'$status_persetujuan', 
			'$alasan_ditolak', 
			'Tersedia')");
		return $hasil;
	}

	function cekUsulan($id_usulan_pembimbing){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa,
			tbl_skripsi,
			tbl_usulan_pembimbing
			WHERE 
			tbl_skripsi.npm 							= tbl_mahasiswa.npm AND
			tbl_usulan_pembimbing.id_usulan_pembimbing 	= '$id_usulan_pembimbing' AND
			tbl_mahasiswa.status 						!= 'Dihapus' AND
			tbl_skripsi.status 							= 'Tersedia' AND
			tbl_usulan_pembimbing.status 				= 'Tersedia'
			")->num_rows();
		return $hasil;
	}

	function cekStatusPersetujuanUsulan($id_usulan_pembimbing, $status_persetujuan){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa,
			tbl_skripsi,
			tbl_usulan_pembimbing
			WHERE 
			tbl_usulan_pembimbing.id_skripsi 			= tbl_skripsi.id_skripsi AND
			tbl_skripsi.npm 							= tbl_mahasiswa.npm AND
			tbl_usulan_pembimbing.id_usulan_pembimbing  = '$id_usulan_pembimbing' AND
			tbl_mahasiswa.status 						!= 'Dihapus' AND
			tbl_skripsi.status 							= 'Tersedia' AND
			tbl_usulan_pembimbing.status 				= 'Tersedia' AND			
			tbl_usulan_pembimbing.status_persetujuan 	= '$status_persetujuan'
			")->num_rows();
		return $hasil;
	}

	function cekResponUsulan($id_usulan_pembimbing){
		$hasil=$this->db->query(
			"SELECT * FROM  
			tbl_skripsi,
			tbl_usulan_pembimbing
			WHERE 
			tbl_usulan_pembimbing.id_skripsi 	= tbl_skripsi.id_skripsi AND
			tbl_skripsi.status 					= 'Tersedia' AND
			(tbl_usulan_pembimbing.status 		= 'Tersedia' OR tbl_usulan_pembimbing.status 		= 'Dihapus')  AND
			(tbl_usulan_pembimbing.status_persetujuan = 'Usulan Disetujui' OR tbl_usulan_pembimbing.status_persetujuan = 'Usulan Ditolak' )  AND
			tbl_usulan_pembimbing.id_usulan_pembimbing = '$id_usulan_pembimbing'
			")->num_rows();
		return $hasil;
	}

	function cekResponUsulanKoordinator($id_usulan_pembimbing){
		$hasil=$this->db->query(
			"SELECT * FROM  
			tbl_skripsi,
			tbl_usulan_pembimbing,
			tbl_persetujuan_usulan_pembimbing
			WHERE 
			tbl_persetujuan_usulan_pembimbing.id_usulan_pembimbing 	= tbl_usulan_pembimbing.id_usulan_pembimbing AND
			tbl_usulan_pembimbing.id_skripsi 			= tbl_skripsi.id_skripsi AND
			tbl_skripsi.status 							= 'Tersedia' AND
			tbl_persetujuan_usulan_pembimbing.status 	= 'Tersedia' AND
			tbl_usulan_pembimbing.status 				= 'Tersedia' AND
			tbl_usulan_pembimbing.id_usulan_pembimbing  = '$id_usulan_pembimbing'
			")->num_rows();
		return $hasil;
	}

	function cekResponUsulanProdi($id_skripsi){
		$hasil=$this->db->query(
			"SELECT * FROM  
			tbl_skripsi,
			tbl_usulan_pembimbing
			WHERE 
			tbl_usulan_pembimbing.id_skripsi 		 = tbl_skripsi.id_skripsi AND
			tbl_skripsi.status 						 = 'Tersedia' AND
			tbl_usulan_pembimbing.status 			 = 'Tersedia' AND
			tbl_usulan_pembimbing.status_persetujuan = 'Usulan Ditolak'  AND
			tbl_skripsi.id_skripsi 					 = '$id_skripsi'
			")->num_rows();
		return $hasil;
	}

	function cekUsulanDospem($id_skripsi){
		$hasil=$this->db->query(
			"SELECT * FROM  
			tbl_skripsi,
			tbl_usulan_pembimbing
			WHERE 
			tbl_usulan_pembimbing.id_skripsi 	= tbl_skripsi.id_skripsi AND
			tbl_skripsi.status 					= 'Tersedia' AND
			tbl_usulan_pembimbing.status 		= 'Tersedia' AND
			tbl_skripsi.id_skripsi 				= '$id_skripsi' ")->num_rows();
		return $hasil;
	}

	function cekSetujuTolak($id_skripsi, $respon){
		$hasil=$this->db->query(
			"SELECT * FROM  
			tbl_skripsi,
			tbl_usulan_pembimbing
			WHERE 
			tbl_usulan_pembimbing.id_skripsi 		 = tbl_skripsi.id_skripsi AND
			tbl_skripsi.status 						 = 'Tersedia' AND
			tbl_usulan_pembimbing.status 			 = 'Tersedia' AND
			tbl_usulan_pembimbing.status_persetujuan = '$respon'  AND
			tbl_skripsi.id_skripsi 					 = '$id_skripsi'
			")->num_rows();
		return $hasil;
	}

	// function cekResponUsulan($id_skripsi, $status_persetujuan){
	// 	$hasil=$this->db->query(
	// 		"SELECT * FROM  
	// 		-- tbl_skripsi,
	// 		tbl_usulan_pembimbing
	// 		WHERE 
	// 		-- tbl_usulan_pembimbing.id_skripsi 	= tbl_skripsi.id_skripsi AND
	// 		-- tbl_skripsi.status 							= 'Tersedia' AND
	// 		tbl_usulan_pembimbing.status 				= 'Tersedia' AND
	// 		tbl_usulan_pembimbing.status_persetujuan 			= '$status_persetujuan' AND
	// 		id_skripsi 				= '$id_skripsi'
	// 		")->num_rows();
	// 	return $hasil;
	// }

	function alasan_ditolak($npm, $id_usulan_pembimbing)
	{
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_skripsi, 
			tbl_usulan_pembimbing
			WHERE 
			tbl_mahasiswa.npm 					= tbl_skripsi.npm AND
			tbl_usulan_pembimbing.id_skripsi 	= tbl_skripsi.id_skripsi AND
			tbl_usulan_pembimbing.id_usulan_pembimbing = '$id_usulan_pembimbing' AND
			tbl_mahasiswa.status 				!= 'Dihapus' AND
			tbl_skripsi.status 					= 'Tersedia' AND
			tbl_usulan_pembimbing.status 		= 'Tersedia'
			");
		return $hasil->result_array();
	}

	function show_histori123($id_skripsi)
	{
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_skripsi,
			tb_prodi,
			tbl_usulan_pembimbing,
			tb_dosen
			WHERE 
			tbl_mahasiswa.npm 					= tbl_skripsi.npm AND
			tbl_jenis_sk.id_jenis_sk 			= tbl_skripsi.id_jenis_sk AND
			tb_prodi.kode_prodi 				= tbl_mahasiswa.kode_prodi AND
			tbl_usulan_pembimbing.id_skripsi 	= tbl_skripsi.id_skripsi AND

			tb_prodi.status 					!= 'Dihapus' AND
			tb_dosen.status 					!= 'Dihapus' AND
			tbl_skripsi.status 					= 'Tersedia' AND
			tbl_jenis_sk.status 				= 'Tersedia' AND
			tbl_mahasiswa.status 				!= 'Dihapus' AND
			tbl_usulan_pembimbing.status 		= 'Tersedia' AND
			tbl_skripsi.id_skripsi 				= '$id_skripsi'
			");
		return $hasil->result_array();
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

	function cek_jumlah_dibimbing($npk){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_skripsi,
			tb_prodi,
			tbl_usulan_pembimbing
			WHERE 
			tbl_mahasiswa.npm 					= tbl_skripsi.npm AND
			tbl_mahasiswa.kode_prodi 			= tb_prodi.kode_prodi AND
			tbl_jenis_sk.id_jenis_sk 			= tbl_skripsi.id_jenis_sk AND
			tbl_usulan_pembimbing.id_skripsi 	= tbl_skripsi.id_skripsi AND
			tbl_usulan_pembimbing.id_skripsi 	= tbl_skripsi.id_skripsi AND
			tb_prodi.status 					!= 'Dihapus' AND
			tbl_skripsi.status 					= 'Tersedia' AND
			tbl_jenis_sk.status 				= 'Tersedia' AND
			tbl_mahasiswa.status 				= 'Aktif' AND
			tbl_usulan_pembimbing.status 		= 'Tersedia' AND
			tbl_usulan_pembimbing.status 		= 'Tersedia' AND
			tbl_usulan_pembimbing.npk 			= '$npk' AND
			tbl_usulan_pembimbing.status_persetujuan = 'Berkas Disetujui'
			")->num_rows();
		if ($hasil>=10) {
			return 1;
		} else{
			return 0;
		}
	}

	function simpan_dospem($npk, $id_skripsi){
		$query = $this->db->query("INSERT INTO tbl_dospem_skripsi (id_skripsi,
			npk,
			respon,
			tgl_respon,
			alasan_ditolak,
			status)
			VALUES ($id_skripsi,
			'$npk',
			'Penunjukan Diterima Pembimbing',
			'0000-00-00 00:00:00',
			'',
			'Tersedia')
			");
		return $query;
	}

	function show_histori($id_skripsi)
	{
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_skripsi,
			tb_prodi,
			tbl_persetujuan_skripsi,
			tbl_usulan_pembimbing,
			tb_dosen
			WHERE 
			tbl_mahasiswa.npm 					= tbl_skripsi.npm AND
			tbl_jenis_sk.id_jenis_sk 			= tbl_skripsi.id_jenis_sk AND
			tb_prodi.kode_prodi 				= tbl_mahasiswa.kode_prodi AND
			tbl_usulan_pembimbing.id_skripsi	= tbl_skripsi.id_skripsi AND
			tbl_usulan_pembimbing.npk 			= tb_dosen.npk AND
			tbl_persetujuan_skripsi.id_skripsi  = tbl_skripsi.id_skripsi AND

			tb_prodi.status 					!= 'Dihapus' AND
			tb_dosen.status 					!= 'Dihapus' AND
			tbl_usulan_pembimbing.status 		!= 'Dihapus' AND
			tbl_skripsi.status 					= 'Tersedia' AND
			tbl_jenis_sk.status 				= 'Tersedia' AND
			tbl_mahasiswa.status 				!= 'Dihapus' AND
			tbl_persetujuan_skripsi.status 		= 'Tersedia' AND
			tbl_persetujuan_skripsi.tema_persetujuan = 'Pengecekan Berkas Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha' AND
			tbl_skripsi.id_skripsi 				= '$id_skripsi'
			");
		return $hasil->result_array();
	}

	function show_histori_koordinator($id_skripsi)
	{
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_skripsi,
			tb_prodi,
			tbl_persetujuan_skripsi,
			tbl_usulan_pembimbing,
			tb_dosen,
			tbl_persetujuan_usulan_pembimbing
			WHERE 
			tbl_mahasiswa.npm 								= tbl_skripsi.npm AND
			tbl_jenis_sk.id_jenis_sk 						= tbl_skripsi.id_jenis_sk AND
			tb_prodi.kode_prodi 							= tbl_mahasiswa.kode_prodi AND
			tbl_usulan_pembimbing.id_skripsi				= tbl_skripsi.id_skripsi AND
			tbl_persetujuan_usulan_pembimbing.id_skripsi	= tbl_skripsi.id_skripsi AND
			tbl_usulan_pembimbing.npk 						= tb_dosen.npk AND
			tbl_persetujuan_skripsi.id_skripsi 				= tbl_skripsi.id_skripsi AND

			tb_prodi.status 								!= 'Dihapus' AND
			tb_dosen.status 								!= 'Dihapus' AND
			tbl_usulan_pembimbing.status 					!= 'Dihapus' AND
			tbl_persetujuan_usulan_pembimbing.status 		!= 'Dihapus' AND
			tbl_skripsi.status 								= 'Tersedia' AND
			tbl_jenis_sk.status 							= 'Tersedia' AND
			tbl_mahasiswa.status 							!= 'Dihapus' AND
			tbl_persetujuan_skripsi.status 					= 'Tersedia' AND
			tbl_persetujuan_skripsi.tema_persetujuan = 'Pengecekan Berkas Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha' AND
			tbl_skripsi.id_skripsi 							= '$id_skripsi'
			");
		return $hasil->result_array();
	}

	function input_nomor_surat($id_skripsi){
		$baris = $this->db->query("SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_skripsi,
			tb_prodi,
			tbl_persetujuan_skripsi, 
			tbl_usulan_pembimbing,
			tbl_persetujuan_usulan_pembimbing,
			tbl_dospem_skripsi
			WHERE 
			tbl_mahasiswa.npm 					= tbl_skripsi.npm AND
			tbl_mahasiswa.kode_prodi 			= tb_prodi.kode_prodi AND
			tbl_jenis_sk.id_jenis_sk 			= tbl_skripsi.id_jenis_sk AND
			tbl_persetujuan_skripsi.id_skripsi  = tbl_skripsi.id_skripsi AND
			tbl_dospem_skripsi.id_skripsi 		= tbl_skripsi.id_skripsi AND
			tbl_usulan_pembimbing.id_skripsi 	= tbl_skripsi.id_skripsi AND
			tbl_persetujuan_usulan_pembimbing.id_usulan_pembimbing = tbl_persetujuan_usulan_pembimbing.id_usulan_pembimbing AND

			tb_prodi.status 				!= 'Dihapus' AND
			tbl_skripsi.status 				= 'Tersedia' AND
			tbl_jenis_sk.status 			= 'Tersedia' AND
			tbl_mahasiswa.status 			= 'Aktif' AND
			tbl_persetujuan_skripsi.status 	= 'Tersedia' AND
			tbl_dospem_skripsi.status 		= 'Tersedia' AND
			tbl_usulan_pembimbing.status 	= 'Tersedia' AND
			tbl_persetujuan_usulan_pembimbing.status = 'Tersedia' AND
			tbl_usulan_pembimbing.status_persetujuan = 'Usulan Disetujui' AND
			tbl_persetujuan_usulan_pembimbing.status_persetujuan = 'Usulan Disetujui' AND
			tbl_dospem_skripsi.respon 				 = 'Usulan Disetujui' AND
			tbl_persetujuan_skripsi.tema_persetujuan = 'Pengecekan Berkas Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha' ")->row();
		if ($baris) {
			$nama_mahasiswa = $baris->nama_mahasiswa;
			$npm 			= $baris->npm;
			$judul 			= $baris->judul;
			$tgl_upload 	= $baris->tgl_upload;
		} else{
			redirect('fakultas/monitoring_skripsi');
		}

		date_default_timezone_set('Asia/Jakarta');
		$tahun 			= date('Y');
		$waktu_sekarang = date('Y-m-d H:i:s');
		$row = $this->db->query("SELECT max(nomor_surat) AS nomor_max FROM tbl_nomor_surat WHERE tahun = '$tahun' AND fungsi_nomor='SK Pembimbing Skripsi'")->row();
		if ($row) {
			$nomor_surat = $row->nomor_max;
		} else{
			$nomor_surat = 0;
		}

		$angka = $this->db->query("SELECT * FROM tbl_nomor_surat WHERE relasi_tabel='tbl_syarat_sk' OR  relasi_tabel='tbl_skripsi' OR relasi_tabel='tbl_syarat_sempro' AND status = 'Tersedia'")->num_rows();

		// echo $nomor_surat; die();
		$input_nomor = $this->db->query(
			"INSERT INTO tbl_nomor_surat (fungsi_nomor, 
			relasi_tabel, 
			id_relasi, 
			nomor_surat, 
			tahun, 
			status) 
			VALUES ('SK Pembimbing Skripsi', 
			'tbl_skripsi', 
			$id_skripsi, 
			($angka +1), 
			'$tahun', 
			'Tersedia') ");
		if ($input_nomor) {
			$topik_relasi 			= 'Tandatangan SK Pembimbing Skripsi oleh Dekan';
			$id_random 				= $this->generate_id_random();
			$nama_penanda_tangan 	= $_SESSION['nama'];
			$npk_penanda_tangan 	= $_SESSION['npk'];
			$jabatan_penanda_tangan = $_SESSION['jabatan'];
			$kodemax 				= str_pad(($nomor_surat+1), 4, "0", STR_PAD_LEFT);
			$nomor_surat_full 		= ($kodemax).'/KPTS/FT-UIR/SI/'.$tahun;
			$perihal 				= 'Tandatangan SK Skripsi atas nama '.$nama_mahasiswa.' ('.$npm.') yang ditandatangani pada tanggal '.$tgl_upload.' dengan judul '.$judul.'.' ;
			$hasil 	= $this->db->query(
				"INSERT INTO tbl_ttd_surat (id_relasi, 
				topik_relasi, 
				id_random, 
				waktu_input_ttd, 
				nama_penanda_tangan, 
				npk_penanda_tangan, 
				jabatan_penanda_tangan, 
				nomor_surat, 
				perihal, 
				status_validasi, 
				status) 
				VALUES ('$id_skripsi', 
				'$topik_relasi' , 
				'$id_random', 
				'$waktu_sekarang' , 
				'$nama_penanda_tangan', 
				'$npk_penanda_tangan', 
				'$jabatan_penanda_tangan', 
				'$nomor_surat_full', 
				'$perihal', 
				'Tervalidasi', 
				'Tersedia') ");		
		}
		return $hasil;
	}

	function generate_id_random(){
		$seed = str_split('abcdefghijklmnopqrstuvwxyz0123456789'
			.'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'
			.'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'
                 .'0123456789abcdefghijklmnopqrstuvwxyz'); // and any other characters
			shuffle($seed); // probably optional since array_is randomized; this may be redundant
			$rand = '';
			foreach (array_rand($seed, 100) as $k) $rand .= $seed[$k];
			$rand;

			while($this->db->query("SELECT * FROM tbl_ttd_surat WHERE id_random='$rand' AND status = 'Tersedia'")->num_rows()>0){
				$seed = str_split('abcdefghijklmnopqrstuvwxyz0123456789'
					.'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'
					.'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'
                 .'0123456789abcdefghijklmnopqrstuvwxyz'); // and any other characters
				shuffle($seed); // probably optional since array_is randomized; this may be redundant
				$rand = '';
				foreach (array_rand($seed, 100) as $k) $rand .= $seed[$k];
				$rand;
			}
			return $rand;
		}

		function get_row_data_skripsi($id_skripsi){
			$topik_relasi = 'Tandatangan SK Pembimbing Skripsi oleh Dekan';
			$hasil = $this->db->query("	SELECT * FROM 
				tbl_mahasiswa, 
				tbl_jenis_sk, 
				tbl_skripsi,
				tb_prodi,
				tbl_persetujuan_skripsi, 
				tbl_usulan_pembimbing,
				tbl_persetujuan_usulan_pembimbing,
				tbl_dospem_skripsi,
				tbl_ttd_surat,
				tbl_nomor_surat, 
				tb_dosen
				WHERE 
				tbl_mahasiswa.npm 						= tbl_skripsi.npm AND
				tbl_mahasiswa.kode_prodi 				= tb_prodi.kode_prodi AND
				tbl_dospem_skripsi.id_skripsi 			= tbl_skripsi.id_skripsi AND
				tb_dosen.npk 							= tbl_dospem_skripsi.npk AND
				tbl_ttd_surat.topik_relasi 				= '$topik_relasi' AND
				tbl_nomor_surat.fungsi_nomor			= 'SK Pembimbing Skripsi' AND   
				tbl_skripsi.id_skripsi 					= '$id_skripsi' AND
                tbl_skripsi.id_skripsi 					= tbl_nomor_surat.id_relasi AND
                tbl_skripsi.id_skripsi 					= tbl_ttd_surat.id_relasi AND
				tbl_persetujuan_skripsi.id_skripsi		= tbl_skripsi.id_skripsi AND

				tb_prodi.status 						!= 'Dihapus' AND
				tbl_dospem_skripsi.status 				!= 'Dihapus' AND
				tbl_ttd_surat.status 					= 'Tersedia' AND
				tbl_nomor_surat.status 					= 'Tersedia' AND
				tbl_mahasiswa.status 					= 'Aktif' AND
				tbl_persetujuan_skripsi.status 			= 'Tersedia' AND
				tbl_skripsi.status 						= 'Tersedia' AND
				tbl_persetujuan_skripsi.tema_persetujuan = 'Pengecekan Berkas Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha'
				");
			return $hasil->row();
		}

		// PRODI TTD KARTU BIMBINGAN
		function ttd_prodi($id_skripsi){
			date_default_timezone_set('Asia/Jakarta');

			$waktu_sekarang 		= date('Y-m-d H:i:s');
			$topik_relasi 			= 'Tandatangan kartu bimbingan Skripsi oleh Prodi';
			$id_random 				= $this->generate_id_random();
			$nama_penanda_tangan 	= $_SESSION['nama'];
			$perihal 				= 'Tandatangan Kartu Bimbingan Skripsi oleh '.$nama_penanda_tangan;
			$jabatan_penanda_tangan = 'Ketua Program Studi';
			return $this->db->query(
				"INSERT INTO tbl_ttd_dospem (id_relasi,
				topik_relasi,
				id_random,
				waktu_input_ttd, 
				nama_penanda_tangan,
				jabatan_penanda_tangan,
				perihal,
				status_validasi,
				status)
				VALUES ($id_skripsi,
				'$topik_relasi',
				'$id_random',
				'$waktu_sekarang',
				'$nama_penanda_tangan',
				'$jabatan_penanda_tangan',
				'$perihal',
				'Tervalidasi',
				'Tersedia')");
		// }
		// return $hasil;
		}

		function cekTtdProdi($id_skripsi){
			return $this->db->query("SELECT * FROM tbl_skripsi, tbl_ttd_dospem 
				WHERE id_skripsi 			= '$id_skripsi' AND 
				tbl_ttd_dospem.id_relasi 	= tbl_skripsi.id_skripsi AND
				tbl_ttd_dospem.status 		= 'Tersedia' AND
				tbl_skripsi.status 			= 'Tersedia' AND
				tbl_ttd_dospem.topik_relasi = 'Tandatangan kartu bimbingan Skripsi oleh Prodi'")->num_rows();
		}

		function cekTtdProdiTA($id_skripsi){
			return $this->db->query("SELECT * FROM tbl_skripsi, tbl_ttd_dospem 
				WHERE id_skripsi 			= '$id_skripsi' AND 
				tbl_ttd_dospem.id_relasi 	= tbl_skripsi.id_skripsi AND
				tbl_ttd_dospem.status 		= 'Tersedia' AND
				tbl_skripsi.status 			= 'Tersedia' AND
				tbl_ttd_dospem.topik_relasi = 'Tandatangan kartu bimbingan Skripsi oleh Prodi'")->num_rows();
		}

		function cekPenunjukanProdi($id_skripsi, $id_usulan_pembimbing){
			$hasil=$this->db->query(
				"SELECT * FROM 
				tbl_mahasiswa, 
				tbl_jenis_sk, 
				tbl_skripsi,
				tb_prodi,
				tbl_persetujuan_skripsi, 
				tbl_usulan_pembimbing
				WHERE 
				tbl_mahasiswa.npm 							= tbl_skripsi.npm AND
				tbl_mahasiswa.kode_prodi 					= tb_prodi.kode_prodi AND
				tbl_jenis_sk.id_jenis_sk 					= tbl_skripsi.id_jenis_sk AND
				tbl_persetujuan_skripsi.id_skripsi  		= tbl_skripsi.id_skripsi AND
				tbl_usulan_pembimbing.id_skripsi 			= tbl_skripsi.id_skripsi AND

				tb_prodi.status 							!= 'Dihapus' AND
				tbl_skripsi.status 							= 'Tersedia' AND
				tbl_jenis_sk.status 						= 'Tersedia' AND
				tbl_mahasiswa.status 						= 'Aktif' AND
				tbl_persetujuan_skripsi.status 				= 'Tersedia' AND
				tbl_usulan_pembimbing.status 				= 'Tersedia' AND
				tbl_persetujuan_skripsi.tema_persetujuan 	= 'Pengecekan Berkas Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha' AND			
				tbl_skripsi.id_skripsi 						= '$id_skripsi' AND
				tbl_usulan_pembimbing.id_usulan_pembimbing 	= '$id_usulan_pembimbing'

				ORDER BY tbl_usulan_pembimbing.id_usulan_pembimbing DESC;
				")->num_rows();
			return $hasil;
		}

		function cekStatusPenunjukanProdi($id_skripsi, $id_usulan_pembimbing, $status_persetujuan){
			$hasil=$this->db->query(
				"SELECT * FROM 
				tbl_mahasiswa, 
				tbl_jenis_sk, 
				tbl_skripsi,
				tb_prodi,
				tbl_persetujuan_skripsi, 
				tbl_usulan_pembimbing
				WHERE 
				tbl_mahasiswa.npm 							= tbl_skripsi.npm AND
				tbl_mahasiswa.kode_prodi 					= tb_prodi.kode_prodi AND
				tbl_jenis_sk.id_jenis_sk 					= tbl_skripsi.id_jenis_sk AND
				tbl_persetujuan_skripsi.id_skripsi  		= tbl_skripsi.id_skripsi AND
				tbl_usulan_pembimbing.id_skripsi  			= tbl_skripsi.id_skripsi AND

				tb_prodi.status 							!= 'Dihapus' AND
				tbl_skripsi.status 							= 'Tersedia' AND
				tbl_jenis_sk.status 						= 'Tersedia' AND
				tbl_mahasiswa.status 						= 'Aktif' AND
				tbl_persetujuan_skripsi.status 				= 'Tersedia' AND
				tbl_usulan_pembimbing.status_persetujuan 	= '$status_persetujuan' AND
				tbl_skripsi.id_skripsi 						= '$id_skripsi' AND
				tbl_usulan_pembimbing.id_usulan_pembimbing 	= '$id_usulan_pembimbing'
				ORDER BY tbl_usulan_pembimbing.id_usulan_pembimbing DESC;
				")->num_rows();
			return $hasil;
		}

		// function usulan_dospem($id_skripsi, $npk, $id_usulan_pembimbing){
		// 	$hasil=$this->db->query(
		// 		"UPDATE tbl_usulan_pembimbing SET npk = '$npk' WHERE id_skripsi ='$id_skripsi' AND id_usulan_pembimbing = '$id_usulan_pembimbing';");
		// 	return $hasil;
		// }
		
		function usulan_dospem($id_skripsi, $npk, $id){
			$edit = $this->db->query("UPDATE tbl_usulan_pembimbing set status='Dihapus' WHERE id_usulan_pembimbing = '$id' ");
			$hasil=$this->db->query(
				"INSERT INTO tbl_usulan_pembimbing (id_skripsi, 
				npk,
				status_persetujuan,
				alasan_ditolak,  
				status) 
				VALUES ($id_skripsi,  
				'$npk', 
				'Usulan Disetujui', 
				'', 
				'Tersedia')");
			return $hasil;
		}
		
		function hitung_jumlah_dibimbing($npk){
			$hasil=$this->db->query(
				"SELECT * FROM 
				tbl_mahasiswa, 
				tbl_jenis_sk, 
				tbl_skripsi,
				tb_prodi,
				tbl_usulan_pembimbing,
				tbl_persetujuan_skripsi
				WHERE 
				tbl_mahasiswa.npm 							= tbl_skripsi.npm AND
				tbl_mahasiswa.kode_prodi 					= tb_prodi.kode_prodi AND
				tbl_jenis_sk.id_jenis_sk 					= tbl_skripsi.id_jenis_sk AND
				tbl_usulan_pembimbing.id_skripsi 			= tbl_skripsi.id_skripsi AND
				tbl_persetujuan_skripsi.id_skripsi 			= tbl_skripsi.id_skripsi AND
				tbl_persetujuan_skripsi.tema_persetujuan 	= 'Pengecekan Berkas Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha' AND
				tbl_usulan_pembimbing.npk 					= '$npk' AND
				tbl_usulan_pembimbing.status_persetujuan 	= 'Usulan disetujui Prodi' AND
				
				tb_prodi.status 							!= 'Dihapus' AND
				tbl_skripsi.status 							= 'Tersedia' AND
				tbl_jenis_sk.status 						= 'Tersedia' AND
				tbl_persetujuan_skripsi.status 				= 'Tersedia' AND
				tbl_mahasiswa.status 						= 'Aktif' AND
				tbl_usulan_pembimbing.status 				= 'Tersedia' 
				")->num_rows();
			return $hasil;
		}

		// function alasan_ditolak_usulan($id_skripsi)
		// {
		// 	$baris=$this->db->query(
		// 		"SELECT * FROM 
		// 		tbl_mahasiswa, 
		// 		tbl_jenis_sk, 
		// 		tbl_skripsi, 
		// 		tbl_persetujuan_skripsi
		// 		WHERE 
		// 		tbl_mahasiswa.npm 							= tbl_skripsi.npm AND
		// 		tbl_jenis_sk.id_jenis_sk 					= tbl_skripsi.id_jenis_sk AND
		// 		tbl_persetujuan_skripsi.id_skripsi 			= tbl_skripsi.id_skripsi AND
		// 		tbl_persetujuan_skripsi.tema_persetujuan 	= 'Pengecekan Berkas Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha' AND
		// 		tbl_skripsi.id_skripsi 						= '$id_skripsi' AND
		// 		tbl_mahasiswa.status 						!= 'Dihapus' AND
		// 		tbl_skripsi.status 							= 'Tersedia' AND
		// 		tbl_jenis_sk.status 						= 'Tersedia' AND
		// 		tbl_persetujuan_skripsi.status 				= 'Tersedia'
		// 		")->row();
		// 	if ($baris) {
		// 		return $baris->alasan_ditolak;
		// 	}else{
		// 		return '';
		// 	}
		// }

		function alasan_ditolak_usulan($id_skripsi)
		{
			$baris=$this->db->query(
				"SELECT * FROM 
				tbl_mahasiswa, 	
				tbl_jenis_sk, 
				tbl_skripsi, 
				tbl_persetujuan_skripsi,
				tb_dosen,
				tbl_dospem_skripsi
				WHERE 
				tbl_mahasiswa.npm 							= tbl_skripsi.npm AND
				tbl_jenis_sk.id_jenis_sk 					= tbl_skripsi.id_jenis_sk AND
				tbl_persetujuan_skripsi.id_skripsi 			= tbl_skripsi.id_skripsi AND
				tbl_dospem_skripsi.id_skripsi 				= tbl_skripsi.id_skripsi AND
				tbl_persetujuan_skripsi.tema_persetujuan 	= 'Pengecekan Berkas Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha' AND
				tbl_skripsi.id_skripsi 						= '$id_skripsi' AND
				tbl_mahasiswa.status 						!= 'Dihapus' AND
				tb_dosen.status 							!= 'Dihapus' AND
				tbl_skripsi.status 							= 'Tersedia' AND
				tbl_dospem_skripsi.status 					= 'Tersedia' AND
				tbl_jenis_sk.status 						= 'Tersedia' AND
				tbl_persetujuan_skripsi.status 				= 'Tersedia'
				")->row();
			if ($baris) {
				return $baris->alasan_ditolak;
			}else{
				return '';
			}
		}

		function alasan_ditolak_usulan1($id_persetujuan_usulan_pembimbing)
		{
			$baris=$this->db->query(
				"SELECT * FROM 
				tbl_persetujuan_usulan_pembimbing
				WHERE 
				
				tbl_persetujuan_usulan_pembimbing.id_persetujuan_usulan_pembimbing = '$id_persetujuan_usulan_pembimbing' AND
			
				tbl_persetujuan_usulan_pembimbing.status 	= 'Tersedia' 
				
				")->row();
			if ($baris) {
				return $baris->alasan_ditolak;
			}else{
				return '';
			}
		}

		function cekResponPilihan($id_usulan_pembimbing){
			$hasil=$this->db->query(
				"SELECT * FROM  
				tbl_usulan_pembimbing,
				tbl_skripsi
				WHERE 
				tbl_usulan_pembimbing.id_skripsi 			= tbl_skripsi.id_skripsi AND
				tbl_usulan_pembimbing.status 				= 'Tersedia' AND
				tbl_skripsi.status 							= 'Tersedia' AND
				tbl_usulan_pembimbing.id_usulan_pembimbing  = '$id_usulan_pembimbing'
				")->num_rows();
			return $hasil;
		}

		function cekResponPembimbing($id_skripsi, $idusu){
			// tbl_usulan_pembimbing
			$hasil=$this->db->query(
				"SELECT * FROM 
				tbl_usulan_pembimbing
				WHERE 
				status 				 = 'Tersedia' AND
				id_skripsi  		 ='$id_skripsi' AND
				id_usulan_pembimbing = '$idusu'
				");
			return $hasil->num_rows();
		}

		function cekResponKoordinator($id_skripsi, $id_persetujuan_usulan_pembimbing){
			// tbl_usulan_pembimbing
			$hasil=$this->db->query(
				"SELECT * FROM 
				tbl_persetujuan_usulan_pembimbing, tbl_usulan_pembimbing
				WHERE 
				tbl_persetujuan_usulan_pembimbing.id_usulan_pembimbing 					= tbl_usulan_pembimbing.id_usulan_pembimbing AND
				tbl_persetujuan_usulan_pembimbing.status 		= 'Tersedia' AND
				tbl_usulan_pembimbing.status 		= 'Tersedia' AND
				tbl_usulan_pembimbing.id_skripsi  ='$id_skripsi' AND
				tbl_persetujuan_usulan_pembimbing.id_persetujuan_usulan_pembimbing = '$id_persetujuan_usulan_pembimbing'
				");
			return $hasil->num_rows();
		}

		function cekkk($id1, $id2){
			$hasil=$this->db->query(
				"SELECT * FROM 
				tbl_usulan_pembimbing WHERE 
				id_skripsi = '$id2' 

				")->num_rows();
			if ($hasil>1){
				$hasil2=$this->db->query(
					"SELECT max(id_usulan_pembimbing) FROM 
					tbl_usulan_pembimbing WHERE 
					id_skripsi = '$id2'
					")->row();
				return $hasil2;
			}
			
		}
		

		function cekResponPembimbing11($id_usulan_pembimbing, $id_skripsi, $respon){
			$hasil=$this->db->query(
				"SELECT * FROM 
				tbl_dospem_skripsi, tbl_usulan_pembimbing
				WHERE 
				tbl_usulan_pembimbing.npk 					= tbl_dospem_skripsi.npk AND
				tbl_usulan_pembimbing.status 				= 'Tersedia' AND
				tbl_dospem_skripsi.status 					= 'Tersedia' AND
				tbl_dospem_skripsi.id_skripsi  				= '$id_skripsi' AND
				tbl_usulan_pembimbing.id_usulan_pembimbing  = '$id_usulan_pembimbing' AND
				tbl_dospem_skripsi.respon 					= '$respon'
				");
			return $hasil->num_rows();
		}

		function cekResponKoordinator11($id_usulan_pembimbing){
			$hasil=$this->db->query(
				"SELECT * FROM 
				tbl_persetujuan_usulan_pembimbing
				WHERE 
				id_usulan_pembimbing = '$id_usulan_pembimbing' AND
				status_persetujuan = 'Usulan Ditolak' 
				");
			return $hasil->num_rows();
		}

		function get_nama_pembimbing($id_skripsi){
			$hasil = $this->db->query(
				"SELECT * FROM tbl_dospem_skripsi, tb_dosen, tbl_skripsi
				WHERE 
				tbl_dospem_skripsi.status 		= 'Tersedia' AND 
				tbl_dospem_skripsi.respon 		= 'Usulan Disetujui' AND 
				tbl_skripsi.status 				= 'Tersedia' AND 
				tb_dosen.status 				!= 'Dihapus' AND
				tbl_dospem_skripsi.npk 			= tb_dosen.npk AND
				tbl_dospem_skripsi.id_skripsi 	= tbl_skripsi.id_skripsi AND
				tbl_dospem_skripsi.id_skripsi 	= '$id_skripsi' 
				")->row();
			if ($hasil) {
				return $hasil->nama_dosen;
			}else{
				return '';
			}
		}
	}
	?>