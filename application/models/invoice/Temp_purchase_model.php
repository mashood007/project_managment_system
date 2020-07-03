<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Temp_purchase_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
    		$this->load->model(array(
 			'invoice/purchase_model'

 		)); 		
 	}
 	public function create($post)
 	{
 		$this->db->insert('temp_purchase', $post);
 		$insert_id = $this->db->insert_id();
   		return  $insert_id;	 		
 	}

 	public function All()
 	{
	 	return $this->db->select('*')
	 	->from('temp_purchase')
	 	->where('status',0)
	 	->order_by("id", "asc")
		->get()->result_array();
 	}

  public function nonSaleReport()
  {
    return $this->db->select("temp_purchase.id, temp_purchase.item, 'Non Sale Item' as account_name, temp_purchase.price as amount, non_sale_items.description, purchase_invoice.created_at, purchase_invoice.mode")
    ->from('temp_purchase')
    ->join('purchase_invoice', 'temp_purchase.invoice_no = purchase_invoice.id', 'LEFT')
    ->join('non_sale_items', 'temp_purchase.item_id = non_sale_items.id', 'LEFT')
    ->where('temp_purchase.invoice_no > 0')
    ->where('temp_purchase.item_type','no_sale')
    ->order_by("temp_purchase.id", "asc")
    ->group_by('temp_purchase.id')
    ->get()->result_array();   
  }


  public function filterNonSaleReport($post = '')
  {
    $from_date = $post['from_date'];
    $to_date = $post['to_date'];

    $rslt =  $this->db->select("temp_purchase.id, temp_purchase.item, 'Non Sale Item' as account_name, temp_purchase.price as amount, non_sale_items.description, purchase_invoice.created_at, purchase_invoice.mode, purchase_invoice.date_time")
    ->from('temp_purchase')
    ->join('purchase_invoice', 'temp_purchase.invoice_no = purchase_invoice.id', 'LEFT')
    ->join('non_sale_items', 'temp_purchase.item_id = non_sale_items.id', 'LEFT')
    ->where('temp_purchase.invoice_no > 0')
    ->where('temp_purchase.item_type','no_sale');
    if ($to_date != '')
    {
      $time = strtotime($to_date. ' +1 day');
      $rslt = $rslt->where('purchase_invoice.date_time <',date('Y-m-d',$time));
    }
    if ($from_date != '')
    {
      $time = strtotime($from_date);
      $rslt = $rslt->where('purchase_invoice.date_time >=',date('Y-m-d',$time));
    }
    return $rslt->order_by("temp_purchase.id", "asc")
    ->group_by('temp_purchase.id')
    ->get()->result_array();
  }

 	public function byInvoice($invoice)
 	{
	 	return $this->db->select('*')
	 	->from('temp_purchase')
	 	->where('invoice_no',$invoice)
	 	->order_by("id", "asc")
		->get()->result_array();
 	}

 	public function delete($id)
 	{
 		return $this -> db -> where('id', $id)
    	->delete('temp_purchase'); 		
 	}

 	public function invoice($id)
 	{

	 return $this->db->set('status',1)
	 	->set('invoice_no',$id)
  		->where('status',0)
  		->update('temp_purchase'); 		

 	}

 	public function cancelInvoice($id)
 	{
	 return $this->db->set('status',5)
  		->where('invoice_no',$id)
  		->update('temp_purchase'); 			
 	}

 	public function amount($invoice_no)
 	{
	 	return $this->db->select('sum(total) as sum_of')
	 	->from('temp_purchase')
	 	->where('invoice_no',$invoice_no)
		->get()->row()->sum_of;
 	}

 	public function getDetails($id)
 	{
 	return $this->db->select('*')
 	->from('temp_purchase')
 	->where('id',$id)
	->get()->row();
 	}

 	public function update($id, $post)
  	{
	  return $this->db->set('price',$post['price'])
	  	->set('quantity',$post['quantity'])
	  	->set('gst',$post['gst'])
	  	->set('tax_ex_in',$post['tax_ex_in'])
	  	->set('total',$post['total'])
  		->where('id',$id)
  		->update('temp_purchase'); 		
  	}
 
  	public function itemCount($item_id, $unit)
  	{
  		return $this->db->select('SUM(quantity) as stock_in_qty, SUM(total) as stock_in_price')
  		->from('temp_purchase')
  		->where('item_id', $item_id)
  		->where('unit', $unit)
  		->where('status', 1)
  		->get()->row();
  	}

  	public function itemMonthlyCount($item_id, $unit)
  	{
 
 		$start = date('m/01/Y');
  		$end = date('m/t/Y'); 
  		$rslt =  $this->db->select('SUM(quantity) as stock_in_qty, SUM(total) as stock_in_price')
  		->from('temp_purchase')
  		->join('purchase_invoice', 'temp_purchase.invoice_no = purchase_invoice.id', 'LEFT')
  		->where('item_id', $item_id)
  		->where('unit', $unit)
  		->where('status', 1);
 		$rslt = $this->purchase_model->toDateFilter($rslt, $end);
 		$rslt = $this->purchase_model->fromDateFilter($rslt, $start);  		
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
  		$rslt =  $this->db->select('SUM(quantity) as stock_in_qty, SUM(total) as stock_in_price')
  		->from('temp_purchase')
  		->join('purchase_invoice', 'temp_purchase.invoice_no = purchase_invoice.id', 'LEFT')
  		->where('item_id', $item_id)
  		->where('unit', $unit)
  		->where('status', 1);
 		$rslt = $this->purchase_model->toDateFilter($rslt, $end);
 		$rslt = $this->purchase_model->fromDateFilter($rslt, $start);  		
  		return $rslt->get()->row();
  	}

  	public function lastPurchasePrice($item_id)
  	{
 	return $this->db->select('price')
 	->from('temp_purchase')
 	->where('item_id',$item_id)
	->get()->row()->price;
  	}

 	public function findByItem($item_id, $item_model)
 	{
	 	return $this->db->select('temp_purchase.*, purchase_invoice.party_id, purchase_invoice.selled_by, purchase_invoice.purchase_date as purchased_on, purchase_invoice.created_by as purchased_by, employees.photo as emp_photo, purchase_invoice.no as InvoiceNo')
	 	->from('temp_purchase')
	 	->join('purchase_invoice','temp_purchase.invoice_no = purchase_invoice.id', 'LEFT')
	 	->join('employees','purchase_invoice.created_by = employees.id', 'LEFT')
	 	->where('temp_purchase.item_id',$item_id)
	 	->where('temp_purchase.item_model', $item_model)
	 	->where('temp_purchase.status',1)
		->get()->result_array();
 	}

 	public function findByItemAndDate($item_id, $post)
 	{
	 	$rslt =  $this->db->select('temp_purchase.*, purchase_invoice.party_id, purchase_invoice.selled_by, purchase_invoice.purchase_date as purchased_on, purchase_invoice.created_by as purchased_by, employees.photo as emp_photo, purchase_invoice.no as InvoiceNo')
	 	->from('temp_purchase')
	 	->join('purchase_invoice','temp_purchase.invoice_no = purchase_invoice.id', 'LEFT')
	 	->join('employees','purchase_invoice.created_by = employees.id', 'LEFT')
	 	->where('temp_purchase.item_id',$item_id)
	 	->where('temp_purchase.item_model', $post['item_model'])
	 	->where('temp_purchase.status',1);
	 	$rslt = $this->purchase_model->toDateFilter($rslt, $post['to_date']);
 		$rslt = $this->purchase_model->fromDateFilter($rslt, $post['from_date']);
		return $rslt->get()->result_array(); 		
 	}

 }	