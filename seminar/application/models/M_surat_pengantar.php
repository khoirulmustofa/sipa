<?php 

class M_surat_pengantar extends CI_Model
{
	// TATAUSAHA
	// MENAMPILKAN DATA MAHASISWA BERDASARKAN KODE PRODI
	function combobox_mahasiswa($kode_prodi)
	{
		return $this->db->query("SELECT * FROM tbl_mahasiswa WHERE kode_prodi='$kode_prodi' AND status='Aktif'")->result_array();
	}

	function edit_data_mahasiswa($id_surat_pengantar, $npm, $nama_instansi, $alamat_instansi, $ditujukan, $lokasi, $judul_kp){
		$hasil = $this->db->query("UPDATE tbl_surat_pengantar 
			SET nama_instansi 			= '$nama_instansi', 
				alamat_instansi 		= '$alamat_instansi',
				ditujukan 					= '$ditujukan',
				lokasi 					= '$lokasi',
				judul_kp 				= '$judul_kp'
			WHERE id_surat_pengantar 	= '$id_surat_pengantar'");
		return $hasil;
	}

	// MENAMPILKAN DATA PRODI
	function combobox_prodi()
	{
		return $this->db->query("SELECT * FROM tb_prodi WHERE status='Tersedia'")->result_array();
	}

	// CEK STATUS PERSETUJUAN SURAT PENGANTAR OLEH TU
	function cekStatusPersetujuanSuratPengantar($id_surat_pengantar, $status_persetujuan, $jabatan){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa,
			tbl_surat_pengantar,
			tbl_persetujuan_surat_pengantar
			WHERE 
			tbl_persetujuan_surat_pengantar.id_surat_pengantar 	= tbl_surat_pengantar.id_surat_pengantar AND
			tbl_surat_pengantar.npm 							= tbl_mahasiswa.npm AND
			
			tbl_surat_pengantar.id_surat_pengantar 				= '$id_surat_pengantar' AND
			tbl_persetujuan_surat_pengantar.jabatan 			= '$jabatan' AND
			tbl_persetujuan_surat_pengantar.status_persetujuan 	= '$status_persetujuan' AND

			tbl_mahasiswa.status 								!= 'Dihapus' AND
			tbl_surat_pengantar.status 							= 'Tersedia' AND
			tbl_persetujuan_surat_pengantar.status 				= 'Tersedia' 			
			")->num_rows();
		return $hasil;
	}

	function cekStatusPersetujuanSuratPengantarMhsTu($id_surat_pengantar, $status_persetujuan){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa,
			tbl_surat_pengantar,
			tbl_persetujuan_surat_pengantar
			WHERE 
			tbl_persetujuan_surat_pengantar.id_surat_pengantar 	= tbl_surat_pengantar.id_surat_pengantar AND
			tbl_persetujuan_surat_pengantar.jabatan 	= '$jabatan' AND
			tbl_surat_pengantar.npm 							= tbl_mahasiswa.npm AND
			tbl_surat_pengantar.id_surat_pengantar 				= '$id_surat_pengantar' AND

			tbl_mahasiswa.status 								!= 'Dihapus' AND
			tbl_surat_pengantar.status 							= 'Tersedia' AND
			tbl_persetujuan_surat_pengantar.status 				= 'Tersedia' AND			
			tbl_persetujuan_surat_pengantar.status_persetujuan 	= '$status_persetujuan'
			")->num_rows();
		return $hasil;
	}

	function cekStatusPersetujuanSuratPengantarMhsProdi($id_surat_pengantar, $status_persetujuan){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa,
			tbl_surat_pengantar,
			tbl_persetujuan_surat_pengantar
			WHERE 
			tbl_persetujuan_surat_pengantar.id_surat_pengantar 	= tbl_surat_pengantar.id_surat_pengantar AND
			tbl_persetujuan_surat_pengantar.jabatan 	= 'Staff Prodi Teknik' AND
			tbl_surat_pengantar.npm 							= tbl_mahasiswa.npm AND
			tbl_surat_pengantar.id_surat_pengantar 				= '$id_surat_pengantar' AND

			tbl_mahasiswa.status 								!= 'Dihapus' AND
			tbl_surat_pengantar.status 							= 'Tersedia' AND
			tbl_persetujuan_surat_pengantar.status 				= 'Tersedia' AND			
			tbl_persetujuan_surat_pengantar.status_persetujuan 	= '$status_persetujuan'
			")->num_rows();
		return $hasil;
	}

	// function cekStatusPersetujuanSuratPengantar($id_surat_pengantar, $status_persetujuan){
	// 	$hasil=$this->db->query(
	// 		"SELECT * FROM 
	// 		tbl_mahasiswa,
	// 		tbl_surat_pengantar,
	// 		tbl_persetujuan_surat_pengantar
	// 		WHERE 
	// 		tbl_persetujuan_surat_pengantar.id_surat_pengantar 	= tbl_surat_pengantar.id_surat_pengantar AND
	// 		tbl_surat_pengantar.npm 							= tbl_mahasiswa.npm AND
	// 		tbl_surat_pengantar.id_surat_pengantar 				= '$id_surat_pengantar' AND

	// 		tbl_mahasiswa.status 								!= 'Dihapus' AND
	// 		tbl_surat_pengantar.status 							= 'Tersedia' AND
	// 		tbl_persetujuan_surat_pengantar.status 				= 'Tersedia' AND			
	// 		tbl_persetujuan_surat_pengantar.status_persetujuan 	= '$status_persetujuan'
	// 		")->num_rows();
	// 	return $hasil;
	// }

	// CEK RESPON TU TERHADAP SURAT PENGANTAR
	function cekResponSuratPengantarProdi($id_surat_pengantar){
		$hasil=$this->db->query(
			"SELECT * FROM  
			tbl_surat_pengantar,
			tbl_persetujuan_surat_pengantar
			WHERE 
			tbl_persetujuan_surat_pengantar.id_surat_pengantar 	= tbl_surat_pengantar.id_surat_pengantar AND
			tbl_surat_pengantar.status 							= 'Tersedia' AND
			tbl_persetujuan_surat_pengantar.status 				= 'Tersedia' AND
			tbl_surat_pengantar.id_surat_pengantar 				= '$id_surat_pengantar' AND
			tbl_persetujuan_surat_pengantar.jabatan 			= 'Staff Prodi Teknik'
			")->num_rows();
		return $hasil;
	}

	function cekResponSuratPengantarMhs($id_surat_pengantar){
		$hasil=$this->db->query(
			"SELECT * FROM  
			tbl_surat_pengantar,
			tbl_persetujuan_surat_pengantar
			WHERE 
			tbl_persetujuan_surat_pengantar.id_surat_pengantar 	= tbl_surat_pengantar.id_surat_pengantar AND
			tbl_surat_pengantar.status 							= 'Tersedia' AND
			tbl_persetujuan_surat_pengantar.status 				= 'Tersedia' AND
			tbl_surat_pengantar.id_surat_pengantar 				= '$id_surat_pengantar' 
			")->num_rows();
		return $hasil;
	}

	function cekResponSuratPengantar($id_surat_pengantar){
		$hasil=$this->db->query(
			"SELECT * FROM  
			tbl_surat_pengantar,
			tbl_persetujuan_surat_pengantar
			WHERE 
			tbl_persetujuan_surat_pengantar.id_surat_pengantar 	= tbl_surat_pengantar.id_surat_pengantar AND
			tbl_surat_pengantar.status 							= 'Tersedia' AND
			tbl_persetujuan_surat_pengantar.status 				= 'Tersedia' AND
			tbl_surat_pengantar.id_surat_pengantar 				= '$id_surat_pengantar' 
			")->num_rows();
		return $hasil;
	}

	// PERSETUJUAN SURAT PENGANTAR OLEH TATAUSAHA
	function persetujuanTu($id_surat_pengantar, $pelaku, $jabatan, $status_persetujuan, $alasan_ditolak){
		$hasil=$this->db->query(
			"INSERT INTO tbl_persetujuan_surat_pengantar (id_surat_pengantar, 
			pelaku,
			jabatan,
			status_persetujuan,
			alasan_ditolak,  
			status) 
			VALUES ($id_surat_pengantar,  
			'$pelaku', 
			'Staff Tata Usaha Teknik', 
			'$status_persetujuan', 
			'$alasan_ditolak', 
			'Tersedia')");
		return $hasil;
	}

	function persetujuanProdi($id_surat_pengantar, $pelaku, $jabatan, $status_persetujuan, $alasan_ditolak){
		$hasil=$this->db->query(
			"INSERT INTO tbl_persetujuan_surat_pengantar (id_surat_pengantar, 
			pelaku,
			jabatan,
			status_persetujuan,
			alasan_ditolak,  
			status) 
			VALUES ($id_surat_pengantar,  
			'$pelaku', 
			'Staff Prodi Teknik', 
			'$status_persetujuan', 
			'$alasan_ditolak', 
			'Tersedia')");
		return $hasil;
	}

	// MENAMPILKAN DATA SURAT PENGANTAR TATAUSAHA
	function return_kondisi(){
		if (isset($_SESSION['kode_prodi'])) {
			$kode_prodi = $_SESSION['kode_prodi'];
			$qr = "AND tb_prodi.kode_prodi 		= '$kode_prodi' ";
		}else{
			$qr = "";
		}
		return $qr;
	}

	function data_surat_pengantar(){
		$kondisi = $this->return_kondisi();
		$query = "SELECT * FROM tbl_surat_pengantar, 
								tbl_mahasiswa, 
								tb_prodi
				where tbl_surat_pengantar.npm 	= tbl_mahasiswa.npm AND
					tb_prodi.kode_prodi 		= tbl_mahasiswa.kode_prodi AND
					tbl_surat_pengantar.status 	='Tersedia' AND
					tb_prodi.status 			!= 'Dihapus' AND
					tbl_mahasiswa.status 		!='Dihapus'
				$kondisi
				ORDER BY tbl_surat_pengantar.id_surat_pengantar DESC";
			$hasil=$this->db->query($query)->result_array();
			return $hasil;
	}
	
	// MENAMPILKAN DATA DI TABLE
	// function show_monitoring_sk($kode_prodi, $date_mulai, $date_selesai)
	// {
	// 	$hasil=$this->db->query(
	// 		"SELECT * FROM 
	// 		tbl_mahasiswa, 
	// 		tbl_jenis_sk, 
	// 		tbl_syarat_sk,
	// 		tb_prodi
	// 		WHERE 
	// 		tbl_mahasiswa.npm = tbl_syarat_sk.npm AND
	// 		tbl_jenis_sk.id_jenis_sk = tbl_syarat_sk.id_jenis_sk AND
	// 		tb_prodi.kode_prodi= tbl_mahasiswa.kode_prodi AND

	// 		tb_prodi.status != 'Dihapus' AND
	// 		tbl_syarat_sk.status = 'Tersedia' AND
	// 		tbl_jenis_sk.status = 'Tersedia' AND
	// 		tbl_mahasiswa.status = 'Aktif' AND
	// 		tb_prodi.kode_prodi = '$kode_prodi' AND

	// 		DATE(tbl_syarat_sk.tgl_upload_syarat_sk) >= '$date_mulai' AND
	// 		DATE(tbl_syarat_sk.tgl_upload_syarat_sk) <= '$date_selesai' 
	// 		ORDER BY tbl_syarat_sk.tgl_upload_syarat_sk DESC
	// 		");
	// 	return $hasil;
	// }

	// MENAMPILKAN DATA MAHASISWA BERDASARKAN NPM
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

	// CEK DATA SURAT PENGANTAR
	function cekSuratPengantar($id_surat_pengantar){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa,
			tbl_surat_pengantar
			WHERE 
			tbl_surat_pengantar.npm 				= tbl_mahasiswa.npm AND
			tbl_surat_pengantar.id_surat_pengantar 	= '$id_surat_pengantar' AND

			tbl_mahasiswa.status 					!= 'Dihapus' AND
			tbl_surat_pengantar.status 				= 'Tersedia'
			")->num_rows();
		return $hasil;
	}

	// function cekSuratPengantar($id_surat_pengantar){
	// 	$hasil=$this->db->query(
	// 		"SELECT * FROM 
	// 		tbl_mahasiswa,
	// 		tbl_surat_pengantar
	// 		WHERE 
	// 		tbl_surat_pengantar.npm 				= tbl_mahasiswa.npm AND
	// 		tbl_surat_pengantar.id_surat_pengantar 	= '$id_surat_pengantar' AND

	// 		tbl_mahasiswa.status 					!= 'Dihapus' AND
	// 		tbl_surat_pengantar.status 				= 'Tersedia'
	// 		")->num_rows();
	// 	return $hasil;
	// }

	function cekSuratPengantarProdi($id_surat_pengantar){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa,
			tbl_surat_pengantar,
			tbl_persetujuan_surat_pengantar
			WHERE 
			tbl_surat_pengantar.npm 				= tbl_mahasiswa.npm AND
			tbl_surat_pengantar.id_surat_pengantar 	= '$id_surat_pengantar' AND
			tbl_persetujuan_surat_pengantar.id_surat_pengantar 	= tbl_surat_pengantar.id_surat_pengantar AND
			tbl_mahasiswa.status 					!= 'Dihapus' AND
			tbl_surat_pengantar.status 				= 'Tersedia'
			")->num_rows();
		return $hasil;
	}

	// MAHASISWA
	// MENAMBAH DATA MAHASISWA YANG MENGURUS SURAT PENGANTAR
	function tambah_surat_pengantar($npm, $nama_instansi, $alamat_instansi, $lokasi, $ditujukan, $judul_kp, $waktu_mulai, $waktu_selesai, $nama_file_full, $nama_file_full_lampiran){
		$hasil=$this->db->query("INSERT INTO tbl_surat_pengantar ( 
			npm, 
			nama_instansi, 
			alamat_instansi, 
			lokasi, 
			ditujukan, 
			judul_kp, 
			waktu_mulai, 
			waktu_selesai,
			nama_file_surat_pengantar, 
			lampiran, 
			status) 
			VALUES ( 
			'$npm', 
			'$nama_instansi', 
			'$alamat_instansi', 
			'$lokasi', 
			'$ditujukan', 
			'$judul_kp', 
			'$waktu_mulai', 
			'$waktu_selesai', 
			'$nama_file_full', 
			'$nama_file_full_lampiran', 
			'Tersedia')");
		return $hasil;
	}

	// MENAMPILKAN DATA SURAT PENGANTAR MAHASISWA
	function data_surat_pengantar_mhs($kode_prodi){
		$npm = $_SESSION['npm'];
		return $this->db->query("SELECT * FROM tbl_surat_pengantar, tbl_mahasiswa
			where tbl_surat_pengantar.npm 	= tbl_mahasiswa.npm AND
			tbl_surat_pengantar.status 		='Tersedia' AND
			tbl_mahasiswa.kode_prodi 		= '$kode_prodi' AND
			tbl_mahasiswa.npm 				= '$npm' AND
			tbl_mahasiswa.status 			!='Dihapus' 
			ORDER BY tbl_surat_pengantar.tgl_upload_surat_pengantar DESC
			")->result_array();
	}

	// MENGAHAPUS DATA MAHASISWA YANG MENGURUS SURAT PENGANTAR
	function hapus_surat_pengantar($id_surat_pengantar){
		$hasil = $this->db->query("UPDATE tbl_surat_pengantar SET status = 'Dihapus' WHERE id_surat_pengantar ='$id_surat_pengantar';");
		return $hasil;
	}
	
	// FAKULTAS
	
	function show_surat_pengantar_prodi($kode_prodi)
	{
		$kondisi = $this->return_kondisi();
		$query = "SELECT * FROM 
			tbl_mahasiswa, 
			tb_prodi,
			tbl_surat_pengantar,
			tbl_persetujuan_surat_pengantar
			WHERE 
			tbl_mahasiswa.kode_prodi 							= tb_prodi.kode_prodi AND
			tbl_surat_pengantar.npm 							= tbl_mahasiswa.npm AND
			tbl_persetujuan_surat_pengantar.id_surat_pengantar 	= tbl_surat_pengantar.id_surat_pengantar AND

			tb_prodi.status 									!= 'Dihapus' AND
			tbl_surat_pengantar.status 							= 'Tersedia' AND
			tbl_persetujuan_surat_pengantar.status 				= 'Tersedia' AND
			tbl_mahasiswa.status 								= 'Aktif' AND

			tbl_persetujuan_surat_pengantar.status_persetujuan 	= 'Berkas Disetujui' AND
			tbl_persetujuan_surat_pengantar.jabatan 	= 'Staff Tata Usaha Teknik' AND
			tb_prodi.kode_prodi 	= '$kode_prodi'
			$kondisi
			ORDER BY tbl_persetujuan_surat_pengantar.id_persetujuan_surat_pengantar DESC";
			$hasil=$this->db->query($query)->result_array();
			return $hasil;
	}

	function show_surat_pengantar_fakultas()
	{
		$kondisi = $this->return_kondisi();
		$query = "SELECT * FROM 
			tbl_mahasiswa, 
			tb_prodi,
			tbl_surat_pengantar,
			tbl_persetujuan_surat_pengantar
			WHERE 
			tbl_mahasiswa.kode_prodi 							= tb_prodi.kode_prodi AND
			tbl_surat_pengantar.npm 							= tbl_mahasiswa.npm AND
			tbl_persetujuan_surat_pengantar.id_surat_pengantar 	= tbl_surat_pengantar.id_surat_pengantar AND

			tb_prodi.status 									!= 'Dihapus' AND
			tbl_surat_pengantar.status 							= 'Tersedia' AND
			tbl_persetujuan_surat_pengantar.status 				= 'Tersedia' AND
			tbl_mahasiswa.status 								= 'Aktif' AND

			tbl_persetujuan_surat_pengantar.status_persetujuan 	= 'Berkas Disetujui' AND
			tbl_persetujuan_surat_pengantar.jabatan 	= 'Staff Prodi Teknik'
			$kondisi
			ORDER BY tbl_persetujuan_surat_pengantar.id_persetujuan_surat_pengantar DESC";
			$hasil=$this->db->query($query)->result_array();
			return $hasil;
	}

	// CEK RESPON FAKULTAS TERHADAP SURAT PENGANTAR
	function cekResponSuratPengantarFakultas($id_surat_pengantar){
		$hasil=$this->db->query(
			"SELECT * FROM  
			tbl_surat_pengantar,
			tbl_persetujuan_surat_pengantar, 
			tbl_ttd_surat, 
			tbl_nomor_surat
			WHERE 
			tbl_persetujuan_surat_pengantar.id_surat_pengantar = tbl_surat_pengantar.id_surat_pengantar AND
			tbl_ttd_surat.topik_relasi 		= 'Tandatangan Surat Pengantar Instansi KP oleh Dekan' AND
			tbl_ttd_surat.id_relasi 		= tbl_surat_pengantar.id_surat_pengantar AND
			tbl_nomor_surat.id_relasi 		= tbl_surat_pengantar.id_surat_pengantar AND
			tbl_nomor_surat.relasi_tabel 	= 'tbl_surat_pengantar' AND
			tbl_nomor_surat.fungsi_nomor 	= 'Surat Pengantar Instansi KP' AND

			tbl_ttd_surat.status 			= 'Tersedia' AND
			tbl_persetujuan_surat_pengantar.status = 'Tersedia' AND
			tbl_nomor_surat.status 			= 'Tersedia' AND
			tbl_surat_pengantar.status 		= 'Tersedia' AND
			tbl_surat_pengantar.id_surat_pengantar = '$id_surat_pengantar'
			")->num_rows();
		return $hasil;
	}

	// PENOMORAN SURAT OTOMATIS
	function input_nomor_surat($id_surat_pengantar, $nama_instansi, $alamat_instansi, $npm, $nama_mahasiswa, $waktu_mulai, $waktu_selesai, $tgl_upload_surat_pengantar){
		date_default_timezone_set('Asia/Jakarta');
		$tahun = date('Y');
		$waktu_sekarang = date('Y-m-d H:i:s');
		$row = $this->db->query("SELECT max(nomor_surat) AS nomor_max FROM tbl_nomor_surat WHERE tahun = '$tahun' AND fungsi_nomor='Surat Pengantar Instansi KP'")->row();
		if ($row) {
			$nomor_surat = $row->nomor_max;
		} else{
			$nomor_surat = 0;
		}

		$angka = $this->db->query("SELECT * FROM tbl_nomor_surat WHERE relasi_tabel='tbl_surat_pengantar' OR  relasi_tabel='tbl_surat_pengantar_penelitian' AND status = 'Tersedia'")->num_rows();

		$input_nomor = $this->db->query(
			"INSERT INTO tbl_nomor_surat (fungsi_nomor, 
			relasi_tabel, 
			id_relasi,
			nomor_surat, 
			tahun, 
			status) 
			VALUES ('Surat Pengantar Instansi KP', 
			'tbl_surat_pengantar', 
			$id_surat_pengantar, 
			($angka +1), 
			'$tahun', 
			'Tersedia')"
			);
		if ($input_nomor) {
			$topik_relasi 			= 'Tandatangan Surat Pengantar Instansi KP oleh Dekan';
			$id_random 				= $this->generate_id_random();
			$nama_penanda_tangan 	= $_SESSION['nama'];
			$npk_penanda_tangan 	= $_SESSION['npk'];
			$jabatan_penanda_tangan = $_SESSION['jabatan'];
			$kodemax 				= str_pad(($nomor_surat+1), 4, "0", STR_PAD_LEFT);
			$nomor_surat_full 		= ($kodemax).'/E-UIR/27-T/'.$tahun;
			// $nomor_surat_full 		= ($kodemax).'/KPTS/FT-UIR/SP/'.$tahun;
			$perihal 				= 'Tandatangan Surat Pengantar Instansi KP ke '.$nama_instansi.' di '.$alamat_instansi.' atas nama '.$nama_mahasiswa.' ('.$npm.') yang diajukan pada tanggal '.$tgl_upload_surat_pengantar.' dan berlangsung pada '.$waktu_mulai.'sampai dengan '.$waktu_selesai.'.' ;
			$hasil = $this->db->query(
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
				VALUES ('$id_surat_pengantar', 
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

			while($this->db->query("SELECT * FROM tb_ttd_digital WHERE id_random='$rand' AND status = 'Tersedia'")->num_rows()>0){
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

		function get_row_data_surat_pengantar($id_surat_pengantar){
			$topik_relasi = 'Tandatangan Surat Pengantar Instansi KP oleh Dekan';
			$hasil = $this->db->query(
				"SELECT * FROM tbl_mahasiswa, 
								tbl_ttd_surat, 
								tbl_surat_pengantar, 
								tbl_nomor_surat, 
								tb_prodi
				WHERE 
				tbl_surat_pengantar.npm 				= tbl_mahasiswa.npm AND
				tb_prodi.kode_prodi 					= tbl_mahasiswa.kode_prodi AND
				tbl_surat_pengantar.id_surat_pengantar 	= tbl_nomor_surat.id_relasi AND
				tbl_surat_pengantar.id_surat_pengantar 	= tbl_ttd_surat.id_relasi AND
				tbl_nomor_surat.fungsi_nomor 			= 'Surat Pengantar Instansi KP' AND
				tbl_ttd_surat.topik_relasi 				= '$topik_relasi' AND
				tbl_surat_pengantar.id_surat_pengantar 	= '$id_surat_pengantar' AND
				tbl_surat_pengantar.status 				= 'Tersedia' AND
				tbl_ttd_surat.status 					= 'Tersedia' AND
				tbl_nomor_surat.status 					= 'Tersedia' AND
				tb_prodi.status 						= 'Tersedia' AND
				tbl_mahasiswa.status 					!= 'Dihapus' 
				");
			return $hasil->row();
		}

		function get_email_prodi($kode_prodi){
			$hasil = $this->db->query(
				"SELECT email AS email FROM tb_prodi_attribut 
				WHERE status_akun != 'Dihapus' AND
				kode_prodi = '$kode_prodi' AND 
				jabatan='Ketua Program Studi'")->row();
			if ($hasil) {
				return $hasil->email;
			}else{
				return '-';
			}
		}

		function get_nohp_prodi($kode_prodi){
			$hasil = $this->db->query(
				"SELECT no_hp AS no_hp FROM tb_prodi_attribut 
				WHERE status_akun != 'Dihapus' AND
				kode_prodi = '$kode_prodi' AND 
				jabatan='Ketua Program Studi'")->row();
			if ($hasil) {
				return $hasil->no_hp;
			}else{
				return '-';
			}
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

	// ----------------------------------------------------
	// EDIT PROFIL MAHASISWA TANPA FOTO
		function edit_data_nofile($id_syarat_sk, 
			$npm, 
			$nama_tempat_kp, 
			$judul_kp, 
			$nama_pembimbing_lapangan, 
			$no_hp_pembimbing_lapangan, 
			$waktu_mulai, 
			$waktu_selesai){
			date_default_timezone_set('Asia/Jakarta');
			$tgl_sekarang = date('Y-m-d H:i:s');
			$hasil = $this->db->query("UPDATE tbl_syarat_sk 
				SET nama_tempat_kp 			='$nama_tempat_kp', 
				judul_kp 					='$judul_kp', 
				nama_pembimbing_lapangan 	='$nama_pembimbing_lapangan', 
				no_hp_pembimbing_lapangan 	='$no_hp_pembimbing_lapangan' , 
				waktu_mulai 				='$waktu_mulai' , 
				waktu_selesai 			='$waktu_selesai',
				tgl_upload_syarat_sk		='$tgl_sekarang'
				WHERE id_syarat_sk ='$id_syarat_sk'");
			return $hasil;
		}

	// EDIT PROFIL MAHASISWA DENGAN FOTO
		function edit_data($id_syarat_sk, 
			$npm, 
			$nama_tempat_kp, 
			$judul_kp, 
			$nama_pembimbing_lapangan, 
			$no_hp_pembimbing_lapangan, 
			$waktu_mulai, 
			$waktu_selesai, 
			$nama_file_syarat_sk_baru){
			date_default_timezone_set('Asia/Jakarta');
			$tgl_sekarang = date('Y-m-d H:i:s');
			$hasil = $this->db->query("UPDATE tbl_syarat_sk 
				SET nama_tempat_kp 			='$nama_tempat_kp', 
				judul_kp 					='$judul_kp', 
				nama_pembimbing_lapangan 	='$nama_pembimbing_lapangan', 
				no_hp_pembimbing_lapangan 	='$no_hp_pembimbing_lapangan' , 
				waktu_mulai 				='$waktu_mulai' , 
				waktu_selesai 			='$waktu_selesai' , 
				nama_file_syarat_sk 		='$nama_file_syarat_sk_baru',
				tgl_upload_syarat_sk		='$tgl_sekarang' 
				WHERE id_syarat_sk 			='$id_syarat_sk'");
			return $hasil;
		}

	// -----------------------------------------------------------------------------
		function hapus_respon_tu($id_syarat_sk){
			$hasil = $this->db->query("UPDATE tbl_persetujuan_sk 
				SET status 			= 'Dihapus'
				WHERE id_syarat_sk 	='$id_syarat_sk'");
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

		// function alasan_ditolak($npm, $id_syarat_sk)
		// {
		// 	$hasil=$this->db->query(
		// 		"SELECT * FROM 
		// 		tbl_mahasiswa, 
		// 		tbl_jenis_sk, 
		// 		tbl_syarat_sk, 
		// 		tbl_persetujuan_sk
		// 		WHERE 
		// 		tbl_mahasiswa.npm = tbl_syarat_sk.npm AND
		// 		tbl_jenis_sk.id_jenis_sk = tbl_syarat_sk.id_jenis_sk AND
		// 		tbl_persetujuan_sk.id_syarat_sk = tbl_syarat_sk.id_syarat_sk AND
		// 		tbl_mahasiswa.npm = '$npm' AND
		// 		tbl_mahasiswa.status != 'Dihapus' AND
		// 		tbl_syarat_sk.status = 'Tersedia' AND
		// 		tbl_jenis_sk.status = 'Tersedia' AND
		// 		tbl_persetujuan_sk.status = 'Tersedia'
		// 		");
		// 	return $hasil->result_array();
		// }

		function alasan_ditolak($npm, $id_surat_pengantar)
		{
			$hasil=$this->db->query(
				"SELECT * FROM 
				tbl_mahasiswa, 
				tbl_surat_pengantar, 
				tbl_persetujuan_surat_pengantar
				WHERE 
				tbl_mahasiswa.npm = tbl_surat_pengantar.npm AND
				tbl_persetujuan_surat_pengantar.id_surat_pengantar = tbl_surat_pengantar.id_surat_pengantar AND
				-- tbl_mahasiswa.npm = '$npm' AND
				tbl_surat_pengantar.id_surat_pengantar 	= '$id_surat_pengantar' AND
				tbl_mahasiswa.status 					!= 'Dihapus' AND
				tbl_surat_pengantar.status 				= 'Tersedia' AND
				tbl_persetujuan_surat_pengantar.status 	= 'Tersedia'
				");
			return $hasil->result_array();
		}

		
	}
	?>