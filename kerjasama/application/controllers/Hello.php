<?php

class Hello extends CI_Controller
{
    public function index()
    {
        $data['mahasiswa'] = $this->m_mhs->tampil_data()->result();
        $this->load->view('v_mhs', $data);
    }
    public function tambah()
    {

        $this->load->view('input_mhs');
    }
    public function tambah_aksi()
    {

        $npm = $this->input->post('npm');
        $nama_mhs = $this->input->post('nama_mhs');
        $jk_mhs = $this->input->post('jk_mhs');
        $tgl_lahir = $this->input->post('tgl_lahir');
        $alamat = $this->input->post('alamat');

        $data = array(
            'npm' => $npm,
            'nama_mhs' => $nama_mhs,
            'jk_mhs' => $jk_mhs,
            'tgl_lahir' => $tgl_lahir,
            'alamat' => $alamat
        );

        $this->m_mhs->input_data($data);
        redirect('hello/index');
    }

    public function hapus($npm)
    {
        $where = array('npm' => $npm);
        $this->m_mhs->hapus_data($where);
        redirect('hello/index');
    }
}
