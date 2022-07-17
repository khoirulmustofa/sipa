<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kompre extends CI_Controller {
	function __construct(){
		parent::__construct();
		//CEK SESSION
		if((!isset($_SESSION['login_smpu']))){
			echo '<script type"text/javascript">';
			echo 'window.location.href="'.str_replace("seminar/", "", base_url()).'"';
			echo '</script>';
		}else{
			if(strcmp($_SESSION["status_login"], 'Tata Usaha')!==0 ){
				//tidak dibolehkan
				redirect('');
			}else{
				//dibolehkan
			}
		}
		$this->load->model('m_kompre');
		$this->load->library('ciqrcode');
		$this->load->library('pdfgenerator');
	}

	public function index()
	{
		
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('tu/kompre');
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);
	}
}