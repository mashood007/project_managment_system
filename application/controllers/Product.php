<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'settings/unit_model',
 			'product/category_model',
 			'product/subcategory_model',
 			'product/product_model',
 			'settings/tax_model',
 			'invoice/temp_purchase_model',
 			'stock_model',
 			'invoice/tempsales_model',
 			'party_model',
 			'temp_party_model',
 			'customer_model'
 		));
}
	public function new_product()
	{
		//stock = opening_stock
		$image_path = '';
        $this->load->library('upload');
		$logged_user = $this->current_user();
		$this->form_validation->set_rules('category_id',"Category Name",'required');
		$this->form_validation->set_rules('sales_price',"Sale Price",'required');		
		$this->form_validation->set_rules('purchase_price',"Purchase Price",'required');		
		$this->form_validation->set_rules('base_unit_id',"Base Unit",'required');
		$this->form_validation->set_rules('product_name',"Product Name",'required');
		if($this->form_validation->run() === true)
		{


       $config = [
            'upload_path'   => 'upload/product_image/',
            'allowed_types' => 'gif|jpg|png|jpeg|svg', 
            'overwrite'     => false,
            'maintain_ratio' => true,
            'encrypt_name'  => true,
            'remove_spaces' => true,
            'file_ext_tolower' => true 
        ];

        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload('image'))
        {
            $error = array('error' => $this->upload->display_errors());
         }
        else
        {
        $data = array('upload_data' => $this->upload->data());
        $image_path = $this->upload->data('file_name');
        }
        	$post = $this->input->post();
			$post['created_by'] = $logged_user['user_id'];
			$post['updated_by'] = $logged_user['user_id'];
			$post['created_at'] = date("j F, Y, g:i a");
			$post['updated_at'] = date("j F, Y, g:i a");
			$post['image'] = $image_path;

			$res=$this->product_model->create($post);
			if($res)
			{
				$this->session->set_flashdata('message', "Product added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
			redirect('product/new_product');
		}

		$data['categories'] = $this->category_model->AllCategories();
		$data['units'] = $this->unit_model->All();
		$data['tax'] = $this->tax_model->AllTaxs();
		$this->load->view('layouts/header');
		$this->load->view('product/new_product', $data);
		$this->load->view('layouts/footer');
		
	}

	public function edit($id)
	{
		$logged_user = $this->current_user();
		$product =  $this->product_model->FindById($id);
		$image_path = $product['image'];
        $this->load->library('upload');
		$this->form_validation->set_rules('category_id',"Category Name",'required');
		$this->form_validation->set_rules('sales_price',"Sale Price",'required');		
		$this->form_validation->set_rules('purchase_price',"Purchase Price",'required');		
		$this->form_validation->set_rules('base_unit_id',"Base Unit",'required');
		$this->form_validation->set_rules('product_name',"Product Name",'required');
		if($this->form_validation->run() === true)
		{


       $config = [
            'upload_path'   => 'upload/product_image/',
            'allowed_types' => 'gif|jpg|png|jpeg|svg', 
            'overwrite'     => false,
            'maintain_ratio' => true,
            'encrypt_name'  => true,
            'remove_spaces' => true,
            'file_ext_tolower' => true 
        ];

        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload('image'))
        {
            $error = array('error' => $this->upload->display_errors());
            $image_path = $product['image'];
         }
        else
        {
        $data = array('upload_data' => $this->upload->data());
        $image_path = $this->upload->data('file_name');
        }
        	$post = $this->input->post();
			$post['updated_by'] = $logged_user['user_id'];
			$post['updated_at'] = date("j F, Y, g:i a");
			$post['image'] = $image_path;

			$res=$this->product_model->update($id, $post);
			if($res)
			{
				$this->session->set_flashdata('message', "Product updated successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
			redirect('product/info/'.$id);
		}

		$data['product'] =  $product;
		$data['categories'] = $this->category_model->AllCategories();
		$category_id =  $data['product']['category_id'];
		$data['subcategories'] = $this->subcategory_model->categorySubcategories($category_id);
		$data['units'] = $this->unit_model->All();
		$data['tax'] = $this->tax_model->AllTaxs();
		$this->load->view('layouts/header');
		$this->load->view('product/edit', $data);
		$this->load->view('layouts/footer');		
	}

	public function product_category()
	{
		$this->form_validation->set_rules('name'," Name",'required');
		$this->form_validation->set_rules('name', 'Name', 'is_unique[category.name]');
		if($this->form_validation->run() === true)
		{
			$res=$this->category_model->create($this->input->post());
			if($res)
			{
				$this->session->set_flashdata('message', "Category added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
			redirect('product/product_category');
		}
		$data['categories'] = $this->category_model->AllCategories();
		$this->load->view('layouts/header');
		$this->load->view('product/product_category', $data);
		$this->load->view('layouts/footer');
	}

	public function product_subcategory()
	{
		$this->form_validation->set_rules('subcategory_name',"Sub Category Name",'required');
		$this->form_validation->set_rules('category_id',"Category",'required');		
		if($this->form_validation->run() === true)
		{
			$res=$this->subcategory_model->create($this->input->post());
			if($res)
			{
				$this->session->set_flashdata('message', "Sub Category added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
			redirect('product/product_subcategory');
		}

		$data['categories'] = $this->category_model->AllCategories();
		$data['subcategories'] = $this->subcategory_model->All();
		$this->load->view('layouts/header');
		$this->load->view('product/product_subcategory', $data);
		$this->load->view('layouts/footer');
	}

	public function subcategories()
	{	$post =  $this->input->post();
		$category_id =  $post['category_id'];

		$data['subcategories'] = $this->subcategory_model->categorySubcategories($category_id);
		echo $this->load->view('product/subcategories', $data);
	}



	public function index()
	{

		$data['categories'] = $this->category_model->AllCategories();
		$data['products'] = $this->product_model->list_data();		
		$this->load->view('layouts/header');
		$this->load->view('product/index', $data);
		$this->load->view('layouts/footer');		
	}

	public function list_view()
	{

		$data['categories'] = $this->category_model->AllCategories();
		$data['products'] = $this->product_model->list_data();		
		$this->load->view('layouts/header');
		$this->load->view('product/list_view', $data);
		$this->load->view('layouts/footer');		
	}

	public function info($id)
	{
		$data['product'] =  $this->product_model->FindById($id);
		$data['last_purchase_price'] = $this->temp_purchase_model->lastPurchasePrice($id);
		$data['stock'] = $this->stock_model->stock($data['product']);
		$this->load->view('layouts/header');
		$this->load->view('product/product_info', $data);
		$this->load->view('layouts/footer');		
	}

	public function sales_history($id)
	{
		$data['product'] =  $this->product_model->FindById($id);
		$data['sales'] = $this->tempsales_model->findByItem($id, 'product');
		$data['sales_stock'] = $this->stock_model->sales($data['product']);
		$data['sales_yearly_stock'] = $this->stock_model->sales($data['product'], 'yearly');
		$data['sales_monthly_stock'] = $this->stock_model->sales($data['product'], 'monthly');

		$this->load->view('layouts/header');
		$this->load->view('product/product_sales_history', $data);
		$this->load->view('layouts/footer');		
	}

	public function purchase_history($id)
	{
		$data['product'] =  $this->product_model->FindById($id);
		$data['purchases'] = $this->temp_purchase_model->findByItem($id, 'product');
		$data['purchase_stock'] = $this->stock_model->purchase($data['product'],'');		
		$data['purchase_yearly_stock'] = $this->stock_model->purchase($data['product'], 'yearly');
		$data['purchase_monthly_stock'] = $this->stock_model->purchase($data['product'], 'monthly');
		$this->load->view('layouts/header');
		$this->load->view('product/product_purchase_history', $data);
		$this->load->view('layouts/footer');		
	}

	public function filter_sales_history($id)
	{
		$post = $this->input->post();
		$data['product'] =  $this->product_model->FindById($id);
		$post['item_model'] = 'product';
		$data['sales'] = $this->tempsales_model->findByItemAndDate($id, $post);
		$this->load->view('product/sales_history_table', $data);

	}

	public function filter_purchase_history($id)
	{
		$post = $this->input->post();
		$data['product'] =  $this->product_model->FindById($id);
		$post['item_model'] = 'product';
		$data['purchases'] = $this->temp_purchase_model->findByItemAndDate($id, $post);
		$this->load->view('product/purchase_history_table', $data);
	}

	public function status($id, $status)
	{
		$logged_user = $this->current_user();
		$status = ($status == '0' ? 1 : 0);
		$post = array('status' => $status, 'updated_by' => $logged_user['user_id'],'updated_at' => date("j F, Y, g:i a"));
		$this->product_model->update($id,$post);
		$this->session->set_flashdata('message', "Product Updated successfully");
		redirect('product/list_view');
	}

	public function delete($id)
	{
        $logged_user = $this->current_user();
        $post['deleted_by'] = $logged_user['user_id'];
        $post['deleted_at'] = date("j F, Y, g:i a");
        $this->product_model->update($id,$post);
        echo $id;
	}

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}

}