<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'settings/service_model',
 			'settings/unit_model'
 		));


}
	public function index()
	{
		$data['title']  = "Service Settings";

		$this->form_validation->set_rules('service',"Name",'required');
		if($this->form_validation->run() === true)
		{
			$res=$this->service_model->addService($this->input->post());
			if($res)
			{
				$this->session->set_flashdata('message', "Service added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
		}


		$data['units'] = $this->unit_model->All();
		$data['services'] = $this->service_model->AllServices();
		$this->load->view('layouts/header');
		$this->load->view('settings/service/index', $data);
		$this->load->view('layouts/footer');
		
	}

}