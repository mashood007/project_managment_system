<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
   // 		$this->load->model(array(
 			

 		// )); 			
 	}

 	public function create($post)
 	{
 		$res =  $this->db->insert('delivery_challan_cart', $post);	
 		return $res;
 	}

 	public function All()
 	{
	 	return $this->db->select('*')
	 	->from('delivery_challan_cart')
	 	->where('status',0)
		->get()->result_array();
 	}

 	public function itemsOfDc($dc_id)
 	{
	 	return $this->db->select('sum(quantity),item_id,unit, products.product_name, products.base_unit_id, products.secondary_unit_id,products.convertional_rate')
	 	->from('delivery_challan_cart')
	 	->join('products','products.id = delivery_challan_cart.item_id', 'LEFT')
	 	->where('delivery_challan_id',$dc_id)
	 	->group_by('item_id, unit')
	 	->order_by('item_id')
		->get()->result_array();
 	}


 	public function projectItems($project_id)
 	{
 		return $this->db
 		->select('item_id')
 		->from('delivery_challan_cart')
        ->join('delivery_challan', 'delivery_challan.id = delivery_challan_cart.delivery_challan_id', 'LEFT')
 		->where('delivery_challan.delivery_for', $project_id)
 		->where('delivery_challan.for_type', 'project')
 		->group_by('item_id')
 		->get()->result_array();
 	}

 	public function delivery_challan($delivery_challan_id)
 	{
 	 $res = $this->db->set('status',1)
	 	->set('delivery_challan_id',$delivery_challan_id)
  		->where('status',0)
  		->update('delivery_challan_cart'); 			
  		return $res;
 	}



 	public function delete($id)
 	{
 		return $this -> db -> where('id', $id)
    	->delete('delivery_challan_cart'); 		
 	}

 	public function update($id, $post)
  	{
	  return $this->db->set('price',$post['price'])
	  	->set('quantity',$post['quantity'])
	  	->set('gst',$post['gst'])
	  	->set('tax_ex_in',$post['tax_ex_in'])
	  	->set('total',$post['total'])
  		->where('id',$id)
  		->update('delivery_challan_cart'); 		
  	}

 	public function getDetails($id)
 	{
 	return $this->db->select('*')
 	->from('delivery_challan_cart')
 	->where('id',$id)
	->get()->row();
 	}

 	public function byDcId($dc_id)
 	{
 	 	return $this->db->select('*')
	 	->from('delivery_challan_cart')
	 	->where('delivery_challan_id',$dc_id)
		->get()->result_array();		
 	}

 	public function clear()
 	{
 		return $this ->db-> where('status', 0)
    	->delete('delivery_challan_cart'); 		
 	}
 	 	
}
?>