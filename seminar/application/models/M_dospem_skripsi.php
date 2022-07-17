<?php 

class M_dospem_skripsi extends CI_Model
{
	function show_sk_mahasiswa($npk)
	{
		$hasil=$this->db->query("SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_skripsi,
			tb_prodi,
			tbl_persetujuan_skripsi, 
			tbl_usulan_pembimbing,
			tbl_persetujuan_usulan_pembimbing
			WHERE 
			tbl_mahasiswa.npm 					= tbl_skripsi.npm AND
			tbl_mahasiswa.kode_prodi 			= tb_prodi.kode_prodi AND
			tbl_jenis_sk.id_jenis_sk 			= tbl_skripsi.id_jenis_sk AND
			tbl_persetujuan_skripsi.id_skripsi 	= tbl_skripsi.id_skripsi AND
			tbl_usulan_pembimbing.id_skripsi 	= tbl_skripsi.id_skripsi AND
			tbl_persetujuan_usulan_pembimbing.id_usulan_pembimbing = tbl_usulan_pembimbing.id_usulan_pembimbing AND

			tb_prodi.status 				!= 'Dihapus' AND
			tbl_skripsi.status 				= 'Tersedia' AND
			tbl_jenis_sk.status 			= 'Tersedia' AND
			tbl_mahasiswa.status 			= 'Aktif' AND
			tbl_persetujuan_skripsi.status 	= 'Tersedia' AND
			tbl_usulan_pembimbing.status 	= 'Tersedia' AND
			tbl_persetujuan_usulan_pembimbing.status = 'Tersedia' AND
			tbl_usulan_pembimbing.status_persetujuan = 'Usulan Disetujui' AND
			tbl_persetujuan_usulan_pembimbing.status_persetujuan = 'Usulan Disetujui' AND
			tbl_persetujuan_skripsi.tema_persetujuan = 'Pengecekan Berkas Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha' AND
			tbl_persetujuan_usulan_pembimbing.npk = '$npk'
			ORDER BY tbl_persetujuan_usulan_pembimbing.id_usulan_pembimbing DESC;
			");
		return $hasil;
	}

	function cekResponPembimbing($id_skripsi, $npk){
		$hasil=$this->db->query("SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_skripsi,
			tb_prodi,
			tbl_persetujuan_skripsi, 
			tbl_usulan_pembimbing,
			tbl_persetujuan_usulan_pembimbing,
			tbl_dospem_skripsi
			WHERE 
			tbl_mahasiswa.npm 					= tbl_skripsi.npm AND
			tbl_mahasiswa.kode_prodi 			= tb_prodi.kode_prodi AND
			tbl_jenis_sk.id_jenis_sk 			= tbl_skripsi.id_jenis_sk AND
			tbl_persetujuan_skripsi.id_skripsi  = tbl_skripsi.id_skripsi AND
			tbl_dospem_skripsi.id_skripsi 		= tbl_skripsi.id_skripsi AND
			tbl_usulan_pembimbing.id_skripsi 	= tbl_skripsi.id_skripsi AND
			tbl_persetujuan_usulan_pembimbing.id_usulan_pembimbing = tbl_usulan_pembimbing.id_usulan_pembimbing AND

			tb_prodi.status 				!= 'Dihapus' AND
			tbl_skripsi.status 				= 'Tersedia' AND
			tbl_skripsi.id_skripsi 			='$id_skripsi' AND
			tbl_dospem_skripsi.npk 			='$npk' AND
			tbl_jenis_sk.status 			= 'Tersedia' AND
			tbl_mahasiswa.status 			= 'Aktif' AND
			tbl_persetujuan_skripsi.status 	= 'Tersedia' AND
			tbl_dospem_skripsi.status 		= 'Tersedia' AND
			tbl_usulan_pembimbing.status 	= 'Tersedia' AND
			tbl_persetujuan_usulan_pembimbing.status = 'Tersedia' AND
			tbl_usulan_pembimbing.status_persetujuan = 'Usulan Disetujui' AND
			tbl_persetujuan_usulan_pembimbing.status_persetujuan = 'Usulan Disetujui' AND
			tbl_persetujuan_skripsi.tema_persetujuan = 'Pengecekan Berkas Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha'
			");
		return $hasil->num_rows();
	}

	// PERSETUJUAN USULAN PEMBIMBING OLEH KOORDINATOR
	function persetujuan_dospem_skripsi($npk, $id_skripsi,  $respon, $alasan_ditolak){

		$hasil=$this->db->query(
			"UPDATE tbl_dospem_skripsi set status = 'Dihapus' WHERE id_skripsi = '$id_skripsi'");
		if ($hasil) {
			$hasil2=$this->db->query(
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
		return $hasil2;
		}

		
	}

	// CEK RESPON FAKULTAS TERHADAP SK
	function cekResponSKFakultas($id_skripsi){
		$hasil=$this->db->query(
			"SELECT * FROM  
			tbl_skripsi,
			tbl_persetujuan_skripsi, 
			tbl_ttd_surat, 
			tbl_nomor_surat
			WHERE 
			tbl_persetujuan_skripsi.id_persetujuan_skripsi 	= tbl_persetujuan_skripsi.id_persetujuan_skripsi AND
			tbl_skripsi.status 				= 'Tersedia' AND
			tbl_ttd_surat.topik_relasi 		= 'Tandatangan SK Pembimbing Skripsi oleh Dekan' AND
			tbl_ttd_surat.id_relasi 		= tbl_skripsi.id_skripsi AND
			tbl_nomor_surat.id_relasi 		= tbl_skripsi.id_skripsi AND
			tbl_nomor_surat.relasi_tabel 	= 'tbl_skripsi' AND
			tbl_nomor_surat.fungsi_nomor 	= 'SK Pembimbing Skripsi' AND

			tbl_ttd_surat.status 			= 'Tersedia' AND
			tbl_persetujuan_skripsi.status 	= 'Tersedia' AND
			tbl_nomor_surat.status 			= 'Tersedia' AND
			tbl_skripsi.id_skripsi 			= '$id_skripsi'
			")->num_rows();
		return $hasil;
	}

	function cekPenunjukan($id_skripsi, $npk){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_skripsi,
			tb_prodi,
			tbl_persetujuan_skripsi, 
			tbl_usulan_pembimbing,
			tbl_persetujuan_usulan_pembimbing
			WHERE 
			tbl_mahasiswa.npm 					= tbl_skripsi.npm AND
			tbl_mahasiswa.kode_prodi 			= tb_prodi.kode_prodi AND
			tbl_jenis_sk.id_jenis_sk 			= tbl_skripsi.id_jenis_sk AND
			tbl_persetujuan_skripsi.id_skripsi  = tbl_skripsi.id_skripsi AND
			tbl_usulan_pembimbing.id_skripsi 	= tbl_skripsi.id_skripsi AND
			tbl_persetujuan_usulan_pembimbing.id_usulan_pembimbing = tbl_persetujuan_usulan_pembimbing.id_usulan_pembimbing AND

			tb_prodi.status 				!= 'Dihapus' AND
			tbl_skripsi.status 				= 'Tersedia' AND
			tbl_jenis_sk.status 			= 'Tersedia' AND
			tbl_mahasiswa.status 			= 'Aktif' AND
			tbl_persetujuan_skripsi.status 	= 'Tersedia' AND
			tbl_usulan_pembimbing.status 	= 'Tersedia' AND
			tbl_persetujuan_usulan_pembimbing.status = 'Tersedia' AND
			tbl_usulan_pembimbing.status_persetujuan = 'Usulan Disetujui' AND
			tbl_persetujuan_usulan_pembimbing.status_persetujuan = 'Usulan Disetujui' AND
			tbl_persetujuan_skripsi.tema_persetujuan = 'Pengecekan Berkas Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha' AND			
			tbl_skripsi.id_skripsi = '$id_skripsi' AND
			tbl_persetujuan_usulan_pembimbing.npk = '$npk'

			ORDER BY tbl_persetujuan_usulan_pembimbing.id_usulan_pembimbing DESC;
			")->num_rows();
		return $hasil;
	}

	function cekStatusPenunjukan($id_skripsi, $respon, $npk){
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_skripsi,
			tb_prodi,
			tbl_persetujuan_skripsi, 
			tbl_usulan_pembimbing,
			tbl_persetujuan_usulan_pembimbing,
			tbl_dospem_skripsi
			WHERE 
			tbl_mahasiswa.npm 					= tbl_skripsi.npm AND
			tbl_mahasiswa.kode_prodi 			= tb_prodi.kode_prodi AND
			tbl_jenis_sk.id_jenis_sk 			= tbl_skripsi.id_jenis_sk AND
			tbl_persetujuan_skripsi.id_skripsi  = tbl_skripsi.id_skripsi AND
			tbl_usulan_pembimbing.id_skripsi 	= tbl_skripsi.id_skripsi AND
			tbl_dospem_skripsi.id_skripsi 		= tbl_skripsi.id_skripsi AND
			tbl_persetujuan_usulan_pembimbing.id_usulan_pembimbing = tbl_persetujuan_usulan_pembimbing.id_usulan_pembimbing AND

			tb_prodi.status 				!= 'Dihapus' AND
			tbl_skripsi.status 				= 'Tersedia' AND
			tbl_jenis_sk.status 			= 'Tersedia' AND
			tbl_mahasiswa.status 			= 'Aktif' AND
			tbl_persetujuan_skripsi.status 	= 'Tersedia' AND
			tbl_dospem_skripsi.status 		= 'Tersedia' AND
			tbl_usulan_pembimbing.status 	= 'Tersedia' AND
			tbl_persetujuan_usulan_pembimbing.status = 'Tersedia' AND
			tbl_usulan_pembimbing.status_persetujuan = 'Usulan Disetujui' AND
			tbl_persetujuan_usulan_pembimbing.status_persetujuan = 'Usulan Disetujui' AND
			tbl_persetujuan_skripsi.tema_persetujuan = 'Pengecekan Berkas Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha' AND			
			tbl_skripsi.id_skripsi = '$id_skripsi' AND
			tbl_dospem_skripsi.npk = '$npk' AND
			tbl_dospem_skripsi.respon = '$respon'

			ORDER BY tbl_persetujuan_usulan_pembimbing.id_usulan_pembimbing DESC;
			")->num_rows();
		return $hasil;
	}

	function alasan_ditolak($npm, $id_skripsi)
	{
		$hasil=$this->db->query(
			"SELECT * FROM 
			tbl_mahasiswa, 
			tbl_jenis_sk, 
			tbl_skripsi,
			tb_prodi,
			tbl_persetujuan_skripsi, 
			tbl_usulan_pembimbing,
			tbl_persetujuan_usulan_pembimbing,
			tbl_dospem_skripsi
			WHERE 
			tbl_mahasiswa.npm 					= tbl_skripsi.npm AND
			tbl_mahasiswa.kode_prodi 			= tb_prodi.kode_prodi AND
			tbl_jenis_sk.id_jenis_sk 			= tbl_skripsi.id_jenis_sk AND
			tbl_persetujuan_skripsi.id_skripsi  = tbl_skripsi.id_skripsi AND
			tbl_usulan_pembimbing.id_skripsi 	= tbl_skripsi.id_skripsi AND
			tbl_dospem_skripsi.id_skripsi 		= tbl_skripsi.id_skripsi AND
			tbl_persetujuan_usulan_pembimbing.id_usulan_pembimbing = tbl_persetujuan_usulan_pembimbing.id_usulan_pembimbing AND

			tb_prodi.status 				!= 'Dihapus' AND
			tbl_skripsi.status 				= 'Tersedia' AND
			tbl_jenis_sk.status 			= 'Tersedia' AND
			tbl_mahasiswa.status 			= 'Aktif' AND
			tbl_persetujuan_skripsi.status 	= 'Tersedia' AND
			tbl_dospem_skripsi.status 		= 'Tersedia' AND
			tbl_usulan_pembimbing.status 	= 'Tersedia' AND
			tbl_persetujuan_usulan_pembimbing.status = 'Tersedia' AND
			tbl_usulan_pembimbing.status_persetujuan = 'Usulan Disetujui' AND
			tbl_persetujuan_usulan_pembimbing.status_persetujuan = 'Usulan Disetujui' AND
			tbl_persetujuan_skripsi.tema_persetujuan = 'Pengecekan Berkas Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha' AND			
			tbl_skripsi.id_skripsi = '$id_skripsi' 

			ORDER BY tbl_persetujuan_usulan_pembimbing.id_usulan_pembimbing DESC;
			");
		return $hasil->result_array();
	}

}
?>