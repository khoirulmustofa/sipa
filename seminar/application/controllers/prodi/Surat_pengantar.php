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
			if(strcmp($_SESSION["status_login"], 'Prodi')!==0 ){
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
		$x['data_surat_pengantar'] = $this->m_surat_pengantar->show_surat_pengantar_prodi($_SESSION['kode_prodi']);		
		
		$x['combobox_prodi'] = $this->m_surat_pengantar->combobox_prodi();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('prodi/surat_pengantar', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);
	}

	public function persetujuan (){
		if(isset($_POST['tombolTolak'])){
			date_default_timezone_set('Asia/Jakarta');			
			$id_surat_pengantar = addslashes($this->input->post('id_surat_pengantar'));
			$status_persetujuan	= 'Berkas Ditolak';
			$pelaku 			= $_SESSION['nama'];
			$jabatan 			= 'Staff Prodi Teknik';
			$alasan_ditolak 	= $this->input->post('alasan_ditolak');
			$alasan 			= implode(", ", $alasan_ditolak); 
			if($this->m_surat_pengantar->persetujuanProdi($id_surat_pengantar, $pelaku, $jabatan, $status_persetujuan, $alasan)){
		    		// Data Berhasil diinput
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data Berhasil Ditolak..
				</div>');
				redirect('prodi/surat_pengantar');
			}
			else{
				redirect('prodi/surat_pengantar');
			}
		}elseif(isset($_POST['tombolSetuju'])){
			date_default_timezone_set('Asia/Jakarta');			
			$id_surat_pengantar = addslashes($this->input->post('id_surat_pengantar'));
			$status_persetujuan	= 'Berkas Disetujui';
			$pelaku 			= $_SESSION['nama'];
			$jabatan 			= 'Staff Prodi Teknik';
			$alasan_ditolak 	= ''; 
			if($this->m_surat_pengantar->persetujuanProdi($id_surat_pengantar, $pelaku, $jabatan, $status_persetujuan, $alasan_ditolak)){
	    		// Data Berhasil diinput
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data Berhasil disetujui..
				</div>');
				redirect('prodi/surat_pengantar');
			}
			else{
				redirect('prodi/surat_pengantar');
			}
		}
		else{
			redirect('prodi/surat_pengantar');
		}
	}

	function cetak($id_surat_pengantar=null)
	{    
		$this->data['id_surat_pengantar'] = $id_surat_pengantar;
		
        // filename dari pdf ketika didownload
		$file_pdf = 'Surat Pengantar Instansi KP';
		
        // setting paper
		$paper = 'Legal';
		
        //orientasi paper potrait / landscape
		$orientation = "portrait";
		
		$html = $this->load->view('prodi/cetak_surat_pengantar',$this->data, true);
		
        // run dompdf
		$this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
		unlink("templates/img/qrcode/qrcode".$id_surat_pengantar.".png");   
	}
}