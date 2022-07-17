<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sanksi extends CI_Controller {
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
		$this->load->model('m_sanksi');
	}

	public function index()
	{
		$kode_prodi = $_SESSION['kode_prodi'];
		$x['combobox_mahasiswa'] = $this->m_sanksi->combobox_mahasiswa($kode_prodi);
		$x['data_sanksi'] = $this->m_sanksi->data_sanksi($kode_prodi);
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('prodi/sanksi', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);
	}	

	public function tambah_sanksi(){
		if(isset($_POST['tombolSanksi'])){
			$npm 					= $_POST['npm'];
			$penyebab 				= $_POST['penyebab'];
			$sanksi 				= $_POST['sanksi'];
			$tanggal_mulai_sanksi 	= $_POST['tanggal_mulai_sanksi'];
			$jam_mulai_sanksi 		= $_POST['jam_mulai_sanksi'];
			$tanggal_selesai_sanksi = $_POST['tanggal_selesai_sanksi'];
			$jam_selesai_sanksi 	= $_POST['jam_selesai_sanksi'];
			$waktu_mulai_sanksi 	= $tanggal_mulai_sanksi.' '.$jam_mulai_sanksi;
			$waktu_selesai_sanksi 	= $tanggal_selesai_sanksi.' '.$jam_selesai_sanksi;

			if($this->m_sanksi->tambah_sanksi($npm, $penyebab, $sanksi, $waktu_mulai_sanksi, $waktu_selesai_sanksi)){
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Sanksi Mahasiswa berhasil diiput..
				</div>');	
				redirect('prodi/sanksi');
			}else{
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Sanksi Mahasiswa gagal diiput..
				</div>');	
				redirect('prodi/sanksi');
			}
		}else{
			redirect('prodi/sanksi');
		}
	}

	function hapus_data(){
		if(isset($_POST['tombolHapus'])){
			$id_sanksi = addslashes($this->input->post('id_sanksi'));
			if ($this->m_sanksi->hapus_data($id_sanksi)) {
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
		redirect('prodi/sanksi');
	}
	
}