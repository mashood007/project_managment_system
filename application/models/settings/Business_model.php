<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Business_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function create($post)
 	{
 		unset($post['submit']);
 		return $this->db->insert('business', $post);
 	}


 	public function AllBusinesses()
 	{
	 	return $this->db->select('*')
	 	->from('business')
		->get()->result_array();
 	}

 	public function getBusinessDetails($id)
 	{
	 	return $this->db->select('*')
	 	->from('business')
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