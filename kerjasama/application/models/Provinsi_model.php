<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Provinsi_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function get_master_provinsi()
    {
        $this->db->from("master_provinsi");
        $this->db->order_by('province_name');
        return $this->db->get();
    }

    public function get_master_kota_kabupaten_by_provinsi_id($master_provinsi_id = "")
    {
        $this->db->from("master_kota_kabupaten");
        $this->db->where('master_provinsi_id', $master_provinsi_id);
        return $this->db->get();
    }

    public function get_master_kecamatan_by_kota_kabupaten_id($master_kota_kabupaten_id = "")
    {
        $this->db->from("master_kecamatan");
        $this->db->where('master_kota_kabupaten_id', $master_kota_kabupaten_id);
        return $this->db->get();
    }

    public function get_master_kelurahan_by_kecamatan_id($master_kecamatan_id = "")
    {
        $this->db->from("master_kelurahan");
        $this->db->where('master_kecamatan_id', $master_kecamatan_id);
        return $this->db->get();
    }
}
