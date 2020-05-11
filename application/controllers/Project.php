<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

  public function __construct()
	{
    parent::__construct();
 	$this->load->model(array(
 			'Project_model',
 			'settings/service_model',
 			'Customer_model',
 			'TaskTo_model',
 			'settings/job_model',
 			'ProjectJob_model',
 			'employee_model',
 			'projects/discussion_model',
 			'projects/todo_model'
 		)); 		
	}


	public function install_project()
	{
		$logged_user = $this->current_user();
		$post = $this->input->post();
		$post['created_by'] = $logged_user['user_id'];
		$post['created_at'] = date("j F, Y, g:i a");
		$post['updated_by'] = $logged_user['user_id'];
		$post['updated_at'] = date("j F, Y, g:i a");
		$this->load->library('upload');


		$data['customers']=$this->Customer_model->AllCustomers();
		$data['services'] = $this->service_model->AllServices();


		$this->form_validation->set_rules('name',"Name",'required');
		$this->form_validation->set_rules('customer_id',"Customer Name",'required');
		$this->form_validation->set_rules('price',"Price",'required');
		if($this->form_validation->run() === true)
		{
			$services = $post['services'];
			unset($post['services']);
		   $logo_path = '';
	       $config = [
	            'upload_path'   => 'upload/project_logo/',
	            'allowed_types' => 'gif|jpg|png|jpeg', 
	            'overwrite'     => false,
	            'maintain_ratio' => true,
	            'encrypt_name'  => true,
	            'remove_spaces' => true,
	            'file_ext_tolower' => true 
	        ];
	        $this->upload->initialize($config);
	        if ( ! $this->upload->do_upload('logo'))
	        {
	            $error = array('error' => $this->upload->display_errors());
	         }
	        else
	        {
	        	$data = array('upload_data' => $this->upload->data());
	        	$logo_path = $this->upload->data('file_name');
	        }
	        $post['logo'] = $logo_path;
			$res = $this->Project_model->insert($post);
			if($res)
			{
				$this->add_project_services($res,$services);
				$this->session->set_flashdata('message', "New Project  added successfully");
			}else{
				$this->session->set_flashdata('exception', "Something went wrong, please try again");
			}
		}
			$this->load->view('layouts/header');
			$this->load->view('project/install_project', $data);
			$this->load->view('layouts/footer');
	}

	public function index()
	{
		$this->load->view('layouts/header');
		$this->load->view('project/index', $data);
		$this->load->view('layouts/footer');		
	}

	public function master_list()
	{
		$data['deployments'] = $this->employee_model->AllEmployees();

		$data['projects']=$this->Project_model->AllProjects();
		$this->load->view('layouts/header');
		$this->load->view('project/master_list', $data);
		$this->load->view('layouts/footer');		
	}

	public function complete($id)
	{
		$post = $this->input->post();
		$this->Project_model->update($id,$post);
		
	}

	public function project_info($id)
	{
		$data['project']=$this->Project_model->get_project($id);
		$data['project_completed_jobs']=$this->ProjectJob_model->ProjectCompletedJobs($id);
		$data['project_pending_jobs']=$this->ProjectJob_model->ProjectPendingJobs($id);

		$this->load->view('layouts/header');
		$this->load->view('project/single_project', $data);
		$this->load->view('layouts/footer');		
	}

	public function new_job($id)
	{
		$logged_user = $this->current_user();
			
		$this->form_validation->set_rules('job_id',"Job",'required');
		$this->form_validation->set_rules('project_id',"Project",'required');
		$this->form_validation->set_rules('to',"To",'required');
		$this->form_validation->set_rules('description',"Description",'required');
		$post = $this->input->post();
		$id = !empty($id)? $id : $post['project_id'];
		if($this->form_validation->run() === true)
		{
		
		$post['created_by'] = $logged_user['user_id'];
		$post['created_at'] = date("j F, Y, g:i a");
		$post['updated_by'] = $logged_user['user_id'];
		$post['updated_at'] = date("j F, Y, g:i a");
		$res = $this->ProjectJob_model->create($post);
		if($res)
		{
			$this->session->set_flashdata('message', "New Job added successfully");
		}else{
			$this->session->set_flashdata('exception', "Something went wrong, please try again");
		}
		redirect('project/project_info/'.$id);
		}

		$data['project']=$this->Project_model->get_project($id);
		$data['jobs'] = $this->job_model->AllJobs();
		$data['employees']=$this->TaskTo_model->AllTasksOfUser($logged_user['user_id']);
		$data['project_id'] = $id;
		$this->load->view('layouts/header');
		$this->load->view('project/new_job', $data);
		$this->load->view('layouts/footer');
	}

	public function finish_job()
	{
		$post = $this->input->post();
		$res = $this->ProjectJob_model->finishProjectJob($post);
	}

	public function undo_finished_job()
	{
		$post = $this->input->post();
		$res = $this->ProjectJob_model->pendingProjectJob($post);		
	}

	public function completed_jobs()
	{
		$post = $this->input->post();
		$data['project_completed_jobs']=$this->ProjectJob_model->ProjectCompletedJobs($post['project_id']);
		$this->load->view('project/project_completed_jobs', $data);
	}

	public function pending_jobs()
	{
		$post = $this->input->post();
		$data['project_pending_jobs']=$this->ProjectJob_model->ProjectPendingJobs($post['project_id']);
		$this->load->view('project/project_pending_jobs', $data);
	}

	public function assign_employee()
	{
		$post = $this->input->post();
		$res = $this->Project_model->updateProjectFollow($this->input->post());
	}

	public function discussions($id)
	{
		$data['project']=$this->Project_model->get_project($id);
		$data['discussions'] = $this->discussion_model->byProject($id);
		$this->load->view('layouts/header');
		$this->load->view('project/discussions', $data);
		$this->load->view('layouts/footer');
	}

	public function edit_discussion($id)
	{
		//$data['project']=$this->Project_model->get_project($project_id);
		$data['discussion'] = $this->discussion_model->find($id);
		$this->load->view('layouts/header');
		$this->load->view('project/edit_discussion', $data);
		$this->load->view('layouts/footer');
	}

	public function update_discussion($id)
	{
		$discussion = $this->discussion_model->find($id);
		$post = $this->input->post();
		$res = $this->discussion_model->update($id,$post);
		if ($res)
		{
			$this->session->set_flashdata('message', "Discussion  Updated successfully");
		}else{
			$this->session->set_flashdata('exception', "Something went wrong, please try again");
		}
		$this->upload_discussion_attachments($id);
		redirect('project/discussions/'.$discussion['project_id']);			
	}

	public function add_discussion($id)
	{


		$logged_user = $this->current_user();
		$post = $this->input->post();
		$post['project_id'] = $id;
		$post['created_by'] = $logged_user['user_id'];
		$post['created_at'] = date("j F, Y, g:i a");
		$post['creator_type'] = $logged_user['user_type'];
		$discussion_id = $this->discussion_model->create($post);

		if($discussion_id)
		{
			$this->session->set_flashdata('message', "New Discussion  added successfully");
		}else{
			$this->session->set_flashdata('exception', "Something went wrong, please try again");
		}
		$this->upload_discussion_attachments($discussion_id);
		redirect('project/discussions/'.$id);
	}

	public function remove_discussion($id)
	{
		$this->discussion_model->delete($id);
	}


