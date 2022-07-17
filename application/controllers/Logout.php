<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Logout extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->library('session');
  }

  function index()
  {
    $_SESSION = [];
    session_unset();
    session_destroy();

    redirect('');
    exit;
  }
}
