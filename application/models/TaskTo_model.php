<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TaskTo_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function saveChanges($post)
 	{
 		return $this->db->insert('task_to', $post);
 	}

 	public function deleteusertasks($user)
 	{
 	return $this -> db -> where('task_from', $user)
    ->delete('task_to');
 	}

 	public function AllTasksOfUser($user)
 	{
 	return $this->db->select('task_to.task_to, employees.nick_name')
 	->from('task_to')
 	->join('employees','task_to.task_to = employees.id', 'LEFT')
 	->where("task_to.task_from", $user)
	->get()->result_array();
 	}

 }
 ?>