<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LeadService_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function addLeadService($post)
 	{
 		unset($post['submit']);
 		return $this->db->insert('leads_services', $post);
 	}

 	public function getDetails($lead_id)
 	{
 	return $this->db->select('services.service')
 	->from('leads_services')
  	->join('services','leads_services.service_id = services.id', 'LEFT')
 	->where('leads_services.lead_id',$lead_id)
 	->order_by("leads_services.id", "desc")
	->get()->result_array();
 	}

 	public function getServiceIds($lead_id)
 	{
 		return $this->db->select('leads_services.service_id')
	 	->from('leads_services')
	 	->where('lead_id',$lead_id)
 		->get()->result_array();
 	}

 	public function servicesOfLead($lead_id)
 	{
 		$res = $this->getDetails($lead_id);
 		$services = array( );
 		foreach ($res as $service)
 			array_push($services, $service['service']);
 		return join(" , ",$services);
 	}

 	public function deleteByLead($lead_id)
 	{
 		return $this->db->where('lead_id',$lead_id)->delete('leads_services');
 	}

 }
 ?>