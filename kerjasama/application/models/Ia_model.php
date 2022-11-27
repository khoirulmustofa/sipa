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
}
