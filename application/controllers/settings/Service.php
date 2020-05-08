<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'settings/service_model',
 			'settings/unit_model'
 		));


}
	public function index()
	{
		$data['title']  = "Service Settings";

		$this->form_validation->set_rules('service',"Name",'required');
		if($this->form_validation->run() === true)
		{
			$res=$this->service_model->addService($this->input->post());
			if($res)
			{
				$this->session->set_flashdata('message', "Service added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
		}


		$data['units'] = $this->unit_model->All();
		$this->load->view('layouts/header');
		$this->load->view('settings/service/index', $data);
		$this->load->view('layouts/footer');
		
	}

	public function delete($id)
	{
        $logged_user = $this->current_user();
        $post['deleted_by'] = $logged_user['user_id'];
        $post['deleted_at'] = date("j F, Y, g:i a");
        $this->service_model->update($id,$post);
        echo $id;
	}

	public function update($id)
	{
		$post = $this->input->post();
        $this->service_model->update($id,$post);
        redirect('settings/service/list_view');		
	}

	public function edit($id)
	{
		$data['units'] = $this->unit_model->All();
		$data['service'] = $this->service_model->FindById($id);
		$this->load->view('layouts/header');
		$this->load->view('settings/service/edit', $data);
		$this->load->view('layouts/footer');		
	}

	public function list_view()
	{
		$data['services'] = $this->service_model->AllServices();
		$this->load->view('layouts/header');
		$this->load->view('settings/service/list_view', $data);
		$this->load->view('layouts/footer');
	}

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}
}