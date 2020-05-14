<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_status_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();			
 	}

 	public function create($post)
 	{
 		return $this->db->insert('project_status', $post);
 	}

 	public function delete($project_id, $status_id)
 	{
 		return $this->db->where('project_id', $project_id)
 		->where('status_id', $status_id)
 		->delete('project_status');
 	}

 	public function statusIds($project_id)
 	{
 		return $this->db->select('status_id')
 		->where('project_id', $project_id)
 		->get('project_status')->result_array();
 	}

 }
 ?>