<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function addService($post)
 	{
 		unset($post['submit']);
 		return $this->db->insert('services', $post);
 	}


 	public function AllServices()
 	{
 	return $this->db->select('services.*, units.full_name as unit_name')
 	->from('services')
 	->join('units','services.unit = units.id', 'LEFT')
 	->where('services.deleted_by',0)
	->get()->result_array();
 	}

 	public function update($id,$post)
 	{
 		return $this->db->where('id',$id)->update("services",$post);
 	}

 	public function FindById($id)
 	{
	 	return $this->db->select('services.* , units.full_name as unit_name')
	 	->from('services')
	 	->join('units','services.unit = units.id', 'LEFT')
	 	->where('services.id',$id)
		->get()->row_array(); 		
 	}


 	public function UnitOfItem($item)
 	{
	 	return $this->db->select('services.unit as unit_id, units.full_name as unit_name')
	 	->from('services')
	 	->join('units','services.unit = units.id', 'LEFT')
	 	->where('services.id',$item)
		->get()->result_array(); 		
 	}

 }
 ?>	