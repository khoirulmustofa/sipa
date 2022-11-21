<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Moa_model extends CI_Model
{

    public function getMOAList($tahun_kerja_sama = "")
    {
        $this->db->select("a.id as no,a.id,a.nama_lembaga_mitra,b.nama_negara,a.durasi,a.kategori_moa,a.tingkat_moa,a.tanggal,a.tanggal_akhir");
        $this->db->from("tbl_moa as a");
        $this->db->join("master_negara as b", "b.id = a.negara_id", "left");
        if ($tahun_kerja_sama != "") {
            $this->db->where("YEAR(a.tanggal)", $tahun_kerja_sama);
        }
        $this->db->get();
        $query = $this->db->last_query();
        return $query;
    }

    public function getTahunMOA()
    {
        $this->db->select("DISTINCT YEAR(tanggal) as tahun_moa");
        $this->db->from("tbl_moa");
        return  $this->db->get();
    }

    public function insert_moa($data)
    {
        $this->db->insert('tbl_moa', $data);
        return  $this->db->affected_rows();
    }
}
