<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validasi_ttd_digital extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_validasi_ttd');
	}

	public function cek($id_random = null)
	{
		// echo $data; die();

		$x['getDataValidasi'] = $this->m_validasi_ttd->getDataValidasi($id_random);
		$this->load->view('templates/header');
		$this->load->view('validasi_ttd_digital', $x);
		unset($_SESSION['messege']);

	}

	public function cek_prodi($id_random = null)
	{
		// echo $data; die();

		$x['getDataValidasi'] = $this->m_validasi_ttd->getDataValidasi($id_random);
		$this->load->view('templates/header');
		$this->load->view('validasi_ttd_digital', $x);
		unset($_SESSION['messege']);

	}

	public function cek_fakultas($id_random = null)
	{
		// echo $data; die();

		$x['getDataValidasi'] = $this->m_validasi_ttd->getDataValidasiFakultas($id_random);
		$x['getDataValidasiPengantarFakultas'] = $this->m_validasi_ttd->getDataValidasiPengantarFakultas($id_random);
		$this->load->view('templates/header');
		$this->load->view('validasi_ttd_digital', $x);
		unset($_SESSION['messege']);

	}

}
?>