<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function create($post)
 	{
 		unset($post['submit']);
 		return $this->db->insert('project_statuses', $post);
 	}


 	public function All()
 	{
 	return $this->db->select('*')
 	->from('project_statuses')
 	->where('deleted_by',0)
 	->order_by('order_number')
	->get()->result_array();
 	}

 	public function update($id,$post)
 	{
 		return $this->db->where('id',$id)->update("project_statuses",$post);
 	}

 }
 ?>	