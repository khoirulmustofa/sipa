<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {
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
		$this->load->model('m_profil');
	}

	public function index()
	{
		$data['mahasiswa']=$this->m_profil->tampil_data();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('profil', $data);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);

	}

	public function editProfil(){
		if (isset($_SESSION['status_login'])) {
			if($_SESSION['status_login']=="Mahasiswa" ){
				$username 		= addslashes ($this->input->post('username'));
				$status_login 	= addslashes ($this->input->post('status_login'));
				$nama_mahasiswa = addslashes ($this->input->post('nama'));
				$npm 			= addslashes ($this->input->post('npm'));
				$jk 			= addslashes ($this->input->post('jk'));
				$tempat_lahir 	= addslashes ($this->input->post('tempat_lahir'));
				$tgl_lahir 		= addslashes ($this->input->post('tgl_lahir'));
				$alamat 		= addslashes ($this->input->post('alamat'));
				$no_hp 			= addslashes ($this->input->post('no_hp'));
				$no_ktp 		= addslashes ($this->input->post('no_ktp'));
				$email_student	= addslashes ($this->input->post('email_student'));
				$email_umum 	= addslashes ($this->input->post('email_umum'));
				$agama 			= addslashes ($this->input->post('agama'));

				//ekstensi foto yang akan diperbolehkan di program
				$extensionList = array("png", "jpg", "jpeg", "PNG", "JPG", "JPEG");
				$maxsize = 1024 * 200;

				$foto = $_FILES['gambar']['name'];

				// Cek apakah user ingin mengubah fotonya atau tidak
				if(empty($foto)){ // Jika user tidak memilih file foto pada form
					// Lakukan proses update tanpa mengubah fotonya
					// Proses ubah data ke Database
					$this->m_profil->edit_profil_nophoto($nama_mahasiswa, $npm, $jk, $tempat_lahir, $tgl_lahir, $email_student, $email_umum, $no_hp, $no_ktp, $agama, $alamat);
					$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Data anda berhasil diedit!
					</div>');
					//set session
					$_SESSION["username"] 		= $npm;
					$_SESSION["npm"] 			= $npm;
					$_SESSION["nama"] 			= $nama_mahasiswa;
					$_SESSION["jk"] 			= $jk;
					$_SESSION["tempat_lahir"] 	= $tempat_lahir;
					$_SESSION["tgl_lahir"] 		= $tgl_lahir;
					$_SESSION["password"] 		= $password;
					$_SESSION["email_student"] 	= $email_student;
					$_SESSION["email_umum"] 	= $email_umum;
					$_SESSION["no_hp"] 			= $no_hp;
					$_SESSION["no_ktp"] 		= $no_ktp;
					$_SESSION["agama"] 			= $agama;
					$_SESSION["alamat"] 		= $alamat;
					// $_SESSION["foto"] 			= $foto;
					redirect('profil');

				}else{ // Jika user memilih foto / mengisi input file foto pada form
					$pecah = explode(".", $foto);
					$ekstensi = $pecah[1];

					// Rename nama_mahasiswa fotonya dengan menambahkan tanggal dan jam upload
					$fotobaru = date('dmYHis').$foto;

					// Set path folder tempat menyimpan fotonya
					$path = "templates/img/mahasiswa/".$fotobaru;
					// Lakukan proses update termasuk mengganti foto sebelumnya
					if (in_array($ekstensi, $extensionList)){
						// memindahkan file ke temporary
						$tmp = $_FILES['gambar']['tmp_name'];

						if($_FILES['gambar']['size']<=$maxsize){
							// Proses upload
							if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
								// Proses simpan ke Database
								if($_SESSION['foto']!=""){
									unlink('templates/img/mahasiswa/'.$_SESSION['foto']);
								}
								$this->m_profil->edit_profil($nama_mahasiswa, $npm, $jk, $tempat_lahir, $tgl_lahir, $email_student, $email_umum, $no_hp, $no_ktp, $agama, $alamat, $fotobaru);
								$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									Data anda berhasil diedit!
								</div>');
								//set session
								$_SESSION["username"] 		= $npm;
								$_SESSION["npm"] 			= $npm;
								$_SESSION["nama"] 			= $nama_mahasiswa;
								$_SESSION["jk"] 			= $jk;
								$_SESSION["tempat_lahir"] 	= $tempat_lahir;
								$_SESSION["tgl_lahir"] 		= $tgl_lahir;
								$_SESSION["password"] 		= $password;
								$_SESSION["email_student"] 	= $email_student;
								$_SESSION["email_umum"] 	= $email_umum;
								$_SESSION["no_hp"] 			= $no_hp;
								$_SESSION["no_ktp"] 		= $no_ktp;
								$_SESSION["agama"] 			= $agama;
								$_SESSION["alamat"] 		= $alamat;
								$_SESSION["foto"] 			= $fotobaru;
								redirect('profil');      
							}else{
								// Jika gambar gagal diupload, Lakukan :
								$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									Maaf, Foto gagal untuk diupload!
								</div>');
								redirect('profil');
							}
						}
						else{
							$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								Maaf, Ukuran foto besar dari 200 kb!
							</div>');
							redirect('profil');
						}
					}
					else{
						$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							Maaf, file yang diupload bukan file image!
						</div>');
						redirect('profil');
					}	
				}	
			}else{
				$username 		= addslashes ($this->input->post('username'));
				$status_login 	= addslashes ($this->input->post('status_login'));
				$nama_mahasiswa = addslashes ($this->input->post('nama_mahasiswa'));
				$npm 			= addslashes ($this->input->post('npm'));
				$jk 			= addslashes ($this->input->post('jk'));
				$tempat_lahir 	= addslashes ($this->input->post('tempat_lahir'));
				$tanggal_lahir 	= addslashes ($this->input->post('tanggal_lahir'));
				$alamat 		= addslashes ($this->input->post('alamat'));
				$no_hp 			= addslashes ($this->input->post('no_hp'));
				$no_ktp 		= addslashes ($this->input->post('no_ktp'));
				$email_student	= addslashes ($this->input->post('email_student'));
				$email_umum 	= addslashes ($this->input->post('email_umum'));

				//ekstensi foto yang akan diperbolehkan di program
				$extensionList = array("png", "jpg", "jpeg", "PNG", "JPG", "JPEG");
				$maxsize = 1024 * 200;

				$foto = $_FILES['gambar']['name'];

				// Cek apakah user ingin mengubah fotonya atau tidak
				if(empty($foto)){ // Jika user tidak memilih file foto pada form
					// Lakukan proses update tanpa mengubah fotonya
					// Proses ubah data ke Database
					$this->m_profil->edit_profil_mahasiswa_nophoto($nama_mahasiswa, $npm, $jk, $email_student, $email_umum);
					$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Data anda berhasil diedit!
					</div>');
					//set session
					$_SESSION["username"] 		= $npm;
					$_SESSION["npm"] 			= $npm;
					$_SESSION["nama"] 			= $nama_mahasiswa;
					$_SESSION["jk"] 			= $jk;
					$_SESSION["tempat_lahir"] 	= $tempat_lahir;
					$_SESSION["tgl_lahir"] 		= $tgl_lahir;
					$_SESSION["password"] 		= $password;
					$_SESSION["email_student"] 	= $email_student;
					$_SESSION["email_umum"] 	= $email_umum;
					$_SESSION["no_hp"] 			= $no_hp;
					$_SESSION["no_ktp"] 		= $no_ktp;
					$_SESSION["agama"] 			= $agama;
					$_SESSION["alamat"] 		= $alamat;
					redirect('profil');

				}else{ // Jika user memilih foto / mengisi input file foto pada form
					$pecah = explode(".", $foto);
					$ekstensi = $pecah[1];

					// Rename nama_mahasiswa fotonya dengan menambahkan tanggal dan jam upload
					$fotobaru = date('dmYHis').$foto;

					// Set path folder tempat menyimpan fotonya
					$path = "templates/img/mahasiswa/".$fotobaru;
					// Lakukan proses update termasuk mengganti foto sebelumnya
					if (in_array($ekstensi, $extensionList)){
						// memindahkan file ke temporary
						$tmp = $_FILES['gambar']['tmp_name'];

						if($_FILES['gambar']['size']<=$maxsize){
							// Proses upload
							if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
								// Proses simpan ke Database
								unlink('templates/img/mahasiswa/'.$_SESSION['foto']);
								$this->m_profil->edit_profil_mahasiswa($nama_mahasiswa, $npm, $jk, $email_student, $email_umum, $fotobaru);
								$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									Data anda berhasil diedit!
								</div>');
								//set session
								$_SESSION["username"] 		= $npm;
								$_SESSION["npm"] 			= $npm;
								$_SESSION["nama"] 			= $nama_mahasiswa;
								$_SESSION["jk"] 			= $jk;
								$_SESSION["tempat_lahir"] 	= $tempat_lahir;
								$_SESSION["tgl_lahir"] 		= $tgl_lahir;
								$_SESSION["password"] 		= $password;
								$_SESSION["email_student"] 	= $email_student;
								$_SESSION["email_umum"] 	= $email_umum;
								$_SESSION["no_hp"] 			= $no_hp;
								$_SESSION["no_ktp"] 		= $no_ktp;
								$_SESSION["agama"] 			= $agama;
								$_SESSION["alamat"] 		= $alamat;
								$_SESSION["foto"] = $fotobaru;
								redirect('profil');      
							}else{
								// Jika gambar gagal diupload, Lakukan :
								$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									Maaf, Foto gagal untuk diupload!
								</div>');
								redirect('profil');
							}
						}
						else{
							$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								Maaf, Ukuran foto besar dari 200 kb!
							</div>');
							redirect('profil');
						}
					}
					else{
						$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							Maaf, file yang diupload bukan file image!
						</div>');
						redirect('profil');
					}	
				}	
			}

		}
	}

	function ganti_password(){
		if(isset($_POST['password_baru'])){
			$password_lama = addslashes ($this->input->post('password_lama'));
			$password_baru = addslashes ($this->input->post('password_baru'));
			$konfirmasi_password_baru = addslashes ($this->input->post('konfirmasi_password_baru'));

			$npm = $_SESSION['npm'];
			$row = $this->m_profil->ambil($npm);
			if(isset($row)){
				$password_encripsi = $row->password;
				if(password_verify($password_lama, $password_encripsi)){
					$password_baru_enc = password_hash($password_baru, PASSWORD_DEFAULT);
					if(strcmp($password_baru, $konfirmasi_password_baru)==0){
						$this->m_profil->ganti_password($password_baru_enc, $npm);
						$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							Password akun anda berhasil diubah..
						</div>');
						redirect('profil');
						date_default_timezone_set('Asia/Jakarta');
						$this->m_profil->input_log($_SESSION['status'],$_SESSION['id'],$_SESSION['nama'],date('Y/m/d'),date("H:i:s"),'Ganti sandi akun');
						redirect('profil');
					}
					else{
						$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							Maaf, Konfirmasi sandi baru tidak sesuai!
						</div>');
						redirect('profil');
					}
				}
				else{
					$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Maaf, Password lama tidak sesuai!
					</div>');
					redirect('profil');
				}
			}
		}else{
			redirect('profil');
		}
	}
}