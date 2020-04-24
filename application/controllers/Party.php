<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Party extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'party_model'
 		)); 		
}
	public function new_party()
	{
		$photo_path = '';
        $id_proof_path = '';
        $this->load->library('upload');
		$logged_user = $this->current_user();		
		$this->form_validation->set_rules('name',"Company Name",'required');
		$this->form_validation->set_rules('mobile1',"Mobile 1",'required');
		if($this->form_validation->run() === true)
		{

       $config = [
            'upload_path'   => 'upload/party_photo/',
            'allowed_types' => 'gif|jpg|png|jpeg', 
            'overwrite'     => false,
            'maintain_ratio' => true,
            'encrypt_name'  => true,
            'remove_spaces' => true,
            'file_ext_tolower' => true 
        ];

        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload('photo'))
        {
            $error = array('error' => $this->upload->display_errors());
         }
        else
        {
        $data = array('upload_data' => $this->upload->data());
        $photo_path = $this->upload->data('file_name');
        }

       $config = [
            'upload_path'   => 'upload/party_id_proof',
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
			$post['updated_by'] = $logged_user['user_id'];
			$post['created_at'] = date("j F, Y, g:i a");
			$post['updated_at'] = date("j F, Y, g:i a");			
			$post['photo'] = $photo_path;
			$post['id_proof'] = $id_proof_path;
			$res=$this->party_model->add($post);
			if($res)
			{
				$this->session->set_flashdata('message', "New Party/Company added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}

		}

		$this->load->view('layouts/header');
		$this->load->view('party/new');
		$this->load->view('layouts/footer');
		
	}

	public function index()
	{
		$data['parties']=$this->party_model->All();
		$this->load->view('layouts/header');
		$this->load->view('party/index', $data);
		$this->load->view('layouts/footer');

	}

	public function profile_info()
	{
		$this->load->view('layouts/header');
		$this->load->view('party/profile_info');
		$this->load->view('layouts/footer');
	}

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}

}