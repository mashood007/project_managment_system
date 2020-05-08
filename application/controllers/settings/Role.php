<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'settings/role_model'
 		));


}
	public function index()
	{
		$data['title']  = "Add New Group";

		$this->form_validation->set_rules('designation',"Role",'required');
		if($this->form_validation->run() === true)
		{
			$res=$this->role_model->addRole($this->input->post());
			if($res)
			{
				$this->session->set_flashdata('message', "Role added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
			//redirect('group', $data);
		}


		$data['roles'] = $this->role_model->AllRoles();
		$this->load->view('layouts/header');
		$this->load->view('settings/role/index', $data);
		$this->load->view('layouts/footer');
		
	}


	public function delete($id)
    {
        $logged_user = $this->current_user();
        $post['deleted_by'] = $logged_user['user_id'];
        $post['deleted_at'] = date("j F, Y, g:i a");
        $this->role_model->update($id,$post);
        echo $id;
    }

    public function update($id)
    {
    	$post = $this->input->post();
        $this->role_model->update($id,$post);
    }

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}

}