<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_order_cart_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
   		$this->load->model(array(
 			'invoice/temp_purchase_model'
 		));	 		
 	}
 	public function create($post)
 	{
 		$this->db->insert('purchase_order_cart', $post);
 		$insert_id = $this->db->insert_id();
   		return  $insert_id;
 	}

 	public function All()
 	{
	 	return $this->db->select('*')
	 	->from('purchase_order_cart')
	 	->where('status',0)
	 	->order_by("id", "asc")
		->get()->result_array();
 	}

 	public function getbyOrderId($order_id)
 	{
	 	return $this->db->select('*')
	 	->from('purchase_order_cart')
	 	->where('purchase_order_no',$order_id)
	 	->order_by("id", "asc")
		->get()->result_array(); 		
 	}

 	public function delete($id)
 	{
 		return $this -> db -> where('id', $id)
    	->delete('purchase_order_cart'); 		
 	}

 	public function update($id, $post)
  	{
	  return $this->db->set('price',$post['price'])
	  	->set('quantity',$post['quantity'])
	  	->set('gst',$post['gst'])
	  	->set('tax_ex_in',$post['tax_ex_in'])
	  	->set('total',$post['total'])
  		->where('id',$id)
  		->update('purchase_order_cart'); 		
  	}

 	public function getCartItem($id)
 	{
 	return $this->db->select('*')
 	->from('purchase_order_cart')
 	->where('id',$id)
	->get()->row();
 	}

 	public function order($id)
 	{

	 return $this->db->set('status',1)
	 	->set('purchase_order_no',$id)
  		->where('status',0)
  		->update('purchase_order_cart'); 		

 	}

 	public function moveToInvoiceCart($order_no, $invoice_no, $current_user)
 	{
 		$cart = $this->getbyOrderId($order_no);
 		foreach ($cart as $row) {
 			unset($row['purchase_order_no']);
 			unset($row['id']);
 			$row['created_at'] = date("j F, Y, g:i a");
 			$row['created_by'] = $current_user;
 			$row['invoice_no'] = $invoice_no;
 			$res = $this->temp_purchase_model->create($row);
 		}
 		return true;
 	}

}
?>