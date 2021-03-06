<?php 

/**
* 
*/
class not_installed extends ci_controller
{
	
	function __construct()
	{
		parent::__construct();
	}
	function index(){
		
        if ($this->session->userdata('username') != "") {
            $data['title'] = 'Home';
            $this->load->model('employee');
            $this->load->model('job');
            $username = $this->session->userdata('username');
            $data['result'] = $this->employee->get_detail_emp($username);

            $dt = $data['result']->row();
            $data['job'] = $this->job->get_job_data($dt->emp_job)->row();

            $this->load->model('notifications');
            $data['notif'] = $this->notifications->get_notifications($dt->emp_num);
            $data['app_config'] = $this->admin_config->load_app_config();         
            $data['mid_content'] = 'content/not_installed';
            $this->load->view('includes/home_template', $data);
        } else {
            redirect("/login");
        }
	}
}
 ?>