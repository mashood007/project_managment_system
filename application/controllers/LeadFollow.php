<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LeadFollow extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'Lead_model',
 			'LeadFollow_model'
 		)); 		
}


	public function add_new()
	{
		$logged_user = $this->current_user();
		$post = $this->input->post();
		$post['created_by'] = $logged_user['user_id'];
		$post['created_at'] = date("j F, Y, g:i a");
		$res=$this->LeadFollow_model->addLeadFollow($post);
		if($res)
		{
			$this->session->set_flashdata('message', "New Follow  added successfully");
		}else{
			$this->session->set_flashdata('exception', "Something went wrong, please try again");
		}
		redirect('/marketing/lead_info/'.$post['lead_id'], 'refresh');

	}

	public function delete($id)
	{
        $logged_user = $this->current_user();
        $post['deleted_by'] = $logged_user['user_id'];
        $post['deleted_at'] = date("j F, Y, g:i a");
        $this->LeadFollow_model->update($id,$post);
        echo $id;
	}

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}


}