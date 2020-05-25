<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}

 	public function create($post)
 	{
 		return $this->db->insert('permissions', $post);
 	} 

 	public function deletePermission($id)
 	{
 		return $this->db->where('role', $id)->delete('permissions');
 	}

 	public function rolePermission($role)
 	{
 	return $this->db->select('*')
 	->from('permissions')
 	->where('role', $role)
	->get()->result_array();
 	}

    public function check($page, $role)
    {
    	return $this->db->select('*')
    	->from('permissions')
    	->where('role', $role)
    	->where('page', $page)
    	->get()->result_array();
    }

    public function checkParent($parent, $role)
    {
        return $this->db->select('permissions.*, pages.parent')
        ->from('permissions')
        ->join('pages','pages.id = permissions.page','LEFT')
        ->where('role', $role)
        ->where('pages.parent', $parent)
        ->get()->result_array();
    }

 }