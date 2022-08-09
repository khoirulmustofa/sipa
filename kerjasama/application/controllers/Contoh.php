<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contoh extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $semester_ganjil_array = array('9', '10', '11', '12', '1', '2');
        $semester_genap_array = array('3', '4', '5', '6', '7', '8');
        $month = "2022-12-02";
        $bulan = substr($month, 5, 2);

        if (in_array($bulan, $semester_ganjil_array)) {
           echo "Semester Ganjil";
        } else if (in_array($bulan, $semester_genap_array)) {
            echo "semester Genap";
        }
    }
}
