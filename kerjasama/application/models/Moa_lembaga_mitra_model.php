<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Moa_lembaga_mitra_model extends CI_Model
{

    public function insert_moa_lembaga_mitra($data)
    {
        $this->db->insert('tbl_moa_lembaga_mitra', $data);
        return  $this->db->affected_rows();
    }

    public function get_moa_lembaga_mitra_by_moa_id($moa_id = "")
    {
        $this->db->select("a.*");
        $this->db->from("tbl_moa_lembaga_mitra as a");
        $this->db->where("a.moa_id", $moa_id);
        return  $this->db->get();
    }

    public function delete_moa_lembaga_mitra_by_moa_id($moa_id = "")
    {
        $this->db->where('moa_id', $moa_id);
        $this->db->delete('tbl_moa_lembaga_mitra');
    }
}
