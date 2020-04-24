<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skill_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function addSkill($post)
 	{
 		unset($post['submit']);
 		return $this->db->insert('skills', $post);
 	}


 	public function AllSkills()
 	{
 	return $this->db->select('*')
 	->from('skills')
	->get()->result_array();
 	}

 // 	 public function deleteGroup($id)
 // 	{
	//  return $this->db->set('alive',0)
 // 		->where('id',$id)
 // 		->update('staff_group'); 		
 // 	}

 }
 ?>	