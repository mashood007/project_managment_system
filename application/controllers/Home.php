<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
       parent::__construct();
       $this->load->model(array(
            'login_model'
        ));       
    }
	public function index()
	{
		$this->load->view('layouts/header');
		$this->load->view('home/index');
		$this->load->view('layouts/footer');
	}
	public function login()
	{

		if (isset($this->session->userdata['logged_in'])) {
			redirect('/home', 'refresh');
		}

		

		$this->form_validation->set_rules('user_name',"User Name",'required');
		$this->form_validation->set_rules('user_password',"Password",'required');
		if($this->form_validation->run() === true)
		{
			$post = $this->input->post();
			$res=$this->login_model->login($post['user_name'], $post['user_password']);
			if (count($res)>0)
			{
				$session_data = array(
				'user_name' => $res[0]['user_name'],
				'nick_name' => $res[0]['nick_name'],
				'user_id' => $res[0]['id']
				);
				// Add user data in session
				$this->session->set_userdata('logged_in', $session_data);
				redirect('/home', 'refresh');

			}
			else{
				$data['message_display'] = "Invalid User Name and/or Password";
			}
		}
		$this->load->view('home/login',$data);

	}

	public function logout()
	{

		$session_data = array(
			'user_name' => '',
			'nick_name' => '',
			'user_id' => ''
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		$data['message_display'] = 'Successfully Logout';
		$this->load->view('home/login',$data);		
	}


}
?>