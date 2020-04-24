<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meterial_order_cart_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();			
 	}

 	public function create($post)
 	{
 		return $this->db->insert('meterial_order_cart', $post);
 	}

 	public function delete($id)
 	{
 		return $this -> db -> where('id', $id)
    	->delete('meterial_order_cart'); 		
 	}

 	public function update($id, $post)
 	{
 		return $this->db->where('id',$id)->update('meterial_order_cart', $post);
 	}

 	public function meterialOrder($mu_id)
 	{
 		return $this->db->set('meterial_order_id', $mu_id)
 		->where('meterial_order_id', 0)
 		->update('meterial_order_cart');
 	}

 	public function tempItems()
 	{
	 	return $this->db->select('meterial_order_cart.*, products.product_name, products.base_unit_id, products.secondary_unit_id, products.convertional_rate, base_units.short_name as base_unit_name, secondary_units.short_name as secondary_unit_name, used_units.short_name as unit_name')
	 	->from('meterial_order_cart')
	 	->join('products', 'meterial_order_cart.item_id = products.id', 'LEFT')
	 	->join('units as base_units','base_units.id = products.base_unit_id', 'LEFT')
	 	->join('units as secondary_units','secondary_units.id = products.secondary_unit_id', 'LEFT')
	 	->join('units as used_units','used_units.id = meterial_order_cart.unit_id', 'LEFT')	
 		->where('meterial_order_id', 0)
 		->get()->result_array();
 	}

 	public function items($order_id)
 	{
	 	return $this->db->select('meterial_order_cart.*, products.product_name, products.base_unit_id, products.secondary_unit_id, products.convertional_rate, base_units.short_name as base_unit_name, secondary_units.short_name as secondary_unit_name, used_units.short_name as unit_name')
	 	->from('meterial_order_cart')
	 	->join('products', 'meterial_order_cart.item_id = products.id', 'LEFT')
	 	->join('units as base_units','base_units.id = products.base_unit_id', 'LEFT')
	 	->join('units as secondary_units','secondary_units.id = products.secondary_unit_id', 'LEFT')
	 	->join('units as used_units','used_units.id = meterial_order_cart.unit_id', 'LEFT')	
 		->where('meterial_order_id', $order_id)
 		->get()->result_array();
 	}


 }
 ?>