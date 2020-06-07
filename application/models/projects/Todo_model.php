<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();		
 	}

 	public function create($post)
 	{
 		return $this->db->insert('todo', $post);
 	}

 	public function addTask($post)
 	{
 		$this->db->insert('todo_tasks',$post);
   		return  $this->db->insert_id();
 	}

 	public function find($id)
 	{
 		return $this->db->select('todo.*,project_jobs.to, employees.nick_name, jobs.job')
 		->from('todo')
 		->join('project_jobs','todo.assign = project_jobs.id AND todo.assign > 0','LEFT')
 		->join('employees','project_jobs.to = employees.id ','LEFT')
 		->join('jobs','project_jobs.job_id = jobs.id ','LEFT')
 		->where('todo.id', $id)
 		->order_by('todo.id','desc')
 		->get()->row_array();
 	}


 // 	public function findByProject($project_id)
 // 	{
 // 	return $this->db->select('*')
 // 	->from('todo')
 // 	// ->join('todo_tasks',"todo.id = todo_tasks.todo_id ",'LEFT') 
 // 	//->join('todo_tasks',"todo.id = todo_tasks.todo_id AND todo_tasks.status = 0 ",'LEFT') 	
 // 	->where('todo.project_id',$project_id)
 // 	->order_by('id','desc')
	// ->get()->result_array();
 // 	}


 	public function findByProject($project_id)
 	{
 	return $this->db->select('todo.project_id, todo.name as todo_name, COUNT(todo_tasks.id) total_tasks, SUM(case when todo_tasks.status=1 then 1 else 0 end ) as total_checked_tasks , todo.id as todo_id')
 	->from('todo_tasks')
 	->join('todo',"todo.id = todo_tasks.todo_id ",'RIGHT') 
 	->where('todo.project_id',$project_id)
 	->group_by('todo_tasks.todo_id')
 	->order_by('todo_tasks.todo_id','desc')
	->get()->result_array();
 	}

 	public function findByProjectAndAssigner($project_id, $user)
 	{
 	return $this->db->select('todo.project_id, todo.name as todo_name, COUNT(todo_tasks.id) total_tasks, SUM(case when todo_tasks.status=1 then 1 else 0 end ) as total_checked_tasks , todo.id as todo_id')
 	->from('todo_tasks')
 	->join('todo',"todo.id = todo_tasks.todo_id ",'RIGHT') 
 	->where('todo.project_id',$project_id)
 	->where('todo.assign',$user)
 	->group_by('todo_tasks.todo_id')
 	->order_by('todo_tasks.todo_id','desc')
	->get()->result_array();
 	}

 	

 	public function tasks($todo_id)
 	{
 		return $this->db->select('*')
 		->from('todo_tasks')
 		->where('todo_id',$todo_id)
	    ->get()->result_array();
 	}

 	public function delete($id)
 	{
 		return $this -> db -> where('id', $id)->delete('todo');
 	}

 	public function updateTask($id,$post)
 	{
 		return $this->db->where('id', $id)->update('todo_tasks', $post);
 	}

 	public function updateTodo($id,$post)
 	{
 		return $this->db->where('id', $id)->update('todo', $post);
 	}

 	public function removeTask($id)
 	{
 		return $this->db->where('id', $id)->delete('todo_tasks');
 	}


 }
 ?>