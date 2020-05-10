<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LeadFollow_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function addLeadFollow($post)
 	{
 		unset($post['submit']);
 		$this->db->insert('lead_follows', $post);
 		return $this->db->insert_id();
 	}

  	public function getDetails($id)
 	{
 	return $this->db->select('lead_follows.*, employees.nick_name, employees.photo')
 	->from('lead_follows')
 	->join('employees','lead_follows.created_by = employees.id', 'LEFT')
 	->where('lead_follows.lead_id',$id)
 	->where('lead_follows.deleted_by',0)
 	->order_by("lead_follows.id", "desc")
	->get()->result_array();
 	}

 	public function update($id,$post)
 	{
 		return $this->db->where('id',$id)->update("lead_follows",$post);
 	}

 }
 ?>