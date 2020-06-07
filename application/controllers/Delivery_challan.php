<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery_challan extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'project_model',
 			'customer_model',
 			'employee_model',
 			'party_model', 
 			'Project_model',
 			'settings/service_model',
 			'product/product_model',
 			'invoice/sales_model',
 			'delivery_challan_dep/cart_model',
 			'delivery_challan_dep/delivery_challan_model',
 			'projects/meterial_delivery_model',
 			'projects/meterial_usage_model'
 		)); 		
	}


	public function index()
	{
		$data['title']  = "Delivery challan";
		$data['next'] = $this->delivery_challan_model->next();
		$this->load->view('layouts/header');
		$this->load->view('delivery_challan/index', $data);
		$this->load->view('layouts/footer');

	}


	public function cart()
	{
		$data['cart'] =  $this->cart_model->All();
		$this->load->view('delivery_challan/cart', $data);	
	}

	public function edit($id)
	{
		$data['title']  = "Delivery challan Edit";
		$data['delivery_challan'] = $this->delivery_challan_model->getDetails($id);
	   switch ($data['delivery_challan']->for_type) {
        case 'indivitual':
            if ($data['delivery_challan']->for_cat == 'cutomer')
            {
                $data['project'] = $this->customer_model->fullName($data['delivery_challan']->delivery_for);
            }
            else
            {
                $data['project'] = $this->party_model->Name($data['delivery_challan']->delivery_for);
            }
            break;                      
        case 'project':
           $data['project'] = $this->Project_model->Name($data['delivery_challan']->delivery_for);
           break;
       }
		$this->load->view('layouts/header');
		$this->load->view('delivery_challan/edit', $data);
		$this->load->view('layouts/footer');
	}	

	public function dc_cart($dc_id)
	{
		$data['cart'] =  $this->cart_model->byDcId($dc_id);
		$this->load->view('delivery_challan/cart', $data);	
	}

	public function add()
	{
		$post = $this->input->post();
	 	$logged_user = $this->current_user();
		$post['created_by'] = $logged_user['user_id'];
		$post['created_at'] = date("j F, Y, g:i a");	
		$post['updated_by'] = $logged_user['user_id'];
		$post['updated_at'] = date("j F, Y, g:i a");		
		$delivery_challan_id = $this->delivery_challan_model->create($post);
		$this->cart_model->delivery_challan($delivery_challan_id);
		// if ($post['for_type'] == "project")
		// {
		// 	$this->meterial_delivery_model->meterial_delivery($delivery_challan_id, $post['delivery_for']);
		// 	$this->meterial_usage_model->meterial_usage($delivery_challan_id, $post['delivery_for']);
		// }
		redirect('/delivery_challan', 'refresh');
		
	}

	public function for_delivery()
	{
		$post = $this->input->post();
		switch ($post['for']) {
			case 'indivitual':
				$data['parties']=$this->party_model->All();
				$data['customers']=$this->customer_model->AllCustomers();
				$this->load->view('delivery_challan/for_indivitual', $data);	
				break;
			case 'project':
				$data['projects'] = $this->project_model->AllProjects();
				$this->load->view('delivery_challan/for_project', $data);
				break;
			case 'branch':
				$this->load->view('delivery_challan/for_branch', $data);
				break;							
			default:
				$data['parties']=$this->party_model->All();
				$data['customers']=$this->customer_model->AllCustomers();
				$this->load->view('delivery_challan/for_indivitual', $data);	
				break;
		}
	}

	public function show($id)
	{
		$data['delivery_challan'] = $this->delivery_challan_model->getDetails($id);
        $data['cart'] =  $this->cart_model->byDcId($id);
		$this->load->view('layouts/header');
		$this->load->view('delivery_challan/show', $data);
		$this->load->view('layouts/footer');		
	}

	public function copy_to_invoice($id)
	{
		$this->delivery_challan_model->copy_to_invoice($id);
		$data['invoice_no'] = $this->sales_model->LastInvoiceNo();
		$data['services'] = $this->service_model->AllServices();
		$data['products'] = $this->product_model->All();
		$data['customers']=$this->customer_model->AllCustomers();
		$data['parties']=$this->party_model->All();
		$data['delivery_challan'] = $this->delivery_challan_model->getDetails($id);
		if ($data['delivery_challan']->for_type == 'project')
		{
			$project = $this->Project_model->get_project($data['delivery_challan']->delivery_for);
			$data['customer'] = $project['customer_id'];
		}
		elseif ($data['delivery_challan']->for_type == "indivitual") {
			$data['customer'] = $data['delivery_challan']->delivery_for;
		}
		$this->load->view('layouts/header');
		$this->load->view('delivery_challan/copy_to_invoice', $data);
		$this->load->view('layouts/footer');		
	}

	public function update($id)
	{
		$post = $this->input->post();
		$post['updated_by'] = $logged_user['user_id'];
		$post['updated_at'] = date("j F, Y, g:i a");	
		$this->delivery_challan_model->update($id, $post);
		redirect('/delivery_challan/show/'.$id, 'refresh');
	}

	public function destroy($id)
	{
		$logged_user = $this->current_user();
		$this->delivery_challan_model->delete($id, $logged_user['user_id']);
	}

	public function report()
	{
		$data['record'] = $this->delivery_challan_model->all();
		$this->load->view('layouts/header');
		$this->load->view('delivery_challan/report', $data);
		$this->load->view('layouts/footer');		
	}

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}

}