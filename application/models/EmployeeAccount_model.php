<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeAccount_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function create($post)
 	{
 		unset($post['submit']);
 		$post['no'] = LastNo() + 1; 
 		return $this->db->insert('employee_account', $post);
 	}


 	public function employeePayments($employee_id)
 	{
 	return $this->db->select('sum(amount) as total')
 	->from('employee_account')
 	->where('employee_id',$employee_id)
 	->where('payment_reciept',"P")
	->get()->row_array();
 	}

 	public function employeeReciepts($employee_id)
 	{
 	return $this->db->select('sum(amount) as total')
 	->from('employee_account')
 	->where('employee_id',$employee_id)
 	->where('payment_reciept',"R")
	->get()->row_array();
 	}

 	public function employeePayroll($employee_id)
 	{
 	return $this->db->select('employee_account.*, employees.photo as emp_photo, employees.nick_name as emp_name')
 	->from('employee_account')
 	->join('employees','employee_account.created_by = employees.id', 'LEFT')
 	->where('employee_account.employee_id',$employee_id)
	->get()->result_array();
 	}

 	public function All()
 	{
 	return $this->db->select("employee_account.*, employees.nick_name as customer_name, 'Payroll' as transaction")
 	->from('employee_account')
 	->join('employees','employee_account.employee_id = employees.id', 'LEFT')
 	->group_by('employee_account.id')
	->get()->result_array();
 	}

 	public function filter($post)
 	{
 		$from_date = $post['from_date'];
		$to_date = $post['to_date'];
		$trans_type = $post['trans_type'];
		$account_type = $post['account_type'];

 		$rslt =  $this->db->select("employee_account.*, employees.nick_name as customer_name, 'Payroll' as transaction")
 		->from('employee_account')
 		->join('employees','employee_account.employee_id = employees.id', 'LEFT');
 		$rslt = $this->accountFilter($rslt, $account_type);
 		$rslt = $this->paymentRecieptFilter($rslt, $trans_type);
 		$rslt = $this->toDateFilter($rslt, $to_date);
 		$rslt = $this->fromDateFilter($rslt, $from_date);
 		return $rslt->group_by('employee_account.id')
		->get()->result_array();
 	}



 	private function accountFilter($rslt, $account)
 	{
 		if ($account != '')
 		{
 			return $rslt->where('employee_account.mode',$account);
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
 			return $rslt->where('employee_account.payment_reciept',$trans_type);
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
 			return $rslt->where('employee_account.date_time <=',date('Y-m-d',$time));
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
 			return $rslt->where('employee_account.date_time >=',date('Y-m-d',$time));
 		}
 		else
 		{
 			return $rslt;
 		}
 	}

	public function LastNo()
  	{
    	return $this->db->select('no')
    	->from('employee_account')
    	->order_by('id', 'desc')
    	->get()->row()->no;
  	} 

 }
 ?>