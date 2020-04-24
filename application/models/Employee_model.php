<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function addEmployee($post)
 	{
 		unset($post['submit']);
 		return $this->db->insert('employees', $post);
 	}


 	public function AllEmployees()
 	{
 	return $this->db->select('*')
 	->from('employees')
	->get()->result_array();
 	}

 	public function getDetails($id)
 	{
 	return $this->db->select('employees.*, roles.designation')
 	->from('employees')
 	->join('roles','employees.role = roles.id', 'LEFT')
 	->where('employees.id',$id)
	->get()->row_array();
 	}

 // 	 public function deleteGroup($id)
 // 	{
	//  return $this->db->set('alive',0)
 // 		->where('id',$id)
 // 		->update('staff_group'); 		
 // 	}

 }
 ?>