<?php
class M_mhs extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('t_mahasiswa');
    }

    public function input_data($data)
    {
        return $this->db->insert('t_mahasiswa', $data);
    }

    public function hapus_data($where)
    {
        $this->db->where($where);
        $this->db->delete('t_mahasiswa');
    }
}
