
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hrmanagement extends CI_Controller {



    public function __construct()
    {
       parent::__construct();
       $this->load->model(array(
            'settings/skill_model',
            'settings/role_model',
            'employee_model',
            'TaskTo_model',
            'MessagingTo_model',
            'RequestsTo_model'
        ));       
    }	

	public function index()
	{

        $data['skills'] = $this->skill_model->AllSkills();
        $data['roles'] = $this->role_model->AllRoles();
        $data['deployments'] = $this->employee_model->AllEmployees();
		$this->load->view('layouts/header');
		$this->load->view('hr_managment/deployment', $data);
		$this->load->view('layouts/footer');


	}
	public function new_deployment()
	{
        $photo_path = '';
        $id_proof_path = '';
        $this->load->library('upload');
		$this->form_validation->set_rules('full_name',"Full Name",'required');
		$this->form_validation->set_rules('nick_name',"Nick Name",'required');

        $this->form_validation->set_rules('role',"Role",'required');
        $this->form_validation->set_rules('user_name',"User Name",'required');
        $this->form_validation->set_rules('user_password',"User Password",'required');
        
        $this->form_validation->set_rules('mobile1',"One Mobile",'required');


       $config = [
            'upload_path'   => 'upload/employee_photo/',
            'allowed_types' => 'gif|jpg|png|jpeg', 
            'overwrite'     => false,
            'maintain_ratio' => true,
            'encrypt_name'  => true,
            'remove_spaces' => true,
            'file_ext_tolower' => true 
        ];

        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload('user_image'))
        {
            $error = array('error' => $this->upload->display_errors());
         }
        else
        {
        $data = array('upload_data' => $this->upload->data());
        $photo_path = $this->upload->data('file_name');
        }

        if ($photo_path =='')
        {
            $this->form_validation->set_rules('user_image',"Photo",'required');
        }
       $config = [
            'upload_path'   => 'upload/employee_id_proof',
            'allowed_types' => 'gif|jpg|png|jpeg|pdf', 
            'overwrite'     => false,
            'maintain_ratio' => true,
            'encrypt_name'  => true,
            'remove_spaces' => true,
            'file_ext_tolower' => true 
        ];
                $this->upload->initialize($config);

                if ( ! $this->upload->do_upload('id_proof'))
                {
                        $error = array('error' => $this->upload->display_errors());
                }
                else
                {
                    $data = array('upload_data' => $this->upload->data());
                    $id_proof_path = $this->upload->data('file_name');
                }        



        if($this->form_validation->run() === true)
        {   $post = $this->input->post();
            $post['photo'] = $photo_path;
            $post['id_proof'] =  $id_proof_path;
            $res=$this->employee_model->addEmployee($post);
            if($res)
            {
                $this->session->set_flashdata('message', "New Deployment added successfully");
            }
            else{
                $this->session->set_flashdata('exception', "Something went wrong, please try again");
            }
        redirect('/hrmanagement', 'refresh');
        }
        else
        {
        $data['skills'] = $this->skill_model->AllSkills();
        $data['roles'] = $this->role_model->AllRoles();
        $data['deployments'] = $this->employee_model->AllEmployees();
        
        $this->load->view('layouts/header');
        $this->load->view('hr_managment/deployment', $data);
        $this->load->view('layouts/footer');
        }
        
		
	}

    public function employees()
    {

        $data['skills'] = $this->skill_model->AllSkills();
        $data['roles'] = $this->role_model->AllRoles();
        $data['deployments'] = $this->employee_model->AllEmployees();
        $this->load->view('layouts/header');
        $this->load->view('hr_managment/employees', $data);
        $this->load->view('layouts/footer');
        

    }

    public function  employee_profile_info($id)
    {
        $data['profile_info'] = $this->employee_model->getDetails($id);
        $this->load->view('layouts/header');
        $this->load->view('hr_managment/user_profile_info', $data);
        $this->load->view('layouts/footer');        
    } 

    public function user_connctions($id)
    {   $data['profile_info'] = $this->employee_model->getDetails($id);
        $data['deployments'] = $this->employee_model->AllEmployees();
        $data['user_id'] = $id;
        $tasks_to = $this->TaskTo_model->AllTasksOfUser($id);
        $requests_to = $this->RequestsTo_model->AllRecordsOfUser($id);
        $messaging_to = $this->MessagingTo_model->AllRecordsOfUser($id);

        $tasks_to_user = array();
        $requests_to_user = array();
        $messaging_to_user = array();

        foreach($tasks_to as $row){array_push($tasks_to_user,$row['task_to']);}
        foreach($requests_to as $row){array_push($requests_to_user,$row['request_to']);}
        foreach($messaging_to as $row){array_push($messaging_to_user,$row['messaging_to']);}        
        
        $data['tasks_to'] = $tasks_to_user;
        $data['requests_to_user'] = $requests_to_user;
        $data['messaging_to_user'] = $messaging_to_user;
        
        $this->load->view('layouts/header');
        $this->load->view('hr_managment/user_connctions', $data);
        $this->load->view('layouts/footer');   
    }

    public function apply_user_connection_settings()
    {
        $post = $this->input->post();
      //  print_r($post);
        
        $this->TaskTo_model->deleteusertasks($post['selected_user_id']);
        $this->MessagingTo_model->deleteuserRecord($post['selected_user_id']);
        $this->RequestsTo_model->deleteuserRecord($post['selected_user_id']);

        foreach($post['task_to_users_list'] as $user)
        {
            $hash = array("task_to"=>$user, "task_from"=>$post['selected_user_id']);
            $this->TaskTo_model->saveChanges($hash);
        }
        foreach($post['messaging_to'] as $user)
        {
            $hash = array("messaging_to"=>$user, "messaging_from"=>$post['selected_user_id']);
            $this->MessagingTo_model->saveChanges($hash);
        }
        foreach($post['requests_to'] as $user)
        {
            $hash = array("request_to"=>$user, "request_from"=>$post['selected_user_id']);
            $this->RequestsTo_model->saveChanges($hash);
        }


        echo $logged_user['nick_name'];
    } 


    private function current_user()
    {
        return  $this->session->userdata['logged_in'];
    }

}
?>