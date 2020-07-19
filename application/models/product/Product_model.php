<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}

 	public function Create($post)
 	{
 		unset($post['submit']);
 		return $this->db->insert('products', $post);
 	}


 	public function All()
 	{
 	return $this->db->select('products.*, category.name as category_name, subcategory.subcategory_name')
 	->join('category','category.id = products.category_id', 'LEFT')
 	->join('subcategory','subcategory.id = products.subcategory_id', 'LEFT')
 	->from('products')
 	->where('products.status', 0)
 	->where('products.deleted_by', 0)
	->get()->result_array();
 	}


 	public function list_data()
 	{
 	return $this->db->select('products.*, category.name as category_name, subcategory.subcategory_name')
 	->join('category','category.id = products.category_id', 'LEFT')
 	->join('subcategory','subcategory.id = products.subcategory_id', 'LEFT')
 	->from('products')
 	->where('products.deleted_by', 0)
	->get()->result_array();
 	}

 	public function FindById($id)
 	{
	 	return $this->db->select('products.*,tax.tax as tax_rate,tax.name as tax_type, category.name as category_name, subcategory.subcategory_name, base_units.full_name as base_unit_name, secondary_units.full_name as secondary_unit_name')
	 	->join('category','category.id = products.category_id', 'LEFT')
	 	->join('subcategory','subcategory.id = products.subcategory_id', 'LEFT')
	 	->join('tax','tax.id = products.tax_id', 'LEFT')
	 	->join('units as base_units','base_units.id = products.base_unit_id', 'LEFT')
	 	->join('units as secondary_units','secondary_units.id = products.secondary_unit_id', 'LEFT')
	 	->from('products')
	 	->where('products.id',$id)
		->get()->row_array(); 		
 	}

 	public function UnitOfItem($item)
 	{
	 	return $this->db->select('products.base_unit_id, products.secondary_unit_id, base_units.full_name as base_unit_name, secondary_units.full_name as secondary_unit_name')
	 	->from('products')
	 	->join('units as base_units','products.base_unit_id = base_units.id', 'LEFT')
	 	->join('units as secondary_units','products.secondary_unit_id = secondary_units.id', 'LEFT')
	 	->where('products.id',$item)
	 	->where('products.deleted_by', 0)
		->get()->result_array(); 		
 	}

 	public function update($id, $post)
 	{
 		unset($post['submit']);
 		return $this->db->where('id', $id)->update('products', $post);
 	}

 }
 ?>	