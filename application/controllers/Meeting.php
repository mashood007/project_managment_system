<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meeting extends CI_Controller {

  public function __construct()
    {
    parent::__construct();
 	$this->load->model(array(
 			'meeting_model'
 		)); 		
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
				$this->session->set_flashdata('message', "New Meeting added successfully ");
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


	private function current_user()
	{
		return 	$this->session->userdata['logged_in'];
	}

}