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
        $data['menu'] = 'menu_dashboard';
        $data['title'] = "Dashboard";
        $data['load_css'] = '';
        $data['load_js'] = '';

        $this->template->load('_template/main_template', 'dashboard/view_index', $data);
    }
}
