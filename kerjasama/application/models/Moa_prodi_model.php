<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Moa_prodi_model extends CI_Model
{

    public function insert_moa_prodi($data)
    {
        $this->db->insert('tbl_moa_prodi', $data);
        return  $this->db->affected_rows();
    }

    public function get_moa_prodi_by_moa_id($moa_id = "")
    {
        $this->db->select("a.*,b.nama_prodi,b.jenjang,b.akreditasi,b.status");
        $this->db->from("tbl_moa_prodi as a");
        $this->db->join("tb_prodi as b", "b.kode_prodi = a.kode_prodi");
        $this->db->where("a.moa_id", $moa_id);
        return  $this->db->get();
    }

    public function delete_moa_prodi_by_moa_id($moa_id = "")
    {
        $this->db->where('moa_id', $moa_id);
        $this->db->delete('tbl_moa_prodi');
    }
}
