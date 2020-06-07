<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meterial_order_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();			
 		$this->load->model(array(
 			
 			'product/product_model',
 			'projects/meterial_order_cart_model',
 			'delivery_challan_dep/cart_model'
 			
 		));
 	}

 	public function create($post)
 	{
 	 	$this->db->insert('meterial_order', $post);
 		$insert_id = $this->db->insert_id();
   		return  $insert_id; 	
 	}

 	public function update($id, $post)
 	{
 		return $this->db->where('id', $id)->update('meterial_order', $post);
 	}

  	public function all()
 	{
	 	return $this->db->select('meterial_order.*, ordered.nick_name as ordered_by_emp, ordered.photo as ordered_emp_photo, send.nick_name as  send_by_emp , projects.name as project_name')
	 	->from('meterial_order')
	 	->join('employees as ordered','ordered.id = meterial_order.ordered_by', 'LEFT')
	 	->join('employees as send','send.id = meterial_order.send_by', 'LEFT')
	 	->join('projects','projects.id = meterial_order.project_id', 'LEFT')
	 	->where('meterial_order.deleted_by',0)
		->get()->result_array();
 	}
 
  	public function byProject($project_id)
 	{
	 	return $this->db->select('meterial_order.*, ordered.nick_name as ordered_by_emp, send.nick_name as  send_by_emp ')
	 	->from('meterial_order')
	 	->join('employees as ordered','ordered.id = meterial_order.ordered_by', 'LEFT')
	 	->join('employees as send','send.id = meterial_order.send_by', 'LEFT')
	 	->where('project_id',$project_id)
	 	->where('meterial_order.deleted_by',0)
		->get()->result_array();
 	}

 	public function copyToDc($project_id, $order_id)
 	{
 		$items = $this->meterial_order_cart_model->items($order_id);
 		$this->cart_model->clear();
 		foreach ($items as $row) {
 			$item = $this->product_model->FindById($row['item_id']);
 			
 			$post['item_id'] = $row['item_id'];
 			$post['item_model'] = "product";
 			$post['item'] = $row['product_name'];
 			$post['item_type'] ="sale";
 			$post['unit_label'] = $row['unit_name'];
 			$post['unit'] = $row['unit_id'];
 			$post['quantity'] = $row['quantity'];
 			$post['price'] = $item['purchase_price'];
 			$post['tax_ex_in'] = $item['purchase_tax_ex_in'];

 			if ($row['unit_id'] == $item['base_unit_id'])
 				{$quantity = $post['quantity'] ;}
 			else
 				{ $quantity = $post['quantity'] / $item['convertional_rate']; }
 			$post['discound'] = $item['discound'] * $quantity;

			if ($post['tax_ex_in'] == 'ex')
			{
				$gross = ($post['price'] - $item['discound'])* $quantity;
				$post['gst'] = $item['tax_rate']/100 * $gross;
				$post['total'] = $gross + $post['gst'];
			}
			else
			{
				$gross = (($post['price'] - $item['discound']) /($item['tax_rate']+100))*100;
				$post['gst'] = $post['price'] - $gross;
				$post['price'] = $gross;
				$post['total'] = ($gross + $post['gst']) * $quantity;
			}
			$post['gst_rate']  = $item['tax_rate'];
			$post['gst_type']  = $item['tax_type'];
			$post['gst_rate']  = $item['tax_rate'];
			$post['gst_type']  = $item['tax_type'];
			$res = $this->cart_model->create($post);

 		}
 		
 	}

 }
 ?>