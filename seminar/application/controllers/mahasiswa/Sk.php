<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
defined('BASEPATH') OR exit('No direct script access allowed');

class Sk extends CI_Controller {
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
		$this->load->model('m_sk');
		$this->load->model('m_monitoring_sk');
		$this->load->library('ciqrcode');
		$this->load->library('pdfgenerator');
	}

	public function index()
	{
		$npm = $_SESSION['npm'];
		$x['combobox_jenis_sk'] 		= $this->m_sk->combobox_jenis_sk();
		$x['combobox_nama_tempat_kp'] 	= $this->m_sk->combobox_nama_tempat_kp($npm);
		$x['row_data'] 					= $this->m_sk->row_data($_SESSION['npm']);
		$x['pencarian_data'] 			= $this->m_sk->show_sk($_SESSION['npm']);
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('mahasiswa/sk', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);

	}

	public function tambah_data()
	{
		if(isset($_POST['tombolInputSyaratSK'])){
			date_default_timezone_set('Asia/Jakarta');
			
			$id_jenis_sk 				= addslashes($this->input->post('id_jenis_sk'));
			$id_surat_pengantar 		= addslashes($this->input->post('id_surat_pengantar'));
			$judul_kerja_praktik 		= addslashes($this->input->post('judul_kerja_praktik'));
			$nama_pembimbing_lapangan 	= addslashes($this->input->post('nama_pembimbing_lapangan'));
			$nama_mahasiswa 	= $_SESSION['nama'];
			// echo $nama_mahasiswa; die();
			$no_hp_pembimbing_lapangan	= addslashes($this->input->post('no_hp_pembimbing_lapangan'));
			$email_pembimbing_lapangan	= addslashes($this->input->post('email_pembimbing_lapangan'));
			$waktu_mulai_kp				= addslashes($this->input->post('waktu_mulai_kp'));
			$waktu_selesai_kp 			= addslashes($this->input->post('waktu_selesai_kp'));
			$npm 						= $_SESSION['npm'];
			$nama_file  				= $_FILES['file']['name'];
			$nama_file_full 			= date('YmdHis').$nama_file;

			$nama_file_spp  			= $_FILES['file_spp_dasar']['name'];
			$nama_file_full_spp 		= date('YmdHis').$nama_file_spp;
			$folderspp 			= "templates/file/mahasiswa/syarat_sk/sk/spp/".$nama_file_full_spp;
			move_uploaded_file($_FILES['file_spp_dasar']["tmp_name"], $folderspp);
			
			$nama_file_transkrip  		= $_FILES['file_transkrip']['name'];
			$nama_file_full_transkrip	= date('YmdHis').$nama_file_transkrip;
			$foldertranskrip = "templates/file/mahasiswa/syarat_sk/sk/transkrip/".$nama_file_full_transkrip;
			move_uploaded_file($_FILES['file_transkrip']["tmp_name"], $foldertranskrip);

			$nama_file_laporan  		= $_FILES['file_laporan']['name'];
			$nama_file_full_laporan	= date('YmdHis').$nama_file_laporan;
			$folderlaporan = "templates/file/mahasiswa/syarat_sk/sk/laporan/".$nama_file_full_laporan;
			move_uploaded_file($_FILES['file_laporan']["tmp_name"], $folderlaporan);
			
			$folder = "templates/file/mahasiswa/syarat_sk/sk/".$nama_file_full;
			if(move_uploaded_file($_FILES['file']["tmp_name"], $folder))
			{
				$string_random = $this->generateRandomString(10);
				if($this->m_sk->tambah_data($id_jenis_sk, $npm, $id_surat_pengantar, $judul_kerja_praktik, $nama_pembimbing_lapangan, $no_hp_pembimbing_lapangan, $email_pembimbing_lapangan, $string_random, $waktu_mulai_kp, $waktu_selesai_kp, $nama_file_full, $nama_file_full_spp, $nama_file_full_transkrip, $nama_file_full_laporan))
				{
				$this->send_email($nama_mahasiswa, $email_pembimbing_lapangan, $nama_pembimbing_lapangan, $string_random);
		    		// Data Berhasil diinput
					$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Data Berhasil diUpload..
					</div>');
					redirect('mahasiswa/sk');
				}
				else{
		    		// Data Gagal diinput
					$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Data Gagal diUpload..
					</div>');
					redirect('mahasiswa/sk');
				}
			}
			else{
		    	// File Gagal diinput
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					File Gagal diUpload..
				</div>');
				redirect('mahasiswa/sk');
			}
		}else{
			redirect('mahasiswa/sk');
		}
	}	

