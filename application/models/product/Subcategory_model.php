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
 	 	->where('subcategory.deleted_by',0)
		->get()->result_array();
 	}

 	public function update($id, $post)
 	{
 		unset($post['submit']);
 		return $this->db->where('id',$id)->update('subcategory', $post);
 	}

 	public function byId($id)
 	{
 	  return $this->db->select('*')
      ->from('subcategory')
 	  ->where('id', $id)
	  ->get()->row_array();
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