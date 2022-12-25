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
        is_login();
    }

    // tampil MOA
    public function index()
    {
        $this->load->model('Ia_model');
        $this->load->model('Prodi_model');

        $data['menu'] = 'menu_ia';
        $data['title'] = "Implementation Arrangement (IA)";
        $data['load_css'] = 'ia/css_index';
        $data['load_js'] = 'ia/js_index';
        $data['tahun_ia_result'] = $this->Ia_model->get_tahun_ia()->result();
        $data['prodi_result'] = $this->Prodi_model->get_prodi()->result();
        $this->template->load('_template/main_template', 'ia/view_index', $data);
    }

    //  data ajax list MOU
    public function list()
    {
        $tahun_ia = $this->input->post('tahun_ia', TRUE);
        $kategori_ia = $this->input->post('kategori_ia', TRUE);
        $kode_prodi = $this->input->post('kode_prodi', TRUE);

        $this->load->model('Ia_model');

        // cek status_login ?
        $kode_prodi_hasil = "";
        if (($_SESSION['status_login'] == "Prodi")) {
            $kode_prodi_hasil = $_SESSION['kode_prodi'];
        } else {
            $kode_prodi_hasil =  $kode_prodi;
        }

        $datatables = new Datatables(new CodeigniterAdapter());
        $query = $this->Ia_model->get_list_ai($kode_prodi_hasil, $tahun_ia, $kategori_ia);
        $datatables->query($query);
        echo $datatables->generate();
    }

    public function create()
    {
        // initialize model
        $this->load->model('Ia_model');
        $this->load->model('Moa_model');
        $this->load->model('Dosen_model');
        $this->load->model('Ia_dosen_model');
        $this->load->model('Ia_dokumen_model');
        $this->load->model('Ia_kategori_model');
        $this->load->model('Ia_dosen_luar_biasa_model');
        $this->load->model('Ia_mahasiswa_model');

        // cek status_login ?
        $kode_prodi = "";
        if (($_SESSION['status_login'] == "Prodi")) {
            $kode_prodi = $_SESSION['kode_prodi'];
        }

        $data['menu'] = "menu_ia";
        $data['title'] = 'Tambah Implementation Arrangement (IA)';
        $data['action'] = "ia/create_action";
        $data['id']  = set_value('id');
        $data['moa_lembaga_mitra_id']  = set_value('moa_lembaga_mitra_id');
        $data['kategori_ia']  = set_value('kategori_ia');
        $data['tingkat_ia']  = set_value('tingkat_ia');
        $data['judul_kegiatan_ia']  = set_value('judul_kegiatan_ia');
        $data['manfaat_kegiatan_ia']  = set_value('manfaat_kegiatan_ia');
        $data['tanggal_awal_ia']  = set_value('tanggal_awal_ia');
        $data['tanggal_akhir_ia']  = set_value('tanggal_akhir_ia');


        $data['moa_result'] = $this->Moa_model->get_moa_by_prodi($kode_prodi)->result();
        $data['dosen_result'] = $this->Dosen_model->get_dosen()->result();
        $data['ia_kategori_result'] = $this->Ia_kategori_model->get_ia_kategori_by_ia_id('')->result();
        $data['ia_dosen_result'] = $this->Ia_dosen_model->get_ia_dosen_by_ia_id('')->result();
        $data['ia_dosen_luar_biasa_result'] = $this->Ia_dosen_luar_biasa_model->get_ia_dosen_luar_biasa_by_ia_id('')->result();
        $data['ia_mahasiswa_result'] = $this->Ia_mahasiswa_model->get_ia_mahasiswa_by_ia_id('')->result();
        $data['ia_dokumen_result'] = $this->Ia_dokumen_model->get_ia_dokumen_by_ia_id('')->result();

        $data_response =  array(
            'status' => true,
            'view_modal_form' => $this->load->view('ia/view_form', $data, true)
        );
        echo json_encode($data_response);
    }

    public function create_action()
    {
        // INIT MODEL
        $this->load->model('Ia_model');
        $this->load->model('Ia_dokumen_model');
        $this->load->model('Ia_dosen_model');
        $this->load->model('Ia_dosen_luar_biasa_model');
        $this->load->model('Ia_mahasiswa_model');
        $this->load->model('Ia_kategori_model');

        // validasi form
        $this->form_validation->set_rules('moa_lembaga_mitra_id', 'MOA Lembaga', 'trim|required');
        $this->form_validation->set_rules('kategori_ia[]', 'Kategori IA', 'trim|required');
        $this->form_validation->set_rules('tingkat_ia', 'tingkat IA', 'trim|required');
        $this->form_validation->set_rules('judul_kegiatan_ia', 'judul kegiatan', 'trim|required');
        $this->form_validation->set_rules('manfaat_kegiatan_ia', 'manfaat kegiatan', 'trim|required');
        $this->form_validation->set_rules('tanggal_awal_ia', 'tanggal awal', 'trim|required');
        $this->form_validation->set_rules('tanggal_akhir_ia', 'tanggal akhir', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data_response =  array(
                'status' => false,
                // 'token_csrf' => $this->security->get_csrf_hash(),
                'messege' => validation_errors(),
            );
            echo json_encode($data_response);
        } else {
             // cek status_login ?
        $kode_prodi = "";
        if (($_SESSION['status_login'] == "Prodi")) {
            $kode_prodi = $_SESSION['kode_prodi'];
        }

            $tanda_waktu = date('Y:m:d H:i:s');
            $data['moa_lembaga_mitra_id'] = $this->input->post('moa_lembaga_mitra_id', TRUE);
            $data['tingkat_ia'] = $this->input->post('tingkat_ia', TRUE);
            $data['judul_kegiatan_ia'] = $this->input->post('judul_kegiatan_ia', TRUE);
            $data['manfaat_kegiatan_ia'] = $this->input->post('manfaat_kegiatan_ia', TRUE);
            $data['tanggal_awal_ia'] = $this->input->post('tanggal_awal_ia', TRUE);
            $data['tanggal_akhir_ia'] = $this->input->post('tanggal_akhir_ia', TRUE);
            $data['kode_prodi'] = $kode_prodi;
            $data['waktu_buat'] = $tanda_waktu;
            // insert into tbl_ia
            $this->Ia_model->insert_ia($data);
            // get IA by waktu buat
            $ia_row = $this->Ia_model->get_ia_by_waktu_buat($tanda_waktu)->row();

            // insert tbl_ia_kategori
            $kategori_ia_arr = $this->input->post('kategori_ia[]', TRUE);
            foreach ($kategori_ia_arr as $key => $value) {
                $data_kategori['ia_id'] = $ia_row->id;
                $data_kategori['kategori'] = $value;
                $this->Ia_kategori_model->insert_ia_kategori($data_kategori);
            }

            // insert tbl_ia_dosen
            $npk_arr = $this->input->post('npk[]', TRUE);
            foreach ($npk_arr as $key => $value) {
                $data_dosen['ia_id'] = $ia_row->id;
                $data_dosen['npk'] = $value;
                $this->Ia_dosen_model->insert_ia_dosen($data_dosen);
            }

            // insert tbl_ia_dosen_luar_biasa
            $nama_dosen_luar_biasa_arr = $this->input->post('nama_dosen_luar_biasa[]', TRUE);
            foreach ($nama_dosen_luar_biasa_arr as $key => $value) {
                $data_dosen_luar_biasa['ia_id'] = $ia_row->id;
                $data_dosen_luar_biasa['nama_dosen_luar_biasa'] = $value;
                $this->Ia_dosen_luar_biasa_model->insert_ia_dosen_luar_biasa($data_dosen_luar_biasa);
            }

            // insert tbl_ia_mahasiswa
            $nama_mahasiswa_arr = $this->input->post('nama_mahasiswa[]', TRUE);
            foreach ($nama_mahasiswa_arr as $key => $value) {
                $data_mahasiswa['ia_id'] = $ia_row->id;
                $data_mahasiswa['nama_mahasiswa'] = $value;
                $this->Ia_mahasiswa_model->insert_ia_mahasiswa($data_mahasiswa);
            }

            // insert  tbl_moa_dokumen
            $count = count($_FILES['files']['name']);

            for ($i = 0; $i < $count; $i++) {

                $nama_file_arr =  $this->input->post('nama_file[]', TRUE);
                $jenis_dokumen_arr =  $this->input->post('jenis_dokumen[]', TRUE);

                if (!empty($_FILES['files']['name'][$i])) {

                    $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                    $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['files']['size'][$i];

                    $config_doc1['upload_path'] = './assets/doc_ia/';
                    $config_doc1['allowed_types'] = '*';
                    $config_doc1['file_name'] = "doc_ia_" . date('Ymdhis');
                    $this->load->library('upload', $config_doc1);
                    $this->upload->initialize($config_doc1);

                    $this->upload->do_upload('file');
                    $data_upload = $this->upload->data();
                    $data_dokumen['ia_id'] = $ia_row->id;
                    $data_dokumen['jenis_dokumen'] = $jenis_dokumen_arr[$i];
                    $data_dokumen['file_dokumen'] = $data_upload['file_name'];
                    $data_dokumen['nama_file'] = $nama_file_arr[$i];
                    $this->Ia_dokumen_model->insert_ia_dokumen($data_dokumen);
                }
            }


            $data_response =  array(
                'status' => true,
                // 'token_csrf' => $this->security->get_csrf_hash(),
                'messege' => 'Tambah Implementation Arrangement (IA) BERHASIL'
            );
            echo json_encode($data_response);
        }
    }

    public function detail()
    {
        $this->load->model('Ia_model');
        $this->load->model('Moa_model');
        $this->load->model('Dosen_model');
        $this->load->model('Ia_dosen_model');
        $this->load->model('Ia_dokumen_model');
        $this->load->model('Ia_kategori_model');
        $this->load->model('Ia_dosen_luar_biasa_model');
        $this->load->model('Ia_mahasiswa_model');

        $id = $this->input->get('ia_id', TRUE);
        $ia_row = $this->Ia_model->get_ia_by_id($id)->row();

        // cek status_login ?
        $kode_prodi = "";
        if (($_SESSION['status_login'] == "Prodi")) {
            $kode_prodi = $_SESSION['kode_prodi'];
        }

        $data['menu'] = 'menu_ia';
        $data['title'] = 'Detail Implementation Arrangement (IA)';
        $data['id']  = $ia_row->id;
        $data['moa_lembaga_mitra_id'] = $ia_row->moa_lembaga_mitra_id;
        $data['tingkat_ia']  = $ia_row->tingkat_ia;
        $data['judul_kegiatan_ia']  = $ia_row->judul_kegiatan_ia;
        $data['manfaat_kegiatan_ia']  = $ia_row->manfaat_kegiatan_ia;
        $data['tanggal_awal_ia']  = $ia_row->tanggal_awal_ia;
        $data['tanggal_akhir_ia']  = $ia_row->tanggal_akhir_ia;
        $data['selisih_hari'] = $ia_row->selisih_hari;

        $data['moa_result'] = $this->Moa_model->get_moa_by_prodi($kode_prodi)->result();
        $data['dosen_result'] = $this->Dosen_model->get_dosen()->result();
        $data['ia_kategori_result'] = $this->Ia_kategori_model->get_ia_kategori_by_ia_id($ia_row->id)->result();
        $data['ia_dosen_result'] = $this->Ia_dosen_model->get_ia_dosen_dosen_by_ia_id($ia_row->id)->result();
        $data['ia_dosen_luar_biasa_result'] = $this->Ia_dosen_luar_biasa_model->get_ia_dosen_luar_biasa_by_ia_id($ia_row->id)->result();
        $data['ia_mahasiswa_result'] = $this->Ia_mahasiswa_model->get_ia_mahasiswa_by_ia_id($ia_row->id)->result();
        $data['ia_dokumen_result'] = $this->Ia_dokumen_model->get_ia_dokumen_by_ia_id($ia_row->id)->result();

        $this->template->load('_template/main_template', 'ia/view_detail', $data);
    }

    public function update()
    {
        $this->load->model('Ia_model');
        $this->load->model('Moa_model');
        $this->load->model('Dosen_model');
        $this->load->model('Ia_dosen_model');
        $this->load->model('Ia_dokumen_model');
        $this->load->model('Ia_kategori_model');
        $this->load->model('Ia_dosen_luar_biasa_model');
        $this->load->model('Ia_mahasiswa_model');

        $id = $this->input->get('id', TRUE);
        $ia_row = $this->Ia_model->get_ia_by_id($id)->row();

        // cek status_login ?
        $kode_prodi = "";
        if (($_SESSION['status_login'] == "Prodi")) {
            $kode_prodi = $_SESSION['kode_prodi'];
        }

        $data['menu'] = "menu_ia";
        $data['title'] = 'Update Implementation Arrangement (IA)';
        $data['action'] = "ia/update_action";
        $data['id']  = $ia_row->id;
        $data['moa_lembaga_mitra_id'] = $ia_row->moa_lembaga_mitra_id;
        $data['tingkat_ia']  = $ia_row->tingkat_ia;
        $data['judul_kegiatan_ia']  = $ia_row->judul_kegiatan_ia;
        $data['manfaat_kegiatan_ia']  = $ia_row->manfaat_kegiatan_ia;
        $data['tanggal_awal_ia']  = $ia_row->tanggal_awal_ia;
        $data['tanggal_akhir_ia']  = $ia_row->tanggal_akhir_ia;

        $data['moa_result'] = $this->Moa_model->get_moa_by_prodi($kode_prodi)->result();
        $data['dosen_result'] = $this->Dosen_model->get_dosen()->result();
        $data['ia_kategori_result'] = $this->Ia_kategori_model->get_ia_kategori_by_ia_id($ia_row->id)->result();
        $data['ia_dosen_result'] = $this->Ia_dosen_model->get_ia_dosen_by_ia_id($ia_row->id)->result();
        $data['ia_dosen_luar_biasa_result'] = $this->Ia_dosen_luar_biasa_model->get_ia_dosen_luar_biasa_by_ia_id($ia_row->id)->result();
        $data['ia_mahasiswa_result'] = $this->Ia_mahasiswa_model->get_ia_mahasiswa_by_ia_id($ia_row->id)->result();
        $data['ia_dokumen_result'] = $this->Ia_dokumen_model->get_ia_dokumen_by_ia_id($ia_row->id)->result();

        $data_response =  array(
            'status' => true,
            'ia_kategori_result' => $this->Ia_kategori_model->get_ia_kategori_by_ia_id($ia_row->id)->result(),
            'view_modal_form' => $this->load->view('ia/view_form', $data, true)
        );
        echo json_encode($data_response);
    }

    public function update_action()
    {
        // INIT MODEL
        $this->load->model('Ia_model');
        $this->load->model('Ia_dokumen_model');
        $this->load->model('Ia_dosen_model');
        $this->load->model('Ia_dosen_luar_biasa_model');
        $this->load->model('Ia_mahasiswa_model');
        $this->load->model('Ia_kategori_model');

        // validasi form
        $this->form_validation->set_rules('moa_lembaga_mitra_id', 'MOA Lembaga', 'trim|required');
        $this->form_validation->set_rules('kategori_ia[]', 'Kategori IA', 'trim|required');
        $this->form_validation->set_rules('tingkat_ia', 'tingkat IA', 'trim|required');
        $this->form_validation->set_rules('judul_kegiatan_ia', 'judul kegiatan', 'trim|required');
        $this->form_validation->set_rules('manfaat_kegiatan_ia', 'manfaat kegiatan', 'trim|required');
        $this->form_validation->set_rules('tanggal_awal_ia', 'tanggal awal', 'trim|required');
        $this->form_validation->set_rules('tanggal_akhir_ia', 'tanggal akhir', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data_response =  array(
                'status' => false,
                // 'token_csrf' => $this->security->get_csrf_hash(),
                'messege' => validation_errors(),
            );
            echo json_encode($data_response);
        } else {
            $id = $this->input->post('id', TRUE);

            $data['moa_lembaga_mitra_id'] = $this->input->post('moa_lembaga_mitra_id', TRUE);
            $data['tingkat_ia'] = $this->input->post('tingkat_ia', TRUE);
            $data['judul_kegiatan_ia'] = $this->input->post('judul_kegiatan_ia', TRUE);
            $data['manfaat_kegiatan_ia'] = $this->input->post('manfaat_kegiatan_ia', TRUE);
            $data['tanggal_awal_ia'] = $this->input->post('tanggal_awal_ia', TRUE);
            $data['tanggal_akhir_ia'] = $this->input->post('tanggal_akhir_ia', TRUE);
            // insert into tbl_ia
            $this->Ia_model->update_ia_by_id($id,$data);
           

            $this->Ia_kategori_model->delete_ia_kategori_by_ia_id($id);
            // insert tbl_ia_kategori
            $kategori_ia_arr = $this->input->post('kategori_ia[]', TRUE);
            foreach ($kategori_ia_arr as $key => $value) {
                $data_kategori['ia_id'] = $id;
                $data_kategori['kategori'] = $value;
                $this->Ia_kategori_model->insert_ia_kategori($data_kategori);
            }

            $this->Ia_dosen_model->delete_ia_dosen_by_ia_id($id);
            // insert tbl_ia_dosen
            $npk_arr = $this->input->post('npk[]', TRUE);
            foreach ($npk_arr as $key => $value) {
                $data_dosen['ia_id'] = $id;
                $data_dosen['npk'] = $value;
                $this->Ia_dosen_model->insert_ia_dosen($data_dosen);
            }

            $this->Ia_dosen_luar_biasa_model->delete_ia_dosen_luar_biasa_by_ia_id($id);
            // insert tbl_ia_dosen_luar_biasa
            $nama_dosen_luar_biasa_arr = $this->input->post('nama_dosen_luar_biasa[]', TRUE);
            foreach ($nama_dosen_luar_biasa_arr as $key => $value) {
                $data_dosen_luar_biasa['ia_id'] = $id;
                $data_dosen_luar_biasa['nama_dosen_luar_biasa'] = $value;
                $this->Ia_dosen_luar_biasa_model->insert_ia_dosen_luar_biasa($data_dosen_luar_biasa);
            }

            $this->Ia_mahasiswa_model->delete_ia_mahasiswa_by_ia_id($id);
            // insert tbl_ia_mahasiswa
            $nama_mahasiswa_arr = $this->input->post('nama_mahasiswa[]', TRUE);
            foreach ($nama_mahasiswa_arr as $key => $value) {
                $data_mahasiswa['ia_id'] = $id;
                $data_mahasiswa['nama_mahasiswa'] = $value;
                $this->Ia_mahasiswa_model->insert_ia_mahasiswa($data_mahasiswa);
            }

            // insert  tbl_moa_dokumen
            $count = count($_FILES['files']['name']);

            for ($i = 0; $i < $count; $i++) {

                $nama_file_arr =  $this->input->post('nama_file[]', TRUE);
                $jenis_dokumen_arr =  $this->input->post('jenis_dokumen[]', TRUE);

                if (!empty($_FILES['files']['name'][$i])) {

                    $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                    $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['files']['size'][$i];

                    $config_doc1['upload_path'] = './assets/doc_ia/';
                    $config_doc1['allowed_types'] = '*';
                    $config_doc1['file_name'] = "doc_ia_" . date('Ymdhis');
                    $this->load->library('upload', $config_doc1);
                    $this->upload->initialize($config_doc1);

                    $this->upload->do_upload('file');
                    $data_upload = $this->upload->data();
                    $data_dokumen['ia_id'] = $id;
                    $data_dokumen['jenis_dokumen'] = $jenis_dokumen_arr[$i];
                    $data_dokumen['file_dokumen'] = $data_upload['file_name'];
                    $data_dokumen['nama_file'] = $nama_file_arr[$i];
                    $this->Ia_dokumen_model->insert_ia_dokumen($data_dokumen);
                }
            }

            $data_response =  array(
                'status' => true,
                // 'token_csrf' => $this->security->get_csrf_hash(),
                'messege' => 'Update Implementation Arrangement (IA) BERHASIL'
            );

            echo json_encode($data_response);
        }
    }

    public function delete_action()
    {
        $this->load->model('Ia_model');

        $id =  $this->input->post('id', TRUE);
        if ($this->Ia_model->delete_ia_by_id($id) > 0) {
            $data_response =  array(
                'status' => true,
                // 'token_csrf' => $this->security->get_csrf_hash(),
                'messege' => 'Hapus Implementation Arrangement (IA) BERHASIL'
            );
        } else {
            $data_response =  array(
                'status' => false,
                // 'token_csrf' => $this->security->get_csrf_hash(),
                'messege' => 'Hapus  Implementation Arrangement (IA) GAGAL'
            );
        }
        echo json_encode($data_response);
    }
}
