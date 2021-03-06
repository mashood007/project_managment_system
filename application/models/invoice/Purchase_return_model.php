<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_return_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
  		$this->load->model(array(
 			'invoice/temp_purchase_model'
 		));		
 		
 	}


 	public function create($post)
 	{
    $post['no'] = $this->LastInvoiceNo() + 1;
 		$this->db->insert('purchase_return', $post);
 		$insert_id = $this->db->insert_id();
   		return  $insert_id;
 	}

  public function purchaseReturn($invoice)
  {
    return $this->db->select('purchase_return.*, sum(purchase_return_cart.total) as total, purchase_invoice.no as InvoiceNo')
    ->from('purchase_return')
    ->join('purchase_invoice', 'purchase_invoice.id = purchase_return.invoice_no','LEFT')
    ->join('purchase_return_cart', 'purchase_return_cart.purchase_return_id = purchase_return.id','LEFT')
    ->where('purchase_return.invoice_no', $invoice)
    ->group_by('purchase_return.id')
    ->get()->result_array();
  
  }

 	public function moveToReturnCart($invoice_no, $current_user)
 	{
 		$res =  $this->deleteByInvoiceAndStatus($invoice_no, 0);
 		if ($res)
 		{
	 		$cart = $this->temp_purchase_model->byInvoice($invoice_no);
	 		foreach ($cart as $row) {
	 			unset($row['id']);
	 			$row['created_by'] = $current_user;
	 			$row['created_at'] = date("j F, Y, g:i a");
	 			$row['status'] = 0;
	 			$this->addToCart($row);
	 		}
 		}
 	}

 	public function addToCart($post)
 	{
 		return $this->db->insert('purchase_return_cart', $post);  		  		
 	}

 	public function deleteByStatus($status)
 	{
 		return $this -> db -> where('status', $status)
    	->delete('purchase_return_cart'); 		
 	}

 	public function deleteByInvoice($invoice_no)
 	{
 		return $this -> db -> where('invoice_no', $invoice_no)
    	->delete('purchase_return_cart'); 		
 	}


 	public function deleteByInvoiceAndStatus($invoice_no, $status)
 	{
 		return $this -> db -> where('invoice_no', $invoice_no)-> where('status', $status)
    	->delete('purchase_return_cart'); 		
 	}

 	public function deleteItem($id)
 	{
 		return $this -> db -> where('id', $id)
    	->delete('purchase_return_cart'); 		
 	}
 	

 	public function updatePurchaseNo($purchase_return_id, $invoice_no)
  	{
	  return $this->db->set('purchase_return_id',$purchase_return_id)
	  	->set('status',1)
  		->where('invoice_no',$invoice_no)
  		->where('status', 0)
  		->update('purchase_return_cart'); 		
  	}


  	public function updateChart($id, $post)
  	{
	  return $this->db
	  ->set('quantity',$post['quantity'])
	  ->set('gst',$post['gst'])
	  ->set('total',$post['total'])
	  ->where('id',$id)
	  ->update('purchase_return_cart');
  	}

 	public function getCartItem($id)
 	{
 	return $this->db->select('*')
 	->from('purchase_return_cart')
 	->where('id',$id)
	->get()->row();
 	}

  public function LastInvoiceNo()
  {
    return $this->db->select('no')
    ->from('purchase_return')
    ->order_by('id', 'desc')
    ->get()->row()->no;
  }

 	public function All()
 	{
	 	return $this->db->select('purchase_return.*, employees.nick_name as employee_name, employees.photo as emp_photo , purchase_invoice.selled_by, purchase_invoice.party_id, purchase_invoice.no as InvoiceNo, sum(purchase_return_cart.total) as total')
	 	->from('purchase_return')
 	 	->join('employees','purchase_return.created_by = employees.id', 'LEFT')
 	 	->join('purchase_invoice','purchase_return.invoice_no = purchase_invoice.id', 'LEFT')
    ->join('purchase_return_cart', 'purchase_return_cart.purchase_return_id = purchase_return.id', 'LEFT')
	 	->order_by("purchase_return.id", "asc")
    ->group_by('purchase_return.id')
		->get()->result_array();
 	}


  public function filter($post)
  {
    $from_date = $post['from_date'];
    $to_date = $post['to_date']; 
    $rslt = $this->db->select('purchase_return.*, employees.nick_name as employee_name, employees.photo as emp_photo , purchase_invoice.selled_by, purchase_invoice.party_id, purchase_invoice.no as InvoiceNo, sum(purchase_return_cart.total) as total')
    ->from('purchase_return')
    ->join('employees','purchase_return.created_by = employees.id', 'LEFT')
    ->join('purchase_invoice','purchase_return.invoice_no = purchase_invoice.id', 'LEFT')
    ->join('purchase_return_cart', 'purchase_return_cart.purchase_return_id = purchase_return.id', 'LEFT')
    ->order_by("purchase_return.id", "asc");
    $rslt = $this->toDateFilter($rslt, $to_date);
    $rslt = $this->fromDateFilter($rslt, $from_date);
    return $rslt->group_by('purchase_return.id')
    ->get()->result_array();
  }



 	public function byInvoice($invoice)
 	{
	 	return $this->db->select('*')
	 	->from('purchase_return_cart')
	 	->where('invoice_no',$invoice)
	 	->where('status',0)
	 	->order_by("id", "asc")
		->get()->result_array();
 	}

  public function getCart($purchase_return_id)
  {
    return $this->db->select('*')
    ->from('purchase_return_cart')
    ->where('purchase_return_id',$purchase_return_id)
    ->order_by("id", "asc")
    ->get()->result_array();
  }


 	public function amount($purchase_return_id)
 	{
	 	return $this->db->select('sum(total) as sum_of')
	 	->from('purchase_return_cart')
	 	->where('purchase_return_id',$purchase_return_id)
		->get()->row()->sum_of;
 	}


 	public function invoice($id)
 	{

	 return $this->db->set('status',1)
	 	->set('invoice_no',$id)
  		->where('status',0)
  		->update('purchase_return_cart'); 		

 	}


 	public function update($id, $post)
  	{
	  return $this->db->set('price',$post['price'])
	  	->set('quantity',$post['quantity'])
	  	->set('gst',$post['gst'])
	  	->set('tax_ex_in',$post['tax_ex_in'])
	  	->set('total',$post['total'])
  		->where('id',$id)
  		->update('purchase_return_cart'); 		
  	}

    public function update_data($id, $post)
    {
       return $this->db->where('id', $id)->update('purchase_return', $post);

    }

  	public function itemCount($item_id, $unit)
  	{
  		return $this->db->select('SUM(quantity) as stock_in_qty, SUM(total) as stock_in_price')
  		->from('purchase_return_cart')
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
  		->from('purchase_return_cart')
  		->join('purchase_return', 'purchase_return_cart.purchase_return_id = purchase_return.id', 'LEFT')
  		->where('item_id', $item_id)
  		->where('unit', $unit)
  		->where('status', 1);
 		$rslt = $this->toDateFilter($rslt, $end);
 		$rslt = $this->fromDateFilter($rslt, $start);  		
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
  		->from('purchase_return_cart')
  		->join('purchase_return', 'purchase_return_cart.purchase_return_id = purchase_return.id', 'LEFT')
  		->where('item_id', $item_id)
  		->where('unit', $unit)
  		->where('status', 1);
 		$rslt = $this->toDateFilter($rslt, $end);
 		$rslt = $this->fromDateFilter($rslt, $start);  		
  		return $rslt->get()->row();
  	}

 	public function toDateFilter($rslt, $to_date)
 	{
 		if ($to_date != '')
 		{
      $date = str_replace('/', '-', $to_date);
      $time = strtotime($date);
 			return $rslt->where('purchase_return.date_time <=',date('Y-m-d',$time));
 		}
 		else {return $rslt;}
 	}

 	public function fromDateFilter($rslt, $from_date)
 	{
 		if ($from_date != '')
 		{
      $date = str_replace('/', '-', $from_date);
      $time = strtotime($date);
 			return $rslt->where('purchase_return.date_time >=',date('Y-m-d',$time));
 		}
 		else {return $rslt;}
 	}


  public function getDetails($id)
  {
    return $this->db->select('purchase_return.*,employees.nick_name as created_by_name, employees.photo, purchase_invoice.party_id, purchase_invoice.selled_by, purchase_invoice.no as InvoiceNo, purchase_invoice.purchase_type')
    ->from('purchase_return')
    ->join('employees','purchase_return.created_by = employees.id', 'LEFT')
    ->join('purchase_invoice','purchase_invoice.id = purchase_return.invoice_no', 'LEFT')
    ->where('purchase_return.id',$id)
    ->get()->row();
  }

  public function tax_report($start_date = '', $end_date = '')
  {
    $rslt = $this->db->select('COUNT(DISTINCT purchase_return.id) as total_purchase, SUM(purchase_return_cart.gst) as total_tax')
    ->from('purchase_return')
    ->join('purchase_return_cart', 'purchase_return.id = purchase_return_cart.purchase_return_id AND purchase_return_cart.status = 1', 'LEFT');
  //  ->where('purchase_return.deleted_by', 0);
    $rslt = $this->toDateFilter($rslt, $end_date);
    $rslt = $this->fromDateFilter($rslt,$start_date);
    return $rslt->get()->row_array();
  }

 }	