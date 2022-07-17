<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penunjukan_pembimbing extends CI_Controller {
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
				if(strcmp($_SESSION["status_login"], 'Fakultas')==0){
					redirect('');
				}else{
					redirect('');
				}
			}else{
				//dibolehkan
			}
		}

		$this->load->model('m_penunjukan_pembimbing');
	}

	public function index()
	{
		$kode_prodi 			= $_SESSION["kode_prodi"];
		$x['combobox_dosen'] 	= $this->m_penunjukan_pembimbing->combobox_dosen($kode_prodi);
		$x['data'] 				= $this->m_penunjukan_pembimbing->show_penunjukan_pembimbing();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('prodi/penunjukan_pembimbing', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);

	}

	public function tambah_aksi()
	{
		date_default_timezone_set('Asia/Jakarta');
		$npk 			= $_SESSION['username'];
		$id_jenis_sk 	= $_POST['id_jenis_sk'];
	    $nama_file  	= $_FILES['file']['name'];
	    $nama_file_full = date('YmdHis').$nama_file;
	    // echo $nama_file_full; die();
	    $folder = "templates/file/mahasiswa/syarat_sk/sk/".$nama_file_full;
	    if(move_uploaded_file($_FILES['file']["tmp_name"], $folder))
	    {
	    	if($this->m_penunjukan_pembimbing->tambah_aksi($id_jenis_sk, $nama_file_full, $npm))
	    	{
	    		// Data Berhasil diinput
	    		$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Data Berhasil diUpload..
				</div>');
	    		redirect('mahasiswa/penunjukan_pembimbing');
	    	}
	    	else{
	    		// Data Gagal diinput
	    		$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Data Gagal diUpload..
				</div>');
	    		redirect('mahasiswa/penunjukan_pembimbing');
	    	}
	    }
	    else{
	    	// File Gagal diinput
	    	$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				File Gagal diUpload..
				</div>');
	    	redirect('mahasiswa/penunjukan_pembimbing');
	    }
	}	
}