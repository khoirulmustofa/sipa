<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kerja_sama extends CI_Controller
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
        $this->load->model('Kerja_sama_model');

        $tahun_kerja_sama_result = $this->Kerja_sama_model->get_tahun_kerja_sama()->result();

        $data['menu'] = 'menu_kerja_sama';
        $data['title'] = "Daftar Kerja Sama";
        $data['load_css'] = 'tu/kerja_sama/css_index';
        $data['load_js'] = 'tu/kerja_sama/js_index';
        $data['tahun_kerja_sama_result'] = $tahun_kerja_sama_result;

        $this->template->load('_template/main_template', 'tu/kerja_sama/view_index', $data);
    }

    public function get_kerja_sama_json()
    {
        $this->load->model('Kerja_sama_model');
        $jenis_kerjasama = $this->input->post('jenis_kerjasama', TRUE);
        $tahun_kerja_sama = $this->input->post('tahun_kerja_sama', TRUE);

        header('Content-Type: application/json');
        $list = $this->Kerja_sama_model->get_datatables($jenis_kerjasama,$tahun_kerja_sama);
        $data = array();
        $no = $this->input->post('start');
        //looping data mahasiswa
        foreach ($list as $kerja_sama) {
            $no++;
            $row = array();
            
            //row pertama akan kita gunakan untuk btn edit dan delete
            $row[] = $no;
            $row[] =  '<a class="btn btn-info btn-sm" onclick="btn_detail('."'".$kerja_sama->id_kerjasama."'".')"><i class="fa fa-eye"></i> </a>
                        <a class="btn btn-warning btn-sm" onclick="btn_edit('."'".$kerja_sama->id_kerjasama."'".')"><i class="fa fa-edit"></i> </a>
                        <a class="btn btn-danger btn-sm" onclick="btn_delete('."'".$kerja_sama->id_kerjasama."'".')"><i class="fa fa-trash"></i> </a>';
            $row[] = $kerja_sama->jenis_kerjasama;
            $row[] = $kerja_sama->lembaga_mitra;
            $row[] = $kerja_sama->alamat_mitra;
            $row[] = $kerja_sama->nama_negara;
            $row[] = $kerja_sama->durasi_kerjasama;
            $row[] = $kerja_sama->tgl_kerjasama;
            $row[] = $kerja_sama->tgl_kerjasama;
            $row[] = $kerja_sama->tgl_kerjasama;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Kerja_sama_model->count_all(),
            "recordsFiltered" => $this->Kerja_sama_model->count_filtered($jenis_kerjasama,$tahun_kerja_sama),
            "data" => $data,
        );
        //output to json format
        $this->output->set_output(json_encode($output));
    }

    public function buat_kerja_sama()
    {
        // load model
        $this->load->model('Negara_model');
        $this->load->model('Provinsi_model');

        // ambil data negara dari model Kerja_sama_model
        $negara_result = $this->Negara_model->get_master_negara()->result();
        // ambil data provinsi dari model Kerja_sama_model
        $provinsi_result = $this->Provinsi_model->get_master_provinsi()->result();
        // ambil data kota_kabupaten dari model master_kota_kabupaten
        $kota_kabupaten_result = $this->Provinsi_model->get_master_kota_kabupaten_by_provinsi_id("")->result();
        // ambil data master_kecamatan dari model kabupaten_kota
        $kecamatan_result = $this->Provinsi_model->get_master_kecamatan_by_kota_kabupaten_id("")->result();
        // ambil data kelurahan dari model master_kelurahan
        $kelurahan_result = $this->Provinsi_model->get_master_kelurahan_by_kecamatan_id("")->result();

        $data = array(
            'title' => "Tambah Kerja Sama",
            'action' => "kerja_sama/buat_kerja_sama_action",
            'id_kerjasama' => set_value('id_kerjasama'),
            'jenis_kerjasama' => set_value('jenis_kerjasama'),
            'tgl_kerjasama' => set_value('tgl_kerjasama'),
            'lembaga_mitra' => set_value('lembaga_mitra'),
            'alamat_mitra' => set_value('alamat_mitra'),
            'negara_id' => set_value('negara_id'),
            'provinsi_id' => set_value('provinsi_id'),
            'kabupaten_kota_id' => set_value('kabupaten_kota_id'),
            'kecamatan_id' => set_value('kecamatan_id'),
            'kelurahan_id' => set_value('kelurahan_id'),
            'durasi_kerjasama' => set_value('durasi_kerjasama'),
            'akhir_kerjasama' => set_value('akhir_kerjasama'),
            'dokumen_kerjasama' => set_value('dokumen_kerjasama'),
            'negara_result' => $negara_result,
            'provinsi_result' => $provinsi_result,
            'kota_kabupaten_result' => $kota_kabupaten_result,
            'kecamatan_result' => $kecamatan_result,
            'kelurahan_result' => $kelurahan_result
        );
        $data_response =  array(
            'status' => true,
            'view_modal_form' => $this->load->view('tu/kerja_sama/view_form', $data, true)
        );
        echo json_encode($data_response);
    }

    public function buat_kerja_sama_action()
    {
        $this->form_validation->set_rules('jenis_kerjasama', 'jenis kerjasama', 'trim|required');
        $this->form_validation->set_rules('tgl_kerjasama', 'tgl kerjasama', 'trim|required');
        $this->form_validation->set_rules('lembaga_mitra', 'lembaga mitra', 'trim|required');
        $this->form_validation->set_rules('alamat_mitra', 'alamat mitra', 'trim|required');
        $this->form_validation->set_rules('negara_id', 'negara id', 'trim|required');
        if ($this->input->post('negara_id', TRUE) == "102") {
            $this->form_validation->set_rules('provinsi_id', 'provinsi id', 'trim|required');
            $this->form_validation->set_rules('kabupaten_kota_id', 'kabupaten kota id', 'trim|required');
            $this->form_validation->set_rules('kecamatan_id', 'kecamatan id', 'trim|required');
            $this->form_validation->set_rules('kelurahan_id', 'kelurahan id', 'trim|required');
        }
        $this->form_validation->set_rules('durasi_kerjasama', 'durasi kerjasama', 'trim|required');
        if (empty($_FILES['dokumen_kerjasama']['name'])) {
            $this->form_validation->set_rules('dokumen_kerjasama', 'Document', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            $data_response =  array(
                'status' => false,
                'messege' => validation_errors(),
            );
            echo json_encode($data_response);
        } else {

            $config['upload_path'] = './assets/file_dok/';
            $config['encrypt_name'] = TRUE;
            $config['allowed_types']        = '*';
            // $config['max_size']             = 100;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            // $this->upload->initialize($config);
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('dokumen_kerjasama')) {
                $data_response =  array(
                    'status' => false,
                    'messege' => $this->upload->display_errors()
                    // $this->upload->display_errors()
                );
                echo json_encode($data_response);
            } else {
                $data_upload = $this->upload->data();
                $data_insert = array(
                    'jenis_kerjasama' => $this->input->post('jenis_kerjasama', TRUE),
                    'tgl_kerjasama' => $this->input->post('tgl_kerjasama', TRUE),
                    'lembaga_mitra' => $this->input->post('lembaga_mitra', TRUE),
                    'alamat_mitra' => $this->input->post('alamat_mitra', TRUE),
                    'negara_id' => $this->input->post('negara_id', TRUE),
                    'provinsi_id' => $this->input->post('provinsi_id', TRUE),
                    'kabupaten_kota_id' => $this->input->post('kabupaten_kota_id', TRUE),
                    'kecamatan_id' => $this->input->post('kecamatan_id', TRUE),
                    'kelurahan_id' => $this->input->post('kelurahan_id', TRUE),
                    'durasi_kerjasama' => $this->input->post('durasi_kerjasama', TRUE),
                    'akhir_kerjasama' => date('Y-m-d', strtotime('+' . $this->input->post('durasi_kerjasama', TRUE) . ' year', strtotime($this->input->post('tgl_kerjasama', TRUE)))),
                    'dokumen_kerjasama' => $data_upload['file_name'],
                );

                // load model
                $query =  $this->load->model('Kerja_sama_model');
                // insert ke table tb_kerjasama
                $this->Kerja_sama_model->insert_tb_kerjasama($data_insert);

                $data_response =  array(
                    'status' => true,
                    'messege' => '<p>Tambah Kerja Sama Berhasil Disimpan</p>',
                );
                echo json_encode($data_response);
            }
        }
    }

    public function edit_kerja_sama()
    {
        // load model
        $this->load->model('Negara_model');
        $this->load->model('Provinsi_model');
        $this->load->model('Kerja_sama_model');

        $id_kerjasama = $this->input->get('id_kerjasama', TRUE);

        $kerja_sama_row = $this->Kerja_sama_model->get_tb_kerjasama_by_id($id_kerjasama)->row();

        // ambil data negara dari model Kerja_sama_model
        $negara_result = $this->Negara_model->get_master_negara()->result();
        // ambil data provinsi dari model Kerja_sama_model
        $provinsi_result = $this->Provinsi_model->get_master_provinsi()->result();

        // ambil data kota_kabupaten dari model master_kota_kabupaten
        $kota_kabupaten_result = $this->Provinsi_model->get_master_kota_kabupaten_by_provinsi_id($kerja_sama_row->provinsi_id)->result();
        // ambil data master_kecamatan dari model kabupaten_kota
        $kecamatan_result = $this->Provinsi_model->get_master_kecamatan_by_kota_kabupaten_id($kerja_sama_row->kabupaten_kota_id)->result();
        // ambil data kelurahan dari model master_kelurahan
        $kelurahan_result = $this->Provinsi_model->get_master_kelurahan_by_kecamatan_id($kerja_sama_row->kecamatan_id)->result();


        // ambil data tb_kerjasama dan relasinya by Id
        $data = array(
            'title' => "Edit Kerja Sama",
            'action' => "kerja_sama/edit_kerja_sama_action",
            'id_kerjasama' => set_value('id_kerjasama', $kerja_sama_row->id_kerjasama),
            'jenis_kerjasama' => set_value('jenis_kerjasama', $kerja_sama_row->jenis_kerjasama),
            'tgl_kerjasama' => set_value('tgl_kerjasama', $kerja_sama_row->tgl_kerjasama),
            'lembaga_mitra' => set_value('lembaga_mitra', $kerja_sama_row->lembaga_mitra),
            'alamat_mitra' => set_value('alamat_mitra', $kerja_sama_row->alamat_mitra),
            'negara_id' => set_value('negara_id', $kerja_sama_row->negara_id),
            'provinsi_id' => set_value('provinsi_id', $kerja_sama_row->provinsi_id),
            'kabupaten_kota_id' => set_value('kabupaten_kota_id', $kerja_sama_row->kabupaten_kota_id),
            'kecamatan_id' => set_value('kecamatan_id', $kerja_sama_row->kecamatan_id),
            'kelurahan_id' => set_value('kelurahan_id', $kerja_sama_row->kelurahan_id),
            'durasi_kerjasama' => set_value('durasi_kerjasama', $kerja_sama_row->durasi_kerjasama),
            'akhir_kerjasama' => set_value('akhir_kerjasama', $kerja_sama_row->akhir_kerjasama),
            'dokumen_kerjasama' => set_value('dokumen_kerjasama', $kerja_sama_row->dokumen_kerjasama),
            'negara_result' => $negara_result,
            'provinsi_result' => $provinsi_result,
            'kota_kabupaten_result' => $kota_kabupaten_result,
            'kecamatan_result' => $kecamatan_result,
            'kelurahan_result' => $kelurahan_result
        );
        $data_response =  array(
            'status' => true,
            'view_modal_form' => $this->load->view('tu/kerja_sama/view_form', $data, true)
        );
        echo json_encode($data_response);
    }

    public function edit_kerja_sama_action()
    {
        $this->form_validation->set_rules('jenis_kerjasama', 'jenis kerjasama', 'trim|required');
        $this->form_validation->set_rules('tgl_kerjasama', 'tgl kerjasama', 'trim|required');
        $this->form_validation->set_rules('lembaga_mitra', 'lembaga mitra', 'trim|required');
        $this->form_validation->set_rules('alamat_mitra', 'alamat mitra', 'trim|required');
        $this->form_validation->set_rules('negara_id', 'negara id', 'trim|required');
        if ($this->input->post('negara_id', TRUE) == "102") {
            $this->form_validation->set_rules('provinsi_id', 'provinsi id', 'trim|required');
            $this->form_validation->set_rules('kabupaten_kota_id', 'kabupaten kota id', 'trim|required');
            $this->form_validation->set_rules('kecamatan_id', 'kecamatan id', 'trim|required');
            $this->form_validation->set_rules('kelurahan_id', 'kelurahan id', 'trim|required');
        }
        $this->form_validation->set_rules('durasi_kerjasama', 'durasi kerjasama', 'trim|required');
        // if (empty($_FILES['dokumen_kerjasama']['name'])) {
        //     $this->form_validation->set_rules('dokumen_kerjasama', 'Document', 'required');
        // }

        $id_kerjasama = $this->input->post('id_kerjasama', TRUE);

        if ($this->form_validation->run() == FALSE) {
            $data_response =  array(
                'status' => false,
                'messege' => validation_errors(),
            );
            echo json_encode($data_response);
        } else {

            if (empty($_FILES['dokumen_kerjasama']['name'])) {

                $data_update = array(
                    'jenis_kerjasama' => $this->input->post('jenis_kerjasama', TRUE),
                    'tgl_kerjasama' => $this->input->post('tgl_kerjasama', TRUE),
                    'lembaga_mitra' => $this->input->post('lembaga_mitra', TRUE),
                    'alamat_mitra' => $this->input->post('alamat_mitra', TRUE),
                    'negara_id' => $this->input->post('negara_id', TRUE),
                    'provinsi_id' => $this->input->post('provinsi_id', TRUE),
                    'kabupaten_kota_id' => $this->input->post('kabupaten_kota_id', TRUE),
                    'kecamatan_id' => $this->input->post('kecamatan_id', TRUE),
                    'kelurahan_id' => $this->input->post('kelurahan_id', TRUE),
                    'durasi_kerjasama' => $this->input->post('durasi_kerjasama', TRUE),
                    'akhir_kerjasama' => date('Y-m-d', strtotime('+' . $this->input->post('durasi_kerjasama', TRUE) . ' year', strtotime($this->input->post('tgl_kerjasama', TRUE)))),
                );

                // load model
                $query =  $this->load->model('Kerja_sama_model');
                // insert ke table tb_kerjasama
                $this->Kerja_sama_model->update_tb_kerjasama_by_id($data_update, $id_kerjasama);

                $data_response =  array(
                    'status' => true,
                    'messege' => '<p>Tambah Kerja Sama Berhasil Disimpan</p>',
                );
                echo json_encode($data_response);
            } else {


                $config['upload_path'] = './assets/file_dok/';
                $config['encrypt_name'] = TRUE;
                $config['allowed_types']        = '*';

                $this->upload->initialize($config);
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('dokumen_kerjasama')) {
                    $data_response =  array(
                        'status' => false,
                        'messege' => $this->upload->display_errors()
                    );
                    echo json_encode($data_response);
                } else {
                    $data_upload = $this->upload->data();
                    $data_update = array(
                        'jenis_kerjasama' => $this->input->post('jenis_kerjasama', TRUE),
                        'tgl_kerjasama' => $this->input->post('tgl_kerjasama', TRUE),
                        'lembaga_mitra' => $this->input->post('lembaga_mitra', TRUE),
                        'alamat_mitra' => $this->input->post('alamat_mitra', TRUE),
                        'negara_id' => $this->input->post('negara_id', TRUE),
                        'provinsi_id' => $this->input->post('provinsi_id', TRUE),
                        'kabupaten_kota_id' => $this->input->post('kabupaten_kota_id', TRUE),
                        'kecamatan_id' => $this->input->post('kecamatan_id', TRUE),
                        'kelurahan_id' => $this->input->post('kelurahan_id', TRUE),
                        'durasi_kerjasama' => $this->input->post('durasi_kerjasama', TRUE),
                        'akhir_kerjasama' => date('Y-m-d', strtotime('+' . $this->input->post('durasi_kerjasama', TRUE) . ' year', strtotime($this->input->post('tgl_kerjasama', TRUE)))),
                        'dokumen_kerjasama' => $data_upload['file_name'],
                    );

                    // load model
                    $query =  $this->load->model('Kerja_sama_model');
                    // insert ke table tb_kerjasama
                    $this->Kerja_sama_model->update_tb_kerjasama_by_id($data_update, $id_kerjasama);

                    $data_response =  array(
                        'status' => true,
                        'messege' => '<p>Tambah Kerja Sama Berhasil Disimpan</p>',
                    );
                    echo json_encode($data_response);
                }
            }
        }
    }

    public function detail_kerja_sama()
    {
        // load model
        $this->load->model('Kerja_sama_model');

        $id_kerjasama = $this->input->get('id_kerjasama', TRUE);
        // ambil data tb_kerjasama dan relasinya by Id
        $kerja_sama_row = $this->Kerja_sama_model->get_tb_kerjasama_dll_by_id($id_kerjasama)->row();


        $data = array(
            'title' => "Detail Kerja Sama",
            'action' => "kerja_sama/edit_kerja_sama_action",
            'id_kerjasama' => $kerja_sama_row->id_kerjasama,
            'jenis_kerjasama' => $kerja_sama_row->jenis_kerjasama,
            'tgl_kerjasama' => $kerja_sama_row->tgl_kerjasama,
            'lembaga_mitra' => $kerja_sama_row->lembaga_mitra,
            'alamat_mitra' => $kerja_sama_row->alamat_mitra,
            'negara_id' => $kerja_sama_row->negara_id,
            'provinsi_id' => $kerja_sama_row->provinsi_id,
            'kabupaten_kota_id' => $kerja_sama_row->kabupaten_kota_id,
            'kecamatan_id' => $kerja_sama_row->kecamatan_id,
            'kelurahan_id' => $kerja_sama_row->kelurahan_id,
            'durasi_kerjasama' => $kerja_sama_row->durasi_kerjasama,
            'akhir_kerjasama' => $kerja_sama_row->akhir_kerjasama,
            'tgl_peringatan' => $kerja_sama_row->tgl_peringatan,
            'dokumen_kerjasama' => $kerja_sama_row->dokumen_kerjasama,
            'nama_negara' => $kerja_sama_row->nama_negara,
            'province_name' =>  $kerja_sama_row->province_name,
            'kota_kabupaten_nama' =>  $kerja_sama_row->kota_kabupaten_nama,
            'kecamatan_nama' => $kerja_sama_row->kecamatan_nama,
            'kelurahan_nama' => $kerja_sama_row->kelurahan_nama,
        );
        $data_response =  array(
            'status' => true,
            'view_modal_form' => $this->load->view('tu/kerja_sama/view_detail', $data, true)
        );
        echo json_encode($data_response);
    }

    public function get_kota_kabupaten()
    {
        // load model
        $this->load->model('Provinsi_model');
        // leparan data provinsi_id
        $provinsi_id =  $this->input->get('provinsi_id', TRUE);
        // ambil query dari model Provinsi_model
        $kota_kabupaten_result =  $this->Provinsi_model->get_master_kota_kabupaten_by_provinsi_id($provinsi_id)->result();

        $html = '<option value="">Pilih Kota Kabupaten</option>';
        foreach ($kota_kabupaten_result as $key => $value) {
            $html .= '<option value="' . $value->master_kota_kabupaten_id . '">' . $value->kota_kabupaten_nama . '</option>';
        }
        $data_response =  array(
            'status' => true,
            'kota_kabupaten_html' => $html,
        );
        echo json_encode($data_response);
    }

    public function get_kecamatan()
    {
        // load model
        $this->load->model('Provinsi_model');
        // leparan data kota_kabupaten_id
        $kota_kabupaten_id =  $this->input->get('kabupaten_kota_id', TRUE);
        // ambil query dari model Provinsi_model
        $kecamatan_result =  $this->Provinsi_model->get_master_kecamatan_by_kota_kabupaten_id($kota_kabupaten_id)->result();

        $html = '<option value="">Pilih Kecamatan</option>';
        foreach ($kecamatan_result as $key => $value) {
            $html .= '<option value="' . $value->master_kecamatan_id . '">' . $value->kecamatan_nama . '</option>';
        }
        $data_response =  array(
            'status' => true,
            'kecamatan_html' => $html,
        );
        echo json_encode($data_response);
    }

    public function get_kelurahan()
    {
        // load model
        $this->load->model('Provinsi_model');
        // leparan data kota_kabupaten_id
        $kecamatan_id =  $this->input->get('kecamatan_id', TRUE);
        // ambil query dari model Provinsi_model      
        $kelurahan_result =  $this->Provinsi_model->get_master_kelurahan_by_kecamatan_id($kecamatan_id)->result();

        $html = '<option value="">Pilih Kelurhan / Desa</option>';
        foreach ($kelurahan_result as $key => $value) {
            $html .= '<option value="' . $value->master_kelurahan_id . '">' . $value->kelurahan_nama . '</option>';
        }
        $data_response =  array(
            'status' => true,
            'kelurahan_html' => $html,
        );
        echo json_encode($data_response);
    }


    // Untuk menghapus data di table tb_kerjasama
    public function hapus_action()
    {
        // load model
        $this->load->model('Kerja_sama_model');

        $id_kerjasama = $this->input->get('id_kerjasama', TRUE);

        $query = $this->Kerja_sama_model->delete_tb_kerjasama_by_id($id_kerjasama);
        $data_response =  array(
            'status' => true,
            'messege' => '<p>Berhasil hapus data Kerja Sama</p>',
        );
        echo json_encode($data_response);
    }
}
