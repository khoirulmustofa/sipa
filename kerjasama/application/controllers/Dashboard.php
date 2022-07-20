<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        // cek login dari app_helper
        is_login();
    }

    public function index()
    {
        // load model
        $this->load->model('Kerja_sama_model');

        // ambil query jumlah kerja sama MOA dan MOU
        $jumlah_kerja_sama_row = $this->Kerja_sama_model->get_count_kerja_sama()->row();


        $data['menu'] = 'menu_dashboard';
        $data['title'] = "Dashboard";
        $data['load_css'] = '';
        $data['load_js'] = '';
        $data['jumlah_kerja_sama_row'] = $jumlah_kerja_sama_row;

        $this->template->load('_template/main_template', 'dashboard/view_index', $data);
    }
}
