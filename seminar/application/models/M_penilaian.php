<?php 

class M_penilaian extends CI_Model
{
	function nilai_sempro($id_syarat_sempro, $posisi, $npk, $pendahuluan, $saran_pendahuluan, $tinjauan, $saran_tinjauan, $metodologi, $saran_metodologi, $referensi, $saran_referensi, $sistematika, $saran_sistematika, $presentasi, $saran_presentasi ){
		$hasil=$this->db->query(
			"INSERT INTO tbl_nilai_sempro (
			id_syarat_sempro,
			posisi,
			npk,
			pendahuluan,
			saran_pendahuluan,
			tinjauan,
			saran_tinjauan,
			metodologi,
			saran_metodologi,
			referensi,
			saran_referensi,
			sistematika,
			saran_sistematika,
			presentasi,
			saran_presentasi,
			status) 
			VALUES ( 
			'$id_syarat_sempro', 
			'$posisi', 
			'$npk', 
			'$pendahuluan', 
			'$saran_pendahuluan',
			'$tinjauan',
			'$saran_tinjauan',
			'$metodologi',
			'$saran_metodologi',
			'$referensi',
			'$saran_referensi',
			'$sistematika',
			'$saran_sistematika',
			'$presentasi',
			'$saran_presentasi',
			'Tersedia')");
		return $hasil;
	}

	function nilai_kompre($id_syarat_kompre, $posisi, $npk, $abstrak, $saran_abstrak,	$pendahuluan, $saran_pendahuluan, $tinjauan, $saran_tinjauan, $metodologi, $saran_metodologi, $hasil, $saran_hasil, $kesimpulan, $saran_kesimpulan, $referensi, $saran_referensi, $sistematika, $saran_sistematika, $presentasi, $saran_presentasi ){
		$hasil=$this->db->query(
			"INSERT INTO tbl_nilai_kompre (
			id_syarat_kompre,
			posisi,
			npk,
			abstrak,
			saran_abstrak,
			pendahuluan,
			saran_pendahuluan,
			tinjauan,
			saran_tinjauan,
			metodologi,
			saran_metodologi,
			hasil,
			saran_hasil,
			kesimpulan,
			saran_kesimpulan,
			referensi,
			saran_referensi,
			sistematika,
			saran_sistematika,
			presentasi,
			saran_presentasi,
			status) 
			VALUES ( 
			'$id_syarat_kompre', 
			'$posisi', 
			'$npk', 
			'$abstrak', 
			'$saran_abstrak',
			'$pendahuluan', 
			'$saran_pendahuluan',
			'$tinjauan',
			'$saran_tinjauan',
			'$metodologi',
			'$saran_metodologi',
			'$hasil',
			'$saran_hasil',
			'$kesimpulan',
			'$saran_kesimpulan',
			'$referensi',
			'$saran_referensi',
			'$sistematika',
			'$saran_sistematika',
			'$presentasi',
			'$saran_presentasi',
			'Tersedia')");
		return $hasil;
	}

