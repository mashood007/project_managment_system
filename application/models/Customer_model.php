<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function addCustomer($post)
 	{
 		unset($post['submit']);
 		return $this->db->insert('customers', $post);
 	}


 	public function AllCustomers()
 	{
 	return $this->db->select('*')
 	->from('customers')
	->get()->result_array();
 	}

 	public function getDetails($id)
 	{
 	return $this->db->select('*')
 	->from('customers')
 	->where('customers.id',$id)
	->get()->row_array();
 	}

 	public function fullName($id)
 	{
 	return $this->db->select('full_name')
 	->from('customers')
 	->where('customers.id',$id)
	->get()->row()->full_name;
 	}
 	
 // 	 public function deleteGroup($id)
 // 	{
	//  return $this->db->set('alive',0)
 // 		->where('id',$id)
 // 		->update('staff_group'); 		
 // 	}

 }
 ?>