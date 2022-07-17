<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_profil extends CI_Model
{
	public function tampil_data()
	{
		$query = $this->db->query('SELECT * FROM tbl_mahasiswa ');
		return $query->result();
	}

	// function edit_profil($nama_tabel, $field_nama, $username, $nama, $npk, $jk, $no_hp, $email, $fotobaru){
	// 	$hasil=$this->db->query("UPDATE tbl_mahasiswa SET $field_nama='$nama', npk='$npk', jenis_kelamin='$jk', no_hp='$no_hp', email='$email', foto='$fotobaru' WHERE username = '$username';");
	// 	return $hasil;
	// }

	function edit_profil_nophoto($nama_mahasiswa, $npm, $jk, $tempat_lahir, $tgl_lahir, $email_student, $email_umum, $no_hp, $no_ktp, $agama, $alamat){
		$hasil=$this->db->query("UPDATE tbl_mahasiswa 
								SET nama_mahasiswa ='$nama_mahasiswa', 
									jk 				='$jk', 
									tempat_lahir 	='$tempat_lahir', 
									tgl_lahir 		='$tgl_lahir', 
									email_student 	='$email_student', 
									email_umum 		='$email_umum', 
									no_hp 			='$no_hp', 
									no_ktp 			='$no_ktp', 
									agama  			='$agama', 
									alamat 			='$alamat' 
								 WHERE npm = '$npm';");
		return $hasil;
	}

	function edit_profil($nama_mahasiswa, $npm, $jk, $tempat_lahir, $tgl_lahir, $email_student, $email_umum, $no_hp, $no_ktp, $agama, $alamat, $foto){
		$hasil=$this->db->query("UPDATE tbl_mahasiswa 
								SET nama_mahasiswa  ='$nama_mahasiswa', 
									jk 				='$jk', 
									tempat_lahir 	='$tempat_lahir', 
									tgl_lahir 		='$tgl_lahir', 
									email_student 	='$email_student', 
									email_umum 		='$email_umum', 
									no_hp 			='$no_hp', 
									no_ktp 			='$no_ktp', 
									agama  			='$agama', 
									alamat 			='$alamat',
									foto 			='$foto'
								 WHERE npm = '$npm';");
		return $hasil;
	}

	function ganti_password($password_baru_enc, $npm){
		return $this->db->query("UPDATE tbl_mahasiswa SET password='$password_baru_enc' where npm='$npm'");
	}

	function ambil($npm){
		$query = $this->db->query("SELECT * from tbl_mahasiswa where npm='$npm'");
		return $row = $query->row();
	}

}