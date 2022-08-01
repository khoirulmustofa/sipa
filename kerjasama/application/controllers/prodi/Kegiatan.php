<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\CodeigniterAdapter;

class Kegiatan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        // cek login dari app_helper
        //is_login();
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

    public function get_datatable_kegiatan()
    {
        $jenis_kerjasama = $this->input->post('jenis_kerjasama', TRUE);

        $where = "";
        if ($jenis_kerjasama != '') {
            $where = " WHERE jenis_kegiatan = '$jenis_kerjasama'";
        } 
        $datatables = new Datatables(new CodeigniterAdapter);

        $datatables->query("SELECT id_kegiatan,jenis_kegiatan,awal_kegiatan,akhir_kegiatan,judul_kegiatan,manfaat_kegiatan,doc_undangan,doc_absensi,doc_foto,doc_1,doc_2,doc_3,doc_4,doc_5,doc_6, DATEDIFF(akhir_kegiatan, awal_kegiatan) as selisih_hari FROM tb_kegiatan " . $where);        

        echo $datatables->generate();
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

    public function create_action()
    {
        // validation Form
        $this->form_validation->set_rules('jenis_kegiatan', 'Jenis Kegiatan', 'trim|required');
        $this->form_validation->set_rules('awal_kegiatan', 'Awal Pelaksanaan', 'trim|required');
        $this->form_validation->set_rules('akhir_kegiatan', 'Akhir Pelaksanaan', 'trim|required');
        $this->form_validation->set_rules('judul_kegiatan', 'Judul Kegiatan', 'trim|required');
        $this->form_validation->set_rules('manfaat_kegiatan', 'Manfaat Kegiatan', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data_response =  array(
                'status' => false,
                'messege' => validation_errors(),
            );
            echo json_encode($data_response);
        } else {



            $data_insert['jenis_kegiatan'] = $this->input->post('jenis_kegiatan', TRUE);
            $data_insert['awal_kegiatan'] = $this->input->post('awal_kegiatan', TRUE);
            $data_insert['akhir_kegiatan'] = $this->input->post('akhir_kegiatan', TRUE);
            $data_insert['judul_kegiatan'] = $this->input->post('judul_kegiatan', TRUE);
            $data_insert['manfaat_kegiatan'] = $this->input->post('manfaat_kegiatan', TRUE);

            if (!empty($_FILES['doc_undangan']['name'])) {
                $data_insert['doc_undangan'] = $this->_upload_doc_undangan();
            }
            // load model
            $this->load->model('Kegiatan_model');
            // insert ke table tb_kerjasama
            $this->Kegiatan_model->insert_tb_kegiatan($data_insert);

            $data_response['status'] = true;
            $data_response['messege'] = '<p>Tambah Kegiatan Berhasil Disimpan</p>';
            echo json_encode($data_response);
        }
    }

    private function _upload_doc_undangan()
    {
        $config_doc_undangan['upload_path'] = './assets/file_kegiatan/';
        $config_doc_undangan['encrypt_name'] = TRUE;
        $config_doc_undangan['allowed_types'] = '*';
        // $this->upload->initialize($config);
        $this->load->library('upload', $config_doc_undangan);
        $this->upload->do_upload('doc_undangan');

        $data_upload = $this->upload->data();
        return $data_upload['file_name'];
    }
}
