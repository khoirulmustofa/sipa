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
			if(strcmp($_SESSION["status_login"], 'Tata Usaha')!==0 ){
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
		if(isset($_POST['tombol_cari'])){
			if ($_POST['kode_prodi']=='0') {
				unset($_SESSION['kode_prodi']);
			}else{
			$_SESSION['kode_prodi']   = $_POST['kode_prodi'];				
			}
		}

		$x['pencarian_data'] = $this->m_monitoring_skripsi->show_monitoring_sk_tu();		
		$x['combobox_prodi'] = $this->m_monitoring_skripsi->combobox_prodi();

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('tu/monitoring_skripsi', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);
	}

	public function open_file()
	{
		$id_skripsi 		= $_POST['id_skripsi'];
		$pelaku 			= $_SESSION['nama'];
		$jabatan 			= 'Staff Tata Usaha Teknik';
		$file_open 			= $_POST['file_open'];
		$this->m_monitoring_skripsi->open_file($id_skripsi, $pelaku, $jabatan, $file_open);
	}

	public function setuju_berkas(){
		$id_skripsi 		= $_POST['id_skripsi'];
		$pelaku 			= $_SESSION['nama'];
		$jabatan 			= 'Staff Tata Usaha Teknik';
		$tema_persetujuan	= $_POST['tema_persetujuan'];
		$alasan_ditolak 	= ''; 
		$status_persetujuan = $_POST['status_persetujuan'];
		$this->m_monitoring_skripsi->setuju_berkas($id_skripsi, $pelaku, $jabatan, $tema_persetujuan, $alasan_ditolak, $status_persetujuan);
	}

	public function tolak_berkas(){
		$id_skripsi 		= $_POST['id'];
		$pelaku 			= $_SESSION['nama'];
		$jabatan 			= 'Staff Tata Usaha Teknik';
		$tema_persetujuan	= $_POST['tema'];
		$alasan_ditolak 	= $_POST['als'];
		$status_persetujuan = 'Berkas Ditolak';
		$this->m_monitoring_skripsi->setuju_berkas($id_skripsi, $pelaku, $jabatan, $tema_persetujuan, $alasan_ditolak, $status_persetujuan);
	}

	public function persetujuan(){
		if(isset($_POST['tombolTolak'])){
			date_default_timezone_set('Asia/Jakarta');			
			$id_skripsi 		= addslashes($this->input->post('id_skripsi'));
			$pelaku 			= $_SESSION['nama'];
			$jabatan 			= 'Staff Tata Usaha Teknik';
			$status_persetujuan	= 'Berkas Ditolak';
			$tema_persetujuan	= 'Pengecekan Berkas Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha';
			$alasan_ditolak 	= $this->input->post('alasan_ditolak');
			$alasan = implode(", ", $alasan_ditolak); 
			if($this->m_monitoring_skripsi->persetujuan($id_skripsi, $pelaku, $jabatan, $status_persetujuan, $tema_persetujuan, $alasan))
			{
		    	// Data Berhasil diinput
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data Berhasil Ditolak..
				</div>');
				redirect('tu/monitoring_skripsi');
			}
			else{
				redirect('tu/monitoring_skripsi');
			}
		}elseif(isset($_POST['tombolSetuju'])){
			date_default_timezone_set('Asia/Jakarta');			
			$id_skripsi 		= addslashes($this->input->post('id_skripsi'));
			$pelaku 			= $_SESSION['nama'];
			$jabatan 			= 'Staff Tata Usaha Teknik';
			$status_persetujuan	= 'Berkas Disetujui';
			$tema_persetujuan	= 'Pengecekan Berkas Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha';
			$alasan_ditolak 	= ''; 
			if($this->m_monitoring_skripsi->persetujuan($id_skripsi, $pelaku, $jabatan, $status_persetujuan, $tema_persetujuan, $alasan)){
	    		// Data Berhasil diinput
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data Berhasil disetujui..
				</div>');
				redirect('tu/monitoring_skripsi');
			}
			else{
				redirect('tu/monitoring_skripsi');
			}
		}
		else{
			redirect('tu/monitoring_skripsi');
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
        
        $html = $this->load->view('tu/cetak_sk_pembimbing_skripsi',$this->data, true);

        
        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
        unlink("templates/img/qrcode/qrcode".$id_skripsi.".png");
        
    }
}
?>