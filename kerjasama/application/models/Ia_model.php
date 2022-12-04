<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ia_model extends CI_Model
{

    public function getIAList()
    {
        $this->db->select("a.id as no,a.id,a.tingkat_ia,a.judul_kegiatan,a.tanggal_awal,a.tanggal_akhir,DATEDIFF(a.tanggal_akhir,a.tanggal_awal) as selisih_hari");
        $this->db->from("tbl_ia as a");

        $this->db->get();
        $query = $this->db->last_query();
        return $query;
    }

    public function insert_ia($data)
    {
        $this->db->insert('tbl_ia', $data);
        return  $this->db->affected_rows();
    }

    public function update_ia_by_id($id = "", $data = array())
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_ia', $data);
        return  $this->db->affected_rows();
    }

    public function get_ia_by_id($id = "")
    {
        $this->db->select("*");
        $this->db->from("tbl_ia as a");
        $this->db->where("id", $id);

        return  $this->db->get();
    }

    public function delete_ia_by_id($id = "")
    {
        $this->db->where('id', $id);
        $this->db->delete("tbl_ia");
        return  $this->db->affected_rows();
    }

    public function get_rekapitulasi_kerjasama($tingkat_ia = "")
    {
        
        $this->db->select("a.id,(SELECT GROUP_CONCAT(nama_prodi) FROM tb_prodi WHERE kode_prodi IN (kode_prodi)) AS nama_prodi,b.nama_lembaga_mitra_moa");
        $this->db->select("IF(a.tingkat_ia = 'Internasional', 'Internasional', NULL) as internasional");
        $this->db->select("IF(a.tingkat_ia = 'Nasional', 'Nasional', NULL) as nasional");
        $this->db->select("IF(a.tingkat_ia = 'Wilayah', 'Wilayah', NULL) as wilayah");
        $this->db->select("a.judul_kegiatan,a.manfaat_kegiatan,a.tanggal_awal,a.dokumen1");
        $this->db->select("REPLACE(b.kode_prodi,'#',',') AS kode_prodi");
        $this->db->from("tbl_ia as a");
        $this->db->join("tbl_moa as b", "b.id = a.moa_id");
        if ($tingkat_ia != "") {
            $this->db->where("a.tingkat_ia", $tingkat_ia);
        }
        $this->db->get();
        $query = $this->db->last_query();
        return $query;
    }
}
