<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subcategory_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}

 	public function Create($post)
 	{
 		unset($post['submit']);
 		return $this->db->insert('subcategory', $post);
 	}

 	public function All()
 	{
	 	return $this->db->select('subcategory.*, category.name as category_name')
	 	->from('subcategory')
 	 	->join('category','category.id = subcategory.category_id', 'LEFT')
		->get()->result_array();
 	}

 	public function categorySubcategories($category_id)
 	{
	 	return $this->db->select('subcategory.*, category.name as category_name')
	 	->from('subcategory')
 	 	->join('category','category.id = subcategory.category_id', 'LEFT')
 		->where("subcategory.category_id", $category_id)
		->get()->result_array();
 	}
 }
 ?>	