<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'settings/unit_model'
 		));
}
	public function index()
	{
	    $logged_user = $this->current_user();       
        if ($logged_user['role'] != 1)
        {
            redirect('home/no_permission');
        }
		$data['title']  = "Add New Group";
		$this->form_validation->set_rules('full_name',"Full Name",'required');
		$this->form_validation->set_rules('short_name',"Short Name",'required');		
		if($this->form_validation->run() === true)
		{
			$res=$this->unit_model->create($this->input->post());
			if($res)
			{
				$this->session->set_flashdata('message', "Unit added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
			redirect('settings/unit');
		}


		$data['units'] = $this->unit_model->All();
		$this->load->view('layouts/header', $data);
		$this->load->view('settings/unit/index', $data);
		$this->load->view('layouts/footer');
		
	}


	public function update($id)
	{
		$post = $this->input->post();
        $res = $this->unit_model->update($id,$post);
		if($res)
		{
			$this->session->set_flashdata('message', "Unit updated successfully");
		}else{
			$this->session->set_flashdata('exception', "Something went wrong, please try again");
		}
        redirect('settings/unit');
	}

	public function delete($id)
	{
        $logged_user = $this->current_user();
        $post['deleted_by'] = $logged_user['user_id'];
        $post['deleted_at'] = date("j F, Y, g:i a");
        $this->unit_model->update($id,$post);
        echo $id;
	}

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}

}