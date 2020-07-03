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
            'smtp_user' => 'xeobrain@gmail.com',
            'smtp_pass' => 'mjonfznkgdzcieuh',
            'smtp_timeout' => '4',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1'
        );
        $this->load->library('email');
        $this->email->initialize($config);
        $this->load->model(array(
            'login_model',
            'my_todo_model',
            'customer_model',
            'employee_model',
            'settings/business_model'
        ));       
    }
	public function index()
	{
		$this->load->view('layouts/header');
		$this->load->view('home/index');
		$this->load->view('layouts/footer');
	}

	public function customer_dash()
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
				'user_type' => 'employees',
				'role' => $res[0]['role']
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

	public function customer_login()
	{

		if (isset($this->session->userdata['logged_in'])) {
			redirect('home/customer_dash', 'refresh');
		}

		$this->form_validation->set_rules('user_name',"User Name",'required');
		$this->form_validation->set_rules('user_password',"Password",'required');
		if($this->form_validation->run() === true)
		{
			$post = $this->input->post();
			$res=$this->login_model->customer_login($post['user_name'], $post['user_password']);
			if (count($res)>0)
			{
				$session_data = array(
				'user_name' => $res[0]['user_name'],
				'nick_name' => $res[0]['full_name'],
				'user_id' => $res[0]['id'],
				'user_type' => 'customers',
				'role' => 'customer'
				);
				// Add user data in session
				$this->session->set_userdata('logged_in', $session_data);
                $this->session->set_flashdata('message', "Welcome");
				redirect('/customer_home', 'refresh');

			}
			else{
				$data['message_display'] = "Invalid User Name and/or Password";
				redirect('home/customer_login', 'refresh');
			}
		}
		$data['title'] = 'Login';
		$this->load->view('home/customer_login',$data);

	}

	public function logout()
	{
		$user_type = $this->session->userdata['logged_in']['user_type'] ;
		$session_data = array(
			'user_name' => '',
			'nick_name' => '',
			'user_id' => '',
			'role' => '',
			'user_type' => ''
		);
		$this->session->unset_userdata('logged_in', $session_data);
		$data['message_display'] = 'Successfully Logout';
		if ($user_type == 'employees')
		{
        	$this->load->view('home/login',$data);		
		}
		else
		{
			$this->load->view('home/customer_login',$data);	
		}
	}

	public function forgot_password()
	{
		$this->form_validation->set_rules('email',"Email",'required');
		if($this->form_validation->run() === true)
		{   
			$post = $this->input->post();
			$employee = $this->employee_model->getByEmail($post['email']);
			if (count($employee)>0)
			{
				$this->forgot_password_email($employee, 'employees');
				$this->session->set_flashdata('message', "Please Check Your Mail");
			}
			else
			{
			$customer = $this->customer_model->getByEmail($post['email']);
				if(count($customer) > 0)
				{
				$this->forgot_password_email($customer, 'customers');
				$this->session->set_flashdata('message', "Please Check Your Mail");
				}
				else
				{
				$this->session->set_flashdata('exception', "This Email is not vaild");					
				}
			}		
		}
		$this->load->view('home/forgot_password');				
	}



	public function change_password()
	{
		$logged_user = $this->current_user();       
		$this->form_validation->set_rules('old_password',"Old Password",'required');
		$this->form_validation->set_rules('new_password1',"New Password",'required');
		$this->form_validation->set_rules('new_password2',"Confirm Password",'required');
		if($this->form_validation->run() === true)
		{
			$post = $this->input->post();
			if ($post['new_password1'] != $post['new_password2'])
			{
				$this->session->set_flashdata('exception', "Confirm password does not match");

			}
			else
			{
			if ($logged_user['user_type'] == 'employees')
			{
			$res=$this->employee_model->password($logged_user['user_id'], $post['old_password']);
			if (count($res)>0)
			{
				$change = $this->employee_model->changePassword($logged_user['user_id'], $post['new_password1']);
				$this->session->set_flashdata('message', "Password Changed");
				redirect('home');
			}
			else
			{
				$this->session->set_flashdata('exception', "Current Password is Wrong");
			}
			}
			elseif ($logged_user['user_type'] == 'customers') {
			$res=$this->customer_model->password($logged_user['user_id'], $post['old_password']);
			if (count($res)>0)
			{
				$change = $this->customer_model->changePassword($logged_user['user_id'], $post['new_password1']);
                $this->session->set_flashdata('message', "Password Changed");
                redirect('home');
	
			}
			else
			{
				$this->session->set_flashdata('exception', "Current Password is Wrong");
			}
			}
		}

		}
	
		$this->load->view('home/change_password');	

	}

	public function no_permission()
	{
		$this->load->view('home/no_permission');		

	}

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}

	private function forgot_password_email($user, $type)
	{
		$data['business'] = $this->business_model->business();
        $this->email->set_newline("\r\n");
        $this->email->from('noreplay@xeobrain.com', $data['business']['company_name']);
        $data['userName'] = 'admin@Xeobrain';
        $data['password'] = $type == "employees" ? $user['user_password'] : $user['password'];
        $data['user_name'] = $user['user_name'];
        $data['email'] = $user['email'];
        $this->email->to($user['email']);  // replace it with receiver mail id
        $this->email->subject("Password recovered!"); // replace it with relevant subject
   
        $body = $this->load->view('home/forgot_Password_email',$data,TRUE);
        $this->email->message($body);  
        $this->email->send();
        //echo $this->email->print_debugger();
	}

}
?>