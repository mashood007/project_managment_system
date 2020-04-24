<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

  public function __construct()
	{
    parent::__construct();
 	$this->load->model(array(
 			'Project_model',
 			'settings/service_model',
 			'Customer_model',
 			'TaskTo_model',
 			'settings/job_model',
 			'ProjectJob_model',
 			'employee_model'
 		)); 		
	}


	public function install_project()
	{
		$data['deployments'] = $this->employee_model->AllEmployees();
		$logged_user = $this->current_user();
		$post = $this->input->post();
		$post['created_by'] = $logged_user['user_id'];
		$post['created_at'] = date("j F, Y, g:i a");
		$post['updated_by'] = $logged_user['user_id'];
		$post['updated_at'] = date("j F, Y, g:i a");
		$this->load->library('upload');


		$data['customers']=$this->Customer_model->AllCustomers();
		$data['services'] = $this->service_model->AllServices();
		$data['projects']=$this->Project_model->AllProjects();


		$this->form_validation->set_rules('name',"Name",'required');
		$this->form_validation->set_rules('customer_id',"Customer Name",'required');
		$this->form_validation->set_rules('price',"Price",'required');
		if($this->form_validation->run() === true)
		{
		   $logo_path = '';
	       $config = [
	            'upload_path'   => 'upload/project_logo/',
	            'allowed_types' => 'gif|jpg|png|jpeg', 
	            'overwrite'     => false,
	            'maintain_ratio' => true,
	            'encrypt_name'  => true,
	            'remove_spaces' => true,
	            'file_ext_tolower' => true 
	        ];
	        $this->upload->initialize($config);
	        if ( ! $this->upload->do_upload('logo'))
	        {
	            $error = array('error' => $this->upload->display_errors());
	         }
	        else
	        {
	        	$data = array('upload_data' => $this->upload->data());
	        	$logo_path = $this->upload->data('file_name');
	        }
	        $post['logo'] = $logo_path;
			$res=$this->Project_model->insert($post);
			if($res)
			{
				$this->session->set_flashdata('message', "New Follow  added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
		}
			$this->load->view('layouts/header');
			$this->load->view('project/install_project', $data);
			$this->load->view('layouts/footer');
	}

	public function index()
	{
		$this->load->view('layouts/header');
		$this->load->view('project/install_project', $data);
		$this->load->view('layouts/footer');		
	}

	public function project_info($id)
	{
		$data['project']=$this->Project_model->get_project($id);
		$data['project_completed_jobs']=$this->ProjectJob_model->ProjectCompletedJobs($id);
		$data['project_pending_jobs']=$this->ProjectJob_model->ProjectPendingJobs($id);

		$this->load->view('layouts/header');
		$this->load->view('project/single_project', $data);
		$this->load->view('layouts/footer');		
	}

	public function new_job($id)
	{
		$logged_user = $this->current_user();
			
		$this->form_validation->set_rules('job_id',"Job",'required');
		$this->form_validation->set_rules('project_id',"Project",'required');
		$this->form_validation->set_rules('to',"To",'required');
		$this->form_validation->set_rules('description',"Description",'required');
		$post = $this->input->post();
		$id = !empty($id)? $id : $post['project_id'];
		if($this->form_validation->run() === true)
		{
		
		$post['created_by'] = $logged_user['user_id'];
		$post['created_at'] = date("j F, Y, g:i a");
		$post['updated_by'] = $logged_user['user_id'];
		$post['updated_at'] = date("j F, Y, g:i a");
		$res = $this->ProjectJob_model->create($post);
		if($res)
		{
			$this->session->set_flashdata('message', "New Job added successfully");
		}else{
			$this->session->set_flashdata('exception', "Something went wrong, please try again");
		}
		redirect('project/project_info/'.$id);
		}

		$data['project']=$this->Project_model->get_project($id);
		$data['jobs'] = $this->job_model->AllJobs();
		$data['employees']=$this->TaskTo_model->AllTasksOfUser($logged_user['user_id']);
		$data['project_id'] = $id;
		$this->load->view('layouts/header');
		$this->load->view('project/new_job', $data);
		$this->load->view('layouts/footer');
	}

	public function finish_job()
	{
		$post = $this->input->post();
		$res = $this->ProjectJob_model->finishProjectJob($post);
	}

	public function undo_finished_job()
	{
		$post = $this->input->post();
		$res = $this->ProjectJob_model->pendingProjectJob($post);		
	}

	public function completed_jobs()
	{
		$post = $this->input->post();
		$data['project_completed_jobs']=$this->ProjectJob_model->ProjectCompletedJobs($post['project_id']);
		echo $this->load->view('project/project_completed_jobs', $data);
	}

	public function pending_jobs()
	{
		$post = $this->input->post();
		$data['project_pending_jobs']=$this->ProjectJob_model->ProjectPendingJobs($post['project_id']);
		echo $this->load->view('project/project_pending_jobs', $data);
	}

	public function assign_employee()
	{
		$post = $this->input->post();
		$res = $this->Project_model->updateProjectFollow($this->input->post());
	}

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}


}