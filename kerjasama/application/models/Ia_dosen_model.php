<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ia_dosen_model extends CI_Model
{

    public function insert_ia_dosen($data)
    {
        $this->db->insert('tbl_ia_dosen', $data);
        return  $this->db->affected_rows();
    }

    public function get_ia_dosen_by_ia_id($ia_id = "")
    {
        $this->db->select("a.*");
        $this->db->from("tbl_ia_dosen as a");
        $this->db->where("a.ia_id", $ia_id);
        return  $this->db->get();
    }

    public function get_ia_dosen_dosen_by_ia_id($ia_id = "")
    {
        $this->db->select("a.*,b.*");
        $this->db->from("tbl_ia_dosen as a");
        $this->db->join("tb_dosen as b", "b.npk = a.npk");
        $this->db->where("a.ia_id", $ia_id);
        return  $this->db->get();
    }

    public function delete_ia_dosen_by_ia_id($ia_id = "")
    {
        $this->db->where('ia_id', $ia_id);
        $this->db->delete('tbl_ia_dosen');
    }
}
