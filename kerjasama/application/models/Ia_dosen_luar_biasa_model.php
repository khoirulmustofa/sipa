<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ia_dosen_luar_biasa_model extends CI_Model
{

    public function insert_ia_dosen_luar_biasa($data)
    {
        $this->db->insert('tbl_ia_dosen_luar_biasa', $data);
        return  $this->db->affected_rows();
    }

    public function get_ia_dosen_luar_biasa_by_ia_id($ia_id = "")
    {
        $this->db->select("a.*");
        $this->db->from("tbl_ia_dosen_luar_biasa as a");
        $this->db->where("a.ia_id", $ia_id);
        return  $this->db->get();
    }

    public function delete_ia_dosen_luar_biasa_by_ia_id($ia_id = "")
    {
        $this->db->where('ia_id', $ia_id);
        $this->db->delete('tbl_ia_dosen_luar_biasa');
    }
}