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

    public function cetak_pdf()
    {
        $tanggal_awal = $this->input->get('tanggal_awal', TRUE);
        $tanggal_akhir =  $this->input->post('tanggal_akhir', TRUE);

        $data['menu'] = "";

        $html = $this->load->view('rekapitulasi_kerja_sama/view_cetak_pdf', $data, true);
        $mpdf = new Mpdf\Mpdf([
            'debug' => true,
            'format' => 'A4-P',
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 30,
            'margin_bottom' => 10,
            'margin_header' => 5,
            'margin_footer' => 5
        ]);

        // $mpdf->SetWatermarkImage('custom/images/logo_kepala.png', -1, [150, 150], 'F');
        // $mpdf->showWatermarkImage = false;
        // $mpdf->watermarkTextAlpha = 0.5;
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($html);
        $mpdf->Output("Table Kerja Sama Tridarma.pdf", "I");
    }
}