public function upload_discussion_attachments($discussion_id)
{       

    $this->load->library('upload');
    $files = $_FILES;
    $cpt = count($_FILES['attachments']['name']);
    for($i=0; $i<$cpt; $i++)
    {           
        $_FILES['attachments']['name']= $files['attachments']['name'][$i];
        $_FILES['attachments']['type']= $files['attachments']['type'][$i];
        $_FILES['attachments']['tmp_name']= $files['attachments']['tmp_name'][$i];
        $_FILES['attachments']['error']= $files['attachments']['error'][$i];
        $_FILES['attachments']['size']= $files['attachments']['size'][$i];    
        print_r($_FILES['attachments']);
        $this->upload->initialize($this->set_upload_options());
        if (! $this->upload->do_upload('attachments'))
        {
        	$error = array('error' => $this->upload->display_errors());
        	
        }

    $data = array(
        'attachment' => $this->upload->data('file_name'),
        'discussion_id' => $discussion_id,
        'file_type' => $_FILES['attachments']['type'],
        'file_name' => $_FILES['attachments']['name'],
        'file_size' => $_FILES['attachments']['size']
        
     );
    if ( $_FILES['attachments']['size'] > 0)
    {
     $result_set = $this->discussion_model->insertAttachment($data);
    }
  }


}


