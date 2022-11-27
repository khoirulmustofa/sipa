<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dosen_model extends CI_Model
{

    public function get_dosen()
    {
        $this->db->select("*");
        $this->db->from("tb_dosen");
        $this->db->order_by("nama_dosen");
        return  $this->db->get();
    }

    public function get_dosen_by_npk_arr($arry_npk = array())
    {
        $this->db->select("*");
        $this->db->from("tb_dosen");
        $this->db->where_in("npk",$arry_npk);
        return  $this->db->get();
    }
}