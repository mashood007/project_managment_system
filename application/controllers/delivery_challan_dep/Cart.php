<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'Project_model',
 			'customer_model',
 			'employee_model',
 			'delivery_challan_dep/cart_model',
 			'settings/unit_model',
 			'settings/service_model',
 			'product/product_model',
 		)); 		
	}

	public function add($dc_id = '')
	{
		$post = $this->input->post();
		$logged_user = $this->current_user();
		if ($post['item'] != '' && $post['item_type'] != '' && $post['unit'] != '' && $post['quantity'] != '')
		{
			$post['item_id'] = $post['item'];
			$post['item_model'] = 'product';
			$post['created_by'] = $logged_user['user_id'];
			$post['created_at'] = date("j F, Y, g:i a");
			$unit = $this->unit_model->getUnitDetails($post['unit']);

			$post['unit_label']  = $unit['short'];
			$item = $this->product_model->FindById($post['item']);
			if (($post['unit'] == $item['secondary_unit_id']) && ($item['convertional_rate'] > 0))
			{
				$quantity = $post['quantity'] / $item['convertional_rate'];
			}
			else
			{
				$quantity = $post['quantity'];
			}			
			$post['item']  = $item['product_name'];
			$post['discound'] = $item['discound'] * $quantity;
			if ($post['price'] == ""){$post['price'] = $item['purchase_price'];}
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
			if ($dc_id != '')
			{
				$post['status'] = 1;
				$post['delivery_challan_id'] = $dc_id;
			}
						
			$post['gst_rate']  = $item['tax_rate'];
			$post['gst_type']  = $item['tax_type'];
			$post['gst_rate']  = $item['tax_rate'];
			$post['gst_type']  = $item['tax_type'];
			$res = $this->cart_model->create($post);
		}
		if ($dc_id != '')
		{
			$data['cart'] =  $this->cart_model->byDcId($dc_id);
		}
		else
		{
			$data['cart'] =  $this->cart_model->All();
		}
		$this->load->view('delivery_challan/cart', $data);	
	}

	public function delete($id)
	{
		$this->cart_model->delete($id);
		if ($post['invoice'] == '')
		{
			$data['cart'] =  $this->cart_model->All();
		}
		else
		{
			$data['cart'] =  $this->cart_model->byDcId($post['invoice']);			
		}
		$this->load->view('delivery_challan/cart', $data);
	}


	public function update($id)
	{
		$post = $this->input->post();
		$cart_item = $this->cart_model->getDetails($id);
		$price = $cart_item->price;
		$gst = $cart_item->gst_rate;
		$old_qty = $cart_item->quantity;
		
		$item = $this->product_model->FindById($cart_item->item_id);
		if (($cart_item->unit == $item['secondary_unit_id']) && ($item['convertional_rate'] > 0))
		{$quantity = $post['quantity'] / $item['convertional_rate'];}
		else
		{	$quantity = $post['quantity'];	}	
		
		if ($cart_item->tax_ex_in == 'ex')
		{
			$gross = $post['price']* $quantity;
			$post['gst'] = $item['tax_rate']/100 * $gross;
		}
		else
		{
			$gross = ($post['price'] /($item['tax_rate']+100))*100;
			$post['gst'] = $post['price'] - $gross;
			$post['price'] = $gross;
		}

		$post['total'] = $gross + $post['gst'];
		$this->cart_model->update($id, $post);
		if ($post['invoice'] == '')
		{
			$data['cart'] =  $this->cart_model->All();
		}
		else
		{
			$data['cart'] =  $this->cart_model->byDcId($post['invoice']);			
		}
		$this->load->view('delivery_challan/cart', $data);
	}


	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}


}