<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct(){
		parent::__construct();
		if((!isset($_SESSION['login_smpu']))){	
			redirect('halaman_tamu');
		}
		$this->load->model('m_dashboard');
	}
	
	public function index()
	{
		if ($_SESSION['status_login']=="Dosen"){
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('dashboard');
			$this->load->view('templates/footer');
		}
		if ($_SESSION['status_login']=="Tata Usaha"){
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('dashboard');
			$this->load->view('templates/footer');
		}

		if ($_SESSION['status_login']=="Mahasiswa"){
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('dashboard');
			$this->load->view('templates/footer');
		}

		if ($_SESSION['status_login']=="Fakultas"){
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('dashboard');
			$this->load->view('templates/footer');
		}

		if ($_SESSION['status_login']=="Prodi"){
		$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('dashboard');
			$this->load->view('templates/footer');
		}

		if ($_SESSION['status_login']=="Koordinator Prodi"){
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('dashboard');
			$this->load->view('templates/footer');
		}

		if ($_SESSION['status_login']=="GKM Prodi"){
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('dashboard');
			$this->load->view('templates/footer');
		}

		if ($_SESSION['status_login']=="UPM"){
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('dashboard');
			$this->load->view('templates/footer');
		}

		if ($_SESSION['status_login']=="Pembimbing Lapangan KP"){
			$this->load->view('templates/header');
			// $this->load->view('templates/sidebar');
			$this->load->view('dashboard');
			$this->load->view('templates/footer');
		}
	}	
}