<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_pengantar_penelitian extends CI_Controller {
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

		$this->load->model('m_surat_pengantar_penelitian');
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

		$x['data_surat_pengantar_penelitian'] = $this->m_surat_pengantar_penelitian->data_surat_pengantar_penelitian();
		$x['combobox_prodi'] 		= $this->m_surat_pengantar_penelitian->combobox_prodi();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('tu/surat_pengantar_penelitian', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);
	}

	public function persetujuan (){
		if(isset($_POST['tombolTolak'])){
			date_default_timezone_set('Asia/Jakarta');			
			$id_surat_pengantar_penelitian = addslashes($this->input->post('id_surat_pengantar_penelitian'));
			$status_persetujuan	= 'Berkas Ditolak';
			$pelaku 			= $_SESSION['nama'];
			$jabatan 			= 'Staff Tata Usaha Teknik';
			$alasan_ditolak 	= $this->input->post('alasan_ditolak');
			$alasan 			= implode(", ", $alasan_ditolak); 
			if($this->m_surat_pengantar_penelitian->persetujuanTu($id_surat_pengantar_penelitian, $pelaku, $jabatan, $status_persetujuan, $alasan)){
		    		// Data Berhasil diinput
		    		$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Data Berhasil Ditolak..
					</div>');
		    		redirect('tu/surat_pengantar_penelitian');
		    	}
		    	else{
					redirect('tu/surat_pengantar_penelitian');
				}
		}elseif(isset($_POST['tombolSetuju'])){
			date_default_timezone_set('Asia/Jakarta');			
			$id_surat_pengantar_penelitian = addslashes($this->input->post('id_surat_pengantar_penelitian'));
			$status_persetujuan	= 'Berkas Disetujui';
			$pelaku 			= $_SESSION['nama'];
			$jabatan 			= 'Staff Tata Usaha Teknik';
			$alasan_ditolak 	= ''; 
			if($this->m_surat_pengantar_penelitian->persetujuanTu($id_surat_pengantar_penelitian, $pelaku, $jabatan, $status_persetujuan, $alasan_ditolak)){
	    		// Data Berhasil diinput
	    		$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Data Berhasil disetujui..
				</div>');
	    		redirect('tu/surat_pengantar_penelitian');
	    	}
	    	else{
				redirect('tu/surat_pengantar_penelitian');
			}
		}
		else{
			redirect('tu/surat_pengantar_penelitian');
		}
	}

	function cetak($id_surat_pengantar_penelitian=null)
    {    
       // $this->data
       $this->data['id_surat_pengantar_penelitian'] = $id_surat_pengantar_penelitian;
        
        // filename dari pdf ketika didownload
        $file_pdf = 'Surat Pengantar Penelitian';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        
        $html = $this->load->view('tu/cetak_surat_pengantar_penelitian',$this->data, true);
        
        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
        unlink("templates/img/qrcode/qrcode".$id_surat_pengantar_penelitian.".png");   
    }
}