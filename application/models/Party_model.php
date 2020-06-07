<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Party_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function add($post)
 	{
 		unset($post['submit']);
 		return $this->db->insert('party', $post);
 	}


 	public function All()
 	{
 	return $this->db->select('party.*, employees.photo as employee_photo')
 	->from('party')
 	->join('employees','party.created_by = employees.id', 'LEFT')
 	->where('party.deleted_by', 0)
	->get()->result_array();
 	}

 	public function getDetails($id)
 	{
 	return $this->db->select('*')
 	->from('party')
 	->where('party.id',$id)
	->get()->row_array();
 	}

 	public function update($id, $post)
 	{
 		return $this->db->where('id', $id)->update('party', $post);
 	}

 	public function Name($id)
 	{
 	return $this->db->select('name')
 	->from('party')
 	->where('id',$id)
	->get()->row()->name;
 	}
 }
 ?>