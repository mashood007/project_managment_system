<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salesestimate_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}

 	public function create($post)
 	{
 		$post['no'] = $this->LastEstimateNo()+1;
 		$this->db->insert('sales_estimate', $post);
 		$insert_id = $this->db->insert_id();
   		return  $insert_id;
 	}


 	public function all()
 	{
	 	return $this->db->select('sales_estimate.*, customers.full_name, customers.city, customers.mobile1, employees.nick_name as created_by_nick_name, employees.photo')
	 	->from('sales_estimate')
	 	->join('customers','sales_estimate.customer_id = customers.id', 'LEFT')
	 	->join('employees','sales_estimate.created_by = employees.id', 'LEFT')
	 	->where('sales_estimate.deleted_by', 0)
		->get()->result_array();
 	}


 	public function get($estimate)
 	{
	 	return $this->db->select('*')
	 	->from('sales_estimate')
	 	->where('id',$estimate)
		->get()->row_array();
 	}


 	public function getEstimate($invoice)
 	{
	 	return $this->db->select('sales_estimate.*, customers.full_name, customers.city, customers.mobile1, customers.designation, customers.company, customers.address1, customers.email, employees.nick_name as emp_name')
	 	->from('sales_estimate')
	 	->join('customers','sales_estimate.customer_id = customers.id', 'LEFT')
	 	->join('employees','sales_estimate.created_by = employees.id', 'LEFT')
	 	->where('sales_estimate.id',$invoice)
	 	->where('sales_estimate.deleted_by', 0)
		->get()->row_array();
 	}


 	public function update($id, $post)
 	{
 		return $this->db->where('id', $id)->update('sales_estimate', $post);
 	}

 	public function projectEstimates($project_id)
 	{
 		return $this->db->select('id')
 		->from('sales_estimate')
 		->where('conv_no', $project_id)
 		->where('conv', 'project')
 		->where('deleted_by', 0)
 		->get()->result_array();
 	}

 	public function leadEstimates($project_id)
 	{
 		return $this->db->select('id')
 		->from('sales_estimate')
 		->where('conv_no', $project_id)
 		->where('conv', 'lead')
 		->where('deleted_by', 0)
 		->get()->result_array();
 	}
 	public function delete($id)
 	{
 		return $this -> db -> where('id', $id)
    	->delete('sales_estimate'); 		
 	}
 	public function LastEstimateNo()
 	{
 		return $this->db->select('no')
 		->from('sales_estimate')
 		->order_by('id', 'desc')
		->get()->row()->no;
 	}
 }
 ?>