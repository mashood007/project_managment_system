<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meeting_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}

 	public function create($post)
 	{
 		unset($post['submit']);
 		$this->db->insert('meetings', $post);
    return $this->db->insert_id();
 	}

 	public function update($id, $post)
 	{
 		return $this->db->where('id', $id)
 		->update('meetings', $post);
 	}

 	public function upcoming_meetings()
 	{
 		return $this->db->select('*')
 		->from('meetings')
 		//->where('schedule_date <=',date('Y-m-d'))
 		->where('mode','meeting')
 		->where('finished_by', 0)
 		->where('deleted_by', 0)
 		->get()->result_array();
 	}

 	public function completed_meetings()
 	{
 		return $this->db->select('*')
 		->from('meetings')
 		->where('mode','meeting')
 		->where('finished_by > 0')
 		->where('deleted_by', 0)
 		->get()->result_array();
 	}

 	public function pending_meetings()
 	{
 		return $this->db->select('*')
 		->from('meetings')
 		->where('mode','availability')
 		->where('deleted_by', 0)
 		->get()->result_array();
 	}

  public function TotalMeetings()
  {
    return $this->db->select('COUNT(*) AS total')
    ->from('meetings')
    ->where('mode','meeting')
    ->where('finished_by > 0')
    ->get()->row()->total;
  }

  public function YearlyMeetings()
  {
    return $this->db->select('COUNT(*) AS total')
    ->from('meetings')
    ->where('mode','meeting')
    ->where('finished_by > 0')
    ->where('YEAR(schedule_date)', date('Y'))
    ->get()->row()->total;
  }

  public function monthlyMeetings()
  {
    return $this->db->select('COUNT(*) AS total')
    ->from('meetings')
    ->where('mode','meeting')
    ->where('finished_by > 0')
    ->where('MONTH(schedule_date)', date('m'))
    ->get()->row()->total;
  }

}
