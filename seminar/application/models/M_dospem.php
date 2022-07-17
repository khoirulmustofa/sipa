<?php 

class M_dospem extends CI_Model
{
	function hitung_yangdibimbing(){
		$npk = $_SESSION['npk'];
		$result = $this->db->query("SELECT count(id_syarat_sk) as a FROM tbl_dospem WHERE npk = $npk AND respon= 'Penunjukan Diterima Pembimbing' AND status='Tersedia'");
		return $result->row()->a;
	}

	function hitung_penunjukan(){
		$npk = $_SESSION['npk'];
		$result = $this->db->query("SELECT count(id_syarat_sk) as a FROM tbl_dospem WHERE npk = $npk AND respon= 'Menunggu Respon Pembimbing' AND status='Tersedia'");
		return $result->row()->a;
	}
	function hitung_penolakan(){
		$npk = $_SESSION['npk'];
		$result = $this->db->query("SELECT count(id_syarat_sk) as a FROM tbl_dospem WHERE npk = $npk AND respon= 'Penunjukan Ditolak Pembimbing' AND status='Tersedia'");
		return $result->row()->a;
	}

	function show_sk_mahasiswa($npk)
	{
		$hasil=$this->db->query("SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_syarat_sk,
			tb_prodi,
			tbl_persetujuan_sk, 
			tbl_dospem,
			tbl_surat_pengantar
			WHERE 
			tbl_mahasiswa.npm 				= tbl_syarat_sk.npm AND
			tbl_mahasiswa.kode_prodi 		= tb_prodi.kode_prodi AND
			tbl_jenis_sk.id_jenis_sk 		= tbl_syarat_sk.id_jenis_sk AND
			tbl_persetujuan_sk.id_syarat_sk = tbl_syarat_sk.id_syarat_sk AND
			tbl_dospem.id_syarat_sk 		= tbl_syarat_sk.id_syarat_sk AND
			tbl_surat_pengantar.id_surat_pengantar = tbl_syarat_sk.nama_tempat_kp AND


			tb_prodi.status 				!= 'Dihapus' AND
			tbl_syarat_sk.status 			= 'Tersedia' AND
			tbl_jenis_sk.status 			= 'Tersedia' AND
			tbl_surat_pengantar.status 		= 'Tersedia' AND
			tbl_mahasiswa.status 			= 'Aktif' AND
			tbl_dospem.status 				= 'Tersedia' AND
			tbl_persetujuan_sk.status 		= 'Tersedia' AND
			tbl_persetujuan_sk.tema_persetujuan = 'Pengecekan Berkas Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha' AND
			tbl_dospem.npk 					= '$npk'
			ORDER BY tbl_dospem.id_dospem DESC;
			");
		return $hasil;
	}
			// 	tbl_dospem.npk 					= tb_dosen.npk AND
			// tb_dosen.kode_jurusan = tb_prodi.kode_prodi AND

			// tb_dosen.status 				!= 'Dihapus' AND

	function cekResponPembimbing($id_dospem, $status_respon){
		$hasil=$this->db->query("
			SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_syarat_sk, 
			tbl_dospem
			WHERE 
			tbl_mahasiswa.npm = tbl_syarat_sk.npm AND
			tbl_jenis_sk.id_jenis_sk = tbl_syarat_sk.id_jenis_sk AND
			tbl_dospem.id_syarat_sk = tbl_syarat_sk.id_syarat_sk AND
			
			tbl_mahasiswa.status 	!= 'Dihapus' AND
			tbl_syarat_sk.status 	= 'Tersedia' AND
			tbl_jenis_sk.status 	= 'Tersedia' AND
			tbl_dospem.status 		= 'Tersedia' AND
			tbl_dospem.id_dospem 	= '$id_dospem' AND
			tbl_dospem.respon 		= '$status_respon'
		");
		return $hasil->num_rows();
	}

	function persetujuan_tolak($id_dospem, $alasan_ditolak){
		date_default_timezone_set('Asia/Jakarta');
		$tgl_sekarang 	= date('Y-m-d H:i:s');
		$hasil = $this->db->query("UPDATE tbl_dospem SET respon = 'Penunjukan Ditolak Pembimbing', 
														tgl_respon = '$tgl_sekarang',
														alasan_ditolak = '$alasan_ditolak'
													WHERE id_dospem = '$id_dospem'");
		return $hasil;
	}

	function persetujuan_terima($id_dospem, $alasan_ditolak){
		date_default_timezone_set('Asia/Jakarta');
		$tgl_sekarang 	= date('Y-m-d H:i:s');
		$hasil = $this->db->query("UPDATE tbl_dospem SET respon = 'Penunjukan Diterima Pembimbing', 
														tgl_respon = '$tgl_sekarang',
														alasan_ditolak = '$alasan_ditolak'
													WHERE id_dospem = '$id_dospem'");
		return $hasil;
	}

	function cekResponDospem($id_dospem, $status){
		$hasil=$this->db->query("
			SELECT * FROM 
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

			tbl_persetujuan_sk.id_syarat_sk = tbl_syarat_sk.id_syarat_sk AND
			tbl_dospem.id_syarat_sk 		= tbl_syarat_sk.id_syarat_sk AND

			tb_prodi.status 				!= 'Dihapus' AND
			tbl_syarat_sk.status 			= 'Tersedia' AND
			tbl_jenis_sk.status 			= 'Tersedia' AND
			tbl_mahasiswa.status 			= 'Aktif' AND
			tbl_dospem.status 				= 'Tersedia' AND
			tbl_persetujuan_sk.status 		= 'Tersedia' AND
			tbl_dospem.id_dospem = '$id_dospem' AND
			tbl_dospem.status = '$status'
			")->num_rows();
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
}