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
        $data['semester_result'] = $this->Kegiatan_model->get_semester()->result(); // ambil data semester dari model

        $this->template->load('_template/main_template', 'prodi/kegiatan/view_index', $data);
    }

    public function get_datatable_kegiatan()
    {
        $kode_prodi = $_SESSION['kode_prodi'];
        $tahun_semester = $this->input->post('tahun_semester', TRUE);
        $tahun_semester_array = explode('#', $tahun_semester);

        $where = "";
        if ($tahun_semester != '') {
            $where = " AND YEAR(awal_kegiatan) = '$tahun_semester_array[0]' AND semester = '$tahun_semester_array[1]'";
        }
        $datatables = new Datatables(new CodeigniterAdapter);

        $datatables->query("SELECT id_kegiatan,jenis_kegiatan,awal_kegiatan,akhir_kegiatan,judul_kegiatan,manfaat_kegiatan,doc_undangan,doc_absensi,doc_foto,doc_1,doc_2,doc_3,doc_4,doc_5,doc_6, DATEDIFF(akhir_kegiatan, awal_kegiatan) as selisih_hari FROM tb_kegiatan WHERE kode_prodi = '$kode_prodi'" . $where);

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
            'doc_materi' => set_value('doc_materi'),
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
        // load model
        $this->load->model('Kegiatan_model');

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

            // $data['kode_prodi'] = $_SESSION['kode_prodi'];
            $data['kode_prodi'] = '2';
            $data['jenis_kegiatan'] = $this->input->post('jenis_kegiatan', TRUE);
            $data['awal_kegiatan'] = $this->input->post('awal_kegiatan', TRUE);
            $data['akhir_kegiatan'] = $this->input->post('akhir_kegiatan', TRUE);
            $data['judul_kegiatan'] = $this->input->post('judul_kegiatan', TRUE);
            $data['manfaat_kegiatan'] = $this->input->post('manfaat_kegiatan', TRUE);

            $semester_ganjil_array = array('9', '10', '11', '12', '1', '2');
            $semester_genap_array = array('3', '4', '5', '6', '7', '8');
            $month = $this->input->post('awal_kegiatan', TRUE);
            $bulan = substr($month, 5, 2);

            if (in_array($bulan, $semester_ganjil_array)) {
                $data['semester'] = '1';
            } else if (in_array($bulan, $semester_genap_array)) {
                $data['semester'] = '2';
            }


            if (!empty($_FILES['doc_undangan']['name'])) {
                $data['doc_undangan'] = $this->_upload_doc_undangan();
            }

            if (!empty($_FILES['doc_absensi']['name'])) {
                $data['doc_absensi'] = $this->_upload_doc_absensi();
            }

            if (!empty($_FILES['doc_materi']['name'])) {
                $data['doc_materi'] = $this->_upload_doc_materi();
            }

            if (!empty($_FILES['doc_foto']['name'])) {
                $data['doc_foto'] = $this->_upload_doc_foto();
            }

            if (!empty($_FILES['doc_1']['name'])) {
                $data['doc_1'] = $this->_upload_doc_1();
            }

            if (!empty($_FILES['doc_2']['name'])) {
                $data['doc_2'] = $this->_upload_doc_2();
            }

            if (!empty($_FILES['doc_3']['name'])) {
                $data['doc_3'] = $this->_upload_doc_3();
            }

            if (!empty($_FILES['doc_4']['name'])) {
                $data['doc_4'] = $this->_upload_doc_4();
            }

            if (!empty($_FILES['doc_5']['name'])) {
                $data['doc_5'] = $this->_upload_doc_5();
            }

            if (!empty($_FILES['doc_6']['name'])) {
                $data['doc_6'] = $this->_upload_doc_6();
            }

            // insert ke table tb_kerjasama
            $this->Kegiatan_model->insert_tb_kegiatan($data);

            $data_response['status'] = true;
            $data_response['messege'] = '<p>Tambah Kegiatan Berhasil Disimpan</p>';
            echo json_encode($data_response);
        }
    }

    public function detail()
    {
        // load model
        $this->load->model('Kegiatan_model');

        $id_kegiatan = $this->input->get('id_kegiatan', TRUE);
        // ambil tb_kegiatan
        $kegiatan_row = $this->Kegiatan_model->get_tb_kegiatan_by_id($id_kegiatan)->row();

        $data['title'] = 'Detail Kegiatan';
        $data['id_kegiatan'] = $kegiatan_row->id_kegiatan;
        $data['jenis_kegiatan'] = $kegiatan_row->jenis_kegiatan;
        $data['awal_kegiatan'] = $kegiatan_row->awal_kegiatan;
        $data['akhir_kegiatan'] = $kegiatan_row->akhir_kegiatan;
        $data['selisih_hari'] = $kegiatan_row->selisih_hari;
        $data['judul_kegiatan'] = $kegiatan_row->judul_kegiatan;
        $data['manfaat_kegiatan'] = $kegiatan_row->manfaat_kegiatan;
        $data['doc_undangan'] = $kegiatan_row->doc_undangan;
        $data['doc_absensi'] = $kegiatan_row->doc_absensi;
        $data['doc_materi'] = $kegiatan_row->doc_materi;
        $data['doc_foto'] = $kegiatan_row->doc_foto;
        $data['doc_1'] = $kegiatan_row->doc_1;
        $data['doc_2'] = $kegiatan_row->doc_2;
        $data['doc_3'] = $kegiatan_row->doc_3;
        $data['doc_4'] = $kegiatan_row->doc_4;
        $data['doc_5'] = $kegiatan_row->doc_5;
        $data['doc_6'] = $kegiatan_row->doc_6;

        $response['status'] = true;
        $response['view_modal_form'] = $this->load->view('prodi/kegiatan/view_detail', $data, true);
        echo json_encode($response);
    }

    public function edit()
    {
        // load model kegiatan
        $this->load->model('Kegiatan_model');

        $kegiatan_row = $this->Kegiatan_model->get_tb_kegiatan_by_id($this->input->get('id_kegiatan', TRUE))->row();

        $data = array(
            'title' => "Edit Kegiatan",
            'action' => "prodi/kegiatan/edit_action",
            'id_kegiatan' => set_value('id_kegiatan', $kegiatan_row->id_kegiatan),
            'jenis_kegiatan' => set_value('jenis_kegiatan', $kegiatan_row->jenis_kegiatan),
            'awal_kegiatan' => set_value('awal_kegiatan', $kegiatan_row->awal_kegiatan),
            'akhir_kegiatan' => set_value('akhir_kegiatan', $kegiatan_row->akhir_kegiatan),
            'judul_kegiatan' => set_value('judul_kegiatan', $kegiatan_row->judul_kegiatan),
            'manfaat_kegiatan' => set_value('manfaat_kegiatan', $kegiatan_row->manfaat_kegiatan),
            'doc_undangan' => set_value('doc_undangan', $kegiatan_row->doc_undangan),
            'doc_absensi' => set_value('doc_absensi', $kegiatan_row->doc_absensi),
            'doc_materi' => set_value('doc_materi', $kegiatan_row->doc_materi),
            'doc_foto' => set_value('doc_foto', $kegiatan_row->doc_foto),
            'doc_1' => set_value('doc_1', $kegiatan_row->doc_1),
            'doc_2' => set_value('doc_2', $kegiatan_row->doc_2),
            'doc_3' => set_value('doc_3', $kegiatan_row->doc_3),
            'doc_4' => set_value('doc_4', $kegiatan_row->doc_4),
            'doc_5' => set_value('doc_5', $kegiatan_row->doc_5),
            'doc_6' => set_value('doc_6', $kegiatan_row->doc_6),
        );

        $data_response =  array(
            'status' => true,
            'view_modal_form' => $this->load->view('prodi/kegiatan/view_form', $data, true)
        );
        echo json_encode($data_response);
    }

    public function edit_action()
    {
        // load model
        $this->load->model('Kegiatan_model');

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

            $id_kegiatan = $this->input->post('id_kegiatan', TRUE);
            // $data['kode_prodi'] = $_SESSION['kode_prodi'];
            $data['kode_prodi'] = '2';
            $data['jenis_kegiatan'] = $this->input->post('jenis_kegiatan', TRUE);
            $data['awal_kegiatan'] = $this->input->post('awal_kegiatan', TRUE);
            $data['akhir_kegiatan'] = $this->input->post('akhir_kegiatan', TRUE);
            $data['judul_kegiatan'] = $this->input->post('judul_kegiatan', TRUE);
            $data['manfaat_kegiatan'] = $this->input->post('manfaat_kegiatan', TRUE);

            $semester_ganjil_array = array('9', '10', '11', '12', '1', '2');
            $semester_genap_array = array('3', '4', '5', '6', '7', '8');
            $month = $this->input->post('awal_kegiatan', TRUE);
            $bulan = substr($month, 5, 2);

            if (in_array($bulan, $semester_ganjil_array)) {
                $data['semester'] = '1';
            } else if (in_array($bulan, $semester_genap_array)) {
                $data['semester'] = '2';
            }

            if (!empty($_FILES['doc_undangan']['name'])) {
                $data['doc_undangan'] = $this->_upload_doc_undangan();
            }

            if (!empty($_FILES['doc_absensi']['name'])) {
                $data['doc_absensi'] = $this->_upload_doc_absensi();
            }

            if (!empty($_FILES['doc_materi']['name'])) {
                $data['doc_materi'] = $this->_upload_doc_materi();
            }

            if (!empty($_FILES['doc_foto']['name'])) {
                $data['doc_foto'] = $this->_upload_doc_foto();
            }

            if (!empty($_FILES['doc_1']['name'])) {
                $data['doc_1'] = $this->_upload_doc_1();
            }

            if (!empty($_FILES['doc_2']['name'])) {
                $data['doc_2'] = $this->_upload_doc_2();
            }

            if (!empty($_FILES['doc_3']['name'])) {
                $data['doc_3'] = $this->_upload_doc_3();
            }

            if (!empty($_FILES['doc_4']['name'])) {
                $data['doc_4'] = $this->_upload_doc_4();
            }

            if (!empty($_FILES['doc_5']['name'])) {
                $data['doc_5'] = $this->_upload_doc_5();
            }

            if (!empty($_FILES['doc_6']['name'])) {
                $data['doc_6'] = $this->_upload_doc_6();
            }

            // update ke table tb_kerjasama
            $this->Kegiatan_model->update_tb_kegiatan_by_id($id_kegiatan, $data);

            $data_response['status'] = true;
            $data_response['messege'] = '<p>Update Kegiatan Berhasil Disimpan</p>';
            echo json_encode($data_response);
        }
    }

    public function delete_action()
    {

        // load model
        $this->load->model('Kegiatan_model');

        $id_kerjasama = $this->input->post('id_kerjasama', TRUE);

        $query = $this->Kegiatan_model->delete_tb_kegiatan_by_id($id_kerjasama);
        $data_response =  array(
            'status' => true,
            'messege' => '<p>Berhasil hapus data Kerja Sama</p>',
        );
        echo json_encode($data_response);
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

    private function _upload_doc_absensi()
    {
        $config_doc_absensi['upload_path'] = './assets/file_kegiatan/';
        $config_doc_absensi['encrypt_name'] = TRUE;
        $config_doc_absensi['allowed_types'] = '*';
        // $this->upload->initialize($config);
        $this->load->library('upload', $config_doc_absensi);
        $this->upload->do_upload('doc_undangan');

        $data_upload = $this->upload->data();
        return $data_upload['file_name'];
    }

    private function _upload_doc_materi()
    {
        $config_doc_materi['upload_path'] = './assets/file_kegiatan/';
        $config_doc_materi['encrypt_name'] = TRUE;
        $config_doc_materi['allowed_types'] = '*';
        // $this->upload->initialize($config);
        $this->load->library('upload', $config_doc_materi);
        $this->upload->do_upload('doc_materi');

        $data_upload = $this->upload->data();
        return $data_upload['file_name'];
    }

    private function _upload_doc_foto()
    {
        $config_doc_foto['upload_path'] = './assets/file_kegiatan/';
        $config_doc_foto['encrypt_name'] = TRUE;
        $config_doc_foto['allowed_types'] = '*';
        // $this->upload->initialize($config);
        $this->load->library('upload', $config_doc_foto);
        $this->upload->do_upload('doc_foto');

        $data_upload = $this->upload->data();
        return $data_upload['file_name'];
    }

    private function _upload_doc_1()
    {
        $config_doc_1['upload_path'] = './assets/file_kegiatan/';
        $config_doc_1['encrypt_name'] = TRUE;
        $config_doc_1['allowed_types'] = '*';
        // $this->upload->initialize($config);
        $this->load->library('upload', $config_doc_1);
        $this->upload->do_upload('doc_1');

        $data_upload = $this->upload->data();
        return $data_upload['file_name'];
    }

    private function _upload_doc_2()
    {
        $config_doc_2['upload_path'] = './assets/file_kegiatan/';
        $config_doc_2['encrypt_name'] = TRUE;
        $config_doc_2['allowed_types'] = '*';
        // $this->upload->initialize($config);
        $this->load->library('upload', $config_doc_2);
        $this->upload->do_upload('doc_2');

        $data_upload = $this->upload->data();
        return $data_upload['file_name'];
    }

    private function _upload_doc_3()
    {
        $config_doc_3['upload_path'] = './assets/file_kegiatan/';
        $config_doc_3['encrypt_name'] = TRUE;
        $config_doc_3['allowed_types'] = '*';
        // $this->upload->initialize($config);
        $this->load->library('upload', $config_doc_3);
        $this->upload->do_upload('doc_3');

        $data_upload = $this->upload->data();
        return $data_upload['file_name'];
    }

    private function _upload_doc_4()
    {
        $config_doc_4['upload_path'] = './assets/file_kegiatan/';
        $config_doc_4['encrypt_name'] = TRUE;
        $config_doc_4['allowed_types'] = '*';
        // $this->upload->initialize($config);
        $this->load->library('upload', $config_doc_4);
        $this->upload->do_upload('doc_4');

        $data_upload = $this->upload->data();
        return $data_upload['file_name'];
    }

    private function _upload_doc_5()
    {
        $config_doc_5['upload_path'] = './assets/file_kegiatan/';
        $config_doc_5['encrypt_name'] = TRUE;
        $config_doc_5['allowed_types'] = '*';
        // $this->upload->initialize($config);
        $this->load->library('upload', $config_doc_5);
        $this->upload->do_upload('doc_5');

        $data_upload = $this->upload->data();
        return $data_upload['file_name'];
    }

    private function _upload_doc_6()
    {
        $config_doc_6['upload_path'] = './assets/file_kegiatan/';
        $config_doc_6['encrypt_name'] = TRUE;
        $config_doc_6['allowed_types'] = '*';
        // $this->upload->initialize($config);
        $this->load->library('upload', $config_doc_6);
        $this->upload->do_upload('doc_6');

        $data_upload = $this->upload->data();
        return $data_upload['file_name'];
    }
}
