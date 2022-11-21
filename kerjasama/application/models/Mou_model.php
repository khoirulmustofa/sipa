<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mou_model extends CI_Model
{

    public function getMOUList($tahun_kerja_sama = "")
    {
        $this->db->select("a.id as no,a.id,a.tanggal_kerja_sama,a.nama_lembaga_mitra,a.periode");
        $this->db->select("b.nama_negara,c.province_name,d.kota_kabupaten_nama,e.kecamatan_nama,f.kelurahan_nama");
        $this->db->select("a.alamat,a.durasi_kerja_sama,a.tanggal_akhir_kerja_sama,a.status");
        $this->db->from("tbl_mou as a");
        $this->db->join("master_negara as b", "b.id = a.negara_id", "left");
        $this->db->join("master_provinsi as c", "c.master_provinsi_id = a.provinsi_id", "left");
        $this->db->join("master_kota_kabupaten as d", "d.master_kota_kabupaten_id = a.kota_kabupaten_id", "left");
        $this->db->join("master_kecamatan as e", "e.master_kecamatan_id = a.kecamata_id", "left");
        $this->db->join("master_kelurahan as f", "f.master_kelurahan_id = a.kelurahan_id", "left");
        if ($tahun_kerja_sama != "") {
            $this->db->where("YEAR(a.tanggal_kerja_sama)", $tahun_kerja_sama);
        }
        $this->db->get();
        $query = $this->db->last_query();
        return $query;
    }

    public function getTahunMOU()
    {
        $this->db->select("YEAR(tanggal_kerja_sama) as tahun_mou");
        $this->db->from("tbl_mou");
        return  $this->db->get();
    }

    public function getMouResult()
    {
        $this->db->select("*");
        $this->db->from("tbl_mou");
        return  $this->db->get();
    }

    
}
