<?php 

class M_penguji_skripsi extends CI_Model
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
			tbl_persetujuan_sempro.tema_persetujuan 	= 'Pengecekan Berkas Persyaratan Sempro Mahasiswa oleh Tata Usaha' 
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

		";
		$hasil=$this->db->query($query)->result_array();
		return $hasil;
	}

	function show_data_kompre()
	{
		$kondisi = $this->return_kondisi();
		$query =
		"SELECT * FROM 
		tbl_mahasiswa, 
		tbl_seminar, 
		tbl_syarat_kompre,
		tbl_syarat_sempro,
		tb_prodi		
		WHERE 
		tbl_mahasiswa.npm 			= tbl_syarat_kompre.npm AND
		tbl_mahasiswa.npm 			= tbl_syarat_sempro.npm AND
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

	function show_data_sempro_dosen($npk)
	{
		$kondisi = $this->return_kondisi();
		$query =
		"SELECT * FROM 
		tbl_mahasiswa, 
		tbl_syarat_sempro, 
		tbl_seminar,
		tb_prodi,
		tbl_persetujuan_sempro, 
		tbl_penguji_skripsi
		WHERE 
		tbl_mahasiswa.npm 						= tbl_syarat_sempro.npm AND
		tbl_mahasiswa.kode_prodi 				= tb_prodi.kode_prodi AND
		tbl_syarat_sempro.id_seminar 			= tbl_seminar.id_seminar AND
		tbl_persetujuan_sempro.id_syarat_sempro	= tbl_syarat_sempro.id_syarat_sempro AND
		tbl_penguji_skripsi.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND

		tb_prodi.status 						!= 'Dihapus' AND
		tbl_seminar.status 						= 'Tersedia' AND
		tbl_syarat_sempro.status 				= 'Tersedia' AND
		tbl_mahasiswa.status 					= 'Aktif' AND
		tbl_persetujuan_sempro.status 			= 'Tersedia' AND
		tbl_persetujuan_sempro.tema_persetujuan = 'Pengecekan Berkas Persyaratan Sempro Mahasiswa oleh Tata Usaha' AND
		tbl_penguji_skripsi.npk 				= '$npk'
		$kondisi

		";
		$hasil=$this->db->query($query)->result_array();
		return $hasil;
	}

	function show_sk_penguji_fakultas()
	{
		$kondisi = $this->return_kondisi();
		$query = "SELECT * FROM 
		tbl_mahasiswa, 
		tbl_syarat_sempro, 
		tbl_seminar,
		tb_prodi,
		tbl_persetujuan_sempro
		WHERE 
		tbl_mahasiswa.npm 						= tbl_syarat_sempro.npm AND
		tbl_mahasiswa.kode_prodi 				= tb_prodi.kode_prodi AND
		tbl_syarat_sempro.id_seminar 			= tbl_seminar.id_seminar AND
		tbl_persetujuan_sempro.id_syarat_sempro	= tbl_syarat_sempro.id_syarat_sempro AND

		tb_prodi.status 						!= 'Dihapus' AND
		tbl_seminar.status 						= 'Tersedia' AND
		tbl_syarat_sempro.status 				= 'Tersedia' AND
		tbl_mahasiswa.status 					= 'Aktif' AND
		tbl_persetujuan_sempro.status 			= 'Tersedia' AND
		tbl_persetujuan_sempro.tema_persetujuan = 'Pengecekan Berkas Persyaratan Sempro Mahasiswa oleh Tata Usaha' 
		$kondisi

		";
		$hasil=$this->db->query($query)->result_array();
		return $hasil;
	}

	function simpan_penguji($id_syarat_sempro, $posisi, $npk){
		$hasil=$this->db->query(
			"INSERT INTO tbl_penguji_skripsi (id_syarat_sempro, 
			npk,
			posisi,
			status_persetujuan,
			alasan_ditolak,  
			status) 
			VALUES ($id_syarat_sempro,  
			'$npk', 
			'$posisi', 
			'$status_persetujuan', 
			'', 
			'Tersedia')");
		return $hasil;
	}

	function cekPenunjukan($id_syarat_sempro){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_seminar, 
			tbl_syarat_sempro,
			tb_prodi,
			tbl_persetujuan_sempro
			WHERE 
			tbl_mahasiswa.npm 						= tbl_syarat_sempro.npm AND
			tbl_mahasiswa.kode_prodi 				= tb_prodi.kode_prodi AND
			tbl_seminar.id_seminar 					= tbl_syarat_sempro.id_seminar AND
			tbl_persetujuan_sempro.id_syarat_sempro = tbl_syarat_sempro.id_syarat_sempro AND

			tb_prodi.status 						!= 'Dihapus' AND
			tbl_syarat_sempro.status 				= 'Tersedia' AND
			tbl_seminar.status 						= 'Tersedia' AND
			tbl_mahasiswa.status 					= 'Aktif' AND
			tbl_persetujuan_sempro.status 			= 'Tersedia' AND
			tbl_persetujuan_sempro.tema_persetujuan = 'Pengecekan Berkas Persyaratan Sempro Mahasiswa oleh Tata Usaha' AND			
			tbl_syarat_sempro.id_syarat_sempro 		= '$id_syarat_sempro'

			")->num_rows();
		return $hasil;
	}

	function cekStatusPenunjukan($id_syarat_sempro, $status_persetujuan, $npk){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_seminar, 
			tbl_syarat_sempro,
			tb_prodi,
			tbl_persetujuan_sempro, 
			tbl_penguji_skripsi
			WHERE 
			tbl_mahasiswa.npm 						= tbl_syarat_sempro.npm AND
			tbl_mahasiswa.kode_prodi 				= tb_prodi.kode_prodi AND
			tbl_seminar.id_seminar 					= tbl_syarat_sempro.id_seminar AND
			tbl_persetujuan_sempro.id_syarat_sempro = tbl_syarat_sempro.id_syarat_sempro AND
			tbl_penguji_skripsi.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND

			tb_prodi.status 									!= 'Dihapus' AND
			tbl_syarat_sempro.status 							= 'Tersedia' AND
			tbl_seminar.status 									= 'Tersedia' AND
			tbl_mahasiswa.status 								= 'Aktif' AND
			tbl_persetujuan_sempro.status 						= 'Tersedia' AND
			tbl_persetujuan_sempro.tema_persetujuan = 'Pengecekan Berkas Persyaratan Sempro Mahasiswa oleh Tata Usaha' AND			
			tbl_syarat_sempro.id_syarat_sempro 					= '$id_syarat_sempro' AND
			tbl_penguji_skripsi.npk 					= '$npk' AND
			tbl_penguji_skripsi.status_persetujuan 				= '$status_persetujuan'

			ORDER BY tbl_syarat_sempro.id_syarat_sempro DESC;
			")->num_rows();
		return $hasil;
	}

	// PERSETUJUAN PENGUJI SEMPRO OLEH DOSEN
	function persetujuan_penguji_skripsi($id_penguji_skripsi,  $status_persetujuan, $alasan_ditolak, $status){
		date_default_timezone_set('Asia/Jakarta');	
		$waktu = date('Y-m-d H:i:s');
		$hasil=$this->db->query(
			"UPDATE tbl_penguji_skripsi SET waktu_respon = '$waktu' ,status_persetujuan = '$status_persetujuan' , alasan_ditolak = '$alasan_ditolak', status = '$status' WHERE id_penguji_skripsi ='$id_penguji_skripsi' ;" );
		return $hasil;
	}

	function get_alasan($id_penguji_skripsi){
		$hasil = $this->db->query(
			"SELECT * FROM tbl_penguji_skripsi WHERE status = 'Tersedia' AND id_penguji_skripsi = '$id_penguji_skripsi'")->row();
		if ($hasil) {
			return $hasil->alasan_ditolak;
		}else{
			return '';
		}
	}

	function get_alasan_penguji($id_syarat_sempro){
		$hasil = $this->db->query(
			"SELECT * FROM tbl_penguji_skripsi WHERE status = 'Tersedia' AND id_syarat_sempro = '$id_syarat_sempro'")->row();
		if ($hasil) {
			return $hasil->alasan_ditolak;
		}else{
			return '';
		}
	}

	function get_nama_penguji($id_syarat_sempro, $posisi){
		$hasil = $this->db->query(
			"SELECT * FROM tbl_penguji_skripsi, tb_dosen, tbl_syarat_sempro
			WHERE tbl_penguji_skripsi.status 		= 'Tersedia' AND 
			tbl_syarat_sempro.status 				= 'Tersedia' AND 
			tb_dosen.status 						!= 'Dihapus' AND
			tbl_penguji_skripsi.npk 				= tb_dosen.npk AND
			tbl_penguji_skripsi.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND
			tbl_penguji_skripsi.id_syarat_sempro 	= '$id_syarat_sempro' AND 	
			tbl_penguji_skripsi.posisi 			= '$posisi'
			")->row();
		if ($hasil) {
			return $hasil->nama_dosen;
		}else{
			return '';
		}
	}

	function cekResponPembimbing1($id_syarat_sempro){
		$hasil=$this->db->query("SELECT * FROM 
			tbl_mahasiswa, 
			tbl_seminar, 
			tbl_syarat_sempro,
			tb_prodi,
			tbl_persetujuan_sempro,
			tbl_penguji_skripsi
			WHERE 
			tbl_mahasiswa.npm 						= tbl_syarat_sempro.npm AND
			tbl_mahasiswa.kode_prodi 				= tb_prodi.kode_prodi AND
			tbl_seminar.id_seminar 					= tbl_syarat_sempro.id_seminar AND
			tbl_persetujuan_sempro.id_syarat_sempro = tbl_syarat_sempro.id_syarat_sempro AND
			tbl_penguji_skripsi.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND

			tb_prodi.status 						!= 'Dihapus' AND
			tbl_syarat_sempro.status 				= 'Tersedia' AND
			tbl_penguji_skripsi.status 				= 'Tersedia' AND
			tbl_seminar.status 						= 'Tersedia' AND
			tbl_mahasiswa.status 					= 'Aktif' AND
			tbl_persetujuan_sempro.status 			= 'Tersedia' AND
			tbl_persetujuan_sempro.tema_persetujuan = 'Pengecekan Berkas Persyaratan Sempro Mahasiswa oleh Tata Usaha' AND	
			tbl_syarat_sempro.id_syarat_sempro 		= '$id_syarat_sempro'");
		return $hasil->num_rows();
	}

	function persetujuan_dospem_skripsi($npk, $id_skripsi,  $respon, $alasan_ditolak){
		$hasil=$this->db->query(
			"INSERT INTO tbl_dospem_skripsi (id_skripsi, 
			npk,
			respon,
			alasan_ditolak,  
			status) 
			VALUES ('$id_skripsi',  
			'$npk',
			'$respon', 
			'$alasan_ditolak', 
			'Tersedia')");
		return $hasil;
	}

	function cekRespon($id_syarat_sempro){
		$hasil=$this->db->query(
			"SELECT * FROM  
			tbl_syarat_sempro,
			tbl_persetujuan_sempro,
			tbl_seminar,
			tbl_mahasiswa
			WHERE 
			tbl_persetujuan_sempro.id_syarat_sempro = tbl_syarat_sempro.id_syarat_sempro AND
			tbl_syarat_sempro.id_seminar = tbl_seminar.id_seminar AND
			tbl_syarat_sempro.npm = tbl_mahasiswa.npm AND
			tbl_syarat_sempro.status = 'Tersedia' AND
			tbl_persetujuan_sempro.status = 'Tersedia' AND
			tbl_seminar.status = 'Tersedia' AND
			tbl_mahasiswa.status != 'Dihapus' AND
			tbl_syarat_sempro.id_syarat_sempro = '$id_syarat_sempro'
			")->num_rows();
		return $hasil;
	}

	function cekResponSKFakultas($id_syarat_sempro){
		$hasil=$this->db->query(
			"SELECT * FROM  
			tbl_syarat_sempro,
			tbl_persetujuan_sempro, 
			tbl_ttd_surat, 
			tbl_nomor_surat
			WHERE 
			tbl_persetujuan_sempro.id_persetujuan_sempro = tbl_persetujuan_sempro.id_persetujuan_sempro AND
			tbl_syarat_sempro.status 				= 'Tersedia' AND
			tbl_ttd_surat.topik_relasi 				= 'Tandatangan SK Penguji Skripsi oleh Dekan' AND
			tbl_ttd_surat.id_relasi 				= tbl_syarat_sempro.id_syarat_sempro AND
			tbl_nomor_surat.id_relasi 				= tbl_syarat_sempro.id_syarat_sempro AND
			tbl_nomor_surat.relasi_tabel 			= 'tbl_syarat_sempro' AND
			tbl_nomor_surat.fungsi_nomor 			= 'SK Penguji Skripsi' AND

			tbl_ttd_surat.status 					= 'Tersedia' AND
			tbl_persetujuan_sempro.status 			= 'Tersedia' AND
			tbl_persetujuan_sempro.tema_persetujuan = 'Pengecekan Berkas Persyaratan Sempro Mahasiswa oleh Tata Usaha' AND	

			tbl_nomor_surat.status 					= 'Tersedia' AND
			tbl_syarat_sempro.id_syarat_sempro 				= '$id_syarat_sempro'
			")->num_rows();
		return $hasil;
	}

	function input_nomor_surat($id_syarat_sempro){
		$baris = $this->db->query("SELECT * FROM 
			tbl_mahasiswa, 
			tbl_seminar, 
			tbl_syarat_sempro,
			tb_prodi,
			tbl_persetujuan_sempro, 
			tbl_penguji_skripsi,
			tb_dosen
			WHERE 
			tbl_mahasiswa.npm 						= tbl_syarat_sempro.npm AND
			tbl_mahasiswa.kode_prodi 				= tb_prodi.kode_prodi AND
			tbl_syarat_sempro.id_seminar 			= tbl_seminar.id_seminar AND
			tbl_persetujuan_sempro.id_syarat_sempro = tbl_syarat_sempro.id_syarat_sempro AND
			tbl_penguji_skripsi.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND
			tbl_penguji_skripsi.npk 				= tb_dosen.npk AND
			tb_prodi.status 						!= 'Dihapus' AND
			tbl_syarat_sempro.status 				= 'Tersedia' AND
			tbl_seminar.status 						= 'Tersedia' AND
			tbl_mahasiswa.status 					= 'Aktif' AND
			tbl_penguji_skripsi.status 				= 'Tersedia' AND
			tbl_persetujuan_sempro.status 			= 'Tersedia' AND
			tbl_syarat_sempro.id_syarat_sempro 		= '$id_syarat_sempro' AND
			tbl_penguji_skripsi.status_persetujuan 	= 'Usulan Disetujui'")->row();
		if ($baris) {
			$nama_mahasiswa 				= $baris->nama_mahasiswa;
			$nama_dosen 				= $baris->nama_dosen;
			$npm 							= $baris->npm;
			$npk 							= $baris->npk;
		} else{
			redirect('fakultas/penguji_skripsi');
		}

		date_default_timezone_set('Asia/Jakarta');
		$tahun 			= date('Y');
		$waktu_sekarang = date('Y-m-d H:i:s');
		$row = $this->db->query("SELECT max(nomor_surat) AS nomor_max FROM tbl_nomor_surat WHERE tahun = '$tahun' AND fungsi_nomor='SK Penguji Skripsi'")->row();
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
			VALUES ('SK Penguji Skripsi', 
			'tbl_syarat_sempro', 
			$id_syarat_sempro, 
			($angka +1), 
			'$tahun', 
			'Tersedia') ");
		if ($input_nomor) {
			$topik_relasi 			= 'Tandatangan SK Penguji Skripsi oleh Dekan';
			$id_random 				= $this->generate_id_random();
			$nama_penanda_tangan 	= $_SESSION['nama'];
			$npk_penanda_tangan 	= $_SESSION['npk'];
			$jabatan_penanda_tangan = $_SESSION['jabatan'];
			$kodemax 				= str_pad(($nomor_surat+1), 4, "0", STR_PAD_LEFT);
			$nomor_surat_full 		= ($kodemax).'/KPTS/FT-UIR/KP/'.$tahun;
			$perihal 				= 'Tandatangan SK Penguji Skripsi atas nama '.$nama_mahasiswa.'.' ;
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
				VALUES ('$id_syarat_sempro', 
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

		function cekResponPembimbing($id_syarat_sempro){
			$hasil=$this->db->query("SELECT * FROM 
				tbl_mahasiswa, 
				tbl_seminar, 
				tbl_syarat_sempro,
				tb_prodi,
				tbl_persetujuan_sempro,
				tbl_penguji_skripsi,
				tb_dosen
				WHERE 
				tbl_mahasiswa.npm 						= tbl_syarat_sempro.npm AND
				tbl_seminar.id_seminar 					= tbl_syarat_sempro.id_seminar AND
				tbl_mahasiswa.kode_prodi 				= tb_prodi.kode_prodi AND
				tbl_persetujuan_sempro.id_syarat_sempro = tbl_syarat_sempro.id_syarat_sempro AND
				tbl_penguji_skripsi.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND
				tbl_persetujuan_sempro.id_syarat_sempro = tbl_syarat_sempro.id_syarat_sempro AND
				tbl_penguji_skripsi.npk 				= tb_dosen.npk AND

				tb_prodi.status 						!= 'Dihapus' AND
				tb_dosen.status 						!= 'Dihapus' AND
				tbl_syarat_sempro.status 				= 'Tersedia' AND
				tbl_syarat_sempro.id_syarat_sempro 		= '$id_syarat_sempro' AND
				tbl_mahasiswa.status 					= 'Aktif' AND
				tbl_persetujuan_sempro.status 			= 'Tersedia' AND
				tbl_penguji_skripsi.status 				= 'Tersedia' AND
				tbl_persetujuan_sempro.tema_persetujuan = 'Pengecekan Berkas Persyaratan Sempro Mahasiswa oleh Tata Usaha'
				");
			return $hasil->num_rows();
		}

		function cekResponPenguji($id_penguji_skripsi ){
			$hasil=$this->db->query(
				"SELECT * FROM 
				tbl_penguji_skripsi WHERE id_penguji_skripsi='$id_penguji_skripsi' AND status_persetujuan != ''");
			return $hasil->num_rows();
		}

		function cekResponPenguji1($id_syarat_sempro, $posisi){
			$hasil=$this->db->query(
				"SELECT * FROM 
				tbl_penguji_skripsi
				WHERE 
				status 			 = 'Tersedia' AND
				id_syarat_sempro ='$id_syarat_sempro' AND
				posisi 			 = '$posisi'
				");
			return $hasil->num_rows();
		}

		function cekResponPenguji11($id_syarat_sempro, $posisi, $status_persetujuan){
			$hasil=$this->db->query(
				"SELECT * FROM 
				tbl_penguji_skripsi
				WHERE 
				status 				= 'Tersedia' AND
				id_syarat_sempro 	='$id_syarat_sempro' AND
				posisi 				= '$posisi' AND
				status_persetujuan 	= '$status_persetujuan'
				");
			return $hasil->num_rows();
		}

		function cekResponPilihan($id_syarat_sempro){
			$hasil=$this->db->query("SELECT * FROM 
				tbl_mahasiswa, 
				tbl_seminar, 
				tbl_syarat_sempro,
				tb_prodi,
				tbl_persetujuan_sempro,
				tbl_penguji_skripsi,
				tb_dosen
				WHERE 
				tbl_mahasiswa.npm 						= tbl_syarat_sempro.npm AND
				tbl_seminar.id_seminar 					= tbl_syarat_sempro.id_seminar AND
				tbl_mahasiswa.kode_prodi 				= tb_prodi.kode_prodi AND
				tbl_penguji_skripsi.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND
				tbl_persetujuan_sempro.id_syarat_sempro = tbl_syarat_sempro.id_syarat_sempro AND
				tbl_penguji_skripsi.npk 				= tb_dosen.npk AND

				tb_prodi.status 						!= 'Dihapus' AND
				tb_dosen.status 						!= 'Dihapus' AND
				tbl_syarat_sempro.status 				= 'Tersedia' AND
				tbl_seminar.status 						= 'Tersedia' AND
				tbl_syarat_sempro.id_syarat_sempro 		= '$id_syarat_sempro' AND
				tbl_mahasiswa.status 					= 'Aktif' AND
				tbl_persetujuan_sempro.status 			= 'Tersedia' AND
				tbl_persetujuan_sempro.status_persetujuan = 'Berkas Disetujui' AND
				tbl_penguji_skripsi.status 				= 'Tersedia' AND
				tbl_persetujuan_sempro.tema_persetujuan = 'Pengecekan Berkas Persyaratan Sempro Mahasiswa oleh Tata Usaha'
				");
			return $hasil->num_rows();
		}

		// function show_penilaian_pembimbing1($npk)
		// {
		// 	$kondisi = $this->return_kondisi();
		// 	$query =
		// 	"SELECT * FROM 
		// 	tbl_mahasiswa, 
		// 	tbl_skripsi,
		// 	tbl_seminar,
		// 	tb_prodi,
		// 	tbl_persetujuan_sempro, 
		// 	tbl_dospem_skripsi,
		// 	tbl_syarat_sempro,
		// 	tbl_syarat_kompre
		// 	WHERE 
		// 	tbl_mahasiswa.npm 						= tbl_syarat_sempro.npm AND
		// 	tbl_mahasiswa.kode_prodi 				= tb_prodi.kode_prodi AND
		// 	tbl_syarat_sempro.id_seminar 			= tbl_seminar.id_seminar AND
		// 	tbl_persetujuan_sempro.id_syarat_sempro	= tbl_syarat_sempro.id_syarat_sempro AND
		// 	tbl_dospem_skripsi.id_skripsi			= tbl_skripsi.id_skripsi AND
			
		// 	tb_prodi.status 						!= 'Dihapus' AND
		// 	tbl_mahasiswa.status 					= 'Aktif' AND
		// 	tbl_seminar.status 						= 'Tersedia' AND
		// 	tbl_persetujuan_sempro.status 			= 'Tersedia' AND
		// 	tbl_skripsi.status 						= 'Tersedia' AND
		// 	tbl_dospem_skripsi.status 				= 'Tersedia' AND
		// 	tbl_dospem_skripsi.respon 				= 'Usulan Disetujui' AND
		// 	tbl_persetujuan_sempro.status 			= 'Tersedia' AND
		// 	tbl_persetujuan_sempro.tema_persetujuan = 'Pengecekan Berkas Persyaratan Sempro Mahasiswa oleh Tata Usaha' AND
		// 	tbl_syarat_sempro.status 				= 'Tersedia' AND

		// 	tbl_dospem_skripsi.npk 					= '$npk';
		// 	$kondisi

		// 	";
		// 	$hasil=$this->db->query($query)->result_array();
		// 	return $hasil;
		// }

		// function show_penilaian_pembimbing2($npk)
		// {
		// 	$npk = $_SESSION['npk'];
		// 	$result = $this->db->query("SELECT *
		// 								FROM tbl_mahasiswa, tbl_skripsi 
		// 								JOIN tbl_syarat_sempro b ON tbl_mahasiswa.npm = tbl_syarat_sempro.npm
		// 								JOIN tbl_dospem_skripsi ON tbl_dospem_skripsi.id_skripsi = tbl_skripsi.id_skripsi
		// 								JOIN tbl_persetujuan_sempro ON tbl_persetujuan_sempro.id_syarat_sempro = tbl_syarat_sempro.id_syarat_sempro
		// 								LEFT JOIN tbl_syarat_kompre ON tbl_mahasiswa.npm = tbl_syarat_kompre.npm
		// 								WHERE tbl_dospem_skripsi.npk = '$npk' 
		// 								AND tbl_dospem_skripsi.respon = 'Usulan Disetujui'
		// 								AND tbl_persetujuan_sempro.tema_persetujuan = 'Pengecekan Berkas Persyaratan Sempro Mahasiswa oleh Tata Usaha'
		// 								AND tbl_syarat_kompre.id_syarat_kompre IS NULL");
		// 	return $result->row()->d;
		// }

		function show_penilaian_pembimbing($npk)
		{
			$this->db->select('*');
			$this->db->from('tbl_mahasiswa');
			$this->db->join('tbl_skripsi', 'tbl_mahasiswa.npm = tbl_skripsi.npm');
			$this->db->join('tbl_syarat_sempro', 'tbl_mahasiswa.npm = tbl_syarat_sempro.npm');
			$this->db->join('tb_prodi', 'tbl_mahasiswa.kode_prodi = tb_prodi.kode_prodi');
			$this->db->join('tbl_syarat_kompre', 'tbl_mahasiswa.npm = tbl_syarat_kompre.npm', 'left');
			$this->db->join('tbl_dospem_skripsi','tbl_dospem_skripsi.id_skripsi = tbl_skripsi.id_skripsi');
			$this->db->join('tbl_persetujuan_sempro', 'tbl_persetujuan_sempro.id_syarat_sempro = tbl_syarat_sempro.id_syarat_sempro');
			$this->db->where('tema_persetujuan', 'Pengecekan Berkas Persyaratan Sempro Mahasiswa oleh Tata Usaha');
			$this->db->where('tbl_dospem_skripsi.respon', 'Usulan Disetujui');
			$this->db->where('tbl_dospem_skripsi.npk', $npk);

			$return = $this->db->get('');
			return $return->result_array();
		}

		function show_penilaian($npk)
		{
			$this->db->select('*');
			$this->db->from('tbl_mahasiswa');
			$this->db->join('tbl_skripsi', 'tbl_mahasiswa.npm = tbl_skripsi.npm');
			$this->db->join('tbl_syarat_sempro', 'tbl_mahasiswa.npm = tbl_syarat_sempro.npm');
			$this->db->join('tb_prodi', 'tbl_mahasiswa.kode_prodi = tb_prodi.kode_prodi');
			$this->db->join('tbl_syarat_kompre', 'tbl_mahasiswa.npm = tbl_syarat_kompre.npm', 'left');
			$this->db->join('tbl_penguji_skripsi','tbl_penguji_skripsi.id_syarat_sempro = tbl_syarat_sempro.id_syarat_sempro');
			$this->db->join('tbl_persetujuan_sempro', 'tbl_persetujuan_sempro.id_syarat_sempro = tbl_syarat_sempro.id_syarat_sempro');
			$this->db->where('tema_persetujuan', 'Pengecekan Berkas Persyaratan Sempro Mahasiswa oleh Tata Usaha');
			$this->db->where('tbl_penguji_skripsi.status_persetujuan', 'Usulan Disetujui');
			$this->db->where('tbl_penguji_skripsi.npk', $npk);

			$return = $this->db->get('');
			return $return->result_array();
		}

		function show_penilaian1($npk)
		{
			$kondisi = $this->return_kondisi();
			$query =
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_syarat_sempro, 
			tbl_syarat_kompre, 
			tbl_seminar,
			tb_prodi,
			tbl_persetujuan_sempro, 
			tbl_penguji_skripsi,
			tbl_ttd_surat, 
			tbl_nomor_surat
			WHERE 
			tbl_mahasiswa.npm 						= tbl_syarat_sempro.npm AND
			tbl_mahasiswa.kode_prodi 				= tb_prodi.kode_prodi AND
			tbl_syarat_sempro.id_seminar 			= tbl_seminar.id_seminar AND
			tbl_persetujuan_sempro.id_syarat_sempro	= tbl_syarat_sempro.id_syarat_sempro AND
			tbl_penguji_skripsi.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND
			tbl_ttd_surat.topik_relasi 				= 'Tandatangan SK Penguji Skripsi oleh Dekan' AND
			tbl_ttd_surat.id_relasi 				= tbl_syarat_sempro.id_syarat_sempro AND
			tbl_nomor_surat.id_relasi 				= tbl_syarat_sempro.id_syarat_sempro AND
			tbl_nomor_surat.relasi_tabel 			= 'tbl_syarat_sempro' AND
			tbl_nomor_surat.fungsi_nomor 			= 'SK Penguji Skripsi' AND
			tb_prodi.status 						!= 'Dihapus' AND
			tbl_seminar.status 						= 'Tersedia' AND
			tbl_ttd_surat.status 					= 'Tersedia' AND
			tbl_nomor_surat.status 					= 'Tersedia' AND
			tbl_syarat_sempro.status 				= 'Tersedia' AND
			tbl_mahasiswa.status 					= 'Aktif' AND
			tbl_persetujuan_sempro.status 			= 'Tersedia' AND
			tbl_penguji_skripsi.status 				= 'Tersedia' AND
			tbl_persetujuan_sempro.tema_persetujuan = 'Pengecekan Berkas Persyaratan Sempro Mahasiswa oleh Tata Usaha' AND
			tbl_penguji_skripsi.npk 				= '$npk'
			$kondisi

			";
			$hasil=$this->db->query($query)->result_array();
			return $hasil;
		}

		// function show_penilaian_pembimbing($npk)
		// {
		// 	$kondisi = $this->return_kondisi();
		// 	$query =
		// 	"SELECT * FROM 
		// 	tbl_mahasiswa, 
		// 	tbl_jenis_sk, 
		// 	tbl_skripsi,
		// 	tbl_seminar,
		// 	tb_prodi,
		// 	tbl_persetujuan_sempro, 
		// 	tbl_usulan_pembimbing,
		// 	tbl_syarat_sempro, 
		// 	tbl_persetujuan_usulan_pembimbing,
		// 	tbl_ttd_surat, 
		// 	tbl_nomor_surat
		// 	WHERE 
		// 	tbl_mahasiswa.npm 						= tbl_syarat_sempro.npm AND
		// 	tbl_mahasiswa.kode_prodi 				= tb_prodi.kode_prodi AND
		// 	tbl_syarat_sempro.id_seminar 			= tbl_seminar.id_seminar AND
		// 	tbl_ttd_surat.id_relasi 				= tbl_syarat_sempro.id_syarat_sempro AND
		// 	tbl_nomor_surat.id_relasi 				= tbl_syarat_sempro.id_syarat_sempro AND
		// 	tbl_jenis_sk.id_jenis_sk 				= tbl_skripsi.id_jenis_sk AND
		// 	tbl_persetujuan_sempro.id_syarat_sempro	= tbl_syarat_sempro.id_syarat_sempro AND
		// 	tbl_usulan_pembimbing.id_skripsi 		= tbl_skripsi.id_skripsi AND
		// 	tbl_persetujuan_usulan_pembimbing.id_usulan_pembimbing = tbl_usulan_pembimbing.id_usulan_pembimbing AND
		// 	tbl_ttd_surat.id_relasi 				= tbl_syarat_sempro.id_syarat_sempro AND
		// 	tbl_nomor_surat.id_relasi 				= tbl_syarat_sempro.id_syarat_sempro AND
		// 	tb_prodi.status 						!= 'Dihapus' AND
		// 	tbl_skripsi.status 						= 'Tersedia' AND
		// 	tbl_jenis_sk.status 					= 'Tersedia' AND
		// 	tbl_mahasiswa.status 					= 'Aktif' AND
		// 	tbl_seminar.status 						= 'Tersedia' AND

		// 	tbl_persetujuan_sempro.status 			= 'Tersedia' AND
		// 	tbl_usulan_pembimbing.status 			= 'Tersedia' AND
		// 	tbl_persetujuan_usulan_pembimbing.status = 'Tersedia' AND
		// 	tbl_usulan_pembimbing.status_persetujuan = 'Usulan Disetujui' AND
		// 	tbl_persetujuan_usulan_pembimbing.status_persetujuan = 'Usulan Disetujui' AND
		// 	tbl_persetujuan_sempro.tema_persetujuan = 'Pengecekan Berkas Persyaratan Sempro Mahasiswa oleh Tata Usaha' AND
		// 	tbl_syarat_sempro.status 				= 'Tersedia' AND

		// 	tbl_persetujuan_usulan_pembimbing.npk = '$npk'
		// 	ORDER BY tbl_persetujuan_usulan_pembimbing.id_usulan_pembimbing DESC;
		// 	$kondisi

		// 	";
		// 	$hasil=$this->db->query($query)->result_array();
		// 	return $hasil;
		// }

		function show_nilai()
		{
			$hasil=$this->db->query(
				"SELECT * FROM  tbl_syarat_sempro,
				tbl_nilai_sempro
				WHERE tbl_nilai_sempro.id_syarat_sempro = tbl_syarat_sempro.id_syarat_sempro AND
				tbl_syarat_sempro.status 	 			= 'Tersedia' AND
				tbl_nilai_sempro.status 				= 'Tersedia'
				");

			return $hasil;
		}

		function get_row_data_skripsi($id_syarat_sempro){
			$topik_relasi = 'Tandatangan SK Penguji Skripsi oleh Dekan';
			$hasil = $this->db->query("	SELECT * FROM 
				tbl_mahasiswa, 
				tbl_syarat_sempro, 
				tbl_seminar,
				tb_prodi,
				tbl_persetujuan_sempro,
				tbl_ttd_surat,
				tbl_nomor_surat,
				tb_dosen,
				tbl_dospem_skripsi,
				tbl_penguji_skripsi,
				tbl_skripsi
				WHERE 
				tbl_mahasiswa.npm 						= tbl_syarat_sempro.npm AND
				tbl_mahasiswa.npm 						= tbl_skripsi.npm AND
				tbl_mahasiswa.kode_prodi 				= tb_prodi.kode_prodi AND
				tbl_syarat_sempro.id_seminar 			= tbl_seminar.id_seminar AND
				tbl_penguji_skripsi.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND
				tbl_dospem_skripsi.id_skripsi 			= tbl_skripsi.id_skripsi AND
				tbl_ttd_surat.topik_relasi 				= '$topik_relasi' AND
				tbl_nomor_surat.fungsi_nomor			= 'SK Penguji Skripsi' AND   
				tbl_syarat_sempro.id_syarat_sempro 		= '$id_syarat_sempro' AND
				tbl_persetujuan_sempro.id_syarat_sempro	= tbl_syarat_sempro.id_syarat_sempro AND
                 tbl_syarat_sempro.id_syarat_sempro 	= tbl_ttd_surat.id_relasi AND
                tbl_syarat_sempro.id_syarat_sempro 		= tbl_nomor_surat.id_relasi AND

				tb_prodi.status 						!= 'Dihapus' AND
				tbl_dospem_skripsi.status 				!= 'Dihapus' AND
				tbl_penguji_skripsi.status 				!= 'Dihapus' AND
				tbl_seminar.status 						= 'Tersedia' AND
				tbl_syarat_sempro.status 				= 'Tersedia' AND
				tbl_ttd_surat.status 					= 'Tersedia' AND
				tbl_nomor_surat.status 					= 'Tersedia' AND
				tbl_mahasiswa.status 					= 'Aktif' AND
				tbl_persetujuan_sempro.status 			= 'Tersedia' AND
				tbl_skripsi.status 						= 'Tersedia' AND
				tbl_persetujuan_sempro.tema_persetujuan = 'Pengecekan Berkas Persyaratan Sempro Mahasiswa oleh Tata Usaha' 
				");

			return $hasil->row();
		}
	}
	?>