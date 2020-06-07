<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meterial_usage extends CI_Controller {

  public function __construct()
	{
    parent::__construct();
 	$this->load->model(array(
 			
 			'projects/project_meterial_usage_model',
 			'projects/meterial_usage_model',
 			'product/product_model',
 			'project_model'
 		));
	}

  public function index($project_id)
  {
	$data['meterial_usages'] = $this->project_meterial_usage_model->byProject($project_id);
	$data['project'] = $this->project_model->get_project($project_id);
	$this->load->view('layouts/header');
	$this->load->view('project/meterial_usage/index', $data);
	$this->load->view('layouts/footer');	 	
  }

  public function add($project_id)
  {
  	$data['items'] = $this->meterial_usage_model->tempItems();
	$data['project'] = $this->project_model->get_project($project_id);
	$data['products'] = $this->product_model->All();
	$this->load->view('layouts/header');
	$this->load->view('project/meterial_usage/add', $data);
	$this->load->view('layouts/footer');  	
  }

  public function create_mu($project_id)
  {
  		$logged_user = $this->current_user();
		$post['created_by'] = $logged_user['user_id'];
		$post['created_at'] = date("j F, Y, g:i a");	
		$post['updated_by'] = $logged_user['user_id'];
		$post['updated_at'] = date("j F, Y, g:i a");
		$post['project_id'] = $project_id;
		$mu_id = $this->project_meterial_usage_model->create($post);
		$this->meterial_usage_model->meterialUsage($mu_id);
	    $this->session->set_flashdata('message', "New Meterial Usage Created");
	 //   redirect('projects/meterial_usage/index/'.$project_id, 'refresh');		
  }


  public function add_item()
  {
  	$post = $this->input->post();
  	$this->meterial_usage_model->create($post);
  	$data['items'] = $this->meterial_usage_model->tempItems();
  	$this->load->view('project/meterial_usage/used_items', $data);
  }

  public function details($project_id)
  {
	$data['items'] = $this->meterial_usage_model->byProject($project_id);
	$data['project'] = $this->project_model->get_project($project_id);
	$this->load->view('layouts/header');
	$this->load->view('project/meterial_usage/details', $data);
	$this->load->view('layouts/footer');	 	
  }


  public function update($project_id)
  {
    $post = $this->input->post();
    $logged_user = $this->current_user();			
	$project = $this->project_model->get_project($project_id);;
	if ($project['mu_status'] < 1)
	{
			$post['mu_status'] = 1;
			$post['mu_submitted_on'] = date("j F, Y, g:i a");
			$post['mu_submitted_by'] = $logged_user['user_id'];
	}
	$res = $this->project_model->update($project_id, $post);
	$this->session->set_flashdata('message', "Meterial Usage Updated");
	redirect('projects/meterial_usage/details/'.$project_id, 'refresh');
  }

  public function update_qty($id)
  {
  	$post = $this->input->post();
  	$this->meterial_usage_model->update($id, $post);
  	$data['items'] = $this->meterial_usage_model->tempItems();
  	$this->load->view('project/meterial_usage/used_items', $data);
  }

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}

}
?>