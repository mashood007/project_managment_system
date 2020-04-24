<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task_manager extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'TaskTo_model',
 			'Task_model'
 		)); 		
}


	public function index()
	{
		$logged_user = $this->current_user();
		$data['tasks_to'] = $this->TaskTo_model->AllTasksOfUser($logged_user['user_id']);

		$this->form_validation->set_rules('name',"Task Name",'required');
		$this->form_validation->set_rules('employee_id',"To",'required');

		if($this->form_validation->run() === true)
		{
			$post = $this->input->post();
			$post['created_by'] = $logged_user['user_id'];
			$post['created_at'] = date("j F, Y, g:i a");
			$res=$this->Task_model->create($post);
			if($res)
			{
				$this->session->set_flashdata('message', "Account added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
		}
		$data['tasks'] = $this->Task_model->TasksCreatedByMe($logged_user['user_id']);
		$this->load->view('layouts/header');
		$this->load->view('task_manager/make_task', $data);
		$this->load->view('layouts/footer');

	}

	public function my_tasks()
	{
		$logged_user = $this->current_user();
		$data['tasks'] = $this->Task_model->TasksAssignedToMe($logged_user['user_id']);
		$this->load->view('layouts/header');
		$this->load->view('task_manager/my_tasks', $data);
		$this->load->view('layouts/footer');		
	}


	public function finish_task()
	{
		$post = $this->input->post();
		$res=$this->Task_model->finish($post);
		if($res)
		{
			$this->session->set_flashdata('message', "Finished successfully");
		}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
		}
		redirect('/task_manager/my_tasks', 'refresh');


	}

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}


}