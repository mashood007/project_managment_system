
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meterial_delivery_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
   		$this->load->model(array(
 			'delivery_challan_dep/cart_model'

 		)); 			
 	}

 	public function create($post)
 	{
 		return $this->db->insert('metiral_delivery_check_list', $post);
 	}

 	public function meterial_delivery($delivery_challan_id, $project_id)
 	{
 		$cart = $this->cart_model->byDcId($delivery_challan_id);
 		foreach ($cart as $row ) {
 		$data['cart_id'] = $row['id'];
 		$data['item_id'] = $row['item_id'];
 		$data['item_label'] = $row['item'];
 		$data['unit_id'] = $row['unit'];
 		$data['unit_label'] = $row['unit_label'];
 		$data['quantity'] = $row['quantity']; 
 		$data['dc_id'] = $delivery_challan_id;
 		$data['project_id'] = $project_id;
 		$this->create($data);
 		}
 	}


 	public function byDcId($dc_id)
 	{
 	 	return $this->db->select('*')
	 	->from('metiral_delivery_check_list')
	 	->where('dc_id',$dc_id)
		->get()->result_array();		
 	}

 	public function updateQuantity($id, $quantity)
  	{
	  return $this->db->set('quantity',$quantity)
  		->where('id',$id)
  		->update('metiral_delivery_check_list'); 		
  	}

}
?>