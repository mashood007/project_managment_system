<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discussion_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
   // 		$this->load->model(array(
 		// 	'delivery_challan_dep/cart_model'

 		// )); 			
 	}

 	public function create($post)
 	{
 		$this->db->insert('project_discussions', $post);
 		$insert_id = $this->db->insert_id();
   		return  $insert_id;
 	}

 	public function update($id,$post)
 	{
 		return $this->db->set('discussion',$post['discussion'])
 		->where('id', $id)
 		->update('project_discussions');
 	}

 	public function insertAttachment($post)
 	{
 		return $this->db->insert('discussion_attachments', $post);
 	}

 	public function byProject($id)
 	{
 	 	return $this->db->select('project_discussions.*, employees.nick_name as emp_name, employees.photo as emp_photo, customers.full_name as cust_name, customers.photo as cust_photo')
	 	->from('project_discussions')
	 	->join('employees',"employees.id = project_discussions.created_by AND project_discussions.creator_type = 'employees'",'LEFT')
	 	->join('customers',"customers.id = project_discussions.created_by AND project_discussions.creator_type = 'customers'",'LEFT')
	 	->where('project_id',$id)
	 	->order_by('id','desc')
		->get()->result_array();		
 	}

 	public function find($id)
 	{
 	 	return $this->db->select('project_discussions.*, employees.nick_name as emp_name, employees.photo as emp_photo, customers.full_name as cust_name, customers.photo as cust_photo')
	 	->from('project_discussions')
	 	->join('employees',"employees.id = project_discussions.created_by AND project_discussions.creator_type = 'employees'",'LEFT')
	 	->join('customers',"customers.id = project_discussions.created_by AND project_discussions.creator_type = 'customers'",'LEFT')
	 	->where('project_discussions.id',$id)
		->get()->row_array();		
 	}

 	public function attachments($discussion_id)
 	{
 		return $this->db->select('*')
 		->from('discussion_attachments')
 		->where('discussion_id', $discussion_id)
	 	->order_by('id','desc')
		->get()->result_array();
 	}

 	public function delete($id)
 	{
 		$res = $this -> db -> where('id', $id)->delete('project_discussions');
 		$this->deleteAttchmentByDisc($id);
 		return $res;
 	}

 	public function deleteAttchmentByDisc($disc_id)
 	{
 		$this -> db -> where('discussion_id', $disc_id)->delete('discussion_attachments');
 	}

}
 ?>