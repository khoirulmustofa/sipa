<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mou_model extends CI_Model
{

    public function getMOUList($tahun_kerja_sama = "")
    {
        $this->db->select("a.id as no,a.id,a.tanggal,a.nama_lembaga_mitra,a.periode");
        $this->db->select("b.nama_negara,c.province_name,d.kota_kabupaten_nama,e.kecamatan_nama,f.kelurahan_nama");
        $this->db->select("a.alamat,a.durasi,a.tanggal_akhir,a.status");
        $this->db->from("tbl_mou as a");
        $this->db->join("master_negara as b", "b.id = a.negara_id", "left");
        $this->db->join("master_provinsi as c", "c.master_provinsi_id = a.provinsi_id", "left");
        $this->db->join("master_kota_kabupaten as d", "d.master_kota_kabupaten_id = a.kota_kabupaten_id", "left");
        $this->db->join("master_kecamatan as e", "e.master_kecamatan_id = a.kecamatan_id", "left");
        $this->db->join("master_kelurahan as f", "f.master_kelurahan_id = a.kelurahan_id", "left");
        if ($tahun_kerja_sama != "") {
            $this->db->where("YEAR(a.tanggal)", $tahun_kerja_sama);
        }
        $this->db->get();
        $query = $this->db->last_query();
        return $query;
    }

    public function getTahunMOU()
    {
        $this->db->select("YEAR(tanggal) as tahun_mou");
        $this->db->from("tbl_mou");
        return  $this->db->get();
    }

    public function getMouResult()
    {
        $this->db->select("*");
        $this->db->from("tbl_mou");
        return  $this->db->get();
    }

    public function get_mou()
    {
        $this->db->select("*");
        $this->db->from("tbl_mou");
        return  $this->db->get();
    }

    public function getMouById($id = "")
    {
        $this->db->select("*");
        $this->db->from("tbl_mou");
        $this->db->where("id", $id);
        return  $this->db->get();
    }

    public function insert_mou($data = array())
    {
        $this->db->insert('tbl_mou', $data);
        return  $this->db->affected_rows();
    }

    public function update_mou_by_id($id = "", $data = array())
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_mou', $data);
        return  $this->db->affected_rows();
    }

    public function delete_mou_by_id($id = "")
    {
        $this->db->where('id', $id);
        $this->db->delete("tbl_mou");
        return  $this->db->affected_rows();
    }

    public function get_mou_detail_by_id($mou_id = "")
    {
        $this->db->select("a.id,a.periode,a.tanggal,a.nama_lembaga_mitra,a.negara_id,a.provinsi_id,a.kota_kabupaten_id,a.kecamatan_id,a.kelurahan_id,a.alamat,a.durasi,a.tanggal_akhir,a.dokumen");
        $this->db->select("b.nama_negara,c.province_name,d.kota_kabupaten_nama,e.kecamatan_nama,f.kelurahan_nama");
        $this->db->from("tbl_mou as a");
        $this->db->join("master_negara as b", "b.id = a.negara_id", "left");
        $this->db->join("master_provinsi as c", "c.master_provinsi_id = a.provinsi_id", "left");
        $this->db->join("master_kota_kabupaten as d", "d.master_kota_kabupaten_id = a.kota_kabupaten_id", "left");
        $this->db->join("master_kecamatan as e", "e.master_kecamatan_id = a.kecamatan_id", "left");
        $this->db->join("master_kelurahan as f", "f.master_kelurahan_id = a.kelurahan_id", "left");
        $this->db->where("a.id", $mou_id);
        return  $this->db->get();
    }
}
