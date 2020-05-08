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
 	->where('deleted_by',0)
	->get()->result_array();
 	}

 	public function update($id,$post)
 	{
 		return $this->db->where('id',$id)->update('skills',$post);
 	}
 }
 ?>	