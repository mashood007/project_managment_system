<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lead_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function addLead($post)
 	{
 		unset($post['submit']);
 		$this->db->insert('leads', $post);
 		return $this->db->insert_id();
 	}


 	public function AllLeads()
 	{
 	return $this->db->select('leads.*, employees.nick_name, employees.photo')
 	->from('leads')
 	->join('employees','leads.created_by = employees.id', 'LEFT')
	->get()->result_array();
 	}

 	public function AllLeadsOfUser($user)
 	{
 	return $this->db->select('leads.*, employees.nick_name, employees.photo')
 	->from('leads')
 	->join('employees','leads.created_by = employees.id', 'LEFT')
 	->where("leads.created_by", $user)
 	->or_where("leads.follow", $user)
	->get()->result_array();
 	}

 	public function getLeadDetails($id)
 	{
 	return $this->db->select('*')
 	->from('leads')
 	->where('id',$id)
 	->order_by("id", "desc")
	->get()->row_array();
 	}

 	public function updateLeadStatus($post)
 	{
  		 return $this->db->set('status',(int)$post['rate'])
 		->where('id',(int)$post['id'])
 		->update('leads');
 	}

 	public function updateLeadFollow($post)
 	{
  		 return $this->db->set('follow',(int)$post['follow'])
 		->where('id',(int)$post['id'])
 		->update('leads');
 	} 	

 // 	 public function deleteGroup($id)
 // 	{
	//  return $this->db->set('alive',0)
 // 		->where('id',$id)
 // 		->update('staff_group'); 		
 // 	}

 }
 ?>