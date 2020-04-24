<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salesestimate_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}

 	public function create($post)
 	{
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
		->get()->row_array();
 	}



 	public function delete($id)
 	{
 		return $this -> db -> where('id', $id)
    	->delete('sales_estimate'); 		
 	}
 	public function LastEstimateNo()
 	{
 		$this->db->select_max('id');
		$result = $this->db->get('sales_estimate')->row();  
		return $result->id;
 	}
 }
 ?>