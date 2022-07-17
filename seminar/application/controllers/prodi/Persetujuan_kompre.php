<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Persetujuan_kompre extends CI_Controller {
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
		$this->load->model('m_monitoring_kompre');
		$this->load->library('ciqrcode');
		$this->load->library('pdfgenerator');
	}

	public function index()
	{
		$kode_prodi = $_SESSION['kode_prodi'];
		if(isset($_SESSION['kode_prodi']) ){
			$x['pencarian_data'] = $this->m_monitoring_kompre->show_persetujuan($_SESSION['kode_prodi']);
		}
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('prodi/persetujuan_kompre', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);
	}

	public function persetujuan (){
		if(isset($_POST['tombolTolak'])){
			date_default_timezone_set('Asia/Jakarta');			
			$id_syarat_kompre 		= addslashes($this->input->post('id_syarat_kompre'));
			if($this->m_monitoring_kompre->persetujuan_kompre($id_syarat_kompre)){
		    		// Data Berhasil diinput
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data Berhasil Ditolak..
				</div>');
				redirect('prodi/persetujuan_kompre');
			}
			else{
				redirect('prodi/persetujuan_kompre');
			}
		}elseif(isset($_POST['tombolSetuju'])){
			date_default_timezone_set('Asia/Jakarta');			
			$id_syarat_kompre 		= addslashes($this->input->post('id_syarat_kompre'));
			if($this->m_monitoring_kompre->persetujuan_kompre($id_syarat_kompre)){
	    		// Data Berhasil diinput
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data Berhasil disetujui..
				</div>');
				redirect('prodi/persetujuan_kompre');
			}
			else{
				redirect('prodi/persetujuan_kompre');
			}
		}
		else{
			redirect('prodi/persetujuan_kompre');
		}
	}


}