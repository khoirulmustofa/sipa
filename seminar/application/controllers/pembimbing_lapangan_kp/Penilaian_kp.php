<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian_kp extends CI_Controller {
	function __construct(){
		parent::__construct();
		//CEK SESSION
		// if((!isset($_SESSION['login_smpu']))){
		// 	echo '<script type"text/javascript">';
		// 	echo 'window.location.href="'.str_replace("seminar/", "", base_url()).'"';
		// 	echo '</script>';
		// }else{
		// 	if(strcmp($_SESSION["status_login"], 'Pembimbing Lapangan KP')!==0 ){
		// 		//tidak dibolehkan
		// 		redirect('');
		// 	}else{
		// 		//dibolehkan
		// 	}
		// }
		$this->load->model('m_pembimbing_lapangan');
		$this->load->library('ciqrcode');
		$this->load->library('pdfgenerator');
	}

	public function index()
	{

		$this->load->view('templates/header');
		$this->load->view('pembimbing_lapangan_kp/penilaian_kp');
		unset($_SESSION['messege']);

	}

	public function nilai_pembimbing_lapangan(){
		if(isset($_POST['tombolNilaiPembimbingLapangan'])){
			$id_syarat_sk	= $_SESSION['id_syarat_sk'];
			$kepribadian 	= $_POST['kepribadian'];
			$kedisiplinan 	= $_POST['kedisiplinan'];
			$motivasi 		= $_POST['motivasi'];
			$tanggung_jawab = $_POST['tanggung_jawab'];
			$komitmen 		= $_POST['komitmen'];
			$kerjasama 		= $_POST['kerjasama'];
			$keselamatan 	= $_POST['keselamatan'];
			$laporan 		= $_POST['laporan'];

			if(($kepribadian 		>=0 && $kepribadian 	<=100) && 
				($kedisiplinan 		>=0 && $kedisiplinan 	<=100) && 
				($motivasi 			>=0 && $motivasi 		<=100) && 
				($tanggung_jawab 	>=0 && $tanggung_jawab 	<=100) && 
				($komitmen 			>=0 && $komitmen 		<=100) && 
				($kerjasama 		>=0 && $kerjasama 		<=100) && 
				($keselamatan 		>=0 && $keselamatan 	<=100) && 
				($laporan 			>=0 && $laporan 		<=100)){

				if($this->m_pembimbing_lapangan->tambah_nilai_pembimbing_lapangan($id_syarat_sk, $kepribadian, $kedisiplinan, $motivasi, $tanggung_jawab, $komitmen, $kerjasama, $keselamatan, $laporan)){
					$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Nilai Berhasil diiput..
					</div>');	
					redirect('pembimbing_lapangan_kp/penilaian_kp');
				}else{
					$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Nilai Gagal diiput..
					</div>');	
					redirect('pembimbing_lapangan_kp/penilaian_kp');
				}
			}else{
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Pastikan nilai yang diinputkan sesuai range yang ditentukan..
				</div>');	
				redirect('pembimbing_lapangan_kp/penilaian_kp');
			}
		}else{
			redirect('pembimbing_lapangan_kp/penilaian_kp');
		}
	}
}