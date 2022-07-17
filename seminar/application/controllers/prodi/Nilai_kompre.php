<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai_kompre extends CI_Controller {
	function __construct(){
		parent::__construct();
		//CEK SESSION
		if((!isset($_SESSION['login_smpu']))){
			echo '<script type"text/javascript">';
			echo 'window.location.href="'.str_replace("seminar/", "", base_url()).'"';
			echo '</script>';
		}else{
			if(strcmp($_SESSION["status_login"], 'Prodi')!==0 ){
				//tidak dibolehkan
				redirect('');
			}else{
				//dibolehkan
			}
		}
		$this->load->model('m_penguji_skripsi');
		$this->load->model('m_monitoring_skripsi');
		$this->load->model('m_penilaian');
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
		
		$x['pencarian_data'] = $this->m_penguji_skripsi->show_data_kompre();	
		
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('prodi/nilai_kompre', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);
	}

	function konfirmasi(){
		if(isset($_POST['tombolKonfirmasi'])){
			$id_syarat_kompre = addslashes($this->input->post('id_syarat_kompre'));
			if ($this->m_penilaian->konfirmasi($id_syarat_kompre)) {
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data berhasil dikonfirmasi!
				</div>');
			}else{
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data gagal dikonfirmasi!
				</div>');
			}				
		}
		redirect('prodi/nilai_kompre');
	}

}