<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_schedule_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}

 	public function create($post)
 	{
 		unset($post['submit']);
 		return $this->db->insert('project_schedules', $post);
 	}

 	public function update($id,$post)
 	{
 		return $this->db->where('id',$id)->update('project_schedules', $post);
 	}


  	public function projectSchedules($project_id)
 	{
 	return $this->db->select('project_schedules.*, employees.nick_name, employees.photo')
 	->from('project_schedules')
 	->join('employees','project_schedules.created_by = employees.id', 'LEFT')
 	->where('project_schedules.project_id',$project_id)
 	->where('project_schedules.deleted_by',0)
 	->order_by("project_schedules.id", "desc")
	->get()->result_array();
 	}

 }
 ?>