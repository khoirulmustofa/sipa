<?php 

class M_monitoring_sk extends CI_Model
{
	function kalkulasiNilaiDospem($id_syarat_sk){
		$baris_nilai1 = $this->db->query(
			"SELECT * FROM tbl_nilai, tbl_syarat_sk 
			WHERE 	tbl_nilai.id_syarat_sk 	= tbl_syarat_sk.id_syarat_sk AND 
			tbl_nilai.status 				='Tersedia' AND
			tbl_syarat_sk.id_syarat_sk 		= '$id_syarat_sk' AND
			tbl_syarat_sk.status 			='Tersedia'")->row();

		$sikap1 		= $baris_nilai1->sikap;
		$pemahaman1 	= $baris_nilai1->pemahaman;
		$kelengkapan1 	= $baris_nilai1->kelengkapan;

		$jumlah1 		= (($sikap1*25)/100) + (($pemahaman1*50)/100) +  (($kelengkapan1*25)/100);
		return $jumlah1;

	}

	function combobox_prodi()
	{
		return $this->db->query("SELECT * FROM tb_prodi WHERE status='Tersedia'")->result_array();
	}

	function combobox_nama_tempat_kp($npm)
	{
		return $this->db->query(
			"SELECT * FROM tbl_surat_pengantar, tbl_persetujuan_surat_pengantar, tbl_mahasiswa 
			WHERE tbl_mahasiswa.npm = tbl_surat_pengantar.npm AND
			tbl_persetujuan_surat_pengantar.id_surat_pengantar = tbl_surat_pengantar.id_surat_pengantar AND 
			tbl_mahasiswa.status !='Dihapus' AND
			tbl_persetujuan_surat_pengantar.status = 'Tersedia' AND
			tbl_mahasiswa.npm = '$npm' AND
			tbl_surat_pengantar.status = 'Tersedia'")->result_array();
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

	function show_monitoring_sk()
	{
		$kondisi = $this->return_kondisi();
		$query = "SELECT * FROM 
		tbl_mahasiswa, 
		tbl_jenis_sk, 
		tbl_syarat_sk,
		tb_prodi,
		tbl_surat_pengantar
		WHERE 
		tbl_mahasiswa.npm 			= tbl_syarat_sk.npm AND
		tbl_jenis_sk.id_jenis_sk 	= tbl_syarat_sk.id_jenis_sk AND
		tb_prodi.kode_prodi 		= tbl_mahasiswa.kode_prodi AND
		tbl_surat_pengantar.id_surat_pengantar = tbl_syarat_sk.nama_tempat_kp AND

		tb_prodi.status 			!= 'Dihapus' AND
		tbl_syarat_sk.status 		= 'Tersedia' AND
		tbl_jenis_sk.status 		= 'Tersedia' AND
		tbl_surat_pengantar.status 		= 'Tersedia' AND
		tbl_mahasiswa.status 		= 'Aktif'
		$kondisi
		ORDER BY tbl_syarat_sk.tgl_upload_syarat_sk DESC";
		$hasil=$this->db->query($query)->result_array();
		return $hasil;
	}

	// function show_monitoring_sk_all()
	// {
	// 	$hasil=$this->db->query(
	// 		"SELECT * FROM 
	// 		tbl_mahasiswa, 
	// 		tbl_jenis_sk, 
	// 		tbl_syarat_sk,
	// 		tb_prodi,
	// 		tbl_surat_pengantar
	// 		WHERE 
	// 		tbl_mahasiswa.npm 			= tbl_syarat_sk.npm AND
	// 		tbl_jenis_sk.id_jenis_sk 	= tbl_syarat_sk.id_jenis_sk AND
	// 		tb_prodi.kode_prodi 		= tbl_mahasiswa.kode_prodi AND
	// 		tbl_surat_pengantar.id_surat_pengantar = tbl_syarat_sk.nama_tempat_kp AND

	// 		tb_prodi.status 			!= 'Dihapus' AND
	// 		tbl_syarat_sk.status 		= 'Tersedia' AND
	// 		tbl_jenis_sk.status 		= 'Tersedia' AND
	// 		tbl_surat_pengantar.status 		= 'Tersedia' AND
	// 		tbl_mahasiswa.status 		= 'Aktif'
	// 		ORDER BY tbl_syarat_sk.tgl_upload_syarat_sk DESC
	// 		");
	// 	return $hasil;
	// }

	function show_monitoring_sk_prodi()
	{
		$kondisi = $this->return_kondisi();
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_syarat_sk,
			tb_prodi,
			tbl_persetujuan_sk,
			tbl_surat_pengantar
			WHERE 
			tbl_mahasiswa.npm 			= tbl_syarat_sk.npm AND
			tbl_jenis_sk.id_jenis_sk 	= tbl_syarat_sk.id_jenis_sk AND
			tb_prodi.kode_prodi 		= tbl_mahasiswa.kode_prodi AND
			tbl_surat_pengantar.id_surat_pengantar 		= tbl_syarat_sk.nama_tempat_kp AND

			tb_prodi.status 			!= 'Dihapus' AND
			tbl_syarat_sk.status 		= 'Tersedia' AND
			tbl_surat_pengantar.status 	= 'Tersedia' AND
			tbl_jenis_sk.status 		= 'Tersedia' AND
			tbl_mahasiswa.status 		!= 'Dihapus' AND

			tbl_persetujuan_sk.id_syarat_sk 		= tbl_syarat_sk.id_syarat_sk AND
			tbl_persetujuan_sk.status_persetujuan 	= 'Berkas Disetujui' AND
			tbl_persetujuan_sk.tema_persetujuan = 'Pengecekan Berkas Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha' 
			$kondisi

			ORDER BY tbl_syarat_sk.tgl_upload_syarat_sk DESC
			");
		return $hasil;
	}

	function show_monitoring_sk_gkm($date_mulai, $date_selesai)
	{
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_syarat_sk,
			tb_prodi,
			tbl_persetujuan_sk,
			tbl_surat_pengantar
			WHERE 
			tbl_mahasiswa.npm 			= tbl_syarat_sk.npm AND
			tbl_jenis_sk.id_jenis_sk 	= tbl_syarat_sk.id_jenis_sk AND
			tb_prodi.kode_prodi 		= tbl_mahasiswa.kode_prodi AND
			tbl_surat_pengantar.id_surat_pengantar 		= tbl_syarat_sk.nama_tempat_kp AND

			tb_prodi.status 			!= 'Dihapus' AND
			tbl_syarat_sk.status 		= 'Tersedia' AND
			tbl_surat_pengantar.status 	= 'Tersedia' AND
			tbl_jenis_sk.status 		= 'Tersedia' AND
			tbl_mahasiswa.status 		!= 'Dihapus' AND

			tbl_persetujuan_sk.id_syarat_sk 		= tbl_syarat_sk.id_syarat_sk AND
			tbl_persetujuan_sk.status_persetujuan 	= 'Berkas Disetujui' AND
			tbl_persetujuan_sk.tema_persetujuan = 'Pengecekan Berkas Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha' AND
			DATE(tbl_syarat_sk.tgl_upload_syarat_sk) >= '$date_mulai' AND
			DATE(tbl_syarat_sk.tgl_upload_syarat_sk) <= '$date_selesai'
			ORDER BY tbl_syarat_sk.tgl_upload_syarat_sk DESC
			");
		return $hasil;
	}

	// CEK RESPON FAKULTAS TERHADAP SK
	function cekResponSKFakultas($id_syarat_sk){
		$hasil=$this->db->query(
			"SELECT * FROM  
			tbl_syarat_sk,
			tbl_persetujuan_sk, 
			tbl_ttd_surat, 
			tbl_nomor_surat
			WHERE 
			tbl_persetujuan_sk.id_persetujuan_sk 	= tbl_persetujuan_sk.id_persetujuan_sk AND
			tbl_syarat_sk.status 					= 'Tersedia' AND
			tbl_ttd_surat.topik_relasi 				= 'Tandatangan SK Pembimbing KP oleh Dekan' AND
			tbl_ttd_surat.id_relasi 				= tbl_syarat_sk.id_syarat_sk AND
			tbl_nomor_surat.id_relasi 				= tbl_syarat_sk.id_syarat_sk AND
			tbl_nomor_surat.relasi_tabel 			= 'tbl_syarat_sk' AND
			tbl_nomor_surat.fungsi_nomor 			= 'SK Pembimbing KP' AND

			tbl_ttd_surat.status 					= 'Tersedia' AND
			tbl_persetujuan_sk.status 				= 'Tersedia' AND
			tbl_nomor_surat.status 					= 'Tersedia' AND
			tbl_syarat_sk.id_syarat_sk 				= '$id_syarat_sk'
			")->num_rows();
		return $hasil;
	}
	
	function show_nilai_pembimbing_lapangan()
	{
		$hasil=$this->db->query("SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_syarat_sk,
			tb_prodi,
			tbl_persetujuan_sk, 
			tbl_dospem,
			tbl_nomor_surat,
			tbl_ttd_surat,
			tbl_bimbingan,
			tbl_pembimbing_lapangan
			WHERE 
			tbl_mahasiswa.npm 					= tbl_syarat_sk.npm AND
			tbl_mahasiswa.kode_prodi 			= tb_prodi.kode_prodi AND
			tbl_jenis_sk.id_jenis_sk 			= tbl_syarat_sk.id_jenis_sk AND
			tbl_persetujuan_sk.id_syarat_sk 	= tbl_syarat_sk.id_syarat_sk AND
			tbl_dospem.id_syarat_sk 			= tbl_syarat_sk.id_syarat_sk AND
			tbl_pembimbing_lapangan.id_syarat_sk = tbl_syarat_sk.id_syarat_sk AND
			tbl_ttd_surat.topik_relasi 			= 'Tandatangan SK Pembimbing KP oleh Dekan' AND
			tbl_ttd_surat.id_relasi 			= tbl_syarat_sk.id_syarat_sk AND
			tbl_nomor_surat.id_relasi 			= tbl_syarat_sk.id_syarat_sk AND
			tbl_nomor_surat.relasi_tabel 		= 'tbl_syarat_sk' AND
			tbl_nomor_surat.fungsi_nomor 		= 'SK Pembimbing KP' AND
			tbl_persetujuan_sk.tema_persetujuan = 'Pengecekan Berkas Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha' AND

			tb_prodi.status 					!= 'Dihapus' AND
			tbl_syarat_sk.status 				= 'Tersedia' AND
			tbl_jenis_sk.status 				= 'Tersedia' AND
			tbl_pembimbing_lapangan.status 		= 'Tersedia' AND
			tbl_bimbingan.status 				= 'Tersedia' AND
			tbl_mahasiswa.status 				= 'Aktif' AND
			tbl_dospem.status 					= 'Tersedia' AND
			tbl_persetujuan_sk.status 			= 'Tersedia' AND
			tbl_nomor_surat.status 				= 'Tersedia' AND
			tbl_ttd_surat.status 				= 'Tersedia' 
			ORDER BY tbl_bimbingan.id_bimbingan DESC;
			");
		return $hasil;
	}

	public function cek_nilai_dospem($id_syarat_sk)
	{
		$hasil=$this->db->query("SELECT * FROM 
			tbl_syarat_sk,
			tbl_nilai,
			tbl_dospem
			WHERE 
			tbl_nilai.id_syarat_sk 				= tbl_syarat_sk.id_syarat_sk AND
			tbl_dospem.id_syarat_sk 				= tbl_syarat_sk.id_syarat_sk AND
			tbl_syarat_sk.status 				= 'Tersedia' AND
			tbl_nilai.status 					= 'Tersedia' AND
			tbl_syarat_sk.id_syarat_sk 				= '$id_syarat_sk'

			");
		return $hasil;
	}

	function show_monitoring_sk_fakultas()
	{
		$kondisi = $this->return_kondisi();
		$query = "SELECT * FROM
		tbl_mahasiswa, 
		tbl_jenis_sk, 
		tbl_syarat_sk,
		tb_prodi,
		tbl_persetujuan_sk, 
		tbl_dospem,
		tb_dosen,
		tbl_surat_pengantar
		WHERE 
		tbl_mahasiswa.npm 						= tbl_syarat_sk.npm AND
		tbl_mahasiswa.kode_prodi 				= tb_prodi.kode_prodi AND
		tbl_jenis_sk.id_jenis_sk 				= tbl_syarat_sk.id_jenis_sk AND
		tbl_persetujuan_sk.id_syarat_sk 		= tbl_syarat_sk.id_syarat_sk AND
		tbl_dospem.id_syarat_sk 				= tbl_syarat_sk.id_syarat_sk AND
		tbl_surat_pengantar.id_surat_pengantar 	= tbl_syarat_sk.nama_tempat_kp AND
		tbl_dospem.npk 							= tb_dosen.npk AND
		tbl_persetujuan_sk.tema_persetujuan = 'Pengecekan Berkas Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha' AND

		tb_prodi.status 				!= 'Dihapus' AND
		tbl_syarat_sk.status 			= 'Tersedia' AND
		tbl_surat_pengantar.status 		= 'Tersedia' AND
		tbl_jenis_sk.status 			= 'Tersedia' AND
		tbl_mahasiswa.status 			= 'Aktif' AND
		tbl_dospem.status 				= 'Tersedia' AND
		tbl_persetujuan_sk.status 		= 'Tersedia' AND

		tbl_dospem.respon = 'Penunjukan Diterima Pembimbing' 
		$kondisi
		ORDER BY tbl_dospem.id_dospem DESC";
		$hasil=$this->db->query($query)->result_array();
		return $hasil;
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

	function cekStatusPersetujuanTU($id_syarat_sk, $tema_persetujuan, $status_persetujuan){
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

			tbl_mahasiswa.status 					!= 'Dihapus' AND
			tbl_syarat_sk.status 					= 'Tersedia' AND
			tbl_jenis_sk.status 					= 'Tersedia' AND
			tbl_persetujuan_sk.status 				= 'Tersedia' AND
			tbl_syarat_sk.id_syarat_sk 				='$id_syarat_sk' AND
			tbl_persetujuan_sk.tema_persetujuan 	= '$tema_persetujuan' AND
			tbl_persetujuan_sk.status_persetujuan 	= '$status_persetujuan'
			")->num_rows();
		return $hasil;
	}

	function alasan_ditolak($id_syarat_sk, $tema_persetujuan)
	{
		$baris=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_syarat_sk, 
			tbl_persetujuan_sk
			WHERE 
			tbl_mahasiswa.npm 				= tbl_syarat_sk.npm AND
			tbl_jenis_sk.id_jenis_sk 		= tbl_syarat_sk.id_jenis_sk AND
			tbl_persetujuan_sk.id_syarat_sk = tbl_syarat_sk.id_syarat_sk AND
			tbl_persetujuan_sk.id_syarat_sk = '$id_syarat_sk' AND
			tbl_persetujuan_sk.tema_persetujuan = '$tema_persetujuan' AND
			tbl_mahasiswa.status 			!= 'Dihapus' AND
			tbl_syarat_sk.status 			= 'Tersedia' AND
			tbl_jenis_sk.status 			= 'Tersedia' AND
			tbl_persetujuan_sk.status 		= 'Tersedia'
			")->row();
		if ($baris) {
			return $baris->alasan_ditolak;
		}else{
			return '';
		}
	}


	function persetujuan($id_syarat_sk, $pelaku, $jabatan, $status_persetujuan, $tema_persetujuan, $alasan_ditolak){

		$tes = $this->db->query("SELECT * FROM tbl_persetujuan_sk WHERE id_syarat_sk=$id_syarat_sk AND tema_persetujuan = 'Pengecekan Berkas Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha' AND status = 'Tersedia'")->num_rows();
		if ($tes < 1){

			$hasil=$this->db->query("INSERT INTO tbl_persetujuan_sk (id_syarat_sk, 
				pelaku, 
				jabatan, 
				status_persetujuan,
				tema_persetujuan, 
				alasan_ditolak,  
				status) 
				VALUES ($id_syarat_sk, 
				'$pelaku', 
				'$jabatan', 
				'$status_persetujuan', 
				'$tema_persetujuan', 
				'$alasan_ditolak', 
				'Tersedia')");
			return $hasil;
		}
	}

	function cekResponTU($id_syarat_sk, $tema){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_syarat_sk, 
			tbl_persetujuan_sk
			WHERE 
			tbl_mahasiswa.npm 					= tbl_syarat_sk.npm AND
			tbl_jenis_sk.id_jenis_sk 			= tbl_syarat_sk.id_jenis_sk AND
			tbl_persetujuan_sk.id_syarat_sk 	= tbl_syarat_sk.id_syarat_sk AND
			
			tbl_mahasiswa.status 				!= 'Dihapus' AND
			tbl_syarat_sk.status 				= 'Tersedia' AND
			tbl_jenis_sk.status 				= 'Tersedia' AND
			tbl_persetujuan_sk.status 			= 'Tersedia' AND
			tbl_persetujuan_sk.tema_persetujuan ='$tema' AND
			tbl_persetujuan_sk.id_syarat_sk 	= '$id_syarat_sk'
			")->num_rows();
		return $hasil;
	}

	function cekOpenFile($id_syarat_sk, $file_open){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_syarat_sk, 
			tbl_open_file
			WHERE 
			tbl_mahasiswa.npm 					= tbl_syarat_sk.npm AND
			tbl_jenis_sk.id_jenis_sk 			= tbl_syarat_sk.id_jenis_sk AND
			tbl_open_file.id_syarat_sk 	= tbl_syarat_sk.id_syarat_sk AND
			
			tbl_mahasiswa.status 				!= 'Dihapus' AND
			tbl_syarat_sk.status 				= 'Tersedia' AND
			tbl_jenis_sk.status 				= 'Tersedia' AND
			tbl_open_file.status 			= 'Tersedia' AND
			tbl_open_file.file_open ='$file_open' AND
			tbl_open_file.id_syarat_sk 	= '$id_syarat_sk'
			")->num_rows();
		return $hasil;
	}

	// CEK RESPON FAKULTAS TERHADAP SK
	// function cekResponSKFakultas($id_syarat_sk){
	// 	$hasil=$this->db->query(
	// 		"SELECT * FROM  
	// 		tbl_syarat_sk,
	// 		tbl_persetujuan_sk, 
	// 		tbl_ttd_surat, 
	// 		tbl_nomor_surat
	// 		WHERE 
	// 		tbl_persetujuan_sk.id_syarat_sk = tbl_syarat_sk.id_syarat_sk AND
	// 		tbl_ttd_surat.topik_relasi = 'Tandatangan SK Pembimbing KP oleh Dekan' AND
	// 		tbl_ttd_surat.id_relasi = tbl_syarat_sk.id_syarat_sk AND
	// 		tbl_nomor_surat.id_relasi = tbl_syarat_sk.id_syarat_sk AND
	// 		tbl_nomor_surat.relasi_tabel = 'tbl_syarat_sk' AND
	// 		tbl_nomor_surat.fungsi_nomor = 'SK Pembimbing KP' AND

	// 		tbl_ttd_surat.status = 'Tersedia' AND
	// 		tbl_persetujuan_sk.status = 'Tersedia' AND
	// 		tbl_nomor_surat.status = 'Tersedia' AND
	// 		tbl_syarat_sk.status = 'Tersedia' AND
	// 		tbl_syarat_sk.id_syarat_sk = '$id_syarat_sk'
	// 		")->num_rows();
	// 	return $hasil;
	// }

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
			tbl_syarat_sk,
			tb_prodi,
			tbl_persetujuan_sk, 
			tbl_dospem
			WHERE 
			tbl_mahasiswa.npm 				= tbl_syarat_sk.npm AND
			tbl_mahasiswa.kode_prodi 		= tb_prodi.kode_prodi AND
			tbl_jenis_sk.id_jenis_sk 		= tbl_syarat_sk.id_jenis_sk AND
			tbl_persetujuan_sk.tema_persetujuan = 'Pengecekan File Laporan KP untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha' AND
			tbl_persetujuan_sk.id_syarat_sk = tbl_syarat_sk.id_syarat_sk AND
			tbl_dospem.id_syarat_sk 		= tbl_syarat_sk.id_syarat_sk AND
			tb_prodi.status 				!= 'Dihapus' AND
			tbl_syarat_sk.status 			= 'Tersedia' AND
			tbl_jenis_sk.status 			= 'Tersedia' AND
			tbl_mahasiswa.status 			= 'Aktif' AND
			tbl_dospem.status 				= 'Tersedia' AND
			tbl_persetujuan_sk.status 		= 'Tersedia' AND
			tbl_dospem.npk = '$npk' AND
			tbl_dospem.respon = 'Penunjukan Diterima Pembimbing' 
			")->num_rows();
		if ($hasil>=10) {
			return 1;
		} else{
			return 0;
		}
	}

	function hitung_jumlah_dibimbing($npk){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_syarat_sk,
			tb_prodi,
			tbl_persetujuan_sk, 
			tbl_dospem
			WHERE 
			tbl_mahasiswa.npm 				= tbl_syarat_sk.npm AND
			tbl_mahasiswa.kode_prodi 		= tb_prodi.kode_prodi AND
			tbl_jenis_sk.id_jenis_sk 		= tbl_syarat_sk.id_jenis_sk AND
			tbl_persetujuan_sk.tema_persetujuan = 'Pengecekan File Laporan KP untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha' AND
			tbl_persetujuan_sk.id_syarat_sk = tbl_syarat_sk.id_syarat_sk AND
			tbl_dospem.id_syarat_sk 		= tbl_syarat_sk.id_syarat_sk AND
			tb_prodi.status 				!= 'Dihapus' AND
			tbl_syarat_sk.status 			= 'Tersedia' AND
			tbl_jenis_sk.status 			= 'Tersedia' AND
			tbl_mahasiswa.status 			= 'Aktif' AND
			tbl_dospem.status 				= 'Tersedia' AND
			tbl_persetujuan_sk.status 		= 'Tersedia' AND
			tbl_dospem.npk 					= '$npk' AND
			tbl_dospem.respon 				= 'Penunjukan Diterima Pembimbing' 
			")->num_rows();
		return $hasil;
	}

	function hitung_sedang_dibimbing(){
		$npk = $_SESSION['npk'];
		$result = $this->db->query("SELECT count(tbl_dospem.id_syarat_sk) as a FROM tbl_dospem, tbl_syarat_sk WHERE npk = $npk AND tbl_dospem.id_syarat_sk = tbl_syarat_sk.id_syarat_sk AND tbl_dospem.status='Tersedia' AND tbl_syarat_sk.status='Tersedia'");
		return $result->row()->a;
	}

	// function cek_jumlah_dibimbing($npk){
	// 	$hasil=$this->db->query(
	// 		"SELECT * FROM tbl_mahasiswa,
	// 						tbl_jenis_sk,
	// 						tbl_syarat_sk,
	// 						tbl_dospem,
	// 						tbl_nilai,
	// 						tbl_nomor_surat,
	// 						tbl_pembimbing_lapangan,
	// 						tb_prodi,
	// 						tb_dosen 
	// 		WHERE 	tb_dosen.kode_jurusan 				 = tb_prodi.kode_prodi AND 
	// 				tbl_syarat_sk.id_jenis_sk 			 = tbl_jenis_sk.id_jenis_sk AND 
	// 				tbl_syarat_sk.npm 					 = tbl_mahasiswa.npm AND 
	// 				tbl_nomor_surat.fungsi_nomor = 'SK Pembimbing KP' AND
	// 				tbl_nomor_surat.relasi_tabel = 'tbl_syarat_sk' AND
	// 				tbl_nomor_surat.id_relasi = tbl_syarat_sk.id_syarat_sk AND
	// 				tbl_dospem.npk 						 = tb_dosen.npk AND
	// 				tbl_dospem.respon 						 = 'Penunjukan Diterima Pembimbing' AND
	// 				tbl_nilai.id_syarat_sk 				 =tbl_syarat_sk.id_syarat_sk AND
	// 				tbl_nilai.
	// 				tbl_pembimbing_lapangan.id_syarat_sk = tbl_syarat_sk.id_syarat_sk AND
	// 		tb_prodi.status 			= 'Tersedia' AND
	// 		tbl_jenis_sk.status = 'Tersedia' AND
	// 		tbl_syarat_sk.status = 'Tersedia' AND
	// 		tbl_dospem.status = 'Tersedia' AND
	// 		tbl_nilai.status = 'Tersedia' AND
	// 		tbl_nomor_surat.status = 'Tersedia' AND
	// 		tbl_pembimbing_lapangan.status = 'Tersedia' AND
	// 		tb_dosen.status 			= 'Aktif' AND
	// 		tbl_mahasiswa.status 			= 'Aktif' AND
	// 		tbl_mahasiswa.npm			='$npm'
	// 		")->num_rows();
	// 	if ($hasil>=10) {
	// 		return 1;
	// 	} else{
	// 		return 0;
	// 	}
	// }

	// function combobox_dosen($kode_prodi)
	// {
	// 	$query = $this->db->query(
	// 	"SELECT * FROM tb_prodi, tb_dosen, tbl_syarat_sk, tbl_dospem
	// 	WHERE 		tb_dosen.kode_jurusan 		= tb_prodi.kode_prodi AND 
	// 				-- tbl_syarat_sk.npm = tbl_mahasiswa.npm AND
	// 				-- tbl_mahasiswa.kode_prodi 	= tb_prodi.kode_prodi AND
 //                    tbl_dospem.id_syarat_sk 	= tbl_syarat_sk	.id_syarat_sk AND
 //                    tbl_dospem.npk 				= tb_dosen	.npk AND
	// 				tb_prodi.status 			= 'Tersedia' AND
 //                    tbl_syarat_sk.status 		= 'Tersedia' AND
 //                    tbl_dospem.status 			= 'Aktif' AND
	// 				tb_dosen.status 			= 'Aktif' AND
	// 				-- tbl_mahasiswa.status 		= 'Aktif' AND
	// 				tb_dosen.status_dosen 		= 'Dosen Tetap Program Studi' AND
	// 				tb_prodi.kode_prodi			='$kode_prodi' AND
	// 				-- tbl_syarat_sk.id_syarat_sk 			<= '3'
	// 				LOCATE('{$kode_prodi}', tbl_dospem.id_dospem) <=3

	// 		");
	// 	return $query->result_array();
	// }

	function simpan_dospem($npk, $id_syarat_sk){
		$tes = $this->db->query("SELECT * FROM tbl_dospem WHERE id_syarat_sk=$id_syarat_sk")->num_rows();
		if ($tes < 1){
			
			$hasil=$this->db->query("INSERT INTO tbl_dospem (id_syarat_sk,
				npk,
				respon,
				tgl_respon,
				alasan_ditolak,
				status)
				VALUES ($id_syarat_sk,
				'$npk',
				'Penunjukan Diterima Pembimbing',
				'0000-00-00 00:00:00',
				'',
				'Tersedia')");
			return $hasil;
		}
	}

	function cekResponPembimbing($id_syarat_sk, $status_respon){
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
			tbl_dospem.id_syarat_sk 	= '$id_syarat_sk' AND
			tbl_dospem.respon 			= '$status_respon'
			");
		return $hasil->num_rows();
	}

	function akun_pembimbing_lapangan($id_syarat_sk, $email_pembimbing_lapangan, $string_random){
		$hasil = $this->db->query("UPDATE tbl_syarat_sk SET email_pembimbing_lapangan = '$email_pembimbing_lapangan', string_random = '$string_random' WHERE id_syarat_sk ='$id_syarat_sk';");
		return $hasil;
	}

	function hapus_dospem($id_syarat_sk){
		$hasil = $this->db->query("UPDATE tbl_dospem SET status = 'Dihapus' WHERE id_syarat_sk ='$id_syarat_sk' AND respon = 'Menunggu Respon Pembimbing';");
		return $hasil;
	}

	function tombolReset($id_syarat_sk){
		$hasil = $this->db->query("DELETE FROM tbl_dospem WHERE id_syarat_sk ='$id_syarat_sk';");
		return $hasil;
	}
	
	function tombolResetPersetujuan1($id_syarat_sk){
		$hasil = $this->db->query("UPDATE tbl_persetujuan_sk SET status = 'Dihapus' WHERE id_syarat_sk ='$id_syarat_sk' AND tema_persetujuan ='Pengecekan Berkas Bukti Penerimaan Lapangan untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha'");
		return $hasil;
	}

	function tombolResetPersetujuan2($id_syarat_sk){
		$hasil = $this->db->query("UPDATE tbl_persetujuan_sk SET status = 'Dihapus' WHERE id_syarat_sk ='$id_syarat_sk' AND tema_persetujuan = 'Pengecekan Berkas SPP dasar untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha'");
		return $hasil;
	}

	function tombolResetPersetujuan3($id_syarat_sk){
		$hasil = $this->db->query("UPDATE tbl_persetujuan_sk SET status = 'Dihapus' WHERE id_syarat_sk ='$id_syarat_sk' AND tema_persetujuan = 'Pengecekan Berkas Transkip Nilai Sementara untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha' ");
		return $hasil;
	}

	function tombolResetPersetujuan4($id_syarat_sk){
		$hasil = $this->db->query("UPDATE tbl_persetujuan_sk SET status = 'Dihapus' WHERE id_syarat_sk ='$id_syarat_sk' AND tema_persetujuan ='Pengecekan File Laporan KP untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha'");
		return $hasil;
	}

	function konfirmasi($id_syarat_sk){
		$hasil1 = $this->db->query("UPDATE tbl_nilai SET status_verifikasi_prodi = 'Terverifikasi' WHERE id_syarat_sk ='$id_syarat_sk' ;");
		$hasil2 = $this->db->query("UPDATE tbl_pembimbing_lapangan SET status_verifikasi_prodi = 'Terverifikasi' WHERE id_syarat_sk ='$id_syarat_sk' ;");
		return $hasil1+$hasil2;
	}

	function show_histori($id_syarat_sk)
	{
		$hasil=$this->db->query(
			"SELECT tb_dosen.nama_dosen as nama FROM 
			tbl_syarat_sk,
			tbl_dospem,
			tb_dosen
			WHERE 
			
			tbl_dospem.id_syarat_sk			= tbl_syarat_sk.id_syarat_sk AND
			tbl_dospem.npk 					= tb_dosen.npk AND

			tb_dosen.status 				!= 'Dihapus' AND
			tbl_dospem.status 				!= 'Dihapus' AND
			tbl_syarat_sk.status 			= 'Tersedia' AND
			
			tbl_syarat_sk.id_syarat_sk 		= '$id_syarat_sk'
			")->row();
		if ($hasil) {
			return $hasil->nama;
		}else{
			return 'Tidak ada';
		}
	}

	function ttd_prodi($id_syarat_sk){
		date_default_timezone_set('Asia/Jakarta');

		$waktu_sekarang = date('Y-m-d H:i:s');
		$topik_relasi = 'Tandatangan kartu bimbingan Kerja Praktik oleh Prodi';
		$id_random = $this->generate_id_random();
		$nama_penanda_tangan = $_SESSION['nama'];
		$perihal = 'Tandatangan Kartu Bimbingan Kerja Praktik oleh '.$nama_penanda_tangan;
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
			VALUES ($id_syarat_sk,
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

	function cekValidasiProdi($id_syarat_sk){
		return $this->db->query("SELECT * FROM tbl_syarat_sk, tbl_nilai 
			WHERE tbl_syarat_sk.id_syarat_sk='$id_syarat_sk' AND 
			tbl_nilai.id_syarat_sk = tbl_syarat_sk.id_syarat_sk AND
			tbl_nilai.status = 'Tersedia' AND
			tbl_syarat_sk.status = 'Tersedia' AND
			tbl_nilai.status_verifikasi_prodi = 'Terverifikasi'")->num_rows();
	}

	function cekTtdProdi($id_syarat_sk){
		return $this->db->query("SELECT * FROM tbl_syarat_sk, tbl_ttd_dospem 
			WHERE id_syarat_sk='$id_syarat_sk' AND 
			tbl_ttd_dospem.id_relasi = tbl_syarat_sk.id_syarat_sk AND
			tbl_ttd_dospem.status = 'Tersedia' AND
			tbl_syarat_sk.status = 'Tersedia' AND
			tbl_ttd_dospem.topik_relasi = 'Tandatangan kartu bimbingan Kerja Praktik oleh Prodi'")->num_rows();
	}

	function getDataProdi($id_syarat_sk){
		return $this->db->query("SELECT * FROM tbl_syarat_sk, tbl_ttd_dospem 
			WHERE id_syarat_sk='$id_syarat_sk' AND 
			tbl_ttd_dospem.id_relasi = tbl_syarat_sk.id_syarat_sk AND
			tbl_ttd_dospem.status = 'Tersedia' AND
			tbl_bimbingan.status = 'Tersedia' AND
			tbl_ttd_dospem.topik_relasi = 'Tandatangan kartu bimbingan Kerja Praktik oleh Prodi'")->result_array();
	}

	function input_nomor_surat($id_syarat_sk){
		$baris = $this->db->query("SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_syarat_sk,
			tb_prodi,
			tbl_persetujuan_sk, 
			tbl_dospem,
			tb_dosen
			WHERE 
			tbl_mahasiswa.npm 				= tbl_syarat_sk.npm AND
			tbl_mahasiswa.kode_prodi 		= tb_prodi.kode_prodi AND
			tbl_jenis_sk.id_jenis_sk 		= tbl_syarat_sk.id_jenis_sk AND
			tbl_persetujuan_sk.id_syarat_sk = tbl_syarat_sk.id_syarat_sk AND
			tbl_dospem.id_syarat_sk 		= tbl_syarat_sk.id_syarat_sk AND
			tbl_dospem.npk 					= tb_dosen.npk AND
			tb_prodi.status 				!= 'Dihapus' AND
			tbl_syarat_sk.status 			= 'Tersedia' AND
			tbl_jenis_sk.status 			= 'Tersedia' AND
			tbl_mahasiswa.status 			= 'Aktif' AND
			tbl_dospem.status 				= 'Tersedia' AND
			tbl_persetujuan_sk.status 		= 'Tersedia' AND
			tbl_syarat_sk.id_syarat_sk 		= '$id_syarat_sk' AND
			tbl_dospem.respon 				= 'Penunjukan Diterima Pembimbing'")->row();
		if ($baris) {
			$nama_mahasiswa 				= $baris->nama_mahasiswa;
			$npm 							= $baris->npm;
			$nama_tempat_kp 				= $baris->nama_tempat_kp;
			$waktu_mulai_kp 				= $baris->waktu_mulai_kp;
			$waktu_selesai_kp 				= $baris->waktu_selesai_kp;
		} else{
			redirect('fakultas/monitoring_sk');
		}

		date_default_timezone_set('Asia/Jakarta');
		$tahun 			= date('Y');
		$waktu_sekarang = date('Y-m-d H:i:s');
		$row = $this->db->query("SELECT max(nomor_surat) AS nomor_max FROM tbl_nomor_surat WHERE tahun = '$tahun' AND fungsi_nomor='SK Pembimbing KP'")->row();
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
			VALUES ('SK Pembimbing KP', 
			'tbl_syarat_sk', 
			$id_syarat_sk, 
			($angka +1), 
			'$tahun', 
			'Tersedia') ");
		if ($input_nomor) {
			$topik_relasi 			= 'Tandatangan SK Pembimbing KP oleh Dekan';
			$id_random 				= $this->generate_id_random();
			$nama_penanda_tangan 	= $_SESSION['nama'];
			$npk_penanda_tangan 	= $_SESSION['npk'];
			$jabatan_penanda_tangan = $_SESSION['jabatan'];
			$kodemax 				= str_pad(($nomor_surat+1), 4, "0", STR_PAD_LEFT);
			$nomor_surat_full 		= ($kodemax).'/KPTS/FT-UIR/KP/'.$tahun;
			$perihal 				= 'Tandatangan SK KP atas nama '.$nama_mahasiswa.' ('.$npm.') yang diajukan pada tanggal '.$tgl_upload_syarat_sk.' dan berlangsung pada '.$waktu_mulai_kp.' sampai dengan '.$waktu_selesai_kp.'.' ;
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
				VALUES ('$id_syarat_sk', 
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

		function row_data($npm)
		{
			$hasil=$this->db->query(
				"SELECT * FROM tbl_mahasiswa, 
				tbl_jenis_sk, 
				tbl_syarat_sk ,
				tbl_surat_pengantar
				WHERE tbl_mahasiswa.npm 						= tbl_syarat_sk.npm AND
				tbl_jenis_sk.id_jenis_sk 				= tbl_syarat_sk.id_jenis_sk AND
				tbl_surat_pengantar.id_surat_pengantar 	= tbl_syarat_sk.nama_tempat_kp AND
				tbl_mahasiswa.npm 						= '$npm' AND
				tbl_mahasiswa.status 					!= 'Dihapus' AND
				tbl_syarat_sk.status 					= 'Tersedia' AND
				tbl_surat_pengantar.status 				= 'Tersedia' AND
				tbl_jenis_sk.status 					= 'Tersedia' ");
			return $hasil->row();
		}

		function get_row_data_syarat_sk($id_syarat_sk){
			$topik_relasi = 'Tandatangan SK Pembimbing KP oleh Dekan';
			$hasil = $this->db->query(
				"SELECT * FROM tbl_mahasiswa, 
				tbl_ttd_surat, 
				tbl_syarat_sk, 
				tbl_nomor_surat, 
				tb_prodi, 
				tbl_dospem, 
				tb_dosen
				WHERE tbl_syarat_sk.npm 				= tbl_mahasiswa.npm AND
				tbl_syarat_sk.id_syarat_sk 		= tbl_dospem.id_syarat_sk AND
				tbl_dospem.id_syarat_sk 		= tbl_syarat_sk.id_syarat_sk AND
				tb_prodi.kode_prodi 			= tbl_mahasiswa.kode_prodi AND
				tb_dosen.npk 					= tbl_dospem.npk AND
				tbl_ttd_surat.topik_relasi 		= '$topik_relasi' AND
				tbl_syarat_sk.id_syarat_sk 		= tbl_ttd_surat.id_relasi AND
				tbl_nomor_surat.fungsi_nomor	= 'SK Pembimbing KP' AND
				tbl_syarat_sk.id_syarat_sk 		= '$id_syarat_sk' AND
				tbl_syarat_sk.id_syarat_sk 		= tbl_nomor_surat.id_relasi AND
				tbl_syarat_sk.status 			= 'Tersedia' AND
				tbl_ttd_surat.status 			= 'Tersedia' AND
				tbl_nomor_surat.status 			= 'Tersedia' AND
				tb_prodi.status 				= 'Tersedia' AND
				tbl_mahasiswa.status 			!= 'Dihapus' AND
				tbl_dospem.status 				= 'Tersedia' AND
				tb_dosen.status 				!= 'Dihapus' 
				");
			return $hasil->row();
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

		public function setuju_berkas($id_syarat_sk, $pelaku, $jabatan, $tema_persetujuan, $alasan_ditolak, $status_persetujuan){
			$cek = $this->db->query("SELECT * FROM tbl_persetujuan_sk WHERE id_syarat_sk='$id_syarat_sk' AND tema_persetujuan='$tema_persetujuan' AND status='Tersedia'")->num_rows();

			if($cek<1){
				$hasil=$this->db->query(
					"INSERT INTO tbl_persetujuan_sk (id_syarat_sk, 
					pelaku, 
					jabatan, 
					status_persetujuan,
					tema_persetujuan, 
					alasan_ditolak,  
					status) 
					VALUES ($id_syarat_sk, 
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
			$this->cekPersetujuanSemuaBerkas($id_syarat_sk);
		}

		public function show_nilai()
		{
			$hasil=$this->db->query(
				"SELECT * FROM tbl_syarat_sk,
				tbl_nilai
				WHERE tbl_nilai.id_syarat_sk = tbl_syarat_sk.id_syarat_sk AND
				tbl_syarat_sk.status = 'Tersedia' AND
				tbl_nilai.status 	 = 'Tersedia'
				");
			return $hasil;
		}

		public function open_file($id_syarat_sk, $pelaku, $jabatan, $file_open){
			$cek = $this->db->query("SELECT * FROM tbl_open_file WHERE id_syarat_sk='$id_syarat_sk' AND file_open='$file_open' AND status='Tersedia'")->num_rows();

			if($cek<1){
				$hasil=$this->db->query(
					"INSERT INTO tbl_open_file (id_syarat_sk, 
					pelaku, 
					jabatan, 
					file_open, 
					status) 
					VALUES ($id_syarat_sk, 
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

		public function cekPersetujuanSemuaBerkas($id_syarat_sk){
			$tema1 = "Pengecekan Berkas Bukti Penerimaan Lapangan untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha";
			$hasil1 = $this->db->query("SELECT * FROM tbl_persetujuan_sk WHERE id_syarat_sk='$id_syarat_sk' AND tema_persetujuan='$tema1' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();
			$tema2 = "Pengecekan Berkas SPP dasar untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha";
			$hasil2 = $this->db->query("SELECT * FROM tbl_persetujuan_sk WHERE id_syarat_sk='$id_syarat_sk' AND tema_persetujuan='$tema2' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();
			$tema3 = "Pengecekan Berkas Transkip Nilai Sementara untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha";
			$hasil3 = $this->db->query("SELECT * FROM tbl_persetujuan_sk WHERE id_syarat_sk='$id_syarat_sk' AND tema_persetujuan='$tema3' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();
			$tema4 = "Pengecekan File Laporan KP untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha";
			$hasil4 = $this->db->query("SELECT * FROM tbl_persetujuan_sk WHERE id_syarat_sk='$id_syarat_sk' AND tema_persetujuan='$tema4' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();
			$return_arr[] = array(
				'hasil1' => $hasil1,
				'hasil2' => $hasil2,
				'hasil3' => $hasil3,
				'hasil4' => $hasil4);
   				// header('Content-type: application/json');
			echo json_encode($return_arr);
		}

		public function cekPersetujuanSemuaBerkas2($id_syarat_sk){
			$tema1 = "Pengecekan Berkas Bukti Penerimaan Lapangan untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha";
			$hasil1 = $this->db->query("SELECT * FROM tbl_persetujuan_sk WHERE id_syarat_sk='$id_syarat_sk' AND tema_persetujuan='$tema1' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();
			$tema2 = "Pengecekan Berkas SPP dasar untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha";
			$hasil2 = $this->db->query("SELECT * FROM tbl_persetujuan_sk WHERE id_syarat_sk='$id_syarat_sk' AND tema_persetujuan='$tema2' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();
			$tema3 = "Pengecekan Berkas Transkip Nilai Sementara untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha";
			$hasil3 = $this->db->query("SELECT * FROM tbl_persetujuan_sk WHERE id_syarat_sk='$id_syarat_sk' AND tema_persetujuan='$tema3' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();
			$tema4 = "Pengecekan File Laporan KP untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha";
			$hasil4 = $this->db->query("SELECT * FROM tbl_persetujuan_sk WHERE id_syarat_sk='$id_syarat_sk' AND tema_persetujuan='$tema4' AND status_persetujuan='Berkas Disetujui' AND status='Tersedia'")->num_rows();

			if($hasil1>0 && $hasil2>0 && $hasil3>0 && $hasil4>0){
				return 1;
			}else{
				return 0;
			}
		}

		public function cekNilaiDospem($id_syarat_sk){
			$hasil=$this->db->query(
				"SELECT * FROM  
				tbl_mahasiswa,
				tbl_nilai, 
				tbl_syarat_sk
				WHERE 
				tbl_mahasiswa.npm 			= tbl_syarat_sk.npm AND
				tbl_nilai.id_syarat_sk 		= tbl_syarat_sk.id_syarat_sk AND
				tbl_syarat_sk.id_syarat_sk 	= '$id_syarat_sk' AND
				
				tbl_mahasiswa.status 		= 'Aktif' AND
				tbl_syarat_sk.status 		= 'Tersedia' AND
				tbl_nilai.status 			= 'Tersedia' 
				")->num_rows();
			return $hasil;
		}

		public function cekNilaiPembimbingLapangan($id_syarat_sk){
			$hasil=$this->db->query(
				"SELECT * FROM  
				tbl_mahasiswa,
				tbl_pembimbing_lapangan, 
				tbl_syarat_sk
				WHERE 
				tbl_mahasiswa.npm 						= tbl_syarat_sk.npm AND
				tbl_pembimbing_lapangan.id_syarat_sk 	= tbl_syarat_sk.id_syarat_sk AND
				tbl_syarat_sk.id_syarat_sk 				= '$id_syarat_sk' AND
				
				tbl_mahasiswa.status 					= 'Aktif' AND
				tbl_syarat_sk.status 					= 'Tersedia' AND
				tbl_pembimbing_lapangan.status 			= 'Tersedia' 
				")->num_rows();
			return $hasil;
		}
	}
	?>