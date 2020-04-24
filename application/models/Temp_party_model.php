<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Temp_party_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function create($post)
 	{
 		
 		$this->db->insert('temp_parties', $post);
 		$insert_id = $this->db->insert_id();
   		return  $insert_id;		
 	}


 	public function All()
 	{
 	return $this->db->select('*')
 	->from('temp_parties')
	->get()->result_array();
 	}
 	
 	public function getDetails($id)
 	{
 	return $this->db->select('*')
 	->from('temp_parties')
 	->where('temp_parties.id',$id)
	->get()->row_array();
 	}


 }
 ?>