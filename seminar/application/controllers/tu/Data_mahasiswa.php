<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_mahasiswa extends CI_Controller {
	function __construct(){
		parent::__construct();
		//CEK SESSION
		if((!isset($_SESSION['login_smpu']))){
			echo '<script type"text/javascript">';
			echo 'window.location.href="'.str_replace("seminar/", "", base_url()).'"';
			echo '</script>';
		}else{
			if(strcmp($_SESSION["status_login"], 'Tata Usaha')!==0 ){
				redirect('');
			}else{
				//dibolehkan
			}
		}

		$this->load->model('m_register');
	}

	public function index()
	{
		if(isset($_POST['tombol_cari'])){
			if ($_POST['kode_prodi']=='0') {
				unset($_SESSION['kode_prodi']);
			}else{
				$_SESSION['kode_prodi']   = $_POST['kode_prodi'];				
			}
		}
		$x['pencarian_data']=$this->m_register->show_mahasiswa();
		$x['combobox_prodi'] = $this->m_register->combobox_prodi();

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('tu/data_mahasiswa', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);
	}

	public function edit_nama(){
		if(isset($_POST['tombolSimpan'])){
			
			$nama_mahasiswa = addslashes($this->input->post('nama_mahasiswa'));
			$alamat 		= addslashes($this->input->post('alamat'));
			$no_hp 			= addslashes($this->input->post('no_hp'));
			$no_ktp 		= addslashes($this->input->post('no_ktp'));
			$email_student 	= addslashes($this->input->post('email_student'));
			$email_umum 	= addslashes($this->input->post('email_umum'));
			$npm 			= addslashes($this->input->post('npm'));

			if ($this->m_register->edit_nama($npm, $nama_mahasiswa, $alamat, $no_hp, $no_ktp, $email_student, $email_umum)
				) {
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Berhasil Edit Data!
				</div>');

		} else{
			$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Gagal Edit Data !
			</div>');
		}		
	}
	redirect('tu/data_mahasiswa');
}

function reset_password(){
	if(isset($_POST['reset_password'])){

		$npm=addslashes($this->input->post('npm'));
		$password_baru=addslashes($this->input->post('password_baru'));
		$konfirmasi_password_baru=addslashes($this->input->post('konfirmasi_password_baru'));
		$npm=addslashes($this->input->post('npm'));
		$kode_prodi = $_SESSION['kode_prodi'];
		if($password_baru==$konfirmasi_password_baru){

			$password_baru_enc = password_hash($password_baru, PASSWORD_DEFAULT);
			if($this->m_register->reset_password($npm, $password_baru_enc)){
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Password akun berhasil direset!
				</div>');
			}else{
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Maaf, Password akun gagal direset!
				</div>');
			}
			
		}else{
			$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Maaf, konfirmasi password tidak sesuai. Silahkan coba lagi!
			</div>');
		}
	}
	redirect('tu/data_mahasiswa');
}
}