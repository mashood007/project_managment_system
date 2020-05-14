<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {

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
 			'settings/cess_model',
 			'party_model', 
 			'invoice/invoice_cess_model',
 			'lead_model',
 			'employee_model',
 			'employeeAccount_model',
 			'revenue_model'
 		));


}
	public function index($lead_no = '')
	{
		$logged_user = $this->current_user();
		if ($lead_no)
		{	$data['lead'] = $lead_no;
			$lead = $this->lead_model->getLeadDetails($lead_no);
			$data['lead_creator'] = $this->employee_model->getDetails($lead['created_by']);
			$data['lead_convertor'] = $this->employee_model->getDetails($lead['converted_by']);
		}
		$data['invoice_submitor'] = $this->employee_model->getDetails($logged_user['user_id']);
		$data['title']  = "Sales invoice";
		$data['parties']=$this->party_model->All();
		$data['invoice_no'] = $this->sales_model->LastInvoiceNo();
		$data['services'] = $this->service_model->AllServices();
		$data['products'] = $this->product_model->All();
		$data['customers']=$this->customer_model->AllCustomers();
		$this->load->view('layouts/header');
		$this->load->view('invoice/sales/index', $data);
		$this->load->view('layouts/footer');
		
	}


	public function edit($id)
	{
		$data['title']  = "Sales invoice";
		$data['invoice'] = $this->sales_model->get($id);
		$data['services'] = $this->service_model->AllServices();
		$data['products'] = $this->product_model->All();
		$data['customers']=$this->customer_model->AllCustomers();
		$data['parties']=$this->party_model->All();
		$this->load->view('layouts/header');
		$this->load->view('invoice/sales/edit', $data);
		$this->load->view('layouts/footer');
		
	}

	public function update($id)
	{
		if(!empty($id))
		{
		$data['invoice'] = $this->sales_model->get($id);
		$post = $this->input->post();
		if (!empty($post['customer_id']))
		{
			$invoice = $this->sales_model->update($id, $post);
			$this->tempsales_model->invoice($id);
			echo base_url('/invoice/report');
		}
		else
		{
			echo base_url('/invoice/sales/edit/'.$id);
		}
		}
		else
		{
			echo base_url('/invoice/report');
		}

	}


	public function item_units()
	{
		$post = $this->input->post();
		$data['item_type'] = $post['item_type'];
		if ($post['item_type'] == "service")
		{
			$data['units'] = $this->service_model->UnitOfItem($post['item']);
		}
		else
		{
			$data['units'] = $this->product_model->UnitOfItem($post['item']);			
		}	
		echo $this->load->view('invoice/sales/units_list', $data);
	}

	public function make_invoice($lead_no = '')
	{
		$logged_user = $this->current_user();
		$post = $this->input->post();
		$post['created_by'] = $logged_user['user_id'];
		$post['created_at'] = date("j F, Y, g:i a");
		
		$invoice = $this->sales_model->create($post);
		$this->tempsales_model->invoice($invoice);
		$cess = $this->cess_model->AllCess();
		foreach ($cess as $row) {
			$params['invoice_id'] = $invoice;
			$params['cess_name'] = $row['name'];
			$params['cess'] = $row['cess'];
			$this->invoice_cess_model->create($params);
		}
		$this->pay_incentive($invoice, $lead_no);
		//status 2
		echo base_url("invoice/report/");
	}

	public function create_estimate()
	{
		$logged_user = $this->current_user();
		$post = $this->input->post();
		$post['created_by'] = $logged_user['user_id'];
		$post['created_at'] = date("j F, Y, g:i a");
		
		$invoice = $this->salesestimate_model->create($post);
		$this->tempsales_model->estimate($invoice);
		
		//status 2
		echo $invoice;
	}

	public function convert_sale($estimate)
	{
		$post = $this->salesestimate_model->get($estimate);
		$post['created_at'] = date("j F, Y, g:i a");
		unset($post['id']);
		$invoice = $this->sales_model->create($post);
		$cess = $this->cess_model->AllCess();
		foreach ($cess as $row) {
			$params['invoice_id'] = $invoice;
			$params['cess_name'] = $row['name'];
			$params['cess'] = $row['cess'];
			$this->invoice_cess_model->create($params);
		}
		$this->tempsales_model->estimateToInvoice($invoice, $estimate);
		$invoice = $this->salesestimate_model->delete($estimate);
		redirect('/invoice/report/estimate', 'refresh');
	}
	

	public function bill($invoice_no)
	{
		$data['bill'] =  $this->tempsales_model->findByInvoice($invoice_no);
		echo $this->load->view('invoice/sales/bill', $data);
	}

	public function return_bill($invoice_no)
	{
		$logged_user = $this->current_user();
		$bill =  $this->tempsales_model->findByInvoice($invoice_no);
		$this->tempsalesreturn_model->deleteTemp();
		foreach ($bill as $row) {
			unset($row['id']);
			unset($row['status']);
			$row['created_at'] = date("j F, Y, g:i a");
			$row['created_by'] = $logged_user['user_id'];
			$this->tempsalesreturn_model->create($row);
		}
		$data['invoice'] =  $this->sales_model->get($invoice_no);
		$data['bill'] = $this->tempsalesreturn_model->findByInvoice($invoice_no);
		echo $this->load->view('invoice/sales/return_bill', $data);
	}

	public function make_invoice_return($invoice_no)
	{
		$logged_user = $this->current_user();
		$post = $this->input->post();
		$post['created_by'] = $logged_user['user_id'];
		$post['created_at'] = date("j F, Y, g:i a");
		$post['invoice_no'] = $invoice_no;
		$invoice_return = $this->salesreturn_model->create($post);
		$this->tempsalesreturn_model->invoice($invoice_return);
		
		//status 2
		echo base_url("invoice/report");
		//print_r($post);
	}

	public function invoice_info($invoice_no)
	{
		$data['title']  = "Sales invoice";
		$data['invoice'] = $this->sales_model->get($invoice_no);
		$data['bill'] =  $this->tempsales_model->findByInvoice($invoice_no);
		$data['cess'] = $this->invoice_cess_model->invoiceCess($invoice_no);
		$this->load->view('layouts/header');
		$this->load->view('invoice/sales/invoice_info', $data);
		$this->load->view('layouts/footer');		
	}

	public function return_info($invoice_no)
	{
		$data['title']  = "Sales invoice";
		$data['invoice'] = $this->sales_model->get($invoice_no);
		$data['bill'] =  $this->tempsales_model->findByInvoice($invoice_no);
		$data['cess'] = $this->cess_model->AllCess();
		$this->load->view('layouts/header');
		$this->load->view('invoice/sales/return_info', $data);
		$this->load->view('layouts/footer');		
	}


	private function pay_incentive($invoice, $lead_no = 0)
	{
		//employeeAccount_model
		$cart = $this->tempsales_model->findByInvoice($invoice);
        $taxable_amount = 0;
        if (sizeof($cart) > 0)
         {
            $total = 0;
            $gst = 0;
            foreach($cart as $row)
            {
                $total += $row['total'];
                $gst += $row['gst'];
            }
            $taxable_amount = $total - $gst;
        }		
		$logged_user = $this->current_user();
		if ($lead_no > 0)
		{	
			$lead = $this->lead_model->getLeadDetails($lead_no);
			$lead_creator = $this->employee_model->getDetails($lead['created_by']);
			$payroll_amount = $taxable_amount/100*$lead_creator['marketing_incentive'];
			$this->revenue_model->create(array('lead' => $lead_no,'invoice' => $invoice, 'employee' => $logged_user['user_id'], 'reason' => 'marketing_incentive','amount' => $payroll_amount ));

			$lead_convertor = $this->employee_model->getDetails($lead['converted_by']);
			$payroll_amount = $taxable_amount/100*$lead_convertor['sales_incentive'];
			$this->revenue_model->create(array('lead' => $lead_no,'invoice' => $invoice, 'employee' => $logged_user['user_id'], 'reason' => 'sales_incentive','amount' => $payroll_amount ));
		}

		$invoice_submitor = $this->employee_model->getDetails($logged_user['user_id']);
		$payroll_amount = $taxable_amount/100*$invoice_submitor['invoice_incentive'];
		$this->revenue_model->create(array('lead' => $lead_no,'invoice' => $invoice, 'employee' => $logged_user['user_id'], 'reason' => 'invoice_incentive','amount' => $payroll_amount ));
	}

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}
}