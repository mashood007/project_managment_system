<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'settings/job_model'
 		));


}
	public function index()
	{
		$data['title']  = "Job Settings";

		$this->form_validation->set_rules('job',"Name",'required');
		if($this->form_validation->run() === true)
		{
			$res=$this->job_model->addJob($this->input->post());
			if($res)
			{
				$this->session->set_flashdata('message', "Job added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
		}


		$data['jobs'] = $this->job_model->AllJobs();
		$this->load->view('layouts/header');
		$this->load->view('settings/job/index', $data);
		$this->load->view('layouts/footer');
		
	}

	public function delete($id)
	{
        $logged_user = $this->current_user();
        $post['deleted_by'] = $logged_user['user_id'];
        $post['deleted_at'] = date("j F, Y, g:i a");
        $this->job_model->update($id,$post);
        echo $id;
	}

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}	

}