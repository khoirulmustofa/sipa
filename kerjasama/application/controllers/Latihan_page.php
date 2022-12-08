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
        //     $array = ['a','b','c','d','e','f','g','h','i','j'];

        //   print_r(array_search('z',$array));    

        echo date('Y', strtotime('-1 year'));
    }
}
