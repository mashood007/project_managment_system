<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meterial_return_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
   		$this->load->model(array(
 			'delivery_challan_dep/cart_model'

 		)); 			
 	}

 	public function create($post)
 	{
 		return $this->db->insert('meterial_return', $post);
 	}

 	public function update($id, $post)
 	{
 		return $this->db->where('id',$id)->update('meterial_return', $post);
 	}

 	public function ProjectId($id)
 	{
 		return $this->db->select('project_id')
 		->from('meterial_return')
 		->where('id', $id)
 		->get()->row()->project_id;
 	}

 	public function tempItems()
 	{
	 	return $this->db->select('meterial_return.*, products.product_name, products.base_unit_id, products.secondary_unit_id, products.convertional_rate, base_units.short_name as base_unit_name, secondary_units.short_name as secondary_unit_name, used_units.short_name as unit_name')
	 	->from('meterial_return')
	 	->join('products', 'meterial_return.item_id = products.id', 'LEFT')
	 	->join('units as base_units','base_units.id = products.base_unit_id', 'LEFT')
	 	->join('units as secondary_units','secondary_units.id = products.secondary_unit_id', 'LEFT')
	 	->join('units as used_units','used_units.id = meterial_return.unit_id', 'LEFT')	
 		->where('project_meterial_return_id', 0)
 		->get()->result_array();
 	}

	public function meterialReturn($id)
 	{
 		return $this->db->set('project_meterial_return_id', $id)
 		->where('project_meterial_return_id', 0)
 		->update('meterial_return');
 	}


 } 
?>