<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kegiatan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        // cek login dari app_helper
        is_login();
    }

    public function index()
    {
        // load model
        $this->load->model('Kegiatan_model');

        $data['menu'] = 'menu_kegiatan';
        $data['title'] = "Kegiatan";
        $data['load_css'] = '';
        $data['load_js'] = 'prodi/kegiatan/js_index';

        $this->template->load('_template/main_template', 'prodi/kegiatan/view_index', $data);
    }

    public function create()
    {
        $data = array(
            'title' => "Tambah Kegiatan",
            'action' => "prodi/kegiatan/create_action",
            'id_kegiatan' => set_value('id_kegiatan'),
            'jenis_kegiatan' => set_value('jenis_kegiatan'),
            'awal_kegiatan' => set_value('awal_kegiatan'),
            'akhir_kegiatan' => set_value('akhir_kegiatan'),
            'judul_kegiatan' => set_value('judul_kegiatan'),
            'manfaat_kegiatan' => set_value('manfaat_kegiatan'),
            'doc_undangan' => set_value('doc_undangan'),
            'doc_absensi' => set_value('doc_absensi'),
            'doc_foto' => set_value('doc_foto'),
            'doc_1' => set_value('doc_1'),
            'doc_2' => set_value('doc_2'),
            'doc_3' => set_value('doc_3'),
            'doc_4' => set_value('doc_4'),
            'doc_5' => set_value('doc_5'),
            'doc_6' => set_value('doc_6'),
        );
        $data_response =  array(
            'status' => true,
            'view_modal_form' => $this->load->view('prodi/kegiatan/view_form', $data, true)
        );
        echo json_encode($data_response);
    }
}
