<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Non_sale_item_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		//non_sale_items
 		
 	}

 public function create($post)
 {
   unset($post['submit']);
   $this->db->insert('non_sale_items', $post);
   $insert_id = $this->db->insert_id();
   return  $insert_id;
 }

  public function get($id)
  {
    return $this->db->select('*')
    ->from('non_sale_items')
    ->where('id', $id)
    ->get()->row_array();
  }

 public function update($id, $post)
 {
 	return $this->db->where('id', $id)
 	->update('non_sale_items', $post);
 }

 public function all()
 {
 	return $this->db->select('*')
 	->from('non_sale_items')
 	->where('deleted_by', 0)
 	->get()->result_array();
 }

}