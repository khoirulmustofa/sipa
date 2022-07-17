<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_pengantar extends CI_Controller {
	function __construct(){
		parent::__construct();
		//CEK SESSION
		if((!isset($_SESSION['login_smpu']))){
			echo '<script type"text/javascript">';
		    echo 'window.location.href="'.str_replace("seminar/", "", base_url()).'"';
		    echo '</script>';
		}else{
			if(strcmp($_SESSION["status_login"], 'Fakultas')!==0 ){
				//tidak dibolehkan
				redirect('');
			}else{
				//dibolehkan
			}
		}
		$this->load->model('m_surat_pengantar');
		$this->load->library('ciqrcode');
        $this->load->library('pdfgenerator');
	}

	public function index()
	{
		if(isset($_POST['tombol_cari'])){
			if ($_POST['kode_prodi']=='0') {
				unset($_SESSION['kode_prodi']);
			}else{
			$_SESSION['kode_prodi']   = $_POST['kode_prodi'];				
			}
		}

		$x['pencarian_data'] = $this->m_surat_pengantar->show_surat_pengantar_fakultas();
		// $x['pencarian_data'] = $this->m_surat_pengantar->show_surat_pengantar_fakultas($pelaku);
		$x['combobox_prodi'] = $this->m_surat_pengantar->combobox_prodi();

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('fakultas/surat_pengantar', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);
	}	

	function cetak($id_surat_pengantar=null)
	{    
       	// $this->data
		$this->data['id_surat_pengantar'] = $id_surat_pengantar;

        // filename dari pdf ketika didownload
		$file_pdf = 'Surat Pengantar Instansi KP';
        // setting paper

		$paper = 'Legal';
        //orientasi paper potrait / landscape
		$orientation = "portrait";

		$html = $this->load->view('fakultas/cetak_surat_pengantar',$this->data, true);

        // run dompdf
		$this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
		unlink("templates/img/qrcode/qrcode".$id_surat_pengantar.".png");

	}

    function tandatangandekan(){
    	$id_surat_pengantar = addslashes($this->input->post('id_surat_pengantar'));
    	$nama_instansi 		= addslashes($this->input->post('nama_instansi'));
    	$alamat_instansi 	= addslashes($this->input->post('alamat_instansi'));
    	$npm 				= addslashes($this->input->post('npm'));
    	$nama_mahasiswa 	= addslashes($this->input->post('nama_mahasiswa'));
    	$waktu_mulai 	= addslashes($this->input->post('waktu_mulai'));
    	$waktu_selesai 	= addslashes($this->input->post('waktu_selesai'));
    	$tgl_upload_surat_pengantar = addslashes($this->input->post('tgl_upload_surat_pengantar'));

    	// $id_surat_pengantar 		= $_POST['id_surat_pengantar'];
    	// $nama_instansi 				= $_POST['nama_instansi'];
    	// $alamat_instansi 			= $_POST['alamat_instansi'];
    	// $npm 						= $_POST['npm'];
    	// $nama_mahasiswa 			= $_POST['nama_mahasiswa'];
    	// $waktu_mulai 			= $_POST['waktu_mulai'];
    	// $waktu_selesai 			= $_POST['waktu_selesai'];
    	// $tgl_upload_surat_pengantar = $_POST['tgl_upload_surat_pengantar'];

    	if ($this->m_surat_pengantar->input_nomor_surat($id_surat_pengantar, $nama_instansi, $alamat_instansi, $npm, $nama_mahasiswa, $waktu_mulai, $waktu_selesai, $tgl_upload_surat_pengantar)) {
    		$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Surat Pengantar Instansi KP berhasil ditanda tangan..
					</div>');
		    		redirect('fakultas/surat_pengantar');
    	}
    	else{
    		$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Surat Pengantar Instansi KP  gagal ditanda tangan..
					</div>');
		    		redirect('fakultas/surat_pengantar');
    	}
    }
}