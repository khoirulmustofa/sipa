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
        $data['id']  = set_value('id');
        $data['moa_id']  = set_value('moa_id');
        $data['kategori_ia']  = set_value('kategori_ia');
        $data['tingkat_ia']  = set_value('tingkat_ia');
        $data['judul_kegiatan']  = set_value('judul_kegiatan');
        $data['manfaat_kegiatan']  = set_value('manfaat_kegiatan');
        $data['tanggal_awal']  = set_value('tanggal_awal');
        $data['tanggal_akhir']  = set_value('tanggal_akhir');
        $data['dosen_terlibat']  = set_value('dosen_terlibat');

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
        $this->form_validation->set_rules('kategori_ia', 'kategori moa', 'trim|required');
        $this->form_validation->set_rules('tingkat_ia', 'tingkat moa', 'trim|required');
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
            // jika ada dokumen 1
            if (!empty($_FILES['dokumen1']['name'])) {
                $config_doc1['upload_path'] = './assets/doc_ia/';
                $config_doc1['allowed_types'] = '*';
                $config_doc1['file_name'] = "doc1_" . date('Ymdhis');
                $this->load->library('upload', $config_doc1);
                $this->upload->initialize($config_doc1);

                $this->upload->do_upload('dokumen1');
                $data_upload1 = $this->upload->data();
                $data['dokumen1'] = $data_upload1['file_name'];
            }

            // jika ada dokumen 2
            if (!empty($_FILES['dokumen2']['name'])) {
                $config_doc2['upload_path'] = './assets/doc_ia/';
                $config_doc2['allowed_types'] = '*';
                $config_doc2['file_name'] = "doc2_" . date('Ymdhis');
                $this->load->library('upload', $config_doc2);
                $this->upload->initialize($config_doc2);

                $this->upload->do_upload('dokumen2');
                $data_upload2 = $this->upload->data();
                $data['dokumen2'] = $data_upload2['file_name'];
            }

            // jika ada dokumen 3
            if (!empty($_FILES['dokumen3']['name'])) {
                $config_doc3['upload_path'] = './assets/doc_ia/';
                $config_doc3['allowed_types'] = '*';
                $config_doc3['file_name'] = "doc3_" . date('Ymdhis');
                $this->load->library('upload', $config_doc3);
                $this->upload->initialize($config_doc3);

                $this->upload->do_upload('dokumen3');
                $data_upload3 = $this->upload->data();
                $data['dokumen3'] = $data_upload3['file_name'];
            }

            $data['moa_id'] = $this->input->post('moa_id', TRUE);
            $data['kategori_ia'] = $this->input->post('kategori_ia', TRUE);
            $data['tingkat_ia'] = $this->input->post('tingkat_ia', TRUE);
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

    public function detail()
    {
        $this->load->model('Ia_model');
        $this->load->model('Moa_model');
        $this->load->model('Dosen_model');

        $id = $this->input->get('id', TRUE);
        $ia_row = $this->Ia_model->get_ia_by_id($id)->row();

        $data['title'] = 'Detail Implementation Arrangement (IA)';
        $data['id']  = $ia_row->id;
        $data['kategori_ia']  = $ia_row->kategori_ia;
        $data['moa_id']  = $ia_row->moa_id;
        $data['tingkat_ia']  = $ia_row->tingkat_ia;
        $data['judul_kegiatan']  = $ia_row->judul_kegiatan;
        $data['manfaat_kegiatan']  = $ia_row->manfaat_kegiatan;
        $data['tanggal_awal']  = $ia_row->tanggal_awal;
        $data['tanggal_akhir']  = $ia_row->tanggal_akhir;
        $data['dosen_terlibat']  = $ia_row->dosen_terlibat;
        $data['dokumen1']  = $ia_row->dokumen1;
        $data['dokumen2']  = $ia_row->dokumen2;
        $data['dokumen3']  = $ia_row->dokumen3;

        $data['moa_result'] = $this->Moa_model->get_moa()->result();
        $data['dosen_result'] = $this->Dosen_model->get_dosen()->result();

        $data_response =  array(
            'status' => true,
            'view_modal_form' => $this->load->view('ia/view_detail', $data, true)
        );
        echo json_encode($data_response);
    }

    public function update()
    {
        $this->load->model('Ia_model');
        $this->load->model('Moa_model');
        $this->load->model('Dosen_model');

        $id = $this->input->get('id', TRUE);
        $ia_row = $this->Ia_model->get_ia_by_id($id)->row();

        $data['menu'] = "menu_ia";
        $data['title'] = 'Update Implementation Arrangement (IA)';
        $data['action'] = "ia/update_action";
        $data['id']  = $ia_row->id;
        $data['kategori_ia']  = $ia_row->kategori_ia;
        $data['moa_id']  = $ia_row->moa_id;
        $data['tingkat_ia']  = $ia_row->tingkat_ia;
        $data['judul_kegiatan']  = $ia_row->judul_kegiatan;
        $data['manfaat_kegiatan']  = $ia_row->manfaat_kegiatan;
        $data['tanggal_awal']  = $ia_row->tanggal_awal;
        $data['tanggal_akhir']  = $ia_row->tanggal_akhir;
        $data['dosen_terlibat']  = $ia_row->dosen_terlibat;

        $data['moa_result'] = $this->Moa_model->get_moa()->result();
        $data['dosen_result'] = $this->Dosen_model->get_dosen()->result();

        $data_response =  array(
            'status' => true,
            'view_modal_form' => $this->load->view('ia/view_form', $data, true)
        );
        echo json_encode($data_response);
    }

    public function update_action()
    {
        $this->load->model('Ia_model');

        // validasi form
        $this->form_validation->set_rules('moa_id', 'moa id', 'trim|required');
        $this->form_validation->set_rules('kategori_ia', 'kategori moa', 'trim|required');
        $this->form_validation->set_rules('tingkat_ia', 'tingkat moa', 'trim|required');
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
            // jika ada dokumen 1
            if (!empty($_FILES['dokumen1']['name'])) {
                $config_doc1['upload_path'] = './assets/doc_ia/';
                $config_doc1['allowed_types'] = '*';
                $config_doc1['file_name'] = "doc1_" . date('Ymdhis');
                $this->load->library('upload', $config_doc1);
                $this->upload->initialize($config_doc1);

                $this->upload->do_upload('dokumen1');
                $data_upload1 = $this->upload->data();
                $data['dokumen1'] = $data_upload1['file_name'];
            }

            // jika ada dokumen 2
            if (!empty($_FILES['dokumen2']['name'])) {
                $config_doc2['upload_path'] = './assets/doc_ia/';
                $config_doc2['allowed_types'] = '*';
                $config_doc2['file_name'] = "doc2_" . date('Ymdhis');
                $this->load->library('upload', $config_doc2);
                $this->upload->initialize($config_doc2);

                $this->upload->do_upload('dokumen2');
                $data_upload2 = $this->upload->data();
                $data['dokumen2'] = $data_upload2['file_name'];
            }

            // jika ada dokumen 3
            if (!empty($_FILES['dokumen3']['name'])) {
                $config_doc3['upload_path'] = './assets/doc_ia/';
                $config_doc3['allowed_types'] = '*';
                $config_doc3['file_name'] = "doc3_" . date('Ymdhis');
                $this->load->library('upload', $config_doc3);
                $this->upload->initialize($config_doc3);

                $this->upload->do_upload('dokumen3');
                $data_upload3 = $this->upload->data();
                $data['dokumen3'] = $data_upload3['file_name'];
            }

            $data['moa_id'] = $this->input->post('moa_id', TRUE);
            $data['kategori_ia'] = $this->input->post('kategori_ia', TRUE);
            $data['tingkat_ia'] = $this->input->post('tingkat_ia', TRUE);
            $data['judul_kegiatan'] = $this->input->post('judul_kegiatan', TRUE);
            $data['manfaat_kegiatan'] = $this->input->post('manfaat_kegiatan', TRUE);
            $data['tanggal_awal'] = $this->input->post('tanggal_awal', TRUE);
            $data['tanggal_akhir'] = $this->input->post('tanggal_akhir', TRUE);
            $data['dosen_terlibat'] = implode("#", $this->input->post('dosen_terlibat[]', TRUE));
            $id = $this->input->post('id', TRUE);
            $this->Ia_model->update_ia_by_id($id, $data);
            $data_response =  array(
                'status' => true,
                // 'token_csrf' => $this->security->get_csrf_hash(),
                'messege' => 'Tambah Implementation Arrangement (IA) BERHASIL'
            );

            echo json_encode($data_response);
        }
    }
}
