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
        $query = $this->Moa_model->get_list_moa($tahun_kerja_sama);
        $datatables->query($query);
        echo $datatables->generate();
    }

    public function create()
    {
        $this->load->model('Mou_model');
        $this->load->model('Wilayah_indonesia_model');
        $this->load->model('Prodi_model');

        $model_row = $this->Mou_model->get_mou()->result();
        if (count($model_row) > 0) {
            $data['menu'] = "menu_master";
            $data['title'] = 'Tambah Memorandum of Agreement (MOA)';
            $data['action'] = "moa/create_action";

            $data['id'] = set_value('id');
            $data['mou_id'] = set_value('mou_id');
            $data['kategori_moa'] = set_value('kategori_moa');
            $data['tingkat_moa'] = set_value('tingkat_moa');
            $data['tanggal_moa'] = set_value('tanggal_moa');
            $data['nama_lembaga_mitra_moa'] = set_value('nama_lembaga_mitra_moa');
            $data['negara_id'] = set_value('negara_id');
            $data['provinsi_id'] = set_value('provinsi_id');
            $data['kota_kabupaten_id'] = set_value('kota_kabupaten_id');
            $data['kecamatan_id'] = set_value('kecamatan_id');
            $data['kelurahan_id'] = set_value('kelurahan_id');
            $data['alamat_moa'] = set_value('alamat_moa');
            $data['tanggal_akhir_moa'] = set_value('tanggal_akhir_moa');
            $data['dokumen1_moa'] = set_value('dokumen1_moa');
            $data['dokumen2_moa'] = set_value('dokumen2_moa');
            $data['dokumen3_moa'] = set_value('dokumen3_moa');
            $data['nama_dokumen1_moa'] = set_value('nama_dokumen1_moa');
            $data['nama_dokumen2_moa'] = set_value('nama_dokumen2_moa');
            $data['nama_dokumen3_moa'] = set_value('nama_dokumen3_moa');
            $data['kode_prodi'] = set_value('kode_prodi');

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
        } else {
            $data_response =  array(
                'status' => true,
                'messege' => 'Data Memorandum of Understanding (MOU) Belum ada'
            );
            echo json_encode($data_response);
        }
    }

    public function create_action()
    {
        $this->load->model('Moa_model');

        // validasi form
        $this->form_validation->set_rules('mou_id', 'Pilih MOU', 'trim|required');
        $this->form_validation->set_rules('kategori_moa[]', 'Kategori', 'trim|required');
        $this->form_validation->set_rules('tingkat_moa', 'Tingkatan', 'trim|required');
        $this->form_validation->set_rules('tanggal_moa', 'Tanggal Mulai', 'trim|required');
        $this->form_validation->set_rules('tanggal_akhir_moa', 'Tanggal Akhir', 'trim|required');
        $this->form_validation->set_rules('nama_lembaga_mitra_moa[]', 'Nama Lembaga Mitra', 'trim|required');
        $this->form_validation->set_rules('negara_id', 'Negara', 'trim|required');
        if ($this->input->post('negara_id', TRUE) == 102) {
            $this->form_validation->set_rules('provinsi_id', 'Provinsi', 'trim|required');
            $this->form_validation->set_rules('kota_kabupaten_id', 'Kota Kabupaten', 'trim|required');
            $this->form_validation->set_rules('kecamatan_id', 'Kota Kecamatan', 'trim|required');
            $this->form_validation->set_rules('kelurahan_id', 'Kelurhan / Desa', 'trim|required');
        }
        $this->form_validation->set_rules('alamat_moa', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('kode_prodi[]', 'Pilih Prodi', 'trim|required');

        // jika ada dokumen 1
        if (!empty($_FILES['dokumen1_moa']['name'])) {
            $config_doc1['upload_path'] = './assets/doc_moa/';
            $config_doc1['allowed_types'] = '*';
            $config_doc1['file_name'] = "doc1_" . date('Ymdhis');
            $this->load->library('upload', $config_doc1);
            $this->upload->initialize($config_doc1);

            $this->upload->do_upload('dokumen1_moa');
            $data_upload1 = $this->upload->data();
            $data['dokumen1_moa'] = $data_upload1['file_name'];
            $data['nama_dokumen1_moa'] = $this->input->post('nama_dokumen1_moa', TRUE);
        }

        // jika ada dokumen 2
        if (!empty($_FILES['dokumen2_moa']['name'])) {
            $config_doc2['upload_path'] = './assets/doc_moa/';
            $config_doc2['allowed_types'] = '*';
            $config_doc2['file_name'] = "doc2_" . date('Ymdhis');
            $this->load->library('upload', $config_doc2);
            $this->upload->initialize($config_doc2);

            $this->upload->do_upload('dokumen2_moa');
            $data_upload2 = $this->upload->data();
            $data['dokumen2_moa'] = $data_upload2['file_name'];
            $data['nama_dokumen2_moa'] = $this->input->post('nama_dokumen2_moa', TRUE);
        }

        // jika ada dokumen 3
        if (!empty($_FILES['dokumen3_moa']['name'])) {
            $config_doc3['upload_path'] = './assets/doc_moa/';
            $config_doc3['allowed_types'] = '*';
            $config_doc3['file_name'] = "doc3_" . date('Ymdhis');
            $this->load->library('upload', $config_doc3);
            $this->upload->initialize($config_doc3);

            $this->upload->do_upload('dokumen3_moa');
            $data_upload3 = $this->upload->data();
            $data['dokumen3_moa'] = $data_upload3['file_name'];
            $data['nama_dokumen3_moa'] = $this->input->post('nama_dokumen3_moa', TRUE);
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
            $data['kategori_moa'] = implode("#", $this->input->post('kategori_moa[]', TRUE));
            $data['tingkat_moa'] = $this->input->post('tingkat_moa', TRUE);
            $data['tanggal_moa'] = $this->input->post('tanggal_moa', TRUE);
            $data['tanggal_akhir_moa'] = $this->input->post('tanggal_akhir_moa', TRUE);
            $data['nama_lembaga_mitra_moa'] = implode("#", $this->input->post('nama_lembaga_mitra_moa[]', TRUE));
            $data['negara_id'] = $this->input->post('negara_id', TRUE);
            $data['provinsi_id'] = $this->input->post('provinsi_id', TRUE);
            $data['kota_kabupaten_id'] = $this->input->post('kota_kabupaten_id', TRUE);
            $data['kecamatan_id'] = $this->input->post('kecamatan_id', TRUE);
            $data['kelurahan_id'] = $this->input->post('kelurahan_id', TRUE);
            $data['alamat_moa'] = $this->input->post('alamat_moa', TRUE);
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

    public function update()
    {
        $this->load->model('Moa_model');
        $this->load->model('Mou_model');
        $this->load->model('Wilayah_indonesia_model');
        $this->load->model('Prodi_model');

        $id = $this->input->get('id', TRUE);
        $moa_row = $this->Moa_model->get_moa_by_id($id)->row();
        if ($moa_row) {
            $data['title'] = 'Update Memorandum of Agreement (MOA)';
            $data['action'] = "moa/update_action";

            $data['id'] = set_value('id', $moa_row->id);
            $data['mou_id'] = set_value('mou_id', $moa_row->mou_id);
            $data['kategori_moa'] = set_value('kategori_moa', $moa_row->kategori_moa);
            $data['tingkat_moa'] = set_value('tingkat_moa', $moa_row->tingkat_moa);
            $data['tanggal_moa'] = set_value('tanggal_moa', $moa_row->tanggal_moa);
            $data['nama_lembaga_mitra_moa'] = set_value('nama_lembaga_mitra_moa', $moa_row->nama_lembaga_mitra_moa);
            $data['negara_id'] = set_value('negara_id', $moa_row->negara_id);
            $data['provinsi_id'] = set_value('provinsi_id', $moa_row->provinsi_id);
            $data['kota_kabupaten_id'] = set_value('kota_kabupaten_id', $moa_row->kota_kabupaten_id);
            $data['kecamatan_id'] = set_value('kecamatan_id', $moa_row->kecamatan_id);
            $data['kelurahan_id'] = set_value('kelurahan_id', $moa_row->kelurahan_id);
            $data['alamat_moa'] = set_value('alamat_moa', $moa_row->alamat_moa);
            $data['tanggal_akhir_moa'] = set_value('tanggal_akhir_moa', $moa_row->tanggal_akhir_moa);
            $data['dokumen1_moa'] = set_value('dokumen1_moa', $moa_row->dokumen1_moa);
            $data['dokumen2_moa'] = set_value('dokumen2_moa', $moa_row->dokumen2_moa);
            $data['dokumen3_moa'] = set_value('dokumen3_moa', $moa_row->dokumen3_moa);
            $data['nama_dokumen1_moa'] = set_value('nama_dokumen1_moa', $moa_row->nama_dokumen1_moa);
            $data['nama_dokumen2_moa'] = set_value('nama_dokumen2_moa', $moa_row->nama_dokumen2_moa);
            $data['nama_dokumen3_moa'] = set_value('nama_dokumen3_moa', $moa_row->nama_dokumen3_moa);
            $data['kode_prodi'] = set_value('kode_prodi', $moa_row->kode_prodi);

            $data['mou_result'] = $this->Mou_model->getMouResult()->result();
            $data['negara_result'] = $this->Wilayah_indonesia_model->get_master_negara()->result();
            $data['provinsi_result'] = $this->Wilayah_indonesia_model->get_master_provinsi()->result();
            $data['kota_kabupaten_result'] = $this->Wilayah_indonesia_model->get_master_kota_kabupaten_by_provinsi_id($moa_row->provinsi_id)->result();
            $data['kecamatan_result'] = $this->Wilayah_indonesia_model->get_master_kecamatan_by_kota_kabupaten_id($moa_row->kota_kabupaten_id)->result();
            $data['kelurahan_result'] = $this->Wilayah_indonesia_model->get_master_kelurahan_by_kecamatan_id($moa_row->kecamatan_id)->result();
            $data['prodi_result'] = $this->Prodi_model->get_prodi()->result();
            $data_response =  array(
                'status' => true,
                'data' => $moa_row,
                'view_modal_form' => $this->load->view('moa/view_form', $data, true)
            );
            echo json_encode($data_response);
        } else {
            $data_response =  array(
                'status' => true,
                'messege' => 'Data tidak ditemukan'
            );
            echo json_encode($data_response);
        }
    }

    public function update_action()
    {
        $this->load->model('Moa_model');

        // validasi form
        $this->form_validation->set_rules('mou_id', 'Pilih MOU', 'trim|required');
        $this->form_validation->set_rules('kategori_moa[]', 'Kategori', 'trim|required');
        $this->form_validation->set_rules('tingkat_moa', 'Tingkatan', 'trim|required');
        $this->form_validation->set_rules('tanggal_moa', 'Tanggal Mulai', 'trim|required');
        $this->form_validation->set_rules('tanggal_akhir_moa', 'Tanggal Akhir', 'trim|required');
        $this->form_validation->set_rules('nama_lembaga_mitra_moa[]', 'Nama Lembaga Mitra', 'trim|required');
        $this->form_validation->set_rules('negara_id', 'Negara', 'trim|required');
        if ($this->input->post('negara_id', TRUE) == 102) {
            $this->form_validation->set_rules('provinsi_id', 'Provinsi', 'trim|required');
            $this->form_validation->set_rules('kota_kabupaten_id', 'Kota Kabupaten', 'trim|required');
            $this->form_validation->set_rules('kecamatan_id', 'Kota Kecamatan', 'trim|required');
            $this->form_validation->set_rules('kelurahan_id', 'Kelurhan / Desa', 'trim|required');
        }
        $this->form_validation->set_rules('alamat_moa', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('kode_prodi[]', 'Pilih Prodi', 'trim|required');

        // jika ada dokumen 1
        if (!empty($_FILES['dokumen1_moa']['name'])) {
            $config_doc1['upload_path'] = './assets/doc_moa/';
            $config_doc1['allowed_types'] = '*';
            $config_doc1['file_name'] = "doc1_" . date('Ymdhis');
            $this->load->library('upload', $config_doc1);
            $this->upload->initialize($config_doc1);

            $this->upload->do_upload('dokumen1_moa');
            $data_upload1 = $this->upload->data();
            $data['dokumen1_moa'] = $data_upload1['file_name'];
            $data['nama_dokumen1_moa'] = $this->input->post('nama_dokumen1_moa', TRUE);
        }

        // jika ada dokumen 2
        if (!empty($_FILES['dokumen2_moa']['name'])) {
            $config_doc2['upload_path'] = './assets/doc_moa/';
            $config_doc2['allowed_types'] = '*';
            $config_doc2['file_name'] = "doc2_" . date('Ymdhis');
            $this->load->library('upload', $config_doc2);
            $this->upload->initialize($config_doc2);

            $this->upload->do_upload('dokumen2_moa');
            $data_upload2 = $this->upload->data();
            $data['dokumen2_moa'] = $data_upload2['file_name'];
            $data['nama_dokumen2_moa'] = $this->input->post('nama_dokumen2_moa', TRUE);
        }

        // jika ada dokumen 3
        if (!empty($_FILES['dokumen3_moa']['name'])) {
            $config_doc3['upload_path'] = './assets/doc_moa/';
            $config_doc3['allowed_types'] = '*';
            $config_doc3['file_name'] = "doc3_" . date('Ymdhis');
            $this->load->library('upload', $config_doc3);
            $this->upload->initialize($config_doc3);

            $this->upload->do_upload('dokumen3_moa');
            $data_upload3 = $this->upload->data();
            $data['dokumen3_moa'] = $data_upload3['file_name'];
            $data['nama_dokumen3_moa'] = $this->input->post('nama_dokumen3_moa', TRUE);
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
            $data['kategori_moa'] = implode("#", $this->input->post('kategori_moa[]', TRUE));
            $data['tingkat_moa'] = $this->input->post('tingkat_moa', TRUE);
            $data['tanggal_moa'] = $this->input->post('tanggal_moa', TRUE);
            $data['tanggal_akhir_moa'] = $this->input->post('tanggal_akhir_moa', TRUE);
            $data['nama_lembaga_mitra_moa'] = implode("#", $this->input->post('nama_lembaga_mitra_moa[]', TRUE));
            $data['negara_id'] = $this->input->post('negara_id', TRUE);
            $data['provinsi_id'] = $this->input->post('provinsi_id', TRUE);
            $data['kota_kabupaten_id'] = $this->input->post('kota_kabupaten_id', TRUE);
            $data['kecamatan_id'] = $this->input->post('kecamatan_id', TRUE);
            $data['kelurahan_id'] = $this->input->post('kelurahan_id', TRUE);
            $data['alamat_moa'] = $this->input->post('alamat_moa', TRUE);
            $data['kode_prodi'] = implode("#", $this->input->post('kode_prodi[]', TRUE));

            $id = $this->input->post('id', TRUE);
            $this->Moa_model->update_moa_by_id($id, $data);

            $data_response =  array(
                'status' => true,
                // 'token_csrf' => $this->security->get_csrf_hash(),
                'messege' => 'Update Memorandum of Agreement (MOA) BERHASIL'
            );
            echo json_encode($data_response);
        }
    }

    public function detail()
    {
        $this->load->model('Moa_model');
        $this->load->model('Mou_model');
        $this->load->model('Wilayah_indonesia_model');
        $this->load->model('Prodi_model');

        $id = $this->input->get('id', TRUE);
        $moa_row = $this->Moa_model->get_moa_detail_by_id($id)->row();
        if ($moa_row) {
            $data['title'] = 'Detail Memorandum of Agreement (MOA)';
            $data['action'] = "moa/update_action";
            $data['id'] = set_value('id', $moa_row->id);
            $data['moa_row'] = $moa_row;
            $data['prodi_result'] = $this->Prodi_model->get_prodi()->result();
            $data_response =  array(
                'status' => true,
                'view_modal_form' => $this->load->view('moa/view_detail', $data, true)
            );
            echo json_encode($data_response);
        } else {
            $data_response =  array(
                'status' => true,
                'messege' => 'Data tidak ditemukan'
            );
            echo json_encode($data_response);
        }
    }

    public function delete_action()
    {
        $this->load->model('Moa_model');

        $id =  $this->input->post('id', TRUE);
        if ($this->Moa_model->delete_moa_by_id($id) > 0) {
            $data_response =  array(
                'status' => true,
                // 'token_csrf' => $this->security->get_csrf_hash(),
                'messege' => 'Hapus Memorandum of Agreement (MOA) BERHASIL'
            );
        } else {
            $data_response =  array(
                'status' => false,
                // 'token_csrf' => $this->security->get_csrf_hash(),
                'messege' => 'Hapus  Memorandum of Agreement (MOA) GAGAL'
            );
        }
        echo json_encode($data_response);
    }
}
