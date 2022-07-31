<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kerja_sama_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function get_tahun_kerja_sama()
    {
        $this->db->distinct();
        $this->db->select("YEAR(a.tgl_kerjasama) as tgl_kerjasama");
        $this->db->from("tb_kerjasama as a");
        $this->db->where("YEAR(tgl_kerjasama) > YEAR(DATE_SUB(NOW(), INTERVAL 5 YEAR))");
        $this->db->order_by('tgl_kerjasama');
        return  $this->db->get();
    }

    public function get_kerja_sama($jenis_kerjasama = "", $tahun_kerja_sama = "")
    {
        $this->db->select('a.id_kerjasama,a.jenis_kerjasama,a.periode,a.tgl_kerjasama,a.lembaga_mitra,a.alamat_mitra,a.negara_id,a.provinsi_id,a.kabupaten_kota_id,a.kecamatan_id,a.kelurahan_id,a.durasi_kerjasama,a.akhir_kerjasama,a.dokumen_kerjasama');
        $this->db->select('b.nama_negara,c.province_name,d.kota_kabupaten_nama,e.kecamatan_nama,f.kelurahan_nama');
        $this->db->select("DATE(DATE_SUB(a.akhir_kerjasama, INTERVAL 90 DAY)) as 'tgl_peringatan'");
        $this->db->from('tb_kerjasama as a');
        $this->db->join('master_negara as b', 'b.id = a.negara_id');
        $this->db->join('master_provinsi as c', 'c.master_provinsi_id = a.provinsi_id', 'left');
        $this->db->join('master_kota_kabupaten as d', 'd.master_kota_kabupaten_id = a.kabupaten_kota_id', 'left');
        $this->db->join('master_kecamatan as e', 'e.master_kecamatan_id = a.kecamatan_id', 'left');
        $this->db->join('master_kelurahan as f', 'f.master_kelurahan_id = a.kelurahan_id', 'left');
        if ($jenis_kerjasama != "") {
            $this->db->where('jenis_kerjasama', $jenis_kerjasama);
        }
        if ($tahun_kerja_sama != "") {
            $this->db->where('YEAR(tgl_kerjasama)', $tahun_kerja_sama);
        }
        return  $this->db->get();
    }



    public function insert_tb_kerjasama($data = array())
    {
        $this->db->insert('tb_kerjasama', $data);
        $this->db->save_queries = TRUE;
        $query = $this->db->last_query();
        return $query;
    }

    public function update_tb_kerjasama_by_id($data = array(), $id_kerjasama = "")
    {
        $this->db->where('id_kerjasama', $id_kerjasama);
        $this->db->update('tb_kerjasama', $data);
        $this->db->save_queries = TRUE;
        $query = $this->db->last_query();
        return $query;
    }

    public function delete_tb_kerjasama_by_id($id_kerjasama = "")
    {
        $this->db->where('id_kerjasama', $id_kerjasama);
        $this->db->delete('tb_kerjasama');
        $this->db->save_queries = TRUE;
        $query = $this->db->last_query();
        return $query;
    }

    public function get_tb_kerjasama_by_id($id_kerjasama = "")
    {
        $this->db->select("*");
        $this->db->from("tb_kerjasama as a");
        $this->db->where("a.id_kerjasama", $id_kerjasama);
        return  $this->db->get();
    }

    public function get_count_kerja_sama($tahun_kerja_sama = "")
    {
        $this->db->select("COUNT(IF(jenis_kerjasama = 'MOU', jenis_kerjasama, NULL)) AS MOU");
        $this->db->select("COUNT(IF(jenis_kerjasama = 'MOA', jenis_kerjasama, NULL)) AS MOA");
        $this->db->from("tb_kerjasama");
        if ($tahun_kerja_sama != "") {
            $this->db->where("YEAR(tgl_kerjasama)", $tahun_kerja_sama);
        }
        return  $this->db->get();
    }

    public function get_tb_kerjasama_dll_by_id($id_kerjasama = "")
    {
        $this->db->select('a.id_kerjasama,a.jenis_kerjasama,a.periode,a.tgl_kerjasama,a.lembaga_mitra,a.alamat_mitra,a.negara_id,a.provinsi_id,a.kabupaten_kota_id,a.kecamatan_id,a.kelurahan_id,a.durasi_kerjasama,a.akhir_kerjasama,a.dokumen_kerjasama,a.perbaharui');
        $this->db->select('b.nama_negara,c.province_name,d.kota_kabupaten_nama,e.kecamatan_nama,f.kelurahan_nama');
        $this->db->select("DATE(DATE_SUB(a.akhir_kerjasama, INTERVAL 90 DAY)) as 'tgl_peringatan'");
        $this->db->from('tb_kerjasama as a');
        $this->db->join('master_negara as b', 'b.id = a.negara_id');
        $this->db->join('master_provinsi as c', 'c.master_provinsi_id = a.provinsi_id', 'left');
        $this->db->join('master_kota_kabupaten as d', 'd.master_kota_kabupaten_id = a.kabupaten_kota_id', 'left');
        $this->db->join('master_kecamatan as e', 'e.master_kecamatan_id = a.kecamatan_id', 'left');
        $this->db->join('master_kelurahan as f', 'f.master_kelurahan_id = a.kelurahan_id', 'left');
        $this->db->where('id_kerjasama', $id_kerjasama);
        return  $this->db->get();
    }
}
