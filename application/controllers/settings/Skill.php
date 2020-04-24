<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skill extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'settings/skill_model'
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
		$data['title']  = "Skill Settings";

		$this->form_validation->set_rules('skill',"Skill",'required');
		if($this->form_validation->run() === true)
		{
			$res=$this->skill_model->addSkill($this->input->post());
			if($res)
			{
				$this->session->set_flashdata('message', "Skill added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
		}


		$data['skills'] = $this->skill_model->AllSkills();
		$this->load->view('layouts/header');
		$this->load->view('settings/skill/index', $data);
		$this->load->view('layouts/footer');
		
	}

}