<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Conversation_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();			
 	}

 	public function create($post)
 	{
 		$this->db->insert('conversations', $post);
 		$insert_id = $this->db->insert_id();
   		return  $insert_id;
 	}

 	public function update($id,$post)
 	{
 		return $this->db->set('post',$post['post'])
 		->where('id', $id)
 		->update('conversations');
 	}

 	public function insertAttachment($post)
 	{
 		return $this->db->insert('conversation_attachments', $post);
 	}

 	public function byJob($id)
 	{
 	 	return $this->db->select('conversations.*, employees.nick_name as emp_name, employees.photo as emp_photo')
	 	->from('conversations')
	 	->join('employees',"employees.id = conversations.created_by",'LEFT')
	 	->where('job_id',$id)
	 	->order_by('id','desc')
		->get()->result_array();		
 	}

 	public function find($id)
 	{
 	 	return $this->db->select('conversations.*, employees.nick_name as emp_name, employees.photo as emp_photo')
	 	->from('conversations')
	 	->join('employees',"employees.id = conversations.created_by",'LEFT')
	 	->where('conversations.id',$id)
		->get()->row_array();		
 	}

 	public function attachments($discussion_id)
 	{
 		return $this->db->select('*')
 		->from('conversation_attachments')
 		->where('conversation_id', $discussion_id)
	 	->order_by('id','desc')
		->get()->result_array();
 	}

 	public function delete($id)
 	{
 		$res = $this -> db -> where('id', $id)->delete('conversations');
 		$this->deleteAttchmentByDisc($id);
 		return $res;
 	}

 	public function deleteAttchmentByDisc($disc_id)
 	{
 		$this -> db -> where('conversation_id', $disc_id)->delete('conversation_attachments');
 	}

}
 ?>