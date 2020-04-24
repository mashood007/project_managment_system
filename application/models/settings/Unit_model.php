
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function create($post)
 	{
 		unset($post['submit']);
 		return $this->db->insert('units', $post);
 	}


 	public function All()
 	{
 	return $this->db->select('*')
 	->from('units')
	->get()->result_array();
 	}

 	public function getUnitDetails($id)
 	{
 	return $this->db->select('*')
 	->from('units')
 	->where('id',$id)
	->get()->row_array();
 	}

 	
 }
 ?>	