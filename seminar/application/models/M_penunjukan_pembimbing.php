<?php 

class M_penunjukan_pembimbing extends CI_Model
{
	function combobox_dosen($kode_prodi)
	{
		$query = $this->db->query("SELECT * from tb_prodi, tb_dosen 
			where tb_dosen.kode_jurusan = tb_prodi.kode_prodi AND 
			tb_prodi.status 			= 'Tersedia' AND
			tb_dosen.status 			= 'Aktif' AND
			tb_prodi.kode_prodi 		='$kode_prodi'");
		return $query->result_array();
	}

	function show_penunjukan_pembimbing()
	{
		$hasil=$this->db->query("SELECT * FROM 
			tb_dosen, 
			tb_prodi, 
			tb_prodi_attribut
			WHERE 
			tb_prodi_attribut.username 		= tb_prodi.kode_prodi AND
			tb_prodi_attribut.username 		= tb_dosen.npk AND
			tb_dosen.npk 					= '$_SESSION[npk]' AND
			tb_prodi.status 				= 'Tersedia' AND
			tb_prodi_attribut.status_akun 	= 'Aktif'");
		return $hasil;
	}
}
?>