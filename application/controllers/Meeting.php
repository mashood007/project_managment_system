<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meeting extends CI_Controller {

  public function __construct()
    {
    parent::__construct();
 	$this->load->model(array(
 			'meeting_model'
 		)); 
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
	}


	public function index()
	{
		$data['title'] = 'Meeting';
		$data['meetings'] = $this->meeting_model->upcoming_meetings();
		$data['total_meetings'] = $this->meeting_model->TotalMeetings();
		$data['yearly_meetings'] = $this->meeting_model->YearlyMeetings();
		$data['monthly_meetings'] = $this->meeting_model->monthlyMeetings();
		$this->load->view('layouts/header', $data);
		$this->load->view('meeting/index', $data);
		$this->load->view('layouts/footer');		
	}

	public function info($id)
	{
		$data['title'] = 'Meeting Info';
		$data['meeting'] = $this->meeting_model->get($id);
		$this->load->view('layouts/header', $data);
		$this->load->view('meeting/info', $data);
		$this->load->view('layouts/footer');
	}

	public function filter($type)
	{
		switch ($type) {
			case 'upcoming':
			    $data['meetings'] = $this->meeting_model->upcoming_meetings();
			    $this->load->view('meeting/upcoming_meetings', $data);
				break;
			case 'completed':
			    $data['meetings'] = $this->meeting_model->completed_meetings();
			    $this->load->view('meeting/completed_meetings', $data);
				break;
			case 'pending':
			    $data['meetings'] = $this->meeting_model->pending_meetings();
			    $this->load->view('meeting/pending_meetings', $data);
				break;							
		}
	}

	public function add_meeting()
	{
		$logged_user = $this->current_user();
		$this->form_validation->set_rules('schedule_date',"Date",'required');
		$this->form_validation->set_rules('schedule_time',"Time",'required');
		if($this->form_validation->run() === true)
		{
			$post = $this->input->post();
			$post['created_by'] = $logged_user['user_id'];
			$post['created_at'] = date("j F, Y, g:i a");
			$time = strtotime($post['schedule_date']);
			$post['schedule_date'] = date('Y-m-d', $time);
			$post['mode'] = 'meeting';
			$res = $this->meeting_model->create($post);
			if($res)
			{
				$this->meeting_confirmed_sms($post);
				$this->meeting_confirmed_mail($post);
				$this->session->set_flashdata('message', "New Meeting added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again ");
			}
		}
		redirect('meeting');
	}

	public function add_availability()
	{
		$logged_user = $this->current_user();
		$this->form_validation->set_rules('schedule_date',"Date",'required');
		if($this->form_validation->run() === true)
		{
			$post = $this->input->post();
			$post['created_by'] = $logged_user['user_id'];
			$post['created_at'] = date("j F, Y, g:i a");
			$time = strtotime($post['schedule_date']);
			$post['schedule_date'] = date('Y-m-d', $time);			
			$post['mode'] = 'availability';
			$res = $this->meeting_model->create($post);
			if($res)
			{
				$this->session->set_flashdata('message', "New Availability added successfully ");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again ");
			}
		}
		redirect('meeting');
	}

    public function delete($id)
    {
        $logged_user = $this->current_user();
        $post['deleted_by'] = $logged_user['user_id'];
        $post['deleted_at'] = date("j F, Y, g:i a");
        $this->meeting_model->update($id,$post);
        echo $id;
    }

    public function finish($id)
    {
        $logged_user = $this->current_user();
        $post['finished_by'] = $logged_user['user_id'];
        $post['finished_at'] = date("j F, Y, g:i a");
        $res = $this->meeting_model->update($id,$post);
		if($res)
		{
			$this->session->set_flashdata('message', "Finished ");
		}else{
			$this->session->set_flashdata('exception', "Something went wrong, please try again ");
		}
		redirect('meeting');        
    }

    public function undo_finish($id)
    {
        $logged_user = $this->current_user();
        $post['finished_by'] = 0;
        $post['finished_at'] = '';
        $res = $this->meeting_model->update($id,$post);
		if($res)
		{
			$this->session->set_flashdata('message', "Undo Finish ");
		}else{
			$this->session->set_flashdata('exception', "Something went wrong, please try again ");
		}   
		redirect('meeting');     
    }

    private function meeting_confirmed_sms($post)
    {
    	$msg = urlencode("Hello ".$post['visitor'].", \nMeeting on (".$post['purpose'].") is scheduled with Xeobrain and you, (".$post['location'].")");
    	$url = "http://login.yourbulksms.com/api/sendhttp.php?authkey=11263AoUBQdbIKlmi5c90e392&mobiles=".$post['phone']."&message=".$msg."&sender=XBRAIN&route=4";
    	$is_ok = file_get_contents($url);
    	//echo $is_ok;
    }

	private function meeting_confirmed_mail($post)
	{
		$data['business'] = $this->business_model->business();
        $this->email->set_newline("\r\n");
        $this->email->from('noreplay@xeobrain.com', $data['business']['company_name']);
        $data['userName'] = 'admin@Xeobrain';
        $data['customer'] = $post['visitor'];
        $data['location'] = $post['location'];
        $this->email->to($post['email']);
        $this->email->subject("Meeting Confirmed!"); // replace it with relevant subject
        $body = $this->load->view('meeting/meeting_confirmed_mail',$data,TRUE);
        $this->email->message($body);  
        $this->email->send();
        //echo $this->email->print_debugger();
	}

	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}

}