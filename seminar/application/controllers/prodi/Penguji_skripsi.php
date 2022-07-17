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
			if(strcmp($_SESSION["status_login"], 'Prodi')!==0 ){
				//tidak dibolehkan
				redirect('');
			}else{
				//dibolehkan
			}
		}
		$this->load->model('m_penguji_skripsi');
		$this->load->model('m_monitoring_skripsi');
		$this->load->model('m_penilaian');
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
		
		$x['pencarian_data'] = $this->m_penguji_skripsi->show_data_sempro();		
		$x['pencarian_nilai'] = $this->m_penilaian->show_nilai();

		// $x['pencarian_data'] = $this->m_penguji_skripsi->show_pilihan_penguji();
		$x['pencarian_dospem'] 	= $this->m_penguji_skripsi->combobox_dosen($_SESSION['kode_prodi']);				

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('prodi/penguji_skripsi', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);
	}

	public function penguji(){
		if(isset($_POST['tombolPilihPenguji'])){
			$npk = $_POST['npk'];
			$id_syarat_sempro = $_POST['id_syarat_sempro'];
			$posisi = $_POST['posisi'];
			if($this->m_penguji_skripsi->simpan_penguji($id_syarat_sempro, $posisi, $npk)){
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Penguji berhasil dipilih ..
				</div>');	
				redirect('prodi/penguji_skripsi');
			}else{
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Penguji gagal dipilih..
				</div>');	
				redirect('prodi/penguji_skripsi');
			}
		}else{
			redirect('prodi/penguji_skripsi');
		}
	}

	function cetak_sk_penguji_skripsi($id_syarat_sempro=null)
	{    

		$this->data['id_syarat_sempro'] = $id_syarat_sempro;
       // $this->data
		
        // filename dari pdf ketika didownload
		$file_pdf = 'SK Penguji Skripsi ';
        // setting paper
		$paper = 'Legal';
        //orientasi paper potrait / landscape
		$orientation = "portrait";
		
		$html = $this->load->view('prodi/cetak_sk_penguji_skripsi',$this->data, true);

		
        // run dompdf
		$this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
		unlink("templates/img/qrcode/qrcode".$id_syarat_sempro.".png");
		
	}
}