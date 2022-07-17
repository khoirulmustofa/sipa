<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bimbingan_skripsi extends CI_Controller {
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
		$this->load->model('m_bimbingan_skripsi');
		$this->load->model('m_monitoring_skripsi');
		$this->load->library('ciqrcode');
		$this->load->library('pdfgenerator');
	}

	public function index()
	{
		$npm = $_SESSION['npm'];
		// $x['pencarian_data'] 	= $this->m_bimbingan->show_sk_mahasiswa2();
		$x['data_bimbingan'] 	= $this->m_bimbingan_skripsi->data_bimbingan2($npm);
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('mahasiswa/bimbingan_skripsi', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);
	}

	public function tambah_laporan_lengkap(){
		if(isset($_POST['tombolUploadLaporan'])){
			date_default_timezone_set('Asia/Jakarta');
			$id_skripsi 	= addslashes($this->input->post('id_skripsi'));
			$nama_file 		= addslashes($this->input->post('nama_file'));
			$nama_file_lama = addslashes($this->input->post('nama_file_lama'));
			$file 			= addslashes($this->input->post('file'));
			$nama_files  	= $_FILES['file']['name'];
			$nama_file_full = date('YmdHis').$nama_files;

			$nama_jenis_file = addslashes($_POST['nama_jenis_file']);

			$folder = "templates/file/mahasiswa/syarat_sk/skripsi/laporan_acc/".$nama_file_full;
			
			if(move_uploaded_file($_FILES['file']["tmp_name"], $folder))
			{
				if($this->m_bimbingan_skripsi->tambah_laporan_acc($id_skripsi, $nama_file_full, $nama_file_lama, $nama_jenis_file))
				{
		    		// Data Berhasil diinput
					$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Data Berhasil diUpload..
					</div>');
					redirect('mahasiswa/bimbingan_skripsi');
				}
				else{
		    		// Data Gagal diinput
					$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Data Gagal diUpload..
					</div>');
					redirect('mahasiswa/bimbingan_skripsi');
				}

			}
			else{
		    	// File Gagal diinput
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					File Gagal diUpload..
				</div>');
				redirect('mahasiswa/bimbingan_skripsi');
			}
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

    function cetak_kartu_bimbingan_skripsi($id_skripsi=null)
	{    
	       // $this->data
		$this->data['id_skripsi'] = $id_skripsi;

	        // filename dari pdf ketika didownload
		$file_pdf = 'Kartu Bimbingan';
	        // setting paper
		$paper = 'Legal';
	        //orientasi paper potrait / landscape
		$orientation = "portrait";

		$html = $this->load->view('mahasiswa/cetak_kartu_bimbingan_skripsi',$this->data, true);

	        // run dompdf
		$this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
		unlink("templates/img/qrcode/qrcode".$id_skripsi.".png");   
	}
}
?>