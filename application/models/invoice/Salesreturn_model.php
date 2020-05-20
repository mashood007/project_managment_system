<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salesreturn_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}

 	public function create($post)
 	{
 		$post['no'] = $this->LastInvoiceNo()+1;
 		$this->db->insert('sales_return', $post);
 		$insert_id = $this->db->insert_id();
   		return  $insert_id;
 	}

	public function LastInvoiceNo()
  	{
    	return $this->db->select('no')
    	->from('sales_return')
    	->order_by('id', 'desc')
    	->get()->row()->no;
  	} 

   public function all()
 	{
	 	return $this->db->select('sales_return.*, customers.full_name, customers.city, customers.mobile1, employees.nick_name as created_by_nick_name, employees.photo, sum(temp_sales_return.total) as total, sales_invoice.no as InvoiceNo')
	 	->from('sales_return')
	 	->join('sales_invoice','sales_invoice.id = sales_return.invoice_no', 'LEFT')
	 	->join('customers','sales_return.customer_id = customers.id', 'LEFT')
	 	->join('employees','sales_return.created_by = employees.id', 'LEFT')
	 	->join('temp_sales_return','temp_sales_return.invoice_no = sales_return.id','LEFT')
	 	->where('sales_return.deleted_by', 0)
	 	->group_by('sales_return.id')	 	
		->get()->result_array();
 	}


  	public function get($id)
 	{
	 	return $this->db->select('sales_return.*, customers.full_name, customers.city, customers.mobile1, employees.nick_name as emp_name, employees.photo, sum(temp_sales_return.total) as total, sales_invoice.no as InvoiceNo')
	 	->from('sales_return')
	 	->join('sales_invoice','sales_invoice.id = sales_return.invoice_no', 'LEFT')
	 	->join('customers','sales_return.customer_id = customers.id', 'LEFT')
	 	->join('employees','sales_return.created_by = employees.id', 'LEFT')
	 	->join('temp_sales_return','temp_sales_return.invoice_no = sales_return.id','LEFT')
	 	->where('sales_return.id', $id)
	 	->group_by('sales_return.id')	 	
		->get()->row_array();
 	}

 	public function invoiceReturn($invoice)
 	{
 		return $this->db->select('sales_return.*, sum(temp_sales_return.total) as total')
	 	->from('sales_return')
	 	->join('temp_sales_return', 'temp_sales_return.invoice_no = sales_return.id','LEFT')
	 	->where('sales_return.invoice_no', $invoice)
	 	->where('sales_return.deleted_by', 0)
	 	->group_by('sales_return.id')
 		->get()->result_array();
	
 	}

 	public function update($id, $post)
 	{
 		return $this->db->where('id', $id)->update('sales_return', $post);
 	}

 	public function filter($post)
 	{
 		$from_date = $post['from_date'];
		$to_date = $post['to_date'];

 		$rslt =  $this->db->select('sales_return.*, customers.full_name, customers.city, customers.mobile1, employees.nick_name as created_by_nick_name, employees.photo, sum(temp_sales_return.total) as total, sales_invoice.no as InvoiceNo')
	 	->from('sales_return')
	 	->join('customers','sales_return.customer_id = customers.id', 'LEFT')
	 	->join('sales_invoice','sales_invoice.id = sales_return.invoice_no', 'LEFT')	 	
	 	->join('employees','sales_return.created_by = employees.id', 'LEFT')
	 	->join('temp_sales_return','temp_sales_return.invoice_no = sales_return.id','LEFT')
	 	->where('sales_return.deleted_by', 0);
 		$rslt = $this->toDateFilter($rslt, $to_date);
 		$rslt = $this->fromDateFilter($rslt, $from_date);
 		return $rslt->group_by('sales_return.id')
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