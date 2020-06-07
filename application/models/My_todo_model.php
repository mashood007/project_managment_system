<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_todo_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();		
 	}

 	public function create($post)
 	{
 		$this->db->insert('my_todo_tasks', $post);
 		return $this->db->insert_id();
 	}

 	public function update($id, $post)
 	{
 		return $this->db->where('id', $id)->update('my_todo_tasks', $post);
 	}

 	public function delete($id, $post)
 	{
 		return $this->db->where('id', $id)->delete('my_todo_tasks');
 	}

 	public function all($user_id)
 	{
 		return $this->db->select('*')
 		->from('my_todo_tasks')
 		->where('created_by',$user_id)
 		->order_by('id','asc')
	    ->get()->result_array();
 	}

 }
?>