<?php 

class M_bimbingan extends CI_Model
{
	function getDataBimbingan($id_syarat_sk){
		return $this->db->query("SELECT * FROM tbl_bimbingan, tbl_ttd_dospem 
			WHERE id_syarat_sk='$id_syarat_sk' AND 
			tbl_ttd_dospem.id_relasi = tbl_bimbingan.id_bimbingan AND
			tbl_ttd_dospem.status = 'Tersedia' AND
			tbl_bimbingan.status = 'Tersedia' AND
			tbl_ttd_dospem.topik_relasi = 'Tandatangan bimbingan Kerja Praktik oleh Dosen Pembimbing'
			ORDER BY bimbingan_ke ASC")->result_array();
	}

	function get_file_lampiran_bimbingan($id_syarat_sk, $pertemuanKe){
		$hasil = $this->db->query("SELECT * FROM  tbl_bimbingan 
			WHERE id_syarat_sk='$id_syarat_sk' AND 
			bimbingan_ke = '$pertemuanKe' AND
			status = 'Tersedia' ")->row();
		if ($hasil) {
			return $hasil->file_lampiran;
		}else{
			return "";
		}
	}

	function getIdRandom($id_syarat_sk, $topik){
		$hasil = $this->db->query("SELECT * FROM  tbl_ttd_dospem 
			WHERE id_relasi='$id_syarat_sk' AND 
			tbl_ttd_dospem.status = 'Tersedia' AND
			tbl_ttd_dospem.topik_relasi = '$topik'")->row();
		if ($hasil) {
			return $hasil->id_random;
		}else{
			return 0;
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
	
	function combobox_mahasiswa($kode_prodi)
	{
		return $this->db->query("SELECT * FROM tbl_mahasiswa WHERE kode_prodi='$kode_prodi' AND status='Aktif'")->result_array();
	}

	function show_sk_mahasiswa($npk)
	{
		$hasil=$this->db->query(
			"SELECT * FROM 
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

	function show_sk_mahasiswa2()
	{
		$hasil=$this->db->query(
			"SELECT * FROM tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_syarat_sk,
			tb_prodi,
			tbl_persetujuan_sk, 
			tbl_dospem,
			tbl_nomor_surat,
			tbl_ttd_surat
			WHERE tbl_mahasiswa.npm 			= tbl_syarat_sk.npm AND
			tbl_mahasiswa.kode_prodi 			= tb_prodi.kode_prodi AND
			tbl_jenis_sk.id_jenis_sk 			= tbl_syarat_sk.id_jenis_sk AND
			tbl_persetujuan_sk.id_syarat_sk 	= tbl_syarat_sk.id_syarat_sk AND
			tbl_dospem.id_syarat_sk 			= tbl_syarat_sk.id_syarat_sk AND
			tbl_ttd_surat.topik_relasi 			= 'Tandatangan SK Pembimbing KP oleh Dekan' AND
			tbl_ttd_surat.id_relasi 			= tbl_syarat_sk.id_syarat_sk AND
			tbl_nomor_surat.id_relasi 			= tbl_syarat_sk.id_syarat_sk AND
			tbl_nomor_surat.relasi_tabel 		= 'tbl_syarat_sk' AND
			tbl_nomor_surat.fungsi_nomor 		= 'SK Pembimbing KP' AND
			tbl_persetujuan_sk.tema_persetujuan = 'Pengecekan Berkas Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha' AND
			tb_prodi.status 					!= 'Dihapus' AND
			tbl_syarat_sk.status 				= 'Tersedia' AND
			tbl_jenis_sk.status 				= 'Tersedia' AND
			tbl_mahasiswa.status 				= 'Aktif' AND
			tbl_dospem.status 					= 'Tersedia' AND
			tbl_persetujuan_sk.status 			= 'Tersedia' AND
			tbl_nomor_surat.status 				= 'Tersedia' AND
			tbl_ttd_surat.status 				= 'Tersedia' 
			ORDER BY tbl_dospem.id_dospem DESC;
			");
		return $hasil;
	}

	function show_bimbingan()
	{
		$hasil=$this->db->query(
			"SELECT * FROM  tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_syarat_sk,
			tb_prodi,
			tbl_persetujuan_sk, 
			tbl_dospem,
			tbl_nomor_surat,
			tbl_ttd_surat,
			tbl_bimbingan
			WHERE tbl_mahasiswa.npm 			= tbl_syarat_sk.npm AND
			tbl_mahasiswa.kode_prodi 			= tb_prodi.kode_prodi AND
			tbl_jenis_sk.id_jenis_sk 			= tbl_syarat_sk.id_jenis_sk AND
			tbl_persetujuan_sk.id_syarat_sk 	= tbl_syarat_sk.id_syarat_sk AND
			tbl_bimbingan.id_syarat_sk 			= tbl_syarat_sk.id_syarat_sk AND
			tbl_dospem.id_syarat_sk 			= tbl_syarat_sk.id_syarat_sk AND
			tbl_ttd_surat.topik_relasi 			= 'Tandatangan SK Pembimbing KP oleh Dekan' AND
			tbl_ttd_surat.id_relasi 			= tbl_syarat_sk.id_syarat_sk AND
			tbl_nomor_surat.id_relasi 			= tbl_syarat_sk.id_syarat_sk AND
			tbl_nomor_surat.relasi_tabel 		= 'tbl_syarat_sk' AND
			tbl_nomor_surat.fungsi_nomor 		= 'SK Pembimbing KP' AND
			tbl_persetujuan_sk.tema_persetujuan = 'Pengecekan Berkas Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha' AND

			tb_prodi.status 					!= 'Dihapus' AND
			tbl_syarat_sk.status 				= 'Tersedia' AND
			tbl_jenis_sk.status 				= 'Tersedia' AND
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

	function show_nilai()
	{
		$hasil=$this->db->query(
			"SELECT * FROM  tbl_syarat_sk,
			tbl_nilai
			WHERE tbl_nilai.id_syarat_sk = tbl_syarat_sk.id_syarat_sk AND
			tbl_syarat_sk.status 	 = 'Tersedia' AND
			tbl_nilai.status 		 = 'Tersedia'
			");

		return $hasil;
	}

	function show_nilai_pembimbing_lapangan()
	{
		$hasil=$this->db->query(
			"SELECT * FROM  tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_syarat_sk,
			tb_prodi,
			tbl_persetujuan_sk, 
			tbl_dospem,
			tbl_nomor_surat,
			tbl_ttd_surat,
			tbl_bimbingan,
			tbl_pembimbing_lapangan
			WHERE   tbl_mahasiswa.npm 			= tbl_syarat_sk.npm AND
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

	function data_bimbingan($kode_prodi){
		return $this->db->query(
			"SELECT * FROM tbl_bimbingan, tbl_mahasiswa
			WHERE   tbl_bimbingan.npm 	= tbl_mahasiswa.npm AND
			tbl_bimbingan.status 		='Tersedia' AND
			tbl_mahasiswa.kode_prodi 	= '$kode_prodi' AND
			tbl_mahasiswa.status 		!='Dihapus'
			ORDER BY tbl_bimbingan.id_bimbingan DESC")->result_array();
	}

	// TAMBAH DATA BIMBINGAN OLEH DOSEN
	function tambah_bimbingan($id_syarat_sk, $bimbingan_ke, $materi_bimbingan, $hasil_bimbingan, $jenis_pertemuan_bimbingan, $nama_mahasiswa, $npm, $nama_file_full_lampiran){
		$hasil=$this->db->query(
			"INSERT INTO tbl_bimbingan (
			id_syarat_sk, 
			bimbingan_ke, 
			materi_bimbingan,
			hasil_bimbingan,
			jenis_pertemuan_bimbingan,
			file_lampiran,
			status) 
			VALUES ( 
			'$id_syarat_sk', 
			'$bimbingan_ke', 
			'$materi_bimbingan', 
			'$hasil_bimbingan',
			'$jenis_pertemuan_bimbingan',
			'$nama_file_full_lampiran', 
			'Tersedia')");
		$id_relasi = $this->db->insert_id(); 

		if ($hasil) {
			$topik_relasi = 'Tandatangan bimbingan Kerja Praktik oleh Dosen Pembimbing';
			$id_random = $this->generate_id_random();
			$perihal = 'Tandatangan bimbingan Kerja praktik atas nama '.$nama_mahasiswa.' ('.$npm.') pertemuan ke-'.$bimbingan_ke;
			$nama_penanda_tangan = $_SESSION['nama'];
			$jabatan_penanda_tangan = 'Dosen Pembimbing Kerja Praktik';
			$this->db->query(
				"INSERT INTO tbl_ttd_dospem (id_relasi,
				topik_relasi,
				id_random,
				nama_penanda_tangan,
				jabatan_penanda_tangan,
				perihal,
				status_validasi,
				status)
				VALUES ($id_relasi,
				'$topik_relasi',
				'$id_random',
				'$nama_penanda_tangan',
				'$jabatan_penanda_tangan',
				'$perihal',
				'Tervalidasi',
				'Tersedia')"
				);
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

			while($this->db->query("SELECT * FROM tbl_ttd_dospem WHERE id_random='$rand' AND status = 'Tersedia'")->num_rows()>0){
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

	// MAHASISWA UPLOAD LAPORAN LENGKAP
		function tambah_laporan_acc($id_syarat_sk, $nama_file_full, $nama_file_lama, $nama_jenis_file){
			if ($nama_file_lama != '') {
				unlink(base_url('templates/file/mahasiswa/syarat_sk/sk/laporan_acc/').$nama_file_lama);
			}

			$hasil = $this->db->query(
				"UPDATE tbl_file_kp set status='Dihapus' WHERE id_syarat_sk = '$id_syarat_sk' AND nama_file='$nama_jenis_file'");
			
			$hasil2 = $this->db->query(
				"INSERT INTO tbl_file_kp (id_syarat_sk, 
				nama_file,
				file,
				status)
				VALUES ('$id_syarat_sk',
				'$nama_jenis_file',
				'$nama_file_full', 
				'Tersedia'
				)");
			return $hasil2;
		}

	// CEK DATA LAPORAN LENGKAP YANG DIUPLOAD OLEH MAHASISWA
		function cekLaporanLengkap($id_syarat_sk, $pertemuanKe){
			if ($pertemuanKe!='Laporan Lengkap') {
				$pertemuan = 'Laporan P'.$pertemuanKe; 
			}else{
				$pertemuan = $pertemuanKe;
			}
			$hasil=$this->db->query(
				"SELECT * FROM 
				tbl_file_kp
				WHERE 
				tbl_file_kp.nama_file = '$pertemuan' AND
				tbl_file_kp.id_syarat_sk = '$id_syarat_sk' AND
				tbl_file_kp.status 		= 'Tersedia'
				");
			return $hasil;
		}

		function cekPertemuanBimbingan($id_syarat_sk, $pertemuanKe){
			$hasil=$this->db->query(
				"SELECT count(id_bimbingan) AS jml FROM 
				tbl_bimbingan WHERE id_syarat_sk='$id_syarat_sk' AND bimbingan_ke='$pertemuanKe' AND status='Tersedia'");
			if ($hasil) {
				$baris = $hasil->row();
				if ($baris->jml>0) {
					return 1; 
				}else{
					return 0;
				}
			}else{
				return 0;
			}
		}

		function cek_laporan_pertemuan($id_syarat_sk, $pertemuanKe){
			$pertemuan = 'Laporan P'.$pertemuanKe; 
			$hasil=$this->db->query(
				"SELECT count(id_file_kp) AS jml FROM 
				tbl_file_kp WHERE id_syarat_sk='$id_syarat_sk' AND nama_file='$pertemuan' AND status='Tersedia'");
			if ($hasil) {
				$baris = $hasil->row();
				if ($baris->jml>0) {
					return 1; 
				}else{
					return 0;
				}
			}else{
				return 0;
			}	
		}

		function cekTigaBimbingan($id_syarat_sk){
			$hasil=$this->db->query(
				"SELECT DISTINCT bimbingan_ke AS jml FROM 
				tbl_bimbingan WHERE id_syarat_sk='$id_syarat_sk' AND status='Tersedia'");
			if ($hasil->num_rows()>=3) {
				return 1;
			}else{
				return 0;
			}
		}

		function nilai_bimbingan($id_syarat_sk, $sikap, $pemahaman, $kelengkapan){
			$hasil=$this->db->query(
				"INSERT INTO tbl_nilai (
				id_syarat_sk,
				sikap,
				pemahaman,
				kelengkapan,
				status_verifikasi_prodi,
				status) 
				VALUES ( 
				'$id_syarat_sk', 
				'$sikap', 
				'$pemahaman',
				'$kelengkapan',
				'',
				'Tersedia')");
			return $hasil;
		}

		function tambah_nilai_pembimbing_lapangan($id_syarat_sk, $kepribadian, $kedisiplinan, $motivasi, $tanggung_jawab, $komitmen, $kerjasama, $keselamatan_kerja, $laporan){
			$hasil=$this->db->query(
				"INSERT INTO tbl_pembimbing_lapangan (
						-- npm, 
						id_syarat_sk, 
						kepribadian, 
						kedisiplinan,
						motivasi,
						tanggung_jawab,
						komitmen,
						kerjasama,
						keselamatan_kerja,
						laporan,
						status) 
						VALUES ( 
						-- '$npm', 
						'$id_syarat_sk', 
						'$kepribadian', 
						'$kedisiplinan', 
						'$motivasi',
						'$tanggung_jawab',
						'$komitmen',
						'$kerjasama',
						'$keselamatan_kerja',
						'$laporan',
						'Tersedia')");
			return $hasil;
		}

		function cek_pertemuan_sebelum($id_syarat_sk, $pertemuanSebelum){
			if($pertemuanSebelum==0){
				return 1;
			}else{
				return $this->db->query("SELECT * FROM tbl_bimbingan WHERE id_syarat_sk='$id_syarat_sk' AND bimbingan_ke='$pertemuanSebelum' AND status='Tersedia'")->num_rows();
			}	
		}

		function ambilItem($id_syarat_sk, $pertemuanKe, $field_target){
			$baris = $this->db->query("SELECT $field_target as target FROM tbl_bimbingan WHERE id_syarat_sk='$id_syarat_sk' AND bimbingan_ke='$pertemuanKe' AND status='Tersedia'")->row();
			if($baris){
				return $baris->target;
			}else{
				return "";
			}
		}

		function cekKonfirmasi($id_syarat_sk){
			return $this->db->query(
				"SELECT * FROM tbl_nilai, tbl_syarat_sk, tbl_pembimbing_lapangan 
				WHERE 	tbl_nilai.id_syarat_sk 			= tbl_syarat_sk.id_syarat_sk AND 
				tbl_pembimbing_lapangan.id_syarat_sk 	= tbl_syarat_sk.id_syarat_sk AND 
				tbl_nilai.status 						= 'Tersedia' AND
				tbl_pembimbing_lapangan.status 			= 'Tersedia' AND
				tbl_syarat_sk.status 					= 'Tersedia' AND
				tbl_syarat_sk.id_syarat_sk 				= '$id_syarat_sk' AND
				tbl_nilai.status_verifikasi_prodi 		= 'Terverifikasi' AND
				tbl_pembimbing_lapangan.status_verifikasi_prodi ='Terverifikasi'")->num_rows();
		}

	// function cekTtdProdi($id_syarat_sk){
	// 	return $this->db->query(
	// 		"SELECT * FROM tbl_bimbingan, tbl_syarat_sk, tbl_pembimbing_lapangan 
	// 		WHERE 	tbl_nilai.id_syarat_sk 			= tbl_syarat_sk.id_syarat_sk AND 
	// 		tbl_pembimbing_lapangan.id_syarat_sk 	= tbl_syarat_sk.id_syarat_sk AND 
	// 		tbl_nilai.status 						='Tersedia' AND
	// 		tbl_pembimbing_lapangan.status 			='Tersedia' AND
	// 		tbl_syarat_sk.status 			='Tersedia' AND
	// 		tbl_syarat_sk.id_syarat_sk 				= '$id_syarat_sk' AND
	// 		tbl_nilai.status_verifikasi_prodi 		= 'Terverifikasi' AND
	// 		tbl_pembimbing_lapangan.status_verifikasi_prodi ='Terverifikasi'")->num_rows();
	// }

		function cekResponNilai($id_syarat_sk){
			return $this->db->query(
				"SELECT * FROM tbl_nilai, tbl_syarat_sk 
				WHERE 	tbl_nilai.id_syarat_sk 	= tbl_syarat_sk.id_syarat_sk AND 
				tbl_nilai.status 				='Tersedia' AND
				tbl_syarat_sk.id_syarat_sk 		= '$id_syarat_sk' AND
				tbl_syarat_sk.status 			='Tersedia'")->num_rows();
		}

		function cekResponkk($id_syarat_sk){
			return $this->db->query(
				"SELECT * FROM tbl_ttd_dospem
				WHERE 
				topik_relasi = 'Tandatangan kartu bimbingan Kerja Praktik oleh Prodi' AND
				id_relasi = '$id_syarat_sk' AND
				status 			='Tersedia'")->num_rows();
		}

		function cekResponNilai_pembimbing_lapangan($id_syarat_sk){
			return $this->db->query(
				"SELECT * FROM tbl_pembimbing_lapangan, tbl_syarat_sk 
				WHERE 	tbl_pembimbing_lapangan.id_syarat_sk = tbl_syarat_sk.id_syarat_sk AND 
				tbl_pembimbing_lapangan.status 	='Tersedia' AND
				tbl_syarat_sk.id_syarat_sk 		= '$id_syarat_sk' AND
				tbl_syarat_sk.status 			='Tersedia'")->num_rows();
		}

		function kalkulasiNilaiDospem($id_syarat_sk){
			$baris_nilai1 = $this->db->query(
				"SELECT * FROM tbl_nilai, tbl_syarat_sk 
				WHERE 	tbl_nilai.id_syarat_sk 	= tbl_syarat_sk.id_syarat_sk AND 
				tbl_nilai.status 				='Tersedia' AND
				tbl_syarat_sk.id_syarat_sk 		= '$id_syarat_sk' AND
				tbl_syarat_sk.status 			='Tersedia'")->row();

			if ($baris_nilai1) {
				$sikap1 		= $baris_nilai1->sikap;
				$pemahaman1 	= $baris_nilai1->pemahaman;
				$kelengkapan1 	= $baris_nilai1->kelengkapan;
				$jumlah1 		= (($sikap1*25)/100) + (($pemahaman1*50)/100) +  (($kelengkapan1*25)/100);
				return $jumlah1;
			}else{
				return 0;
			}
		}

		function get_nilai($id_syarat_sk, $item){
			$baris_nilai2 = $this->db->query(
				"SELECT * FROM tbl_pembimbing_lapangan, tbl_syarat_sk 
				WHERE 	tbl_pembimbing_lapangan.id_syarat_sk = tbl_syarat_sk.id_syarat_sk AND 
				tbl_pembimbing_lapangan.status 		 		='Tersedia' AND
				tbl_syarat_sk.id_syarat_sk 					= '$id_syarat_sk' AND
				tbl_syarat_sk.status 						= 'Tersedia'")->row();

			if ($baris_nilai2) {
				return $baris_nilai2->$item;
			}else{
				return 'Maaf, ada kesalahan';
			}
			
		}

		function kalkulasiNilaiLapangan($id_syarat_sk){
			$baris_nilai2 = $this->db->query(
				"SELECT * FROM tbl_pembimbing_lapangan, tbl_syarat_sk 
				WHERE 	tbl_pembimbing_lapangan.id_syarat_sk = tbl_syarat_sk.id_syarat_sk AND 
				tbl_pembimbing_lapangan.status 		 		='Tersedia' AND
				tbl_syarat_sk.id_syarat_sk 					= '$id_syarat_sk' AND
				tbl_syarat_sk.status 						= 'Tersedia'")->row();

			$kepribadian2 		= $baris_nilai2->kepribadian;
			$kedisiplinan2 		= $baris_nilai2->kedisiplinan;
			$motivasi2 			= $baris_nilai2->motivasi;
			$tanggung_jawab2 	= $baris_nilai2->tanggung_jawab;
			$komitmen2 			= $baris_nilai2->komitmen;
			$kerjasama2 		= $baris_nilai2->kerjasama;
			$keselamatan2 		= $baris_nilai2->keselamatan;
			$laporan2 			= $baris_nilai2->tanggung_jawab;

			$jumlah2 = (($kepribadian2*10)/100) + (($kedisiplinan2*10)/100) + (($motivasi2*10)/100) + (($tanggung_jawab2*20)/100) + (($komitmen2*10)/100) + (($kerjasama2*10)/100) + (($keselamatan2*10)/100) + (($laporan2*20)/100) ;
			return $jumlah2;

		}

		function kalkulasiNilai($id_syarat_sk){
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
			$persentase1 	= $jumlah1 * 40/ 100;

			$baris_nilai2 = $this->db->query(
				"SELECT * FROM tbl_pembimbing_lapangan, tbl_syarat_sk 
				WHERE 	tbl_pembimbing_lapangan.id_syarat_sk = tbl_syarat_sk.id_syarat_sk AND 
				tbl_pembimbing_lapangan.status 		 		='Tersedia' AND
				tbl_syarat_sk.id_syarat_sk 					= '$id_syarat_sk' AND
				tbl_syarat_sk.status 						= 'Tersedia'")->row();

			$kepribadian2 		= $baris_nilai2->kepribadian;
			$kedisiplinan2 		= $baris_nilai2->kedisiplinan;
			$motivasi2 			= $baris_nilai2->motivasi;
			$tanggung_jawab2 	= $baris_nilai2->tanggung_jawab;
			$komitmen2 			= $baris_nilai2->komitmen;
			$kerjasama2 		= $baris_nilai2->kerjasama;
			$keselamatan2 		= $baris_nilai2->keselamatan;
			$laporan2 			= $baris_nilai2->tanggung_jawab;

			$jumlah2 = (($kepribadian2*10)/100) + (($kedisiplinan2*10)/100) + (($motivasi2*10)/100) + (($tanggung_jawab2*20)/100) + (($komitmen2*10)/100) + (($kerjasama2*10)/100) + (($keselamatan2*10)/100) + (($laporan2*20)/100) ;
			$persentase2 = $jumlah2 * 60/ 100;

			return $this->konversiHuruf($persentase1+$persentase2);

		}
		
		function konversiHuruf($nilai){
			if($nilai >80){
				return 'A';
			}elseif($nilai >75 && $nilai <=80){
				return 'A-';
			}elseif($nilai >70 && $nilai <=75){
				return 'B+';
			}elseif($nilai >60 && $nilai <=70){
				return 'B';
			}elseif($nilai >55 && $nilai <=60){
				return 'B-';
			}elseif($nilai >50 && $nilai <=55){
				return 'C+';
			}elseif($nilai >40 && $nilai <=55){
				return 'C';
			}elseif($nilai >35 && $nilai <=40){
				return 'C-';
			}elseif($nilai >30 && $nilai <=35){
				return 'D';
			}else{
				return 'E';
			}
		}

		function row_data($npm)
		{
			$hasil=$this->db->query(
				"SELECT * FROM 	tbl_mahasiswa, 
				tbl_jenis_sk, 
				tbl_syarat_sk,
				tb_prodi,
				tbl_persetujuan_sk, 
				tbl_dospem,
				tbl_nomor_surat,
				tbl_ttd_surat,
				tbl_bimbingan
				WHERE 	tbl_mahasiswa.npm 			= tbl_syarat_sk.npm AND
				tbl_mahasiswa.kode_prodi 			= tb_prodi.kode_prodi AND
				tbl_jenis_sk.id_jenis_sk 			= tbl_syarat_sk.id_jenis_sk AND
				tbl_persetujuan_sk.id_syarat_sk 	= tbl_syarat_sk.id_syarat_sk AND
				tbl_dospem.id_syarat_sk 			= tbl_syarat_sk.id_syarat_sk AND
				tbl_ttd_surat.topik_relasi 			= 'Tandatangan SK Pembimbing KP oleh Dekan' AND
				tbl_ttd_surat.id_relasi 			= tbl_syarat_sk.id_syarat_sk AND
				tbl_bimbingan.id_relasi 			= tbl_syarat_sk.id_syarat_sk AND
				tbl_nomor_surat.id_relasi 			= tbl_syarat_sk.id_syarat_sk AND
				tbl_nomor_surat.relasi_tabel 		= 'tbl_syarat_sk' AND
				tbl_nomor_surat.fungsi_nomor 		= 'SK Pembimbing KP' AND
				tbl_persetujuan_sk.tema_persetujuan = 'Pengecekan Berkas Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha' AND

				tb_prodi.status 					!= 'Dihapus' AND
				tbl_syarat_sk.status 				= 'Tersedia' AND
				tbl_jenis_sk.status 				= 'Tersedia' AND
				tbl_bimbingan.status 				= 'Tersedia' AND
				tbl_mahasiswa.status 				= 'Aktif' AND
				tbl_dospem.status 					= 'Tersedia' AND
				tbl_persetujuan_sk.status 			= 'Tersedia' AND
				tbl_nomor_surat.status 				= 'Tersedia' AND
				tbl_ttd_surat.status 				= 'Tersedia'");
			return $hasil->row();
		}

		function data_bimbingan2($npm){
			return $this->db->query(
				"SELECT * FROM 
				tbl_syarat_sk,
				tbl_mahasiswa
				where 
				tbl_mahasiswa.npm 		= tbl_syarat_sk.npm AND
				tbl_syarat_sk.status 	= 'Tersedia' AND
				tbl_mahasiswa.npm 		= '$npm' AND
				tbl_mahasiswa.status 	= 'Aktif' 
				")->result_array();
		}

		function get_row_data_bimbingan($id_syarat_sk){
			// $topik_relasi = 'Tandatangan Kartu Bimbingan Oleh Dosen Pembimbing';
			$hasil = $this->db->query(
				"SELECT * FROM tbl_mahasiswa, 
				tbl_syarat_sk, 
				tb_prodi, 
				tb_prodi_attribut, 
				tbl_dospem, 
				tb_dosen,
				tbl_ttd_dospem
				WHERE tbl_syarat_sk.npm 				= tbl_mahasiswa.npm AND
				tbl_syarat_sk.id_syarat_sk 		= tbl_dospem.id_syarat_sk AND
				tbl_dospem.id_syarat_sk 		= tbl_syarat_sk.id_syarat_sk AND
				tb_prodi.kode_prodi 			= tbl_mahasiswa.kode_prodi AND
				tb_prodi_attribut.kode_prodi 	= tb_prodi.kode_prodi AND
				tb_dosen.npk 					= tbl_dospem.npk AND
				tbl_syarat_sk.id_syarat_sk 		= '$id_syarat_sk' AND
				tbl_syarat_sk.status 			= 'Tersedia' AND
				tb_prodi.status 				= 'Tersedia' AND
				tb_prodi_attribut.status_akun 	= 'Aktif' AND
				tb_prodi_attribut.jabatan 		= 'Ketua Program Studi' AND
				tbl_mahasiswa.status 			!= 'Dihapus' AND
				tbl_dospem.status 				= 'Tersedia' AND
				tbl_ttd_dospem.status 				= 'Tersedia' AND
				tb_dosen.status 				!= 'Dihapus' 
				");
			return $hasil->row();
		}
		

		// function get_row_data_bimbingan($id_syarat_sk){
		// 	$topik_relasi = 'Tandatangan Kartu Bimbingan Oleh Dosen Pembimbing';
		// 	$hasil = $this->db->query(
		// 		"SELECT * FROM tbl_mahasiswa, 
		// 						tbl_syarat_sk, 
		// 						tb_prodi, 
		// 						tbl_dospem, 
		// 						tb_dosen, 
		// 						tb_dosen_lanjutan,
		// 						tbl_bimbingan,
		// 						tbl_ttd_surat
		// 		WHERE tbl_syarat_sk.npm 				= tbl_mahasiswa.npm AND
		// 				tbl_syarat_sk.id_syarat_sk 		= tbl_dospem.id_syarat_sk AND
		// 				tbl_dospem.id_syarat_sk 		= tbl_syarat_sk.id_syarat_sk AND
		// 				tbl_bimbingan.id_syarat_sk 		= tbl_syarat_sk.id_syarat_sk AND
		// 				tb_prodi.kode_prodi 			= tbl_mahasiswa.kode_prodi AND
		// 				tb_dosen.npk 					= tbl_dospem.npk AND
		// 				tb_dosen.npk 					= tb_dosen_lanjutan.npk AND

		// 				tbl_ttd_surat.topik_relasi 		= '$topik_relasi' AND
		// 				tbl_syarat_sk.id_syarat_sk 		= tbl_ttd_surat.id_relasi AND
		// 				tbl_ttd_surat.status 			= 'Tersedia' AND

		// 				tbl_syarat_sk.id_syarat_sk 		= '$id_syarat_sk' AND
		// 				tbl_syarat_sk.status 			= 'Tersedia' AND
		// 				tb_prodi.status 				= 'Tersedia' AND
		// 				tbl_bimbingan.status 				= 'Tersedia' AND
		// 				tbl_mahasiswa.status 			!= 'Dihapus' AND
		// 				tbl_dospem.status 				= 'Tersedia' AND
		// 				tb_dosen_lanjutan.status 				!= 'Dihapus' AND
		// 				tb_dosen.status 				!= 'Dihapus' 
		// 				");
		// 	return $hasil->row();
		// }

		
	}