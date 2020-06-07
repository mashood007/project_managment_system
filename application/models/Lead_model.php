<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lead_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function addLead($post)
 	{
 		unset($post['submit']);
 		$this->db->insert('leads', $post);
 		return $this->db->insert_id();
 	}


 	public function AllLeads()
 	{
 	return $this->db->select('leads.*, employees.nick_name, employees.photo, customers.full_name as client_name, customers.company as company, customers.city as place, customers.mobile1 as phone, customers.whatsapp as whatsapp, customers.email as email, customers.type as customer_type')
 	->from('leads')
 	->join('customers','leads.customer_id = customers.id', 'LEFT') 	
 	->join('employees','leads.created_by = employees.id', 'LEFT')
 	->where('leads.deleted_by',0)
	->get()->result_array();
 	}

 	public function AllLeadsOfUser($user)
 	{
 	return $this->db->select('leads.*, employees.nick_name, employees.photo, customers.full_name as client_name, customers.company as company, customers.city as place, customers.mobile1 as phone, customers.whatsapp as whatsapp, customers.email as email, customers.type as customer_type')
 	->from('leads')
 	 ->join('customers','leads.customer_id = customers.id', 'LEFT') 	
 	->join('employees','leads.created_by = employees.id', 'LEFT')
 	->where("leads.created_by", $user)
 	->or_where("follow LIKE '%$user%'")
 	->where('leads.deleted_by',0)
	->get()->result_array();
 	}

 	public function getLeadDetails($id)
 	{
 	return $this->db->select('leads.*, employees.nick_name as emp_name, employees.photo as emp_photo, customers.full_name as client_name, customers.company as company, customers.city as place, customers.mobile1 as phone, customers.whatsapp as whatsapp, customers.email as email, customers.type as customer_type')
 	->from('leads')
 	 ->join('customers','leads.customer_id = customers.id', 'LEFT') 	
 	->join('employees','leads.created_by = employees.id', 'LEFT')
 	->where('leads.id',$id)
 	->order_by("leads.id", "desc")
	->get()->row_array();
 	}

 	public function updateLeadStatus($post)
 	{
  		 return $this->db->set('status',(int)$post['rate'])
 		->where('id',(int)$post['id'])
 		->update('leads');
 	}

 	public function updateLeadFollow($post)
 	{
  		 return $this->db->set('follow',$post['follow'])
 		->where('id',(int)$post['id'])
 		->update('leads');
 	} 	

 	public function update($id,$post)
 	{
 		return $this->db->where('id',$id)->update('leads',$post);
 	}

 }
 ?>