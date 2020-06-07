<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery_challan_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model(array(
 			'invoice/tempsales_model',
 			'delivery_challan_dep/cart_model'

 		)); 	
 	}

 	public function create($post)
 	{
 		$this->db->insert('delivery_challan', $post);
 		$insert_id = $this->db->insert_id();
   		return  $insert_id; 
   	}

 	public function getDetails($id)
 	{
	 	return $this->db->select('delivery_challan.*, employees.photo, employees.nick_name as emp_name')
	 	->from('delivery_challan')
	 	->join('employees','employees.id = delivery_challan.created_by', 'LEFT')
	 	->where('delivery_challan.id', $id)
		->get()->row();
 	}

 	public function All()
 	{
	 	return $this->db->select('delivery_challan.*, employees.photo, employees.nick_name as emp_name')
	 	->from('delivery_challan')
	 	->join('employees','employees.id = delivery_challan.created_by', 'LEFT')
	 	->where('delivery_challan.deleted_by', 0)
		->get()->result_array();
 	}

 	public function AllProjectDcs($project_id)
 	{
	 	return $this->db->select('delivery_challan.*, employees.photo, employees.nick_name as emp_name')
	 	->from('delivery_challan')
	 	->join('employees','employees.id = delivery_challan.created_by', 'LEFT')
	 	->where('delivery_challan.deleted_by', 0)
	 	->where('delivery_challan.for_type', 'project')
	 	->where('delivery_challan.delivery_for', $project_id)
		->get()->result_array();
 	}

 	public function next()
 	{
  		$this->db->select_max('id');
		$result = $this->db->get('delivery_challan')->row();  
		return $result->id+1;		
 	}

 	public function delete($id, $logged_user)
 	{
 	 return $this->db->set('deleted_by',$logged_user)
	 	->set('deleted_at',date("j F, Y, g:i a"))
  		->where('id',$id)
  		->update('delivery_challan'); 	
 	}

 	public function update($id,$post)
 	{
 		$this->db->where('id',$id)->update('delivery_challan', $post);
 	}

 	public function updateCheckList($id,$post)
 	{
 		return $this->db->set('about_checklist', $post['about_checklist'])
 		->set('delivery_status', $post['delivery_status'])
 		->set('delivery_on', $post['delivered_on'])
 		->set('delivered_by', $post['delivered_by'])
 		->where('id',$id)
 		->update('delivery_challan');
 	}

 	public function copy_to_invoice($dc_id)
 	{
 		$this->tempsales_model->clear();
 		$cart = $this->cart_model->byDcId($dc_id);
 		foreach ($cart as $post) {
 			unset($post['id']);
 			unset($post['delivery_challan_id']);
 			unset($post['item_type']);
 			$post['type'] = $post['item_model'];
 			unset($post['item_model']);
 			$post['unit_id'] = $post['unit'];
 			$post['unit'] = $post['unit_label'];
 			unset($post['unit_label']);
 			unset($post['tax_ex_in']);
 			$post['status'] = 0;
 			$this->tempsales_model->create($post);
 		}
 	}

}
?>