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

 	public function update($id, $post)
 	{
 		return $this->db->where('id',$id)->update('employees',$post);
 	}

 	public function AllEmployees()
 	{
 	return $this->db->select('*')
 	->from('employees')
 	->where('deleted_by',0)
	->get()->result_array();
 	}

 	public function getDetails($id)
 	{
 	return $this->db->select('employees.*, roles.designation, SUM(revenue.amount) as total_revenue, COUNT(DISTINCT revenue.invoice) as total_sale, COUNT(DISTINCT tasks.id) as completed_tasks, COUNT(DISTINCT finished_jobs.id) as total_finished_jobs, COUNT(DISTINCT working_jobs.id) as total_working_jobs')
 	->from('employees')
 	->join('roles','employees.role = roles.id', 'LEFT')
 	->join('revenue','revenue.employee = employees.id', 'LEFT')
 	->join('tasks','tasks.employee_id = employees.id AND tasks.status = 1', 'LEFT')
 	->join('project_jobs as finished_jobs',"finished_jobs.to = employees.id AND finished_jobs.status = 1", 'LEFT')
 	->join('project_jobs as working_jobs',"working_jobs.to = employees.id AND working_jobs.status = 0", 'LEFT')
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