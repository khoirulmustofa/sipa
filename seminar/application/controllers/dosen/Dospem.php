<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dospem extends CI_Controller {
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
			$this->load->model('m_dospem');
			$this->load->model('m_monitoring_sk');
			$this->load->library('ciqrcode');
        	$this->load->library('pdfgenerator');
	}

	public function index()
	{
		$x['pencarian_data'] = $this->m_dospem->show_sk_mahasiswa($_SESSION['npk']);
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('dosen/dospem', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);

	}
	public function persetujuan(){
		if(isset($_POST['tombolTolakDospem'])){
			date_default_timezone_set('Asia/Jakarta');			
			$id_dospem 		= addslashes($this->input->post('id_dospem'));
			$alasan_ditolak 	= addslashes($this->input->post('alasan_ditolak'));
			if($this->m_dospem->persetujuan_tolak($id_dospem, $alasan_ditolak))
		    	{
		    		// Data Berhasil diinput
		    		$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data Berhasil ditolak..
					</div>');
		    		redirect('dosen/dospem');
		    	}
		    	else{
					redirect('dosen/dospem');
				}
		}elseif(isset($_POST['tombolTerimaDospem'])){
			date_default_timezone_set('Asia/Jakarta');			
			$id_dospem 		= addslashes($this->input->post('id_dospem'));
			// echo $id_dospem; die();
			$alasan_ditolak = '';
			if($this->m_dospem->persetujuan_terima($id_dospem, $alasan_ditolak))
		    	{
		    		// Data Berhasil diinput
		    		$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data Berhasil disetujui..
					</div>');
		    		redirect('dosen/dospem');
		    	}
		    	else{
					redirect('dosen/dospem');
				}
		}
		else{
			redirect('dosen/dospem');
		}
	}

	function cetak_sk_pembimbing_kp($id_syarat_sk=null)
    {    

       $this->data['id_syarat_sk'] = $id_syarat_sk;
       // $this->data
        
        // filename dari pdf ketika didownload
        $file_pdf = 'SK Pembimbing KP ';
        // setting paper
        $paper = 'Legal';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        
        $html = $this->load->view('dosen/cetak_sk_pembimbing_kp',$this->data, true);

        
        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
        unlink("templates/img/qrcode/qrcode".$id_syarat_sk.".png");
        
    }
}