public function todo($project_id, $todo_id = "")
{
	$data['project']=$this->Project_model->get_project($project_id);
	$data['todo_list'] = $this->todo_model->findByProject($project_id);
	$data['todo_id'] = $todo_id;
	$this->load->view('layouts/header');
	$this->load->view('project/todo/index', $data);
	$this->load->view('layouts/footer');
}

public function job_todo($project_id, $todo_id = "")
{	
	$logged_user = $this->current_user();
	$data['project']=$this->Project_model->get_project($project_id);
	$data['todo_list'] =$this->todo_model->findByProjectAndAssigner($project_id,$logged_user['user_id']);
	$data['todo_id'] = $todo_id;
	$this->load->view('layouts/header');
	$this->load->view('project/todo/job_todo', $data);
	$this->load->view('layouts/footer');
}

public function new_todo($project_id)
{
	$data['project']=$this->Project_model->get_project($project_id);
	
	$this->form_validation->set_rules('name',"Todo List Name",'required');
	if($this->form_validation->run() == true)
	{
		$logged_user = $this->current_user();
		$post = $this->input->post();
		$post['project_id'] = $project_id;
		$post['created_by'] = $logged_user['user_id'];
		$post['created_at'] = date("j F, Y, g:i a");
		$res=$this->todo_model->create($post);
		if($res)
		{
			$this->session->set_flashdata('message', "New Todo  added successfully");
		}else{
			$this->session->set_flashdata('exception', "Something went wrong, please try again");
		}
	}
	$data['todo_list'] = $this->todo_model->findByProject($project_id);
	$this->load->view('layouts/header');
	$this->load->view('project/todo/new', $data);
	$this->load->view('layouts/footer');	
}

public function remove_todo($id)
{
	$res=$this->todo_model->delete($id);
}


public function todo_tasks($todo)
{
	$data['todo'] = $this->todo_model->find($todo);
	$data['todo_tasks'] = $this->todo_model->tasks($todo);
	$data['deployments'] = $this->employee_model->AllEmployees();
	$this->load->view('project/todo/todo_tasks', $data);
}

public function job_todo_tasks($todo)
{
	$data['todo'] = $this->todo_model->find($todo);
	$logged_user = $this->current_user();
	if ($logged_user['user_id'] == $data['todo']['assign'])
	{
		$data['todo_tasks'] = $this->todo_model->tasks($todo);
		$data['deployments'] = $this->employee_model->AllEmployees();
		$this->load->view('project/todo/job_todo_tasks', $data);
	}
}


public function add_todo_task($todo)
{
	$post = $this->input->post();
	$post['todo_id'] = $todo;
	$logged_user = $this->current_user();
	$post['created_by'] = $logged_user['user_id'];
	echo $this->todo_model->addTask($post);
}

public function check_task($id)
{
	$post = $this->input->post();
	$this->todo_model->updateTask($id,$post);
}

public function remove_task($id)
{
	$this->todo_model->removeTask($id);
}

public function assign_todo($todo_id)
{
	$post = $this->input->post();
	$this->todo_model->updateTodo($todo_id,$post);
}

private function set_upload_options()
{   
    //upload an image options
    $config = [
        'upload_path'   => 'upload/project_disccusion_attachment/',
        'allowed_types' => 'gif|jpg|png|jpeg|pdf|doc', 
        'overwrite'     => false,
        'maintain_ratio' => true,
        'encrypt_name'  => true,
        'remove_spaces' => true,
        'file_ext_tolower' => true 
    ];

    return $config;
}



private function current_user()
{
	return 	$this->session->userdata['logged_in'];
}

private function add_project_services($project_id, $services)
{
	  foreach ($services as $i)
		{
        	$l_s = array('project_id' => $project_id,'service_id' => $i);
			$this->Project_model->addServices($l_s);
		}
}


}