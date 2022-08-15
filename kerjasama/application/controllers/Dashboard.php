<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        // cek login dari app_helper
        //is_login();
    }

    public function index()
    {
        // load model
        $this->load->model('Kerja_sama_model');
        $this->load->model('Prodi_model');
        $this->load->model('Kegiatan_model');

        $kode_prodi = '';
        if ($_SESSION['status_login'] == "Fakultas") {
            $kode_prodi = '';
        } else {
            $kode_prodi = $_SESSION['kode_prodi'];
        }


        $tahun_kerja_sama =  $this->input->get('tahun_kerja_sama', TRUE);
        // ambil query jumlah kerja sama MOA dan MOU

        $tahun_kerja_sama_result = $this->Kerja_sama_model->get_tahun_kerja_sama()->result();
        $prodi_result = $this->Prodi_model->get_prodi_by_id($kode_prodi)->result();

        $data['semester_result'] = $this->Kegiatan_model->get_semester()->result();

        $data['menu'] = 'menu_dashboard';
        $data['title'] = "Dashboard";
        $data['load_css'] = '';
        $data['load_js'] = 'dashboard/js_index';
        $data['tahun_kerja_sama_result'] = $tahun_kerja_sama_result;
        $data['prodi_result'] = $prodi_result;
        $data['semester_result'] = $this->Kegiatan_model->get_semester()->result();

        $this->template->load('_template/main_template', 'dashboard/view_index', $data);
    }

    public function data_kegiatan()
    {
        $this->load->model('Kegiatan_model');

        $tahun_semester = $this->input->get('tahun_semester', TRUE);
        
        $kode_prodi = '';
        if ($_SESSION['status_login'] == "Fakultas") {
            $kode_prodi = '';
        } else {
            $kode_prodi = $_SESSION['kode_prodi'];
        }

        $jumlah_kegiatan_per_prodi_result = $this->Kegiatan_model->get_count_kegiatan_per_prodi($kode_prodi,$tahun_semester)->result();

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
