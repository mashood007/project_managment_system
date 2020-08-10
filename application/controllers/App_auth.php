<?php 
    class Auth_module
    {
    private $CI;

    function Auth_module()
    {
    $this->CI = &get_instance();
    }

    function index()
    {
    if ($this->CI->session->userdata('logged_in') == "" && (current_url() != site_url('/home/forgot_password')) && (current_url() != site_url('/home/login')) && (current_url() != site_url('/cron_job/salary_payment')) && (current_url() != site_url('/home/customer_login')))  // If no session found redirect to login page.
    {
        redirect(site_url('/home/login'));
    }
    }
}
?>