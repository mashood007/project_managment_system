<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MessagingTo_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function saveChanges($post)
 	{
 		return $this->db->insert('messaging_to', $post);
 	}

 	public function deleteuserRecord($user)
 	{
 	return $this -> db -> where('messaging_from', $user)
    ->delete('messaging_to');
 	}

 	public function AllRecordsOfUser($user)
 	{
 	return $this->db->select('messaging_to.messaging_to, employees.nick_name')
 	->from('messaging_to')
 	->join('employees','messaging_to.messaging_to = employees.id', 'LEFT')
 	->where("messaging_to.messaging_from", $user)
	->get()->result_array();
 	}

 }
 ?>