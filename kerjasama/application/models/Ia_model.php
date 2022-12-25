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
        $this->db->join("tb_prodi as d", "d.kode_prodi = a. kode_prodi");
        $this->db->join("tbl_ia_kategori as e", "e.ia_id = a. id");
        if ($kode_prodi != "") {
            $this->db->where('c.kode_prodi', $kode_prodi);
        }

        if ($tahun_ia != "") {
            $this->db->where("YEAR(a.tanggal_awal_ia)", $tahun_ia);
        } else {
            $this->db->where("YEAR(a.tanggal_awal_ia) >=", date('Y', strtotime('-5 year')));
        }

        if ($kategori_ia != "") {
            $this->db->where('e.kategori', $kategori_ia);
        }
        $this->db->group_by('c.kode_prodi');
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
        $this->db->select("*,DATEDIFF(a.tanggal_akhir_ia,a.tanggal_awal_ia) as selisih_hari");
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

    public function get_rekapitulasi_kerjasama($tingkat_ia = "", $kategori_ia = "", $kode_prodi = "")
    {
        $this->db->select("a.id,d.nama_prodi,b.nama_lembaga_mitra");
        $this->db->select("IF(a.tingkat_ia = 'Internasional', 'Internasional', NULL) as internasional");
        $this->db->select("IF(a.tingkat_ia = 'Nasional', 'Nasional', NULL) as nasional");
        $this->db->select("IF(a.tingkat_ia = 'Wilayah', 'Wilayah', NULL) as wilayah");
        $this->db->select("a.judul_kegiatan_ia,a.manfaat_kegiatan_ia,a.tanggal_awal_ia,tanggal_akhir_ia");
        $this->db->select("f.file_dokumen");
        $this->db->select("DATEDIFF(a.tanggal_akhir_ia,a.tanggal_awal_ia) as selisih_hari");
        $this->db->from("tbl_ia as a");
        $this->db->join("tbl_moa_lembaga_mitra  as b", "b.id = a.moa_lembaga_mitra_id",);
        $this->db->join("tbl_moa_prodi as c", "c.moa_id = b. moa_id");
        $this->db->join("tb_prodi as d", "d.kode_prodi = a. kode_prodi");
        $this->db->join("tbl_ia_dokumen as f", "f.ia_id = a.id");

        // $this->db->select("a.id as no,a.id,d.nama_prodi,a.tingkat_ia,a.judul_kegiatan_ia,a.tanggal_awal_ia,a.tanggal_akhir_ia,DATEDIFF(a.tanggal_akhir_ia,a.tanggal_awal_ia) as selisih_hari");
        // $this->db->select("IF(a.tingkat_ia = 'Internasional', 'Internasional', NULL) as internasional");
        // $this->db->select("IF(a.tingkat_ia = 'Nasional', 'Nasional', NULL) as nasional");
        // $this->db->select("IF(a.tingkat_ia = 'Wilayah', 'Wilayah', NULL) as wilayah");
        // $this->db->from("tbl_ia as a");
        // $this->db->join("tbl_moa_lembaga_mitra  as b", "b.id = a.moa_lembaga_mitra_id");
        // $this->db->join("tbl_moa_prodi as c", "c.moa_id = b. moa_id");
        // $this->db->join("tb_prodi as d", "d.kode_prodi = c. kode_prodi");

        if ($tingkat_ia != "") {
            $this->db->where("a.tingkat_ia", $tingkat_ia);
        }

        if ($kategori_ia != "") {
            $this->db->where('a.kategori_ia', $kategori_ia);
        }

        if ($kode_prodi != "") {
            $this->db->where('d.kode_prodi', $kode_prodi);
        }
        $this->db->group_by("a.id,d.nama_prodi");
        $this->db->get();
        $query = $this->db->last_query();
        return $query;
    }

    public function get_dosen_by_ia_id($ia_id = "")
    {
        $this->db->select("a.*,c.*");
        $this->db->from("tbl_ia as a");
        $this->db->join("tbl_ia_dosen as b", "b.ia_id = a.id");
        $this->db->join("tb_dosen as c", "c.npk = b. npk");
        
        $this->db->where("a.id", $ia_id);
        return  $this->db->get();
    }

    public function get_ia_prodi_by_moa_id_prodi($ia_id = "", $kode_prodi = "")
    {
        $this->db->select("a.*,c.kode_prodi,d.nama_prodi,DATEDIFF(a.tanggal_akhir_ia,a.tanggal_awal_ia) as selisih_hari");
        $this->db->from("tbl_ia as a");
        $this->db->join("tbl_moa_lembaga_mitra as b", "b.id = a.moa_lembaga_mitra_id");
        $this->db->join("tbl_moa_prodi as c", "c.moa_id = b.moa_id");
        $this->db->join("tb_prodi as d", "d.kode_prodi = c. kode_prodi");
        $this->db->where("a.id", $ia_id);
        $this->db->where("c.kode_prodi", $kode_prodi);
        return  $this->db->get();
    }

    public function get_ia_prodi_by_moa_id($moa_id = "")
    {
        $this->db->select("a.*,c.kode_prodi,d.nama_prodi,DATEDIFF(a.tanggal_akhir_ia,a.tanggal_awal_ia) as selisih_hari");
        $this->db->from("tbl_ia as a");
        $this->db->join("tbl_moa_lembaga_mitra as b", "b.id = a.moa_lembaga_mitra_id");
        $this->db->join("tbl_moa_prodi as c", "c.moa_id = b.moa_id");
        $this->db->join("tb_prodi as d", "d.kode_prodi = c. kode_prodi");
        $this->db->where("c.moa_id", $moa_id);
        return  $this->db->get();
    }

    public function get_rekapitulasi_kerjasama_for_pdf($tanggal_awal_ia = "", $tanggal_akhir_ia = "")
    {

        $this->db->select("a.id,d.nama_prodi,b.nama_lembaga_mitra");
        $this->db->select("IF(a.tingkat_ia = 'Internasional', 'Internasional', NULL) as internasional");
        $this->db->select("IF(a.tingkat_ia = 'Nasional', 'Nasional', NULL) as nasional");
        $this->db->select("IF(a.tingkat_ia = 'Wilayah', 'Wilayah', NULL) as wilayah");
        $this->db->select("a.judul_kegiatan_ia,a.manfaat_kegiatan_ia,a.tanggal_awal_ia");
        $this->db->select("DATEDIFF(a.tanggal_akhir_ia,a.tanggal_awal_ia) as selisih_hari");
        $this->db->from("tbl_ia as a");
        $this->db->join("tbl_moa_lembaga_mitra  as b", "b.id = a.moa_lembaga_mitra_id");
        $this->db->join("tbl_moa_prodi as c", "c.moa_id = b. moa_id");
        $this->db->join("tb_prodi as d", "d.kode_prodi = c. kode_prodi");
       
        $this->db->where("a.tanggal_awal_ia BETWEEN '$tanggal_awal_ia' AND '$tanggal_akhir_ia' ");

        return  $this->db->get();
    }


    public function get_ia_prodi_by_mou_id($mou_id = "")
    {
        $this->db->select("a.*,f.kode_prodi,f.nama_prodi,DATEDIFF(a.tanggal_akhir_ia,a.tanggal_awal_ia) as selisih_hari");
        $this->db->from("tbl_ia as a");
        $this->db->join("tbl_moa_lembaga_mitra as b", "b.id = a.moa_lembaga_mitra_id");
        $this->db->join("tbl_moa as c", "c.id = b.moa_id");
        $this->db->join("tbl_moa_prodi as d", "d.moa_id = c.id");
        $this->db->join("tb_prodi as f", "f.kode_prodi = d. kode_prodi");
        $this->db->where("c.mou_id", $mou_id);
        return  $this->db->get();
    }

    public function get_ia_prodi_by_ia_id($ia_id = "",$kode_prodi = "")
    {
        $this->db->select("a.*,f.kode_prodi,f.nama_prodi,DATEDIFF(a.tanggal_akhir_ia,a.tanggal_awal_ia) as selisih_hari");
        $this->db->from("tbl_ia as a");
        $this->db->join("tbl_moa_lembaga_mitra as b", "b.id = a.moa_lembaga_mitra_id");
        $this->db->join("tbl_moa as c", "c.id = b.moa_id");
        $this->db->join("tbl_moa_prodi as d", "d.moa_id = c.id");
        $this->db->join("tb_prodi as f", "f.kode_prodi = d. kode_prodi");
        $this->db->where("a.id", $ia_id);
        $this->db->where("d.kode_prodi", $kode_prodi);
        return  $this->db->get();
    }

    public function get_dokumen_moa_by_ia_id($ia_id = "")
    {
        $this->db->select("*");
        $this->db->from("tbl_ia as a");
        $this->db->join("tbl_moa_lembaga_mitra as b","b.id = a.moa_lembaga_mitra_id");
        $this->db->join("tbl_moa_dokumen as c","c.moa_id = b.moa_id");
        $this->db->where("a.id",$ia_id);
        return  $this->db->get();
    }

    public function get_dokumen_mou_by_ia_id($ia_id = "")
    {
        $this->db->select("*,d.dokumen as dokumen_mou");
        $this->db->from("tbl_ia as a");
        $this->db->join("tbl_moa_lembaga_mitra as b","b.id = a.moa_lembaga_mitra_id");
        $this->db->join("tbl_moa as c","c.id = b.moa_id");
        $this->db->join("tbl_mou as d","d.id = c.mou_id");
        $this->db->where("a.id",$ia_id);
        return  $this->db->get();
    }
}
