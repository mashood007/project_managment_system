<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_order extends CI_Controller {

  public function __construct()
	{
    parent::__construct();
 	$this->load->model(array(
 			'settings/unit_model',
 			'settings/service_model',
 			'product/product_model',
 			'invoice/purchase_model',
 			'invoice/temp_purchase_model',
 			'invoice/purchase_order_model',
 			'invoice/purchase_order_cart_model',
 			'party_model', 
 			'customer_model', 
 			'temp_party_model'
 		));


	}

  	public function index()
	{
		$logged_user = $this->current_user();
		if (count($this->permission_model->check(21, $logged_user['role'])) < 1)
		{
			redirect('home/no_permission');
		}
		$data['title']  = "Purchase invoice Report";
		$data['purchase_orders'] = $this->purchase_order_model->All();
		$this->load->view('layouts/header');
		$this->load->view('invoice/purchase_order/index', $data);
		$this->load->view('layouts/footer');
		
	}


	public function create()
	{
		$logged_user = $this->current_user();
		if (count($this->permission_model->check(19, $logged_user['role'])) < 1)
		{
			redirect('home/no_permission');
		}
		$data['last_purchase_order_no']=$this->purchase_order_model->LastOrderNo();
		$data['parties']=$this->party_model->All();
		$data['customers']=$this->customer_model->AllCustomers();
		
		$this->load->view('layouts/header');
		$this->load->view('invoice/purchase_order/add', $data);
		$this->load->view('layouts/footer');
	}

	public function save()
	{
		$this->load->library('upload');
		$post = $this->input->post();
		$this->form_validation->set_rules('mode',"Mode",'required');
		if($this->form_validation->run() === true)
		{
		   $logged_user = $this->current_user();
		   $post['created_by'] = $logged_user['user_id'];
		   $post['created_at'] = date("j F, Y, g:i a");		   
		   $post['updated_by'] = $logged_user['user_id'];
		   $post['updated_at'] = date("j F, Y, g:i a");	
		   $logo_path = '';
	       $config = [
	            'upload_path'   => 'upload/purchase_order/',
	            'allowed_types' => 'gif|jpg|png|jpeg', 
	            'overwrite'     => false,
	            'maintain_ratio' => true,
	            'encrypt_name'  => true,
	            'remove_spaces' => true,
	            'file_ext_tolower' => true 
	        ];
	        $this->upload->initialize($config);
	        if ( ! $this->upload->do_upload('photo'))
	        {
	            $error = array('error' => $this->upload->display_errors());
	         }
	        else
	        {
	        	$data = array('upload_data' => $this->upload->data());
	        	$logo_path = $this->upload->data('file_name');
	        }
	        $post['photo'] = $logo_path;
	       
			$res=$this->purchase_order_model->create($post);
			if($res)
			{
				$this->purchase_order_cart_model->order($res);
				$this->session->set_flashdata('message', "New Purchase Order  added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
		}
		redirect('/invoice/purchase_order/create', 'refresh');

	}

	public function cart()
	{
		$data['cart'] =  $this->purchase_order_cart_model->All();
		echo $this->load->view('invoice/purchase_order/cart', $data);			

	}

	public function convert_cart($id)
	{
		$data['cart'] =  $this->purchase_order_cart_model->getbyOrderId($id);
		echo $this->load->view('invoice/purchase_order/convert_cart', $data);			

	}
	

	public function add_item($purchase_order_no = '')
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

			$post['unit_label']  = $unit['full_name'];
			$item = $this->product_model->FindById($post['item']);
			$post['item']  = $item['product_name'];
			if ($post['price'] == ""){$post['price'] = $item['purchase_price'];}
			if ($post['tax_ex_in'] == 'ex')
			{
				$gross = $post['price']* $post['quantity'];
				$post['gst'] = $item['tax_rate']/100 * $gross;
				$post['total'] = $gross + $post['gst'];
			}
			else
			{
				$gross = ($post['price'] /($item['tax_rate']+100))*100;
				$post['gst'] = $post['price'] - $gross;
				$post['price'] = $gross;
				$post['total'] = ($gross + $post['gst']) * $post['quantity'];
			}


			
			$post['gst_rate']  = $item['tax_rate'];
			$post['gst_type']  = $item['tax_type'];
			if ($purchase_order_no !='')
				{
					$post['purchase_order_no'] = $purchase_order_no;
					$post['status'] = 1;
				 }
			$this->purchase_order_cart_model->create($post);

		}
		if ($purchase_order_no =='')
		{
			$data['cart'] =  $this->purchase_order_cart_model->All();
			echo $this->load->view('invoice/purchase_order/cart', $data);
		}
		else{
			$data['cart'] =  $this->purchase_order_cart_model->getbyOrderId($purchase_order_no);
			echo $this->load->view('invoice/purchase_order/convert_cart', $data);			
		}			
	}


	public function delete_temp($id, $order_no = '')
	{	$post = $this->input->post();
		$this->purchase_order_cart_model->delete($id);
		if ($order_no == '')
		{
			$data['cart'] =  $this->purchase_order_cart_model->All();
			echo $this->load->view('invoice/purchase_order/cart', $data);
		}
		else
		{
		$data['cart'] =  $this->purchase_order_cart_model->getbyOrderId($order_no);
		echo $this->load->view('invoice/purchase_order/convert_cart', $data);				
		}
	}

	public function update_cart($id, $order_no = '')
	{
		$post = $this->input->post();
		$cart_item = $this->purchase_order_cart_model->getCartItem($id);
		$price = $cart_item->price;
		$gst = $cart_item->gst_rate;
		$old_qty = $cart_item->quantity;
		$post['gst'] = $gst/$old_qty * $post['quantity'];
		$post['total'] = ($gst/$old_qty + $post['price']) * $post['quantity'];
		$this->purchase_order_cart_model->update($id, $post);

		if ($order_no == '')
		{
			$data['cart'] =  $this->purchase_order_cart_model->All();
			echo $this->load->view('invoice/purchase_order/cart', $data);
		}
		else
		{
		$data['cart'] =  $this->purchase_order_cart_model->getbyOrderId($order_no);
		echo $this->load->view('invoice/purchase_order/convert_cart', $data);				
		}
	}
	
	public function cancel_order($id)
	{
		$logged_user = $this->current_user();
		$this->purchase_order_model->cancel($id, $logged_user['user_id']);
		echo "<script>location.reload()</script>";
	}

	public function convert($id)
	{
		$data['purchase_order']=$this->purchase_order_model->getById($id);
		if($data['purchase_order']->selled_by == 'party')
		{
			$party = $this->party_model->getDetails($data['purchase_order']->party_id);
			$data['seller'] = "<b>".$party['name']."</b>,&nbsp;<font size='2'>".$party['city'].",&nbsp;".$party['phone']."<br>  GSTIN: ".$party['gstin']."</font>";
		}
		else if ($data['purchase_order']->selled_by == 'temp_party')
		{
			$party = $this->temp_party_model->getDetails($data['purchase_order']->party_id);
			$data['seller'] = "<b>".$party['name']."</b>,&nbsp;<font size='2'>".$party['phone']."<br>  GSTIN: ".$party['gstin']."</font>";
		}
		else
		{
			$party = $this->customer_model->getDetails($data['purchase_order']->party_id);
			$data['seller'] = "<b>".$party['full_name']."</b>,&nbsp;<font size='2'>".$party['mobile1'];
		}		
		$this->load->view('layouts/header');
		$this->load->view('invoice/purchase_order/convert', $data);
		$this->load->view('layouts/footer');
	}

	public function convert_to_invoice($order_no)
	{
		$post  = $this->input->post();
		$logged_user = $this->current_user();
		$post['id'] = $order_no;
		$post['updated_by'] = $logged_user['user_id'];
		$post['updated_at'] = date("j F, Y, g:i a");		
		$this->purchase_order_model->updateAndDelete($post);
		$invoice_no = $this->purchase_order_model->convert($order_no, $logged_user['user_id']);
		$this->purchase_order_cart_model->moveToInvoiceCart($order_no, $invoice_no, $logged_user['user_id']);

		if($invoice_no)
		{
		$this->session->set_flashdata('message', "Purchase Order is converted into new Purchase Invoice(".$invoice_no.")");
		}else{
			$this->session->set_flashdata('exception', "Something went wrong, please try again");
		}

		redirect('/invoice/purchase_order', 'refresh');
	}

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}

}
?>