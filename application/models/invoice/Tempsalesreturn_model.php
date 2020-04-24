<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tempsalesreturn_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
    		$this->load->model(array(
 			'invoice/salesreturn_model'

 		));		
 	}

 	public function create($post)
 	{
 		return $this->db->insert('temp_sales_return', $post);
 	}

 	public function All()
 	{
	 	return $this->db->select('*')
	 	->from('temp_sales_return')
	 	->where('status',0)
		->get()->result_array();
 	}


 	public function findByInvoice($invoice_no)
 	{
	 	return $this->db->select('*')
	 	->from('temp_sales_return')
	 	->where('invoice_no',$invoice_no)
	 	->where('status',0)
		->get()->result_array();
 	}

 	public function delete($id)
 	{
 		return $this -> db -> where('id', $id)
    	->delete('temp_sales_return'); 		
 	}

 	public function deleteTemp()
 	{
 		return $this -> db -> where('status', 0)
    	->delete('temp_sales_return'); 		
 	}

 	public function invoice($id)
 	{

	 return $this->db->set('status',2)
	 	->set('invoice_no',$id)
  		->where('status',0)
  		->update('temp_sales_return'); 		

 	}
 	
 	public function estimate($id)
 	{

	 return $this->db->set('status',1)
	 	->set('invoice_no',$id)
  		->where('status',0)
  		->update('temp_sales_return'); 		

 	}

 	public function estimateToInvoice($invoice, $estimate)
 	{

	 return $this->db->set('status',2)
	 	->set('invoice_no',$invoice)
  		->where('invoice_no',$estimate)
  		->update('temp_sales_return'); 		

 	}

 	public function invoiceTotal($invoice_no)
 	{
	 	return $this->db->select('sum(total) as sum_of')
	 	->from('temp_sales_return')
	 	->where('invoice_no',$invoice_no)
		->get()->row_array();
 	}

  	public function itemCount($item_id, $unit)
  	{
  		return $this->db->select('SUM(quantity) as stock_in_qty, SUM(total) as stock_in_price')
  		->from('temp_sales_return')
  		->where('item_id', $item_id)
  		->where('unit_id', $unit)
  		->where('status', 2)
  		->get()->row();
  	}

  	public function itemMonthlyCount($item_id, $unit)
  	{
  		$start = date('m/01/Y');
  		$end = date('m/t/Y');
		
  		$rslt = $this->db->select('SUM(temp_sales_return.quantity) as stock_in_qty, SUM(temp_sales_return.total) as stock_in_price')
  		->from('temp_sales_return')
	 	->join('sales_return','temp_sales_return.invoice_no = sales_return.id', 'LEFT')
  		->where('temp_sales_return.item_id', $item_id)
  		->where('temp_sales_return.unit_id', $unit)
  		->where('temp_sales_return.status', 2);	
 		$rslt = $this->salesreturn_model->toDateFilter($rslt, $end);
 		$rslt = $this->salesreturn_model->fromDateFilter($rslt, $start);
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

 }
 ?>