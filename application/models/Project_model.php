<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}


 	public function insert($post)
 	{
 		unset($post['submit']);
 		return $this->db->insert('projects', $post);
 	}

 	public function update($id,$post)
 	{
 		return $this->db->where('id', $id)->update('projects', $post);
 	}

 	public function Name($id)
 	{
 	return $this->db->select('name')
 	->from('projects')
 	->where('id',$id)
	->get()->row()->name;
 	}
 	
 	public function AllProjects()
 	{
 	return $this->db->select('projects.*, customers.full_name as customer_name')
 	->from('projects')
 	->join('customers','projects.customer_id = customers.id', 'LEFT')
 	->where('projects.finished_by', 0)
	->get()->result_array();
 	}

 	public function get_project($id)
 	{
 	return $this->db->select('projects.*, customers.full_name as customer_name')
 	->from('projects')
 	->join('customers','projects.customer_id = customers.id', 'LEFT')
 	->where('projects.id',$id)
	->get()->row_array();
 	}

 	//updateProjectFollow

 	public function updateProjectFollow($post)
 	{
  		 return $this->db->set('follow',(int)$post['follow'])
 		->where('id',(int)$post['id'])
 		->update('projects');
 	} 	


 	public function customerProjects($customer_id)
 	{
	  	return $this->db->select('projects.*, customers.full_name as customer_name')
	 	->from('projects')
	 	->join('customers','projects.customer_id = customers.id', 'LEFT')
	 	->where('projects.finished_by', 0)
	 	->where('projects.customer_id', $customer_id)
		->get()->result_array();		
 	}


 	public function customerAllProjects($customer_id)
 	{
	  	return $this->db->select('projects.*, customers.full_name as customer_name')
	 	->from('projects')
	 	->join('customers','projects.customer_id = customers.id', 'LEFT')
	 	->where('projects.customer_id', $customer_id)
		->get()->result_array();		
 	}

 }
 ?>