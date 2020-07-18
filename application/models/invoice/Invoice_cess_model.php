<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_cess_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
 		
 	}

 	public function create($post)
 	{
 		return $this->db->insert('invoice_cess', $post);
 	}

 	public function invoiceCess($invoice_id)
 	{
 	return $this->db->select('*, cess_name as name')
 	->from('invoice_cess')
 	->where('invoice_id', $invoice_id)
	->get()->result_array();
 	}


}
?>