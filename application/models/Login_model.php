<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}


 	public function login($user_name, $user_password)
 	{
 	 return $this->db->select('*')
 	->from('employees')
 	->where('user_name',$user_name)
    ->where('user_password',$user_password)
    ->where('status', 0)
	->get()->result_array();
 	}

  	public function customer_login($user_name, $user_password)
 	{
 	 return $this->db->select('*')
 	->from('customers')
 	->where('user_name',$user_name)
    ->where('password',$user_password)
    ->where('active', 1)
	->get()->result_array();
 	}




 }
 ?>