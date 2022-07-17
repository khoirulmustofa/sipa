<?php 

class M_skripsi extends CI_Model
{
	public function tambah_data_skripsi($id_jenis_sk, $npm, $judul, $nama_file_full_spp, $nama_file_full_transkrip, $nama_file_full_krs, $nama_file_full_laporan){
		$tes = $this->db->query("SELECT * from tbl_skripsi where npm=$npm")->num_rows();
		if ($tes < 1){
		$hasil=$this->db->query(
			"INSERT INTO tbl_skripsi (
			id_jenis_sk, 
			npm, 
			judul, 
			file_spp,
			file_transkrip,
			file_krs,
			file_laporan,
			status) 
			VALUES ( 
			'$id_jenis_sk', 
			'$npm', 
			'$judul', 
			'$nama_file_full_spp',
			'$nama_file_full_transkrip',
			'$nama_file_full_krs',
			'$nama_file_full_laporan',
			'Tersedia')");
			return $hasil;
		}
	}

	function cek_penunjukan_dosen($npk){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_syarat_sk,
			tb_prodi,
			tbl_dospem
			WHERE 
			tbl_mahasiswa.npm 				= tbl_syarat_sk.npm AND
			tbl_mahasiswa.kode_prodi 		= tb_prodi.kode_prodi AND
			tbl_jenis_sk.id_jenis_sk 		= tbl_skripsi.id_jenis_sk AND
			tb_prodi.status 				!= 'Dihapus' AND
			tbl_syarat_sk.status 			= 'Tersedia' AND
			tbl_jenis_sk.status 			= 'Tersedia' AND
			tbl_mahasiswa.status 			= 'Aktif' AND
			tbl_dospem.status 				= 'Tersedia' AND
			tbl_dospem.npk = '$npk'")->num_rows();
		if ($hasil>=10) {
			return 1;
		} else{
			return 0;
		}
	}

