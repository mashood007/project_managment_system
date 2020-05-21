<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

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
 			'invoice/salesreturn_model',
 			'settings/cess_model',
 			'invoice/invoice_cess_model',
 			'revenue_model',
 			'settings/business_model'
 		));


}
	public function index()
	{
		$data['title']  = "Sales invoice";

		$data['sales_invoice'] = $this->sales_model->all();
		$this->load->view('layouts/header', $data);
		$this->load->view('invoice/report/invoice_report', $data);
		$this->load->view('layouts/footer');
		
	}

	public function filter()
	{
		$data['sales_invoice'] = $this->sales_model->filter($this->input->post());
		echo $this->load->view('invoice/report/sales_invoice', $data);
	}

	public function filter_return()
	{
		$data['sales_return'] = $this->salesreturn_model->filter($this->input->post());
		$this->load->view('invoice/report/sales_return_filter', $data);
	}

	public function delete_invoice($id)
	{
		$logged_user = $this->current_user();
		$post['deleted_by'] = $logged_user['user_id'];
		$post['deleted_at'] = date("j F, Y, g:i a");
		$this->sales_model->delete($id, $post);
		$this->revenue_model->deleteByInvoice($id);
		echo $id;
	}

	public function delete_invoice_return($id)
	{
		$logged_user = $this->current_user();
		$post['deleted_by'] = $logged_user['user_id'];
		$post['deleted_at'] = date("j F, Y, g:i a");
		$this->salesreturn_model->update($id, $post);
		echo $id;
	}	

	public function invoice_return($id)
	{
		$data['title']  = "Sales Invoice Return";
		$data['invoice'] = $this->sales_model->get($id);
		$data['services'] = $this->service_model->AllServices();
		$data['products'] = $this->product_model->All();
		$data['customers']=$this->customer_model->AllCustomers();
		$this->load->view('layouts/header', $data);
		$this->load->view('invoice/sales/return', $data);
		$this->load->view('layouts/footer');
	}

	public function estimate()
	{
		$data['title']  = "Estimate invoice";
		$data['estimate_invoice'] = $this->salesestimate_model->all();
		$this->load->view('layouts/header', $data);
		$this->load->view('invoice/report/estimate', $data);
		$this->load->view('layouts/footer');
		
	}

	public function sales_return()
	{
		$data['title']  = "sales Return";
		$data['sales_return'] = $this->salesreturn_model->all();
		$this->load->view('layouts/header', $data);
		$this->load->view('invoice/report/sales_return', $data);
		$this->load->view('layouts/footer');
		
	}

	public function invoice_pdf($id)
	{
		$data['id'] = $id;
		$data['business'] = $this->business_model->business();
		$data['cess'] = $this->invoice_cess_model->invoiceCess($id);
		$data['invoice'] = $this->sales_model->get($id);
		$data['bill'] =  $this->tempsales_model->findByInvoice($id);
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

	public function download_pdf($id)
	{
		$data['id'] = $id;
		$data['business'] = $this->business_model->business();
		$data['cess'] = $this->invoice_cess_model->invoiceCess($id);
		$data['invoice'] = $this->sales_model->get($id);
		$data['bill'] =  $this->tempsales_model->findByInvoice($id);
		$this->load->view('invoice/report/invoice_print', $data);
		$html = $this->output->get_output();
        		// Load pdf library
		$this->load->library('pdf');
		$this->pdf->loadHtml($html);
		$this->pdf->setPaper('A4', 'landscape');
		$this->pdf->render();
		// Output the generated PDF (1 = download and 0 = preview)
		$this->pdf->stream("html_contents.pdf", array("Attachment"=> 2));	
	}	

	public function invoice_pdf_preview($id)
	{
		$data['id'] = $id;
		$data['business'] = $this->business_model->business();
		$data['cess'] = $this->invoice_cess_model->invoiceCess($id);
		$data['invoice'] = $this->sales_model->get($id);
		$data['bill'] =  $this->tempsales_model->findByInvoice($id);
		$this->load->view('invoice/report/invoice_print', $data);
	}

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}
	
	public function cancelled_sales()
	{
		$data['title']  = "Sales invoice";

		$data['sales_invoice'] = $this->sales_model->deletes();
		$this->load->view('layouts/header', $data);
		$this->load->view('invoice/report/cancelled_sales', $data);
		$this->load->view('layouts/footer');
		
	}

	public function filter_cancelled_invoices()
	{
		$data['sales_invoice'] = $this->sales_model->filter_deletes($this->input->post());
		$this->load->view('invoice/report/delete_invoice', $data);
	}


}