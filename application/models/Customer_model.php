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


 	public function update($id, $post)
 	{
 		return $this->db->where('id',$id)->update('customers',$post);
 	}

 	public function AllCustomers()
 	{
 		return $this->db->select('customers.*, employees.nick_name as emp_name, employees.photo as emp_photo')
 		->from('customers')
 		->join('employees','employees.id = customers.created_by','LEFT')
 		->where('employees.deleted_at',0)
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