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

    public function get_kegiatan_json()
    {
        $this->load->model('Kerja_sama_model');
        $jenis_kerjasama = $this->input->post('jenis_kerjasama', TRUE);
        $tahun_kerja_sama = $this->input->post('tahun_kerja_sama', TRUE);

        header('Content-Type: application/json');
        // ambil data dari model Kerja_sama_model
        $list = $this->Kerja_sama_model->get_datatables($jenis_kerjasama, $tahun_kerja_sama);
        $data = array();
        $no = $this->input->post('start');

        $date_now = date("Y-m-d"); // this format is string comparable

        //looping data mahasiswa
        foreach ($list as $kerja_sama) {
            $btn_peringatan = '';
            $akhir_kerjasama = $kerja_sama->akhir_kerjasama;
            // cek jenis kerja sama
            if ($kerja_sama->jenis_kerjasama == "MOA") {
                // peringatan 3 bulan
                $tanggal_dikurangi = new DateTime($akhir_kerjasama);
                $tanggal_dikurangi->sub(new DateInterval('P3M')); // 3 bulan
                if ($date_now < format_tgl_Ymd($tanggal_dikurangi)) {
                    $btn_peringatan =  '<button type="button" class="btn btn-success btn-sm">' . format_tgl_dMY($kerja_sama->akhir_kerjasama) . '</button>';
                } else {
                    $btn_peringatan =  '<button type="button" class="btn btn-danger btn-sm berkedip">' . format_tgl_dMY($kerja_sama->akhir_kerjasama) . '</button>';
                }
            } else {
                // peringatan 6 bulan
                $tanggal_dikurangi = new DateTime($akhir_kerjasama);
                $tanggal_dikurangi->sub(new DateInterval('P6M'));  // 6 bulan
                if ($date_now < format_tgl_Ymd($tanggal_dikurangi)) {
                    $btn_peringatan =  '<button type="button" class="btn btn-success btn-sm">' . format_tgl_dMY($kerja_sama->akhir_kerjasama) . '</button>';
                } else {
                    $btn_peringatan =  '<button type="button" class="btn btn-danger btn-sm berkedip">' . format_tgl_dMY($kerja_sama->akhir_kerjasama) . '</button>';
                }
            }

            $no++;
            $row = array();

            //row pertama akan kita gunakan untuk btn edit dan delete
            $row[] = $no;
            $row[] =  '<a class="btn btn-info btn-sm" onclick="btn_detail(' . "'" . $kerja_sama->id_kerjasama . "'" . ')"><i class="fa fa-eye"></i> </a>
                        <a class="btn btn-warning btn-sm" onclick="btn_edit(' . "'" . $kerja_sama->id_kerjasama . "'" . ')"><i class="fa fa-edit"></i> </a>
                        <a class="btn btn-danger btn-sm" onclick="btn_delete(' . "'" . $kerja_sama->id_kerjasama . "'" . ')"><i class="fa fa-trash"></i> </a>';
            $row[] = $kerja_sama->jenis_kerjasama;
            $row[] = $kerja_sama->lembaga_mitra;
            $row[] = $kerja_sama->alamat_mitra;
            $row[] = $kerja_sama->nama_negara;
            $row[] = $kerja_sama->durasi_kerjasama . " Tahun";
            $row[] = format_tgl_dMY($kerja_sama->tgl_kerjasama);
            $row[] = $btn_peringatan;
            $row[] = '<a href="' . base_url('kerjasama/assets/file_dok/' . $kerja_sama->dokumen_kerjasama) . '" class="btn btn-default btn-sm" download ><i class="fa fa-cloud-download"></i> Download</a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Kerja_sama_model->count_all(),
            "recordsFiltered" => $this->Kerja_sama_model->count_filtered($jenis_kerjasama, $tahun_kerja_sama),
            "data" => $data,
        );
        //output to json format
        $this->output->set_output(json_encode($output));
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
