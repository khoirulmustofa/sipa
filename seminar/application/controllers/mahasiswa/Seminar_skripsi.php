<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seminar_skripsi extends CI_Controller {
  public function index()
  {
    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('mahasiswa/seminar_skripsi');
    $this->load->view('templates/footer');
  }
}
