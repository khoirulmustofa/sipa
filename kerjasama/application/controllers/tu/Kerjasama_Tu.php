<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kerjasama_Tu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //CEK SESSION
        if ((!isset($_SESSION['login_smpu']))) {
            echo '<script type"text/javascript">';
            echo 'window.location.href="' . str_replace("kerjasama/", "", base_url()) . '"';
            echo '</script>';
        } else {
            if (strcmp($_SESSION["status_login"], 'Tata Usaha') !== 0) {
                redirect('');
            } else {
                //dibolehkan
            }
        }


        $this->load->model('m_kerjasama');
    }


    public function index()
    {
        $data['kerjasama'] = $this->m_kerjasama->tampil_data()->result();

        $this->load->view('public/part/menu');
        $this->load->view('public/part/header');
        $this->load->view('tu/v_kerjasama_tu', $data);
        $this->load->view('public/part/footer');
    }

    public function kota($provinsi)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?&province=" . $provinsi,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 21f84155b3b634dd01992c59564facfc"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $kota_kab = json_decode($response, true);
            if ($kota_kab['rajaongkir']['status']['code'] == '200') {
                foreach ($kota_kab['rajaongkir']['results'] as $kt) {
                    echo "<option value = '$kt[city_id]'> $kt[city_name] </option>";
                }
            }
        }
    }


    // public function tambah_kerjasama()
    // {

    //     $config['upload_path'] = './assets/dokumen_kerjasama/';

    //     $this->load->library('upload');
    //     $this->upload->initialize($config);


    //     if (!$this->upload->do_upload('file_dok')) {
    //         echo "text";
    //         $this->upload->display_errors();
    //     } else {
    //         $file_dok = $this->upload->data();
    //         $file_dok = $file_dok['file_name'];
    //         $jenis_kerjasama    = $this->input->post('jenis_kerjasama');
    //         $lembaga_mitra      = $this->input->post('lembaga_mitra');
    //         $alamat_mitra       = $this->input->post('alamat_mitra');
    //         $negara             = $this->input->post('negara');
    //         $provinsi           = $this->input->post('provinsi');
    //         $kota_kab           = $this->input->post('kota_kab');
    //         $tgl_kerjasama      = $this->input->post('tgl_kerjasama');
    //         $durasi_kerjasama   = $this->input->post('durasi_kerjasama');
    //         $akhir_kerjasama    = date('Y-m-d', strtotime('+2 year', strtotime($tgl_kerjasama)));


    //         $data = array(
    //             'jenis_kerjasama'   => $jenis_kerjasama,
    //             'tgl_kerjasama'     => $tgl_kerjasama,
    //             'lembaga_mitra'     => $lembaga_mitra,
    //             'alamat_mitra'      => $alamat_mitra,
    //             'negara'            => $negara,
    //             'provinsi'          => $provinsi,
    //             'kota_kab'          => $kota_kab,
    //             'durasi_kerjasama'  => $durasi_kerjasama,
    //             'akhir_kerjasama'   => $akhir_kerjasama,
    //             'dokumen_kerjasama' => $file_dok
    //         );

    //         $this->m_kerjasama->tambah_aksi_kerjasama($data);
    //         $this->session->set_flashdata('messege', '<div class="alert alert-success alert-dismissible" role="alert">
    //                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    //                                 Data berhasil ditambahkan!
    //                                 </div>');
    //         redirect('tu/kerjasama');
    //     }

    //     //$dokumen_kerjasama = $_FILES['dokumen_kerjasama'];

    //     /* if ($dokumen_kerjasama == '') {
    //     } else {
    //         $config['upload_path'] =  './assets/dokumen_kerjasama/';
    //         // $config['allowed_types'] = 'pdf';

    //         $this->load->library('upload', $config);
    //         if (!$this->upload->do_upload('dokumen_kerjasama')) {
    //             echo "Upload Gagal";
    //             die();
    //         } else {
    //             $dokumen_kerjasama = $this->upload->data('file_name');
    //         }
    //     } */
    // }

    public function tambah_kerjasama()
    {
        $jenis_kerjasama    = $this->input->post('jenis_kerjasama');
        $lembaga_mitra      = $this->input->post('lembaga_mitra');
        $alamat_mitra       = $this->input->post('alamat_mitra');
        $negara             = $this->input->post('negara');
        $provinsi           = $this->input->post('provinsi');
        $kota_kab           = $this->input->post('kota_kab');
        $tgl_kerjasama      = $this->input->post('tgl_kerjasama');
        $durasi_kerjasama   = $this->input->post('durasi_kerjasama');
        $akhir_kerjasama    = date('Y-m-d', strtotime('+2 year', strtotime($tgl_kerjasama)));

        $file_dok['file_name'] = 'pepek-' . date('dmYhis');
        $file_dok['upload_path'] = './assets/file_dok/';
        $file_dok['allowed_types'] = 'pdf|PDF';
        $this->upload->initialize($file_dok);
        $this->upload->do_upload('file_dok');
        $nm_file_dok = $file_dok['file_name'] . $this->upload->data('file_ext');


        $data = array(
            'jenis_kerjasama'   => $jenis_kerjasama,
            'tgl_kerjasama'     => $tgl_kerjasama,
            'lembaga_mitra'     => $lembaga_mitra,
            'alamat_mitra'      => $alamat_mitra,
            'negara'            => $negara,
            'provinsi'          => $provinsi,
            'kota_kab'          => $kota_kab,
            'durasi_kerjasama'  => $durasi_kerjasama,
            'akhir_kerjasama'   => $akhir_kerjasama,
            'dokumen_kerjasama' => $nm_file_dok
        );

        $this->m_kerjasama->tambah_aksi_kerjasama($data);
        $this->session->set_flashdata('messege', '<div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    Data berhasil ditambahkan!
                                    </div>');
        redirect('tu/kerjasama');


        //$dokumen_kerjasama = $_FILES['dokumen_kerjasama'];

        /* if ($dokumen_kerjasama == '') {
        } else {
            $config['upload_path'] =  './assets/dokumen_kerjasama/';
            // $config['allowed_types'] = 'pdf';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('dokumen_kerjasama')) {
                echo "Upload Gagal";
                die();
            } else {
                $dokumen_kerjasama = $this->upload->data('file_name');
            }
        } */
    }


    public function edit_kerjasama()
    {
        $id_kerjasama       = $this->input->post('id_kerjasama');
        $jenis_kerjasama    = $this->input->post('jenis_kerjasama');
        $tgl_kerjasama      = $this->input->post('tgl_kerjasama');
        $lembaga_mitra      = $this->input->post('lembaga_mitra');
        $alamat_mitra       = $this->input->post('alamat_mitra');
        $negara             = $this->input->post('negara');
        $provinsi           = $this->input->post('provinsi');
        $kota_kab           = $this->input->post('kota_kab');
        $durasi_kerjasama   = $this->input->post('durasi_kerjasama');

        $data = array(
            'jenis_kerjasama'   => $jenis_kerjasama,
            'tgl_kerjasama'     => $tgl_kerjasama,
            'lembaga_mitra'     => $lembaga_mitra,
            'alamat_mitra'      => $alamat_mitra,
            'negara'            => $negara,
            'provinsi'          => $provinsi,
            'kota_kab'          => $kota_kab,
            'durasi_kerjasama'  => $durasi_kerjasama
        );

        $where = array(
            'id_kerjasama' => $id_kerjasama
        );

        $this->m_kerjasama->edit_aksi_kerjasama($where, $data);
        $this->session->set_flashdata('messege', '<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								Data berhasil diedit!
								</div>');
        redirect('tu/kerjasama');
    }

    public function hapus_kerjasama()
    {
        $id_kerjasama = $this->input->post('id_kerjasama');
        $where = array(
            'id_kerjasama' => $id_kerjasama
        );
        $this->m_kerjasama->hapus_aksi_kerjasama($where);
        $this->session->set_flashdata('messege', '<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Data berhasil dihapus!
				</div>');
        redirect('tu/kerjasama');
    }
}
