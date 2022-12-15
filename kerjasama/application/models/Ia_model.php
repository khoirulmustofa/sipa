<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ia_model extends CI_Model
{

    public function get_list_ai($kode_prodi = "", $tahun_ia = "", $kategori_ia = "")
    {
        $this->db->select("a.id as no,a.id,d.nama_prodi,a.tingkat_ia,a.judul_kegiatan_ia,a.tanggal_awal_ia,a.tanggal_akhir_ia,DATEDIFF(a.tanggal_akhir_ia,a.tanggal_awal_ia) as selisih_hari");
        $this->db->from("tbl_ia as a");
        $this->db->join("tbl_moa_lembaga_mitra  as b", "b.id = a.moa_lembaga_mitra_id");
        $this->db->join("tbl_moa_prodi as c", "c.moa_id = b. moa_id");
        $this->db->join("tb_prodi as d", "d.kode_prodi = c. kode_prodi");
        if ($kode_prodi != "") {
            $this->db->where('c.kode_prodi', $kode_prodi);
        }

        if ($tahun_ia != "") {
            $this->db->where("YEAR(a.tanggal_awal_ia)", $tahun_ia);
        } else {
            $this->db->where("YEAR(a.tanggal_awal_ia) >=", date('Y', strtotime('-5 year')));
        }

        if ($kategori_ia != "") {
            $this->db->where('a.kategori_ia', $kategori_ia);
        }

        $this->db->get();
        $query = $this->db->last_query();
        return $query;
    }

    public function get_tahun_ia()
    {
        $this->db->select("DISTINCT YEAR(tanggal_awal_ia) as tahun_ia");
        $this->db->from("tbl_ia");
        return  $this->db->get();
    }

    public function insert_ia($data)
    {
        $this->db->insert('tbl_ia', $data);
        return  $this->db->affected_rows();
    }

    public function update_ia_by_id($id = "", $data = array())
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_ia', $data);
        return  $this->db->affected_rows();
    }

    public function get_ia_by_id($id = "")
    {
        $this->db->select("*");
        $this->db->from("tbl_ia as a");
        $this->db->where("id", $id);

        return  $this->db->get();
    }

    public function get_ia_by_waktu_buat($waktu_buat = "")
    {
        $this->db->select("*");
        $this->db->from("tbl_ia");
        $this->db->where('waktu_buat', $waktu_buat);
        return  $this->db->get();
    }

    public function delete_ia_by_id($id = "")
    {
        $this->db->where('id', $id);
        $this->db->delete("tbl_ia");
        return  $this->db->affected_rows();
    }

    public function get_rekapitulasi_kerjasama($tingkat_ia = "")
    {
        $this->db->select("a.id,d.nama_prodi,b.nama_lembaga_mitra_moa");
        $this->db->select("IF(a.tingkat_ia = 'Internasional', 'Internasional', NULL) as internasional");
        $this->db->select("IF(a.tingkat_ia = 'Nasional', 'Nasional', NULL) as nasional");
        $this->db->select("IF(a.tingkat_ia = 'Wilayah', 'Wilayah', NULL) as wilayah");
        $this->db->select("a.judul_kegiatan,a.manfaat_kegiatan,a.tanggal_awal_ia,a.dokumen1");
        $this->db->select("DATEDIFF(a.tanggal_akhir_ia,a.tanggal_awal_ia) as selisih_hari");
        $this->db->select("b.dokumen1_moa,b.dokumen2_moa,b.dokumen3_moa");
        $this->db->select("f.dokumen");
        $this->db->from("tbl_ia as a");
        $this->db->join("tbl_moa as b", "b.id = a.moa_id");
        $this->db->join("tbl_moa_prodi as c", "c.moa_id = b.id");
        $this->db->join("tb_prodi as d", "d.kode_prodi = c.kode_prodi");
        $this->db->join("tbl_mou as f", "f.id = b.mou_id", 'left');
        if ($tingkat_ia != "") {
            $this->db->where("a.tingkat_ia", $tingkat_ia);
        }
        $this->db->get();
        $query = $this->db->last_query();
        return $query;
    }

    public function get_ia_prodi_by_moa_id($moa_id = "")
    {
        $this->db->select("a.*,c.kode_prodi,c.nama_prodi,DATEDIFF(a.tanggal_akhir_ia,a.tanggal_awal_ia) as selisih_hari");
        $this->db->from("tbl_ia as a");
        $this->db->join("tbl_moa_prodi as b", "b.moa_id = a.moa_id");
        $this->db->join("tb_prodi as c", "c.kode_prodi = b.kode_prodi");
        $this->db->where("a.moa_id", $moa_id);
        return  $this->db->get();
    }

    public function get_ia_prodi_by_moa_id_prodi($ia_id = "", $kode_prodi = "")
    {
        $this->db->select("a.*,c.kode_prodi,b.nama_lembaga_mitra_moac.nama_prodi,DATEDIFF(a.tanggal_akhir_ia,a.tanggal_awal_ia) as selisih_hari");
        $this->db->from("tbl_ia as a");
        $this->db->join("tbl_moa_prodi as b", "b.moa_id = a.moa_id");
        $this->db->join("tb_prodi as c", "c.kode_prodi = b.kode_prodi");
        $this->db->where("a.id", $ia_id);
        $this->db->where("b.kode_prodi", $kode_prodi);
        return  $this->db->get();
    }

    public function get_rekapitulasi_kerjasama_for_pdf($tanggal_awal_ia = "", $tanggal_akhir_ia = "")
    {

        // $this->db->select("a.id,d.nama_prodi,b.nama_lembaga_mitra_moa");
        // $this->db->select("IF(a.tingkat_ia = 'Internasional', 'Internasional', NULL) as internasional");
        // $this->db->select("IF(a.tingkat_ia = 'Nasional', 'Nasional', NULL) as nasional");
        // $this->db->select("IF(a.tingkat_ia = 'Wilayah', 'Wilayah', NULL) as wilayah");
        // $this->db->select("a.judul_kegiatan,a.manfaat_kegiatan,a.tanggal_awal_ia,a.dokumen1");
        // $this->db->from("tbl_ia as a");
        // $this->db->join("tbl_moa as b", "b.id = a.moa_id");
        // $this->db->join("tbl_moa_prodi as c", "c.moa_id = b.id");
        // $this->db->join("tb_prodi as d", "d.kode_prodi = c.kode_prodi");
        // $this->db->where("a.tanggal_awal_ia BETWEEN '$tanggal_awal_ia' AND '$tanggal_akhir_ia' ");

        $this->db->select("a.id as no,a.id,d.nama_prodi,b.nama_lembaga_mitra_moa,a.tingkat_ia,a.judul_kegiatan,a.manfaat_kegiatan,a.tanggal_awal_ia,a.tanggal_akhir_ia,DATEDIFF(a.tanggal_akhir_ia,a.tanggal_awal_ia) as selisih_hari");
        $this->db->select("IF(a.tingkat_ia = 'Internasional', 'Internasional', NULL) as internasional");
        $this->db->select("IF(a.tingkat_ia = 'Nasional', 'Nasional', NULL) as nasional");
        $this->db->select("IF(a.tingkat_ia = 'Wilayah', 'Wilayah', NULL) as wilayah");
        $this->db->from("tbl_ia as a");
        $this->db->join("tbl_moa as b", "b.id = a.moa_id");
        $this->db->join("tbl_moa_prodi as c", "c.moa_id = b.id");
        $this->db->join("tb_prodi as d", "d.kode_prodi = c.kode_prodi");
        $this->db->where("a.tanggal_awal_ia BETWEEN '$tanggal_awal_ia' AND '$tanggal_akhir_ia' ");

        return  $this->db->get();
    }
}
