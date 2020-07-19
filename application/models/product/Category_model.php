<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}

 	public function Create($post)
 	{
 		unset($post['submit']);
 		return $this->db->insert('category', $post);
 	}

 	public function update($id, $post)
 	{
 		unset($post['submit']);
 		return $this->db->where('id',$id)->update('category', $post);
 	}

 	public function byId($id)
 	{
 	return $this->db->select('*')
 	->from('category')
 	->where('id', $id)
	->get()->row_array();
 	}

 	public function AllCategories()
 	{
 	return $this->db->select('*')
 	->from('category')
 	->where('deleted_by',0)
	->get()->result_array();
 	}

 }
 ?>	