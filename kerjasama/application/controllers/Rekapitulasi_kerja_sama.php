<?php

use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\CodeigniterAdapter;
use phpDocumentor\Reflection\Types\This;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rekapitulasi_kerja_sama extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->model('Moa_model');

        $data['menu'] = 'menu_rekapitulasi';
        $data['title'] = "Table Kerja Sama Tridarma";
        $data['load_css'] = 'rekapitulasi_kerja_sama/css_index';
        $data['load_js'] = 'rekapitulasi_kerja_sama/js_index';
        $data['tahun_moa_result'] = $this->Moa_model->getTahunMOA()->result();
        $this->template->load('_template/main_template', 'rekapitulasi_kerja_sama/view_index', $data);
    }

    public function list()
    {
        $tingkat_ia = $this->input->post('tingkat_ia', TRUE);
        $this->load->model('Ia_model');

        $datatables = new Datatables(new CodeigniterAdapter());
        $query = $this->Ia_model->get_rekapitulasi_kerjasama($tingkat_ia);
        $datatables->query($query);
        echo $datatables->generate();
    }
}
