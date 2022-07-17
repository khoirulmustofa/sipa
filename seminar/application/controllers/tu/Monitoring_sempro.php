<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring_sempro extends CI_Controller {
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
		$this->load->model('m_monitoring_sempro');
		$this->load->library('ciqrcode');
		$this->load->library('pdfgenerator');
	}

	public function index()
	{
		$x['pencarian_data'] = $this->m_monitoring_sempro->show_data_sempro();		
		$x['combobox_prodi'] = $this->m_monitoring_sempro->combobox_prodi();

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('tu/monitoring_sempro', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);
	}

	public function persetujuan(){
		if(isset($_POST['tombolTolak'])){
			date_default_timezone_set('Asia/Jakarta');			
			$id_syarat_sempro 	= addslashes($this->input->post('id_syarat_sempro'));
			$pelaku 			= $_SESSION['nama'];
			$jabatan 			= 'Staff Tata Usaha Teknik';
			$status_persetujuan	= 'Berkas Ditolak';
			$tema_persetujuan	= 'Pengecekan Berkas Persyaratan Sempro Mahasiswa oleh Tata Usaha';
			$alasan_ditolak 	= $this->input->post('alasan_ditolak');
			$alasan = implode(", ", $alasan_ditolak); 
			if($this->m_monitoring_sempro->persetujuan($id_syarat_sempro, $pelaku, $jabatan, $status_persetujuan, $tema_persetujuan, $alasan))
			{
		    	// Data Berhasil diinput
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data Berhasil Ditolak..
				</div>');
				redirect('tu/monitoring_sempro');
			}
			else{
				redirect('tu/monitoring_sempro');
			}
		}elseif(isset($_POST['tombolSetuju'])){
			date_default_timezone_set('Asia/Jakarta');			
			$id_syarat_sempro 	= addslashes($this->input->post('id_syarat_sempro'));
			$pelaku 			= $_SESSION['nama'];
			$jabatan 			= 'Staff Tata Usaha Teknik';
			$status_persetujuan	= 'Berkas Disetujui';
			$tema_persetujuan	= 'Pengecekan Berkas Persyaratan Sempro Mahasiswa oleh Tata Usaha';
			$alasan_ditolak 	= ''; 
			if($this->m_monitoring_sempro->persetujuan($id_syarat_sempro, $pelaku, $jabatan, $status_persetujuan, $tema_persetujuan, $alasan)){
	    		// Data Berhasil diinput
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data Berhasil disetujui..
				</div>');
				redirect('tu/monitoring_sempro');
			}
			else{
				redirect('tu/monitoring_sempro');
			}
		}
		else{
			redirect('tu/monitoring_skripsi');
		}
	}

	public function open_file()
	{
		$id_syarat_sempro 	= $_POST['id_syarat_sempro'];
		$pelaku 			= $_SESSION['nama'];
		$jabatan 			= 'Staff Tata Usaha Teknik';
		$file_open 			= $_POST['file_open'];
		$this->m_monitoring_sempro->open_file($id_syarat_sempro, $pelaku, $jabatan, $file_open);
	}

	public function setuju_berkas(){
		$id_syarat_sempro 	= $_POST['id_syarat_sempro'];
		$pelaku 			= $_SESSION['nama'];
		$jabatan 			= 'Staff Tata Usaha Teknik';
		$tema_persetujuan	= $_POST['tema_persetujuan'];
		$alasan_ditolak 	= ''; 
		$status_persetujuan = $_POST['status_persetujuan'];
		$this->m_monitoring_sempro->setuju_berkas($id_syarat_sempro, $pelaku, $jabatan, $tema_persetujuan, $alasan_ditolak, $status_persetujuan);
	}

	public function tolak_berkas(){
		$id_syarat_sempro 	= $_POST['id'];
		$alasan_ditolak 	= $_POST['als'];
		$pelaku 			= $_SESSION['nama'];
		$jabatan 			= 'Staff Tata Usaha Teknik';
		$tema_persetujuan	= $_POST['tema'];
		$status_persetujuan = 'Berkas Ditolak';
		$this->m_monitoring_sempro->setuju_berkas($id_syarat_sempro, $pelaku, $jabatan, $tema_persetujuan, $alasan_ditolak, $status_persetujuan);
	}
}