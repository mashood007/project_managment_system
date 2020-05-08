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
 	->where('deleted_by',0)
	->get()->result_array();
 	}

 	public function getRoleDetails($id)
 	{
 	return $this->db->select('*')
 	->from('roles')
 	->where('id',$id)
	->get()->row_array();
 	}

 	public function update($id,$post)
 	{
 		return $this->db->where('id',$id)->update('roles',$post);
 	}

 }
 ?>	