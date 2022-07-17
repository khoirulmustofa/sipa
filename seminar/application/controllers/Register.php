<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('m_register');
		// $this->load->helper(array('url','download'));
		
	}
	
	public function index()
	{
		$data['combobox_prodi'] = $this->m_register->combobox_prodi();
		$this->load->view('register', $data);
		unset($_SESSION['messege']);
	}

	public function proses(){
		// $npm 					= addslashes($_POST['npm']);
		$npm 					= addslashes ($this->input->post('npm'));
		$nama_mahasiswa 		= addslashes($_POST['nama_mahasiswa']);
		$jk 					= addslashes($_POST['jk']);
		$tempat_lahir 			= addslashes($_POST['tempat_lahir']);
		$tgl_lahir 				= addslashes($_POST['tgl_lahir']);
		$kode_prodi 			= addslashes($_POST['kode_prodi']);
		$email_student 			= addslashes($_POST['email_student']);
		$email_umum 			= addslashes($_POST['email_umum']);
		$password 				= addslashes($_POST['password']);
		$konfirmasi_password 	= addslashes($_POST['konfirmasi_password']);
		$no_hp 					= addslashes($_POST['no_hp']);
		$no_ktp 				= addslashes($_POST['no_ktp']);
		$agama 					= addslashes($_POST['agama']);
		$alamat 				= addslashes($_POST['alamat']);
		$foto 					= '';

		if (strlen($npm)==9) {
			if(strlen($no_ktp)==16){ 
				// if(substr($email, -18)=="@student.uir.ac.id"){
					if($this->m_register->cekNpm($npm)==0){
						if($password==$konfirmasi_password){
							$password_enc = password_hash($password, PASSWORD_DEFAULT);
							if($this->m_register->proses($npm, $nama_mahasiswa, $jk, $tempat_lahir, $tgl_lahir, $kode_prodi, $email_student, $email_umum, $password_enc, $no_hp, $no_ktp,$agama,$alamat, $foto)){

								$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								Register berhasil, silahkan login dengan NPM dan password yang anda daftarkan (status login = Mahasiswa)!
								</div>');
								echo '<script type"text/javascript">';
							    echo 'window.location.href="'.str_replace("seminar/", "", base_url()).'"';
							    echo '</script>';
							}else{
								$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								Maaf, register gagal!
								</div>');
								redirect('register');
							}
						}else{
							$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							Maaf, Konfirmasi password anda salah!
							</div>');
							redirect('register');
						}
					}else{
						$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Maaf, NPM sudah terdaftar sebelumnya!
						</div>');
						redirect('register');
					}
				// }else{
				// 	$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				// 		Pastikan email yang anda gunakan adalah email student UIR !
				// 		</div>');
				// 		redirect('register');
				// }

			}else{
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				NO. KTP harus 16 karakter !
				</div>');
				redirect('register');	
			}
			
		}else{
			$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				NPM harus 9 karakter !
				</div>');
				redirect('register');
		}
	}
}
