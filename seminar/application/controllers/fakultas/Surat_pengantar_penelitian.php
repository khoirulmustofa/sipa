<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_pengantar_penelitian extends CI_Controller {
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
		$this->load->model('m_surat_pengantar_penelitian');
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

		$x['pencarian_data'] = $this->m_surat_pengantar_penelitian->show_surat_pengantar_penelitian_fakultas();
		$x['combobox_prodi'] = $this->m_surat_pengantar_penelitian->combobox_prodi();

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('fakultas/surat_pengantar_penelitian', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);
	}	

	function cetak($id_surat_pengantar_penelitian=null)
	{    
       	// $this->data
		$this->data['id_surat_pengantar_penelitian'] = $id_surat_pengantar_penelitian;

        // filename dari pdf ketika didownload
		$file_pdf = 'Permohonan Pengantar Penelitan';
        // setting paper

		$paper = 'A4';
        //orientasi paper potrait / landscape
		$orientation = "portrait";

		$html = $this->load->view('fakultas/cetak_surat_pengantar_penelitian',$this->data, true);

        // run dompdf
		$this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
		unlink("templates/img/qrcode/qrcode".$id_surat_pengantar_penelitian.".png");

	}

	function tandatangandekan(){
		$id_surat_pengantar_penelitian = addslashes($this->input->post('id_surat_pengantar_penelitian'));
		$nama_instansi = addslashes($this->input->post('nama_instansi'));
		$alamat_instansi = addslashes($this->input->post('alamat_instansi'));
		$npm = addslashes($this->input->post('npm'));
		$judul_penelitian = addslashes($this->input->post('judul_penelitian'));
		$matakuliah = addslashes($this->input->post('matakuliah'));
		$nama_mahasiswa = addslashes($this->input->post('nama_mahasiswa'));
		$tgl_upload_surat_pengantar_penelitian = addslashes($this->input->post('tgl_upload_surat_pengantar_penelitian'));

		// $id_surat_pengantar_penelitian 		= $_POST['id_surat_pengantar_penelitian'];
		// $nama_instansi 				= $_POST['nama_instansi'];
		// $alamat_instansi 			= $_POST['alamat_instansi'];
		// $npm 						= $_POST['npm'];
		// $judul_penelitian 			= $_POST['judul_penelitian'];
		// $matakuliah 				= $_POST['matakuliah'];
		// $nama_mahasiswa 			= $_POST['nama_mahasiswa'];
		// $tgl_upload_surat_pengantar_penelitian = $_POST['tgl_upload_surat_pengantar_penelitian'];
    	// echo $id_surat_pengantar_penelitian; die();


		if ($this->m_surat_pengantar_penelitian->input_nomor_surat($id_surat_pengantar_penelitian, $nama_instansi, $alamat_instansi, $npm, $nama_mahasiswa, $judul_penelitian, $matakuliah, $tgl_upload_surat_pengantar_penelitian)) {
			$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Surat Pengantar Permohonan Penelitan berhasil ditanda tangan..
			</div>');
			redirect('fakultas/surat_pengantar_penelitian');
		}
		else{
			$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Surat Pengantar Permohonan Penelitan gagal ditanda tangan..
			</div>');
			redirect('fakultas/surat_pengantar_penelitian');
		}
	}
}