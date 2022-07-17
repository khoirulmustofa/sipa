<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring_sk extends CI_Controller {
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
		$this->load->model('m_monitoring_sk');
		$this->load->model('m_bimbingan');
		$this->load->model('m_dashboard');
		$this->load->library('ciqrcode');
		$this->load->library('pdfgenerator');
	}

	public function index()
	{
		$kode_prodi = $_SESSION['kode_prodi'];
		if(isset($_SESSION['kode_prodi']) ){
			$x['pencarian_data'] = $this->m_monitoring_sk->show_monitoring_sk_prodi($_SESSION['kode_prodi']);
			$x['pencarian_nilai'] = $this->m_monitoring_sk->show_nilai();
			$x['pencarian_nilai_pembimbing_lapangan'] = $this->m_monitoring_sk->show_nilai_pembimbing_lapangan();
		}
		
		$x['combobox_dosen'] = $this->m_monitoring_sk->combobox_dosen($kode_prodi);
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('prodi/monitoring_sk', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);
	}	

	public function simpan_dospem(){
		if(isset($_POST['tombolPilihPembimbing'])){
			$npk = $_POST['npk'];
			$id_syarat_sk = $_POST['id_syarat_sk'];
			if($this->m_monitoring_sk->simpan_dospem($npk, $id_syarat_sk)){
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Pembimbing berhasil dipilih ..
				</div>');	
				redirect('prodi/monitoring_sk');
			}else{
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Pembimbing berhasil dipilih ..
				</div>');
				redirect('prodi/monitoring_sk');
			}
		}else{
			redirect('prodi/monitoring_sk');
		}
	}

	function reset_dospem(){
		if(isset($_POST['tombolReset'])){
			$id_syarat_sk = addslashes($this->input->post('id_syarat_sk'));
			if ($this->m_monitoring_sk->tombolReset($id_syarat_sk)) {
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Pemilihan Pembimbing Berhasil di Reset!
				</div>');
			}else{
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Pemilihan Pembimbing Gagal di Reset!
				</div>');
			}				
		}
		redirect('prodi/monitoring_sk');
	}

	function cetak_sk_pembimbing_kp($id_syarat_sk=null)
	{    

		$this->data['id_syarat_sk'] = $id_syarat_sk;
       // $this->data
		
        // filename dari pdf ketika didownload
		$file_pdf = 'SK Pembimbing KP ';
        // setting paper
		$paper = 'Legal';
        //orientasi paper potrait / landscape
		$orientation = "portrait";
		
		$html = $this->load->view('prodi/cetak_sk_pembimbing_kp',$this->data, true);

		
        // run dompdf
		$this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
		unlink("templates/img/qrcode/qrcode".$id_syarat_sk.".png");	
	}

	function konfirmasi(){
		if(isset($_POST['tombolKonfirmasi'])){
			$id_syarat_sk = addslashes($this->input->post('id_syarat_sk'));
			if ($this->m_monitoring_sk->konfirmasi($id_syarat_sk)) {
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data berhasil dikonfirmasi!
				</div>');
			}else{
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data gagal dikonfirmasi!
				</div>');
			}				
		}
		redirect('prodi/monitoring_sk');
	}

	function cetak_kartu_bimbingan($id_syarat_sk=null)
	{    
	       // $this->data
		$this->data['id_syarat_sk'] = $id_syarat_sk;

	        // filename dari pdf ketika didownload
		$file_pdf = 'Kartu Bimbingan';
	        // setting paper
		$paper = 'Legal';
	        //orientasi paper potrait / landscape
		$orientation = "portrait";

		$html = $this->load->view('prodi/cetak_kartu_bimbingan',$this->data, true);

	        // run dompdf
		$this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
		unlink("templates/img/qrcode/qrcode".$id_syarat_sk.".png");   
	}

	function tandatanganprodi(){
		$id_syarat_sk 			= $_POST['id_syarat_sk'];
		
		if ($this->m_monitoring_sk->ttd_prodi($id_syarat_sk)) {
			$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Kartu bimbingan berhasil di Tantatangan..
			</div>');
			redirect('prodi/monitoring_sk');
		}
		else{
			$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Kartu bimbingan gagal di Tantatangan..
			</div>');
			redirect('prodi/monitoring_sk');
		}
	}
}