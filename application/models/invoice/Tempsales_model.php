<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tempsales_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
   		$this->load->model(array(
 			'invoice/sales_model'

 		)); 			
 	}

 	public function create($post)
 	{
 		return $this->db->insert('temp_sales', $post);
 	}

 	public function All()
 	{
	 	return $this->db->select('*')
	 	->from('temp_sales')
	 	->where('status',0)
		->get()->result_array();
 	}


 	public function findByInvoice($invoice_no)
 	{
	 	return $this->db->select('*')
	 	->from('temp_sales')
	 	->where('invoice_no',$invoice_no)
	 	->where('status',2)
		->get()->result_array();
 	}

  public function findByEstimate($estimate)
  {
    return $this->db->select('*')
    ->from('temp_sales')
    ->where('invoice_no',$estimate)
    ->where('status',1)
    ->get()->result_array();
  }

 	public function delete($id)
 	{
 		return $this -> db -> where('id', $id)
    	->delete('temp_sales'); 		
 	}

  public function clear()
  {
    return $this -> db -> where('status', 0)
      ->delete('temp_sales');     
  }

 	public function invoice($id)
 	{

	 return $this->db->set('status',2)
	 	->set('invoice_no',$id)
  		->where('status',0)
  		->update('temp_sales'); 		

 	}
 	
 	public function estimate($id)
 	{

	 return $this->db->set('status',1)
	 	->set('invoice_no',$id)
  		->where('status',0)
  		->update('temp_sales'); 		

 	}

 	public function estimateToInvoice($invoice, $estimate)
 	{

	 return $this->db->set('status',2)
	 	->set('invoice_no',$invoice)
  		->where('invoice_no',$estimate)
  		->update('temp_sales'); 		

 	}

 	public function invoiceTotal($invoice_no)
 	{
	 	return $this->db->select('sum(total) as sum_of')
	 	->from('temp_sales')
	 	->where('invoice_no',$invoice_no)
		->get()->row_array();
 	}

  	public function itemCount($item_id, $unit)
  	{
  		return $this->db->select('SUM(quantity) as stock_in_qty, SUM(total) as stock_in_price')
  		->from('temp_sales')
  		->where('item_id', $item_id)
  		->where('unit_id', $unit)
  		->where('status', 2)
  		->get()->row();
  	}

  	public function itemMonthlyCount($item_id, $unit)
  	{
  		$start = date('m/01/Y');
  		$end = date('m/t/Y');
		
  		$rslt = $this->db->select('SUM(temp_sales.quantity) as stock_in_qty, SUM(temp_sales.total) as stock_in_price')
  		->from('temp_sales')
	 	->join('sales_invoice','temp_sales.invoice_no = sales_invoice.id', 'LEFT')
  		->where('temp_sales.item_id', $item_id)
  		->where('temp_sales.unit_id', $unit)
  		->where('temp_sales.status', 2);	
 		$rslt = $this->sales_model->toDateFilter($rslt, $end);
 		$rslt = $this->sales_model->fromDateFilter($rslt, $start);
	 	return $rslt->get()->row();
  	}

  	public function itemYearlyCount($item_id, $unit)
  	{

        if (date('m') < 4)
        {
            $start = "04/01/".(date('Y') - 1);
            $end = "03/31/".(date('Y'));
        }
        else
        {
           $start = "04/01/".(date('Y'));
           $end = "03/31/".(date('Y') + 1);
        }  		
  		$rslt = $this->db->select('SUM(temp_sales.quantity) as stock_in_qty, SUM(temp_sales.total) as stock_in_price')
  		->from('temp_sales')
	 	->join('sales_invoice','temp_sales.invoice_no = sales_invoice.id', 'LEFT')
  		->where('temp_sales.item_id', $item_id)
  		->where('temp_sales.unit_id', $unit)
  		->where('temp_sales.status', 2);
 		
 		$rslt = $this->sales_model->toDateFilter($rslt, $end);
 		$rslt = $this->sales_model->fromDateFilter($rslt, $start);
	 	return $rslt->get()->row();

  	}

 	public function findByItem($item_id, $item_model)
 	{
	 	return $this->db->select('temp_sales.*, sales_invoice.customer_id, sales_invoice.created_at as sold_on, sales_invoice.created_by as sold_by, employees.photo as emp_photo, customers.full_name as cust_name, customers.mobile1 as cust_mobile, sales_invoice.no as InvoiceNo')
	 	->from('temp_sales')
	 	->join('sales_invoice','temp_sales.invoice_no = sales_invoice.id', 'LEFT')
	 	->join('employees','sales_invoice.created_by = employees.id', 'LEFT')
	 	->join('customers','sales_invoice.customer_id = customers.id', 'LEFT')
	 	->where('temp_sales.item_id',$item_id)
	 	->where('temp_sales.item_model', $item_model)
	 	->where('temp_sales.status',2)
		->get()->result_array();
 	}

 	public function findByItemAndDate($item_id, $post)
 	{
	 	$rslt = $this->db->select('temp_sales.*, sales_invoice.customer_id, sales_invoice.created_at as sold_on, sales_invoice.created_by as sold_by, employees.photo as emp_photo, customers.full_name as cust_name, customers.mobile1 as cust_mobile')
	 	->from('temp_sales')
	 	->join('sales_invoice','temp_sales.invoice_no = sales_invoice.id', 'LEFT')
	 	->join('employees','sales_invoice.created_by = employees.id', 'LEFT')
	 	->join('customers','sales_invoice.customer_id = customers.id', 'LEFT')
	 	->where('temp_sales.item_id',$item_id)
	 	->where('temp_sales.item_model', $post['item_model'])
	 	->where('temp_sales.status',2);
 		$rslt = $this->sales_model->toDateFilter($rslt, $post['to_date']);
 		$rslt = $this->sales_model->fromDateFilter($rslt, $post['from_date']);
	 	return $rslt->get()->result_array();
 	}


 }
 ?>