<?php 

class M_sk extends CI_Model
{
	function combobox_nama_tempat_kp($npm)
	{
		return $this->db->query(
			"SELECT * FROM tbl_surat_pengantar, tbl_persetujuan_surat_pengantar, tbl_mahasiswa, tbl_ttd_surat 
			WHERE tbl_mahasiswa.npm = tbl_surat_pengantar.npm AND
			tbl_persetujuan_surat_pengantar.id_surat_pengantar = tbl_surat_pengantar.id_surat_pengantar AND 
			tbl_mahasiswa.status 					!='Dihapus' AND
			tbl_persetujuan_surat_pengantar.status 	= 'Tersedia' AND
			tbl_ttd_surat.status 					= 'Tersedia' AND
			tbl_ttd_surat.topik_relasi 				= 'Tandatangan Surat Pengantar Instansi KP oleh Dekan' AND
			tbl_ttd_surat.id_relasi 				= tbl_surat_pengantar.id_surat_pengantar AND
			tbl_mahasiswa.npm 						= '$npm' AND
			tbl_surat_pengantar.status 				= 'Tersedia'")->result_array();
	}

	function combobox_jenis_sk()
	{
		return $this->db->query("SELECT * FROM tbl_jenis_sk WHERE status='Tersedia'")->result_array();
	}

	function tambah_data($id_jenis_sk, $npm, $nama_tempat_kp, $judul_kerja_praktik, $nama_pembimbing_lapangan, $no_hp_pembimbing_lapangan, $email_pembimbing_lapangan, $string_random, $waktu_mulai_kp, $waktu_selesai_kp, $nama_file_full, $nama_file_full_spp, $nama_file_full_transkrip, $nama_file_full_laporan){
		$tes = $this->db->query("SELECT * from tbl_syarat_sk where npm=$npm")->num_rows();
		if ($tes < 1){

		$hasil=$this->db->query("INSERT INTO tbl_syarat_sk (id_jenis_sk, 
			npm, 
			nama_tempat_kp, 
			judul_kerja_praktik, 
			nama_pembimbing_lapangan,
			no_hp_pembimbing_lapangan, 
			email_pembimbing_lapangan,
			string_random,
			waktu_mulai_kp, 
			waktu_selesai_kp, 
			nama_file_syarat_sk, 
			file_spp_dasar, 
			file_transkrip, 
			file_laporan, 
			status) 
			VALUES ($id_jenis_sk, 
			'$npm', 
			'$nama_tempat_kp', 
			'$judul_kerja_praktik', 
			'$nama_pembimbing_lapangan', 
			'$no_hp_pembimbing_lapangan', 
			'$email_pembimbing_lapangan',
			'$string_random',
			'$waktu_mulai_kp', 
			'$waktu_selesai_kp', 
			'$nama_file_full', 
			'$nama_file_full_spp', 
			'$nama_file_full_transkrip', 
			'$nama_file_full_laporan', 
			'Tersedia')");
		return $hasil;
		}
	}

	function row_data($npm)
	{
		$hasil=$this->db->query(
			"SELECT * FROM tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_syarat_sk ,
			tbl_surat_pengantar
			WHERE tbl_mahasiswa.npm 				= tbl_syarat_sk.npm AND
			tbl_jenis_sk.id_jenis_sk 				= tbl_syarat_sk.id_jenis_sk AND
			tbl_surat_pengantar.id_surat_pengantar 	= tbl_syarat_sk.nama_tempat_kp AND
			tbl_mahasiswa.npm 						= '$npm' AND
			tbl_mahasiswa.status 					!= 'Dihapus' AND
			tbl_syarat_sk.status 					= 'Tersedia' AND
			tbl_surat_pengantar.status 				= 'Tersedia' AND
			tbl_jenis_sk.status 					= 'Tersedia' ");
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
			");
		return $hasil;
	}

	// CEK RESPON FAKULTAS TERHADAP SK
	function cekResponSKPembimbingKP($id_syarat_sk){
		$hasil=$this->db->query(
			"SELECT * FROM  
			tbl_syarat_sk,
			tbl_jenis_sk,
			tbl_persetujuan_sk, 
			tbl_ttd_surat, 
			tbl_nomor_surat
			WHERE 
			tbl_persetujuan_sk.id_persetujuan_sk 	= tbl_persetujuan_sk.id_persetujuan_sk AND
			tbl_persetujuan_sk.id_syarat_sk 		= tbl_syarat_sk.id_syarat_sk AND
			tbl_syarat_sk.id_jenis_sk 				= tbl_jenis_sk.id_jenis_sk AND
			tbl_ttd_surat.id_relasi 				= tbl_syarat_sk.id_syarat_sk AND
			tbl_nomor_surat.id_relasi 				= tbl_syarat_sk.id_syarat_sk AND
			tbl_nomor_surat.relasi_tabel 			= 'tbl_syarat_sk' AND
			tbl_nomor_surat.fungsi_nomor 			= 'SK Pembimbing KP' AND
			tbl_ttd_surat.topik_relasi 				= 'Tandatangan SK Pembimbing KP oleh Dekan' AND

			tbl_jenis_sk.status 					= 'Tersedia' AND
			tbl_ttd_surat.status 					= 'Tersedia' AND
			tbl_persetujuan_sk.status 				= 'Tersedia' AND
			tbl_nomor_surat.status 					= 'Tersedia' AND
			tbl_syarat_sk.id_syarat_sk 				= '$id_syarat_sk'
			")->num_rows();
		return $hasil;
	}

	// CEK RESPON FAKULTAS TERHADAP SURAT PENGANTAR
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
			tbl_ttd_surat.id_relasi 				= tbl_surat_pengantar.id_surat_pengantar AND
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

	function show_sk($npm)
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
			tbl_surat_pengantar.id_surat_pengantar = tbl_syarat_sk.nama_tempat_kp AND
			tbl_persetujuan_sk.id_syarat_sk = tbl_syarat_sk.id_syarat_sk AND

			tb_prodi.status 			!= 'Dihapus' AND
			tbl_syarat_sk.status 		= 'Tersedia' AND
			tbl_surat_pengantar.status 	= 'Tersedia' AND
			tbl_jenis_sk.status 		= 'Tersedia' AND
			tbl_mahasiswa.status 		!= 'Dihapus' 

			ORDER BY tbl_syarat_sk.tgl_upload_syarat_sk DESC
			");
		return $hasil;
	}

	function edit_data_nofile($id_syarat_sk, 
		$npm, 
		$nama_tempat_kp, 
		$judul_kerja_praktik, 
		$nama_pembimbing_lapangan, 
		$no_hp_pembimbing_lapangan, 
		$email_pembimbing_lapangan, 
		$waktu_mulai_kp, 
		$waktu_selesai_kp){
		date_default_timezone_set('Asia/Jakarta');
		$tgl_sekarang = date('Y-m-d H:i:s');
		$hasil = $this->db->query("UPDATE tbl_syarat_sk 
			SET nama_tempat_kp 			= '$nama_tempat_kp', 
			judul_kerja_praktik 		= '$judul_kerja_praktik', 
			nama_pembimbing_lapangan 	= '$nama_pembimbing_lapangan', 
			no_hp_pembimbing_lapangan 	= '$no_hp_pembimbing_lapangan' , 
			email_pembimbing_lapangan 	= '$email_pembimbing_lapangan' , 
			waktu_mulai_kp 				= '$waktu_mulai_kp' , 
			waktu_selesai_kp 			= '$waktu_selesai_kp',
			tgl_upload_syarat_sk		= '$tgl_sekarang'
			WHERE id_syarat_sk 			= '$id_syarat_sk'");
		return $hasil;
	}

	function upload_file($id_syarat_sk, $nama_field, $nama_file_full, $tema_persetujuan){
		date_default_timezone_set('Asia/Jakarta');
		$tgl_sekarang = date('Y-m-d H:i:s');
		$hasil = $this->db->query("UPDATE tbl_syarat_sk 
			SET $nama_field 	='$nama_file_full',
			tgl_upload_syarat_sk = '$tgl_sekarang'
			WHERE id_syarat_sk 	='$id_syarat_sk'");
		if($hasil){
			$this->db->query("UPDATE tbl_persetujuan_sk 
				SET status ='Dihapus' WHERE id_syarat_sk ='$id_syarat_sk' AND tema_persetujuan = '$tema_persetujuan' ");
		}
		return $hasil;
	}

	function edit_data($id_syarat_sk, 
		$npm, 
		$nama_tempat_kp, 
		$judul_kerja_praktik, 
		$nama_pembimbing_lapangan, 
		$no_hp_pembimbing_lapangan, 
		$email_pembimbing_lapangan, 
		$waktu_mulai_kp, 
		$waktu_selesai_kp, 
		$nama_file_syarat_sk_baru){
		date_default_timezone_set('Asia/Jakarta');
		$tgl_sekarang = date('Y-m-d H:i:s');
		$hasil = $this->db->query("UPDATE tbl_syarat_sk 
			SET nama_tempat_kp 			= '$nama_tempat_kp', 
			judul_kerja_praktik 		= '$judul_kerja_praktik', 
			nama_pembimbing_lapangan 	= '$nama_pembimbing_lapangan', 
			no_hp_pembimbing_lapangan 	= '$no_hp_pembimbing_lapangan' , 
			email_pembimbing_lapangan 	= '$email_pembimbing_lapangan' , 
			waktu_mulai_kp 				= '$waktu_mulai_kp' , 
			waktu_selesai_kp 			= '$waktu_selesai_kp' , 
			nama_file_syarat_sk 		= '$nama_file_syarat_sk_baru',
			tgl_upload_syarat_sk		= '$tgl_sekarang' 
			WHERE id_syarat_sk 			= '$id_syarat_sk'");
		return $hasil;
	}
	
	function hapus_respon_tu($id_syarat_sk){
		$hasil = $this->db->query("UPDATE tbl_persetujuan_sk 
			SET status = 'Dihapus'
			WHERE id_syarat_sk ='$id_syarat_sk'");
		return $hasil;
	}

	function hapus_data($id_syarat_sk){
		$hasil = $this->db->query("UPDATE tbl_syarat_sk SET status = 'Dihapus' WHERE id_syarat_sk ='$id_syarat_sk';");
		return $hasil;
	}

	function cekStatusPersetujuanTU($npm, $status_persetujuan, $tema_persetujuan){
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
			tbl_persetujuan_sk.status_persetujuan 	= '$status_persetujuan' AND
			tbl_persetujuan_sk.tema_persetujuan 	= '$tema_persetujuan'
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

	function alasan_ditolak_semua($npm, $id_syarat_sk)
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

	function alasan_ditolak_berkas($npm, $id_syarat_sk, $tema)
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

	function get_row_data_syarat_sk($id_syarat_sk){
		$topik_relasi = 'Tandatangan SK Pembimbing KP oleh Dekan';
		$hasil = $this->db->query("SELECT * FROM tbl_mahasiswa, 
			tbl_ttd_surat, 
			tbl_syarat_sk, 
			tbl_nomor_surat, 
			tb_prodi, 
			tbl_dospem, 
			tb_dosen
			WHERE tbl_syarat_sk.npm 		= tbl_mahasiswa.npm AND
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
}
?>