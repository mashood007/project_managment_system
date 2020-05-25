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
 		$this->db->insert('customers', $post);
 		return $this->db->insert_id();
 	}

 	public function getByEmail($email)
 	{
	 	return $this->db->select('*')
	 	->from('customers')
	    ->where('email',$email)
		->get()->row_array(); 		
 	}
 	
 	public function changePassword($id, $password)
 	{
 		return $this->db->set('password', $password)->where('id',$id)->update('customers');
 	}

 	public function password($id, $user_password)
 	{
 	return $this->db->select('*')
 	->from('customers')
 	->where('id',$id)
    ->where('password',$user_password)
	->get()->result_array();
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
 		->where('customers.deleted_at',0)
 		->where("customers.type != 'temp'")
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
 	
 	public function All()
 	{
 		return $this->db->select('customers.*, employees.nick_name as emp_name, employees.photo as emp_photo')
 		->from('customers')
 		->join('employees','employees.id = customers.created_by','LEFT')
 		->where('customers.deleted_at',0)
		->get()->result_array();
 	}

 }
 ?>