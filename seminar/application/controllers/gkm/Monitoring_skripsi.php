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
			if(strcmp($_SESSION["status_login"], 'GKM Prodi')!==0 ){
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

		$kode_prodi = $_SESSION['kode_prodi'];
		if(isset($_SESSION['kode_prodi']) ){
			$x['pencarian_data'] = $this->m_monitoring_skripsi->show_monitoring_sk_prodi($_SESSION['kode_prodi']);

		}
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('gkm/monitoring_skripsi', $x);
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
        
        $html = $this->load->view('gkm/cetak_sk_pembimbing_skripsi',$this->data, true);

        
        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
        unlink("templates/img/qrcode/qrcode".$id_skripsi.".png");
        
    }
}
?>