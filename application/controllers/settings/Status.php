<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'settings/status_model'
 		));


}
	public function index()
	{
	    $logged_user = $this->current_user();       
        if ($logged_user['role'] != 1)
        {
            redirect('home/no_permission');
        }	
		$data['title']  = "Status Settings";
		$this->form_validation->set_rules('status',"Name",'required');
		if($this->form_validation->run() === true)
		{
			$post = $this->input->post();
			$post['created_by'] = $logged_user['user_id'];
			$post['created_at'] = date("j F, Y, g:i a");
			$res=$this->status_model->create($post);
			if($res)
			{
				$this->session->set_flashdata('message', "Status added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
			redirect('settings/status');
		}


		$data['statuses'] = $this->status_model->All();
		$this->load->view('layouts/header', $data);
		$this->load->view('settings/status/index', $data);
		$this->load->view('layouts/footer');
		
	}

	public function change_order($id)
	{
        $this->status_model->update($id,$this->input->post());
	}

	public function delete($id)
	{
        $logged_user = $this->current_user();
        $post['deleted_by'] = $logged_user['user_id'];
        $post['deleted_at'] = date("j F, Y, g:i a");
        $this->status_model->update($id,$post);
        echo $id;
	}

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}	

}