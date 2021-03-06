<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cess_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function addCess($post)
 	{
 		unset($post['submit']);
 		return $this->db->insert('cess', $post);
 	}


 	public function AllCess()
 	{
 	return $this->db->select('*')
 	->from('cess')
 	->where('deleted_by',0)
	->get()->result_array();
 	}

 	public function updateCess($post)
 	{
 	    return $this->db->set('name',$post['name'])
	  	->set('cess',$post['cess'])
  		->where('id',$post['id'])
  		->update('cess');
 	}

 	public function update($id,$post)
 	{
 		return $this->db->where('id',$id)->update("cess",$post);
 	}

 }
 ?>	