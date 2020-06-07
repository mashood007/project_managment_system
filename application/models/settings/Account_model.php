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
 	->where('deleted_by',0)
	->get()->result_array();
 	}

 	public function update($id,$post)
 	{
 		return $this->db->where('id',$id)->update("accounts",$post);
 	}

 }
 ?>	