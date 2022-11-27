<?php

use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\CodeigniterAdapter;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ia extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    // tampil MOA
    public function index()
    {
        $this->load->model('Ia_model');

        $data['menu'] = 'menu_ia';
        $data['title'] = "Implementation Arrangement (IA)";
        $data['load_css'] = 'ia/css_index';
        $data['load_js'] = 'ia/js_index';
        // $data['tahun_moa_result'] = $this->Moa_model->getTahunMOA()->result();
        $this->template->load('_template/main_template', 'ia/view_index', $data);
    }

    //  data ajax list MOU
    public function list()
    {
        $tahun_kerja_sama = $this->input->post('tahun_kerja_sama', TRUE);
        $this->load->model('Ia_model');

        $datatables = new Datatables(new CodeigniterAdapter());
        $query = $this->Ia_model->getIAList();
        $datatables->query($query);
        echo $datatables->generate();
    }

    public function create()
    {
        $this->load->model('Ia_model');
        $this->load->model('Moa_model');
        $this->load->model('Dosen_model');

        $data['menu'] = "menu_ia";
        $data['title'] = 'Tambah Implementation Arrangement (IA)';
        $data['action'] = "ia/create_action";
        $data['load_js'] = 'ia/js_form';
        $data['id']  = set_value('id');
        $data['moa_id']  = set_value('moa_id');
        $data['kategori_moa']  = set_value('kategori_moa');
        $data['tingkat_moa']  = set_value('tingkat_moa');
        $data['judul_kegiatan']  = set_value('judul_kegiatan');
        $data['manfaat_kegiatan']  = set_value('manfaat_kegiatan');
        $data['tanggal_awal']  = set_value('tanggal_awal');
        $data['tanggal_akhir']  = set_value('tanggal_akhir');
        $data['dosen_terlibat[]']  = set_value('dosen_terlibat');

        $data['moa_result'] = $this->Moa_model->get_moa()->result();
        $data['dosen_result'] = $this->Dosen_model->get_dosen()->result();

        $data_response =  array(
            'status' => true,
            'view_modal_form' => $this->load->view('ia/view_form', $data, true)
        );
        echo json_encode($data_response);
    }

    public function create_action()
    {
        $this->load->model('Ia_model');

        // validasi form
        $this->form_validation->set_rules('moa_id', 'moa id', 'trim|required');
        $this->form_validation->set_rules('kategori_moa', 'kategori moa', 'trim|required');
        $this->form_validation->set_rules('tingkat_moa', 'tingkat moa', 'trim|required');
        $this->form_validation->set_rules('judul_kegiatan', 'judul kegiatan', 'trim|required');
        $this->form_validation->set_rules('manfaat_kegiatan', 'manfaat kegiatan', 'trim|required');
        $this->form_validation->set_rules('tanggal_awal', 'tanggal awal', 'trim|required');
        $this->form_validation->set_rules('tanggal_akhir', 'tanggal akhir', 'trim|required');
        $this->form_validation->set_rules('dosen_terlibat[]', 'dosen terlibat', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data_response =  array(
                'status' => false,
                // 'token_csrf' => $this->security->get_csrf_hash(),
                'messege' => validation_errors(),
            );
            echo json_encode($data_response);
        } else {
            // jika ada dokumen
            // if (!empty($_FILES['dokumen']['name'])) {
            //     $config_doc1['upload_path'] = './assets/doc_ia/';
            //     $config_doc1['allowed_types'] = '*';
            //     $config_doc1['file_name'] = "doc__mou_" . date('Ymdhis');
            //     $this->load->library('upload', $config_doc1);
            //     $this->upload->initialize($config_doc1);

            //     $this->upload->do_upload('dokumen');
            //     $data_upload1 = $this->upload->data();
            //     $data['dokumen'] = $data_upload1['file_name'];
            // }

            $data['moa_id'] = $this->input->post('moa_id', TRUE);
            $data['kategori_moa'] = $this->input->post('kategori_moa', TRUE);
            $data['tingkat_moa'] = $this->input->post('tingkat_moa', TRUE);
            $data['judul_kegiatan'] = $this->input->post('judul_kegiatan', TRUE);
            $data['manfaat_kegiatan'] = $this->input->post('manfaat_kegiatan', TRUE);
            $data['tanggal_awal'] = $this->input->post('tanggal_awal', TRUE);
            $data['tanggal_akhir'] = $this->input->post('tanggal_akhir', TRUE);
            $data['dosen_terlibat'] = implode("#", $this->input->post('dosen_terlibat[]', TRUE));

            if ($this->Ia_model->insert_ia($data) > 0) {
                $data_response =  array(
                    'status' => true,
                    // 'token_csrf' => $this->security->get_csrf_hash(),
                    'messege' => 'Tambah Implementation Arrangement (IA) BERHASIL'
                );
            } else {
                $data_response =  array(
                    'status' => false,
                    // 'token_csrf' => $this->security->get_csrf_hash(),
                    'messege' => 'Tambah Implementation Arrangement (IA) GAGAL'
                );
            }
            echo json_encode($data_response);
        }
    }
}
