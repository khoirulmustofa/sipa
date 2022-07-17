<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kompre extends CI_Controller {
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
		$this->load->model('m_kompre');
		$this->load->model('m_penilaian');
		$this->load->library('ciqrcode');
		$this->load->library('pdfgenerator');
	}

	public function index()
	{
		$x['combobox_jenis_seminar'] = $this->m_kompre->combobox_jenis_seminar();

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('mahasiswa/kompre', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);
	}

	public function tambah_data()
	{
		if(isset($_POST['tombolInputSyaratKompre'])){
			date_default_timezone_set('Asia/Jakarta');
			
			$id_seminar 	= addslashes($this->input->post('id_seminar'));
			$usulan_tanggal = addslashes($this->input->post('usulan_tanggal'));
			$usulan_jam 	= addslashes($this->input->post('usulan_jam'));
			$npm 			= $_SESSION['npm'];
			
			$nama_file_spp  	= $_FILES['file_spp']['name'];
			$nama_file_full_spp = date('YmdHis').$nama_file_spp;
			$folderspp 			= "templates/file/mahasiswa/syarat_kompre/spp/".$nama_file_full_spp;

			$nama_file_transkrip  		= $_FILES['file_transkrip']['name'];
			$nama_file_full_transkrip 	= date('YmdHis').$nama_file_transkrip;
			$foldertranskrip 			= "templates/file/mahasiswa/syarat_kompre/transkip/".$nama_file_full_transkrip;
			move_uploaded_file($_FILES['file_transkrip']["tmp_name"], $foldertranskrip);

			$nama_file_krs  	= $_FILES['file_krs']['name'];
			$nama_file_full_krs = date('YmdHis').$nama_file_krs;
			$folderkrs 			= "templates/file/mahasiswa/syarat_kompre/krs/".$nama_file_full_krs;
			move_uploaded_file($_FILES['file_krs']["tmp_name"], $folderkrs);
			
			$nama_file_sertifikat_alquran  		= $_FILES['sertifikat_alquran']['name'];
			$nama_file_full_sertifikat_alquran  = date('YmdHis').$nama_file_sertifikat_alquran;
			$foldersertifikat_alquran 			= "templates/file/mahasiswa/syarat_kompre/sertifikat_alquran/".$nama_file_full_sertifikat_alquran;
			move_uploaded_file($_FILES['sertifikat_alquran']["tmp_name"], $foldersertifikat_alquran);

			$nama_file_sertifikat_inggris  		= $_FILES['sertifikat_inggris']['name'];
			$nama_file_full_sertifikat_inggris  = date('YmdHis').$nama_file_sertifikat_inggris;
			$foldersertifikat_inggris 			= "templates/file/mahasiswa/syarat_kompre/sertifikat_inggris/".$nama_file_full_sertifikat_inggris;
			move_uploaded_file($_FILES['sertifikat_inggris']["tmp_name"], $foldersertifikat_inggris);
			
			$nama_file_laporan  	= $_FILES['file_laporan']['name'];
			$nama_file_full_laporan	= date('YmdHis').$nama_file_laporan;
			$folderlaporan 			= "templates/file/mahasiswa/syarat_kompre/laporan_lengkap/".$nama_file_full_laporan;
			move_uploaded_file($_FILES['file_laporan']["tmp_name"], $folderlaporan);

			if(move_uploaded_file($_FILES['file_spp']["tmp_name"], $folderspp))
			{
				if($this->m_kompre->tambah_data($id_seminar, $npm, $usulan_tanggal, $usulan_jam, $nama_file_full_spp, $nama_file_full_krs, $nama_file_full_transkrip, $nama_file_full_sertifikat_alquran, $nama_file_full_sertifikat_inggris, $nama_file_full_laporan))
				{
		    		// Data Berhasil diinput
					$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Data Berhasil diUpload..
					</div>');
					redirect('mahasiswa/kompre');
				}
				else{
		    		// Data Gagal diinput
					$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Data Gagal diUpload..
					</div>');
					redirect('mahasiswa/kompre');
				}
			}
			else{
		    	// File Gagal diinput
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					File Gagal diUpload..
				</div>');
				redirect('mahasiswa/kompre');
			}
		}else{
			redirect('mahasiswa/kompre');
		}
	}	

	public function upload_file(){
		if(isset($_POST['tombol_upload_file1']) || isset($_POST['tombol_upload_file2']) || isset($_POST['tombol_upload_file3']) || isset($_POST['tombol_upload_file4']) || isset($_POST['tombol_upload_file5']) || isset($_POST['tombol_upload_file6']) ){
			$nama_file 			  = $_FILES['file']["name"];
			$nama_file_full 	  = date('YmdHis').$nama_file;
			if (isset($_POST['tombol_upload_file1'])) {
				$nama_field 	  = 'file_spp';
				$tema_persetujuan = 'Pengecekan Berkas SPP untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha';
				$folder 		  = "templates/file/mahasiswa/syarat_kompre/spp/".$nama_file_full;
			}elseif(isset($_POST['tombol_upload_file2'])){
				$nama_field 	  = 'file_transkrip';
				$tema_persetujuan = 'Pengecekan Berkas Transkip untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha';
				$folder 		  = "templates/file/mahasiswa/syarat_kompre/transkip/".$nama_file_full;
			}elseif(isset($_POST['tombol_upload_file3'])){
				$nama_field 	  = 'file_krs';
				$tema_persetujuan = 'Pengecekan Berkas KRS untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha';
				$folder 		  = "templates/file/mahasiswa/syarat_kompre/krs/".$nama_file_full;
			}
			elseif(isset($_POST['tombol_upload_file4'])){
				$nama_field 	  = 'sertifikat_alquran';
				$tema_persetujuan = 'Pengecekan Berkas Sertifikat Alquran untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha';
				$folder 		  = "templates/file/mahasiswa/syarat_kompre/sertifikat_alquran/".$nama_file_full;
			}
			elseif(isset($_POST['tombol_upload_file5'])){
				$nama_field 	  = 'sertifikat_inggris';
				$tema_persetujuan = 'Pengecekan Berkas Sertifikat Inggris untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha';
				$folder 		  = "templates/file/mahasiswa/syarat_kompre/sertifikat_inggris/".$nama_file_full;
			}else{
				$nama_field 	  = 'file_laporan';
				$tema_persetujuan = 'Pengecekan Berkas Laporan Lengkap untuk Persyaratan Kompre Mahasiswa oleh Tata Usaha';
				$folder 		  = "templates/file/mahasiswa/syarat_kompre/laporan_lengkap/".$nama_file_full;
			}

			$nama_file_lama 	  = $_POST['file_lama'];
			$id_syarat_kompre     = $_POST['id_syarat_kompre'];
			
			if(move_uploaded_file($_FILES['file']["tmp_name"], $folder))
			{
				if($this->m_kompre->upload_file($id_syarat_kompre, $nama_field, $nama_file_full, $tema_persetujuan))
				{
				    // Data Berhasil diinput
					unlink('templates/file/mahasiswa/syarat_kompre/'.$nama_file_lama);
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
			redirect('mahasiswa/kompre');
		}else{
			redirect('mahasiswa/kompre');
		}
	}

	

}