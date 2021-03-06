<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Business extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'settings/business_model'
 		));


}
	public function index()
	{

	    $logged_user = $this->current_user();       
        if ($logged_user['role'] != 1)
        {
            redirect('home/no_permission');
        }
        $data['title']  = "Business Settings";

		$this->form_validation->set_rules('company_name',"Company Name",'required');
		 $this->form_validation->set_rules('account_no', 'Account Number ', 'numeric'); 
		if($this->form_validation->run() === true)
		{
			$business = $this->business_model->business();
			$this->load->library('upload');

			$post = $this->input->post();

			
			$post['updated_by'] = $logged_user['user_id'];
			$post['updated_at'] = date("j F, Y, g:i a");

			//if nw rcrd
			$post['created_by'] = $logged_user['user_id'];
			$post['created_at'] = date("j F, Y, g:i a");
			//if nw rcrd

			//logo

		   $logo_path = $business['company_logo'];
	       $config = [
	            'upload_path'   => 'upload/business/company_logo/',
	            'allowed_types' => 'gif|jpg|png|jpeg|svg|ico', 
	            'overwrite'     => false,
	            'maintain_ratio' => true,
	            'encrypt_name'  => true,
	            'remove_spaces' => true,
	            'file_ext_tolower' => true 
	        ];
	        $this->upload->initialize($config);
	        if ( ! $this->upload->do_upload('company_logo'))
	        {
	            $data['error'] = array('error' => $this->upload->display_errors());
	            $error = $data['error'];
	         }
	        else
	        {
	        	$data = array('upload_data' => $this->upload->data());
	        	$logo_path = $this->upload->data('file_name');
	        }
	        $post['company_logo'] = $logo_path;			


	        //logo


	        //icon
		   $icon_path = $business['icon'];
	       $config = [
	            'upload_path'   => 'upload/business/icon/',
	            'allowed_types' => 'gif|jpg|png|jpeg|svg|ico', 
	            'overwrite'     => false,
	            'maintain_ratio' => true,
	            'encrypt_name'  => true,
	            'remove_spaces' => true,
	            'file_ext_tolower' => true 
	        ];
	        $this->upload->initialize($config);
	        if ( ! $this->upload->do_upload('icon'))
	        {
	            $data['error'] = array('error' => $this->upload->display_errors());
	         }
	        else
	        {
	        	$data = array('upload_data' => $this->upload->data());
	        	$icon_path = $this->upload->data('file_name');
	        }
	        $post['icon'] = $icon_path;		        
	        //icon


	        //favicon
		   $favicon_path = $business['favicon'];
	       $config = [
	            'upload_path'   => 'upload/business/favicon/',
	            'allowed_types' => 'gif|jpg|png|jpeg|svg|ico', 
	            'overwrite'     => false,
	            'maintain_ratio' => true,
	            'encrypt_name'  => true,
	            'remove_spaces' => true,
	            'file_ext_tolower' => true 
	        ];
	        $this->upload->initialize($config);
	        if ( ! $this->upload->do_upload('favicon'))
	        {
	            $data['error'] = array('error' => $this->upload->display_errors());
	         }
	        else
	        {
	        	$data = array('upload_data' => $this->upload->data());
	        	$favicon_path = $this->upload->data('file_name');
	        }
	        $post['favicon'] = $favicon_path;	
	        //favicon


	        //authorised_signature

		   $authorised_signature_path = $business['authorised_signature'];
	       $config = [
	            'upload_path'   => 'upload/business/authorised_signature/',
	            'allowed_types' => 'gif|jpg|png|jpeg|svg|ico', 
	            'overwrite'     => false,
	            'maintain_ratio' => true,
	            'encrypt_name'  => true,
	            'remove_spaces' => true,
	            'file_ext_tolower' => true 
	        ];
	        $this->upload->initialize($config);
	        if ( ! $this->upload->do_upload('authorised_signature'))
	        {
	            $data['error'] = array('error' => $this->upload->display_errors());
	         }
	        else
	        {
	        	$data = array('upload_data' => $this->upload->data());
	        	$authorised_signature_path = $this->upload->data('file_name');
	        }
	        $post['authorised_signature'] = $authorised_signature_path;		        
	        //authorised_signature



			$res = $this->business_model->update($post);
			if($res)
			{
				$this->session->set_flashdata('message', "Business updated successfully");
			}
			else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
		}

		$data['business'] = $this->business_model->business();
		$this->load->view('layouts/header');
		$this->load->view('settings/business/index', $data);
		$this->load->view('layouts/footer');
	}


	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}
}