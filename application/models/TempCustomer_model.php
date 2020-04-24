<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TempCustomer_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function addCustomer($post)
 	{
 		
 		$this->db->insert('temp_customers', $post);
 		$insert_id = $this->db->insert_id();
   		return  $insert_id;		
 	}


 	public function AllCustomers()
 	{
 	return $this->db->select('*')
 	->from('temp_customers')
	->get()->result_array();
 	}

 // 	 public function deleteGroup($id)
 // 	{
	//  return $this->db->set('alive',0)
 // 		->where('id',$id)
 // 		->update('staff_group'); 		
 // 	}

 }
 ?>