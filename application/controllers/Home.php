<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
       parent::__construct();
        $config = Array(       
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'send@mail.com',
            'smtp_pass' => 'pasXXXXX',
            'smtp_timeout' => '4',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1'
        );
        $this->load->library('email');
        $this->email->initialize($config);
        $this->load->model(array(
            'login_model',
            'my_todo_model'
        ));       
    }
	public function index()
	{
		$this->load->view('layouts/header');
		$this->load->view('home/index');
		$this->load->view('layouts/footer');
	}

	public function add_todo_task()
	{
		$post = $this->input->post();
		$logged_user = $this->current_user();
		$post['created_by'] = $logged_user['user_id'];
		echo $this->my_todo_model->create($post);
	}

	public function my_todos()
	{
		$logged_user = $this->current_user();
		$data['todo_tasks'] =  $this->my_todo_model->all($logged_user['user_id']);
		$this->load->view('home/my_todos', $data);
	}

	public function check_task($id)
	{
		$post = $this->input->post();
		$this->my_todo_model->update($id,$post);
	}

	public function remove_task($id)
	{
		$this->my_todo_model->delete($id);
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
				'user_id' => $res[0]['id'],
				'user_type' => 'employees'
				);
				// Add user data in session
				$this->session->set_userdata('logged_in', $session_data);
                $this->session->set_flashdata('message', "Welcome");
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
		$this->session->unset_userdata('logged_in', $session_data);
		$data['message_display'] = 'Successfully Logout';
		$this->load->view('home/login',$data);		
	}

	public function forgot_password()
	{

        $this->email->set_newline("\r\n");
        $this->email->from('noreplay@xeobrain.com', 'Anil Labs');
        $data = array(
             'userName'=> 'admin@Xeobrain'
                 );
        $this->email->to('receiver@mail.com');  // replace it with receiver mail id
        $this->email->subject("subject"); // replace it with relevant subject
   
        $body = $this->load->view('home/forgot_Password_email',$data,TRUE);
        $this->email->message($body);  
        $this->email->send();
        echo $this->email->print_debugger();
	}

	public function reset_password()
	{

	}

private function current_user()
{
	return 	$this->session->userdata['logged_in'];
}
}
?>