public function send_email($nama_mahasiswa, $email_pembimbing_lapangan, $nama_pembimbing_lapangan, $string_random){
	// public function send_email(){

		// Load Composer's autoloader
		$this->load->library("php_mail");

		// Instantiation and passing `true` enables exceptions
		$mail = new PHPMailer(true);
		try {
		    //Server settings
		    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
		    $mail->isSMTP();                                            // Set mailer to use SMTP
		    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		   	$mail->Username   = 'fakultas_teknik@uir.ac.id';                       // SMTP username
		    $mail->Password   = 'uirunggul2020';                               // SMTP password
		    $mail->SMTPSecure = 'TLS';                                  // Enable TLS encryption, `ssl` also accepted
		    $mail->Port       = 587;                                    // TCP port to connect to

		    //Recipients
		    $mail->setFrom('fakultas_teknik@uir.ac.id', 'FAKULTAS TEKNIK UIR');
		    $mail->addAddress($email_pembimbing_lapangan, $nama_pembimbing_lapangan);     // Add a recipient

		    // Attachments
		    // $mail->addStringAttachment(file_get_contents('https://cdn0-production-images-kly.akamaized.net/tAr72vTJCpF4IF9O5L493CD79kE=/640x360/smart/filters:quality(75):strip_icc():format(jpeg)/kly-media-production/medias/2754932/original/005940800_1552970791-fotoHL_kucing.jpg'), 'filename.jpg');   // Optional name

		    // Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = 'Akun Pembimbing Lapangan/ Perusahaan Kerja Praktik';
		    $mail->Body    = '<b>Assalamualaikum Wr. Wb.</b><br>
		    				Berkenaan dengan dilaksanakannya Kerja Praktek di Instansi yang Bapak/Ibu pimpin, kami mengharapkan kesediaan/partisipasi Bapak/Ibu untuk memberikan penilaian kepada Mahasiswa kami. Selanjutnya, setelah link https://app.eng.uir.ac.id/sipa terbuka, silahkan Bapak/Ibu inputkan Username, Password dan Status Login dibawah :<br>
		    				Nama Mahasiswa : '.$nama_mahasiswa.'<br>
		    				Username : '.$email_pembimbing_lapangan.'<br>
		    				Password : '.$string_random.'<br>
		    				Status Login : <b>Pembimbing Lapangan KP</b><br>
		    				<b>Wassalamualaikum Wr. Wb.</b>';
		    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		    $mail->send();
		    echo 'Message has been sent';
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}

	}

	function generateRandomString($length) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	public function edit_data(){
		if(isset($_POST['tombolSimpan'])){
			date_default_timezone_set('Asia/Jakarta');
			
			$id_syarat_sk 				= addslashes($this->input->post('id_syarat_sk'));
			$nama_tempat_kp 			= addslashes($this->input->post('id_surat_pengantar'));
			$judul_kerja_praktik 		= addslashes($this->input->post('judul_kerja_praktik'));
			$nama_pembimbing_lapangan 	= addslashes($this->input->post('nama_pembimbing_lapangan'));
			$no_hp_pembimbing_lapangan	= addslashes($this->input->post('no_hp_pembimbing_lapangan'));
			$email_pembimbing_lapangan	= addslashes($this->input->post('email_pembimbing_lapangan'));
			$waktu_mulai_kp				= addslashes($this->input->post('waktu_mulai_kp'));
			$waktu_selesai_kp 			= addslashes($this->input->post('waktu_selesai_kp'));
			$nama_file_syarat_sk_lama	= addslashes($this->input->post('nama_file_syarat_sk'));
			$nama_file  				= $_FILES['file']['name'];
			$npm 						= $_SESSION['npm'];
			$cek_query 					= 0;

			if(empty($nama_file)){ 
				if ($this->m_sk->edit_data_nofile($id_syarat_sk, $npm, $nama_tempat_kp, $judul_kerja_praktik, $nama_pembimbing_lapangan, $no_hp_pembimbing_lapangan, $email_pembimbing_lapangan, $waktu_mulai_kp, $waktu_selesai_kp)
					) {
					$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Data anda berhasil diedit!
					</div>');
				$cek_query = 1;
				
			} else{
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data anda gagal diedit!
				</div>');
			}

		} else{

			$nama_file_full = date('YmdHis').$nama_file;
			$folder 		= "templates/file/mahasiswa/syarat_sk/sk/".$nama_file_full;

			if(move_uploaded_file($_FILES['file']["tmp_name"], $folder))
			{
				if($this->m_sk->edit_data($id_syarat_sk, $npm, $nama_tempat_kp, $judul_kerja_praktik, $nama_pembimbing_lapangan, $no_hp_pembimbing_lapangan, $email_pembimbing_lapangan, $waktu_mulai_kp, $waktu_selesai_kp, $nama_file_full))
				{
				    // Data Berhasil diinput
					unlink('templates/file/mahasiswa/syarat_sk/sk/'.$nama_file_syarat_sk_lama);
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
		}
		if ($cek_query==1) {
			$this->m_sk->hapus_respon_tu($id_syarat_sk);
		}
	}
	redirect('mahasiswa/sk');
	}

	function hapus_data(){
		if(isset($_POST['tombolHapus'])){
			$id_syarat_sk 				= addslashes($this->input->post('id_syarat_sk'));
			if ($this->m_sk->hapus_data($id_syarat_sk)) {
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
		redirect('mahasiswa/sk');
	}

	function cetak_sk_pembimbing_kp($id_syarat_sk=null)
	{    

		$this->data['id_syarat_sk'] = $id_syarat_sk;
		
		// filename dari pdf ketika didownload
		$file_pdf = 'SK Pembimbing KP ';
		
		// setting paper
		$paper = 'Legal';
		
		//orientasi paper potrait / landscape
		$orientation = "portrait";

		$html = $this->load->view('mahasiswa/cetak_sk_pembimbing_kp',$this->data, true);

		// run dompdf
		$this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
		unlink("templates/img/qrcode/qrcode".$id_syarat_sk.".png");
	}

	public function upload_file(){
		if(isset($_POST['tombol_upload_file1']) || isset($_POST['tombol_upload_file2']) || isset($_POST['tombol_upload_file3']) || isset($_POST['tombol_upload_file4']) ){
			$nama_file = $_FILES['file']["name"];
			$nama_file_full = date('YmdHis').$nama_file;
			if (isset($_POST['tombol_upload_file1'])) {
				$nama_field = 'nama_file_syarat_sk';
				$tema_persetujuan = 'Pengecekan Berkas Bukti Penerimaan Lapangan untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha';
				$folder 		= "templates/file/mahasiswa/syarat_sk/sk/".$nama_file_full;
			}elseif(isset($_POST['tombol_upload_file2'])){
				$nama_field = 'file_spp_dasar';
				$tema_persetujuan = 'Pengecekan Berkas SPP dasar untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha';
				$folder 		= "templates/file/mahasiswa/syarat_sk/sk/spp/".$nama_file_full;
			}elseif(isset($_POST['tombol_upload_file3'])){
				$nama_field = 'file_transkrip';
				$tema_persetujuan = 'Pengecekan Berkas Transkip Nilai Sementara untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha';
				$folder 		= "templates/file/mahasiswa/syarat_sk/sk/transkrip/".$nama_file_full;
			}else{
				$nama_field = 'file_laporan';
				$tema_persetujuan = 'Pengecekan File Laporan KP untuk Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha';
				$folder 		= "templates/file/mahasiswa/syarat_sk/sk/laporan/".$nama_file_full;
			}

			$nama_file_lama = $_POST['file_lama'];
			$id_syarat_sk = $_POST['id_syarat_sk'];
			
			if(move_uploaded_file($_FILES['file']["tmp_name"], $folder))
			{
				if($this->m_sk->upload_file($id_syarat_sk, $nama_field, $nama_file_full, $tema_persetujuan))
				{
				    // Data Berhasil diinput
					unlink('templates/file/mahasiswa/syarat_sk/sk/'.$nama_file_lama);
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
			redirect('mahasiswa/sk');
		}else{
			redirect('mahasiswa/sk');
		}
	}
}