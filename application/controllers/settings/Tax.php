<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tax extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'settings/tax_model'
 		));
}
	public function index()
	{
		$logged_user = $this->current_user();
		$this->form_validation->set_rules('name',"Tax Name",'required');
		$this->form_validation->set_rules('tax',"Tax rate",'required');
		if($this->form_validation->run() === true)
		{
			$post = $this->input->post();
			$post['created_by'] = $logged_user['user_id'];
			$post['created_at'] = date("j F, Y, g:i a");

			$res=$this->tax_model->addTax($post);
			if($res)
			{
				$this->session->set_flashdata('message', "Tax added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
		}


		$data['tax'] = $this->tax_model->AllTaxs();
		$this->load->view('layouts/header');
		$this->load->view('settings/tax/index', $data);
		$this->load->view('layouts/footer');
		
	}

	public function update()
	{
		$post = $this->input->post();
		if ($post['tax'] != '' && $post['name'] != '' && $post['id'] != '')
		{
		// $post['created_by'] = $logged_user['user_id'];
		// $post['created_at'] = date("j F, Y, g:i a");
		$res=$this->tax_model->updateTax($post);
		}
		else
		{
			echo "error";
		}
	}

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}
}