<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}
 	public function create($post)
 	{
 		return $this->db->insert('pages', $post);
 	}

 	public function All()
 	{
 	return $this->db->select('*')
 	->from('pages')
 	//->group_by('parent')
	->get()->result_object();
 	}
}