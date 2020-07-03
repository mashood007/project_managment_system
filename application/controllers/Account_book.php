<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_book extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'Project_model',
 			'customer_model',
 			'employee_model',
 			'CustomerAccount_model',
 			'EmployeeAccount_model',
 			'settings/account_model',
 			'journal_model',
 			'party_model',
 			'invoice/sales_model',
 			'invoice/salesreturn_model',
 			'invoice/purchase_model',
 			'invoice/purchase_return_model',
 			'self_transfer_model',
 			'invoice/temp_purchase_model'

 		)); 		
	}


	public function cash_flow_statement()
	{
		$logged_user = $this->current_user();
		if (count($this->permission_model->check(30, $logged_user['role'])) < 1)
		{
			redirect('home/no_permission');
		}
		$employees=$this->EmployeeAccount_model->All();
		$customers = $this->CustomerAccount_model->All();
		$journals = $this->journal_model->AllEcnomicTransactions();
		$invoices = $this->sales_model->cashFlow();
		$data['result'] =  array_merge($employees,$customers, $journals, $invoices);
		$this->load->view('layouts/header');
		$this->load->view('account_book/js');
		$this->load->view('account_book/cash_flow', $data);
		$this->load->view('layouts/footer');	
	}

	public function filter_cash_flow()
	{
		$post = $this->input->post();		
		$employees=$this->EmployeeAccount_model->filter($post);
		$customers = $this->CustomerAccount_model->filter($post);
		$journals = $this->journal_model->filter($post);
		$invoices = $this->sales_model->filterCashFlow($post);
		$data['result'] =  array_merge($employees,$customers, $journals, $invoices);
		$this->load->view('account_book/cash_flow_report', $data);	
	}

	public function cash_payment()
	{
		$logged_user = $this->current_user();
		if (count($this->permission_model->check(25, $logged_user['role'])) < 1)
		{
			redirect('home/no_permission');
		}
		$data['customers'] = $this->customer_model->AllCustomers();
		$data['parties']=$this->party_model->All();

		$this->form_validation->set_rules('customer_id',"Customer",'required');
		$this->form_validation->set_rules('amount',"Amount",'required');
		if($this->form_validation->run() === true)
		{
			$post = $this->input->post();
			$post['payment_reciept'] = "P";
			$post['created_by'] = $logged_user['user_id'];
			$post['created_at'] = date("j F, Y, g:i a");
			$res = $this->CustomerAccount_model->create($post);

			if($res)
			{	
				$this->session->set_flashdata('message', "New Record added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}			
		}
		$this->load->view('layouts/header');
		$this->load->view('account_book/js');
		$this->load->view('account_book/cash_payment', $data);
		$this->load->view('layouts/footer');
		
	}


	public function cash_reciept()
	{
		$logged_user = $this->current_user();
		if (count($this->permission_model->check(26, $logged_user['role'])) < 1)
		{
			redirect('home/no_permission');
		}		$data['customers'] = $this->customer_model->AllCustomers();
		$data['parties']=$this->party_model->All();
		$this->form_validation->set_rules('customer_id',"Customer",'required');
		$this->form_validation->set_rules('amount',"Amount",'required');
		if($this->form_validation->run() === true)
		{
			$post = $this->input->post();
			$post['payment_reciept'] = "R";
			$post['created_by'] = $logged_user['user_id'];
			$post['created_at'] = date("j F, Y, g:i a");
			$res = $this->CustomerAccount_model->create($post);

			if($res)
			{	
				$this->session->set_flashdata('message', "New Record added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}			
		}
		$this->load->view('layouts/header');
		$this->load->view('account_book/js');
		$this->load->view('account_book/cash_reciept', $data);
		$this->load->view('layouts/footer');
		
	}


	public function customer_balance()
	{
		$balance = 0;
		$post = $this->input->post();
		if ($post['type'] == 'customer')
		{
			$payments = $this->CustomerAccount_model->customerPayments($post['customer_id']);
			$reciepts = $this->CustomerAccount_model->customerReciepts($post['customer_id']);
			$invoices = $this->sales_model->customerInvoices($post['customer_id']);

		}
		else
		{
			$payments = $this->CustomerAccount_model->partyPayments($post['customer_id']);
			$reciepts = $this->CustomerAccount_model->partyReciepts($post['customer_id']);
			$invoices = $this->sales_model->partyInvoices($post['customer_id']);
			$purchases = $this->purchase_model->partyPurchases($post['customer_id']);
			foreach ($purchases as $row) {
		       $balance = $balance - $row['cash_paid'] + $row['total'];
		       $purchase_return = $this->purchase_return_model->purchaseReturn($row['id']);
		       foreach ($purchase_return as $row_1) {
		         $balance = $balance - $row_1['total'] + $row_1['cash_recieved'];
		       }					
			}	
		}
			
		foreach ($invoices as $row) {
	       $balance = $balance + $row['cash_recieved'] - $row['total'];
	       $sales_return = $this->salesreturn_model->invoiceReturn($row['id']);
	       foreach ($sales_return as $row_1) {
	         $balance = $balance + $row_1['total']	- $row_1['cash_refund'];
	       }
	    }
	    echo  $balance + $reciepts - $payments; 
	}


	public function payroll()
	{
		$logged_user = $this->current_user();
		if (count($this->permission_model->check(27, $logged_user['role'])) < 1)
		{
			redirect('home/no_permission');
		}		$this->form_validation->set_rules('employee_id',"Employee",'required');
		$this->form_validation->set_rules('mode',"Mode",'required');
		$this->form_validation->set_rules('amount',"Amount",'required');
		if($this->form_validation->run() === true)
		{
			$post = $this->input->post();
			$post['created_by'] = $logged_user['user_id'];
			$post['created_at'] = date("j F, Y, g:i a");
			$res = $this->EmployeeAccount_model->create($post);
			if($res)
			{	
				$this->session->set_flashdata('message', "New Record added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}			
		}

		$data['employees'] = $this->employee_model->AllEmployees();
		$this->load->view('layouts/header');
		$this->load->view('account_book/js');
		$this->load->view('account_book/payroll', $data);
		$this->load->view('layouts/footer');		
	}

	public function employee_balance()
	{
		$post = $this->input->post();
		$payments = $this->EmployeeAccount_model->employeePayments($post['customer_id']);
		$reciepts = $this->EmployeeAccount_model->employeeReciepts($post['customer_id']);

		echo  $payments['total'] - $reciepts['total']; 
	}

	public function journal_transaction()
	{   
		$logged_user = $this->current_user();
		if (count($this->permission_model->check(28, $logged_user['role'])) < 1)
		{
			redirect('home/no_permission');
		}		$this->form_validation->set_rules('account',"Account",'required');
		$this->form_validation->set_rules('mode',"Mode",'required');
		$this->form_validation->set_rules('amount',"Amount",'required');
		if($this->form_validation->run() === true)
		{
			$post = $this->input->post();
			$post['created_by'] = $logged_user['user_id'];
			$post['created_at'] = date("j F, Y, g:i a");
			$res = $this->journal_model->create($post);
			if($res)
			{	
				$this->session->set_flashdata('message', "New Record added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}			
		}

		$data['accounts'] = $this->account_model->AllAccounts();
		$this->load->view('layouts/header');
		$this->load->view('account_book/js');
		$this->load->view('account_book/journal_transaction', $data);
		$this->load->view('layouts/footer');
	}

	public function journal_report()
	{
		$logged_user = $this->current_user();
		if (count($this->permission_model->check(31, $logged_user['role'])) < 1)
		{
			redirect('home/no_permission');
		}
		$data['accounts'] = $this->account_model->AllAccounts();
		$transactions = $this->journal_model->all();
		$non_sale_items = $this->temp_purchase_model->nonSaleReport();
		$data['transactions'] = array_merge($transactions, $non_sale_items);
		$data['title'] = "Accounts Report";
		$this->load->view('layouts/header');
		$this->load->view('account_book/journal_report', $data);
		$this->load->view('layouts/footer');		
	}

	public function filter_journal_report()
	{
		$post = $this->input->post();
		$transactions = $this->journal_model->filter($post);
		if ((int)$post['account'] > 0 || $post['trans_type'] == 'R')
		{
			$data['transactions'] = $transactions;
		}
		else
		{
		  $non_sale_items = $this->temp_purchase_model->nonSaleReport($post);
		  $data['transactions'] = array_merge($transactions, $non_sale_items);
		}
		
		$this->load->view('account_book/filter_journal_report', $data);		
	}

	public function self_transfer()
	{
		$logged_user = $this->current_user();
		if (count($this->permission_model->check(29, $logged_user['role'])) < 1)
		{
			redirect('home/no_permission');
		}
		$logged_user = $this->current_user();
		$data['title'] = "Self Transfer";
		$this->form_validation->set_rules('amount',"Amount",'required');
		if($this->form_validation->run() === true)
		{
			$post = $this->input->post();
			$post['created_by'] = $logged_user['user_id'];
			$post['created_at'] = date("j F, Y, g:i a");
			$res = $this->self_transfer_model->create($post);
			if($res)
			{	
				$this->session->set_flashdata('message', "New Record added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}			
		}
		$data['transactions'] = $this->self_transfer_model->all();
		$this->load->view('layouts/header', $data);
		$this->load->view('account_book/self_transfer', $data);
		$this->load->view('layouts/footer');		
	}

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}

}?>