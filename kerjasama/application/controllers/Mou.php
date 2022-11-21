<?php

use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\CodeigniterAdapter;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mou extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }


    // tampil MOU
    public function index()
    {
        $this->load->model('Mou_model');
        
        $data['menu'] = 'menu_mou';
        $data['title'] = "Memorandum of Understanding (MOU)";
        $data['load_css'] = 'mou/css_index';
        $data['load_js'] = 'mou/js_index';
        $data['tahun_mou_result'] = $this->Mou_model->getTahunMOU()->result();
        $this->template->load('_template/main_template', 'mou/view_index', $data);
    }

    //  data ajax list MOU
    public function list()
    {
        $tahun_kerja_sama = $this->input->post('tahun_kerja_sama', TRUE);        
        $this->load->model('Mou_model');

        $datatables = new Datatables(new CodeigniterAdapter());
        $query = $this->Mou_model->getMOUList($tahun_kerja_sama);
        // print_r($query);
        // exit();
        $datatables->query($query);
        echo $datatables->generate();
    }
}
