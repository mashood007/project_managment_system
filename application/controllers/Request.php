<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'employee_model',
 			'RequestsTo_model',
 			'requests_model'
 		));


}
	public function index()
	{
		$logged_user = $this->current_user();
		if (count($this->permission_model->check(38, $logged_user['role'])) < 1)
		{
			redirect('home/no_permission');
		}
		$data['title']  = "Make a request";

		$this->form_validation->set_rules('employee_id',"Employee Name",'required');
		if($this->form_validation->run() === true)
		{
			$post = $this->input->post();
			$post['created_by'] = $logged_user['user_id'];
			$post['created_at'] = date("j F, Y, g:i a");
			$res=$this->requests_model->create($post);
			if($res)
			{
				$this->session->set_flashdata('message', "Requested successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
		}


		$data['employees'] = $this->RequestsTo_model->AllRecordsOfUser($logged_user['user_id']);
		$data['all_records'] = $this->requests_model->AllReqestsbyUser($logged_user['user_id']);
		$this->load->view('layouts/header');
		$this->load->view('requests/make_request', $data);
		$this->load->view('layouts/footer');
		
	}

	public function delete($id)
	{
		$this->requests_model->delete($id);
		$this->session->set_flashdata('message', "Request Canceled successfully");
		redirect('/request', 'refresh');
	}

	public function status($id, $status_id)
	{
		$this->requests_model->changeStatus($id, $status_id);
		$this->session->set_flashdata('message', "Request Canceled successfully");
		redirect('/request/inbox', 'refresh');
	}

	public function inbox()
	{
		$logged_user = $this->current_user();
		if (count($this->permission_model->check(39, $logged_user['role'])) < 1)
		{
			redirect('home/no_permission');
		}
		$data['title']  = "Requests";
		$data['all_records'] = $this->requests_model->AllReqestsToUser($logged_user['user_id']);
		$this->load->view('layouts/header');
		$this->load->view('requests/request', $data);
		$this->load->view('layouts/footer');
		
	}

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}


}