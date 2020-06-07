<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meterial_order extends CI_Controller {

  public function __construct()
	{
    parent::__construct();
 	$this->load->model(array(
 			
 			'projects/meterial_order_model',
 			'product/product_model',
 			'projects/meterial_order_cart_model',
 			'project_model'
 		));
	}

  public function report()
  {
	$data['meterial_orders'] = $this->meterial_order_model->all();
 	$this->load->view('layouts/header');
	$this->load->view('project/meterial_order/report', $data);
	$this->load->view('layouts/footer'); 	
  }

  public function send($id)
  {
  	$logged_user = $this->current_user();
 	$post['send_by'] = $logged_user['user_id'];
	$post['send_on'] = date("j F, Y, g:i a");
	$post['status'] = 1;
	$this->meterial_order_model->update($id, $post);
 	$data['meterial_orders'] = $this->meterial_order_model->all();
	$this->load->view('project/meterial_order/report_content', $data); 	
  }

  public function remove($id)
  {
  	$logged_user = $this->current_user();
 	$post['deleted_by'] = $logged_user['user_id'];
	$post['deleted_at'] = date("j F, Y, g:i a");
	$this->meterial_order_model->update($id, $post);
 	$data['meterial_orders'] = $this->meterial_order_model->all();
	$this->load->view('project/meterial_order/report_content', $data); 	
  }

  public function index($project_id)
  {
	$data['meterial_orders'] = $this->meterial_order_model->byProject($project_id);
	$data['project'] = $this->project_model->get_project($project_id);
	$this->load->view('layouts/header');
	$this->load->view('project/meterial_order/index', $data);
	$this->load->view('layouts/footer');	 	
  }

  public function add($project_id)
  {
  	$data['items'] = $this->meterial_order_cart_model->tempItems();
	$data['project'] = $this->project_model->get_project($project_id);
	$data['products'] = $this->product_model->All();
	$this->load->view('layouts/header');
	$this->load->view('project/meterial_order/add', $data);
	$this->load->view('layouts/footer');  	
  }


  public function info($project_id, $order_id)
  {
  	$data['items'] = $this->meterial_order_cart_model->items($order_id);
	$data['project'] = $this->project_model->get_project($project_id);
	$data['products'] = $this->product_model->All();
	$data['order_id'] = $order_id;
	$this->load->view('layouts/header');
	$this->load->view('project/meterial_order/info', $data);
	$this->load->view('layouts/footer');  	
  }

  public function create_order($project_id)
  {
  		$logged_user = $this->current_user();
  		$post = $this->input->post();
		$post['ordered_by'] = $logged_user['user_id'];
		$post['ordered_on'] = date("j F, Y, g:i a");	
		$post['project_id'] = $project_id;
		$post['status'] = 0;
		$id = $this->meterial_order_model->create($post);
		$this->meterial_order_cart_model->meterialOrder($id);
	    $this->session->set_flashdata('message', "New Meterial Order Created");
	    redirect('projects/meterial_order/index/'.$project_id, 'refresh');	
  }

  public function delete_item($id)
  {
   	$this->meterial_order_cart_model->delete($id);
  	$data['items'] = $this->meterial_order_cart_model->tempItems();
  	$this->load->view('project/meterial_order/items', $data); 	
  }

  public function add_item_to_order($order_id)
  {
  	$post = $this->input->post();
  	$post['meterial_order_id'] = $order_id;
  	$this->meterial_order_cart_model->create($post);
  	$data['items'] = $this->meterial_order_cart_model->items($order_id);
  	$this->load->view('project/meterial_order/order_items', $data);  	
  }

  public function add_item()
  {
  	$post = $this->input->post();
  	$this->meterial_order_cart_model->create($post);
  	$data['items'] = $this->meterial_order_cart_model->tempItems();
  	$this->load->view('project/meterial_order/items', $data);
  }

  public function update_qty($id)
  {
  	$post = $this->input->post();
  	$this->meterial_order_cart_model->update($id, $post);
  	$data['items'] = $this->meterial_order_cart_model->tempItems();
  	$this->load->view('project/meterial_order/items', $data);
  }

  public function update_qty_in_order($order_id, $id)
  {
  	$post = $this->input->post();
  	$this->meterial_order_cart_model->update($id, $post);
  	$data['items'] = $this->meterial_order_cart_model->items($order_id);
  	$this->load->view('project/meterial_order/order_items', $data);
  }
  

  public function copy_to_dc($project_id, $order_id)
  {
  	$this->meterial_order_model->copyToDc($project_id, $order_id);
  	$this->session->set_flashdata('message', "All the Items of the meterial order was copied to the delivery challan form");
  	redirect('/delivery_challan', 'refresh');	
  }

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}

}
?>