	// MENAMPILKAN DATA SKRIPSI MAHASISWA
	function data_skripsi($kode_prodi){
		$npm = $_SESSION['npm'];
		return $this->db->query("SELECT * FROM tbl_skripsi, tbl_mahasiswa
			where tbl_skripsi.npm 		= tbl_mahasiswa.npm AND
			tbl_skripsi.status 			='Tersedia' AND
			tbl_mahasiswa.kode_prodi	= '$kode_prodi' AND
			tbl_mahasiswa.npm 			= '$npm' AND
			tbl_mahasiswa.status 		!='Dihapus' 
			ORDER BY tbl_skripsi.tgl_upload DESC
			")->result_array();
	}

	// CEK DATA SKRIPSI
	function cekSkripsi($npm){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_skripsi
			WHERE 
			tbl_mahasiswa.npm 			= tbl_skripsi.npm AND
			tbl_jenis_sk.id_jenis_sk 	= tbl_skripsi.id_jenis_sk AND
			tbl_mahasiswa.npm 			= '$npm' AND
			tbl_mahasiswa.status 		!= 'Dihapus' AND
			tbl_skripsi.status 			= 'Tersedia' AND
			tbl_jenis_sk.status 		= 'Tersedia'
			");
		return $hasil;
	}

	function cekSkripsi123($npm){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_skripsi,
			tbl_usulan_pembimbing
			WHERE 
			tbl_mahasiswa.npm 			= tbl_skripsi.npm AND
			tbl_jenis_sk.id_jenis_sk 	= tbl_skripsi.id_jenis_sk AND
			tbl_mahasiswa.npm 			= '$npm' AND
			tbl_mahasiswa.status 		!= 'Dihapus' AND
			tbl_skripsi.status 			= 'Tersedia' AND
			tbl_jenis_sk.status 		= 'Tersedia'
			");
		return $hasil;
	}

	function cekStatusPersetujuanTU($npm, $status_persetujuan, $tema_persetujuan){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_skripsi, 
			tbl_persetujuan_skripsi
			WHERE 
			tbl_mahasiswa.npm 							= tbl_skripsi.npm AND
			tbl_jenis_sk.id_jenis_sk 					= tbl_skripsi.id_jenis_sk AND
			tbl_persetujuan_skripsi.id_skripsi 			= tbl_skripsi.id_skripsi AND
			tbl_mahasiswa.npm 							= '$npm' AND
			tbl_mahasiswa.status 						!= 'Dihapus' AND
			tbl_skripsi.status 							= 'Tersedia' AND
			tbl_jenis_sk.status 						= 'Tersedia' AND
			tbl_persetujuan_skripsi.status 				= 'Tersedia' AND
			tbl_persetujuan_skripsi.status_persetujuan 	= '$status_persetujuan' AND
			tbl_persetujuan_skripsi.tema_persetujuan 	= '$tema_persetujuan'
			")->num_rows();
		return $hasil;
	}

	function row_data($npm)
	{
		$hasil=$this->db->query("SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_skripsi
			WHERE 
			tbl_mahasiswa.npm 			= tbl_skripsi.npm AND
			tbl_jenis_sk.id_jenis_sk 	= tbl_skripsi.id_jenis_sk AND
			tbl_mahasiswa.npm 			= '$npm' AND
			tbl_mahasiswa.status 		!= 'Dihapus' AND
			tbl_skripsi.status 			= 'Tersedia' AND
			tbl_jenis_sk.status 		= 'Tersedia' ");
		return $hasil->row();
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

	function cekNilaiKP($npm){
		$query = $this->db->query(
			"SELECT * FROM tbl_mahasiswa,
			tbl_jenis_sk,
			tbl_syarat_sk,
			tbl_dospem,
			tbl_nilai,
			tbl_nomor_surat,
			tbl_pembimbing_lapangan,
			tb_prodi,
			tb_dosen 
			WHERE 	tb_dosen.kode_jurusan 		 = tb_prodi.kode_prodi AND 
			tbl_syarat_sk.id_jenis_sk 			 = tbl_jenis_sk.id_jenis_sk AND 
			tbl_syarat_sk.npm 					 = tbl_mahasiswa.npm AND 
			tbl_nomor_surat.fungsi_nomor 		 = 'SK Pembimbing KP' AND
			tbl_nomor_surat.relasi_tabel 		 = 'tbl_syarat_sk' AND
			tbl_nomor_surat.id_relasi 			 = tbl_syarat_sk.id_syarat_sk AND
			tbl_dospem.npk 						 = tb_dosen.npk AND
			tbl_dospem.respon 					 = 'Penunjukan Diterima Pembimbing' AND
			tbl_nilai.id_syarat_sk 				 = tbl_syarat_sk.id_syarat_sk AND
			tbl_pembimbing_lapangan.id_syarat_sk = tbl_syarat_sk.id_syarat_sk AND
			tb_prodi.status 					 = 'Tersedia' AND
			tbl_jenis_sk.status 				 = 'Tersedia' AND
			tbl_syarat_sk.status 				 = 'Tersedia' AND
			tbl_dospem.status 					 = 'Tersedia' AND
			tbl_nilai.status 					 = 'Tersedia' AND
			tbl_nomor_surat.status 				 = 'Tersedia' AND
			tbl_pembimbing_lapangan.status 		 = 'Tersedia' AND
			tb_dosen.status 					 = 'Aktif' AND
			tbl_mahasiswa.status 				 = 'Aktif' AND
			tbl_mahasiswa.npm					 = '$npm'");
		return $query->num_rows();
	}

	function upload_file($id_skripsi, $nama_field, $nama_file_full, $tema_persetujuan){
		date_default_timezone_set('Asia/Jakarta');
		$tgl_sekarang = date('Y-m-d H:i:s');
		$hasil = $this->db->query(" UPDATE tbl_skripsi 
			SET $nama_field 	='$nama_file_full'
			WHERE id_skripsi 	='$id_skripsi'");
		if($hasil){
			$this->db->query("UPDATE tbl_persetujuan_skripsi 
				SET status ='Dihapus' WHERE id_skripsi ='$id_skripsi' AND tema_persetujuan = '$tema_persetujuan' ");
		}
		return $hasil;
	}

	function show_histori($id_skripsi)
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
			tbl_mahasiswa.npm 				 = tbl_skripsi.npm AND
			tbl_jenis_sk.id_jenis_sk 		 = tbl_skripsi.id_jenis_sk AND
			tb_prodi.kode_prodi 			 = tbl_mahasiswa.kode_prodi AND
			tbl_usulan_pembimbing.id_skripsi = tbl_skripsi.id_skripsi AND

			tb_prodi.status 				 != 'Dihapus' AND
			tb_dosen.status 				 != 'Dihapus' AND
			tbl_skripsi.status 				 = 'Tersedia' AND
			tbl_jenis_sk.status 			 = 'Tersedia' AND
			tbl_mahasiswa.status 			 != 'Dihapus' AND
			tbl_usulan_pembimbing.status 	 = 'Tersedia' AND
			tbl_skripsi.id_skripsi 			 = '$id_skripsi'
			");
		return $hasil->result_array();
	}

	function usulan_dospem($id_skripsi, $npk){
		$hasil=$this->db->query(
			"INSERT INTO tbl_usulan_pembimbing (id_skripsi, 
			npk,
			status_persetujuan,
			alasan_ditolak,  
			status) 
			VALUES ($id_skripsi,  
			'$npk', 
			'$status_persetujuan', 
			'', 
			'Tersedia')");
		return $hasil;
	}

// function usulan_dospem($id_skripsi, $npk, $status_persetujuan, $alasan_ditolak){
// 		$hasil=$this->db->query(
// 			"INSERT INTO tbl_usulan_pembimbing (id_skripsi, 
// 			npk,
// 			status_persetujuan,
// 			alasan_ditolak,  
// 			status) 
// 			VALUES ($id_skripsi,  
// 			'$npk', 
// 			'$status_persetujuan', 
// 			'$alasan_ditolak', 
// 			'Tersedia')");
// 		return $hasil;
// 	}

	// 	function simpan_dospem($npk, $id_skripsi){
	// 	$query = $this->db->query("	UPDATE tbl_usulan_pembimbing SET npk = '$npk' WHERE id_skripsi ='$id_skripsi' ;" );
	// 	return $query;
	// }

	// function simpan_dospem($npk, $id_skripsi){
	// 	$query = $this->db->query("INSERT INTO tbl_usulan_pembimbing (
	// 		npk,
	// 		id_skripsi,
	// 		waktu_persetujuan,
	// 		status_persetujuan,
	// 		alasan_ditolak,
	// 		status)
	// 		VALUES (
	// 		'$npk',
	// 		$id_skripsi,
	// 		'0000-00-00 00:00:00',
	// 		'Usulan disetujui Prodi',
	// 		'',
	// 		'Tersedia')
	// 		");
	// 	return $query;
	// }

	function cek_jumlah_dibimbing($npk){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_skripsi,
			tb_prodi,
			tbl_usulan_pembimbing,
			tbl_persetujuan_skripsi, 
			WHERE 
			tbl_mahasiswa.npm 					= tbl_skripsi.npm AND
			tbl_mahasiswa.kode_prodi 			= tb_prodi.kode_prodi AND
			tbl_jenis_sk.id_jenis_sk 			= tbl_skripsi.id_jenis_sk AND
			tbl_usulan_pembimbing.id_skripsi 	= tbl_skripsi.id_skripsi AND
			tbl_persetujuan_skripsi.id_skripsi 	= tbl_skripsi.id_skripsi AND
			tbl_persetujuan_skripsi.tema_persetujuan = 'Pengecekan Berkas Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha' AND
			tbl_usulan_pembimbing.npk 			= '$npk' AND
			tbl_usulan_pembimbing.status_persetujuan = 'Usulan disetujui Prodi' AND

			tb_prodi.status 					!= 'Dihapus' AND
			tbl_skripsi.status 					= 'Tersedia' AND
			tbl_jenis_sk.status 				= 'Tersedia' AND
			tbl_persetujuan_skripsi.status 		= 'Tersedia' AND
			tbl_mahasiswa.status 				= 'Aktif' AND
			tbl_usulan_pembimbing.status 		= 'Tersedia'
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
			tbl_skripsi,
			tb_prodi,
			tbl_usulan_pembimbing,
			tbl_persetujuan_skripsi
			WHERE 
			tbl_mahasiswa.npm 					= tbl_skripsi.npm AND
			tbl_mahasiswa.kode_prodi 			= tb_prodi.kode_prodi AND
			tbl_jenis_sk.id_jenis_sk 			= tbl_skripsi.id_jenis_sk AND
			tbl_usulan_pembimbing.id_skripsi 	= tbl_skripsi.id_skripsi AND
			tbl_persetujuan_skripsi.id_skripsi 	= tbl_skripsi.id_skripsi AND
			tbl_persetujuan_skripsi.tema_persetujuan = 'Pengecekan Berkas Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha' AND

			tbl_usulan_pembimbing.npk 			= '$npk' AND
			tbl_usulan_pembimbing.status_persetujuan = 'Usulan disetujui Prodi' AND
			tb_prodi.status 					!= 'Dihapus' AND
			tbl_skripsi.status 					= 'Tersedia' AND
			tbl_jenis_sk.status 				= 'Tersedia' AND
			tbl_persetujuan_skripsi.status 		= 'Tersedia' AND
			tbl_mahasiswa.status 				= 'Aktif' AND
			tbl_usulan_pembimbing.status 		= 'Tersedia' 
			")->num_rows();
		return $hasil;
	}

	function cekResponUsulan($id_skripsi){
		$hasil=$this->db->query(
			"SELECT * FROM  
			tbl_usulan_pembimbing
			WHERE 
			tbl_usulan_pembimbing.status = 'Tersedia' AND
			id_skripsi 				= '$id_skripsi'
			")->num_rows();
		return $hasil;
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
			tbl_nomor_surat
			WHERE 
			tbl_mahasiswa.npm 					= tbl_skripsi.npm AND
			tbl_mahasiswa.kode_prodi 			= tb_prodi.kode_prodi AND
			tbl_jenis_sk.id_jenis_sk 			= tbl_skripsi.id_jenis_sk AND
			tbl_persetujuan_skripsi.id_skripsi 	= tbl_skripsi.id_skripsi AND
			tbl_dospem_skripsi.id_skripsi 		= tbl_skripsi.id_skripsi AND
			tbl_usulan_pembimbing.id_skripsi 	= tbl_skripsi.id_skripsi AND
			tbl_persetujuan_usulan_pembimbing.id_usulan_pembimbing = tbl_usulan_pembimbing.id_usulan_pembimbing AND
			tbl_ttd_surat.topik_relasi 		= '$topik_relasi' AND
			tbl_nomor_surat.fungsi_nomor	= 'SK Pembimbing Skripsi' AND
			tbl_skripsi.id_skripsi 			= '$id_skripsi' AND
			tbl_skripsi.id_skripsi 			= tbl_nomor_surat.id_relasi AND
			tbl_skripsi.id_skripsi 			= tbl_ttd_surat.id_relasi AND

			tb_prodi.status 				!= 'Dihapus' AND
			tbl_skripsi.status 				= 'Tersedia' AND
			tbl_jenis_sk.status 			= 'Tersedia' AND
			tbl_mahasiswa.status 			= 'Aktif' AND
			tbl_persetujuan_skripsi.status 	= 'Tersedia' AND
			tbl_dospem_skripsi.status 		= 'Tersedia' AND
			tbl_usulan_pembimbing.status 	= 'Tersedia' AND
			tbl_ttd_surat.status 			= 'Tersedia' AND
			tbl_nomor_surat.status 			= 'Tersedia' AND
			tbl_persetujuan_usulan_pembimbing.status = 'Tersedia' AND
			tbl_usulan_pembimbing.status_persetujuan = 'Usulan Disetujui' AND
			tbl_persetujuan_usulan_pembimbing.status_persetujuan = 'Usulan Disetujui' AND
			tbl_dospem_skripsi.respon = 'Usulan Disetujui' AND
			tbl_persetujuan_skripsi.tema_persetujuan = 'Pengecekan Berkas Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha' 
			");
		return $hasil->row();
	}

	// function alasan_ditolak($npm, $id_skripsi)
	// {
	// 	$hasil=$this->db->query(
	// 		"SELECT * FROM 
	// 		tbl_mahasiswa, 
	// 		tbl_jenis_sk, 
	// 		tbl_skripsi, 
	// 		tbl_persetujuan_skripsi
	// 		WHERE 
	// 		tbl_mahasiswa.npm 					= tbl_skripsi.npm AND
	// 		tbl_jenis_sk.id_jenis_sk 			= tbl_skripsi.id_jenis_sk AND
	// 		tbl_persetujuan_skripsi.id_skripsi 	= tbl_skripsi.id_skripsi AND
	// 		tbl_mahasiswa.npm 					= '$npm' AND
	// 		tbl_mahasiswa.status 				!= 'Dihapus' AND
	// 		tbl_skripsi.status 					= 'Tersedia' AND
	// 		tbl_jenis_sk.status 				= 'Tersedia' AND
	// 		tbl_persetujuan_skripsi.status 		= 'Tersedia'
	// 		");
	// 	return $hasil->result_array();
	// }

	function alasan_ditolak_usulan($id_skripsi)
	{
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_skripsi, 
			tbl_persetujuan_skripsi,
			tbl_usulan_pembimbing
			WHERE 
			tbl_mahasiswa.npm 					= tbl_skripsi.npm AND
			tbl_jenis_sk.id_jenis_sk 			= tbl_skripsi.id_jenis_sk AND
			tbl_persetujuan_skripsi.id_skripsi 	= tbl_skripsi.id_skripsi AND
			tbl_usulan_pembimbing.id_skripsi 	= tbl_skripsi.id_skripsi AND
			tbl_persetujuan_skripsi.tema_persetujuan = 'Pengecekan Berkas Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha' AND
			tbl_skripsi.id_skripsi 				= '$id_skripsi' AND
			tbl_mahasiswa.status 				!= 'Dihapus' AND
			tbl_skripsi.status 					= 'Tersedia' AND
			tbl_usulan_pembimbing.status 		= 'Tersedia' AND
			tbl_jenis_sk.status 				= 'Tersedia' AND
			tbl_persetujuan_skripsi.status 		= 'Tersedia'
			");
		return $hasil->result_array();
	}

	function alasan_ditolak($id_skripsi, $tema_persetujuan)
	{
		$baris=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_skripsi, 
			tbl_persetujuan_skripsi
			WHERE 
			tbl_mahasiswa.npm 				= tbl_skripsi.npm AND
			tbl_jenis_sk.id_jenis_sk 		= tbl_skripsi.id_jenis_sk AND
			tbl_persetujuan_skripsi.id_skripsi = tbl_skripsi.id_skripsi AND
			tbl_persetujuan_skripsi.id_skripsi = '$id_skripsi' AND
			tbl_persetujuan_skripsi.tema_persetujuan = '$tema_persetujuan' AND
			tbl_mahasiswa.status 			!= 'Dihapus' AND
			tbl_skripsi.status 			= 'Tersedia' AND
			tbl_jenis_sk.status 			= 'Tersedia' AND
			tbl_persetujuan_skripsi.status 		= 'Tersedia'
			")->row();
		if ($baris) {
			return $baris->alasan_ditolak;
		}else{
			return '';
		}
	}
}
?>