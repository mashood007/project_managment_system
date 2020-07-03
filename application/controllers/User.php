	public function customer_login()
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