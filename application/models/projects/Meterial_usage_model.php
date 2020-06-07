<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meterial_usage_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
   		$this->load->model(array(
 			'delivery_challan_dep/cart_model',
 			'projects/meterial_return_model'

 		)); 			
 	}

 	public function create($post)
 	{
 		return $this->db->insert('meterial_usage', $post);
 	}

 	public function update($id, $post)
 	{
 		return $this->db->where('id',$id)->update('meterial_usage', $post);
 	}

 	public function meterialUsage($mu_id)
 	{
 		return $this->db->set('project_meterial_usage_id', $mu_id)
 		->where('project_meterial_usage_id', 0)
 		->update('meterial_usage');
 	}

 	public function meterial_usage($delivery_challan_id, $project_id)
 	{
 		$cart = $this->cart_model->projectItems($project_id);;
 		foreach ($cart as $row ) {
 		$data['project_id'] = $project_id;
 		$data['item_id'] = $row['item_id'];
 		$this->create($data);
 		$this->meterial_return_model->create($data);
 		}
 	}

 	public function ProjectId($id)
 	{
 		return $this->db->select('project_id')
 		->from('meterial_usage')
 		->where('id', $id)
 		->get()->row()->project_id;
 	}

 	public function tempItems()
 	{
	 	return $this->db->select('meterial_usage.*, products.product_name, products.base_unit_id, products.secondary_unit_id, products.convertional_rate, base_units.short_name as base_unit_name, secondary_units.short_name as secondary_unit_name, used_units.short_name as unit_name')
	 	->from('meterial_usage')
	 	->join('products', 'meterial_usage.item_id = products.id', 'LEFT')
	 	->join('units as base_units','base_units.id = products.base_unit_id', 'LEFT')
	 	->join('units as secondary_units','secondary_units.id = products.secondary_unit_id', 'LEFT')
	 	->join('units as used_units','used_units.id = meterial_usage.unit_id', 'LEFT')	
 		->where('project_meterial_usage_id', 0)
 		->get()->result_array();
 	}



 }
 ?>