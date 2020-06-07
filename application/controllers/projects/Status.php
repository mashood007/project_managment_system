<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status extends CI_Controller {

  public function __construct()
	{
    parent::__construct();
 	$this->load->model(array(
 			
 			'projects/project_status_model',
 			'project_model',
 			'settings/status_model'
 		));
	}


	public function index($project_id)
	{
        $logged_user = $this->current_user();       
        if (count($this->permission_model->check(12, $logged_user['role'])) < 1)
        {
            redirect('home/no_permission');
        }
		$data['project']=$this->project_model->get_project($project_id);
		$data['statuses'] = $this->status_model->All();
		$project_status = $this->project_status_model->statusIds($project_id);
		$data['project_status'] = array_column($project_status,'status_id');
		$this->load->view('layouts/header');
		$this->load->view('project/status/index', $data);
		$this->load->view('layouts/footer');		
	}


	public function finish($project_id, $status_id)
	{

		$post['project_id'] = $project_id;
		$post['status_id'] = $status_id;
		$this->project_status_model->create($post);
		echo "Finished";
	}

	public function undo($project_id, $status_id)
	{

		$this->project_status_model->delete($project_id, $status_id);
		echo "Undo Finished";
	}
	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}
}
?>