	function cekResponNilai($id_syarat_sempro, $npk){
		$hasil=$this->db->query("SELECT * FROM  
			tbl_mahasiswa,
			tbl_nilai_sempro, 
			tbl_syarat_sempro
			WHERE 
			tbl_mahasiswa.npm 					= tbl_syarat_sempro.npm AND
			tbl_nilai_sempro.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND
			tbl_syarat_sempro.id_syarat_sempro 	= '$id_syarat_sempro' AND
			
			tbl_mahasiswa.status 				= 'Aktif' AND
			tbl_syarat_sempro.status 			= 'Tersedia' AND
			tbl_nilai_sempro.status 			= 'Tersedia' AND
			tbl_nilai_sempro.npk 				= '$npk'");
		return $hasil->num_rows();
	}

	function cekResponNilaiKompre($id_syarat_kompre, $npk){
		$hasil=$this->db->query("SELECT * FROM  
			tbl_mahasiswa,
			tbl_nilai_kompre, 
			tbl_syarat_kompre
			WHERE 
			tbl_mahasiswa.npm 					= tbl_syarat_kompre.npm AND
			tbl_nilai_kompre.id_syarat_kompre 	= tbl_syarat_kompre.id_syarat_kompre AND
			tbl_syarat_kompre.id_syarat_kompre 	= '$id_syarat_kompre' AND
			
			tbl_mahasiswa.status 				= 'Aktif' AND
			tbl_syarat_kompre.status 			= 'Tersedia' AND
			tbl_nilai_kompre.status 			= 'Tersedia' AND
			tbl_nilai_kompre.npk 				= '$npk'");
		return $hasil->num_rows();
	}

	public function cekNilaiPembimbing($id_syarat_sempro){
		$hasil=$this->db->query(
			"SELECT * FROM  
			tbl_mahasiswa,
			tbl_nilai_sempro, 
			tbl_syarat_sempro
			WHERE 
			tbl_mahasiswa.npm 					= tbl_syarat_sempro.npm AND
			tbl_nilai_sempro.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND
			tbl_syarat_sempro.id_syarat_sempro 	= '$id_syarat_sempro' AND
			tbl_mahasiswa.status 				= 'Aktif' AND
			tbl_syarat_sempro.status 			= 'Tersedia' AND
			tbl_nilai_sempro.status 			= 'Tersedia' 
			")->num_rows();
		return $hasil;
	}

	public function show_nilai(){
		$hasil=$this->db->query(
			"SELECT * FROM  
			tbl_mahasiswa,
			tbl_nilai_sempro, 
			tbl_syarat_sempro
			WHERE 
			tbl_mahasiswa.npm 					= tbl_syarat_sempro.npm AND
			tbl_nilai_sempro.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND
			tbl_mahasiswa.status 				= 'Aktif' AND
			tbl_syarat_sempro.status 			= 'Tersedia' AND
			tbl_nilai_sempro.status 			= 'Tersedia' 
			")->num_rows();
		return $hasil;
	}

	function get_nilai($id_syarat_sempro, $item, $posisi){
		$baris_nilai2 = $this->db->query(
			"SELECT * FROM tbl_nilai_sempro, tbl_syarat_sempro 
			WHERE 	tbl_nilai_sempro.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND 
			tbl_nilai_sempro.status 		 			='Tersedia' AND
			tbl_syarat_sempro.id_syarat_sempro 			= '$id_syarat_sempro' AND
			tbl_nilai_sempro.posisi 					= '$posisi' AND
			tbl_syarat_sempro.status 					= 'Tersedia'")->row();

		if ($baris_nilai2) {
			return $baris_nilai2->$item;
		}else{
			return 'Maaf, ada kesalahan';
		}

	}

	function get_nilai_kompre($id_syarat_kompre, $item, $posisi){
		$baris_nilai3 = $this->db->query(
			"SELECT * FROM tbl_nilai_kompre, tbl_syarat_kompre 
			WHERE 	tbl_nilai_kompre.id_syarat_kompre 	= tbl_syarat_kompre.id_syarat_kompre AND 
			tbl_nilai_kompre.status 		 			='Tersedia' AND
			tbl_syarat_kompre.id_syarat_kompre 			= '$id_syarat_kompre' AND
			tbl_nilai_kompre.posisi 					= '$posisi' AND
			tbl_syarat_kompre.status 					= 'Tersedia'")->row();

		if ($baris_nilai3) {
			return $baris_nilai3->$item;
		}else{
			return 'Maaf, ada kesalahan';
		}

	}

	// function get_nilai_prodi($id_syarat_sempro, $item){
	// 	$baris_nilai2 = $this->db->query(
	// 		"SELECT * FROM tbl_nilai_sempro, tbl_syarat_sempro 
	// 		WHERE 	tbl_nilai_sempro.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND 
	// 		tbl_nilai_sempro.status 		 			='Tersedia' AND
	// 		tbl_syarat_sempro.id_syarat_sempro 			= '$id_syarat_sempro' AND
	// 		tbl_syarat_sempro.status 					= 'Tersedia'")->row();

	// 	if ($baris_nilai2) {
	// 		return $baris_nilai2->$item;
	// 	}else{
	// 		return 'Maaf, ada kesalahan';
	// 	}

	// }

	public function cekNilaiSempro($id_syarat_sempro, $posisi){
		$hasil=$this->db->query(
			"SELECT * FROM  
			tbl_mahasiswa,
			tbl_nilai_sempro, 
			tbl_syarat_sempro
			WHERE 
			tbl_mahasiswa.npm 					= tbl_syarat_sempro.npm AND
			tbl_nilai_sempro.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND
			tbl_syarat_sempro.id_syarat_sempro 	= '$id_syarat_sempro' AND
			tbl_nilai_sempro.posisi 			= '$posisi' AND
			
			tbl_mahasiswa.status 				= 'Aktif' AND
			tbl_syarat_sempro.status 			= 'Tersedia' AND
			tbl_nilai_sempro.status 			= 'Tersedia' 
			")->num_rows();
		return $hasil;
	}

	public function cekNilaiKompre($id_syarat_kompre, $posisi){
		$hasil=$this->db->query(
			"SELECT * FROM  
			tbl_mahasiswa,
			tbl_nilai_kompre, 
			tbl_syarat_kompre
			WHERE 
			tbl_mahasiswa.npm 					= tbl_syarat_kompre.npm AND
			tbl_nilai_kompre.id_syarat_kompre 	= tbl_syarat_kompre.id_syarat_kompre AND
			tbl_syarat_kompre.id_syarat_kompre 	= '$id_syarat_kompre' AND
			tbl_nilai_kompre.posisi 			= '$posisi' AND
			
			tbl_mahasiswa.status 				= 'Aktif' AND
			tbl_syarat_kompre.status 			= 'Tersedia' AND
			tbl_nilai_kompre.status 			= 'Tersedia' 
			")->num_rows();
		return $hasil;
	}

	public function cekPosisi($npk, $posisi){
		$hasil=$this->db->query(
			"SELECT * FROM  
			tbl_mahasiswa,
			tbl_nilai_sempro, 
			tbl_syarat_sempro,
			tbl_penguji_skripsi
			WHERE 
			tbl_mahasiswa.npm 					= tbl_syarat_sempro.npm AND
			tbl_nilai_sempro.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND
			tbl_penguji_skripsi.npk 			= '$npk' AND
			tbl_penguji_skripsi.posisi 			= 'Penguji 1' AND

			tbl_mahasiswa.status 				= 'Aktif' AND
			tbl_syarat_sempro.status 			= 'Tersedia' AND
			tbl_penguji_skripsi.status 			= 'Tersedia' AND
			tbl_nilai_sempro.status 			= 'Tersedia' 
			")->num_rows();
		return $hasil;
	}

	public function cekPosisiKompre($npk, $posisi){
		$hasil=$this->db->query(
			"SELECT * FROM  
			tbl_mahasiswa,
			tbl_nilai_kompre, 
			tbl_syarat_kompre, 
			tbl_penguji_skripsi
			WHERE 
			tbl_mahasiswa.npm 					= tbl_syarat_kompre.npm AND
			tbl_nilai_kompre.id_syarat_kompre 	= tbl_syarat_kompre.id_syarat_kompre AND
			tbl_penguji_skripsi.npk 			= '$npk' AND
			tbl_penguji_skripsi.posisi 			= 'Penguji 1' AND

			tbl_mahasiswa.status 				= 'Aktif' AND
			tbl_syarat_kompre.status 			= 'Tersedia' AND
			tbl_penguji_skripsi.status 			= 'Tersedia' AND
			tbl_nilai_kompre.status 			= 'Tersedia' 
			")->num_rows();
		return $hasil;
	}

	// NILAI SEMPRO
	function NilaiSemproPembimbing($id_syarat_sempro){
		$baris_nilai1 = $this->db->query(
			"SELECT * FROM tbl_nilai_sempro, tbl_syarat_sempro 
			WHERE 	tbl_nilai_sempro.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND 
			tbl_nilai_sempro.status 					= 'Tersedia' AND
			tbl_syarat_sempro.id_syarat_sempro 			= '$id_syarat_sempro' AND
			tbl_nilai_sempro.posisi 					= 'Pembimbing' AND
			tbl_syarat_sempro.status 					= 'Tersedia'")->row();

		if ($baris_nilai1) {
			$pendahuluan1 	= $baris_nilai1->pendahuluan;
			$tinjauan1 		= $baris_nilai1->tinjauan;
			$metodologi1 	= $baris_nilai1->metodologi;
			$referensi1 	= $baris_nilai1->referensi;
			$sistematika1 	= $baris_nilai1->sistematika;
			$presentasi1 	= $baris_nilai1->presentasi;
			$jumlah1 		= (($pendahuluan1*20)/100) + 
			(($tinjauan1*15)/100) +  
			(($metodologi1*25)/100) +
			(($referensi1*10)/100) +
			(($sistematika1*5)/100) +
			(($presentasi1*25)/100) 
			;
			return $jumlah1;
		}else{
			return 0;
		}
	}

	function NilaiSemproPenguji1($id_syarat_sempro){
		$baris_nilai2 = $this->db->query(
			"SELECT * FROM tbl_nilai_sempro, tbl_syarat_sempro 
			WHERE 	tbl_nilai_sempro.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND 
			tbl_nilai_sempro.status 					= 'Tersedia' AND
			tbl_syarat_sempro.id_syarat_sempro 			= '$id_syarat_sempro' AND
			tbl_nilai_sempro.posisi 					= 'Penguji 1' AND
			tbl_syarat_sempro.status 					= 'Tersedia'")->row();

		if ($baris_nilai2) {
			$pendahuluan2 	= $baris_nilai2->pendahuluan;
			$tinjauan2 		= $baris_nilai2->tinjauan;
			$metodologi2 	= $baris_nilai2->metodologi;
			$referensi2 	= $baris_nilai2->referensi;
			$sistematika2 	= $baris_nilai2->sistematika;
			$presentasi2 	= $baris_nilai2->presentasi;
			$jumlah2 		= (($pendahuluan2*20)/100) + 
			(($tinjauan2*15)/100) +  
			(($metodologi2*25)/100) +
			(($referensi2*10)/100) +
			(($sistematika2*5)/100) +
			(($presentasi2*25)/100) 
			;
			return $jumlah2;
		}else{
			return 0;
		}
	}

	function NilaiSemproPenguji2($id_syarat_sempro){
		$baris_nilai3 = $this->db->query(
			"SELECT * FROM tbl_nilai_sempro, tbl_syarat_sempro 
			WHERE 	tbl_nilai_sempro.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND 
			tbl_nilai_sempro.status 					= 'Tersedia' AND
			tbl_syarat_sempro.id_syarat_sempro 			= '$id_syarat_sempro' AND
			tbl_nilai_sempro.posisi 					= 'Penguji 2' AND
			tbl_syarat_sempro.status 					= 'Tersedia'")->row();

		if ($baris_nilai3) {
			$pendahuluan3 	= $baris_nilai3->pendahuluan;
			$tinjauan3 		= $baris_nilai3->tinjauan;
			$metodologi3 	= $baris_nilai3->metodologi;
			$referensi3 	= $baris_nilai3->referensi;
			$sistematika3 	= $baris_nilai3->sistematika;
			$presentasi3 	= $baris_nilai3->presentasi;
			$jumlah3 		= (($pendahuluan3*20)/100) + 
			(($tinjauan3*15)/100) +  
			(($metodologi3*25)/100) +
			(($referensi3*10)/100) +
			(($sistematika3*5)/100) +
			(($presentasi3*25)/100) 
			;
			return $jumlah3;
		}else{
			return 0;
		}
	}

	function cekResponPembimbingSempro($id_syarat_sempro){
		return $this->db->query(
			"SELECT * FROM tbl_nilai_sempro, tbl_syarat_sempro 
			WHERE 	tbl_nilai_sempro.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND 
			tbl_nilai_sempro.status 					= 'Tersedia' AND
			tbl_syarat_sempro.id_syarat_sempro 			= '$id_syarat_sempro' AND
			tbl_nilai_sempro.posisi 					= 'Pembimbing' AND
			tbl_syarat_sempro.status 					= 'Tersedia'")->num_rows();
	}

	function cekResponPenguji1Sempro($id_syarat_sempro){
		return $this->db->query(
			"SELECT * FROM tbl_nilai_sempro, tbl_syarat_sempro 
			WHERE 	tbl_nilai_sempro.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND 
			tbl_nilai_sempro.status 					= 'Tersedia' AND
			tbl_syarat_sempro.id_syarat_sempro 			= '$id_syarat_sempro' AND
			tbl_nilai_sempro.posisi 					= 'Penguji 1' AND
			tbl_syarat_sempro.status 					= 'Tersedia'")->num_rows();
	}

	function cekResponPenguji2Sempro($id_syarat_sempro){
		return $this->db->query(
			"SELECT * FROM tbl_nilai_sempro, tbl_syarat_sempro 
			WHERE 	tbl_nilai_sempro.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND 
			tbl_nilai_sempro.status 					= 'Tersedia' AND
			tbl_syarat_sempro.id_syarat_sempro 			= '$id_syarat_sempro' AND
			tbl_nilai_sempro.posisi 					= 'Penguji 2' AND
			tbl_syarat_sempro.status 					= 'Tersedia'")->num_rows();
	}

	function kalkulasiNilaiSempro($id_syarat_sempro){
		$baris_nilai1 = $this->db->query(
			"SELECT * FROM tbl_nilai_sempro, tbl_syarat_sempro 
			WHERE 	tbl_nilai_sempro.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND 
			tbl_nilai_sempro.status 					= 'Tersedia' AND
			tbl_syarat_sempro.id_syarat_sempro 			= '$id_syarat_sempro' AND
			tbl_nilai_sempro.posisi 					= 'Pembimbing' AND
			tbl_syarat_sempro.status 					= 'Tersedia'")->row();

		$pendahuluan1 	= $baris_nilai1->pendahuluan;
		$tinjauan1 		= $baris_nilai1->tinjauan;
		$metodologi1 	= $baris_nilai1->metodologi;
		$referensi1 	= $baris_nilai1->referensi;
		$sistematika1 	= $baris_nilai1->sistematika;
		$presentasi1 	= $baris_nilai1->presentasi;

		$jumlah1 		= (($pendahuluan1*20)/100) + 
		(($tinjauan1*15)/100) +  
		(($metodologi1*25)/100) +
		(($referensi1*10)/100) +
		(($sistematika1*5)/100) +
		(($presentasi1*25)/100) ;
		$persentase1 	= $jumlah1 * 50/ 100;

		$baris_nilai2 = $this->db->query(
			"SELECT * FROM tbl_nilai_sempro, tbl_syarat_sempro 
			WHERE 	tbl_nilai_sempro.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND 
			tbl_nilai_sempro.status 					= 'Tersedia' AND
			tbl_syarat_sempro.id_syarat_sempro 			= '$id_syarat_sempro' AND
			tbl_nilai_sempro.posisi 					= 'Penguji 1' AND
			tbl_syarat_sempro.status 					= 'Tersedia'")->row();

		$pendahuluan2 	= $baris_nilai2->pendahuluan;
		$tinjauan2 		= $baris_nilai2->tinjauan;
		$metodologi2 	= $baris_nilai2->metodologi;
		$referensi2 	= $baris_nilai2->referensi;
		$sistematika2 	= $baris_nilai2->sistematika;
		$presentasi2 	= $baris_nilai2->presentasi;

		$jumlah2 		= (($pendahuluan2*20)/100) + 
		(($tinjauan2*15)/100) +  
		(($metodologi2*25)/100) +
		(($referensi2*10)/100) +
		(($sistematika2*5)/100) +
		(($presentasi2*25)/100);
		$persentase2 	= $jumlah2 * 25/ 100;

		$baris_nilai3 = $this->db->query(
			"SELECT * FROM tbl_nilai_sempro, tbl_syarat_sempro 
			WHERE 	tbl_nilai_sempro.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND 
			tbl_nilai_sempro.status 					= 'Tersedia' AND
			tbl_syarat_sempro.id_syarat_sempro 			= '$id_syarat_sempro' AND
			tbl_nilai_sempro.posisi 					= 'Penguji 2' AND
			tbl_syarat_sempro.status 					= 'Tersedia'")->row();

		$pendahuluan3 	= $baris_nilai3->pendahuluan;
		$tinjauan3 		= $baris_nilai3->tinjauan;
		$metodologi3 	= $baris_nilai3->metodologi;
		$referensi3 	= $baris_nilai3->referensi;
		$sistematika3 	= $baris_nilai3->sistematika;
		$presentasi3 	= $baris_nilai3->presentasi;
		$jumlah3 		= (($pendahuluan3*20)/100) + 
		(($tinjauan3*15)/100) +  
		(($metodologi3*25)/100) +
		(($referensi3*10)/100) +
		(($sistematika3*5)/100) +
		(($presentasi3*25)/100) ;
		$persentase3 	= $jumlah3 * 25/ 100;

		return $persentase1+$persentase2+$persentase3;

	}

		// NILAI KOMPRE
	function NilaiKomprePembimbing($id_syarat_kompre){
		$baris_nilai11 = $this->db->query(
			"SELECT * FROM tbl_nilai_kompre, tbl_syarat_kompre 
			WHERE 	tbl_nilai_kompre.id_syarat_kompre 	= tbl_syarat_kompre.id_syarat_kompre AND 
			tbl_nilai_kompre.status 					= 'Tersedia' AND
			tbl_syarat_kompre.id_syarat_kompre 			= '$id_syarat_kompre' AND
			tbl_nilai_kompre.posisi 					= 'Pembimbing' AND
			tbl_syarat_kompre.status 					= 'Tersedia'")->row();

		if ($baris_nilai11) {
			$abstrak11 		= $baris_nilai11->abstrak;
			$pendahuluan11 	= $baris_nilai11->pendahuluan;
			$tinjauan11 	= $baris_nilai11->tinjauan;
			$metodologi11 	= $baris_nilai11->metodologi;
			$hasil11 		= $baris_nilai11->hasil;
			$kesimpulan11 	= $baris_nilai11->kesimpulan;
			$referensi11 	= $baris_nilai11->referensi;
			$sistematika11 	= $baris_nilai11->sistematika;
			$presentasi11 	= $baris_nilai11->presentasi;
			$jumlah11 		= (($abstrak11*5)/100) + 
			(($pendahuluan11*10)/100) +  
			(($tinjauan11*5)/100) +  
			(($metodologi11*15)/100) +
			(($hasil11*25)/100) +
			(($kesimpulan11*10)/100) +
			(($referensi11*5)/100) +
			(($sistematika11*5)/100) +
			(($presentasi11*20)/100) ;
			return $jumlah11;
		}else{
			return 0;
		}
	}

	function NilaiKomprePenguji1($id_syarat_kompre){
		$baris_nilai22 = $this->db->query(
			"SELECT * FROM tbl_nilai_kompre, tbl_syarat_kompre 
			WHERE 	tbl_nilai_kompre.id_syarat_kompre 	= tbl_syarat_kompre.id_syarat_kompre AND 
			tbl_nilai_kompre.status 					= 'Tersedia' AND
			tbl_syarat_kompre.id_syarat_kompre 			= '$id_syarat_kompre' AND
			tbl_nilai_kompre.posisi 					= 'Penguji 1' AND
			tbl_syarat_kompre.status 					= 'Tersedia'")->row();

		if ($baris_nilai22) {
			$abstrak22 		= $baris_nilai22->abstrak;
			$pendahuluan22 	= $baris_nilai22->pendahuluan;
			$tinjauan22 	= $baris_nilai22->tinjauan;
			$metodologi22 	= $baris_nilai22->metodologi;
			$hasil22 		= $baris_nilai22->hasil;
			$kesimpulan22 	= $baris_nilai22->kesimpulan;
			$referensi22 	= $baris_nilai22->referensi;
			$sistematika22 	= $baris_nilai22->sistematika;
			$presentasi22 	= $baris_nilai22->presentasi;
			$jumlah22 		= (($abstrak22*5)/100) + 
			(($pendahuluan22*10)/100) +  
			(($tinjauan22*5)/100) +  
			(($metodologi22*15)/100) +
			(($hasil22*25)/100) +
			(($kesimpulan22*10)/100) +
			(($referensi22*5)/100) +
			(($sistematika22*5)/100) +
			(($presentasi22*20)/100) ;
			return $jumlah22;
		}else{
			return 0;
		}
	}

	function NilaiKomprePenguji2($id_syarat_kompre){
		$baris_nilai33 = $this->db->query(
			"SELECT * FROM tbl_nilai_kompre, tbl_syarat_kompre 
			WHERE 	tbl_nilai_kompre.id_syarat_kompre 	= tbl_syarat_kompre.id_syarat_kompre AND 
			tbl_nilai_kompre.status 					= 'Tersedia' AND
			tbl_syarat_kompre.id_syarat_kompre 			= '$id_syarat_kompre' AND
			tbl_nilai_kompre.posisi 					= 'Penguji 2' AND
			tbl_syarat_kompre.status 					= 'Tersedia'")->row();

		if ($baris_nilai33) {
			$abstrak33 			= $baris_nilai33->abstrak;
			$pendahuluan33 	= $baris_nilai33->pendahuluan;
			$tinjauan33 	= $baris_nilai33->tinjauan;
			$metodologi33 	= $baris_nilai33->metodologi;
			$hasil33 		= $baris_nilai33->hasil;
			$kesimpulan33 	= $baris_nilai33->kesimpulan;
			$referensi33 	= $baris_nilai33->referensi;
			$sistematika33 	= $baris_nilai33->sistematika;
			$presentasi33 	= $baris_nilai33->presentasi;
			$jumlah33 		= (($abstrak33*5)/100) + 
			(($pendahuluan33*10)/100) +  
			(($tinjauan33*5)/100) +  
			(($metodologi33*15)/100) +
			(($hasil33*25)/100) +
			(($kesimpulan33*10)/100) +
			(($referensi33*5)/100) +
			(($sistematika33*5)/100) +
			(($presentasi33*20)/100) ;
			return $jumlah33;
		}else{
			return 0;
		}
	}

	function cekResponPembimbingKompre($id_syarat_kompre){
		return $this->db->query(
			"SELECT * FROM tbl_nilai_kompre, tbl_syarat_kompre 
			WHERE 	tbl_nilai_kompre.id_syarat_kompre 	= tbl_syarat_kompre.id_syarat_kompre AND 
			tbl_nilai_kompre.status 					= 'Tersedia' AND
			tbl_syarat_kompre.id_syarat_kompre 			= '$id_syarat_kompre' AND
			tbl_nilai_kompre.posisi 					= 'Pembimbing' AND
			tbl_syarat_kompre.status 					= 'Tersedia'")->num_rows();
	}

	function cekResponPenguji1Kompre($id_syarat_kompre){
		return $this->db->query(
			"SELECT * FROM tbl_nilai_kompre, tbl_syarat_kompre 
			WHERE 	tbl_nilai_kompre.id_syarat_kompre 	= tbl_syarat_kompre.id_syarat_kompre AND 
			tbl_nilai_kompre.status 					= 'Tersedia' AND
			tbl_syarat_kompre.id_syarat_kompre 			= '$id_syarat_kompre' AND
			tbl_nilai_kompre.posisi 					= 'Penguji 1' AND
			tbl_syarat_kompre.status 					= 'Tersedia'")->num_rows();
	}

	function cekResponPenguji2Kompre($id_syarat_kompre){
		return $this->db->query(
			"SELECT * FROM tbl_nilai_kompre, tbl_syarat_kompre 
			WHERE 	tbl_nilai_kompre.id_syarat_kompre 	= tbl_syarat_kompre.id_syarat_kompre AND 
			tbl_nilai_kompre.status 					= 'Tersedia' AND
			tbl_syarat_kompre.id_syarat_kompre 			= '$id_syarat_kompre' AND
			tbl_nilai_kompre.posisi 					= 'Penguji 2' AND
			tbl_syarat_kompre.status 					= 'Tersedia'")->num_rows();
	}

	function kalkulasiNilaiKompre($id_syarat_kompre){
		$baris_nilai11 = $this->db->query(
			"SELECT * FROM tbl_nilai_kompre, tbl_syarat_kompre 
			WHERE 	tbl_nilai_kompre.id_syarat_kompre 	= tbl_syarat_kompre.id_syarat_kompre AND 
			tbl_nilai_kompre.status 					= 'Tersedia' AND
			tbl_syarat_kompre.id_syarat_kompre 			= '$id_syarat_kompre' AND
			tbl_nilai_kompre.posisi 					= 'Pembimbing' AND
			tbl_syarat_kompre.status 					= 'Tersedia'")->row();

		$abstrak11 		= $baris_nilai11->abstrak;
		$pendahuluan11 	= $baris_nilai11->pendahuluan;
		$tinjauan11 	= $baris_nilai11->tinjauan;
		$metodologi11 	= $baris_nilai11->metodologi;
		$hasil11 		= $baris_nilai11->hasil;
		$kesimpulan11 	= $baris_nilai11->kesimpulan;
		$referensi11 	= $baris_nilai11->referensi;
		$sistematika11 	= $baris_nilai11->sistematika;
		$presentasi11 	= $baris_nilai11->presentasi;
		$jumlah11 		= (($abstrak11*5)/100) + 
		(($pendahuluan11*10)/100) +  
		(($tinjauan11*5)/100) +  
		(($metodologi11*15)/100) +
		(($hasil11*25)/100) +
		(($kesimpulan11*10)/100) +
		(($referensi11*5)/100) +
		(($sistematika11*5)/100) +
		(($presentasi11*20)/100) ;

		$persentase11 	= $jumlah11 * 50/ 100;

		$baris_nilai22 = $this->db->query(
			"SELECT * FROM tbl_nilai_kompre, tbl_syarat_kompre 
			WHERE 	tbl_nilai_kompre.id_syarat_kompre 	= tbl_syarat_kompre.id_syarat_kompre AND 
			tbl_nilai_kompre.status 					= 'Tersedia' AND
			tbl_syarat_kompre.id_syarat_kompre 			= '$id_syarat_kompre' AND
			tbl_nilai_kompre.posisi 					= 'Penguji 1' AND
			tbl_syarat_kompre.status 					= 'Tersedia'")->row();

		$abstrak22 		= $baris_nilai22->abstrak;
		$pendahuluan22 	= $baris_nilai22->pendahuluan;
		$tinjauan22 	= $baris_nilai22->tinjauan;
		$metodologi22 	= $baris_nilai22->metodologi;
		$hasil22 		= $baris_nilai22->hasil;
		$kesimpulan22 	= $baris_nilai22->kesimpulan;
		$referensi22 	= $baris_nilai22->referensi;
		$sistematika22 	= $baris_nilai22->sistematika;
		$presentasi22 	= $baris_nilai22->presentasi;
		$jumlah22 		= (($abstrak22*5)/100) + 
		(($pendahuluan22*10)/100) +  
		(($tinjauan22*5)/100) +  
		(($metodologi22*15)/100) +
		(($hasil22*25)/100) +
		(($kesimpulan22*10)/100) +
		(($referensi22*5)/100) +
		(($sistematika22*5)/100) +
		(($presentasi22*20)/100) ;

		$persentase22 	= $jumlah22 * 25/ 100;

		$baris_nilai33 = $this->db->query(
			"SELECT * FROM tbl_nilai_kompre, tbl_syarat_kompre 
			WHERE 	tbl_nilai_kompre.id_syarat_kompre 	= tbl_syarat_kompre.id_syarat_kompre AND 
			tbl_nilai_kompre.status 					= 'Tersedia' AND
			tbl_syarat_kompre.id_syarat_kompre 			= '$id_syarat_kompre' AND
			tbl_nilai_kompre.posisi 					= 'Penguji 2' AND
			tbl_syarat_kompre.status 					= 'Tersedia'")->row();

		$abstrak33 		= $baris_nilai33->abstrak;
		$pendahuluan33 	= $baris_nilai33->pendahuluan;
		$tinjauan33 	= $baris_nilai33->tinjauan;
		$metodologi33 	= $baris_nilai33->metodologi;
		$hasil33 		= $baris_nilai33->hasil;
		$kesimpulan33 	= $baris_nilai33->kesimpulan;
		$referensi33 	= $baris_nilai33->referensi;
		$sistematika33 	= $baris_nilai33->sistematika;
		$presentasi33 	= $baris_nilai33->presentasi;
		$jumlah33 		= (($abstrak33*5)/100) + 
		(($pendahuluan33*10)/100) +  
		(($tinjauan33*5)/100) +  
		(($metodologi33*15)/100) +
		(($hasil33*25)/100) +
		(($kesimpulan33*10)/100) +
		(($referensi33*5)/100) +
		(($sistematika33*5)/100) +
		(($presentasi33*20)/100) ;
		$persentase33 	= $jumlah33 * 25/ 100;

		return $persentase11+$persentase22+$persentase33;

	}

	function cekNilaiSkripsi($id_syarat_sempro, $id_syarat_kompre){
		return $this->db->query(
			"SELECT * FROM tbl_nilai_kompre, tbl_syarat_kompre, tbl_nilai_sempro, tbl_syarat_sempro
			WHERE tbl_nilai_kompre.id_syarat_kompre 	= tbl_syarat_kompre.id_syarat_kompre AND 
			tbl_nilai_sempro.id_syarat_sempro 			= tbl_syarat_sempro.id_syarat_sempro AND 
			tbl_nilai_sempro.status 					= 'Tersedia' AND
			tbl_nilai_kompre.status 					= 'Tersedia' AND
			tbl_syarat_kompre.id_syarat_kompre 			= '$id_syarat_kompre' AND
			tbl_syarat_sempro.id_syarat_sempro 			= '$id_syarat_sempro' AND
			tbl_nilai_kompre.posisi 					= 'Pembimbing' AND
			tbl_nilai_kompre.posisi 					= 'Penguji 1' AND
			tbl_nilai_kompre.posisi 					= 'Penguji 2' AND
			tbl_nilai_sempro.posisi 					= 'Pembimbing' AND
			tbl_nilai_sempro.posisi 					= 'Penguji 1' AND
			tbl_nilai_sempro.posisi 					= 'Penguji 2' AND
			tbl_syarat_sempro.status 					= 'Tersedia' AND
			tbl_syarat_kompre.status 					= 'Tersedia'
			")->num_rows();
	}

	function NilaiSkripsi($id_syarat_sempro, $id_syarat_kompre){
		// SEMINAR PROPOSALL
		// PEMBIMBING SEMPRO
		$baris_nilai1 = $this->db->query(
			"SELECT * FROM tbl_nilai_sempro, tbl_syarat_sempro 
			WHERE 	tbl_nilai_sempro.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND 
			tbl_nilai_sempro.status 					= 'Tersedia' AND
			tbl_syarat_sempro.id_syarat_sempro 			= '$id_syarat_sempro' AND
			tbl_nilai_sempro.posisi 					= 'Pembimbing' AND
			tbl_syarat_sempro.status 					= 'Tersedia'")->row();

		$pendahuluan1 	= $baris_nilai1->pendahuluan;
		$tinjauan1 		= $baris_nilai1->tinjauan;
		$metodologi1 	= $baris_nilai1->metodologi;
		$referensi1 	= $baris_nilai1->referensi;
		$sistematika1 	= $baris_nilai1->sistematika;
		$presentasi1 	= $baris_nilai1->presentasi;

		$jumlah1 		= (($pendahuluan1*20)/100) + 
		(($tinjauan1*15)/100) +  
		(($metodologi1*25)/100) +
		(($referensi1*10)/100) +
		(($sistematika1*5)/100) +
		(($presentasi1*25)/100) ;
		$persentase1 	= $jumlah1 * 50/ 100;

		// PENGUJI 1 SEMPRO
		$baris_nilai2 = $this->db->query(
			"SELECT * FROM tbl_nilai_sempro, tbl_syarat_sempro 
			WHERE 	tbl_nilai_sempro.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND 
			tbl_nilai_sempro.status 					= 'Tersedia' AND
			tbl_syarat_sempro.id_syarat_sempro 			= '$id_syarat_sempro' AND
			tbl_nilai_sempro.posisi 					= 'Penguji 1' AND
			tbl_syarat_sempro.status 					= 'Tersedia'")->row();

		$pendahuluan2 	= $baris_nilai2->pendahuluan;
		$tinjauan2 		= $baris_nilai2->tinjauan;
		$metodologi2 	= $baris_nilai2->metodologi;
		$referensi2 	= $baris_nilai2->referensi;
		$sistematika2 	= $baris_nilai2->sistematika;
		$presentasi2 	= $baris_nilai2->presentasi;

		$jumlah2 		= (($pendahuluan2*20)/100) + 
		(($tinjauan2*15)/100) +  
		(($metodologi2*25)/100) +
		(($referensi2*10)/100) +
		(($sistematika2*5)/100) +
		(($presentasi2*25)/100);
		$persentase2 	= $jumlah2 * 25/ 100;

		// PENGUJI 2 SEMPRO
		$baris_nilai3 = $this->db->query(
			"SELECT * FROM tbl_nilai_sempro, tbl_syarat_sempro 
			WHERE 	tbl_nilai_sempro.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND 
			tbl_nilai_sempro.status 					= 'Tersedia' AND
			tbl_syarat_sempro.id_syarat_sempro 			= '$id_syarat_sempro' AND
			tbl_nilai_sempro.posisi 					= 'Penguji 2' AND
			tbl_syarat_sempro.status 					= 'Tersedia'")->row();

		$pendahuluan3 	= $baris_nilai3->pendahuluan;
		$tinjauan3 		= $baris_nilai3->tinjauan;
		$metodologi3 	= $baris_nilai3->metodologi;
		$referensi3 	= $baris_nilai3->referensi;
		$sistematika3 	= $baris_nilai3->sistematika;
		$presentasi3 	= $baris_nilai3->presentasi;
		$jumlah3 		= (($pendahuluan3*20)/100) + 
		(($tinjauan3*15)/100) +  
		(($metodologi3*25)/100) +
		(($referensi3*10)/100) +
		(($sistematika3*5)/100) +
		(($presentasi3*25)/100) ;
		$persentase3 	= $jumlah3 * 25/ 100;

		// SIDANG AKHIR
		// PEMBIMBING KOMPRE
		$baris_nilai11 = $this->db->query(
			"SELECT * FROM tbl_nilai_kompre, tbl_syarat_kompre 
			WHERE 	tbl_nilai_kompre.id_syarat_kompre 	= tbl_syarat_kompre.id_syarat_kompre AND 
			tbl_nilai_kompre.status 					= 'Tersedia' AND
			tbl_syarat_kompre.id_syarat_kompre 			= '$id_syarat_kompre' AND
			tbl_nilai_kompre.posisi 					= 'Pembimbing' AND
			tbl_syarat_kompre.status 					= 'Tersedia'")->row();

		$abstrak11 		= $baris_nilai11->abstrak;
		$pendahuluan11 	= $baris_nilai11->pendahuluan;
		$tinjauan11 	= $baris_nilai11->tinjauan;
		$metodologi11 	= $baris_nilai11->metodologi;
		$hasil11 		= $baris_nilai11->hasil;
		$kesimpulan11 	= $baris_nilai11->kesimpulan;
		$referensi11 	= $baris_nilai11->referensi;
		$sistematika11 	= $baris_nilai11->sistematika;
		$presentasi11 	= $baris_nilai11->presentasi;
		$jumlah11 		= (($abstrak11*5)/100) + 
		(($pendahuluan11*10)/100) +  
		(($tinjauan11*5)/100) +  
		(($metodologi11*15)/100) +
		(($hasil11*25)/100) +
		(($kesimpulan11*10)/100) +
		(($referensi11*5)/100) +
		(($sistematika11*5)/100) +
		(($presentasi11*20)/100) ;

		$persentase11 	= $jumlah11 * 50/ 100;

		// PENGUJI 1 KOMPRE
		$baris_nilai22 = $this->db->query(
			"SELECT * FROM tbl_nilai_kompre, tbl_syarat_kompre 
			WHERE 	tbl_nilai_kompre.id_syarat_kompre 	= tbl_syarat_kompre.id_syarat_kompre AND 
			tbl_nilai_kompre.status 					= 'Tersedia' AND
			tbl_syarat_kompre.id_syarat_kompre 			= '$id_syarat_kompre' AND
			tbl_nilai_kompre.posisi 					= 'Penguji 1' AND
			tbl_syarat_kompre.status 					= 'Tersedia'")->row();

		$abstrak22 		= $baris_nilai22->abstrak;
		$pendahuluan22 	= $baris_nilai22->pendahuluan;
		$tinjauan22 	= $baris_nilai22->tinjauan;
		$metodologi22 	= $baris_nilai22->metodologi;
		$hasil22 		= $baris_nilai22->hasil;
		$kesimpulan22 	= $baris_nilai22->kesimpulan;
		$referensi22 	= $baris_nilai22->referensi;
		$sistematika22 	= $baris_nilai22->sistematika;
		$presentasi22 	= $baris_nilai22->presentasi;
		$jumlah22 		= (($abstrak22*5)/100) + 
		(($pendahuluan22*10)/100) +  
		(($tinjauan22*5)/100) +  
		(($metodologi22*15)/100) +
		(($hasil22*25)/100) +
		(($kesimpulan22*10)/100) +
		(($referensi22*5)/100) +
		(($sistematika22*5)/100) +
		(($presentasi22*20)/100) ;

		$persentase22 	= $jumlah22 * 25/ 100;

		// PENGUJI 2 KOMPRE
		$baris_nilai33 = $this->db->query(
			"SELECT * FROM tbl_nilai_kompre, tbl_syarat_kompre 
			WHERE 	tbl_nilai_kompre.id_syarat_kompre 	= tbl_syarat_kompre.id_syarat_kompre AND 
			tbl_nilai_kompre.status 					= 'Tersedia' AND
			tbl_syarat_kompre.id_syarat_kompre 			= '$id_syarat_kompre' AND
			tbl_nilai_kompre.posisi 					= 'Penguji 2' AND
			tbl_syarat_kompre.status 					= 'Tersedia'")->row();

		$abstrak33 		= $baris_nilai33->abstrak;
		$pendahuluan33 	= $baris_nilai33->pendahuluan;
		$tinjauan33 	= $baris_nilai33->tinjauan;
		$metodologi33 	= $baris_nilai33->metodologi;
		$hasil33 		= $baris_nilai33->hasil;
		$kesimpulan33 	= $baris_nilai33->kesimpulan;
		$referensi33 	= $baris_nilai33->referensi;
		$sistematika33 	= $baris_nilai33->sistematika;
		$presentasi33 	= $baris_nilai33->presentasi;
		$jumlah33 		= (($abstrak33*5)/100) + 
		(($pendahuluan33*10)/100) +  
		(($tinjauan33*5)/100) +  
		(($metodologi33*15)/100) +
		(($hasil33*25)/100) +
		(($kesimpulan33*10)/100) +
		(($referensi33*5)/100) +
		(($sistematika33*5)/100) +
		(($presentasi33*20)/100) ;
		$persentase33 	= $jumlah33 * 25/ 100;

		return ((($persentase1+$persentase2+$persentase3)*30)/100) + ((($persentase11+$persentase22+$persentase33)*70)/100);
	}

	function Konversi($id_syarat_sempro, $id_syarat_kompre){
		// SEMINAR PROPOSALL
		// PEMBIMBING SEMPRO
		$baris_nilai1 = $this->db->query(
			"SELECT * FROM tbl_nilai_sempro, tbl_syarat_sempro 
			WHERE 	tbl_nilai_sempro.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND 
			tbl_nilai_sempro.status 					= 'Tersedia' AND
			tbl_syarat_sempro.id_syarat_sempro 			= '$id_syarat_sempro' AND
			tbl_nilai_sempro.posisi 					= 'Pembimbing' AND
			tbl_syarat_sempro.status 					= 'Tersedia'")->row();

		$pendahuluan1 	= $baris_nilai1->pendahuluan;
		$tinjauan1 		= $baris_nilai1->tinjauan;
		$metodologi1 	= $baris_nilai1->metodologi;
		$referensi1 	= $baris_nilai1->referensi;
		$sistematika1 	= $baris_nilai1->sistematika;
		$presentasi1 	= $baris_nilai1->presentasi;

		$jumlah1 		= (($pendahuluan1*20)/100) + 
		(($tinjauan1*15)/100) +  
		(($metodologi1*25)/100) +
		(($referensi1*10)/100) +
		(($sistematika1*5)/100) +
		(($presentasi1*25)/100) ;
		$persentase1 	= $jumlah1 * 50/ 100;

		// PENGUJI 1 SEMPRO
		$baris_nilai2 = $this->db->query(
			"SELECT * FROM tbl_nilai_sempro, tbl_syarat_sempro 
			WHERE 	tbl_nilai_sempro.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND 
			tbl_nilai_sempro.status 					= 'Tersedia' AND
			tbl_syarat_sempro.id_syarat_sempro 			= '$id_syarat_sempro' AND
			tbl_nilai_sempro.posisi 					= 'Penguji 1' AND
			tbl_syarat_sempro.status 					= 'Tersedia'")->row();

		$pendahuluan2 	= $baris_nilai2->pendahuluan;
		$tinjauan2 		= $baris_nilai2->tinjauan;
		$metodologi2 	= $baris_nilai2->metodologi;
		$referensi2 	= $baris_nilai2->referensi;
		$sistematika2 	= $baris_nilai2->sistematika;
		$presentasi2 	= $baris_nilai2->presentasi;

		$jumlah2 		= (($pendahuluan2*20)/100) + 
		(($tinjauan2*15)/100) +  
		(($metodologi2*25)/100) +
		(($referensi2*10)/100) +
		(($sistematika2*5)/100) +
		(($presentasi2*25)/100);
		$persentase2 	= $jumlah2 * 25/ 100;

		// PENGUJI 2 SEMPRO
		$baris_nilai3 = $this->db->query(
			"SELECT * FROM tbl_nilai_sempro, tbl_syarat_sempro 
			WHERE 	tbl_nilai_sempro.id_syarat_sempro 	= tbl_syarat_sempro.id_syarat_sempro AND 
			tbl_nilai_sempro.status 					= 'Tersedia' AND
			tbl_syarat_sempro.id_syarat_sempro 			= '$id_syarat_sempro' AND
			tbl_nilai_sempro.posisi 					= 'Penguji 2' AND
			tbl_syarat_sempro.status 					= 'Tersedia'")->row();

		$pendahuluan3 	= $baris_nilai3->pendahuluan;
		$tinjauan3 		= $baris_nilai3->tinjauan;
		$metodologi3 	= $baris_nilai3->metodologi;
		$referensi3 	= $baris_nilai3->referensi;
		$sistematika3 	= $baris_nilai3->sistematika;
		$presentasi3 	= $baris_nilai3->presentasi;
		$jumlah3 		= (($pendahuluan3*20)/100) + 
		(($tinjauan3*15)/100) +  
		(($metodologi3*25)/100) +
		(($referensi3*10)/100) +
		(($sistematika3*5)/100) +
		(($presentasi3*25)/100) ;
		$persentase3 	= $jumlah3 * 25/ 100;

		// SIDANG AKHIR
		// PEMBIMBING KOMPRE
		$baris_nilai11 = $this->db->query(
			"SELECT * FROM tbl_nilai_kompre, tbl_syarat_kompre 
			WHERE 	tbl_nilai_kompre.id_syarat_kompre 	= tbl_syarat_kompre.id_syarat_kompre AND 
			tbl_nilai_kompre.status 					= 'Tersedia' AND
			tbl_syarat_kompre.id_syarat_kompre 			= '$id_syarat_kompre' AND
			tbl_nilai_kompre.posisi 					= 'Pembimbing' AND
			tbl_syarat_kompre.status 					= 'Tersedia'")->row();

		$abstrak11 		= $baris_nilai11->abstrak;
		$pendahuluan11 	= $baris_nilai11->pendahuluan;
		$tinjauan11 	= $baris_nilai11->tinjauan;
		$metodologi11 	= $baris_nilai11->metodologi;
		$hasil11 		= $baris_nilai11->hasil;
		$kesimpulan11 	= $baris_nilai11->kesimpulan;
		$referensi11 	= $baris_nilai11->referensi;
		$sistematika11 	= $baris_nilai11->sistematika;
		$presentasi11 	= $baris_nilai11->presentasi;
		$jumlah11 		= (($abstrak11*5)/100) + 
		(($pendahuluan11*10)/100) +  
		(($tinjauan11*5)/100) +  
		(($metodologi11*15)/100) +
		(($hasil11*25)/100) +
		(($kesimpulan11*10)/100) +
		(($referensi11*5)/100) +
		(($sistematika11*5)/100) +
		(($presentasi11*20)/100) ;

		$persentase11 	= $jumlah11 * 50/ 100;

		// PENGUJI 1 KOMPRE
		$baris_nilai22 = $this->db->query(
			"SELECT * FROM tbl_nilai_kompre, tbl_syarat_kompre 
			WHERE 	tbl_nilai_kompre.id_syarat_kompre 	= tbl_syarat_kompre.id_syarat_kompre AND 
			tbl_nilai_kompre.status 					= 'Tersedia' AND
			tbl_syarat_kompre.id_syarat_kompre 			= '$id_syarat_kompre' AND
			tbl_nilai_kompre.posisi 					= 'Penguji 1' AND
			tbl_syarat_kompre.status 					= 'Tersedia'")->row();

		$abstrak22 		= $baris_nilai22->abstrak;
		$pendahuluan22 	= $baris_nilai22->pendahuluan;
		$tinjauan22 	= $baris_nilai22->tinjauan;
		$metodologi22 	= $baris_nilai22->metodologi;
		$hasil22 		= $baris_nilai22->hasil;
		$kesimpulan22 	= $baris_nilai22->kesimpulan;
		$referensi22 	= $baris_nilai22->referensi;
		$sistematika22 	= $baris_nilai22->sistematika;
		$presentasi22 	= $baris_nilai22->presentasi;
		$jumlah22 		= (($abstrak22*5)/100) + 
		(($pendahuluan22*10)/100) +  
		(($tinjauan22*5)/100) +  
		(($metodologi22*15)/100) +
		(($hasil22*25)/100) +
		(($kesimpulan22*10)/100) +
		(($referensi22*5)/100) +
		(($sistematika22*5)/100) +
		(($presentasi22*20)/100) ;

		$persentase22 	= $jumlah22 * 25/ 100;

		// PENGUJI 2 KOMPRE
		$baris_nilai33 = $this->db->query(
			"SELECT * FROM tbl_nilai_kompre, tbl_syarat_kompre 
			WHERE 	tbl_nilai_kompre.id_syarat_kompre 	= tbl_syarat_kompre.id_syarat_kompre AND 
			tbl_nilai_kompre.status 					= 'Tersedia' AND
			tbl_syarat_kompre.id_syarat_kompre 			= '$id_syarat_kompre' AND
			tbl_nilai_kompre.posisi 					= 'Penguji 2' AND
			tbl_syarat_kompre.status 					= 'Tersedia'")->row();

		$abstrak33 		= $baris_nilai33->abstrak;
		$pendahuluan33 	= $baris_nilai33->pendahuluan;
		$tinjauan33 	= $baris_nilai33->tinjauan;
		$metodologi33 	= $baris_nilai33->metodologi;
		$hasil33 		= $baris_nilai33->hasil;
		$kesimpulan33 	= $baris_nilai33->kesimpulan;
		$referensi33 	= $baris_nilai33->referensi;
		$sistematika33 	= $baris_nilai33->sistematika;
		$presentasi33 	= $baris_nilai33->presentasi;
		$jumlah33 		= (($abstrak33*5)/100) + 
		(($pendahuluan33*10)/100) +  
		(($tinjauan33*5)/100) +  
		(($metodologi33*15)/100) +
		(($hasil33*25)/100) +
		(($kesimpulan33*10)/100) +
		(($referensi33*5)/100) +
		(($sistematika33*5)/100) +
		(($presentasi33*20)/100) ;
		$persentase33 	= $jumlah33 * 25/ 100;

		return $this->konversiHuruf(((($persentase1+$persentase2+$persentase3)*30)/100) + ((($persentase11+$persentase22+$persentase33)*70)/100));
	}

	function konversiHuruf($nilai){
		if($nilai >80){
			return 'A';
		}elseif($nilai >75 && $nilai <=80){
			return 'A-';
		}elseif($nilai >70 && $nilai <=75){
			return 'B+';
		}elseif($nilai >65 && $nilai <=70){
			return 'B';
		}else{
			return 'B-';
		}
	}

	function cekKonfirmasi($id_syarat_kompre){
			return $this->db->query(
				"SELECT * FROM tbl_nilai_kompre, tbl_syarat_kompre
				WHERE tbl_nilai_kompre.id_syarat_kompre = tbl_syarat_kompre.id_syarat_kompre AND 
				tbl_nilai_kompre.status 				= 'Tersedia' AND
				tbl_syarat_kompre.status 				= 'Tersedia' AND
				tbl_syarat_kompre.id_syarat_kompre 		= '$id_syarat_kompre' AND
				tbl_nilai_kompre.status_verifikasi_prodi= 'Terverifikasi'")->num_rows();
		}

		function konfirmasi($id_syarat_kompre){
		$hasil = $this->db->query("UPDATE tbl_nilai_kompre SET status_verifikasi_prodi = 'Terverifikasi' WHERE id_syarat_kompre ='$id_syarat_kompre' ;");
		return $hasil;
	}
}
?>