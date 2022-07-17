<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sempro extends CI_Controller {
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
		$this->load->model('m_sempro');
		$this->load->library('ciqrcode');
		$this->load->library('pdfgenerator');
	}

	public function index()
	{
		$x['combobox_jenis_seminar'] = $this->m_sempro->combobox_jenis_seminar();

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('mahasiswa/sempro', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);
	}


	public function tambah_data()
	{
		if(isset($_POST['tombolInputSyaratSempro'])){
			date_default_timezone_set('Asia/Jakarta');
			
			$id_seminar 	= addslashes($this->input->post('id_seminar'));
			$usulan_tanggal = addslashes($this->input->post('usulan_tanggal'));
			$usulan_jam 	= addslashes($this->input->post('usulan_jam'));
			$npm 			= $_SESSION['npm'];
			
			$nama_file_spp  	= $_FILES['file_spp']['name'];
			$nama_file_full_spp = date('YmdHis').$nama_file_spp;
			$folderspp 			= "templates/file/mahasiswa/syarat_sempro/spp/".$nama_file_full_spp;

			$nama_file_krs  	= $_FILES['file_krs']['name'];
			$nama_file_full_krs = date('YmdHis').$nama_file_krs;
			$folderkrs 			= "templates/file/mahasiswa/syarat_sempro/krs/".$nama_file_full_krs;
			move_uploaded_file($_FILES['file_krs']["tmp_name"], $folderkrs);
			
			$nama_file_proposal  		= $_FILES['file_proposal']['name'];
			$nama_file_full_proposal	= date('YmdHis').$nama_file_proposal;
			$folderproposal 			= "templates/file/mahasiswa/syarat_sempro/proposal/".$nama_file_full_proposal;
			move_uploaded_file($_FILES['file_proposal']["tmp_name"], $folderproposal);

			if(move_uploaded_file($_FILES['file_spp']["tmp_name"], $folderspp))
			{
				if($this->m_sempro->tambah_data($id_seminar, $npm, $usulan_tanggal, $usulan_jam, $nama_file_full_spp, $nama_file_full_krs, $nama_file_full_proposal))
				{
		    		// Data Berhasil diinput
					$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Data Berhasil diUpload..
					</div>');
					redirect('mahasiswa/sempro');
				}
				else{
		    		// Data Gagal diinput
					$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Data Gagal diUpload..
					</div>');
					redirect('mahasiswa/sempro');
				}
			}
			else{
		    	// File Gagal diinput
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					File Gagal diUpload..
				</div>');
				redirect('mahasiswa/sempro');
			}
		}else{
			redirect('mahasiswa/sempro');
		}
	}	

	public function upload_file(){
		if(isset($_POST['tombol_upload_file1']) || isset($_POST['tombol_upload_file2']) || isset($_POST['tombol_upload_file3'])){
			$nama_file 			  = $_FILES['file']["name"];
			$nama_file_full 	  = date('YmdHis').$nama_file;
			if (isset($_POST['tombol_upload_file1'])) {
				$nama_field 	  = 'file_krs';
				$tema_persetujuan = 'Pengecekan Berkas KRS untuk Persyaratan Sempro Mahasiswa oleh Tata Usaha';
				$folder 		  = "templates/file/mahasiswa/syarat_sempro/krs/".$nama_file_full;
			}elseif(isset($_POST['tombol_upload_file2'])){
				$nama_field 	  = 'file_spp';
				$tema_persetujuan = 'Pengecekan Berkas SPP untuk Persyaratan Sempro Mahasiswa oleh Tata Usaha';
				$folder 		  = "templates/file/mahasiswa/syarat_sempro/spp/".$nama_file_full;
			}else{
				$nama_field 	  = 'file_proposal';
				$tema_persetujuan = 'Pengecekan Berkas Proposal untuk Persyaratan Sempro Mahasiswa oleh Tata Usaha';
				$folder 		  = "templates/file/mahasiswa/syarat_sempro/proposal/".$nama_file_full;
			}

			$nama_file_lama = $_POST['file_lama'];
			$id_syarat_sempro = $_POST['id_syarat_sempro'];
			
			if(move_uploaded_file($_FILES['file']["tmp_name"], $folder))
			{
				if($this->m_sempro->upload_file($id_syarat_sempro, $nama_field, $nama_file_full, $tema_persetujuan))
				{
				    // Data Berhasil diinput
					unlink('templates/file/mahasiswa/syarat_sempro/'.$nama_file_lama);
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
			redirect('mahasiswa/sempro');
		}else{
			redirect('mahasiswa/sempro');
		}
	}
}