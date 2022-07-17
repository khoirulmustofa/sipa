<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
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
			if(strcmp($_SESSION["status_login"], 'Tata Usaha')!==0 ){
				redirect('');
			}else{
				//dibolehkan
			}
		}

		$this->load->model('m_monitoring_sk');
		$this->load->library('ciqrcode');
		$this->load->library('pdfgenerator');
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
		$x['pencarian_data'] = $this->m_monitoring_sk->show_monitoring_sk();	
		$x['combobox_prodi'] = $this->m_monitoring_sk->combobox_prodi();

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('tu/monitoring_sk', $x);
		$this->load->view('templates/footer');

		unset($_SESSION['messege']);
	}

	public function persetujuan(){
		if(isset($_POST['tombolTolak'])){
			date_default_timezone_set('Asia/Jakarta');			
			$id_syarat_sk 		= addslashes($this->input->post('id_syarat_sk'));
			$pelaku 			= $_SESSION['nama'];
			$jabatan 			= 'Staff Tata Usaha Teknik';
			$status_persetujuan	= 'Berkas Ditolak';
			$tema_persetujuan	= 'Pengecekan Berkas Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha';
			$alasan_ditolak 	= $this->input->post('alasan_ditolak');
			$alasan = implode(", ", $alasan_ditolak); 
			if($this->m_monitoring_sk->persetujuan($id_syarat_sk, $pelaku, $jabatan, $status_persetujuan, $tema_persetujuan, $alasan))
			{
		    	// Data Berhasil diinput
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data Berhasil Ditolak..
				</div>');
				redirect('tu/monitoring_sk');
			}
			else{
				redirect('tu/monitoring_sk');
			}
		}elseif(isset($_POST['tombolSetuju'])){
			date_default_timezone_set('Asia/Jakarta');			
			$id_syarat_sk 		= addslashes($this->input->post('id_syarat_sk'));
			$pelaku 			= $_SESSION['nama'];
			$jabatan 			= 'Staff Tata Usaha Teknik';
			$status_persetujuan	= 'Berkas Disetujui';
			$tema_persetujuan	= 'Pengecekan Berkas Pengajuan SK Kerja Praktik Mahasiswa oleh Tata Usaha';
			$alasan_ditolak 	= ''; 
			if($this->m_monitoring_sk->persetujuan($id_syarat_sk, $pelaku, $jabatan, $status_persetujuan, $tema_persetujuan, $alasan)){
	    		// Data Berhasil diinput
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Data Berhasil disetujui..
				</div>');
				redirect('tu/monitoring_sk');
			}
			else{
				redirect('tu/monitoring_sk');
			}
		}
		else{
			redirect('tu/monitoring_sk');
		}
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
		
		$html = $this->load->view('tu/cetak_sk_pembimbing_kp',$this->data, true);

        // run dompdf
		$this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
		unlink("templates/img/qrcode/qrcode".$id_syarat_sk.".png");
		
	}

	public function setuju_berkas(){
		$id_syarat_sk 		= $_POST['id_syarat_sk'];
		$pelaku 			= $_SESSION['nama'];
		$jabatan 			= 'Staff Tata Usaha Teknik';
		$tema_persetujuan	= $_POST['tema_persetujuan'];
		$alasan_ditolak 	= ''; 
		$status_persetujuan = $_POST['status_persetujuan'];
		$this->m_monitoring_sk->setuju_berkas($id_syarat_sk, $pelaku, $jabatan, $tema_persetujuan, $alasan_ditolak, $status_persetujuan);
	}

	public function tolak_berkas(){
		$id_syarat_sk 		= $_POST['id'];
		$alasan_ditolak 	= $_POST['als'];
		$pelaku 			= $_SESSION['nama'];
		$jabatan 			= 'Staff Tata Usaha Teknik';
		$tema_persetujuan	= $_POST['tema'];
		$status_persetujuan = 'Berkas Ditolak';
		$this->m_monitoring_sk->setuju_berkas($id_syarat_sk, $pelaku, $jabatan, $tema_persetujuan, $alasan_ditolak, $status_persetujuan);
	}

	public function open_file()
	{
		$id_syarat_sk 		= $_POST['id_syarat_sk'];
		$pelaku 			= $_SESSION['nama'];
		$jabatan 			= 'Staff Tata Usaha Teknik';
		$file_open 			= $_POST['file_open'];
		$this->m_monitoring_sk->open_file($id_syarat_sk, $pelaku, $jabatan, $file_open);
	}

	public function akun_pembimbing_lapangan(){
		if(isset($_POST['tombolKirim'])){
			
			$id_syarat_sk 				= addslashes($this->input->post('id_syarat_sk'));
			$email_pembimbing_lapangan 	= addslashes($this->input->post('email_pembimbing_lapangan'));
			$nama_mahasiswa 			= addslashes($this->input->post('nama_mahasiswa'));
			$nama_pembimbing_lapangan 	= addslashes($this->input->post('nama_pembimbing_lapangan'));

			// echo $nama_mahasiswa; die();
			$string_random = $this->generateRandomString(10);
			if ($this->m_monitoring_sk->akun_pembimbing_lapangan($id_syarat_sk, $email_pembimbing_lapangan, $string_random)
				) {
				$this->send_email($nama_mahasiswa, $email_pembimbing_lapangan, $nama_pembimbing_lapangan, $string_random);
			$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Berhasil Mengirim Ulang Akun Pembimbing Lapangan!
			</div>');

		} else{
			$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Gagal Mengirim Ulang Akun Pembimbing Lapangan !
			</div>');
		}		
	}
	redirect('tu/monitoring_sk');
}

