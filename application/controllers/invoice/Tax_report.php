<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tax_report extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'invoice/sales_model',
 			'invoice/purchase_model',
 			'invoice/salesreturn_model',
 			'invoice/purchase_return_model'
 		));


}
	public function index()
	{
		$data['title'] = 'Tax Report';
		$data['sales'] = $this->sales_model->tax_report();
		$data['purchase'] = $this->purchase_model->tax_report();
		$data['sales_return'] = $this->salesreturn_model->tax_report();
		$data['purchase_return'] = $this->purchase_return_model->tax_report();
		$this->load->view('layouts/header', $data);
		$this->load->view('invoice/tax_report/index', $data);
		$this->load->view('layouts/footer');
	}

	public function filter()
	{
		$post = $this->input->post();
		$data['sales'] = $this->sales_model->tax_report($post['from_date'], $post['to_date']);
		$data['purchase'] = $this->purchase_model->tax_report($post['from_date'], $post['to_date']);
		$data['sales_return'] = $this->salesreturn_model->tax_report($post['from_date'], $post['to_date']);
		$data['purchase_return'] = $this->purchase_return_model->tax_report($post['from_date'], $post['to_date']);
		$this->load->view('invoice/tax_report/filter', $data);
		// print_r($post);
	}



}