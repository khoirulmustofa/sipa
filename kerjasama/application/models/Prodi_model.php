<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Prodi_model extends CI_Model
{

    public function get_prodi_by_id($kode_prodi = "")
    {
        $this->db->from("tb_prodi");
        if ($kode_prodi != "") {
            $this->db->where('kode_prodi', $kode_prodi);
        }
        return $this->db->get();
    }
}