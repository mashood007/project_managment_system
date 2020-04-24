<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tax_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function addTax($post)
 	{
 		unset($post['submit']);
 		return $this->db->insert('tax', $post);
 	}


 	public function AllTaxs()
 	{
 	return $this->db->select('*')
 	->from('tax')
	->get()->result_array();
 	}

 	public function updateTax($post)
 	{
	  return $this->db->set('name',$post['name'])
	  	->set('tax',$post['tax'])
  		->where('id',$post['id'])
  		->update('tax'); 
 	}

 // 	 public function deleteGroup($id)
 // 	{
	//  return $this->db->set('alive',0)
 // 		->where('id',$id)
 // 		->update('staff_group'); 		
 // 	}

 }
 ?>	