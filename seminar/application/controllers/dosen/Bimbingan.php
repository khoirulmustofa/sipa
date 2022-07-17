<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bimbingan extends CI_Controller {
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
		$this->load->model('m_bimbingan');
		$this->load->model('m_monitoring_sk');
		$this->load->library('ciqrcode');
		$this->load->library('pdfgenerator');
	}

	public function index()
	{
		$x['pencarian_data'] 	= $this->m_bimbingan->show_sk_mahasiswa($_SESSION['npk']);
		$x['pencarian'] 		= $this->m_bimbingan->show_bimbingan();
		$x['pencarian_nilai'] 	= $this->m_bimbingan->show_nilai();
		$x['pencarian_nilai_pembimbing_lapangan'] = $this->m_bimbingan->show_nilai_pembimbing_lapangan();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('dosen/bimbingan', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);

	}

	public function tambah_bimbingan(){
		if(isset($_POST['tombolBimbingan'])){
			$id_syarat_sk 				= $_POST['id_syarat_sk'];
			$npm 						= $_POST['npm'];
			$nama_mahasiswa 			= $_POST['nama_mahasiswa'];
			$bimbingan_ke 				= $_POST['bimbingan_ke'];
			$materi_bimbingan 			= $_POST['materi_bimbingan'];
			$hasil_bimbingan 			= $_POST['hasil_bimbingan'];
			$jenis_pertemuan_bimbingan 	= $_POST['jenis_pertemuan_bimbingan'];
			$nama_file_lampiran  		= $_FILES['file_lampiran']['name'];
			if ($nama_file_lampiran=='') {
				$nama_file_full_lampiran = '';
			}else{
				$nama_file_full_lampiran = date('YmdHis').$nama_file_lampiran;
				$folderlampiran = "templates/file/dosen/lampiran_bimbingan/".$nama_file_full_lampiran;
				move_uploaded_file($_FILES['file_lampiran']["tmp_name"], $folderlampiran);
			}
			
			if($this->m_bimbingan->tambah_bimbingan($id_syarat_sk, $bimbingan_ke, $materi_bimbingan, $hasil_bimbingan, $jenis_pertemuan_bimbingan, $nama_mahasiswa, $npm, $nama_file_full_lampiran)){
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data Bimbingan Berhasil diiput..
				</div>');	
				redirect('dosen/bimbingan');
			}else{
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data Bimbingan Gagal diiput..
				</div>');	
				redirect('dosen/bimbingan');
			}
			
		}else{
			redirect('dosen/bimbingan');
		}
	}	

	public function nilai_bimbingan(){
		if(isset($_POST['tombolNilai'])){
			$id_syarat_sk 	= $_POST['id_syarat_sk'];
			$id_nilai 		= $_POST['id_nilai'];
			$sikap 			= $_POST['sikap'];
			$pemahaman 		= $_POST['pemahaman'];
			$kelengkapan 	= $_POST['kelengkapan'];

			if(($sikap >=0 && $sikap <=100) && ($pemahaman >=0 && $pemahaman <=100) && ($kelengkapan >=0 && $kelengkapan <=100)){

				if($this->m_bimbingan->nilai_bimbingan($id_syarat_sk, $sikap, $pemahaman, $kelengkapan)){
					$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Nilai Berhasil diiput..
					</div>');	
					redirect('dosen/bimbingan');
				}else{
					$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Nilai Gagal diiput..
					</div>');	
					redirect('dosen/bimbingan');
				}
			}else{
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Pastikan nilai yang diinputkan sesuai range yang ditentukan..
				</div>');	
				redirect('dosen/bimbingan');
			}
		}else{
			redirect('dosen/bimbingan');
		}
	}

	public function nilai_pembimbing_lapangan(){
		if(isset($_POST['tombolNilaiPembimbingLapangan'])){
			$id_syarat_sk 		= $_POST['id_syarat_sk'];
			$kepribadian 		= $_POST['kepribadian'];
			$kedisiplinan 		= $_POST['kedisiplinan'];
			$motivasi 			= $_POST['motivasi'];
			$tanggung_jawab 	= $_POST['tanggung_jawab'];
			$komitmen 			= $_POST['komitmen'];
			$kerjasama 			= $_POST['kerjasama'];
			$keselamatan_kerja 	= $_POST['keselamatan_kerja'];
			$laporan 			= $_POST['laporan'];

			if($this->m_bimbingan->tambah_nilai_pembimbing_lapangan($id_syarat_sk, $kepribadian, $kedisiplinan, $motivasi, $tanggung_jawab, $komitmen, $kerjasama, $keselamatan_kerja, $laporan)){
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Nilai Berhasil diiput..
				</div>');	
				redirect('dosen/bimbingan');
			}else{
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Nilai Gagal diiput..
				</div>');	
				redirect('dosen/bimbingan');
			}
		}else{
			redirect('dosen/bimbingan');
		}
	}

	function cetak_kartu_bimbingan($id_syarat_sk=null)
	{    
	       // $this->data
		$this->data['id_syarat_sk'] = $id_syarat_sk;

	        // filename dari pdf ketika didownload
		$file_pdf = 'Kartu Bimbingan';
	        // setting paper
		$paper = 'Legal';
	        //orientasi paper potrait / landscape
		$orientation = "portrait";

		$html = $this->load->view('dosen/cetak_kartu_bimbingan',$this->data, true);

	        // run dompdf
		$this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
		unlink("templates/img/qrcode/qrcode".$id_syarat_sk.".png");   
	}
}