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

    public function get_tb_kegiatan_by_id($id_kegiatan)
    {
        $this->db->select("*,DATEDIFF(akhir_kegiatan, awal_kegiatan) as selisih_hari");
        $this->db->from("tb_kegiatan");
        $this->db->where('id_kegiatan', $id_kegiatan);
        return $this->db->get();
    }
}
