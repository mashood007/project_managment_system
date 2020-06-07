<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Self_transfer_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function create($post)
 	{
 		unset($post['submit']);
 		$post['no'] = $this->LastNo() + 1;
 		return $this->db->insert('self_transfer', $post);
 	}

 	public function all()
 	{
 		return $this->db->select('self_transfer.*, employees.nick_name as emp_name, roles.designation')
 		->from('self_transfer')
 		->join('employees','employees.id = self_transfer.created_by', 'LEFT')
 		->join('roles', 'roles.id = employees.role', 'LEFT')
 		->group_by('self_transfer.id')
 		->order_by('self_transfer.id', 'desc')
 		->get()->result_array();
 	}

 	public function LastNo()
 	{
 		return $this->db->select('no')
 		->from('self_transfer')
 		->order_by('id', 'desc')
		->get()->row()->no;
 	} 	
 }
 	?>