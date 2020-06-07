<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RequestsTo_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function saveChanges($post)
 	{
 		return $this->db->insert('requests_to', $post);
 	}

 	public function deleteuserRecord($user)
 	{
 		return $this -> db -> where('request_from', $user)
    	->delete('requests_to');
 	}

 	public function AllRecordsOfUser($user)
 	{
 		return $this->db->select('requests_to.request_to, employees.nick_name')
 		->from('requests_to')
 		->join('employees','requests_to.request_to = employees.id', 'LEFT')
 		->where("requests_to.request_from", $user)
		->get()->result_array();
 	}

 }
 ?>