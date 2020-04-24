<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function addRole($post)
 	{
 		unset($post['submit']);
 		return $this->db->insert('roles', $post);
 	}


 	public function AllRoles()
 	{
 	return $this->db->select('*')
 	->from('roles')
	->get()->result_array();
 	}

 	public function getRoleDetails($id)
 	{
 	return $this->db->select('*')
 	->from('roles')
 	->where('id',$id)
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