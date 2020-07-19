<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function create($post)
 	{
 		$post['no'] = $this->LastInvoiceNo() + 1;
 		$this->db->insert('purchase_invoice', $post);
 		$insert_id = $this->db->insert_id();
   		return  $insert_id;
 	}

 	public function update($id, $post)
 	{
	  return $this->db->where('id', $id)->update('purchase_invoice', $post); 
 	}

 	public function LastInvoiceNo()
 	{
 		return $this->db->select('no')
 		->from('purchase_invoice')
 		->order_by('id', 'desc')
		->get()->row()->no;
 	}

 	public function all()
 	{
	 	return $this->db->select('purchase_invoice.*, employees.nick_name as created_by_nick_name, employees.photo, sum(temp_purchase.total) as total')
	 	->from('purchase_invoice')
	 	->where('purchase_invoice.deleted_by',0)
	 	->join('temp_purchase','temp_purchase.invoice_no = purchase_invoice.id', 'LEFT')
	 	->join('employees','purchase_invoice.created_by = employees.id', 'LEFT')
	 	->group_by('purchase_invoice.id')
		->get()->result_array();
 	}

 	public function cancelledPurchases()
 	{
	 	return $this->db->select('purchase_invoice.*, employees.nick_name as created_by_nick_name, employees.photo, sum(temp_purchase.total) as total')
	 	->from('purchase_invoice')
	 	->where('purchase_invoice.deleted_by > 0')
	 	->join('temp_purchase','temp_purchase.invoice_no = purchase_invoice.id', 'LEFT')
	 	->join('employees','purchase_invoice.created_by = employees.id', 'LEFT')
	 	->group_by('purchase_invoice.id')
		->get()->result_array();		
 	}

 	public function filter_cancelled($post)
 	{
 		$from_date = $post['from_date'];
		$to_date = $post['to_date'];
	 	$rslt = $this->db->select('purchase_invoice.*, employees.nick_name as created_by_nick_name, employees.photo, sum(temp_purchase.total) as total')
	 	->from('purchase_invoice')
	 	->where('purchase_invoice.deleted_by > 0')
	 	->join('temp_purchase','temp_purchase.invoice_no = purchase_invoice.id', 'LEFT')
	 	->join('employees','purchase_invoice.created_by = employees.id', 'LEFT');
	 	
 		$rslt = $this->toDateFilter($rslt, $to_date);
 		$rslt = $this->fromDateFilter($rslt, $from_date);
 		return $rslt->group_by('purchase_invoice.id')
		->get()->result_array();

 	}

 	public function filter($post)
 	{
 		$from_date = $post['from_date'];
		$to_date = $post['to_date'];
	 	$rslt = $this->db->select('purchase_invoice.*, employees.nick_name as created_by_nick_name, employees.photo, sum(temp_purchase.total) as total')
	 	->from('purchase_invoice')
	 	->where('purchase_invoice.deleted_by',0)
	 	->join('temp_purchase','temp_purchase.invoice_no = purchase_invoice.id', 'LEFT')
	 	->join('employees','purchase_invoice.created_by = employees.id', 'LEFT');
	 	
 		$rslt = $this->toDateFilter($rslt, $to_date);
 		$rslt = $this->fromDateFilter($rslt, $from_date);
 		return $rslt->group_by('purchase_invoice.id')
		->get()->result_array();

 	}

 	public function getDetails($id)
 	{
 	return $this->db->select('purchase_invoice.*,purchase_invoice.photo as invoice_image, employees.nick_name as created_by_name, employees.photo')
 	->from('purchase_invoice')
 	->join('employees','purchase_invoice.created_by = employees.id', 'LEFT')
 	->where('purchase_invoice.id',$id)
	->get()->row();
 	}



 	public function partyPurchases($party_id)
 	{
 		return $this->db->select('purchase_invoice.*, SUM(temp_purchase.total) as total')
 		->from('purchase_invoice')
 		->join('temp_purchase', 'purchase_invoice.id = temp_purchase.invoice_no',"LEFT")
	 	->where('purchase_invoice.deleted_by', 0)
	 	->where('purchase_invoice.party_type', 'old')
	 	->where('purchase_invoice.party_id', $party_id)
	 	->group_by('purchase_invoice.id')
		->get()->result_array();
 	}

 	public function cancel($id, $current_user)
 	{
	  return $this->db->set('deleted',1)
	  	->set('deleted_at',date("j F, Y, g:i a"))
	  	->set('deleted_by',$current_user)	  	
  		->where('id',$id)
  		->update('purchase_invoice'); 		
 	}

 	public function toDateFilter($rslt, $to_date)
 	{
 		if ($to_date != '')
 		{
			$date = str_replace('/', '-', $to_date);
			$time = strtotime($date);
 			return $rslt->where('purchase_invoice.purchase_date <=',date('Y-m-d',$time));
 		}
 		else {return $rslt;}
 	}

 	public function fromDateFilter($rslt, $from_date)
 	{
 		if ($from_date != '')
 		{
			$date = str_replace('/', '-', $from_date);
			$time = strtotime($date);
 			return $rslt->where('purchase_invoice.purchase_date >=',date('Y-m-d',$time));
 		}
 		else {return $rslt;}
 	}

  public function tax_report($start_date = '', $end_date = '')
  {
  	$rslt = $this->db->select(' COUNT(DISTINCT purchase_invoice.id) as total_purchase, SUM(temp_purchase.gst) as total_tax')
  	->from('purchase_invoice')
  	->join('temp_purchase', 'purchase_invoice.id = temp_purchase.invoice_no AND temp_purchase.status = 1', 'LEFT')
  	->where('purchase_invoice.deleted_by', 0);
  	$rslt = $this->toDateFilter($rslt, $end_date);
    $rslt = $this->fromDateFilter($rslt,$start_date);
    return $rslt->get()->row_array();
  }

 }	