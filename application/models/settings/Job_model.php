<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function addJob($post)
 	{
 		unset($post['submit']);
 		return $this->db->insert('jobs', $post);
 	}


 	public function AllJobs()
 	{
 	return $this->db->select('*')
 	->from('jobs')
	->get()->result_array();
 	}

 }
 ?>	