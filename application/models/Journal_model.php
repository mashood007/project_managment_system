<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journal_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function create($post)
 	{
 		unset($post['submit']);
 		return $this->db->insert('journal', $post);
 	}


 	public function AllEcnomicTransactions()
 	{
 	return $this->db->select('journal.*,journal.item as projects_name, accounts.name as customer_name')
 	->from('journal')
 	->join('accounts','journal.account = accounts.id', 'LEFT')
 	->where("journal.mode !=", "nec")
 	->group_by('journal.id')
	->get()->result_array();
 	}



 	public function filter($post)
 	{

 		$from_date = $post['from_date'];
		$to_date = $post['to_date'];
		$trans_type = $post['trans_type'];
		$account_type = $post['account_type']; 		
	 	$rslt =  $this->db->select('journal.*,journal.item as projects_name, accounts.name as customer_name')
	 	->from('journal')
	 	->join('accounts','journal.account = accounts.id', 'LEFT');
	 	$rslt = $this->accountFilter($rslt, $account_type);
 		$rslt = $this->paymentRecieptFilter($rslt, $trans_type);
 		$rslt = $this->toDateFilter($rslt, $to_date);
 		$rslt = $this->fromDateFilter($rslt, $from_date);
	 	//->where("journal.mode", $type)
	 	return $rslt->group_by('journal.id')
		->get()->result_array();
 	}



 	private function accountFilter($rslt, $account)
 	{
 		if ($account != '')
 		{
 			return $rslt->where('journal.mode',$account);
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
 			return $rslt->where('journal.payment_reciept',$trans_type);
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
 			return $rslt->where('journal.date_time <=',date('Y-m-d',$time));
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
 			return $rslt->where('journal.date_time >=',date('Y-m-d',$time));
 		}
 		else
 		{
 			return $rslt;
 		}
 	}


 }
 ?>