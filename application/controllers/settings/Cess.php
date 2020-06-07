<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cess extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'settings/cess_model'
 		));
}
	public function index()
	{
	    $logged_user = $this->current_user();       
        if ($logged_user['role'] != 1)
        {
            redirect('home/no_permission');
        }
		$this->form_validation->set_rules('name',"Cess Name",'required');
		$this->form_validation->set_rules('cess',"Cess rate",'required');
		if($this->form_validation->run() === true)
		{
			$post = $this->input->post();
			$post['created_by'] = $logged_user['user_id'];
			$post['created_at'] = date("j F, Y, g:i a");

			$res=$this->cess_model->addCess($post);
			if($res)
			{
				$this->session->set_flashdata('message', "Cess added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
			redirect('settings/cess');
		}


		$data['cess'] = $this->cess_model->AllCess();
		$this->load->view('layouts/header');
		$this->load->view('settings/cess/index', $data);
		$this->load->view('layouts/footer');
		
	}

	public function update()
	{
		$post = $this->input->post();
		if ($post['cess'] != '' && $post['name'] != '' && $post['id'] != '')
		{
		$res=$this->cess_model->updateCess($post);
		}
		else
		{
			echo "error";
		}
	}

	public function delete($id)
	{
        $logged_user = $this->current_user();
        $post['deleted_by'] = $logged_user['user_id'];
        $post['deleted_at'] = date("j F, Y, g:i a");
        $this->cess_model->update($id,$post);
        echo $id;
	}

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}
}