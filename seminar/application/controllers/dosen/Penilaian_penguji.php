<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian_penguji extends CI_Controller {
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
		$this->load->model('m_penilaian');
		$this->load->model('m_penguji_skripsi');
		$this->load->model('m_monitoring_kompre');
		$this->load->library('ciqrcode');
		$this->load->library('pdfgenerator');
	}

	public function index()
	{
		$x['pencarian_data'] 	= $this->m_penguji_skripsi->show_penilaian($_SESSION['npk']);

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('dosen/penilaian_penguji', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);

	} 

	public function nilai_sempro(){
		if(isset($_POST['tombolNilaiSempro'])){
			$id_syarat_sempro 	= $_POST['id_syarat_sempro'];
			$npk 				= $_POST['npk'];
			$pendahuluan 		= $_POST['pendahuluan'];
			$saran_pendahuluan 	= $_POST['saran_pendahuluan'];
			$tinjauan 			= $_POST['tinjauan'];
			$saran_tinjauan 	= $_POST['saran_tinjauan'];
			$metodologi 		= $_POST['metodologi'];
			$saran_metodologi 	= $_POST['saran_metodologi'];
			$referensi 			= $_POST['referensi'];
			$saran_referensi 	= $_POST['saran_referensi'];
			$sistematika 		= $_POST['sistematika'];
			$saran_sistematika 	= $_POST['saran_sistematika'];
			$presentasi 		= $_POST['presentasi'];
			$saran_presentasi 	= $_POST['saran_presentasi'];
			$posisi 			= $_POST['posisi'];

			if(($pendahuluan >=0 && $pendahuluan <=100) && ($tinjauan >=0 && $tinjauan <=100) && ($metodologi >=0 && $metodologi <=100) && ($referensi >=0 && $referensi <=100) && ($sistematika >=0 && $sistematika <=100) && ($presentasi >=0 && $presentasi <=100)){

				if($this->m_penilaian->nilai_sempro($id_syarat_sempro, $posisi, $npk, $pendahuluan, $saran_pendahuluan, $tinjauan, $saran_tinjauan, $metodologi, $saran_metodologi, $referensi, $saran_referensi, $sistematika, $saran_sistematika, $presentasi, $saran_presentasi )){
					$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Nilai Berhasil diiput..
					</div>');	
					redirect('dosen/penilaian_penguji');
				}else{
					$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Nilai Gagal diiput..
					</div>');	
					redirect('dosen/penilaian_penguji');
				}
			}else{
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Pastikan nilai yang diinputkan sesuai range yang ditentukan..
				</div>');	
				redirect('dosen/penilaian_penguji');
			}
		}else{
			redirect('dosen/penilaian_penguji');
		}
	}

	public function nilai_kompre(){
		if(isset($_POST['tombolNilaiKompre'])){
			$id_syarat_kompre 	= $_POST['id_syarat_kompre'];
			$npk 				= $_POST['npk'];
			$abstrak 			= $_POST['abstrak'];
			$saran_abstrak 		= $_POST['saran_abstrak'];
			$pendahuluan 		= $_POST['pendahuluan'];
			$saran_pendahuluan 	= $_POST['saran_pendahuluan'];
			$tinjauan 			= $_POST['tinjauan'];
			$saran_tinjauan 	= $_POST['saran_tinjauan'];
			$metodologi 		= $_POST['metodologi'];
			$saran_metodologi 	= $_POST['saran_metodologi'];
			$hasil 				= $_POST['hasil'];
			$saran_hasil 		= $_POST['saran_hasil'];
			$kesimpulan 		= $_POST['kesimpulan'];
			$saran_kesimpulan 	= $_POST['saran_kesimpulan'];
			$referensi 			= $_POST['referensi'];
			$saran_referensi 	= $_POST['saran_referensi'];
			$sistematika 		= $_POST['sistematika'];
			$saran_sistematika 	= $_POST['saran_sistematika'];
			$presentasi 		= $_POST['presentasi'];
			$saran_presentasi 	= $_POST['saran_presentasi'];
			$posisi 			= $_POST['posisi'];

		if(($abstrak >=0 && $abstrak <=100) && ($pendahuluan >=0 && $pendahuluan <=100) && ($tinjauan >=0 && $tinjauan <=100) && ($metodologi >=0 && $metodologi <=100) && ($hasil >=0 && $hasil <=100) && ($kesimpulan >=0 && $kesimpulan <=100) && ($referensi >=0 && $referensi <=100) && ($sistematika >=0 && $sistematika <=100) && ($presentasi >=0 && $presentasi <=100)){

				if($this->m_penilaian->nilai_kompre($id_syarat_kompre, $posisi, $npk, $abstrak, $saran_abstrak,	$pendahuluan, $saran_pendahuluan, $tinjauan, $saran_tinjauan, $metodologi, $saran_metodologi, $hasil, $saran_hasil, $kesimpulan, $saran_kesimpulan, $referensi, $saran_referensi, $sistematika, $saran_sistematika, $presentasi, $saran_presentasi )){
					$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Nilai Berhasil diiput..
					</div>');	
					redirect('dosen/penilaian_penguji');
				}else{
					$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Nilai Gagal diiput..
					</div>');	
					redirect('dosen/penilaian_penguji');
				}
			}else{
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Pastikan nilai yang diinputkan sesuai range yang ditentukan..
				</div>');	
				redirect('dosen/penilaian_penguji');
			}
		}else{
			redirect('dosen/penilaian_penguji');
		}
	}

}
?>