<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_order_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
  		$this->load->model(array(
 			'invoice/purchase_model'
 		));	 		
 	}
 	public function create($post)
 	{
 		$this->db->insert('purchase_order', $post);
 		$insert_id = $this->db->insert_id();
   		return  $insert_id;
 	}
 	
 	public function LastOrderNo()
 	{
 		$this->db->select_max('id');
		$result = $this->db->get('purchase_order')->row();  
		return $result->id;
 	}

 	public function all()
 	{
	 	return $this->db->select('purchase_order.*, employees.nick_name as created_by_nick_name, employees.photo')
	 	->from('purchase_order')
	 	->where('deleted',0)
	 	->join('employees','purchase_order.created_by = employees.id', 'LEFT')
		->get()->result_array();
 	}

 	public function cancel($id, $current_user)
 	{
	  return $this->db->set('about',$post['about'])
	  	->set('deleted',1)
	  	->set('deleted_at',date("j F, Y, g:i a"))
	  	->set('deleted_by',$current_user)	  	
  		->where('id',$id)
  		->update('purchase_order'); 		
 	}

 	public function getById($id)
 	{
	 	return $this->db->select('purchase_order.*, employees.nick_name as created_by_nick_name, employees.photo')
	 	->from('purchase_order')
	 	->where('purchase_order.id',$id)
	 	->join('employees','purchase_order.created_by = employees.id', 'LEFT')
		->get()->row();
 	}

 	public function update($post)
 	{
	  return $this->db->set('about',$post['about'])
	  	->set('mode',$post['mode'])
	  	->set('cash_paid',$post['cash_paid'])
	  	->set('purchase_date', $post['purchase_date'])
	  	->set('updated_by', $post['updated_by'])
	  	->set('updated_at', $post['updated_at'])	  	
  		->where('id',$post['id'])
  		->update('purchase_order'); 		
 	}

 	public function updateAndDelete($post)
 	{
 		$this->update($post);
 		return $this->cancel($post['id'], $post['updated_by']);
 	}

 	public function convert($order_no, $current_user)
 	{
 		$order = $this->getById($order_no);
 		unset($order->id);
 		unset($order->created_by_nick_name);
 		$order->created_at = date("j F, Y, g:i a");
 		$order->created_by = $current_user;
 		$order->updated_at = date("j F, Y, g:i a");
 		$order->deleted = 0;
 		$order->deleted_by = 0;
 		$order->deleted_at = '';
 		$order->updated_by = $current_user; 		
 		$invoice_no = $this->purchase_model->create($order);
 		$this->addConvertRecord($order_no, $invoice_no, $current_user);
 		return $invoice_no;
 	}

 	public function addConvertRecord($order_no, $invoice_no, $current_user)
 	{
 		$post =  array('purchase_order_id' => $order_no, 'purchase_invoice_id' => $invoice_no, 'created_by' => $current_user, 'created_at' =>   date("j F, Y, g:i a"));
 		return $this->db->insert('purchase_order_to_invoice', $post);
 	}

}
?>