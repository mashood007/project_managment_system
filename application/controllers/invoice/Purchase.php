<?php

//status of temp_purchase_mode
// 0 -> temp
// 1 -> invoice 
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends CI_Controller {

  public function __construct()
	{
    parent::__construct();
 	$this->load->model(array(
 			'settings/unit_model',
 			'settings/service_model',
 			'product/product_model',
 			'invoice/purchase_model',
 			'invoice/temp_purchase_model',
 			'party_model', 
 			'customer_model',
 			'temp_party_model',
 			'invoice/purchase_return_model',
 			'settings/cess_model',
 			'non_sale_item_model'
 		));


	}

  	public function index()
	{
		$logged_user = $this->current_user();
		if (count($this->permission_model->check(20, $logged_user['role'])) < 1)
		{
			redirect('home/no_permission');
		}
		$data['title']  = "Purchase invoice";
		$data['parties']=$this->party_model->All();
		$data['customers']=$this->customer_model->AllCustomers();		
		$data['last_invoice_no']=$this->purchase_model->LastInvoiceNo();
		$this->load->view('layouts/header', $data);
		$this->load->view('account_book/js');
		$this->load->view('invoice/purchase/index', $data);
		$this->load->view('layouts/footer');
		
	}


	public function invoice_info($invoice_no)
	{	
		$data['cess'] = $this->cess_model->AllCess();
		$data['invoice']=$this->purchase_model->getDetails($invoice_no);
		if($data['invoice']->selled_by == 'party')
		{
			$party = $this->party_model->getDetails($data['invoice']->party_id);
			$data['seller'] = "<b>".$party['name']."</b>,&nbsp;<font size='2'>".$party['city'].",&nbsp;".$party['phone']."<br>  GSTIN: ".$party['gstin']."</font>";
		}
		else if ($data['invoice']->selled_by == 'temp_party')
		{
			$party = $this->temp_party_model->getDetails($data['invoice']->party_id);
			$data['seller'] = "<b>".$party['name']."</b>,&nbsp;<font size='2'>".$party['phone']."<br>  GSTIN: ".$party['gstin']."</font>";
		}
		else
		{
			$party = $this->customer_model->getDetails($data['invoice']->party_id);
			$data['seller'] = "<b>".$party['full_name']."</b>,&nbsp;<font size='2'>".$party['mobile1'];
		}
		$data['cart'] =  $this->temp_purchase_model->byInvoice($invoice_no);
		$this->load->view('layouts/header');
		$this->load->view('invoice/purchase/invoice_info', $data);
		$this->load->view('layouts/footer');
	}

	public function add()
	{	
		$logged_user = $this->current_user();
		if (count($this->permission_model->check(20, $logged_user['role'])) < 1)
		{
			redirect('home/no_permission');
		}
		$this->load->library('upload');
		$post = $this->input->post();
		$this->form_validation->set_rules('mode',"Mode",'required');
		if($this->form_validation->run() === true)
		{
			 if ($post['purchase_date'] == '')
			 {
			$post['purchase_date'] = date('Y-m-d');
			 }
			 else
			 {
			 	$date = str_replace('/', '-', $post['purchase_date']);
			 	$post['purchase_date'] =  date("Y-m-d", strtotime($date));
			 }
		   $logged_user = $this->current_user();
		   $post['created_by'] = $logged_user['user_id'];
		   $post['created_at'] = date("j F, Y, g:i a");		   
		   $post['updated_by'] = $logged_user['user_id'];
		   $post['updated_at'] = date("j F, Y, g:i a");	
		   $logo_path = '';
	       $config = [
	            'upload_path'   => 'upload/purchase_invoice/',
	            'allowed_types' => 'gif|jpg|png|jpeg|svg', 
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
	       
			$res=$this->purchase_model->create($post);
			if($res)
			{
				$this->temp_purchase_model->invoice($res);
				$this->session->set_flashdata('message', "New Purchase Invoice  added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
		}
		redirect('/invoice/purchase', 'refresh');

	}

  	public function edit($id)
	{
		$logged_user = $this->current_user();
		if (count($this->permission_model->check(22, $logged_user['role'])) < 1)
		{
			redirect('home/no_permission');
		}	
		$data['title']  = "Purchase invoice";
		$data['parties']=$this->party_model->All();
		$data['customers']=$this->customer_model->AllCustomers();		
		$data['invoice']=$this->purchase_model->getDetails($id);
		if($data['invoice']->selled_by == 'party')
		{
			$party = $this->party_model->getDetails($data['invoice']->party_id);
			$data['seller'] = "<b>".$party['name']."</b>,&nbsp;<font size='2'>".$party['city'].",&nbsp;".$party['phone']."<br>  GSTIN: ".$party['gstin']."</font>";
		}
		else if ($data['invoice']->selled_by == 'temp_party')
		{
			$party = $this->temp_party_model->getDetails($data['invoice']->party_id);
			$data['seller'] = "<b>".$party['name']."</b>,&nbsp;<font size='2'>".$party['phone']."<br>  GSTIN: ".$party['gstin']."</font>";
		}
		else
		{
			$party = $this->customer_model->getDetails($data['invoice']->party_id);
			$data['seller'] = "<b>".$party['full_name']."</b>,&nbsp;<font size='2'>".$party['mobile1'];
		}	
		$this->load->view('layouts/header');
		$this->load->view('invoice/purchase/edit', $data);
		$this->load->view('layouts/footer');
		
	}

	public function update($id)
	{
		$this->form_validation->set_rules('invoice_no',"Invoice",'required');
		$post = $this->input->post();
			 if ($post['purchase_date'] == '')
			 {
				$post['purchase_date'] = date('Y-m-d');
			 }
			 else
			 {
			 	$date = str_replace('/', '-', $post['purchase_date']);
			 	$post['purchase_date'] =  date("Y-m-d", strtotime($date));
			 }
			$logged_user = $this->current_user();
		    $post = $this->input->post();
		    $post['updated_by'] = $logged_user['user_id'];
		    $post['updated_at'] = date("j F, Y, g:i a");	
			unset($post['invoice_no']);
			$res=$this->purchase_model->update($id,$post);
			//print_r($post);
			if($res)
			{
				$this->session->set_flashdata('message', "Purchase Invoice  Updated");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
		redirect('/invoice/purchase/invoice_info/'.$id, 'refresh');			
	}

	 public function invoice_return($id)
	 {
		$logged_user = $this->current_user();
		if (count($this->permission_model->check(23, $logged_user['role'])) < 1)
		{
			redirect('home/no_permission');
		}
		$data['parties']=$this->party_model->All();
		$data['customers']=$this->customer_model->AllCustomers();		
		$data['invoice']=$this->purchase_model->getDetails($id);
		$data['products'] = $this->product_model->All();
		$this->purchase_return_model->moveToReturnCart($id, $logged_user['user_id']);
		if($data['invoice']->selled_by == 'party')
		{
			$party = $this->party_model->getDetails($data['invoice']->party_id);
			$data['seller'] = "<b>".$party['name']."</b>,&nbsp;<font size='2'>".$party['city'].",&nbsp;".$party['phone']."<br>  GSTIN: ".$party['gstin']."</font>";
		}
		else if ($data['invoice']->selled_by == 'temp_party')
		{
			$party = $this->temp_party_model->getDetails($data['invoice']->party_id);
			$data['seller'] = "<b>".$party['name']."</b>,&nbsp;<font size='2'>".$party['phone']."<br>  GSTIN: ".$party['gstin']."</font>";
		}
		else
		{
			$party = $this->customer_model->getDetails($data['invoice']->party_id);
			$data['seller'] = "<b>".$party['full_name']."</b>,&nbsp;<font size='2'>".$party['mobile1'];
		}
		$data['purchase_return_no'] = $this->purchase_return_model->LastInvoiceNo();	
	 	$this->load->view('layouts/header');
	 	$this->load->view('invoice/purchase/return', $data);
	 	$this->load->view('layouts/footer');		
	 }

	public function return_info($id)
	{	
		$logged_user = $this->current_user();
		if (count($this->permission_model->check(23, $logged_user['role'])) < 1)
		{
			redirect('home/no_permission');
		}
		$data['cess'] = $this->cess_model->AllCess();
		$data['invoice']=$this->purchase_return_model->getDetails($id);
		if($data['invoice']->selled_by == 'party')
		{
			$party = $this->party_model->getDetails($data['invoice']->party_id);
			$data['seller'] = "<b>".$party['name']."</b>,&nbsp;<font size='2'>".$party['city'].",&nbsp;".$party['phone']."<br>  GSTIN: ".$party['gstin']."</font>";
		}
		else if ($data['invoice']->selled_by == 'temp_party')
		{
			$party = $this->temp_party_model->getDetails($data['invoice']->party_id);
			$data['seller'] = "<b>".$party['name']."</b>,&nbsp;<font size='2'>".$party['phone']."<br>  GSTIN: ".$party['gstin']."</font>";
		}
		else
		{
			$party = $this->customer_model->getDetails($data['invoice']->party_id);
			$data['seller'] = "<b>".$party['full_name']."</b>,&nbsp;<font size='2'>".$party['mobile1'];
		}
		$data['cart'] =  $this->purchase_return_model->getCart($id);
		$this->load->view('layouts/header');
		$this->load->view('invoice/purchase/return_info', $data);
		$this->load->view('layouts/footer');
	}


	public function edit_return($id)
	{
		$logged_user = $this->current_user();
		if (count($this->permission_model->check(23, $logged_user['role'])) < 1)
		{
			redirect('home/no_permission');
		}
		$data['products'] = $this->product_model->All();		
		$data['cess'] = $this->cess_model->AllCess();
		$data['invoice']=$this->purchase_return_model->getDetails($id);
		if($data['invoice']->selled_by == 'party')
		{
			$party = $this->party_model->getDetails($data['invoice']->party_id);
			$data['seller'] = "<b>".$party['name']."</b>,&nbsp;<font size='2'>".$party['city'].",&nbsp;".$party['phone']."<br>  GSTIN: ".$party['gstin']."</font>";
		}
		else if ($data['invoice']->selled_by == 'temp_party')
		{
			$party = $this->temp_party_model->getDetails($data['invoice']->party_id);
			$data['seller'] = "<b>".$party['name']."</b>,&nbsp;<font size='2'>".$party['phone']."<br>  GSTIN: ".$party['gstin']."</font>";
		}
		else
		{
			$party = $this->customer_model->getDetails($data['invoice']->party_id);
			$data['seller'] = "<b>".$party['full_name']."</b>,&nbsp;<font size='2'>".$party['mobile1'];
		}
		$data['cart'] =  $this->purchase_return_model->getCart($id);
		$this->load->view('layouts/header');
		$this->load->view('invoice/purchase_return/edit', $data);
		$this->load->view('layouts/footer');
	}

	 public function create_return()
	 {
	 	$post = $this->input->post();
	 	$logged_user = $this->current_user();
		$post['created_by'] = $logged_user['user_id'];
		$post['created_at'] = date("j F, Y, g:i a");	
		$post['updated_by'] = $logged_user['user_id'];
		$post['updated_at'] = date("j F, Y, g:i a");
		$purchase_return_id = $this->purchase_return_model->create($post);
		$res = $this->purchase_return_model->updatePurchaseNo($purchase_return_id, $post['invoice_no']);
		if($res)
		{
			$this->session->set_flashdata('message', "New Purchase Return  added successfully");
		}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
		}
	 	redirect('/invoice/purchase_report', 'refresh');
	 }

	public function items()
	{
		$post = $this->input->post();
		if ($post['item_category'] == 'sale')
		{
		$data['products'] = $this->product_model->All();
		$this->load->view('invoice/purchase/sale_items', $data);
		}
		else if($post['item_category'] == 'no_sale')
		{
		$data['products'] = $this->non_sale_item_model->All();
		$this->load->view('invoice/purchase/non_sale_items', $data);
		}
	}

	public function add_item()
	{
		$post = $this->input->post();
		$logged_user = $this->current_user();
		if ($post['item'] != '' && $post['item_type'] == 'sale' && $post['unit'] != '' && $post['quantity'] != '')
		{
			$post['item_id'] = $post['item'];
			$post['item_model'] = 'product';
			$post['created_by'] = $logged_user['user_id'];
			$post['created_at'] = date("j F, Y, g:i a");
			$unit = $this->unit_model->getUnitDetails($post['unit']);

			$post['unit_label']  = $unit['full_name'];
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
			if ($post['price'] == ""){$post['price'] = $item['purchase_price'];}
			if ($post['tax_ex_in'] == 'ex')
			{
				$gross = $post['price']* $quantity;
				$post['gst'] = $item['tax_rate']/100 * $gross;
				$post['total'] = $gross + $post['gst'];
			}
			else
			{
				$gross = ($post['price'] /($item['tax_rate']+100))*100;
				$post['gst'] = $post['price'] - $gross;
				$post['price'] = $gross;
				$post['total'] = ($gross + $post['gst']) * $quantity;
			}


			
			$post['gst_rate']  = $item['tax_rate'];
			$post['gst_type']  = $item['tax_type'];
			$post['gst_rate']  = $item['tax_rate'];
			$post['gst_type']  = $item['tax_type'];
			
			$this->temp_purchase_model->create($post);

		}
		elseif ($post['item'] != '' && $post['item_type'] == 'no_sale' && $post['unit'] != '' && $post['quantity'] != '') {
			$post['item_id'] = $post['item'];
			$post['item_model'] = 'non_sale_item';
			$post['created_by'] = $logged_user['user_id'];
			$post['created_at'] = date("j F, Y, g:i a");
			$unit = $this->unit_model->getUnitDetails($post['unit']);
			$post['unit_label']  = $unit['full_name'];
			$quantity = $post['quantity'];
			$item = $this->non_sale_item_model->get($post['item']);
			$post['item']  = $item['name'];
			$post['total'] = $post['price'] * $quantity;
			$this->temp_purchase_model->create($post);
		}
		$data['cart'] =  $this->temp_purchase_model->All();
		echo $this->load->view('invoice/purchase/cart', $data);			
	}



	public function add_item_to_invoice($invoice)
	{
		$post = $this->input->post();
		$logged_user = $this->current_user();
	if ($post['item'] != '' && $post['item_type'] == 'sale' && $post['unit'] != '' && $post['quantity'] != '')
		{
			$post['item_id'] = $post['item'];
			$post['item_model'] = 'non_sale_item';
			$post['created_by'] = $logged_user['user_id'];
			$post['created_at'] = date("j F, Y, g:i a");
			$unit = $this->unit_model->getUnitDetails($post['unit']);

			$post['unit_label']  = $unit['full_name'];
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
			if ($post['price'] == ""){$post['price'] = $item['purchase_price'];}
			if ($post['tax_ex_in'] == 'ex')
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
			$post['gst_rate']  = $item['tax_rate'];
			$post['gst_type']  = $item['tax_type'];
			$post['status'] = 1;
			$post['invoice_no'] = $invoice;
			$this->temp_purchase_model->create($post);

		}
		elseif ($post['item'] != '' && $post['item_type'] == 'no_sale' && $post['unit'] != '' && $post['quantity'] != '') {
			$post['item_id'] = $post['item'];
			$post['item_model'] = 'non_sale_item';
			$post['created_by'] = $logged_user['user_id'];
			$post['created_at'] = date("j F, Y, g:i a");
			$unit = $this->unit_model->getUnitDetails($post['unit']);
			$post['unit_label']  = $unit['full_name'];
			$quantity = $post['quantity'];
			$item = $this->non_sale_item_model->get($post['item']);
			$post['item']  = $item['name'];
			$post['total'] = $post['price'] * $quantity;
			$post['invoice_no'] = $invoice;
			$post['status'] = 1;
			$this->temp_purchase_model->create($post);
		}

		$data['cart'] =  $this->temp_purchase_model->byInvoice($invoice);
		$this->load->view('invoice/purchase/cart', $data);			
	}


	public function add_item_to_invoice_return($invoice_no, $from='')
	{

		$post = $this->input->post();
		$logged_user = $this->current_user();
	if ($post['item'] != ''  && $post['unit'] != '' && $post['quantity'] != '')
		{
			$post['item_id'] = $post['item'];
			$post['item_model'] = 'product';
			$post['created_by'] = $logged_user['user_id'];
			$post['created_at'] = date("j F, Y, g:i a");
			$unit = $this->unit_model->getUnitDetails($post['unit']);

			$post['unit_label']  = $unit['full_name'];
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
			if (!isset($post['price'])){$post['price'] = $item['purchase_price'];}
			$gross = ($post['price'] /($item['tax_rate']+100))*100;
			$post['gst'] = $post['price'] - $gross;
			$post['price'] = $gross;
			$post['total'] = $gross + $post['gst'];
			$post['gst_rate']  = $item['tax_rate'];
			$post['gst_type']  = $item['tax_type'];
			$post['invoice_no'] = $invoice_no;

			if ($from)
			{
				$post['status'] = 1;
				$post['purchase_return_id'] =$from;
			}
			else
			{
				$post['status'] = 0;

			}
			$this->purchase_return_model->addToCart($post);
			//print_r($post);
		}

			if ($from)
			{
				$data['dn_id'] = $from;
				$data['cart'] =  $this->purchase_return_model->getCart($from);
				$this->load->view('invoice/purchase_return/edit_cart', $data);	
			}
			else
			{
				$data['cart'] =  $this->purchase_return_model->byInvoice($invoice_no);
				$this->load->view('invoice/purchase_return/cart', $data);
			}

	}


	public function cart()
	{
		$data['cart'] =  $this->temp_purchase_model->All();
		$this->load->view('invoice/purchase/cart', $data);		
	}

	public function return_cart($invoice_no)
	{
		$data['cart'] =  $this->purchase_return_model->byInvoice($invoice_no);
		$this->load->view('invoice/purchase_return/cart', $data);	
	}

	public function edit_return_cart($id)
	{
		$data['dn_id'] = $id;
		$data['cart'] =  $this->purchase_return_model->getCart($id);
		$this->load->view('invoice/purchase_return/edit_cart', $data);	
	}

	public function invoice_cart($id)
	{
		$data['cart'] =  $this->temp_purchase_model->byInvoice($id);
		$this->load->view('invoice/purchase/cart', $data);		
	}

	public function delete_temp($id)
	{	$post = $this->input->post();
		$this->temp_purchase_model->delete($id);
		if ($post['invoice'] == '')
		{
			$data['cart'] =  $this->temp_purchase_model->All();
		}
		else
		{
			$data['cart'] =  $this->temp_purchase_model->byInvoice($id);			
		}
		$this->load->view('invoice/purchase/cart', $data);	
	}

    public function delete_return_item($id, $invoice_no)
    {
    	$this->purchase_return_model->deleteItem($id);
		$data['cart'] =  $this->purchase_return_model->byInvoice($invoice_no);
		$this->load->view('invoice/purchase_return/cart', $data);	
    }

    public function delete_return_cart($id, $dn_id)
    {
    	$this->purchase_return_model->deleteItem($id);
		$data['dn_id'] = $dn_id;
		$data['cart'] =  $this->purchase_return_model->getCart($dn_id);
		$this->load->view('invoice/purchase_return/edit_cart', $data);	
    }

	public function update_cart($id)
	{
		$post = $this->input->post();
		$cart_item = $this->temp_purchase_model->getDetails($id);
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
		$this->temp_purchase_model->update($id, $post);
		if ($post['invoice'] == '')
		{
			$data['cart'] =  $this->temp_purchase_model->All();
		}
		else
		{
			$data['cart'] =  $this->temp_purchase_model->byInvoice($id);			
		}
		$this->load->view('invoice/purchase/cart', $data);	
	}
	
	public function update_return($id)
	{
		$res = $this->purchase_return_model->update_data($id, $this->input->post());
		if($res)
		{	
			$this->session->set_flashdata('message', "Purchase Return Updated successfully");
		}else{
			$this->session->set_flashdata('exception', "Something went wrong, please try again");
		}
		redirect('invoice/purchase/return_info/'.$id);
	}


	public function update_return_cart($id, $dn_id = '')
	{
		$post = $this->input->post();
		$cart_item = $this->purchase_return_model->getCartItem($id);
		$price = $cart_item->price;
		$gst = $cart_item->gst_rate;
		$old_qty = $cart_item->quantity;
	
		$item = $this->product_model->FindById($cart_item->item_id);
		if (($cart_item->unit == $item['secondary_unit_id']) && ($item['convertional_rate'] > 0))
		{$quantity = $post['quantity'] / $item['convertional_rate'];}
		else
		{	$quantity = $post['quantity'];	}	

		$post['gst'] = $gst/$old_qty * $quantity ;
		$post['total'] = $cart_item->total / $old_qty * $quantity ;
		$res = $this->purchase_return_model->updateChart($id, $post);
		if ($dn_id)
		{
			$data['dn_id'] = $dn_id;
			$data['cart'] =  $this->purchase_return_model->getCart($dn_id);
			$this->load->view('invoice/purchase_return/edit_cart', $data);				
		}
		else
		{
			$data['cart'] =  $this->purchase_return_model->byInvoice($cart_item->invoice_no);
			$this->load->view('invoice/purchase_return/cart', $data);
		}		
	}

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}

}