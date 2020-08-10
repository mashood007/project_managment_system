<?php

class Cron_job extends CI_Controller {

    public function __construct()
    {
       parent::__construct();
      //is_cli() OR show_404();   
       $this->load->model(array(
            'employee_model',
            'salary_model',
        )); 
    }

    public function salary_payment()
    {
    	$employees = $this->employee_model->ActiveEmployees();
    	foreach ($employees as $row) {
    		if ($row['salary_date'] == date("d"))
    		{
    			$post['created_at'] = date("j F, Y, g:i a");
    			$post['employee_id'] = $row['id'];
    			$post['amount'] = $row['salary'];
    			$this->salary_model->create($post);
    			echo "--".PHP_EOL;
    		}
            else
            {
              //  echo "noooooooo";
            }

    	}
    }

}
?>