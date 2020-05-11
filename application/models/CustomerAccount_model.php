<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerAccount_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function create($post)
 	{
 		unset($post['submit']);
 		return $this->db->insert('customer_account', $post);
 	}



 	public function customerTransactions($customer_id)
 	{
	 	return $this->db->select('customer_account.*, projects.name as project_name, employees.nick_name as emp_name, roles.designation as role_title')
	 	->from('customer_account')
	 	->join('projects','projects.id = customer_account.project_id', 'LEFT')
	 	->join('employees','employees.id = customer_account.created_by', 'LEFT')
	 	->join('roles','roles.id = employees.role', 'LEFT')
	 	->where('customer_account.customer_id',$customer_id)
		->get()->result_array();
 	}

 	public function customerPayments($customer_id)
 	{
 	return $this->db->select('sum(amount) as total')
 	->from('customer_account')
 	->where('customer_id',$customer_id)
 	->where('payment_reciept',"P")
	->get()->row_array();
 	}

 	public function customerReciepts($customer_id)
 	{
 	return $this->db->select('sum(amount) as total')
 	->from('customer_account')
 	->where('customer_id',$customer_id)
 	->where('payment_reciept',"R")
	->get()->row_array();
 	}

 	public function All()
 	{
 	return $this->db->select('customer_account.*, customers.full_name as customer_name, projects.name as projects_name')
 	->from('customer_account')
 	->join('customers','customer_account.customer_id = customers.id', 'LEFT')
 	->join('projects','customer_account.project_id = projects.id', 'LEFT')
 	->group_by('customer_account.id')
	->get()->result_array();
 	}


 	public function filter($post)
 	{
 	 	$from_date = $post['from_date'];
		$to_date = $post['to_date'];
		$trans_type = $post['trans_type'];
		$account_type = $post['account_type'];	
 		$rslt =  $this->db->select('customer_account.*, customers.full_name as customer_name, projects.name as projects_name')
 		->from('customer_account')
 		->join('customers','customer_account.customer_id = customers.id', 'LEFT')
 		->join('projects','customer_account.project_id = projects.id', 'LEFT');
 		$rslt = $this->accountFilter($rslt, $account_type);
 		$rslt = $this->paymentRecieptFilter($rslt, $trans_type);
 		$rslt = $this->toDateFilter($rslt, $to_date);
 		$rslt = $this->fromDateFilter($rslt, $from_date);
 		return $rslt->group_by('customer_account.id')
		->get()->result_array();
 	}
 	
 	private function accountFilter($rslt, $account)
 	{
 		if ($account != '')
 		{
 			return $rslt->where('customer_account.mode',$account);
 		}
 		else
 		{
 			return $rslt;
 		}
 	}


 	private function paymentRecieptFilter($rslt, $trans_type)
 	{
 		if ($trans_type != '')
 		{
 			return $rslt->where('customer_account.payment_reciept',$trans_type);
 		}
 		else
 		{
 			return $rslt;
 		}
 	}

 	private function toDateFilter($rslt, $to_date)
 	{
 		if ($to_date != '')
 		{
 			$time = strtotime($to_date);
 			return $rslt->where('customer_account.date_time <=',date('Y-m-d',$time));
 		}
 		else
 		{
 			return $rslt;
 		}
 	}

 	private function fromDateFilter($rslt, $from_date)
 	{
 		if ($from_date != '')
 		{
 			$time = strtotime($from_date);
 			return $rslt->where('customer_account.date_time >=',date('Y-m-d',$time));
 		}
 		else
 		{
 			return $rslt;
 		}
 	}

 }
 ?>