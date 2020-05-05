<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}

 	public function create($post)
 	{
 		$this->db->insert('sales_invoice', $post);
 		$insert_id = $this->db->insert_id();
   		return  $insert_id;
 	}


 	public function delete($id, $post)
 	{

 		return $this->db->where('id', $id)->update('sales_invoice',$post);
 	}

 	public function update($id, $post)
 	{
 	    $res =  $this->db;
 	    $res = $this->set_customer($res, $post['customer_id']);
 	    $res = $this->set_about($res, $post['about']);
 	    $res = $this->set_mode($res, $post['mode']);
 	    $res = $this->set_balance_to_pay($res, $post['balance_to_pay']);
 	    $res = $this->set_cash_recieved($res, $post['cash_recieved']);
 	    $res = $this->set_sale_date($res,$post['sale_date']);
  		return $res->where('id',$id)
  		->update('sales_invoice'); 		

 	}

 	private function set_customer($res, $customer_id)
 	{
 		return $res->set('customer_id',$customer_id);
 	}

 	private function set_about($res, $about)
 	{
 		return $res->set('about',$about);
 	}

  	private function set_mode($res, $mode)
 	{
 		return $res->set('mode',$mode);
 	}	

  	private function set_sale_date($res, $sale_date)
 	{
 		return $res->set('sale_date',$sale_date);
 	}

  	private function set_balance_to_pay($res, $balance_to_pay)
 	{
 		return $res->set('balance_to_pay',$balance_to_pay);
 	}

  	private function set_cash_recieved($res, $cash_recieved)
 	{
 		return $res->set('cash_recieved',$cash_recieved);
 	} 	

 	public function all()
 	{
	 	return $this->db->select('sales_invoice.*, customers.full_name, customers.city, customers.mobile1, employees.nick_name as created_by_nick_name, employees.photo')
	 	->from('sales_invoice')
	 	->join('customers','sales_invoice.customer_id = customers.id', 'LEFT')
	 	->join('employees','sales_invoice.created_by = employees.id', 'LEFT')
	 	->where('sales_invoice.deleted_by', 0)
		->get()->result_array();
 	}

 	public function filter($post)
 	{

 	 	$rslt =  $this->db->select('sales_invoice.*, customers.full_name, customers.city, customers.mobile1, employees.nick_name as created_by_nick_name, employees.photo')
	 	->from('sales_invoice')
	 	->join('customers','sales_invoice.customer_id = customers.id', 'LEFT')
	 	->join('employees','sales_invoice.created_by = employees.id', 'LEFT')
	 	->where('sales_invoice.deleted_by', 0);

 		$rslt = $this->toDateFilter($rslt, $post['to_date']);
 		$rslt = $this->fromDateFilter($rslt, $post['from_date']);
	 	return $rslt->get()->result_array();

 	}

 	public function toDateFilter($rslt, $to_date)
 	{
 		if ($to_date != '')
 		{
 			$time = strtotime($to_date. ' +1 day');
 			return $rslt->where('sales_invoice.date_time <=',date('Y-m-d',$time));
 		}
 		else {return $rslt;}
 	}

 	public function fromDateFilter($rslt, $from_date)
 	{
 		if ($from_date != '')
 		{
 			$time = strtotime($from_date);
 			return $rslt->where('sales_invoice.date_time >=',date('Y-m-d',$time));
 		}
 		else {return $rslt;}
 	}


 	public function get($invoice)
 	{
	 	return $this->db->select('sales_invoice.*, customers.full_name, customers.city, customers.mobile1, customers.designation, customers.company, customers.address1, customers.email, employees.nick_name as emp_name')
	 	->from('sales_invoice')
	 	->join('customers','sales_invoice.customer_id = customers.id', 'LEFT')
	 	->join('employees','sales_invoice.created_by = employees.id', 'LEFT')
	 	->where('sales_invoice.id',$invoice)
		->get()->row_array();
 	}

 	public function LastInvoiceNo()
 	{
 		$this->db->select_max('id');
		$result = $this->db->get('sales_invoice')->row();  
		return $result->id;
 	}

 }
 ?>