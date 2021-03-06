<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Temp_sales_return extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'settings/unit_model',
 			'customer_model',
 			'settings/service_model',
 			'product/product_model',
 			'invoice/tempsales_model',
 			'invoice/tempsalesreturn_model'
 		));


}


	public function add_item($credit_note = '')
	{
		$logged_user = $this->current_user();
		$post = $this->input->post();

	if ($post['item_id'] != '' && $post['type'] != '' && $post['unit_id'] != '' && $post['quantity'] != '')
		{
			
			$post['created_by'] = $logged_user['user_id'];
			$post['created_at'] = date("j F, Y, g:i a");

			if ($post['type'] == "service")
			{
				$post['item_model'] = 'service';
				$item = $this->service_model->FindById($post['item_id']);
				$post['item']  = $item['service'];
				$post['unit']  = $item['unit_name'];
				
				if ($post['price'] == ""){$post['price'] = $item['sales_price'];}
				$discound = ($post['discound'] == "") ? $item['discound'] : $post['discound'];
				$post['discound'] = $discound * $post['quantity'];

				$gross = ($post['price'] - $item['discound'])* $post['quantity'];

				$post['gst'] = $item['tax']/100 * $gross;
				$post['total'] = $gross + $post['gst'];
			}
			else
			{
				$post['item_model'] = 'product';
				$unit = $this->unit_model->getUnitDetails($post['unit_id']);
				$post['unit']  = $unit['full_name'];
				$item = $this->product_model->FindById($post['item_id']);
				if (($post['unit_id'] == $item['secondary_unit_id']) && ($item['convertional_rate'] > 0))
				{
					$quantity = $post['quantity'] / $item['convertional_rate'];
				}
				else
				{
					$quantity = $post['quantity'];
				}
				$post['item']  = $item['product_name'];
				if ($post['price'] == ""){$post['price'] = $item['sales_price'];}
				$discound = ($post['discound'] == "") ? $item['discound'] : $post['discound'];
				$post['discound'] = $discound * $quantity;

				$gross = ($post['price'] - $item['discound'])* $quantity;

				$post['gst'] = $item['tax_rate']/100 * $gross;
				$post['total'] = $gross + $post['gst'];

			}	

			//bill_area
			if ($credit_note)
			{
				$post['status'] = 2;
				$post['invoice_no'] = $credit_note;
			}
			$this->tempsalesreturn_model->create($post);
			//echo "succuss";
		}
		else
		{
			//print_r($post);
			//echo "error";
		}
		if ($credit_note)
		{
			$data['credit_note'] = $credit_note;
			$data['bill'] =  $this->tempsalesreturn_model->Items($credit_note);
		    $this->load->view('invoice/sales/return_bill', $data);
		}
		else
		{
			$data['bill'] =  $this->tempsalesreturn_model->All();
			$this->load->view('invoice/sales/return_bill', $data);
		}

	}

	public function delete($credit_note = '')
	{
		$post = $this->input->post();
		$this->tempsalesreturn_model->delete($post['id']);
		if ($credit_note)
		{
			$data['credit_note'] = $credit_note;
			$data['bill'] =  $this->tempsalesreturn_model->Items($credit_note);
		    $this->load->view('invoice/sales/return_bill', $data);
		}
		else
		{
			$data['bill'] =  $this->tempsalesreturn_model->All();
			$this->load->view('invoice/sales/return_bill', $data);
		}

	}

	public function bill()
	{
		$data['bill'] =  $this->tempsales_model->All();
		echo $this->load->view('invoice/sales/return_bill', $data);
	}

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}

}