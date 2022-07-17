<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Logout extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->library('session');
  }
  
  function index(){
    $_SESSION = [];
    session_unset();
    session_destroy();
     // echo str_replace("seminar/", "", base_url()); die();
    echo '<script type"text/javascript">';
    echo 'window.location.href="'.str_replace("seminar/", "", base_url()).'"';
    echo '</script>';

    exit;
  }
}