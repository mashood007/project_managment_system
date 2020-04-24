<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meterial_return extends CI_Controller {

  public function __construct()
	{
    parent::__construct();
 	$this->load->model(array(
 			'delivery_challan_dep/delivery_challan_model',
 			'delivery_challan_dep/cart_model',
 			'projects/meterial_return_model',
 			'projects/project_meterial_return_model',
 			'product/product_model',
 			'project_model'
 		));
	}

  public function create_mr($project_id)
  {
  	$logged_user = $this->current_user();
	$post['created_by'] = $logged_user['user_id'];
	$post['created_at'] = date("j F, Y, g:i a");	
	$post['updated_by'] = $logged_user['user_id'];
	$post['updated_at'] = date("j F, Y, g:i a");
	$post['project_id'] = $project_id;
	$id = $this->project_meterial_return_model->create($post);
	$this->meterial_return_model->meterialReturn($id);
	$this->session->set_flashdata('message', "New Meterial Return Created");
  }

  public function index($project_id)
  {
	$data['meterial_returns'] = $this->project_meterial_return_model->byProject($project_id);
	$data['project'] = $this->project_model->get_project($project_id);
	$this->load->view('layouts/header');
	$this->load->view('project/meterial_return/index', $data);
	$this->load->view('layouts/footer');	 	
  }

  public function add($project_id)
  {
  	$data['items'] = $this->meterial_return_model->tempItems();
	$data['project'] = $this->project_model->get_project($project_id);
	$data['products'] = $this->product_model->All();
	$this->load->view('layouts/header');
	$this->load->view('project/meterial_return/add', $data);
	$this->load->view('layouts/footer');  	
  }

  public function add_item()
  {
  	$post = $this->input->post();
  	$this->meterial_return_model->create($post);
  	$data['items'] = $this->meterial_return_model->tempItems();
  	$this->load->view('project/meterial_return/return_items', $data);
  }

  public function details($project_id)
  {
	$data['items'] = $this->meterial_return_model->byProject($project_id);
	$data['project'] = $this->project_model->get_project($project_id);
	$this->load->view('layouts/header');
	$this->load->view('project/meterial_return/details', $data);
	$this->load->view('layouts/footer');	 	
  }


  public function update($project_id)
  {
    $post = $this->input->post();
    $logged_user = $this->current_user();			
	$project = $this->project_model->get_project($project_id);;
	if ($project['mr_status'] < 1)
	{
			$post['mr_status'] = 1;
			$post['mr_returned_on'] = date("j F, Y, g:i a");
			$post['mr_returned_by'] = $logged_user['user_id'];
	}
	$res = $this->project_model->update($project_id, $post);
	$this->session->set_flashdata('message', "Meterial Return Updated");
	redirect('projects/meterial_return/details/'.$project_id, 'refresh');
  }

  public function update_qty($id)
  {
  	$post = $this->input->post();
  	$this->meterial_return_model->update($id, $post);
    $data['items'] = $this->meterial_return_model->tempItems();
  	$this->load->view('project/meterial_return/return_items', $data);
  }

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}

}
?>