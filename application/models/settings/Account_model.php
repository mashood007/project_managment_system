<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function addAccount($post)
 	{
 		unset($post['submit']);
 		return $this->db->insert('accounts', $post);
 	}


 	public function AllAccounts()
 	{
 	return $this->db->select('*')
 	->from('accounts')
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