<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring_skripsi extends CI_Controller {
	function __construct(){
		parent::__construct();
		//CEK SESSION
		if((!isset($_SESSION['login_smpu']))){
			echo '<script type"text/javascript">';
			echo 'window.location.href="'.str_replace("seminar/", "", base_url()).'"';
			echo '</script>';
		}else{
			if(strcmp($_SESSION["status_login"], 'Koordinator Prodi')!==0 ){
				//tidak dibolehkan
				redirect('');
			}else{
				//dibolehkan
			}
		}
		$this->load->model('m_monitoring_skripsi');
		$this->load->library('ciqrcode');
		$this->load->library('pdfgenerator');
	}

	public function index()
	{
		$kode_prodi = $_SESSION['kode_prodi'];
		if(isset($_SESSION['kode_prodi']) ){
			$x['pencarian_data'] = $this->m_monitoring_skripsi->show_monitoring_sk_koordinator($_SESSION['kode_prodi']);
		}

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('koordinator/monitoring_skripsi',$x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);
	}

	public function persetujuan (){
		if(isset($_POST['tombolTolak'])){
			date_default_timezone_set('Asia/Jakarta');			
			$id_usulan_pembimbing 		= addslashes($this->input->post('id_usulan_pembimbing'));
			$status_persetujuan	= 'Usulan Ditolak';
			$npk = $_POST['npk'];
			$alasan_ditolak 	= $this->input->post('alasan_ditolak');
			$alasan 			= implode(", ", $alasan_ditolak); 
			if($this->m_monitoring_skripsi->persetujuan_koordinator($npk, $id_usulan_pembimbing, $status_persetujuan, $alasan)){
		    		// Data Berhasil diinput
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data Berhasil Ditolak..
				</div>');
				redirect('koordinator/monitoring_skripsi');
			}
			else{
				redirect('koordinator/monitoring_skripsi');
			}
		}elseif(isset($_POST['tombolSetuju'])){
			date_default_timezone_set('Asia/Jakarta');			
			$id_usulan_pembimbing 		= addslashes($this->input->post('id_usulan_pembimbing'));
			$status_persetujuan	= 'Usulan Disetujui';
			$npk = $_POST['npk'];			
			$alasan_ditolak 	= ''; 
			if($this->m_monitoring_skripsi->persetujuan_koordinator($npk, $id_usulan_pembimbing, $status_persetujuan, $alasan_ditolak)){
	    		// Data Berhasil diinput
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data Berhasil disetujui..
				</div>');
				redirect('koordinator/monitoring_skripsi');
			}
			else{
				redirect('koordinator/monitoring_skripsi');
			}
		}
		else{
			redirect('koordinator/monitoring_skripsi');
		}
	}

	function cetak_sk_pembimbing_skripsi($id_skripsi=null)
    {    

       $this->data['id_skripsi'] = $id_skripsi;
       // $this->data
        
        // filename dari pdf ketika didownload
        $file_pdf = 'SK Pembimbing Skripsi ';
        // setting paper
        $paper = 'Legal';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        
        $html = $this->load->view('koordinator/cetak_sk_pembimbing_skripsi',$this->data, true);

        
        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
        unlink("templates/img/qrcode/qrcode".$id_skripsi.".png");
        
    }
}