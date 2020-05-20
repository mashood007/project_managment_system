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
 			'settings/cess_model',
 			'settings/business_model'

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
		$data['est_no'] = $id;
		$data['invoice'] = $this->salesestimate_model->getEstimate($id);
		$data['services'] = $this->service_model->AllServices();
		$data['products'] = $this->product_model->All();
		$data['customers']=$this->customer_model->AllCustomers();
		$this->load->view('layouts/header');
		$this->load->view('invoice/estimate/edit', $data);
		$this->load->view('layouts/footer');
		
	}


	public function update($id)
	{
		if(!empty($id))
		{
		$data['invoice'] = $this->salesestimate_model->getEstimate($id);
		$post = $this->input->post();
		
		if (!empty($post['customer_id']))
		{
			$invoice = $this->salesestimate_model->update($id, $post);
			$this->tempsales_model->estimate($id);
			echo base_url('/invoice/report/estimate');
		}
		else
		{
			echo base_url('/invoice/estimate/edit/'.$id);
		}
		}
		else
		{
			echo base_url('/invoice/report/estimate');
		}

	}

	public function bill($est_no)
	{
		$data['bill'] =  $this->tempsales_model->findByEstimate($est_no);
		$data['est_no'] = $est_no;
		echo $this->load->view('invoice/estimate/bill', $data);

	}

	public function pdf($id)
	{
		$data['id'] = $id;
		$data['business'] = $this->business_model->business();
		//$data['cess'] = $this->invoice_cess_model->invoiceCess($id);
		$data['invoice'] = $this->salesestimate_model->getEstimate($id);
		$data['bill'] =  $this->tempsales_model->findByEstimate($id);
		$this->load->view('invoice/report/invoice_print', $data);
		$html = $this->output->get_output();
        		// Load pdf library
		$this->load->library('pdf');
		$this->pdf->loadHtml($html);
		$this->pdf->setPaper('A4', 'landscape');
		$this->pdf->render();
		// Output the generated PDF (1 = download and 0 = preview)
		$this->pdf->stream("html_contents.pdf", array("Attachment"=> 0));		
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

	public function delete($id)
	{
		$logged_user = $this->current_user();
		$post['deleted_by'] = $logged_user['user_id'];
		$post['deleted_at'] = date("j F, Y, g:i a");
		$this->salesestimate_model->update($id, $post);
		echo $id;
	}

}