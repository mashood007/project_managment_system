<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function create($post)
 	{
 		unset($post['submit']);
 		return $this->db->insert('tasks', $post);
 	}


 	public function TasksCreatedByMe($user)
 	{
 	return $this->db->select('tasks.*, employees.nick_name, employees.photo as image')
 	->from('tasks')
 	->join('employees','tasks.employee_id = employees.id', 'LEFT')
 	->where("tasks.created_by", $user)
 	->group_by('tasks.id')
	->get()->result_array();
 	}

 	public function TasksAssignedToMe($user)
 	{
 	return $this->db->select('tasks.*, employees.nick_name, employees.photo as image')
 	->from('tasks')
 	->join('employees','tasks.created_by = employees.id', 'LEFT')
 	->where("tasks.employee_id", $user)
 	->group_by('tasks.id')
	->get()->result_array();
 	}

 	public function finish($post)
 	{
  		 return $this->db->set('replay',$post['replay'])
  		 ->set('status',1)
  		 ->set('completed_on', $post['completed_on'])
 		->where('id',(int)$post['id'])
 		->update('tasks');
 	}
 }
 ?>