<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Moa_model extends CI_Model
{

    public function get_list_moa($tahun_kerja_sama = "", $kategori = "", $tingkat_moa = "")
    {
        $this->db->select("a.id as no,a.id,(GROUP_CONCAT(DISTINCT d.nama_lembaga_mitra)) as nama_lembaga_mitra,a.periode,b.nama_negara,(GROUP_CONCAT(DISTINCT c.kategori)) as kategori_moa,a.tingkat_moa,a.tanggal_moa,a.tanggal_akhir_moa");
        $this->db->from("tbl_moa as a");
        $this->db->join("master_negara as b", "b.id = a.negara_id", "left");
        $this->db->join("tbl_moa_kategori as c", "c.moa_id = a.id");
        $this->db->join("tbl_moa_lembaga_mitra as d", "d.moa_id = a.id");
        if ($tahun_kerja_sama != "") {
            $this->db->where("YEAR(a.tanggal_moa)", $tahun_kerja_sama);
        } else {
            $this->db->where("YEAR(a.tanggal_moa) >=", date('Y', strtotime('-5 year')));
        }

        if ( $kategori != '' ) {
            $this->db->where("c.kategori", $kategori);
        }

        if ( $tingkat_moa != '' ) {
            $this->db->where("a.tingkat_moa", $tingkat_moa);
        }

        $this->db->group_by("a.id");
        $this->db->get();
        $query = $this->db->last_query();
        return $query;
    }

    public function getTahunMOA()
    {
        $this->db->select("DISTINCT YEAR(tanggal_moa) as tahun_moa");
        $this->db->from("tbl_moa");
        return  $this->db->get();
    }

    public function get_tahun_moa()
    {
        $this->db->select("DISTINCT YEAR(tanggal_moa) as tahun_moa");
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

    public function get_moa_by_waktu_buat($waktu_buat = "")
    {
        $this->db->select("*");
        $this->db->from("tbl_moa");
        $this->db->where('waktu_buat', $waktu_buat);
        return  $this->db->get();
    }


    public function get_moa_detail_by_id($id = "")
    {
        // $this->db->select("a.id,a.mou_id,a.kategori_moa,a.tingkat_moa,a.tanggal,a.nama_lembaga_mitra_moa,a.negara_id,a.provinsi_id,a.kota_kabupaten_id,a.kecamatan_id,a.kelurahan_id,a.alamat,a.durasi,a.tanggal_akhir,a.dokumen1,a.dokumen2,a.dokumen3,a.kode_prodi");
        // $this->db->select("c.nama_negara,d.province_name,e.kota_kabupaten_nama,f.kecamatan_nama");
        $this->db->select("a.*,b.*,c.*,d.*,e.*,f.*,g.*");
        $this->db->from("tbl_moa as a");
        $this->db->join("tbl_mou as b", "b.id = a.mou_id", "left");
        $this->db->join("master_negara as c", "c.id = a.negara_id", "left");
        $this->db->join("master_provinsi as d", "d.master_provinsi_id = a.provinsi_id", "left");
        $this->db->join("master_kota_kabupaten as e", "e.master_kota_kabupaten_id = a.kota_kabupaten_id", "left");
        $this->db->join("master_kecamatan as f", "f.master_kecamatan_id = a.kecamatan_id", "left");
        $this->db->join("master_kelurahan as g", "g.master_kelurahan_id = a.kelurahan_id", "left");
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
        $this->db->order_by("tanggal_moa");
        return  $this->db->get();
    }

    public function get_moa_by_prodi($kode_prodi = "")
    {
        $this->db->select('a.id,c.id as moa_lembaga_mitra_id,a.mou_id,a.tingkat_moa,c.nama_lembaga_mitra,a.tanggal_moa,a.tanggal_akhir_moa');
        $this->db->from("tbl_moa as a");
        $this->db->join("tbl_moa_prodi as b", "b.moa_id= a.id");
        $this->db->join("tbl_moa_lembaga_mitra as c", "c.moa_id= a.id");
        if ($kode_prodi != "") {
            $this->db->where("kode_prodi", $kode_prodi);
        }
        return  $this->db->get();
    }

    public function get_count_moa($tahun = "", $tingkat_moa = "")
    {
        // $this->db->select("COUNT(a.id) as count");
        $this->db->from('tbl_moa');
        if ($tahun != "") {
            $this->db->where("YEAR(tanggal_moa)", $tahun);
        }
        if ($tingkat_moa != "") {
            $this->db->where("tingkat_moa", $tingkat_moa);
        }
        return $this->db->count_all_results();
    }

    public function get_count_moa_by_prodi($kode_prodi = "", $tahun = "", $tingkat_moa = "")
    {
        $this->db->select("b.kode_prodi,COUNT(b.kode_prodi) as count_prodi,c.nama_prodi");
        $this->db->from("tbl_moa as a");
        $this->db->join("tbl_moa_prodi as b", "b.moa_id = a.id", 'right');
        $this->db->join("tb_prodi as c", "c.kode_prodi = b.kode_prodi",);
        if ($kode_prodi != "") {
            $this->db->where("b.kode_prodi", $kode_prodi);
        }
        if ($tahun != "") {
            $this->db->where("YEAR(a.tanggal_moa)", $tahun);
        }
        if ($tingkat_moa != "") {
            $this->db->where("a.tingkat_moa", $tingkat_moa);
        }
        $this->db->group_by("b.kode_prodi");
        return  $this->db->get();
    }

   
}
