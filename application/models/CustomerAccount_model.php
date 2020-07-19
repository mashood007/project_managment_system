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
 		 $post['no'] = LastNo() + 1; 
 		return $this->db->insert('customer_account', $post);
 	}



 	public function customerTransactions($customer_id)
 	{
	 	return $this->db->select('customer_account.*, employees.nick_name as emp_name, roles.designation as role_title')
	 	->from('customer_account')
	 	->join('employees','employees.id = customer_account.created_by', 'LEFT')
	 	->join('roles','roles.id = employees.role', 'LEFT')
	 	->where('customer_account.customer_id',$customer_id)
	 	->where('customer_account.type','customer')
 	 	->order_by('customer_account.id','desc')
		->get()->result_array();
 	}

 	public function customerPayments($customer_id)
 	{
 	return $this->db->select('sum(amount) as total')
 	->from('customer_account')
 	->where('customer_id',$customer_id)
 	->where('payment_reciept',"P")
 	->where('customer_account.type','customer')
	->get()->row()->total;
 	}

 	public function customerReciepts($customer_id)
 	{
 	return $this->db->select('sum(amount) as total')
 	->from('customer_account')
 	->where('customer_id',$customer_id)
 	->where('payment_reciept',"R")
 	->where('customer_account.type','customer')
	->get()->row()->total;
 	}


 	public function partyPayments($customer_id)
 	{
 	return $this->db->select('sum(amount) as total')
 	->from('customer_account')
 	->where('customer_id',$customer_id)
 	->where('payment_reciept',"P")
 	->where('customer_account.type','party')
	->get()->row()->total;
 	}

 	public function partyReciepts($customer_id)
 	{
 	return $this->db->select('sum(amount) as total')
 	->from('customer_account')
 	->where('customer_id',$customer_id)
 	->where('payment_reciept',"R")
 	->where('customer_account.type','party')
	->get()->row()->total;
 	}

 	public function All()
 	{
 	return $this->db->select("customer_account.*, customers.full_name as customer_name, party.name as party_name, 'Customer Transation' as transaction")
 	->from('customer_account')
 	->join('customers',"customer_account.customer_id = customers.id AND customer_account.type = 'customer'", 'LEFT')
 	->join('party',"customer_account.customer_id = party.id AND customer_account.type = 'party'", 'LEFT')
 	->group_by('customer_account.id')
 	->order_by('customer_account.id','desc')
	->get()->result_array();
 	}


 	public function filter($post)
 	{
 	 	$from_date = $post['from_date'];
		$to_date = $post['to_date'];
		$trans_type = $post['trans_type'];
		$account_type = $post['account_type'];	
 		$rslt =  $this->db->select("customer_account.*, customers.full_name as customer_name, party.name as party_name, 'Customer Transation' as transaction")
 		->from('customer_account')
 	->join('customers',"customer_account.customer_id = customers.id AND customer_account.type = 'customer'", 'LEFT')
 	->join('party',"customer_account.customer_id = party.id AND customer_account.type = 'party'", 'LEFT'); 		$rslt = $this->accountFilter($rslt, $account_type);
 		$rslt = $this->paymentRecieptFilter($rslt, $trans_type);
 		$rslt = $this->toDateFilter($rslt, $to_date);
 		$rslt = $this->fromDateFilter($rslt, $from_date);
 		return $rslt->group_by('customer_account.id')
	 	->order_by('customer_account.id','desc')
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
			$date = str_replace('/', '-', $to_date);
			$time = strtotime($date);
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
			$date = str_replace('/', '-', $from_date);
			$time = strtotime($date);
 			return $rslt->where('customer_account.date_time >=',date('Y-m-d',$time));
 		}
 		else
 		{
 			return $rslt;
 		}
 	}

	public function LastNo()
  	{
    	return $this->db->select('no')
    	->from('customer_account')
    	->order_by('id', 'desc')
    	->get()->row()->no;
  	} 

 }
 ?>