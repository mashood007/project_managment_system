<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Party extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'party_model',
 			'CustomerAccount_model',
 			'invoice/sales_model',
 			'invoice/salesreturn_model',
 			'invoice/purchase_model',
 			'invoice/purchase_return_model' 			
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
        $this->form_validation->set_rules('mobile1', 'Mobile', 'is_unique[party.mobile1]');
        $this->form_validation->set_rules('user_name', 'User Name', 'is_unique[party.user_name]');
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
			redirect('party/new_party');
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

	public function profile_info($id)
	{

        if ($id == "")
        {
            redirect('/party');
        }
        $data['party'] = $this->party_model->getDetails($id);
		$balance = 0;
		$payments = $this->CustomerAccount_model->partyPayments($id);
		$reciepts = $this->CustomerAccount_model->partyReciepts($id);
		$invoices = $this->sales_model->partyInvoices($id);
		$purchases = $this->purchase_model->partyPurchases($id);
		foreach ($purchases as $row) {
		    $balance = $balance - $row['cash_paid'] + $row['total'];
		    $purchase_return = $this->purchase_return_model->purchaseReturn($row['id']);
		    foreach ($purchase_return as $row_1) {
		      $balance = $balance - $row_1['total'] + $row_1['cash_recieved'];
		    }					
		}
		foreach ($invoices as $row) {
	       $balance = $balance + $row['cash_recieved'] - $row['total'];
	       $sales_return = $this->salesreturn_model->invoiceReturn($row['id']);
	       foreach ($sales_return as $row_1) {
	         $balance = $balance + $row_1['total']	- $row_1['cash_refund'];
	       }
	    }
	    $data['balance'] = $balance + $reciepts - $payments; 
		$this->load->view('layouts/header');
		$this->load->view('party/profile_info', $data);
		$this->load->view('layouts/footer');
	}

	public function edit($id)
	{
		if ($id == "")
		{
			redirect('/party');
		}
		$data['party'] = $this->party_model->getDetails($id);
		$photo_path = $data['party']['photo'];
        $id_proof_path = $data['party']['id_proof'];
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
			if ($photo_path == "")
			{
				$photo_path = $data['party']['photo'];
			}
			if ($id_proof_path == "")
			{
        		$id_proof_path = $data['party']['id_Proof'];
			}			
			$post['photo'] = $photo_path;
			$post['id_proof'] = $id_proof_path;
			$res=$this->party_model->update($id, $post);
			if($res)
			{
				$this->session->set_flashdata('message', "Party/Company Updated successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
		redirect('/party');
		}

		$this->load->view('layouts/header');
		$this->load->view('party/edit', $data);
		$this->load->view('layouts/footer');		
	}

    public function delete($id)
    {
        $logged_user = $this->current_user();
        $post['deleted_by'] = $logged_user['user_id'];
        $post['deleted_at'] = date("j F, Y, g:i a");
        $this->party_model->update($id,$post);
        echo $id;
    }

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}

}