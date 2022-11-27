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
}