<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_pengantar_penelitian extends CI_Controller {
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
		$this->load->model('m_surat_pengantar_penelitian');
		$this->load->library('ciqrcode');
        $this->load->library('pdfgenerator');
	}

	public function index()
	{
		$kode_prodi = $_SESSION['kode_prodi'];
		$x['data_surat_pengantar_penelitian'] 	= $this->m_surat_pengantar_penelitian->data_surat_pengantar_penelitian_mhs($kode_prodi);
		$x['row_data'] = $this->m_surat_pengantar_penelitian->row_data($_SESSION['npm']);
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('mahasiswa/surat_pengantar_penelitian', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);

	}

	public function tambah_surat_pengantar_penelitian()
	{
		if(isset($_POST['tombolTambahSuratPengantarPenelitian'])){
			date_default_timezone_set('Asia/Jakarta');
			$id_surat_pengantar_penelitian 		= addslashes($this->input->post('id_surat_pengantar_penelitian'));
			$nama_instansi 		= addslashes($this->input->post('nama_instansi'));
			$alamat_instansi 	= addslashes($this->input->post('alamat_instansi'));
			$judul_penelitian 	= addslashes($this->input->post('judul_penelitian'));
			$matakuliah 		= addslashes($this->input->post('matakuliah'));
			$ditujukan 					= addslashes($this->input->post('ditujukan'));
			$npm 				= $_SESSION['npm'];
			
			$nama_file_spp  	= $_FILES['file_spp']['name'];
			$nama_file_full_spp = date('YmdHis').$nama_file_spp;
			$folderspp 			= "templates/file/mahasiswa/syarat_sk/surat_pengantar_penelitian/spp/".$nama_file_full_spp;

			$nama_file_ktm  		= $_FILES['file_ktm']['name'];
			$nama_file_full_ktm	= date('YmdHis').$nama_file_ktm;
			$folderktm = "templates/file/mahasiswa/syarat_sk/surat_pengantar_penelitian/ktm/".$nama_file_full_ktm;
			move_uploaded_file($_FILES['file_ktm']["tmp_name"], $folderktm);

			$nama_file_sk  		= $_FILES['file_sk']['name'];
			$nama_file_full_sk	= date('YmdHis').$nama_file_sk;
			$foldersk = "templates/file/mahasiswa/syarat_sk/surat_pengantar_penelitian/sk/".$nama_file_full_sk;
			move_uploaded_file($_FILES['file_sk']["tmp_name"], $foldersk);

			if(move_uploaded_file($_FILES['file_spp']["tmp_name"], $folderspp))
			{
				if($this->m_surat_pengantar_penelitian->tambah_surat_pengantar_penelitian($id_surat_pengantar_penelitian, $npm, $nama_instansi, $alamat_instansi, $ditujukan, $judul_penelitian, $matakuliah, $nama_file_full_spp, $nama_file_full_ktm, $nama_file_full_sk))
				{
		    		// Data Berhasil diinput
					$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Data Berhasil diUpload..
					</div>');
					redirect('mahasiswa/surat_pengantar_penelitian');
				}
				else{
		    		// Data Gagal diinput
					$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Data Gagal diUpload..
					</div>');
					redirect('mahasiswa/surat_pengantar_penelitian');
				}
			}
			else{
		    	// File Gagal diinput
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					File Gagal diUpload..
				</div>');
				redirect('mahasiswa/surat_pengantar_penelitian');
			}
		}else{
			redirect('mahasiswa/surat_pengantar_penelitian');
		}
	}

	function hapus_surat_pengantar_penelitian(){
	if(isset($_POST['tombolHapus'])){
		$id_surat_pengantar_penelitian = addslashes($this->input->post('id_surat_pengantar_penelitian'));
		if ($this->m_surat_pengantar_penelitian->hapus_surat_pengantar_penelitian($id_surat_pengantar_penelitian)) {
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
	redirect('mahasiswa/surat_pengantar_penelitian');
	}

	function cetak($id_surat_pengantar_penelitian=null)
    {    
       // $this->data
       $this->data['id_surat_pengantar_penelitian'] = $id_surat_pengantar_penelitian;
        
        // filename dari pdf ketika didownload
        $file_pdf = 'Permohonan Pengantar Penelitian';
        // setting paper
        $paper = 'Legal';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        
        $html = $this->load->view('mahasiswa/cetak_surat_pengantar_penelitian',$this->data, true);
        
        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
        unlink("templates/img/qrcode/qrcode".$id_surat_pengantar.".png");   
    }

    function tandatangandekan(){
    	$id_surat_pengantar_penelitian 		= $_POST['id_surat_pengantar_penelitian'];
    	$nama_instansi 				= $_POST['nama_instansi'];
    	$alamat_instansi 			= $_POST['alamat_instansi'];
    	$npm 						= $_POST['npm'];
    	$nama_mahasiswa 			= $_POST['nama_mahasiswa'];
    	$waktu_mulai_kp 			= $_POST['waktu_mulai_kp'];
    	$waktu_selesai_kp 			= $_POST['waktu_selesai_kp'];
    	$tgl_upload_surat_pengantar = $_POST['tgl_upload_surat_pengantar'];

    	if ($this->m_surat_pengantar_penelitian->input_nomor_surat($id_surat_pengantar_penelitian, $nama_instansi, $alamat_instansi, $npm, $nama_mahasiswa, $waktu_mulai_kp, $waktu_selesai_kp, $tgl_upload_surat_pengantar)) {
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