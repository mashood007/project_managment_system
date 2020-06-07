<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_meterial_return_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();			
 	}

 	public function create($post)
 	{
 	 	$this->db->insert('project_meterial_return', $post);
 		$insert_id = $this->db->insert_id();
   		return  $insert_id; 	
 	}
 
  	public function byProject($project_id)
 	{
	 	return $this->db->select('project_meterial_return.*, employees.nick_name')
	 	->from('project_meterial_return')
	 	->join('employees','employees.id = project_meterial_return.created_by', 'LEFT')
	 	->where('project_id',$project_id)
		->get()->result_array();
 	}

 }
 ?>