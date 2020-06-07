<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_Schedule extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'project_model',
 			'project_schedule_model'
 		)); 		
}


	public function add($project_id)
	{
		$logged_user = $this->current_user();
		$post = $this->input->post();
		$this->form_validation->set_rules('schedule_time',"Time",'required');
		$this->form_validation->set_rules('schedule_date',"Date",'required');
		if($this->form_validation->run() === true)
		{		
			$post['project_id'] = $project_id;
			$post['created_by'] = $logged_user['user_id'];
			$res=$this->project_schedule_model->create($post);
			if($res)
			{
				$this->session->set_flashdata('message', "New Schedule  added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
		}
		
		redirect('/project/project_info/'.$project_id, 'refresh');

	}

	public function delete($id)
	{
        $logged_user = $this->current_user();
        $post['deleted_by'] = $logged_user['user_id'];
        $post['deleted_at'] = date("j F, Y, g:i a");
        $this->project_schedule_model->update($id,$post);
        echo $id;
	}

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}


}