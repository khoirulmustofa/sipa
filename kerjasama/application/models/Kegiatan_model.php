<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kegiatan_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function insert_tb_kegiatan($data = array())
    {
        $this->db->insert('tb_kegiatan', $data);
        $this->db->save_queries = TRUE;
        $query = $this->db->last_query();
        return $query;
    }
}