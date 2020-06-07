<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marketing extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'Lead_model',
 			'settings/service_model',
 			'LeadService_model',
 			'employee_model',
 			'LeadFollow_model',
 			'lead_schedule_model',
 			'invoice/tempsales_model',
 			'customer_model',
 			'invoice/sales_model',
 			'invoice/salesestimate_model'
 		)); 		
}
	public function new_lead()
	{
		$logged_user = $this->current_user();
		if (count($this->permission_model->check(1, $logged_user['role'])) < 1)
		{
			redirect('home/no_permission');
		}
		$post = $this->input->post();
		$this->form_validation->set_rules('est_price',"Estimate Price",'required');	
		if ($post['user_type_radio'] == 'temp')	
		{
			$this->form_validation->set_rules('client_name',"Client Name",'required');	
			$this->form_validation->set_rules('phone',"Phone",'required');	
   		    $this->form_validation->set_rules('phone', 'Phone', 'is_unique[customers.mobile1]');

		}
		else
		{
			$this->form_validation->set_rules('customer_id',"Client Name",'required');	
			
		}
		if($this->form_validation->run() === true)
		{
			if ($post['user_type_radio'] == 'temp')
			{
				$custom['full_name'] = $post['client_name'];
				$custom['mobile1'] = $post['phone'];
				$custom['whatsapp'] = $post['whatsapp'];
				$custom['email'] = $post['email'];
				$custom['type'] = 'temp';
				$cust = $this->customer_model->addCustomer($custom);
				if (!$cust)
				{
					$this->session->set_flashdata('exception', "Something went wrong, please try again");
				}
				$post['customer_id'] = $cust;
			}

			unset($post['client_name']);
			unset($post['email']);
			unset($post['whatsapp']);
			unset($post['phone']);
			unset($post['user_type_radio']);
			$intrested_in =  $post['interested_in'];
			unset($post['interested_in']);
			$post['created_by'] = $logged_user['user_id'];
			$post['updated_by'] = $logged_user['user_id'];
			$post['created_at'] = date("j F, Y, g:i a");
			$post['updated_at'] = date("j F, Y, g:i a");
			$res=$this->Lead_model->addLead($post);
			if($res)
			{	$this->add_leads_services($intrested_in, $res);
				$this->session->set_flashdata('message', "New Lead added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
			redirect('marketing/new_lead');
		}
		$data['customers']=$this->customer_model->All();
		$data['services'] = $this->service_model->AllServices();
		$this->load->view('layouts/header');
		$this->load->view('marketing/new_lead',$data);
		$this->load->view('layouts/footer');
		
	}

	public function inbox()
	{
		$logged_user = $this->current_user();
		if (count($this->permission_model->check(3, $logged_user['role'])) < 1)
		{
			redirect('home/no_permission');
		}
		$data['leads'] = $this->Lead_model->AllLeadsOfUser($logged_user['user_id']);
		$data['deployments'] = $this->employee_model->AllEmployees();		
		$this->load->view('layouts/header');
		$this->load->view('marketing/inbox', $data);
		$this->load->view('layouts/footer');
	}

	public function advanced_inbox()
	{
		$logged_user = $this->current_user();
		if (count($this->permission_model->check(2, $logged_user['role'])) < 1)
		{
			redirect('home/no_permission');
		}
		$data['leads'] = $this->Lead_model->AllLeads();
		$data['deployments'] = $this->employee_model->AllEmployees();
		$this->load->view('layouts/header');
		$this->load->view('marketing/advanced_inbox', $data);
		$this->load->view('layouts/footer');
	}

	public function lead_info($id)
	{
		$logged_user = $this->current_user();
		if (count($this->permission_model->check(2, $logged_user['role'])) < 1 && count($this->permission_model->check(3, $logged_user['role'])) < 1)
		{
			redirect('home/no_permission');
		}
		$data['lead'] = $this->Lead_model->getLeadDetails($id);
		$data['services'] =$this->LeadService_model->getDetails($id);
		$data['lead_follows'] = $this->LeadFollow_model->getDetails($id);
		$data['invoices'] = $this->sales_model->leadInvoices($id);
		$data['estimates'] = $this->salesestimate_model->leadEstimates($id);			
		$data['schedules']  = $this->lead_schedule_model->leadSchedules($id);
		$this->load->view('layouts/header');
		$this->load->view('marketing/single_lead',$data);
		$this->load->view('layouts/footer');
	}

	public function rate_lead()
	{
		$post = $this->input->post();
		$res = $this->Lead_model->updateLeadStatus($this->input->post());
		echo json_encode($res);
	}

	public function assign_employee($form ='')
	{
		$post = $this->input->post();
		$post['follow'] = serialize($post['follow']);
		$id = (int)$post['id'];
		unset($post['id']);
		$res = $this->Lead_model->update($id,$post);
		$data['row'] = $this->Lead_model->getLeadDetails($id);
		if ($from == 'lead_inbox')
		{
			$this->load->view('marketing/lead_row1',$data);
		}
		else
		{
			$this->load->view('marketing/lead_row',$data);
		}
	}


	public function edit_lead($id)
	{
		$logged_user = $this->current_user();
		if (count($this->permission_model->check(6, $logged_user['role'])) < 1)
		{
			redirect('home/no_permission');
		}
		$data['lead'] = $this->Lead_model->getLeadDetails($id);
		$lead_services = $this->LeadService_model->getServiceIds($id);
		$data['lead_services'] = array_column($lead_services,'service_id');
		$data['services'] = $this->service_model->AllServices();
		$data['customers']=$this->customer_model->All();
		$this->load->view('layouts/header');
		$this->load->view('marketing/edit_lead',$data);
		$this->load->view('layouts/footer');		
	}

	public function update_lead($id)
	{
		$logged_user = $this->current_user();
		$post = $this->input->post();
		$this->form_validation->set_rules('est_price',"Estimate Price",'required');	
		if ($post['user_type_radio'] == 'temp')	
		{
			$this->form_validation->set_rules('phone', 'Phone', 'is_unique[customers.mobile1]');
			$this->form_validation->set_rules('client_name',"Client Name",'required');	
			$this->form_validation->set_rules('phone',"Phone",'required');	
		}
		else
		{
			$this->form_validation->set_rules('customer_id',"Client Name",'required');	
			
		}
		if($this->form_validation->run() === true)
		{


			if ($post['user_type_radio'] == 'temp')
			{   $lead = $this->Lead_model->getLeadDetails($id);
				$custom['full_name'] = $post['client_name'];
				$custom['mobile1'] = $post['phone'];
				$custom['whatsapp'] = $post['whatsapp'];
				$custom['email'] = $post['email'];
				$custom['type'] = 'temp';
				if ( $lead['customer_type'] == 'temp')
				{
					$cust = $lead['customer_id'];
				 	$this->customer_model->update($lead['customer_id'],$custom);
				}
				else
				{
					$cust = $this->customer_model->addCustomer($custom);

				}
				if (!$cust)
				{
					$this->session->set_flashdata('exception', "Something went wrong, please try again");
				}
				$post['customer_id'] = $cust;
			}

			unset($post['user_type_radio']);
			unset($post['email']);
			unset($post['whatsapp']);
			unset($post['phone']);
			unset($post['client_name']);

			$intrested_in =  $post['interested_in'];
			unset($post['interested_in']);
			$post['updated_by'] = $logged_user['user_id'];
			$post['updated_at'] = date("j F, Y, g:i a");
			$res=$this->Lead_model->update($id,$post);
			if($res)
			{	$this->LeadService_model->deleteByLead($id);
				$this->add_leads_services($intrested_in, $id);
				$this->session->set_flashdata('message', "Lead updated successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}

		}
		redirect('marketing/lead_info/'.$id);
	}

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}

	public function delete_lead($id)
	{
        $logged_user = $this->current_user();
        $post['deleted_by'] = $logged_user['user_id'];
        $post['deleted_at'] = date("j F, Y, g:i a");
        $this->Lead_model->update($id,$post);
        echo $id;
	}

	public function convert_as_sale($id)
	{
        $logged_user = $this->current_user();
        $post['converted_by'] = $logged_user['user_id'];
        $post['status'] = 6;
        $this->Lead_model->update($id,$post);
        $this->session->set_flashdata('message', "Mark as Converted");
        redirect('marketing/lead_info/'.$id);
	}

	public function revert($id)
	{
        $post['status'] = 5;
        $post['converted_by'] = 0;
        $this->Lead_model->update($id,$post);
        $this->session->set_flashdata('message', "Reverted");
        redirect('marketing/lead_info/'.$id);		
	}

	public function to_estimate($lead_id)
	{
		$logged_user = $this->current_user();
		$lead_services = $this->LeadService_model->getServiceIds($lead_id);
		$lead_services = array_column($lead_services,'service_id');
		$post['created_by'] = $logged_user['user_id'];
		$post['created_at'] = date("j F, Y, g:i a");
		$post['type'] = "service";
		$this->tempsales_model->clear();
		foreach ($lead_services as $key => $value) {
			$post['item_id'] = $value;
			$post['quantity'] = 1;
			$post['item_model'] = 'service';
			$item = $this->service_model->FindById($value);
			$post['item']  = $item['service'];
			$post['unit']  = $item['unit_name'];
			$post['unit_id'] = $item['unit'];
			$post['price'] = $item['price'];
			$discound = $item['discound'];
			$post['discound'] = $discound * $post['quantity'];

			$gross = ($post['price'] - $item['discound'])* $post['quantity'];
			$post['gst'] = $item['tax']/100 * $gross;
			$post['total'] = $gross + $post['gst'];
			$post['gst_rate']  = $item['tax'];
			$post['gst_type']  = 'no_type';	
			$this->tempsales_model->create($post);	
		}
		$this->session->set_flashdata('message', "The Services Of Lead Copied To The Sales Estimate");
		redirect('invoice/estimate/create_from_master/lead/'.$lead_id);		
	}

	public function to_invoice($lead_id)
	{
		$logged_user = $this->current_user();
		$lead_services = $this->LeadService_model->getServiceIds($lead_id);
		$lead_services = array_column($lead_services,'service_id');
		$post['created_by'] = $logged_user['user_id'];
		$post['created_at'] = date("j F, Y, g:i a");
		$post['type'] = "service";
		$this->tempsales_model->clear();
		foreach ($lead_services as $key => $value) {
			$post['item_id'] = $value;
			$post['quantity'] = 1;
			$post['item_model'] = 'service';
			$item = $this->service_model->FindById($value);
			$post['item']  = $item['service'];
			$post['unit']  = $item['unit_name'];
			$post['unit_id'] = $item['unit'];
			$post['price'] = $item['price'];
			$discound = $item['discound'];
			$post['discound'] = $discound * $post['quantity'];

			$gross = ($post['price'] - $item['discound'])* $post['quantity'];
			$post['gst'] = $item['tax']/100 * $gross;
			$post['total'] = $gross + $post['gst'];
			$post['gst_rate']  = $item['tax'];
			$post['gst_type']  = 'no_type';	
			$this->tempsales_model->create($post);	
		}
		$this->session->set_flashdata('message', "The Services Of Lead Copied To The Sales Invoice");
		redirect('invoice/sales/index/lead/'.$lead_id);		
	}


	private function add_leads_services($intrested_in, $lead)
	{
	  foreach ($intrested_in as $i)
		{
        	$l_s = array('lead_id' => $lead,'service_id' => $i);
			$this->LeadService_model->addLeadService($l_s);
		}
	}


}