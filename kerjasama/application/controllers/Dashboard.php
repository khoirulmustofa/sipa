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
        $tahun_kerja_sama =  $this->input->get('tahun_kerja_sama', TRUE);
        // ambil query jumlah kerja sama MOA dan MOU

        $tahun_kerja_sama_result = $this->Kerja_sama_model->get_tahun_kerja_sama()->result();

        $data['menu'] = 'menu_dashboard';
        $data['title'] = "Dashboard";
        $data['load_css'] = '';
        $data['load_js'] = 'dashboard/js_index';
        $data['tahun_kerja_sama_result'] = $tahun_kerja_sama_result;

        $this->template->load('_template/main_template', 'dashboard/view_index', $data);
    }

    public function index_json()
    {
        $this->load->model('Kerja_sama_model');
        $tahun_kerja_sama =  $this->input->get('tahun_kerja_sama', TRUE);
        $jumlah_kerja_sama_row = $this->Kerja_sama_model->get_count_kerja_sama($tahun_kerja_sama)->row();

        $data_response['status'] = true;
        $data_response['jumlah_kerja_sama_row'] = $jumlah_kerja_sama_row;

        echo json_encode($data_response);
    }
}
