<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marketing extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'Lead_model',
 			'settings/service_model',
 			'LeadService_model',
 			'employee_model',
 			'LeadFollow_model'
 		)); 		
}
	public function new_lead()
	{
		$photo_path = '';
        $id_proof_path = '';
		$logged_user = $this->current_user();
		$this->form_validation->set_rules('client_name',"Client Name",'required');		
		if($this->form_validation->run() === true)
		{

			$post = $this->input->post();
			$intrested_in =  $post['interested_in'];
			unset($post['interested_in']);
			$post['created_by'] = $logged_user['user_id'];
			$post['updated_by'] = $logged_user['user_id'];
			$post['created_at'] = date("j F, Y, g:i a");
			$post['updated_at'] = date("j F, Y, g:i a");
			$res=$this->Lead_model->addLead($post);
			if($res)
			{	$this->add_leads_services($intrested_in, $res);
				$this->session->set_flashdata('message', "New Customer added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}

		}
		$data['services'] = $this->service_model->AllServices();
		$this->load->view('layouts/header');
		$this->load->view('marketing/new_lead',$data);
		$this->load->view('layouts/footer');
		
	}

	public function inbox()
	{
		$this->load->view('layouts/header');
		$this->load->view('marketing/inbox');
		$this->load->view('layouts/footer');

	}

	public function advanced_inbox()
	{
		$logged_user = $this->current_user();
		$data['leads'] = $this->Lead_model->AllLeadsOfUser($logged_user['user_id']);
		$data['deployments'] = $this->employee_model->AllEmployees();
		$this->load->view('layouts/header');
		$this->load->view('marketing/advanced_inbox', $data);
		$this->load->view('layouts/footer');

	}

	public function lead_info($id)
	{
		$data['lead'] = $this->Lead_model->getLeadDetails($id);
		$data['services'] =$this->LeadService_model->getDetails($id);
		$data['lead_follows'] = $this->LeadFollow_model->getDetails($id);
		$this->load->view('layouts/header');
		$this->load->view('marketing/single_lead',$data);
		$this->load->view('layouts/footer');
	}

	public function rate_lead()
	{
		$post = $this->input->post();
		$res = $this->Lead_model->updateLeadStatus($this->input->post());
		echo json_encode($res);
	}

	public function assign_employee()
	{
		$post = $this->input->post();
		$res = $this->Lead_model->updateLeadFollow($this->input->post());
		//echo "tttt";
	}

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}

	private function add_leads_services($intrested_in, $lead)
	{
	  foreach ($intrested_in as $i)
		{
        	$l_s = array('lead_id' => $lead,'service_id' => $i);
			$this->LeadService_model->addLeadService($l_s);
		}
	}


}