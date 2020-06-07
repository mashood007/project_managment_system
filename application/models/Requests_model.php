<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Requests_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function create($post)
 	{
 		unset($post['submit']);
 		return $this->db->insert('employee_requests', $post);
 	}

 	public function AllReqestsbyUser($user)
 	{
 		return $this->db->select('employee_requests.*, employees.nick_name, employees.photo')
 		->from('employee_requests')
 		->join('employees','employee_requests.employee_id = employees.id', 'LEFT')
 		->where("employee_requests.created_by", $user)
		->get()->result_array();
 	}


 	public function AllReqestsToUser($user)
 	{
 		return $this->db->select('employee_requests.*, employees.nick_name, employees.photo')
 		->from('employee_requests')
 		->join('employees','employee_requests.created_by = employees.id', 'LEFT')
 		->where("employee_requests.employee_id", $user)
		->get()->result_array();
 	}


 	public function delete($id)
 	{
		return $this -> db -> where('id', $id)
    	->delete('employee_requests'); 		
 	}
 
    public function changeStatus($id, $status_id)
    {
  		return $this->db->set('replied_on',date("j F, Y, g:i a"))
  		->set('status',$status_id)
 		->where('id',$id)
 		->update('employee_requests');    	
    }

    public function RequestsToMe($user_id)
    {
      return $this->db->select('count(*) as total')
      ->from('employee_requests')
      ->where('employee_id', $user_id)
      ->get()->row()->total;
    }

 }
 ?>