<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estimate extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'settings/unit_model',
 			'customer_model',
 			'settings/service_model',
 			'product/product_model',
 			'invoice/sales_model',
 			'invoice/tempsales_model',
 			'invoice/salesestimate_model',
 			'invoice/tempsalesreturn_model',
 			'invoice/salesreturn_model',
 			'party_model', 
 			'settings/cess_model',
 			'settings/business_model',
 			'lead_model',
 			'employee_model',
 			'project_model'

 		));


}
	public function index()
	{
		$logged_user = $this->current_user();
		if (count($this->permission_model->check(13, $logged_user['role'])) < 1)
		{
			redirect('home/no_permission');
		}
		$data['title']  = "Estimate invoice";
		$data['parties']=$this->party_model->All();

		$data['invoice_no'] = $this->salesestimate_model->LastEstimateNo();
		$data['services'] = $this->service_model->AllServices();
		$data['products'] = $this->product_model->All();
		$data['customers']=$this->customer_model->AllCustomers();
		$this->load->view('layouts/header');
		$this->load->view('invoice/estimate/index', $data);
		$this->load->view('layouts/footer');
		
	}


	public function edit($id)
	{
		$logged_user = $this->current_user();
		if (count($this->permission_model->check(15, $logged_user['role'])) < 1)
		{
			redirect('home/no_permission');
		}
		$data['title']  = "Sales invoice";
		$data['est_no'] = $id;
		$data['invoice'] = $this->salesestimate_model->getEstimate($id);
		$data['services'] = $this->service_model->AllServices();
		$data['products'] = $this->product_model->All();
		$data['customers']=$this->customer_model->AllCustomers();
		$this->load->view('layouts/header');
		$this->load->view('invoice/estimate/edit', $data);
		$this->load->view('layouts/footer');
		
	}


	public function update($id)
	{

		if(!empty($id))
		{
		$data['invoice'] = $this->salesestimate_model->getEstimate($id);
		$post = $this->input->post();
		
		if (!empty($post['customer_id']))
		{
			$invoice = $this->salesestimate_model->update($id, $post);
			$this->tempsales_model->estimate($id);
			echo base_url('/invoice/report/estimate');
		}
		else
		{
			echo base_url('/invoice/estimate/edit/'.$id);
		}
		}
		else
		{
			echo base_url('/invoice/report/estimate');
		}

	}

	public function bill($est_no)
	{
		$data['bill'] =  $this->tempsales_model->findByEstimate($est_no);
		$data['est_no'] = $est_no;
		echo $this->load->view('invoice/estimate/bill', $data);

	}

	public function pdf($id)
	{

		$data['id'] = $id;
		$data['business'] = $this->business_model->business();
		//$data['cess'] = $this->invoice_cess_model->invoiceCess($id);
		$data['invoice'] = $this->salesestimate_model->getEstimate($id);
		$data['bill'] =  $this->tempsales_model->findByEstimate($id);
		$this->load->view('invoice/report/invoice_print', $data);
		$html = $this->output->get_output();
        		// Load pdf library
		$this->load->library('pdf');
		$this->pdf->loadHtml($html);
		$this->pdf->setPaper('A4', 'landscape');
		$this->pdf->render();
		// Output the generated PDF (1 = download and 0 = preview)
		$this->pdf->stream("html_contents.pdf", array("Attachment"=> 0));		
	}


	public function info($id)
	{
		$logged_user = $this->current_user();
		if (count($this->permission_model->check(15, $logged_user['role'])) < 1)
		{
			redirect('home/no_permission');
		}
		$data['title']  = "Sales estimate";
		$data['invoice'] = $this->salesestimate_model->getEstimate($id);
		$data['bill'] =  $this->tempsales_model->findByEstimate($id);
		$data['cess'] = $this->cess_model->AllCess();
		$this->load->view('layouts/header');
		$this->load->view('invoice/estimate/info', $data);
		$this->load->view('layouts/footer');		
	}

	public function create_from_master($from = '', $lead_no = '')
	{
		$logged_user = $this->current_user();
		if (count($this->permission_model->check(14, $logged_user['role'])) < 1)
		{
			redirect('home/no_permission');
		}
		$logged_user = $this->current_user();
		if ($lead_no && $from == 'lead')
		{	$data['lead'] = $lead_no;
			$data['from'] = $from;
			$lead = $this->lead_model->getLeadDetails($lead_no);
			$data['lead_creator'] = $this->employee_model->getDetails($lead['created_by']);
			$data['lead_convertor'] = $this->employee_model->getDetails($lead['converted_by']);
		}
		elseif ($from == "project")
		{
			$data['lead'] = $lead_no;
			$data['project'] = $this->project_model->get_project($lead_no);
			$data['from'] = $from;
		}

		$data['invoice_submitor'] = $this->employee_model->getDetails($logged_user['user_id']);
		$data['title']  = "Sales invoice";
		$data['parties']=$this->party_model->All();
		$data['invoice_no'] = $this->sales_model->LastInvoiceNo();
		$data['services'] = $this->service_model->AllServices();
		$data['products'] = $this->product_model->All();
		$data['customers']=$this->customer_model->AllCustomers();
		$this->load->view('layouts/header', $data);
		$this->load->view('account_book/js');
		$this->load->view('invoice/estimate/create_from_master', $data);
		$this->load->view('layouts/footer');
		
	}


	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}	

	public function delete($id)
	{
		$logged_user = $this->current_user();
		$post['deleted_by'] = $logged_user['user_id'];
		$post['deleted_at'] = date("j F, Y, g:i a");
		$this->salesestimate_model->update($id, $post);
		echo $id;
	}

}