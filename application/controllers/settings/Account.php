<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'settings/account_model'
 		));
 		
 	// 	if (!$this->session->userdata('isAdmin')) 
  //       redirect('logout');
        
		// if (!$this->session->userdata('isLogin') 
		// 	&& !$this->session->userdata('isAdmin'))
		// 	redirect('admin');
 	// }
//    $this->load->helper('url');

}
	public function index()
	{
		$this->form_validation->set_rules('name',"Account Name",'required');
		if($this->form_validation->run() === true)
		{
			$res=$this->account_model->addAccount($this->input->post());
			if($res)
			{
				$this->session->set_flashdata('message', "Account added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
		}


		$data['accounts'] = $this->account_model->AllAccounts();
		$this->load->view('layouts/header');
		$this->load->view('settings/account/index', $data);
		$this->load->view('layouts/footer');
		
	}

}