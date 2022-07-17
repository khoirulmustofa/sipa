<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai_sempro extends CI_Controller {
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
		
		$x['pencarian_data'] = $this->m_penguji_skripsi->show_data_sempro();		
		$x['pencarian_nilai'] = $this->m_penilaian->show_nilai();

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('prodi/nilai_sempro', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);
	}

}