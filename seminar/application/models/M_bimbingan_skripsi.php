<?php 

class M_bimbingan_skripsi extends CI_Model
{
	function data_bimbingan2($npm){
		return $this->db->query(
			"SELECT * FROM 
			tbl_skripsi,
			tbl_mahasiswa
			where 
			tbl_mahasiswa.npm 		= tbl_skripsi.npm AND
			tbl_skripsi.status 		= 'Tersedia' AND
			tbl_mahasiswa.npm 		= '$npm' AND
			tbl_mahasiswa.status 	= 'Aktif' 
			")->result_array();
	}

	function cek_pertemuan_sebelum($id_skripsi, $pertemuanSebelum){
		if($pertemuanSebelum==0){
			return 1;
		}else{
			return $this->db->query("SELECT * FROM tbl_bimbingan_skripsi WHERE id_skripsi='$id_skripsi' AND bimbingan_ke='$pertemuanSebelum' AND status='Tersedia'")->num_rows();
		}	
	}

	// CEK DATA LAPORAN LENGKAP YANG DIUPLOAD OLEH MAHASISWA
	function cekLaporanLengkap($id_skripsi, $pertemuanKe){
		if ($pertemuanKe!='Laporan Lengkap' && $pertemuanKe!='Laporan Lengkap Kompre') {
			$pertemuan = 'Laporan P'.$pertemuanKe; 
		}else{
			$pertemuan = $pertemuanKe;
		}
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_file_skripsi
			WHERE 
			tbl_file_skripsi.nama_file 	= '$pertemuan' AND
			tbl_file_skripsi.id_skripsi = '$id_skripsi' AND
			tbl_file_skripsi.status 	= 'Tersedia'
			");
		return $hasil;
	}

	function cekPertemuanBimbingan($id_skripsi, $pertemuanKe){
		$hasil=$this->db->query(
			"SELECT count(id_bimbingan_skripsi) AS jml FROM 
			tbl_bimbingan_skripsi WHERE id_skripsi='$id_skripsi' AND bimbingan_ke='$pertemuanKe' AND status='Tersedia'");
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

		// MAHASISWA UPLOAD LAPORAN LENGKAP
	function tambah_laporan_acc($id_skripsi, $nama_file_full, $nama_file_lama, $nama_jenis_file){
		if ($nama_file_lama != '') {
			unlink(base_url('templates/file/mahasiswa/syarat_sk/skripsi/laporan_acc/').$nama_file_lama);
		}

		$hasil = $this->db->query(
			"UPDATE tbl_file_skripsi set status='Dihapus' WHERE id_skripsi = '$id_skripsi' AND nama_file='$nama_jenis_file'");

		$hasil2 = $this->db->query(
			"INSERT INTO tbl_file_skripsi (id_skripsi, 
			nama_file,
			file,
			status)
			VALUES ('$id_skripsi',
			'$nama_jenis_file',
			'$nama_file_full', 
			'Tersedia'
			)");
		return $hasil2;
	}

	function show_sk_mahasiswa($npk)
	{
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_skripsi,
			tb_prodi,
			tbl_persetujuan_skripsi, 
			tbl_dospem_skripsi
			WHERE 
			tbl_mahasiswa.npm 						 = tbl_skripsi.npm AND
			tbl_mahasiswa.kode_prodi 				 = tb_prodi.kode_prodi AND
			tbl_jenis_sk.id_jenis_sk 				 = tbl_skripsi.id_jenis_sk AND
			tbl_persetujuan_skripsi.id_skripsi 		 = tbl_skripsi.id_skripsi AND
			tbl_dospem_skripsi.id_skripsi 			 = tbl_skripsi.id_skripsi AND


			tb_prodi.status 						 != 'Dihapus' AND
			tbl_skripsi.status 						 = 'Tersedia' AND
			tbl_jenis_sk.status 					 = 'Tersedia' AND
			tbl_mahasiswa.status 					 = 'Aktif' AND
			tbl_dospem_skripsi.status 				 = 'Tersedia' AND
			tbl_persetujuan_skripsi.status 			 = 'Tersedia' AND
			tbl_persetujuan_skripsi.tema_persetujuan = 'Pengecekan Berkas Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha' AND
			tbl_dospem_skripsi.npk 					 = '$npk'
			ORDER BY tbl_dospem_skripsi.id_dospem_skripsi DESC;
			");
		return $hasil;
	}

	function cek_laporan_pertemuan($id_skripsi, $pertemuanKe){
		$pertemuan = 'Laporan P'.$pertemuanKe; 
		$hasil=$this->db->query(
			"SELECT count(id_file_skripsi) AS jml FROM 
			tbl_file_skripsi WHERE id_skripsi='$id_skripsi' AND nama_file='$pertemuan' AND status='Tersedia'");
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

		// TAMBAH DATA BIMBINGAN OLEH DOSEN
	function tambah_bimbingan($id_skripsi, $bimbingan_ke, $materi_bimbingan, $hasil_bimbingan, $jenis_pertemuan_bimbingan, $nama_mahasiswa, $npm, $nama_file_full_lampiran){
		$hasil=$this->db->query(
			"INSERT INTO tbl_bimbingan_skripsi (
			id_skripsi, 
			bimbingan_ke, 
			materi_bimbingan,
			hasil_bimbingan,
			jenis_pertemuan_bimbingan,
			file_lampiran,
			status) 
			VALUES ( 
			'$id_skripsi', 
			'$bimbingan_ke', 
			'$materi_bimbingan', 
			'$hasil_bimbingan',
			'$jenis_pertemuan_bimbingan',
			'$nama_file_full_lampiran', 
			'Tersedia')");
		$id_relasi = $this->db->insert_id(); 

		if ($hasil) {
			$topik_relasi 			= 'Tandatangan bimbingan Skripsi oleh Dosen Pembimbing';
			$id_random 				= $this->generate_id_random();
			$perihal = 'Tandatangan bimbingan Skripsi atas nama '.$nama_mahasiswa.' ('.$npm.') pertemuan ke-'.$bimbingan_ke;
			$nama_penanda_tangan 	= $_SESSION['nama'];
			$jabatan_penanda_tangan = 'Dosen Pembimbing Skripsi';
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

		function ambilItem($id_skripsi, $pertemuanKe, $field_target){
			$baris = $this->db->query("SELECT $field_target as target FROM tbl_bimbingan_skripsi WHERE id_skripsi='$id_skripsi' AND bimbingan_ke='$pertemuanKe' AND status='Tersedia'")->row();
			if($baris){
				return $baris->target;
			}else{
				return "";
			}
		}

		function get_file_lampiran_bimbingan($id_skripsi, $pertemuanKe){
			$hasil = $this->db->query("SELECT * FROM  tbl_bimbingan_skripsi 
				WHERE id_skripsi ='$id_skripsi' AND 
				bimbingan_ke 	 = '$pertemuanKe' AND
				status 			 = 'Tersedia' ")->row();
			if ($hasil) {
				return $hasil->file_lampiran;
			}else{
				return "";
			}
		}

		function cekEmpatBimbingan($id_skripsi){
			$hasil=$this->db->query(
				"SELECT DISTINCT bimbingan_ke AS jml FROM 
				tbl_bimbingan_skripsi WHERE id_skripsi='$id_skripsi' AND status='Tersedia'");
			if ($hasil->num_rows()>=4) {
				return 1;
			}else{
				return 0;
			}
		}

		function get_row_data_bimbingan($id_skripsi){
			// $topik_relasi = 'Tandatangan Kartu Bimbingan Oleh Dosen Pembimbing';
			$hasil = $this->db->query(
				"SELECT * FROM tbl_mahasiswa, 
				tbl_skripsi, 
				tb_prodi, 
				tb_prodi_attribut, 
				tbl_dospem_skripsi, 
				tb_dosen,
				tbl_ttd_dospem
				WHERE tbl_skripsi.npm 			= tbl_mahasiswa.npm AND
				tbl_skripsi.id_skripsi 			= tbl_dospem_skripsi.id_skripsi AND
				tbl_dospem_skripsi.id_skripsi 	= tbl_skripsi.id_skripsi AND
				tb_prodi.kode_prodi 			= tbl_mahasiswa.kode_prodi AND
				tb_prodi_attribut.kode_prodi 	= tb_prodi.kode_prodi AND
				tb_dosen.npk 					= tbl_dospem_skripsi.npk AND
				tbl_skripsi.id_skripsi 			= '$id_skripsi' AND
				tbl_skripsi.status 				= 'Tersedia' AND
				tb_prodi.status 				= 'Tersedia' AND
				tb_prodi_attribut.status_akun 	= 'Aktif' AND
				tb_prodi_attribut.jabatan 		= 'Ketua Program Studi' AND
				tbl_mahasiswa.status 			!= 'Dihapus' AND
				tbl_dospem_skripsi.status 		= 'Tersedia' AND
				tbl_ttd_dospem.status 			= 'Tersedia' AND
				tb_dosen.status 				!= 'Dihapus' 
				");
			return $hasil->row();
		}

		function getDataBimbingan($id_skripsi){
			return $this->db->query("SELECT * FROM tbl_bimbingan_skripsi, tbl_ttd_dospem 
				WHERE id_skripsi 			 ='$id_skripsi' AND 
				tbl_ttd_dospem.id_relasi 	 = tbl_bimbingan_skripsi.id_bimbingan_skripsi AND
				tbl_ttd_dospem.status 		 = 'Tersedia' AND
				tbl_bimbingan_skripsi.status = 'Tersedia' AND
				tbl_ttd_dospem.topik_relasi  = 'Tandatangan bimbingan Skripsi oleh Dosen Pembimbing'
				ORDER BY bimbingan_ke ASC")->result_array();
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

		function getIdRandom($id_skripsi, $topik){
			$hasil = $this->db->query("SELECT * FROM  tbl_ttd_dospem 
				WHERE id_relasi='$id_skripsi' AND 
				tbl_ttd_dospem.status = 'Tersedia' AND
				tbl_ttd_dospem.topik_relasi = '$topik'")->row();
			if ($hasil) {
				return $hasil->id_random;
			}else{
				return 0;
			}
		}

		function setuju_sempro($id_skripsi){
			$hasil = $this->db->query("UPDATE tbl_file_skripsi SET status_sempro = 'Disetujui Sempro' WHERE id_skripsi ='$id_skripsi' AND nama_file = 'Laporan Lengkap'");
			return $hasil;
		}

		function setuju_kompre($id_skripsi){
			$hasil = $this->db->query("UPDATE tbl_file_skripsi SET status_sempro = 'Disetujui Kompre' WHERE id_skripsi ='$id_skripsi' AND nama_file = 'Laporan Lengkap Kompre'");
			return $hasil;
		}	

		function cekPersetujuan_sempro($id_skripsi){
			return $this->db->query("SELECT * FROM tbl_skripsi, tbl_file_skripsi 
				WHERE tbl_skripsi.id_skripsi 	= '$id_skripsi' AND 
				tbl_file_skripsi.id_skripsi 	= tbl_skripsi.id_skripsi AND
				tbl_file_skripsi.status 		= 'Tersedia' AND
				tbl_file_skripsi.nama_file 		= 'Laporan Lengkap' AND
				tbl_skripsi.status 				= 'Tersedia' AND
				tbl_file_skripsi.status 		= 'Tersedia' AND
				tbl_file_skripsi.status_sempro  = 'Disetujui Sempro'")->num_rows();
		}

		function cekPersetujuan_kompre($id_skripsi){
			return $this->db->query("SELECT * FROM tbl_skripsi, tbl_file_skripsi 
				WHERE tbl_skripsi.id_skripsi 	= '$id_skripsi' AND 
				tbl_file_skripsi.id_skripsi 	= tbl_skripsi.id_skripsi AND
				tbl_file_skripsi.status 		= 'Tersedia' AND
				tbl_file_skripsi.nama_file 		= 'Laporan Lengkap Kompre' AND
				tbl_skripsi.status 				= 'Tersedia' AND
				tbl_file_skripsi.status 		= 'Tersedia' AND
				tbl_file_skripsi.status_sempro  = 'Disetujui Kompre'")->num_rows();
		}
	}
	?>