<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Latihan_page extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        // cek login dari app_helper
        //is_login();
    }

    public function index()
    {
        $data['menu'] = 'menu_latihan';
        $data['title'] = "Daftar Latihan Page";
        $data['load_css'] = '';
        $data['load_js'] = '';

        $this->template->load('_template/main_template', 'latihan_page/view_index', $data);
    }
}