<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_report extends CI_Controller {

  public function __construct()
	{
    parent::__construct();
 	$this->load->model(array(
 			'settings/unit_model',
 			'settings/service_model',
 			'product/product_model',
 			'invoice/purchase_model',
 			'invoice/temp_purchase_model',
 			'invoice/purchase_return_model',
 			'party_model', 
 			'customer_model', 
 			'temp_party_model'
 		));


	}

  	public function index()
	{
		$data['title']  = "Purchase invoice Report";
		$data['purchase_invoices'] = $this->purchase_model->All();
		$this->load->view('layouts/header');
		$this->load->view('invoice/purchase/report', $data);
		$this->load->view('layouts/footer');
		
	}

	public function debit_notes()
	{
		$data['title']  = "Purchase invoice Retrun Report";
		$data['purchase_return_invoices'] = $this->purchase_return_model->All();
		$this->load->view('layouts/header');
		$this->load->view('invoice/purchase_return/report', $data);
		$this->load->view('layouts/footer');		
	}

	public function cancelled()
	{
		$data['purchase_invoices'] = $this->purchase_model->cancelledPurchases();
		$this->load->view('layouts/header');
		$this->load->view('invoice/report/cancelled_purchase_invoice', $data);
		$this->load->view('layouts/footer');		
	}

	public function cancel_invoice($id)
	{
		$logged_user = $this->current_user();
		$res = $this->purchase_model->cancel($id, $logged_user['user_id']);
		$this->temp_purchase_model->cancelInvoice($id);
		$data['purchase_invoices'] = $this->purchase_model->All();
		$this->load->view('invoice/purchase/purchase_report_content', $data);

	}

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}

}
?>