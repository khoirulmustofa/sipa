<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring_sk extends CI_Controller {
	function __construct(){
		parent::__construct();
		//CEK SESSION
		if((!isset($_SESSION['login_smpu']))){
			echo '<script type"text/javascript">';
		    echo 'window.location.href="'.str_replace("seminar/", "", base_url()).'"';
		    echo '</script>';
		}else{
			if(strcmp($_SESSION["status_login"], 'UPM')!==0 ){
					redirect('');
			}else{
				//dibolehkan
			}
		}

		$this->load->model('m_monitoring_sk');
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
		
		$x['pencarian_data'] = $this->m_monitoring_sk->show_monitoring_sk_fakultas();
		$x['combobox_prodi'] = $this->m_monitoring_sk->combobox_prodi();

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('upm/monitoring_sk', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);
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
        
        $html = $this->load->view('tu/cetak_sk_pembimbing_kp',$this->data, true);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
        unlink("templates/img/qrcode/qrcode".$id_syarat_sk.".png");
        
    }
}