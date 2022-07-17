<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skripsi extends CI_Controller {
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
		$this->load->model('m_skripsi');
		$this->load->model('m_monitoring_skripsi');
		$this->load->library('ciqrcode');
		$this->load->library('pdfgenerator');
	}

	public function index()
	{
		$kode_prodi 			= $_SESSION['kode_prodi'];
		$x['row_data'] 			= $this->m_skripsi->row_data($_SESSION['npm']);
		$x['pencarian_dospem'] 	= $this->m_skripsi->combobox_dosen($kode_prodi);				

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('mahasiswa/skripsi', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);

	}

	public function tambah_data_persetujuandosen()
	{
		if(isset($_POST['tombolPersetujuanDosen'])){
			date_default_timezone_set('Asia/Jakarta');
			$npk = $_POST['npk'];
			$id_jenis_sk 		= addslashes($this->input->post('id_jenis_sk'));
			$judul 				= addslashes($this->input->post('judul'));
			$npm 				= $_SESSION['npm'];
			$npk 				= $_SESSION['npk'];
			
			if($this->m_skripsi->tambah_data_persetujuandosen($id_jenis_sk, $npm, $npk, $judul))
			{
		    		// Data Berhasil diinput
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data Berhasil diUpload..
				</div>');
				redirect('mahasiswa/skripsi');
			}
			else{
		    		// Data Gagal diinput
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data Gagal diUpload..
				</div>');
				redirect('mahasiswa/skripsi');
			}
		}else{
			redirect('mahasiswa/skripsi');
		}
	}	

	public function tambah_data_skripsi(){
		if(isset($_POST['tombolPengajuanSK'])){
			date_default_timezone_set('Asia/Jakarta');
			$id_jenis_sk 		= addslashes($this->input->post('id_jenis_sk'));
			$judul 		= addslashes($this->input->post('judul'));
			$npm 				= $_SESSION['npm'];
			// $npk 				= addslashes($this->input->post('npk'));

			$nama_file_spp = $_FILES['file_spp']['name'];
			$nama_file_full_spp = date('YmdHis').$nama_file_spp;
			$folderspp = "templates/file/mahasiswa/syarat_sk/skripsi/spp/".$nama_file_full_spp;
			// move_uploaded_file($_FILES['file_spp']["tmp_name"], $folderspp);	

			$nama_file_transkrip = $_FILES['file_transkrip']['name'];
			$nama_file_full_transkrip = date('YmdHis').$nama_file_transkrip;
			$foldertranskrip = "templates/file/mahasiswa/syarat_sk/skripsi/transkrip/".$nama_file_full_transkrip;
			move_uploaded_file($_FILES['file_transkrip']["tmp_name"], $foldertranskrip);

			$nama_file_krs = $_FILES['file_krs']['name'];
			$nama_file_full_krs = date('YmdHis').$nama_file_krs;
			$folderkrs = "templates/file/mahasiswa/syarat_sk/skripsi/krs/".$nama_file_full_krs;
			move_uploaded_file($_FILES['file_krs']["tmp_name"], $folderkrs);

			$nama_file_laporan = $_FILES['file_laporan']['name'];
			$nama_file_full_laporan = date('YmdHis').$nama_file_laporan;
			$folderlaporan = "templates/file/mahasiswa/syarat_sk/skripsi/laporan/".$nama_file_full_laporan;
			move_uploaded_file($_FILES['file_laporan']["tmp_name"], $folderlaporan);	
			
			if(move_uploaded_file($_FILES['file_spp']["tmp_name"], $folderspp))
			{
				if($this->m_skripsi->tambah_data_skripsi($id_jenis_sk, $npm, $judul, $nama_file_full_spp, $nama_file_full_transkrip, $nama_file_full_krs, $nama_file_full_laporan))
				{
		    		// Data Berhasil diinput
					$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Data Berhasil diUpload..
					</div>');
					redirect('mahasiswa/skripsi');
				}
				else{
		    		// Data Gagal diinput
					$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Data Gagal diUpload..
					</div>');
					redirect('mahasiswa/skripsi');
				}
			}
			else{
		    	// File Gagal diinput
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					File Gagal diUpload..
				</div>');
				redirect('mahasiswa/skripsi');
			}
		}else{
			redirect('mahasiswa/skripsi');
		}
	}

	public function upload_file(){
		if(isset($_POST['tombol_upload_file1']) || isset($_POST['tombol_upload_file2']) || isset($_POST['tombol_upload_file3']) || isset($_POST['tombol_upload_file4']) ){
			$nama_file = $_FILES['file']["name"];
			$nama_file_full = date('YmdHis').$nama_file;
			if (isset($_POST['tombol_upload_file1'])) {
				$nama_field = 'file_spp';
				$tema_persetujuan = 'Pengecekan Berkas SPP dasar untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha';
				$folder 		= "templates/file/mahasiswa/syarat_sk/skripsi/spp/".$nama_file_full;
			}elseif(isset($_POST['tombol_upload_file2'])){
				$nama_field = 'file_transkrip';
				$tema_persetujuan = 'Pengecekan Berkas Transkrip Nilai untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha';
				$folder 		= "templates/file/mahasiswa/syarat_sk/skripsi/transkrip/".$nama_file_full;
			}elseif(isset($_POST['tombol_upload_file3'])){
				$nama_field = 'file_krs';
				$tema_persetujuan = 'Pengecekan Berkas KRS untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha';
				$folder 		= "templates/file/mahasiswa/syarat_sk/skripsi/krs/".$nama_file_full;
			}else{
				$nama_field = 'file_laporan';
				$tema_persetujuan = 'Pengecekan File Proposal Skripsi untuk Pengajuan SK Skripsi Mahasiswa oleh Tata Usaha';
				$folder 		= "templates/file/mahasiswa/syarat_sk/skripsi/laporan/".$nama_file_full;
			}

			$nama_file_lama = $_POST['file_lama'];
			$id_skripsi = $_POST['id_skripsi'];
			
			if(move_uploaded_file($_FILES['file']["tmp_name"], $folder))
			{
				if($this->m_skripsi->upload_file($id_skripsi, $nama_field, $nama_file_full, $tema_persetujuan))
				{
				    // Data Berhasil diinput
					unlink('templates/file/mahasiswa/syarat_sk/skripsi/'.$nama_file_lama);
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
			redirect('mahasiswa/skripsi');
		}else{
			redirect('mahasiswa/skripsi');
		}
	}

	public function usulan_dospem(){
		if(isset($_POST['tombolPilihPembimbing'])){
			$npk = $_POST['npk'];
			$id_skripsi = $_POST['id_skripsi'];
			if($this->m_skripsi->usulan_dospem($id_skripsi, $npk)){
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Pembimbing berhasil dipilih ..
				</div>');	
				redirect('mahasiswa/skripsi');
			}else{
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Pembimbing gagal dipilih..
				</div>');	
				redirect('mahasiswa/skripsi');
			}
		}else{
			redirect('mahasiswa/skripsi');
		}
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
		
		$html = $this->load->view('mahasiswa/cetak_sk_pembimbing_skripsi',$this->data, true);

		
        // run dompdf
		$this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
		unlink("templates/img/qrcode/qrcode".$id_skripsi.".png");
		
	}
}
?>