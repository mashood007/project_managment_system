<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salesreturn_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}

 	public function create($post)
 	{
 		$this->db->insert('sales_return', $post);
 		$insert_id = $this->db->insert_id();
   		return  $insert_id;
 	}
 
  	public function all()
 	{
	 	return $this->db->select('sales_return.*, customers.full_name, customers.city, customers.mobile1, employees.nick_name as created_by_nick_name, employees.photo')
	 	->from('sales_return')
	 	->join('customers','sales_return.customer_id = customers.id', 'LEFT')
	 	->join('employees','sales_return.created_by = employees.id', 'LEFT')
		->get()->result_array();
 	}

 	public function toDateFilter($rslt, $to_date)
 	{
 		if ($to_date != '')
 		{
 			$time = strtotime($to_date. ' +1 day');
 			return $rslt->where('sales_return.date_time <=',date('Y-m-d',$time));
 		}
 		else {return $rslt;}
 	}

 	public function fromDateFilter($rslt, $from_date)
 	{
 		if ($from_date != '')
 		{
 			$time = strtotime($from_date);
 			return $rslt->where('sales_return.date_time >=',date('Y-m-d',$time));
 		}
 		else {return $rslt;}
 	}

 }
 	?>