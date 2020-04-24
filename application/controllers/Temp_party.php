<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Temp_party extends CI_Controller {

  public function __construct()
{
    parent::__construct();
 	$this->load->model(array(
 			'temp_party_model'
 		));
 		

}
	public function add()
	{	$logged_user = $this->current_user();

		$post = $this->input->post();
		$post['created_by'] = $logged_user['user_id'];
		$post['created_at'] = date("j F, Y, g:i a");
		$res=$this->temp_party_model->create($post);
		 echo $res;
	}
	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}
}