<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skill extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'settings/skill_model'
 		));
 		
}
	public function index()
	{
		$data['title']  = "Skill Settings";

		$this->form_validation->set_rules('skill',"Skill",'required');
		if($this->form_validation->run() === true)
		{
			$res=$this->skill_model->addSkill($this->input->post());
			if($res)
			{
				$this->session->set_flashdata('message', "Skill added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
		}


		$data['skills'] = $this->skill_model->AllSkills();
		$this->load->view('layouts/header');
		$this->load->view('settings/skill/index', $data);
		$this->load->view('layouts/footer');
		
	}

	public function delete($id)
	{
        $logged_user = $this->current_user();
        $post['deleted_by'] = $logged_user['user_id'];
        $post['deleted_at'] = date("j F, Y, g:i a");
        $this->skill_model->update($id,$post);
        echo $id;		
	}

	public function update($id)
	{
		$post = $this->input->post();
        $this->skill_model->update($id,$post);
	}

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}
}