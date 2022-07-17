<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Negara_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function get_master_negara()
    {
        $this->db->from("master_negara");
        $this->db->order_by('nama_negara');
        return $this->db->get();
    }

    
}
