<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_category extends CI_Controller {

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


	public function edit_category($id)
	{
		$data['category'] = $this->category_model->byId($id);
		$this->form_validation->set_rules('name'," Name",'required');
		$this->form_validation->set_rules('name', 'Name', 'is_unique[category.name]');
		if($this->form_validation->run() === true)
		{
			$res=$this->category_model->update($id, $this->input->post());
			if($res)
			{
				$this->session->set_flashdata('message', "Category updated successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
			redirect('product/product_category');
		}

		$this->load->view('layouts/header');
		$this->load->view('product/edit_category', $data);
		$this->load->view('layouts/footer');
	}


	public function edit_subcategory($id)
	{
		$data['subcategory'] = $this->subcategory_model->byId($id);
		$data['categories'] = $this->category_model->AllCategories();
		$this->form_validation->set_rules('subcategory_name',"Sub Category Name",'required');
		$this->form_validation->set_rules('category_id',"Category",'required');	
		if($this->form_validation->run() === true)
		{
			$res=$this->subcategory_model->update($id, $this->input->post());
			if($res)
			{
				$this->session->set_flashdata('message', "Subcategory Updated successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
			redirect('product/product_subcategory');
			//print_r($this->input->post());
		}

		$this->load->view('layouts/header');
		$this->load->view('product/edit_subcategory', $data);
		$this->load->view('layouts/footer');
	}

	public function delete_category($id)
    {
        $logged_user = $this->current_user();
        $post['deleted_by'] = $logged_user['user_id'];
        $post['deleted_at'] = date("j F, Y, g:i a");
        $this->category_model->update($id,$post);
        echo $id;
    }

    public function delete_subcategory($id)
    {
        $logged_user = $this->current_user();
        $post['deleted_by'] = $logged_user['user_id'];
        $post['deleted_at'] = date("j F, Y, g:i a");
        $this->subcategory_model->update($id,$post);
        echo $id;
    }


	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}
}