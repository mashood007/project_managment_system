<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Non_sale_items extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'non_sale_item_model'
 		)); 		
}

 public function index()
 {
	$data['title'] = 'Non Sale Items';
	$data['items'] = $this->non_sale_item_model->all();
	$this->load->view('layouts/header', $data);
	$this->load->view('non_sale_items/index', $data);
	$this->load->view('layouts/footer');
 }

 public function add_item()
 {  $logged_user = $this->current_user();
 	$post = $this->input->post();
 	$post['created_by'] = $logged_user['user_id'];
	$post['updated_by'] = $logged_user['user_id'];
	$post['created_at'] = date("j F, Y, g:i a");
	$post['updated_at'] = date("j F, Y, g:i a");
	$this->form_validation->set_rules('name',"Product Name",'required');
	if($this->form_validation->run() === true)
	{
	  $res=$this->non_sale_item_model->create($post);
	  if($res)
	  {
		$this->session->set_flashdata('message', "Product added successfully");
	  }else{
		$this->session->set_flashdata('exception', "Something went wrong, please try again");
	  }
	}
	else
	{
		$this->session->set_flashdata('exception', "Product Name required");
	}
	redirect('non_sale_items');
 }

  public function delete($id)
  {
    $logged_user = $this->current_user();
    $post['deleted_by'] = $logged_user['user_id'];
    $post['deleted_at'] = date("j F, Y, g:i a");
    $this->non_sale_item_model->update($id,$post);
    echo $id;
  }

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}

}