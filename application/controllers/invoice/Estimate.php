<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estimate extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'settings/unit_model',
 			'customer_model',
 			'settings/service_model',
 			'product/product_model',
 			'invoice/sales_model',
 			'invoice/tempsales_model',
 			'invoice/salesestimate_model',
 			'invoice/tempsalesreturn_model',
 			'invoice/salesreturn_model',
 			'party_model', 
 			'settings/cess_model'
 		));


}
	public function index()
	{
		$data['title']  = "Estimate invoice";
		$data['parties']=$this->party_model->All();

		$data['invoice_no'] = $this->salesestimate_model->LastEstimateNo();
		$data['services'] = $this->service_model->AllServices();
		$data['products'] = $this->product_model->All();
		$data['customers']=$this->customer_model->AllCustomers();
		$this->load->view('layouts/header');
		$this->load->view('invoice/estimate/index', $data);
		$this->load->view('layouts/footer');
		
	}


	public function edit($id)
	{
		$data['title']  = "Sales invoice";
		$data['invoice'] = $this->sales_model->get($id);
		$data['services'] = $this->service_model->AllServices();
		$data['products'] = $this->product_model->All();
		$data['customers']=$this->customer_model->AllCustomers();
		$this->load->view('layouts/header');
		$this->load->view('invoice/sales/edit', $data);
		$this->load->view('layouts/footer');
		
	}

	public function info($id)
	{
		$data['title']  = "Sales estimate";
		$data['invoice'] = $this->salesestimate_model->getEstimate($id);
		$data['bill'] =  $this->tempsales_model->findByEstimate($id);
		$data['cess'] = $this->cess_model->AllCess();
		$this->load->view('layouts/header');
		$this->load->view('invoice/estimate/info', $data);
		$this->load->view('layouts/footer');		
	}

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}	



}