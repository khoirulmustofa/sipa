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
			if(strcmp($_SESSION["status_login"], 'Fakultas')!==0 ){
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
		if(isset($_POST['tombol_cari'])){
			if ($_POST['kode_prodi']=='0') {
				unset($_SESSION['kode_prodi']);
			}else{
			$_SESSION['kode_prodi']   = $_POST['kode_prodi'];				
			}
		}

		$x['pencarian_data'] = $this->m_monitoring_skripsi->show_monitoring_sk_fakultas();		
		$x['combobox_prodi'] = $this->m_monitoring_skripsi->combobox_prodi();
		
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('fakultas/monitoring_skripsi', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);
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
        
        $html = $this->load->view('fakultas/cetak_sk_pembimbing_skripsi',$this->data, true);

        
        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
        unlink("templates/img/qrcode/qrcode".$id_skripsi.".png");
        
    }

    function tandatangandekan(){
    	$id_skripsi 			= $_POST['id_skripsi'];
    	
    	if ($this->m_monitoring_skripsi->input_nomor_surat($id_skripsi)) {
    		$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					SK Skripsi berhasil ditanda tangan..
					</div>');
		    		redirect('fakultas/monitoring_skripsi');
    	}
    	else{
    		$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					SK Skripsi gagal ditanda tangan..
					</div>');
		    		redirect('fakultas/monitoring_skripsi');
    	}
    }
}