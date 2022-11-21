<?php

use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\CodeigniterAdapter;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Moa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    // tampil MOA
    public function index()
    {
        $this->load->model('Moa_model');

        $data['menu'] = 'menu_moa';
        $data['title'] = "Memorandum of Agreement (MOA)";
        $data['load_css'] = 'moa/css_index';
        $data['load_js'] = 'moa/js_index';
        $data['tahun_moa_result'] = $this->Moa_model->getTahunMOA()->result();
        $this->template->load('_template/main_template', 'moa/view_index', $data);
    }

    //  data ajax list MOU
    public function list()
    {
        $tahun_kerja_sama = $this->input->post('tahun_kerja_sama', TRUE);
        $this->load->model('Moa_model');

        $datatables = new Datatables(new CodeigniterAdapter());
        $query = $this->Moa_model->getMOAList($tahun_kerja_sama);
        $datatables->query($query);
        echo $datatables->generate();
    }

    public function create()
    {
        $this->load->model('Mou_model');
        $this->load->model('Wilayah_indonesia_model');
        $this->load->model('Prodi_model');

        $data['menu'] = "menu_master";
        $data['title'] = 'Tambah Memorandum of Agreement (MOA)';
        $data['action'] = "moa/create_action";
        $data['id'] = set_value('id');
        $data['mou_id'] = set_value('mou_id');
        $data['kategori_moa'] = set_value('kategori_moa');
        $data['tingkat_moa'] = set_value('tingkat_moa');
        $data['tanggal'] = set_value('tanggal');
        $data['nama_lembaga_mitra'] = set_value('nama_lembaga_mitra');
        $data['negara_id'] = set_value('negara_id');
        $data['provinsi_id'] = set_value('negara_id');
        $data['kota_kabupaten_id'] = set_value('negara_id');
        $data['kecamata_id'] = set_value('negara_id');
        $data['kelurahan_id'] = set_value('negara_id');
        $data['alamat'] = set_value('alamat');
        $data['durasi'] = set_value('durasi');

        $data['mou_result'] = $this->Mou_model->getMouResult()->result();
        $data['negara_result'] = $this->Wilayah_indonesia_model->get_master_negara()->result();
        $data['provinsi_result'] = $this->Wilayah_indonesia_model->get_master_provinsi()->result();
        $data['kota_kabupaten_result'] = $this->Wilayah_indonesia_model->get_master_kota_kabupaten_by_provinsi_id("")->result();
        $data['kecamatan_result'] = $this->Wilayah_indonesia_model->get_master_kecamatan_by_kota_kabupaten_id("")->result();
        $data['kelurahan_result'] = $this->Wilayah_indonesia_model->get_master_kelurahan_by_kecamatan_id("")->result();
        $data['prodi_result'] = $this->Prodi_model->get_prodi()->result();

        $data_response =  array(
            'status' => true,
            // 'token_csrf' => $this->security->get_csrf_hash(),
            'view_modal_form' => $this->load->view('moa/view_form', $data, true)
        );
        echo json_encode($data_response);
    }

    public function create_action()
    {
        $this->load->model('Moa_model');

        // validasi form
        $this->form_validation->set_rules('mou_id', 'Pilih MOU', 'trim|required');
        $this->form_validation->set_rules('kategori_moa', 'Kategori', 'trim|required');
        $this->form_validation->set_rules('tingkat_moa', 'Tingkatan', 'trim|required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
        $this->form_validation->set_rules('nama_lembaga_mitra[]', 'nama_lembaga_mitra', 'trim|required');
        $this->form_validation->set_rules('negara_id', 'Negara', 'trim|required');
        if ($this->input->post('negara_id', TRUE) == 102) {
            $this->form_validation->set_rules('provinsi_id', 'Provinsi', 'trim|required');
            $this->form_validation->set_rules('kota_kabupaten_id', 'Kota Kabupaten', 'trim|required');
            $this->form_validation->set_rules('kecamatan_id', 'Kota Kecamatan', 'trim|required');
            $this->form_validation->set_rules('kelurahan_id', 'Kelurhan / Desa', 'trim|required');
        }
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('durasi', 'Durasi', 'trim|required');
        $this->form_validation->set_rules('kode_prodi[]', 'Pilih Prodi', 'trim|required');

        // jika ada dokumen 1
        if (!empty($_FILES['dokumen1']['name'])) {
            $config_doc1['upload_path'] = './assets/doc_moa/';
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
            $config_doc2['upload_path'] = './assets/doc_moa/';
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
            $config_doc3['upload_path'] = './assets/doc_moa/';
            $config_doc3['allowed_types'] = '*';
            $config_doc3['file_name'] = "doc3_" . date('Ymdhis');
            $this->load->library('upload', $config_doc3);
            $this->upload->initialize($config_doc3);

            $this->upload->do_upload('dokumen3');
            $data_upload3 = $this->upload->data();
            $data['dokumen3'] = $data_upload3['file_name'];
        }

        if ($this->form_validation->run() == FALSE) {
            $data_response =  array(
                'status' => false,
                // 'token_csrf' => $this->security->get_csrf_hash(),
                'messege' => validation_errors(),
            );
            echo json_encode($data_response);
        } else {
            $data['mou_id'] = $this->input->post('mou_id', TRUE);
            $data['kategori_moa'] = $this->input->post('kategori_moa', TRUE);
            $data['tingkat_moa'] = $this->input->post('tingkat_moa', TRUE);
            $data['tanggal'] = $this->input->post('tanggal', TRUE);
            $data['nama_lembaga_mitra'] = implode("#", $this->input->post('nama_lembaga_mitra[]', TRUE));
            $data['negara_id'] = $this->input->post('negara_id', TRUE);
            $data['provinsi_id'] = $this->input->post('provinsi_id', TRUE);
            $data['kota_kabupaten_id'] = $this->input->post('kota_kabupaten_id', TRUE);
            $data['kecamatan_id'] = $this->input->post('kecamatan_id', TRUE);
            $data['kelurahan_id'] = $this->input->post('kelurahan_id', TRUE);
            $data['alamat'] = $this->input->post('alamat', TRUE);
            $data['durasi'] = $this->input->post('durasi', TRUE);
            $data['tanggal_akhir'] = date('Y-m-d', strtotime($this->input->post('tanggal', TRUE) . ' + ' . $this->input->post('durasi', TRUE) . ' years'));
            $data['kode_prodi'] = implode("#", $this->input->post('kode_prodi[]', TRUE));

            if ($this->Moa_model->insert_moa($data) > 0) {
                $data_response =  array(
                    'status' => true,
                    // 'token_csrf' => $this->security->get_csrf_hash(),
                    'messege' => 'Tambah Memorandum of Agreement (MOA) BERHASIL'
                );
            } else {
                $data_response =  array(
                    'status' => false,
                    // 'token_csrf' => $this->security->get_csrf_hash(),
                    'messege' => 'Tambah Memorandum of Agreement (MOA) GAGAL'
                );
            }
            echo json_encode($data_response);
        }
    }

    public function detail()
    {
        $this->load->model('Moa_model');

        $moa_id = $this->input->get('moa_id', TRUE);
        $data['menu'] = 'menu_moa';
        $data['title'] = "Detail Memorandum of Agreement (MOA)";
        $data['moa_row'] = $this->Moa_model->getMoaDetailById($moa_id)->row();     
       
        $this->template->load('_template/main_template', 'moa/view_detail', $data);
    }
}
