<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'settings/account_model'
 		));
 		

}
	public function index()
	{
	    $logged_user = $this->current_user();       
        if ($logged_user['role'] != 1)
        {
            redirect('home/no_permission');
        }
		$this->form_validation->set_rules('name',"Account Name",'required');
		if($this->form_validation->run() === true)
		{
			$res=$this->account_model->addAccount($this->input->post());
			if($res)
			{
				$this->session->set_flashdata('message', "Account added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
			redirect('settings/account');
		}


		$data['accounts'] = $this->account_model->AllAccounts();
		$this->load->view('layouts/header');
		$this->load->view('settings/account/index', $data);
		$this->load->view('layouts/footer');
		
	}

	public function update($id)
	{
		$post = $this->input->post();
        $res = $this->account_model->update($id,$post);
		if($res)
		{
			$this->session->set_flashdata('message', "Account updated successfully");
		}else{
			$this->session->set_flashdata('exception', "Something went wrong, please try again");
		}
        redirect('settings/account');
	}

	public function delete($id)
	{
        $logged_user = $this->current_user();
        $post['deleted_by'] = $logged_user['user_id'];
        $post['deleted_at'] = date("j F, Y, g:i a");
        $this->account_model->update($id,$post);
        echo $id;
	}

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}
}