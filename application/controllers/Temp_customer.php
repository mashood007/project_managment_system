<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Temp_customer extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'tempCustomer_model'
 		));
 		

}
	public function Add()
	{

		$res=$this->tempCustomer_model->addCustomer($this->input->post());
		echo $res;
	}

}