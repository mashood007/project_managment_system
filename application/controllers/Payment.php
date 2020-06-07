<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

  public function __construct()
	{
    parent::__construct();
		
	}
  public function index()
  {
		$this->load->view('layouts/header');
		$this->load->view('payments/index');
		$this->load->view('layouts/footer');  	
  }
}
?>