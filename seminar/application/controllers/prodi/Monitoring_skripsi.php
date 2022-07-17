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
			if(strcmp($_SESSION["status_login"], 'Prodi')!==0 ){
				//tidak dibolehkan
				redirect('');
			}else{
				//dibolehkan
			}
		}
		$this->load->model('m_monitoring_skripsi');
		$this->load->model('m_bimbingan_skripsi');
		$this->load->model('m_dospem_skripsi');
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

		$kode_prodi = $_SESSION['kode_prodi'];
		if(isset($_SESSION['kode_prodi']) ){
			$x['pencarian_data'] = $this->m_monitoring_skripsi->show_monitoring_sk_prodi($_SESSION['kode_prodi']);

		}
		// $x['pencarian_data'] = $this->m_monitoring_skripsi->show_monitoring_sk_prodi();
		$x['pencarian_dospem'] 	= $this->m_monitoring_skripsi->combobox_dosen($_SESSION['kode_prodi']);				

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('prodi/monitoring_skripsi',$x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);
	}

	public function persetujuan (){
		// echo $this->input->post('id_usulan_pembimbing'); die();
		if(isset($_POST['tombolTolak'])){
			date_default_timezone_set('Asia/Jakarta');			
			$id_usulan_pembimbing 		= addslashes($this->input->post('id_usulan_pembimbing'));
			$status_persetujuan	= 'Usulan Ditolak';
			$alasan_ditolak 	= $this->input->post('alasan_ditolak');
			$alasan 			= implode(", ", $alasan_ditolak); 
			if($this->m_monitoring_skripsi->persetujuan_usulan_pembimbing($id_usulan_pembimbing, $status_persetujuan, $alasan)){
		    		// Data Berhasil diinput
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data Berhasil Ditolak..
				</div>');
				redirect('prodi/monitoring_skripsi');
			}
			else{
				redirect('prodi/monitoring_skripsi');
			}
		}elseif(isset($_POST['tombolSetuju'])){
			date_default_timezone_set('Asia/Jakarta');			
			$id_usulan_pembimbing 		= addslashes($this->input->post('id_usulan_pembimbing'));
			$status_persetujuan	= 'Usulan Disetujui';
			$alasan_ditolak 	= ''; 
			if($this->m_monitoring_skripsi->persetujuan_usulan_pembimbing($id_usulan_pembimbing, $status_persetujuan, $alasan_ditolak)){
	    		// Data Berhasil diinput
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data Berhasil disetujui..
				</div>');
				redirect('prodi/monitoring_skripsi');
			}
			else{
				redirect('prodi/monitoring_skripsi');
			}
		}
		else{
			redirect('prodi/monitoring_skripsi');
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
		
		$html = $this->load->view('prodi/cetak_sk_pembimbing_skripsi',$this->data, true);

		
        // run dompdf
		$this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
		unlink("templates/img/qrcode/qrcode".$id_skripsi.".png");
		
	}

	function cetak_kartu_bimbingan_skripsi($id_skripsi=null)
	{    
	       // $this->data
		$this->data['id_skripsi'] = $id_skripsi;

	        // filename dari pdf ketika didownload
		$file_pdf = 'Kartu Bimbingan';
	        // setting paper
		$paper = 'Legal';
	        //orientasi paper potrait / landscape
		$orientation = "portrait";

		$html = $this->load->view('prodi/cetak_kartu_bimbingan_skripsi',$this->data, true);

	        // run dompdf
		$this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
		unlink("templates/img/qrcode/qrcode".$id_skripsi.".png");   
	}

	function tandatanganprodi(){
		$id_skripsi 			= $_POST['id_skripsi'];
		
		if ($this->m_monitoring_skripsi->ttd_prodi($id_skripsi)) {
			$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Kartu bimbingan berhasil di Tantatangan..
			</div>');
			redirect('prodi/monitoring_skripsi');
		}
		else{
			$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Kartu bimbingan gagal di Tantatangan..
			</div>');
			redirect('prodi/monitoring_skripsi');
		}
	}

	public function usulan_dospem(){
		if(isset($_POST['tombolPilihPembimbing'])){
			$npk = $_POST['npk12'];
			$id_skripsi = $_POST['id_skripsi'];
			$id_usulan_pembimbing = $_POST['id_usulan_pembimbing'];
			if($this->m_monitoring_skripsi->usulan_dospem($id_skripsi, $npk, $id_usulan_pembimbing)){
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Pembimbing berhasil dipilih ..
				</div>');	
				redirect('prodi/monitoring_skripsi');
			}else{
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Pembimbing gagal dipilih..
				</div>');	
				redirect('prodi/monitoring_skripsi');
			}
		}else{
			redirect('prodi/monitoring_skripsi');
		}
	}
}