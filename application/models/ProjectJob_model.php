<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProjectJob_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function create($post)
 	{	unset($post['submit']);
 		return $this->db->insert('project_jobs', $post);
 	}

 	public function deleteProjectJob($project)
 	{
 	return $this -> db -> where('project_id', $project)
    ->delete('project_jobs');
 	}

 	public function ProjectJobs($project)
 	{
 	return $this->db->select('project_jobs.*, employees.nick_name as employee_name, employees.photo')
 	->from('project_jobs')
 	->join('employees','project_jobs.created_by = employees.id', 'LEFT')
 	->where("project_jobs.project_id", $project)
	->get()->result_array();
 	}

 	public function ProjectPendingJobs($project)
 	{
 	return $this->db->select('project_jobs.*, employees.nick_name as employee_name, employees.photo, jobs.job')
 	->from('project_jobs')
 	->join('employees','project_jobs.created_by = employees.id', 'LEFT')
 	->join('jobs','project_jobs.job_id = jobs.id', 'LEFT')
 	->where("project_jobs.project_id", $project)
  	->where("project_jobs.status", 0)
	->get()->result_array();
 	}


 	public function ProjectCompletedJobs($project)
 	{
 	return $this->db->select('project_jobs.*, employees.nick_name as employee_name, employees.photo, jobs.job')
 	->from('project_jobs')
 	->join('employees','project_jobs.created_by = employees.id', 'LEFT')
 	->join('jobs','project_jobs.job_id = jobs.id', 'LEFT')
 	->where("project_jobs.project_id", $project)
 	->where("project_jobs.status", 1)
	->get()->result_array();
 	} 	

 	public function finishProjectJob($post)
 	{
  		 return $this->db->set('status',1)
 		->where('id',(int)$post['id'])
 		->update('project_jobs');
 	} 

 	public function pendingProjectJob($post)
 	{
   		 return $this->db->set('status',0)
 		->where('id',(int)$post['id'])
 		->update('project_jobs');		
 	}

 }
 ?>
