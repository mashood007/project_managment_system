<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salary_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 	}


 	public function create($post)
 	{
 		return $this->db->insert('salaries', $post);
 	}

 	public function employeeSalary($user)
 	{
 	return $this->db->select('*')
 	->from('salaries')
 	->where("employee_id", $user)
 	->order_by('date_time', 'DESC')
	->get()->result_array(); 		
 	}

 }
 ?>