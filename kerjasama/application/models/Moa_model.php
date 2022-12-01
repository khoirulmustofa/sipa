<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Moa_model extends CI_Model
{

    public function getMOAList($tahun_kerja_sama = "")
    {
        $this->db->select("a.id as no,a.id,a.nama_lembaga_mitra_moa,b.nama_negara,a.durasi,a.kategori_moa,a.tingkat_moa,a.tanggal,a.tanggal_akhir");
        $this->db->from("tbl_moa as a");
        $this->db->join("master_negara as b", "b.id = a.negara_id", "left");
        if ($tahun_kerja_sama != "") {
            $this->db->where("YEAR(a.tanggal)", $tahun_kerja_sama);
        }
        $this->db->get();
        $query = $this->db->last_query();
        return $query;
    }

    public function getTahunMOA()
    {
        $this->db->select("DISTINCT YEAR(tanggal) as tahun_moa");
        $this->db->from("tbl_moa");
        return  $this->db->get();
    }

    public function insert_moa($data)
    {
        $this->db->insert('tbl_moa', $data);
        return  $this->db->affected_rows();
    }

    public function update_moa_by_id($id = "", $data = array())
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_moa', $data);
        return  $this->db->affected_rows();
    }

    public function delete_moa_by_id($id = "")
    {
        $this->db->where('id', $id);
        $this->db->delete("tbl_moa");
        return  $this->db->affected_rows();
    }


    public function getMoaDetailById($id = "")
    {
        // $this->db->select("a.id,a.mou_id,a.kategori_moa,a.tingkat_moa,a.tanggal,a.nama_lembaga_mitra_moa,a.negara_id,a.provinsi_id,a.kota_kabupaten_id,a.kecamatan_id,a.kelurahan_id,a.alamat,a.durasi,a.tanggal_akhir,a.dokumen1,a.dokumen2,a.dokumen3,a.kode_prodi");
        // $this->db->select("c.nama_negara,d.province_name,e.kota_kabupaten_nama,f.kecamatan_nama");
        $this->db->select("a.*,b.*,c.*,d.*,e.*,f.*");
        $this->db->from("tbl_moa as a");
        $this->db->join("tbl_mou as b", "b.id = a.mou_id", "left");
        $this->db->join("master_negara as c", "c.id = a.negara_id", "left");
        $this->db->join("master_provinsi as d", "d.master_provinsi_id = a.provinsi_id", "left");
        $this->db->join("master_kota_kabupaten as e", "e.master_kota_kabupaten_id = a.kota_kabupaten_id", "left");
        $this->db->join("master_kecamatan as f", "f.master_kecamatan_id = a.kecamatan_id", "left");
        $this->db->where("a.id", $id);
        return  $this->db->get();
    }

    public function get_moa_by_id($id = "")
    {       
        $this->db->from("tbl_moa");
        $this->db->where("id", $id);
        return  $this->db->get();
    }

    public function get_moa()
    {
        $this->db->select('*');
        $this->db->from("tbl_moa");
        $this->db->order_by("tanggal");
        return  $this->db->get();
    }
}
