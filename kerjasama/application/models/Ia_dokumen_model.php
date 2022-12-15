<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ia_dokumen_model extends CI_Model
{

    public function insert_ia_dokumen($data)
    {
        $this->db->insert('tbl_ia_dokumen', $data);
        return  $this->db->affected_rows();
    }

    public function get_ia_dokumen_by_ia_id($ia_id = "")
    {
        $this->db->select("a.*");
        $this->db->from("tbl_ia_dokumen as a");
        $this->db->where("a.ia_id", $ia_id);
        return  $this->db->get();
    }

    public function delete_ia_dokumen_by_ia_id($ia_id = "")
    {
        $this->db->where('ia_id', $ia_id);
        $this->db->delete('tbl_ia_dokumen');
    }
}
