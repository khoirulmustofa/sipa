<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Prodi_model extends CI_Model
{

    public function get_prodi()
    {
        $this->db->from("tb_prodi");
        return $this->db->get();
    }
}