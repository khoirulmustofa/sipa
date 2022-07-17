<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dospem_skripsi extends CI_Controller {
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
			$this->load->model('m_dospem_skripsi');
			$this->load->model('m_monitoring_skripsi');
			$this->load->library('ciqrcode');
        	$this->load->library('pdfgenerator');
	}

	public function index()
	{
		$x['pencarian_data'] = $this->m_dospem_skripsi->show_sk_mahasiswa($_SESSION['npk']);

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('dosen/dospem_skripsi', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);

	}

	public function persetujuan (){
		if(isset($_POST['tombolTolak'])){
			date_default_timezone_set('Asia/Jakarta');			
			$id_persetujuan_usulan_pembimbing = addslashes($this->input->post('id_persetujuan_usulan_pembimbing'));
			$id_skripsi 		= $_POST['id_skripsi'];
			$status_persetujuan	= 'Usulan Ditolak';
			$npk 				= $_POST['npk'];
			$alasan_ditolak 	= $this->input->post('alasan_ditolak');
			$alasan 			= implode(", ", $alasan_ditolak); 
			if($this->m_dospem_skripsi->persetujuan_dospem_skripsi($npk, $id_skripsi, $status_persetujuan, $alasan)){
		    		// Data Berhasil diinput
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data Berhasil Ditolak..
				</div>');
				redirect('dosen/dospem_skripsi');
			}
			else{
				redirect('dosen/dospem_skripsi');
			}
		}elseif(isset($_POST['tombolSetuju'])){
			date_default_timezone_set('Asia/Jakarta');			
			$id_persetujuan_usulan_pembimbing = addslashes($this->input->post('id_persetujuan_usulan_pembimbing'));
			$id_skripsi 		= $_POST['id_skripsi'];
			$status_persetujuan	= 'Usulan Disetujui';
			$npk 				= $_POST['npk'];			
			$alasan_ditolak 	= ''; 
			if($this->m_dospem_skripsi->persetujuan_dospem_skripsi($npk, $id_skripsi, $status_persetujuan, $alasan_ditolak)){
	    		// Data Berhasil diinput
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data Berhasil disetujui..
				</div>');
				redirect('dosen/dospem_skripsi');
			}
			else{
				redirect('dosen/dospem_skripsi');
			}
		}
		else{
			redirect('dosen/dospem_skripsi');
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
        
        $html = $this->load->view('dosen/cetak_sk_pembimbing_skripsi',$this->data, true);
        
        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
        unlink("templates/img/qrcode/qrcode".$id_skripsi.".png");
        
    }
}
?>