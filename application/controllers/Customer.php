<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'customer_model'
 		)); 		
}
	public function add_customer()
	{
		$photo_path = '';
        $id_proof_path = '';
        $this->load->library('upload');
        $post = $this->input->post();
       $config = [
            'upload_path'   => 'upload/customer_photo',
            'allowed_types' => 'gif|jpg|png|jpeg|pdf', 
            'overwrite'     => false,
            'maintain_ratio' => true,
            'encrypt_name'  => true,
            'remove_spaces' => true,
            'file_ext_tolower' => true 
        ];

        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload('user_image'))
        {
            $error = array('error' => $this->upload->display_errors());

         }
        else
        {
        $data = array('upload_data' => $this->upload->data());
        $photo_path = $this->upload->data('file_name');
        }

        if ($photo_path =='')
        {
            $this->form_validation->set_rules('user_image',"Photo",'required');
        }


		$logged_user = $this->current_user();		
		$this->form_validation->set_rules('full_name',"Full Name",'required');
		$this->form_validation->set_rules('user_name',"User Name",'required');
		$this->form_validation->set_rules('password',"Password",'required');
		if($this->form_validation->run() === true)
		{



       $config = [
            'upload_path'   => 'upload/customer_id_proof',
            'allowed_types' => 'gif|jpg|png|jpeg|pdf', 
            'overwrite'     => false,
            'maintain_ratio' => true,
            'encrypt_name'  => true,
            'remove_spaces' => true,
            'file_ext_tolower' => true 
        ];
                $this->upload->initialize($config);

                if ( ! $this->upload->do_upload('id_proof'))
                {
                        $error = array('error' => $this->upload->display_errors());
                }
                else
                {
                    $data = array('upload_data' => $this->upload->data());
                    $id_proof_path = $this->upload->data('file_name');
                }


			$post = $this->input->post();
			$post['created_by'] = $logged_user['user_id'];
			$post['created_at'] = date("j F, Y, g:i a");	
			$post['updated_by'] = $logged_user['user_id'];
			$post['updated_at'] = date("j F, Y, g:i a");	
			$post['photo'] = $photo_path;
			$post['id_proof'] = $id_proof_path;
			$res=$this->customer_model->addCustomer($post);
			if($res)
			{
				$this->session->set_flashdata('message', "New Customer added successfully ");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again ");
			}

		}

		$this->load->view('layouts/header');
		$this->load->view('customer/add_customer');
		$this->load->view('layouts/footer');
		
	}

	public function index()
	{
		$data['customers']=$this->customer_model->AllCustomers();
		$this->load->view('layouts/header');
		$this->load->view('customer/index', $data);
		$this->load->view('layouts/footer');

	}

	public function profile_info()
	{
		$this->load->view('layouts/header');
		$this->load->view('customer/profile_info');
		$this->load->view('layouts/footer');
	}

    public function delete($id)
    {
        $logged_user = $this->current_user();
        $post['deleted_by'] = $logged_user['user_id'];
        $post['deleted_at'] = date("j F, Y, g:i a");
        $this->customer_model->update($id,$post);
        echo $id;
    }

    public function active($id)
    {
        $post['active'] = true;
        $this->customer_model->update($id,$post);
        $data['row'] = $this->customer_model->getDetails($id);
        $this->load->view('customer/row', $data);       
    }

    public function inactive($id)
    {
        $post['active'] = false;
        $this->customer_model->update($id,$post);
        $data['row'] = $this->customer_model->getDetails($id);
        $this->load->view('customer/row', $data);           
    }

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}

}