<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_register extends CI_Model {

	public function combobox_prodi(){
		$hasil = $this->db->query("SELECT * FROM tb_prodi WHERE status ='Tersedia'")->result_array();
		return $hasil;
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

	function show_mahasiswa(){
		$kondisi = $this->return_kondisi();
		$query = "SELECT * FROM tbl_mahasiswa, tb_prodi 
				WHERE tbl_mahasiswa.kode_prodi 	= tb_prodi.kode_prodi 
				AND tb_prodi.status 			!= 'Dihapus' 
				AND	tbl_mahasiswa.status 		!='Dihapus' 
				$kondisi 	
				ORDER BY tbl_mahasiswa.npm ASC";
		$hasil=$this->db->query($query)->result_array();
			return $hasil;
	}

	function edit_nama($npm, $nama_mahasiswa, $alamat, $no_hp, $no_ktp, $email_student, $email_umum){
		$hasil = $this->db->query("UPDATE tbl_mahasiswa 
			SET nama_mahasiswa 	= '$nama_mahasiswa',
			alamat 	= '$alamat',
			no_hp 	= '$no_hp',
			no_ktp 	= '$no_ktp',
			email_student 	= '$email_student',
			email_umum 	= '$email_umum'
			WHERE npm = '$npm'");
		return $hasil;
	}

	public function cekNpm($npm){
		return $this->db->query("SELECT * FROM tbl_mahasiswa WHERE npm ='$npm'")->num_rows();
	}

	function proses($npm, $nama_mahasiswa, $jk, $tempat_lahir, $tgl_lahir, $kode_prodi, $email_student, $email_umum, $password_enc, $no_hp, $no_ktp, $agama, $alamat, $foto){
		return $this->db->query("
			INSERT INTO tbl_mahasiswa (npm, 
										nama_mahasiswa, 
										jk, 
										tempat_lahir, 
										tgl_lahir, 
										kode_prodi, 
										password, 
										email_student, 
										email_umum, 
										no_hp, 
										no_ktp, 
										agama, 
										alamat, 
										foto, 
										status) 
								VALUES ('$npm', 
										'$nama_mahasiswa', 
										'$jk', 
										'$tempat_lahir', 
										'$tgl_lahir', 
										'$kode_prodi', 
										'$password_enc', 
										'$email_student', 
										'$email_umum', 
										'$no_hp', 
										'$no_ktp', 
										'$agama',
										'$alamat', 
										'$foto', 
										'Aktif')
			");
	}

	function reset_password($npm, $password_baru_enc){
		return $this->db->query("UPDATE tbl_mahasiswa SET password='$password_baru_enc' where npm='$npm'");
		return $hasil;
	}
}