<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'settings/unit_model'
 		));
}
	public function index()
	{
		$data['title']  = "Add New Group";

		$this->form_validation->set_rules('full_name',"Full Name",'required');
		$this->form_validation->set_rules('short_name',"Short Name",'required');		
		if($this->form_validation->run() === true)
		{
			$res=$this->unit_model->create($this->input->post());
			if($res)
			{
				$this->session->set_flashdata('message', "Unit added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
			//redirect('group', $data);
		}


		$data['units'] = $this->unit_model->All();
		$this->load->view('layouts/header');
		$this->load->view('settings/unit/index', $data);
		$this->load->view('layouts/footer');
		
	}
	public function tst()
	{
		$this->load->view('layouts/header');
		$this->load->view('test/new_lead');
		$this->load->view('layouts/footer');
	}
}