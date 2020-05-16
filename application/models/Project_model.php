<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}

 	public function projectsOfEmp($emp_id)
 	{
 		$projects =  $this->db->select('projects.id, projects.follow, project_jobs.to')
 		->from('projects')
 		->join('project_jobs', "project_jobs.project_id = projects.id AND project_jobs.to ='$emp_id' ", "LEFT")
 		->where("projects.follow LIKE '%$emp_id%'")
 		->or_where("project_jobs.to", $emp_id)
 		->get()->result_array('id');
 		return array_unique(array_column($projects,'id'));
 	}


 	public function insert($post)
 	{
 		unset($post['submit']);
 		$this->db->insert('projects', $post);
 		$insert_id = $this->db->insert_id();
   		return  $insert_id;
 	}

 	public function addServices($post)
 	{
 	  return $this->db->insert('project_services', $post);
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
 	return $this->db->select('projects.*, customers.full_name as customer_name, count(project_jobs.id) as total_jobs, count(case when project_jobs.status = 1 then 1 else null end) as total_finished_jobs')
 	->from('projects')
 	->join('customers','projects.customer_id = customers.id', 'LEFT')
 	->join('project_jobs', 'project_jobs.project_id = projects.id', 'LEFT')
 	->where('projects.finished_by', 0)
 	->where('projects.deleted_by', 0)
 	->group_by('projects.id')
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
	 	->where('projects.deleted_by', 0)
	 	->where('projects.customer_id', $customer_id)
		->get()->result_array();		
 	}


 	public function customerAllProjects($customer_id)
 	{
	  	return $this->db->select('projects.*, customers.full_name as customer_name')
	 	->from('projects')
	 	->join('customers','projects.customer_id = customers.id', 'LEFT')
	 	->where('projects.customer_id', $customer_id)
	 	->where('projects.deleted_by', 0)
		->get()->result_array();		
 	}

 	public function projectServices($project_id)
 	{
 		return $this->db->select('project_services.*, services.service')
	 	->from('project_services')
	 	->join('services','services.id = project_services.service_id', 'LEFT')
	 	->where('project_services.project_id',$project_id)
 		->get()->result_array();
 	}

 	public function getServiceIds($project_id)
 	{
 		return $this->db->select('project_services.service_id')
	 	->from('project_services')
	 	->where('project_id',$project_id)
 		->get()->result_array();
 	}


 	public function AssignedProjects($follow_id)
 	{
 	return $this->db->select('projects.*, customers.full_name as customer_name, count(project_jobs.id) as total_jobs, count(case when project_jobs.status = 1 then 1 else null end) as total_finished_jobs')
 	->from('projects')
 	->join('customers','projects.customer_id = customers.id', 'LEFT')
 	->join('project_jobs', 'project_jobs.project_id = projects.id', 'LEFT')
 	->where("follow LIKE '%$follow_id%'")
 	->where('projects.finished_by', 0)
 	->where('projects.deleted_by', 0)
 	->group_by('projects.id')
	->get()->result_array();
 	}

 	public function deleteProjectServices($project_id)
 	{
 	   return $this->db->where('project_id', $project_id)->delete('project_services');
 	}

 }
 ?>