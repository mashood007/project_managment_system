
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'customer_model',
            'project_model',
            'customerAccount_model',
            'invoice/sales_model',
            'invoice/salesreturn_model'
 		)); 		
}
	public function export_csv(){ 
			// file name 
			$filename = 'users_'.date('Ymd').'.csv'; 
			header("Content-Description: File Transfer"); 
			header("Content-Disposition: attachment; filename=$filename"); 
			header("Content-Type: application/csv; ");
		   // get data 
			$usersData = $this->Crud_model->getUserDetails();
			// file creation 
			$file = fopen('php://output','w');
			$header = array("Username","Name","Gender","Email"); 
			fputcsv($file, $header);
			foreach ($usersData as $key=>$line){ 
				fputcsv($file,$line); 
			}
			fclose($file); 
			exit; 
	}