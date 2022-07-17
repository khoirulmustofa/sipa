<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penguji_skripsi extends CI_Controller {
	function __construct(){
		parent::__construct();
		//CEK SESSION
		if((!isset($_SESSION['login_smpu']))){
			echo '<script type"text/javascript">';
			echo 'window.location.href="'.str_replace("seminar/", "", base_url()).'"';
			echo '</script>';
		}else{
			if(strcmp($_SESSION["status_login"], 'Dosen')!==0 ){
				//tidak dibolehkan
				redirect('');
			}else{
				//dibolehkan
			}
		}
		$this->load->model('m_penguji_skripsi');
		$this->load->model('m_monitoring_skripsi');
		$this->load->library('ciqrcode');
		$this->load->library('pdfgenerator');
	}

	public function index()
	{

		$x['pencarian_data'] = $this->m_penguji_skripsi->show_data_sempro_dosen($_SESSION['npk']);

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('dosen/penguji_skripsi', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);

	}

	public function persetujuan (){
		if(isset($_POST['tombolTolak'])){
			date_default_timezone_set('Asia/Jakarta');			
			$id_penguji_skripsi = $_POST['id_penguji_skripsi'];
			$status_persetujuan	= 'Usulan Ditolak';
			$npk 				= $_POST['npk'];
			$status 				= 'Dihapus';
			$alasan_ditolak 	= addslashes($this->input->post('alasan_ditolak'));
			if($this->m_penguji_skripsi->persetujuan_penguji_skripsi($id_penguji_skripsi, $status_persetujuan, $alasan_ditolak, $status)){
		    		// Data Berhasil diinput
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data Berhasil Ditolak..
				</div>');
				redirect('dosen/penguji_skripsi');
			}
			else{
				redirect('dosen/penguji_skripsi');
			}
		}elseif(isset($_POST['tombolSetuju'])){
			date_default_timezone_set('Asia/Jakarta');			
			$id_penguji_skripsi 	= $_POST['id_penguji_skripsi'];
			$status_persetujuan		= 'Usulan Disetujui';
			$npk 					= $_POST['npk'];			
			$status 					= 'Tersedia';			
			$alasan_ditolak 		= ''; 
			if($this->m_penguji_skripsi->persetujuan_penguji_skripsi($id_penguji_skripsi, $status_persetujuan, $alasan_ditolak, $status)){
	    		// Data Berhasil diinput
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data Berhasil disetujui..
				</div>');
				redirect('dosen/penguji_skripsi');
			}
			else{
				redirect('dosen/penguji_skripsi');
			}
		}
		else{
			redirect('dosen/penguji_skripsi');
		}
	}

	function cetak_sk_penguji_skripsi($id_skripsi=null)
	{    

		$this->data['id_skripsi'] = $id_skripsi;
       // $this->data
		
        // filename dari pdf ketika didownload
		$file_pdf = 'SK Penguji Skripsi ';
        // setting paper
		$paper = 'Legal';
        //orientasi paper potrait / landscape
		$orientation = "portrait";
		
		$html = $this->load->view('dosen/cetak_sk_penguji_skripsi',$this->data, true);

		
        // run dompdf
		$this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
		unlink("templates/img/qrcode/qrcode".$id_skripsi.".png");
		
	}

}
?>