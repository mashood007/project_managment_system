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


 	public function AllCategories()
 	{
 	return $this->db->select('*')
 	->from('category')
	->get()->result_array();
 	}

 }
 ?>	