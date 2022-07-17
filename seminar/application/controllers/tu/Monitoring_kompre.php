<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring_kompre extends CI_Controller {
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
		$this->load->model('m_monitoring_kompre');
		$this->load->library('ciqrcode');
		$this->load->library('pdfgenerator');
	}

	public function index()
	{
		$x['pencarian_data'] = $this->m_monitoring_kompre->show_data_kompre();		
		$x['combobox_prodi'] = $this->m_monitoring_kompre->combobox_prodi();

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('tu/monitoring_kompre', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);
	}

	public function open_file()
	{
		$id_syarat_kompre 	= $_POST['id_syarat_kompre'];
		$pelaku 			= $_SESSION['nama'];
		$jabatan 			= 'Staff Tata Usaha Teknik';
		$file_open 			= $_POST['file_open'];
		$this->m_monitoring_kompre->open_file($id_syarat_kompre, $pelaku, $jabatan, $file_open);
	}

	public function setuju_berkas(){
		$id_syarat_kompre 	= $_POST['id_syarat_kompre'];
		$pelaku 			= $_SESSION['nama'];
		$jabatan 			= 'Staff Tata Usaha Teknik';
		$tema_persetujuan	= $_POST['tema_persetujuan'];
		$alasan_ditolak 	= ''; 
		$status_persetujuan = $_POST['status_persetujuan'];
		$this->m_monitoring_kompre->setuju_berkas($id_syarat_kompre, $pelaku, $jabatan, $tema_persetujuan, $alasan_ditolak, $status_persetujuan);
	}

	public function tolak_berkas(){
		$id_syarat_kompre 	= $_POST['id'];
		$pelaku 			= $_SESSION['nama'];
		$jabatan 			= 'Staff Tata Usaha Teknik';
		$tema_persetujuan	= $_POST['tema'];
		$alasan_ditolak 	= $_POST['als'];
		$status_persetujuan = 'Berkas Ditolak';
		$this->m_monitoring_kompre->setuju_berkas($id_syarat_kompre, $pelaku, $jabatan, $tema_persetujuan, $alasan_ditolak, $status_persetujuan);
	}

	public function persetujuan(){
		if(isset($_POST['tombolTolak'])){
			date_default_timezone_set('Asia/Jakarta');			
			$id_syarat_kompre 	= addslashes($this->input->post('id_syarat_kompre'));
			$pelaku 			= $_SESSION['nama'];
			$jabatan 			= 'Staff Tata Usaha Teknik';
			$status_persetujuan	= 'Berkas Ditolak';
			$tema_persetujuan	= 'Pengecekan Berkas Persyaratan Sidang Skripsi Mahasiswa oleh Tata Usaha';
			$alasan_ditolak 	= $this->input->post('alasan_ditolak');
			$alasan = implode(", ", $alasan_ditolak); 
			if($this->m_monitoring_kompre->persetujuan($id_syarat_kompre, $pelaku, $jabatan, $status_persetujuan, $tema_persetujuan, $alasan))
			{
		    	// Data Berhasil diinput
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data Berhasil Ditolak..
				</div>');
				redirect('tu/monitoring_kompre');
			}
			else{
				redirect('tu/monitoring_kompre');
			}
		}elseif(isset($_POST['tombolSetuju'])){
			date_default_timezone_set('Asia/Jakarta');			
			$id_syarat_kompre 	= addslashes($this->input->post('id_syarat_kompre'));
			$pelaku 			= $_SESSION['nama'];
			$jabatan 			= 'Staff Tata Usaha Teknik';
			$status_persetujuan	= 'Berkas Disetujui';
			$tema_persetujuan	= 'Pengecekan Berkas Persyaratan Sidang Skripsi Mahasiswa oleh Tata Usaha';
			$alasan_ditolak 	= ''; 
			if($this->m_monitoring_kompre->persetujuan($id_syarat_kompre, $pelaku, $jabatan, $status_persetujuan, $tema_persetujuan, $alasan)){
	    		// Data Berhasil diinput
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data Berhasil disetujui..
				</div>');
				redirect('tu/monitoring_kompre');
			}
			else{
				redirect('tu/monitoring_kompre');
			}
		}
		else{
			redirect('tu/monitoring_skripsi');
		}
	}

}
?>