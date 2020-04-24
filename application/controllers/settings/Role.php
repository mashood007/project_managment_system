<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'settings/role_model'
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
		$data['title']  = "Add New Group";

		$this->form_validation->set_rules('designation',"Role",'required');
		if($this->form_validation->run() === true)
		{
			$res=$this->role_model->addRole($this->input->post());
			if($res)
			{
				$this->session->set_flashdata('message', "Role added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
			//redirect('group', $data);
		}


		$data['roles'] = $this->role_model->AllRoles();
		$this->load->view('layouts/header');
		$this->load->view('settings/role/index', $data);
		$this->load->view('layouts/footer');
		
	}

}