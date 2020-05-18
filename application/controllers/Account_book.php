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
 			'Journal_model'

 		)); 		
	}


	public function cash_flow_statement()
	{

		$employees=$this->EmployeeAccount_model->All();
		$customers = $this->CustomerAccount_model->All();
		$journals = $this->Journal_model->AllEcnomicTransactions();
		$data['result']=array_merge($employees,$customers, $journals);
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
		$journals = $this->Journal_model->filter($post);
		$data['result']=array_merge($employees,$customers, $journals);
		echo $this->load->view('account_book/cash_flow_report', $data);	
	}

	public function cash_payment()
	{
		$logged_user = $this->current_user();
		$data['customers'] = $this->customer_model->AllCustomers();

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
		$data['customers'] = $this->customer_model->AllCustomers();

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


	public function customer_balance($customer_id)
	{
		$post = $this->input->post();
		$payments = $this->CustomerAccount_model->customerPayments($post['customer_id']);
		$reciepts = $this->CustomerAccount_model->customerReciepts($post['customer_id']);

		echo  $payments['total'] - $reciepts['total']; 
	}


	public function payroll()
	{
		$logged_user = $this->current_user();
		$this->form_validation->set_rules('employee_id',"Employee",'required');
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
		$this->form_validation->set_rules('account',"Account",'required');
		$this->form_validation->set_rules('mode',"Mode",'required');
		$this->form_validation->set_rules('amount',"Amount",'required');
		if($this->form_validation->run() === true)
		{
			$post = $this->input->post();
			$post['created_by'] = $logged_user['user_id'];
			$post['created_at'] = date("j F, Y, g:i a");
			$res = $this->Journal_model->create($post);
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

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}

}?>