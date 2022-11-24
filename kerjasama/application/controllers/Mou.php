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

    public function tambah()
    {
        $this->load->model('Mou_model');
        $this->load->model('Wilayah_indonesia_model');

        $data['menu'] = "menu_moa";
        $data['title'] = 'Tambah Memorandum of Understanding (MOU)';
        $data['action'] = "mou/tambah_action";
        $data['load_js'] = 'mou/js_form';
        $data['id'] = set_value('id');
        $data['periode'] = set_value('periode');
        $data['tanggal'] = set_value('tanggal');
        $data['nama_lembaga_mitra'] = set_value('nama_lembaga_mitra');
        $data['negara_id'] = set_value('negara_id');
        $data['provinsi_id'] = set_value('provinsi_id');
        $data['kota_kabupaten_id'] = set_value('kota_kabupaten_id');
        $data['kecamata_id'] = set_value('kecamata_id');
        $data['kelurahan_id'] = set_value('kelurahan_id');
        $data['alamat'] = set_value('alamat');
        $data['durasi'] = set_value('durasi');
        $data['kelurahan_id'] = set_value('negara_id');
        $data['tanggal_akhir'] = set_value('tanggal_akhir');

        $data['negara_result'] = $this->Wilayah_indonesia_model->get_master_negara()->result();
        $data['provinsi_result'] = $this->Wilayah_indonesia_model->get_master_provinsi()->result();
        $data['kota_kabupaten_result'] = $this->Wilayah_indonesia_model->get_master_kota_kabupaten_by_provinsi_id("")->result();
        $data['kecamatan_result'] = $this->Wilayah_indonesia_model->get_master_kecamatan_by_kota_kabupaten_id("")->result();
        $data['kelurahan_result'] = $this->Wilayah_indonesia_model->get_master_kelurahan_by_kecamatan_id("")->result();

        $data_response =  array(
            'status' => true,
            'view_modal_form' => $this->load->view('mou/view_form', $data, true)
        );
        echo json_encode($data_response);
    }

    public function tambah_action()
    {
        $this->load->model('Mou_model');

        // validasi form
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
        $this->form_validation->set_rules('nama_lembaga_mitra', 'Nama Lembaga', 'trim|required');
        $this->form_validation->set_rules('negara_id', 'Negara', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('durasi', 'Durasi', 'trim|required');
        if ($this->input->post('negara_id', TRUE) == 102) {
            $this->form_validation->set_rules('provinsi_id', 'Provinsi', 'trim|required');
            $this->form_validation->set_rules('kota_kabupaten_id', 'Kota Kabupaten', 'trim|required');
            $this->form_validation->set_rules('kecamatan_id', 'Kota Kecamatan', 'trim|required');
            $this->form_validation->set_rules('kelurahan_id', 'Kelurhan / Desa', 'trim|required');
        }

        if ($this->form_validation->run() == FALSE) {
            $data_response =  array(
                'status' => false,
                // 'token_csrf' => $this->security->get_csrf_hash(),
                'messege' => validation_errors(),
            );
            echo json_encode($data_response);
        } else {
            // jika ada dokumen
            if (!empty($_FILES['dokumen']['name'])) {
                $config_doc1['upload_path'] = './assets/doc_mou/';
                $config_doc1['allowed_types'] = '*';
                $config_doc1['file_name'] = "doc__mou_" . date('Ymdhis');
                $this->load->library('upload', $config_doc1);
                $this->upload->initialize($config_doc1);

                $this->upload->do_upload('dokumen');
                $data_upload1 = $this->upload->data();
                $data['dokumen'] = $data_upload1['file_name'];
            }

            $data['periode'] = '1';
            $data['tanggal'] = $this->input->post('tanggal', TRUE);
            $data['nama_lembaga_mitra'] = $this->input->post('nama_lembaga_mitra', TRUE);
            $data['negara_id'] = $this->input->post('negara_id', TRUE);
            $data['provinsi_id'] = $this->input->post('provinsi_id', TRUE);
            $data['kota_kabupaten_id'] = $this->input->post('kota_kabupaten_id', TRUE);
            $data['kecamatan_id'] = $this->input->post('kecamatan_id', TRUE);
            $data['kelurahan_id'] = $this->input->post('kelurahan_id', TRUE);
            $data['alamat'] = $this->input->post('alamat', TRUE);
            $data['durasi'] = $this->input->post('durasi', TRUE);
            $data['tanggal_akhir'] = date('Y-m-d', strtotime($this->input->post('tanggal', TRUE) . ' + ' . $this->input->post('durasi', TRUE) . ' years'));

            if ($this->Mou_model->insert_mou($data) > 0) {
                $data_response =  array(
                    'status' => true,
                    // 'token_csrf' => $this->security->get_csrf_hash(),
                    'messege' => 'Tambah Memorandum of Understanding (MOU) BERHASIL'
                );
            } else {
                $data_response =  array(
                    'status' => false,
                    // 'token_csrf' => $this->security->get_csrf_hash(),
                    'messege' => 'Tambah Memorandum of Understanding (MOU) GAGAL'
                );
            }
            echo json_encode($data_response);
        }
    }

    public function detail()
    {
        $this->load->model('Mou_model');

        $mou_id = $this->input->get('mou_id', TRUE);
        $mou_row = $this->Mou_model->get_mou_detail_by_id($mou_id)->row();

        $data['menu'] = 'menu_mou';
        $data['title'] = "Detail Memorandum of Understanding (MOU)";
        $data['load_js'] = 'mou/js_detail';
        $data['id'] = $mou_row->id;
        $data['periode'] = $mou_row->periode;
        $data['tanggal'] = $mou_row->tanggal;
        $data['nama_lembaga_mitra'] = $mou_row->nama_lembaga_mitra;
        $data['nama_negara'] = $mou_row->nama_negara;
        $data['province_name'] = $mou_row->province_name;
        $data['kota_kabupaten_nama'] = $mou_row->kota_kabupaten_nama;
        $data['kecamatan_nama'] = $mou_row->kecamatan_nama;
        $data['kelurahan_nama'] = $mou_row->kelurahan_nama;
        $data['alamat'] = $mou_row->alamat;
        $data['durasi'] = $mou_row->durasi;
        $data['tanggal_akhir'] = $mou_row->tanggal_akhir;
        $data['dokumen'] = $mou_row->dokumen;


        $this->template->load('_template/main_template', 'mou/view_detail', $data);
    }

    public function edit()
    {
        $this->load->model('Mou_model');
        $this->load->model('Wilayah_indonesia_model');

        $mou_id = $this->input->get('id', TRUE);
        $mou_row = $this->Mou_model->get_mou_detail_by_id($mou_id)->row();

        $data['menu'] = 'menu_mou';
        $data['title'] = "Edit Memorandum of Understanding (MOU)";
        $data['load_js'] = 'mou/js_form';
        $data['action'] = 'mou/edit_action';
        $data['id'] = set_value('id', $mou_row->id);
        $data['periode'] = set_value('periode', $mou_row->periode);
        $data['tanggal'] = set_value('tanggal', $mou_row->tanggal);
        $data['nama_lembaga_mitra'] = set_value('nama_lembaga_mitra', $mou_row->nama_lembaga_mitra);
        $data['negara_id'] = set_value('negara_id', $mou_row->negara_id);
        $data['provinsi_id'] = set_value('provinsi_id', $mou_row->provinsi_id);
        $data['kota_kabupaten_id'] = set_value('kota_kabupaten_id', $mou_row->kota_kabupaten_id);
        $data['kecamatan_id'] = set_value('kecamatan_id', $mou_row->kecamatan_id);
        $data['kelurahan_id'] = set_value('kelurahan_id', $mou_row->kelurahan_id);
        $data['alamat'] = set_value('alamat', $mou_row->alamat);
        $data['durasi'] = set_value('durasi', $mou_row->durasi);
        $data['tanggal_akhir'] = set_value('tanggal_akhir', $mou_row->tanggal_akhir);
        $data['dokumen'] = set_value('dokumen', $mou_row->dokumen);

        $data['negara_result'] = $this->Wilayah_indonesia_model->get_master_negara()->result();
        $data['provinsi_result'] = $this->Wilayah_indonesia_model->get_master_provinsi()->result();
        $data['kota_kabupaten_result'] = $this->Wilayah_indonesia_model->get_master_kota_kabupaten_by_provinsi_id($mou_row->provinsi_id)->result();
        $data['kecamatan_result'] = $this->Wilayah_indonesia_model->get_master_kecamatan_by_kota_kabupaten_id($mou_row->kota_kabupaten_id)->result();
        $data['kelurahan_result'] = $this->Wilayah_indonesia_model->get_master_kelurahan_by_kecamatan_id($mou_row->kecamatan_id)->result();

        $data_response =  array(
            'status' => true,
            'view_modal_form' => $this->load->view('mou/view_form', $data, true)
        );
        echo json_encode($data_response);
    }

    public function edit_action()
    {
        $this->load->model('Mou_model');
        // validasi form
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
        $this->form_validation->set_rules('nama_lembaga_mitra', 'Nama Lembaga', 'trim|required');
        $this->form_validation->set_rules('negara_id', 'Negara', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('durasi', 'Durasi', 'trim|required');
        if ($this->input->post('negara_id', TRUE) == 102) {
            $this->form_validation->set_rules('provinsi_id', 'Provinsi', 'trim|required');
            $this->form_validation->set_rules('kota_kabupaten_id', 'Kota Kabupaten', 'trim|required');
            $this->form_validation->set_rules('kecamatan_id', 'Kota Kecamatan', 'trim|required');
            $this->form_validation->set_rules('kelurahan_id', 'Kelurhan / Desa', 'trim|required');
        }

        if ($this->form_validation->run() == FALSE) {
            $data_response =  array(
                'status' => false,
                // 'token_csrf' => $this->security->get_csrf_hash(),
                'messege' => validation_errors(),
            );
            echo json_encode($data_response);
        } else {
            // jika ada dokumen
            if (!empty($_FILES['dokumen']['name'])) {
                $config_doc1['upload_path'] = './assets/doc_mou/';
                $config_doc1['allowed_types'] = '*';
                $config_doc1['file_name'] = "doc__mou_" . date('Ymdhis');
                $this->load->library('upload', $config_doc1);
                $this->upload->initialize($config_doc1);

                $this->upload->do_upload('dokumen');
                $data_upload1 = $this->upload->data();
                $data['dokumen'] = $data_upload1['file_name'];
            }

            $data['periode'] = $this->input->post('periode', TRUE);
            $data['tanggal'] = $this->input->post('tanggal', TRUE);
            $data['nama_lembaga_mitra'] = $this->input->post('nama_lembaga_mitra', TRUE);
            $data['negara_id'] = $this->input->post('negara_id', TRUE);
            $data['provinsi_id'] = $this->input->post('provinsi_id', TRUE);
            $data['kota_kabupaten_id'] = $this->input->post('kota_kabupaten_id', TRUE);
            $data['kecamatan_id'] = $this->input->post('kecamatan_id', TRUE);
            $data['kelurahan_id'] = $this->input->post('kelurahan_id', TRUE);
            $data['alamat'] = $this->input->post('alamat', TRUE);
            $data['durasi'] = $this->input->post('durasi', TRUE);
            $data['tanggal_akhir'] = date('Y-m-d', strtotime($this->input->post('tanggal', TRUE) . ' + ' . $this->input->post('durasi', TRUE) . ' years'));

            $id =  $this->input->post('id', TRUE);

            $this->Mou_model->update_mou_by_id($id, $data);
            $data_response =  array(
                'status' => true,
                // 'token_csrf' => $this->security->get_csrf_hash(),
                'messege' => 'Edit Memorandum of Understanding (MOU) BERHASIL'
            );

            echo json_encode($data_response);
        }
    }

    public function perpanjang()
    {
        $this->load->model('Mou_model');
        $this->load->model('Wilayah_indonesia_model');

        $mou_id = $this->input->get('mou_id', TRUE);
        $mou_row = $this->Mou_model->get_mou_detail_by_id($mou_id)->row();

        $data['menu'] = 'menu_mou';
        $data['title'] = "Perpanjang Memorandum of Understanding (MOU)";
        $data['load_js'] = 'mou/js_form';
        $data['action'] = 'mou/perpanjang_action';
        $data['id'] = set_value('id', $mou_row->id);
        $data['periode'] = set_value('periode', $mou_row->periode);
        $data['tanggal'] = set_value('tanggal', $mou_row->tanggal);
        $data['nama_lembaga_mitra'] = set_value('nama_lembaga_mitra', $mou_row->nama_lembaga_mitra);
        $data['negara_id'] = set_value('negara_id', $mou_row->negara_id);
        $data['provinsi_id'] = set_value('provinsi_id', $mou_row->provinsi_id);
        $data['kota_kabupaten_id'] = set_value('kota_kabupaten_id', $mou_row->kota_kabupaten_id);
        $data['kecamatan_id'] = set_value('kecamatan_id', $mou_row->kecamatan_id);
        $data['kelurahan_id'] = set_value('kelurahan_id', $mou_row->kelurahan_id);
        $data['alamat'] = set_value('alamat', $mou_row->alamat);
        $data['durasi'] = set_value('durasi', $mou_row->durasi);
        $data['tanggal_akhir'] = set_value('tanggal_akhir', $mou_row->tanggal_akhir);
        $data['dokumen'] = set_value('dokumen', $mou_row->dokumen);

        $data['negara_result'] = $this->Wilayah_indonesia_model->get_master_negara()->result();
        $data['provinsi_result'] = $this->Wilayah_indonesia_model->get_master_provinsi()->result();
        $data['kota_kabupaten_result'] = $this->Wilayah_indonesia_model->get_master_kota_kabupaten_by_provinsi_id($mou_row->provinsi_id)->result();
        $data['kecamatan_result'] = $this->Wilayah_indonesia_model->get_master_kecamatan_by_kota_kabupaten_id($mou_row->kota_kabupaten_id)->result();
        $data['kelurahan_result'] = $this->Wilayah_indonesia_model->get_master_kelurahan_by_kecamatan_id($mou_row->kecamatan_id)->result();

        $this->template->load('_template/main_template', 'mou/view_perpanjang', $data);
    }

    public function perpanjang_action()
    {
        $this->load->model('Mou_model');

        // validasi form
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
        $this->form_validation->set_rules('nama_lembaga_mitra', 'Nama Lembaga', 'trim|required');
        $this->form_validation->set_rules('negara_id', 'Negara', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('durasi', 'Durasi', 'trim|required');
        if ($this->input->post('negara_id', TRUE) == 102) {
            $this->form_validation->set_rules('provinsi_id', 'Provinsi', 'trim|required');
            $this->form_validation->set_rules('kota_kabupaten_id', 'Kota Kabupaten', 'trim|required');
            $this->form_validation->set_rules('kecamatan_id', 'Kota Kecamatan', 'trim|required');
            $this->form_validation->set_rules('kelurahan_id', 'Kelurhan / Desa', 'trim|required');
        }

        if ($this->form_validation->run() == FALSE) {
            $data_response =  array(
                'status' => false,
                // 'token_csrf' => $this->security->get_csrf_hash(),
                'messege' => validation_errors(),
            );
            echo json_encode($data_response);
        } else {
            // jika ada dokumen
            if (!empty($_FILES['dokumen']['name'])) {
                $config_doc1['upload_path'] = './assets/doc_mou/';
                $config_doc1['allowed_types'] = '*';
                $config_doc1['file_name'] = "doc__mou_" . date('Ymdhis');
                $this->load->library('upload', $config_doc1);
                $this->upload->initialize($config_doc1);

                $this->upload->do_upload('dokumen');
                $data_upload1 = $this->upload->data();
                $data['dokumen'] = $data_upload1['file_name'];
            }

            $data['periode'] = ((int) $this->input->post('periode', TRUE)) + 1;
            $data['tanggal'] = $this->input->post('tanggal', TRUE);
            $data['nama_lembaga_mitra'] = $this->input->post('nama_lembaga_mitra', TRUE);
            $data['negara_id'] = $this->input->post('negara_id', TRUE);
            $data['provinsi_id'] = $this->input->post('provinsi_id', TRUE);
            $data['kota_kabupaten_id'] = $this->input->post('kota_kabupaten_id', TRUE);
            $data['kecamatan_id'] = $this->input->post('kecamatan_id', TRUE);
            $data['kelurahan_id'] = $this->input->post('kelurahan_id', TRUE);
            $data['alamat'] = $this->input->post('alamat', TRUE);
            $data['durasi'] = $this->input->post('durasi', TRUE);
            $data['tanggal_akhir'] = date('Y-m-d', strtotime($this->input->post('tanggal', TRUE) . ' + ' . $this->input->post('durasi', TRUE) . ' years'));

            if ($this->Mou_model->insert_mou($data) > 0) {
                $data_response =  array(
                    'status' => true,
                    // 'token_csrf' => $this->security->get_csrf_hash(),
                    'messege' => 'Perpanjang Memorandum of Understanding (MOU) BERHASIL'
                );
            } else {
                $data_response =  array(
                    'status' => false,
                    // 'token_csrf' => $this->security->get_csrf_hash(),
                    'messege' => 'Perpanjang Memorandum of Understanding (MOU) GAGAL'
                );
            }
            echo json_encode($data_response);
        }
    }

    public function delete_action()
    {
        $this->load->model('Mou_model');

        $id =  $this->input->post('id', TRUE);
        if ($this->Mou_model->delete_mou_by_id($id) > 0) {
            $data_response =  array(
                'status' => true,
                // 'token_csrf' => $this->security->get_csrf_hash(),
                'messege' => 'Hapus Memorandum of Understanding (MOU) BERHASIL'
            );
        } else {
            $data_response =  array(
                'status' => false,
                // 'token_csrf' => $this->security->get_csrf_hash(),
                'messege' => 'Hapus Memorandum of Understanding (MOU) GAGAL'
            );
        }
        echo json_encode($data_response);
    }
}
