<?php 

class M_pembimbing_lapangan extends CI_Model
{
	function tambah_nilai_pembimbing_lapangan($id_syarat_sk, $kepribadian, $kedisiplinan, $motivasi, $tanggung_jawab, $komitmen, $kerjasama, $keselamatan, $laporan){
		$hasil=$this->db->query(
			"INSERT INTO tbl_pembimbing_lapangan (
						id_syarat_sk, 
						kepribadian, 
						kedisiplinan,
						motivasi,
						tanggung_jawab,
						komitmen,
						kerjasama,
						keselamatan,
						laporan,
						status) 
						VALUES ( 
						'$id_syarat_sk', 
						'$kepribadian', 
						'$kedisiplinan', 
						'$motivasi',
						'$tanggung_jawab',
						'$komitmen',
						'$kerjasama',
						'$keselamatan',
						'$laporan',
						'Tersedia')");
		return $hasil;
	}

	function cekResponNilai_pembimbing_lapangan($id_syarat_sk){
		return $this->db->query(
			"SELECT * FROM tbl_pembimbing_lapangan, tbl_syarat_sk 
			WHERE 	tbl_pembimbing_lapangan.id_syarat_sk = tbl_syarat_sk.id_syarat_sk AND 
			tbl_pembimbing_lapangan.status 		 		='Tersedia' AND
			tbl_syarat_sk.id_syarat_sk 					= '$id_syarat_sk' AND
			tbl_syarat_sk.status 				 		='Tersedia'")->num_rows();
	}

}

?>