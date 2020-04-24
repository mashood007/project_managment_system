<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function create($post)
 	{
 		$this->db->insert('purchase_invoice', $post);
 		$insert_id = $this->db->insert_id();
   		return  $insert_id;
 	}

 	public function update($post)
 	{
	  return $this->db->set('about',$post['about'])
	  	->set('purchase_date',$post['purchase_date'])
	  	->set('purchase_type',$post['purchase_type'])
	  	->set('mode',$post['mode'])
	  	->set('cash_paid',$post['cash_paid'])
	  	->set('updated_at',$post['updated_at'])
	  	->set('updated_by',$post['updated_by'])	  	
  		->where('id',$post['invoice_no'])
  		->update('purchase_invoice'); 
 	}

 	public function LastInvoiceNo()
 	{
 		$this->db->select_max('id');
		$result = $this->db->get('purchase_invoice')->row();  
		return $result->id;
 	}

 	public function all()
 	{
	 	return $this->db->select('purchase_invoice.*, employees.nick_name as created_by_nick_name, employees.photo')
	 	->from('purchase_invoice')
	 	->where('deleted',0)
	 	->join('employees','purchase_invoice.created_by = employees.id', 'LEFT')
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

 	public function cancelledPurchases()
 	{
	 	return $this->db->select('purchase_invoice.*, employees.nick_name as deleted_by_name, employees.photo')
	 	->from('purchase_invoice')
	 	->where('deleted',1)
	 	->join('employees','purchase_invoice.deleted_by = employees.id', 'LEFT')
		->get()->result_array(); 		
 	}

 	public function cancel($id, $current_user)
 	{
	  return $this->db->set('about',$post['about'])
	  	->set('deleted',1)
	  	->set('deleted_at',date("j F, Y, g:i a"))
	  	->set('deleted_by',$current_user)	  	
  		->where('id',$id)
  		->update('purchase_invoice'); 		
 	}

 	public function toDateFilter($rslt, $to_date)
 	{
 		if ($to_date != '')
 		{
 			$time = strtotime($to_date);
 			return $rslt->where('purchase_invoice.purchase_date <=',date('Y-m-d',$time));
 		}
 		else {return $rslt;}
 	}

 	public function fromDateFilter($rslt, $from_date)
 	{
 		if ($from_date != '')
 		{
 			$time = strtotime($from_date);
 			return $rslt->where('purchase_invoice.purchase_date >=',date('Y-m-d',$time));
 		}
 		else {return $rslt;}
 	}

 }	