public function send_email($nama_mahasiswa, $email_pembimbing_lapangan, $nama_pembimbing_lapangan, $string_random){
	// public function send_email(){
	// echo $nama_mahasiswa; die();
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

		    // echo $nama_mahasiswa; die();
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

	function reset_persetujuan1(){
		if(isset($_POST['tombolReset'])){
			$id_syarat_sk = addslashes($this->input->post('id_syarat_sk'));
			if ($this->m_monitoring_sk->tombolResetPersetujuan1($id_syarat_sk)) {
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Persetujuan Berhasil di Reset !
				</div>');
			}else{
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Pemilihan Pembimbing Gagal di Reset!
				</div>');
			}				
		}
		redirect('tu/monitoring_sk');
	}

	function reset_persetujuan2(){
		if(isset($_POST['tombolReset'])){
			$id_syarat_sk = addslashes($this->input->post('id_syarat_sk'));
			if ($this->m_monitoring_sk->tombolResetPersetujuan2($id_syarat_sk)) {
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Persetujuan Berhasil di Reset !
				</div>');
			}else{
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Pemilihan Pembimbing Gagal di Reset!
				</div>');
			}				
		}
		redirect('tu/monitoring_sk');
	}

	function reset_persetujuan3(){
		if(isset($_POST['tombolReset'])){
			$id_syarat_sk = addslashes($this->input->post('id_syarat_sk'));
			if ($this->m_monitoring_sk->tombolResetPersetujuan3($id_syarat_sk)) {
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Persetujuan Berhasil di Reset !
				</div>');
			}else{
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Pemilihan Pembimbing Gagal di Reset!
				</div>');
			}				
		}
		redirect('tu/monitoring_sk');
	}

	function reset_persetujuan4(){
		if(isset($_POST['tombolReset'])){
			$id_syarat_sk = addslashes($this->input->post('id_syarat_sk'));
			if ($this->m_monitoring_sk->tombolResetPersetujuan4($id_syarat_sk)) {
				$this->session->set_flashdata('messege','<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Persetujuan Berhasil di Reset !
				</div>');
			}else{
				$this->session->set_flashdata('messege','<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Pemilihan Pembimbing Gagal di Reset!
				</div>');
			}				
		}
		redirect('tu/monitoring_sk');
	}
}

// $awal = date_create($tgl_upload_syarat_sk);
// $akhir = date_create(); 
// $diff = date_diff($awal, $akhir);