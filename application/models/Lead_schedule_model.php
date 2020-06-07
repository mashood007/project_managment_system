<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lead_schedule_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}

 	public function create($post)
 	{
 		unset($post['submit']);
 		return $this->db->insert('lead_schedules', $post);
 	}

 	public function update($id,$post)
 	{
 		return $this->db->where('id',$id)->update('lead_schedules', $post);
 	}


  	public function leadSchedules($lead_id)
 	{
 	return $this->db->select('lead_schedules.*, employees.nick_name, employees.photo')
 	->from('lead_schedules')
 	->join('employees','lead_schedules.created_by = employees.id', 'LEFT')
 	->where('lead_schedules.lead_id',$lead_id)
 	->where('lead_schedules.deleted_by',0)
 	->order_by("lead_schedules.id", "desc")
	->get()->result_array();
 	}

 }
 ?>