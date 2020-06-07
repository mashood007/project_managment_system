<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Revenue_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function create($post)
 	{
 		return $this->db->insert('revenue', $post);
 	}

 	public function deleteByInvoice($id)
 	{
 		return $this->db->where('invoice', $id)->delete('revenue');
 	}

 	// public function totalRevenue($emp_id)
 	// {
 	// 	return $this->db->select('SUM(amount) as total_revenue')
 	// 	->where('employee', $emp_id)
 	// 	->get()->row()->total_revenue;	
 	// }

 	public function employeeRevenues($user_id)
 	{
 	return $this->db->select('revenue.*, sales_invoice.created_at, sales_invoice.customer_id, customers.full_name as customer')
 	->from('revenue')
 	->join('sales_invoice','sales_invoice.id = revenue.invoice', 'LEFT')
 	->join('customers','sales_invoice.customer_id = customers.id', 'LEFT')
 	->where("revenue.employee", $user_id)
	->get()->result_array();
 	}
 }
 ?>