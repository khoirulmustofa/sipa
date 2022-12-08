<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('template');
        // cek login dari app_helper
        is_login();
    }

    public function index()
    {
        // init model
        $this->load->model('Moa_model');
        $this->load->model('Prodi_model');

        $data['menu'] = 'menu_dashboard';
        $data['title'] = "Dashboard";
        $data['load_js'] = 'dashboard/js_index';
        $data['tahun_moa_result'] = $this->Moa_model->get_tahun_moa()->result();
        $data['prodi_result'] = $this->Prodi_model->get_prodi()->result();

        $this->template->load('_template/main_template', 'dashboard/view_index', $data);
    }

    public function count_mou()
    {
        $this->load->model('Mou_model');

        $tahun = $this->input->get('tahun', TRUE);

        $data_response['status'] = true;
        $data_response['count_mou'] = $this->Mou_model->get_count_mou($tahun);

        echo json_encode($data_response);
    }

    public function count_moa()
    {
        $this->load->model('Moa_model');

        $tahun = $this->input->get('tahun', TRUE);
        $tingkat_moa = $this->input->get('tingkat_moa', TRUE);
        $data_response['status'] = true;
        $data_response['count_moa'] = $this->Moa_model->get_count_moa($tahun, $tingkat_moa);

        echo json_encode($data_response);
    }

    public function count_kegiatan_perprodi()
    {
        // ini model
        $this->load->model('Moa_model');
        // set kode prodi
        $kode_prodi = "";

        $tahun = $this->input->get('tahun', TRUE);
        $tingkat_moa = $this->input->get('tingkat_moa', TRUE);

        $data_response['status'] = true;
        $data_response['data_count_kegiatan'] = $this->Moa_model->get_count_moa_by_prodi($kode_prodi,$tahun,$tingkat_moa)->result();

        echo json_encode($data_response);
    }

    public function data_kegiatan()
    {
        $this->load->model('Kegiatan_model');

        $tahun_semester = $this->input->get('tahun_semester', TRUE);

        $kode_prodi = '';
        if ($_SESSION['status_login'] == "Fakultas") {
            $kode_prodi = '';
        } else {
            // cek kode stutus login adalah prodi
            if ($_SESSION['status_login'] == "Prodi") {
                $kode_prodi = $_SESSION['kode_prodi'];
            } else {
                // jika tidak prodi
                $kode_prodi = '';
            }
        }

        $jumlah_kegiatan_per_prodi_result = $this->Kegiatan_model->get_count_kegiatan_per_prodi($kode_prodi, $tahun_semester)->result();

        $data_response['status'] = true;
        $data_response['jumlah_kegiatan_per_prodi_result'] = $jumlah_kegiatan_per_prodi_result;

        echo json_encode($data_response);
    }

    public function index_json()
    {
        $this->load->model('Kerja_sama_model');
        $this->load->model('Kegiatan_model');



        $tahun_kerja_sama =  $this->input->get('tahun_kerja_sama', TRUE);
        $jumlah_kerja_sama_row = $this->Kerja_sama_model->get_count_kerja_sama($tahun_kerja_sama)->row();
        $data_response['status'] = true;
        $data_response['jumlah_kerja_sama_row'] = $jumlah_kerja_sama_row;

        echo json_encode($data_response);
    }
}
