<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bimbingan_skripsi extends CI_Controller {
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
		$this->load->model('m_bimbingan_skripsi');
		$this->load->model('m_monitoring_skripsi');
		$this->load->library('ciqrcode');
		$this->load->library('pdfgenerator');
	}

	public function index()
	{
		$x['pencarian_data'] 	= $this->m_bimbingan_skripsi->show_sk_mahasiswa($_SESSION['npk']);

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('dosen/bimbingan_skripsi', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);

	}

	public function tambah_bimbingan_skripsi(){
		if(isset($_POST['tombolBimbingan'])){
			$id_skripsi 				= $_POST['id_skripsi'];
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
				$folderlampiran = "templates/file/dosen/lampiran_bimbingan_skripsi/".$nama_file_full_lampiran;
				move_uploaded_file($_FILES['file_lampiran']["tmp_name"], $folderlampiran);
			}
			
			if($this->m_bimbingan_skripsi->tambah_bimbingan($id_skripsi, $bimbingan_ke, $materi_bimbingan, $hasil_bimbingan, $jenis_pertemuan_bimbingan, $nama_mahasiswa, $npm, $nama_file_full_lampiran)){
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data Bimbingan Berhasil diiput..
				</div>');	
				redirect('dosen/bimbingan_skripsi');
			}else{
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data Bimbingan Gagal diiput..
				</div>');	
				redirect('dosen/bimbingan_skripsi');
			}
			
		}else{
			redirect('dosen/bimbingan_skripsi');
		}
	}	

	function cetak_kartu_bimbingan_skripsi($id_skripsi=null)
	{    
	       // $this->data
		$this->data['id_skripsi'] = $id_skripsi;

	        // filename dari pdf ketika didownload
		$file_pdf = 'Kartu Bimbingan';
	        // setting paper
		$paper = 'Legal';
	        //orientasi paper potrait / landscape
		$orientation = "portrait";

		$html = $this->load->view('dosen/cetak_kartu_bimbingan_skripsi',$this->data, true);

	        // run dompdf
		$this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
		unlink("templates/img/qrcode/qrcode".$id_skripsi.".png");   
	}

	function persetujuan_sempro(){
		if(isset($_POST['tombolSetujuSempro'])){
			$id_skripsi = addslashes($this->input->post('id_skripsi'));
			if ($this->m_bimbingan_skripsi->setuju_sempro($id_skripsi)) {
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Mahasiswa telah diperbolehkan mendaftar seminar proposal!
				</div>');
			}else{
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Mahasiswa tidak diperbolehkan mendaftar seminar proposal!
				</div>');
			}				
		}
		redirect('dosen/bimbingan_skripsi');
	}

	function persetujuan_kompre(){
		if(isset($_POST['tombolSetujuKompre'])){
			$id_skripsi = addslashes($this->input->post('id_skripsi'));
			if ($this->m_bimbingan_skripsi->setuju_kompre($id_skripsi)) {
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Mahasiswa telah diperbolehkan mendaftar Sidang Akhir!
				</div>');
			}else{
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Mahasiswa tidak diperbolehkan mendaftar Sidang Akhir!
				</div>');
			}				
		}
		redirect('dosen/bimbingan_skripsi');
	}
}