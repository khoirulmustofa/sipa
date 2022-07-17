<?php
class M_kerjasama extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('tb_kerjasama');
    }

    public function tambah_aksi_kerjasama($data)
    {
        return $this->db->insert('tb_kerjasama', $data);
    }

    public function edit_aksi_kerjasama($where, $data)
    {
        $this->db->where($where);
        $this->db->update('tb_kerjasama', $data);
    }

    public function hapus_aksi_kerjasama($where)
    {
        $this->db->where($where);
        $this->db->delete('tb_kerjasama');
    }
}
