<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meterial_delivery extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'delivery_challan_dep/delivery_challan_model',
 			'delivery_challan_dep/cart_model',
 			'projects/meterial_delivery_model',
 			'project_model'
 		));
}
	public function info($project_id)
	{
		$data['delivery_challan'] = $this->delivery_challan_model->AllProjectDcs($project_id);
		$data['project']=$this->project_model->get_project($project_id);
		$this->load->view('layouts/header');
		$this->load->view('project/meterial_delivery/index', $data);
		$this->load->view('layouts/footer');
	}

	public function checklist($dc_id)
	{
		$data['delivery_challan'] = $this->delivery_challan_model->getDetails($dc_id);
		$data['cart'] = $this->meterial_delivery_model->byDcId($dc_id);
		$this->load->view('layouts/header');
		$this->load->view('project/meterial_delivery/checklist', $data);
		$this->load->view('layouts/footer');		
	}

	public function update_check_list($dc_id)
	{
    	$post = $this->input->post();
    	$logged_user = $this->current_user();			
		$dc = $this->delivery_challan_model->getDetails($dc_id);
		if ($dc->delivery_status < 1)
		{
			$post['delivery_status'] = 1;
			$post['delivered_on'] = date("j F, Y, g:i a");
			$post['delivered_by'] = $logged_user['user_id'];
		}

		$res = $this->delivery_challan_model->update($dc_id, $post);
		$this->session->set_flashdata('message', "Checklist updated");
		redirect('/projects/meterial_delivery/info/'.$dc->delivery_for, 'refresh');
	}

	public function update_qty($dc_id, $id)
	{
		$post = $this->input->post();
		$this->meterial_delivery_model->updateQuantity($id, $post['quantity']);
		$data['cart'] = $this->meterial_delivery_model->byDcId($dc_id);
		$this->load->view('project/meterial_delivery/checklist_table', $data);
	}

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}

}
?>