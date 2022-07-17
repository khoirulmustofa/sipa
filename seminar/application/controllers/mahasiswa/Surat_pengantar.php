<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_pengantar extends CI_Controller {
	function __construct(){
		parent::__construct();
		//CEK SESSION
		if((!isset($_SESSION['login_smpu']))){
			echo '<script type"text/javascript">';
			echo 'window.location.href="'.str_replace("seminar/", "", base_url()).'"';
			echo '</script>';
		}else{
			if(strcmp($_SESSION["status_login"], 'Mahasiswa')!==0 ){
				//tidak dibolehkan
				redirect('');
			}else{
				//dibolehkan
			}
		}
		$this->load->model('m_surat_pengantar');
		$this->load->library('ciqrcode');
		$this->load->library('pdfgenerator');
	}

	public function index()
	{
		$kode_prodi 				= $_SESSION['kode_prodi'];
		$x['data_surat_pengantar'] 	= $this->m_surat_pengantar->data_surat_pengantar_mhs($kode_prodi);
		$x['row_data'] 				= $this->m_surat_pengantar->row_data($_SESSION['npm']);
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('mahasiswa/surat_pengantar', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);

	}

	public function tambah_surat_pengantar()
	{
		if(isset($_POST['tombolTambahSuratPengantar'])){
			date_default_timezone_set('Asia/Jakarta');
			
			$nama_instansi 				= addslashes($this->input->post('nama_instansi'));
			$judul_kp 					= addslashes($this->input->post('judul_kp'));
			$id_surat_pengantar 		= addslashes($this->input->post('id_surat_pengantar'));
			$alamat_instansi 			= addslashes($this->input->post('alamat_instansi'));
			$ditujukan0 				= addslashes($this->input->post('ditujukan'));
			$ditujukan1					= addslashes($this->input->post('ditujukan1'));
			if ($ditujukan0 == ''){
				$ditujukan = $ditujukan1;
			}else{
				$ditujukan = $ditujukan0 ;
			}

			$lokasi0 					= addslashes($this->input->post('lokasi'));
			$lokasi1					= addslashes($this->input->post('lokasi1'));
			if ($lokasi0 == ''){
				$lokasi = $lokasi1;
			}else{
				$lokasi = $lokasi0 ;
			}
			$waktu_mulai				= addslashes($this->input->post('waktu_mulai'));
			$waktu_selesai 			= addslashes($this->input->post('waktu_selesai'));
			$npm 						= $_SESSION['npm'];
			$nama_file  				= $_FILES['file']['name'];
			$nama_file_full 			= date('YmdHis').$nama_file;

			$nama_file_lampiran  		= $_FILES['filelampiran']['name'];
			if ($nama_file_lampiran=='') {
				$nama_file_full_lampiran = '';
			}else{
				$nama_file_full_lampiran = date('YmdHis').$nama_file_lampiran;
				$folderlampiran = "templates/file/mahasiswa/syarat_sk/surat_pengantar/lampiran/".$nama_file_full_lampiran;
				move_uploaded_file($_FILES['filelampiran']["tmp_name"], $folderlampiran);
			}
			$folder = "templates/file/mahasiswa/syarat_sk/surat_pengantar/".$nama_file_full;
			
			if(move_uploaded_file($_FILES['file']["tmp_name"], $folder))
			{
				
				if($this->m_surat_pengantar->tambah_surat_pengantar($npm, $nama_instansi, $alamat_instansi, $lokasi, $ditujukan, $judul_kp, $waktu_mulai, $waktu_selesai, $nama_file_full, $nama_file_full_lampiran))
				{
		    		// Data Berhasil diinput
					$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Data Berhasil diUpload..
					</div>');
					redirect('mahasiswa/surat_pengantar');
				}
				else{
		    		// Data Gagal diinput
					$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Data Gagal diUpload..
					</div>');
					redirect('mahasiswa/surat_pengantar');
				}

			}
			else{
		    	// File Gagal diinput
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					File Gagal diUpload..
				</div>');
				redirect('mahasiswa/surat_pengantar');
			}

		}else{
			redirect('mahasiswa/surat_pengantar');
		}
	}	

	public function edit_data(){
		if(isset($_POST['tombolSimpan'])){
			date_default_timezone_set('Asia/Jakarta');
			
			$id_syarat_sk 				= addslashes($this->input->post('id_syarat_sk'));
			$nama_tempat_kp 			= addslashes($this->input->post('nama_tempat_kp'));
			$judul_kp 					= addslashes($this->input->post('judul_kp'));
			$nama_pembimbing_lapangan 	= addslashes($this->input->post('nama_pembimbing_lapangan'));
			$no_hp_pembimbing_lapangan	= addslashes($this->input->post('no_hp_pembimbing_lapangan'));
			$waktu_mulai				= addslashes($this->input->post('waktu_mulai'));
			$waktu_selesai 			= addslashes($this->input->post('waktu_selesai'));
			$nama_file_syarat_sk_lama	= addslashes($this->input->post('nama_file_syarat_sk'));
			$nama_file  				= $_FILES['file']['name'];
			$npm 						= $_SESSION['npm'];
			$cek_query 					= 0;

			if(empty($nama_file)){ 
				if ($this->m_surat_pengantar->edit_data_nofile($id_syarat_sk, $npm, $nama_tempat_kp, $judul_kp, $nama_pembimbing_lapangan, $no_hp_pembimbing_lapangan, $waktu_mulai, $waktu_selesai)
					) {
					$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Data anda berhasil diedit!
					</div>');
				$cek_query = 1;
				
			} else{
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data anda gagal diedit!
				</div>');
			}

		} else{

			$nama_file_full = date('YmdHis').$nama_file;
			$folder 		= "templates/file/mahasiswa/syarat_sk/sk/".$nama_file_full;
			if(move_uploaded_file($_FILES['file']["tmp_name"], $folder))
			{
				if($this->m_surat_pengantar->edit_data($id_syarat_sk, $npm, $nama_tempat_kp, $judul_kp, $nama_pembimbing_lapangan, $no_hp_pembimbing_lapangan, $waktu_mulai, $waktu_selesai, $nama_file_full))
				{
				    		// Data Berhasil diinput
					unlink('templates/file/mahasiswa/syarat_sk/sk/'.$nama_file_syarat_sk_lama);
					$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						File Berhasil diUpload..
					</div>');
					$cek_query = 1;	
				}
				else{
							// Jika file gagal diupload, Lakukan :
					$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Maaf, File gagal untuk diupload!
					</div>');
				}
			}
		}
		if ($cek_query==1) {
			$this->m_surat_pengantar->hapus_respon_tu($id_syarat_sk);
		}
	}
	redirect('mahasiswa/sk');
}

function hapus_surat_pengantar(){
	if(isset($_POST['tombolHapus'])){
		$id_surat_pengantar = addslashes($this->input->post('id_surat_pengantar'));
		if ($this->m_surat_pengantar->hapus_surat_pengantar($id_surat_pengantar)) {
			$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Data berhasil dihapus!
			</div>');
		}else{
			$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Data gagal dihapus!
			</div>');
		}				
	}
	redirect('mahasiswa/surat_pengantar');
}

function cetak($id_surat_pengantar=null)
{    
       // $this->data
	$this->data['id_surat_pengantar'] = $id_surat_pengantar;

        // filename dari pdf ketika didownload
	$file_pdf = 'Surat Pengantar Instansi KP';
        // setting paper
	$paper = 'Legal';
        //orientasi paper potrait / landscape
	$orientation = "portrait";

	$html = $this->load->view('mahasiswa/cetak_surat_pengantar',$this->data, true);

        // run dompdf
	$this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
	unlink("templates/img/qrcode/qrcode".$id_surat_pengantar.".png");   
}

function tandatangandekan(){
	$id_surat_pengantar 		= $_POST['id_surat_pengantar'];
	$nama_instansi 				= $_POST['nama_instansi'];
	$alamat_instansi 			= $_POST['alamat_instansi'];
	$npm 						= $_POST['npm'];
	$nama_mahasiswa 			= $_POST['nama_mahasiswa'];
	$waktu_mulai 			= $_POST['waktu_mulai'];
	$waktu_selesai 			= $_POST['waktu_selesai'];
	$tgl_upload_surat_pengantar = $_POST['tgl_upload_surat_pengantar'];

	if ($this->m_surat_pengantar->input_nomor_surat($id_surat_pengantar, $nama_instansi, $alamat_instansi, $npm, $nama_mahasiswa, $waktu_mulai, $waktu_selesai, $tgl_upload_surat_pengantar)) {
		$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			Surat Pengantar Instansi KP berhasil ditanda tangan..
		</div>');
		redirect('fakultas/surat_pengantar');
	}
	else{
		$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			Surat Pengantar Instansi KP  gagal ditanda tangan..
		</div>');
		redirect('fakultas/surat_pengantar');
	}
}
}