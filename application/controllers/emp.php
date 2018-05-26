<?php

class Emp extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if($this->session->userdata('username')=="") die('Forbidden Access');
    }

    function index($id = NULL) {
        //Eka:add session check
        if($this->session->userdata('username') != "admin"){
            echo "Forbidden Access!";
            die;
        }

        $data['title'] = 'List Employees Data';
        $data['mid_content'] = 'content/employee/list_employee';
        $this->load->model('employee');
        
//        $config['base_url'] = base_url() . 'index.php/emp';
//        $config['first_page'] = 'Awal';
//        $config['last_page'] = 'Akhir';
//        $config['total_rows'] = $this->employee->get_total_emp();
//        $config['per_page'] = 7;
//        $config['num_links'] = 4;
//        $this->pagination->initialize($config);
        
        $data['employees'] = $this->employee->get_all_emp();

        $username = $this->session->userdata('username');
        $data['result'] = $this->employee->get_detail_emp($username);
        $data['app_config'] = $this->admin_config->load_app_config();
        $this->load->view('includes/home_template', $data);
    }

    function add_emp() {
        //Eka:add session check
        if($this->session->userdata('username') != "admin"){
            echo "Forbidden Access!";
            die;
        }

        $res = $this->get_session();
        $data['result'] = $res['result'];
        $this->load->model("absensi/database","pegawai",true);
        $this->pegawai->set_table("hrms_employees");
        $this->pegawai->set_table("hrms_employees");
        $data["countEmployee"] = $this->pegawai->count();
        
        $this->load->model('job');
        $data['jobs'] = $this->job->get_all_job();
        $data['job_curr'] = $this->job->load_curr_num();
        $this->load->model('employee');
        $data['emp_curr_num'] = $this->employee->load_curr_num();

        $this->load->model('organization');
        $data['org'] = $this->organization->get_all_org();

        $data['title'] = 'Add New Employee';
        $data['mid_content'] = 'content/employee/add_employee';
        $data['app_config'] = $this->admin_config->load_app_config();
        $this->load->view('includes/home_template', $data);
    }

    function get_session() {
        $this->load->model('employee');
        $username = $this->session->userdata('username');
        $data['result'] = $this->employee->get_detail_emp($username);

        return $data;
    }
   
    function process_add() {
        //Eka:add session check
        if($this->session->userdata('username') != "admin"){
            echo "Forbidden Access!";
            die;
        }

        //Eka: add post var check
        if(!$this->input->post("emp_work_telp")){
            redirect('emp');
        }

        $this->form_validation->set_rules('emp_firstname', 'First Name', 'trim|required');
        // $this->form_validation->set_rules('emp_lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('emp_dob', 'Birth Date', 'trim|required');
        $this->form_validation->set_rules('emp_street', 'Street Address', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('emp_email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('emp_org', 'Organization', 'trim|required');
        $this->form_validation->set_rules('emp_job', 'Job', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[12]');
        //$this->form_validation->set_rules('email_password', 'Email Password', 'required');
        //$this->form_validation->set_rules('email_username', 'Email Username', 'required');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');
        foreach ($this->input->post("emp_work_telp") as $key => $value) {
            // echo $key." ".$value;
            $this->form_validation->set_rules('emp_work_telp['.$key.']', 'Telp', 'trim|xss_clean|is_unique[emp_telp.telp_no]');

        }

        if ($this->form_validation->run() != FALSE) {

            // die();
            $this->load->model('employee');
            $q = $this->employee->add_employee();

            if ($q) {
                redirect('emp');
            } else {
                redirect('emp/add_emp');
            }
        } else {
            // echo validation_errors();
            $this->add_emp();
        }
    }

    function view() {
        //Eka:add session check
        if($this->session->userdata('username') != "admin"){
            echo "Forbidden Access!";
            die;
        }

        $get = $this->uri->uri_to_assoc();
        $this->load->model('employee');
        $data['res'] = $get['id'];

        $this->load->model('job');
        $data['jobs'] = $this->job->get_all_job();

        $this->load->model('organization');
        $data['org'] = $this->organization->get_all_org();
        $data['employee_data'] = $this->employee->get_emp_data($data['res']);
        $data['telp'] = $this->employee->get_employee_telp($data['res']);
        
        $data['title'] = 'Employee Profile';
        $data['mid_content'] = 'content/employee/update_employee';
        $res = $this->get_session();

        $data['user_data'] = $this->employee->get_user_data($data['res']);
        $orgid = $data['employee_data']->row()->org_id;

        $data['job'] = $this->job->load_job_by_org($orgid);

        $data['result'] = $res['result'];
        $data['app_config'] = $this->admin_config->load_app_config();
        $this->load->view('includes/home_template', $data);
    }

    function process_update() {
        //Eka:add session check
        if($this->session->userdata('username') != "admin"){
            echo "Forbidden Access!";
            die;
        }

        $num = $this->input->post('emp_num');
        $this->form_validation->set_rules('emp_firstname', 'First Name', 'trim|required');
        // $this->form_validation->set_rules('emp_lastname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('emp_dob', 'Birth Date', 'trim|required');
        $this->form_validation->set_rules('emp_street', 'Street Address', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('emp_email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('emp_org', 'Organization', 'trim|required');
        $this->form_validation->set_rules('emp_job', 'Job', 'trim|required');
		if($this->input->post('password') != ""){
			$this->form_validation->set_rules('password', 'Password', 'trim|min_length[5]|max_length[12]');
			$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|matches[password]');
		}
        if ($this->form_validation->run() != FALSE) {
            $this->load->model('employee');
            $q = $this->employee->update_emp();

            if ($q) {
                redirect('/emp');
            } else {
                redirect('/emp');
            }
        } else {
            // echo validation_errors();
            // die();
            $this->load->model('employee');
            $data['res'] = $this->input->post('emp_num');

            $this->load->model('job');
            $data['jobs'] = $this->job->get_all_job();

            $this->load->model('organization');
            $data['org'] = $this->organization->get_all_org();
            $data['employee_data'] = $this->employee->get_emp_data($data['res']);
			$data['telp'] = $this->employee->get_employee_telp($data['res']);

            $data['title'] = 'Employee Profile';
            $data['mid_content'] = 'content/employee/update_employee';
            $res = $this->get_session();

            $data['user_data'] = $this->employee->get_user_data($data['res']);
            $orgid = $data['employee_data']->row()->org_id;

            $data['job'] = $this->job->load_job_by_org($orgid);

            $data['result'] = $res['result'];
            $data['app_config'] = $this->admin_config->load_app_config();
            $this->load->view('includes/home_template', $data);
        }
    }

    function filter_emp() {
        //Eka:add session check
        if($this->session->userdata('username') != "admin"){
            echo "Forbidden Access!";
            die;
        }
        $data['title'] = 'List Employees Data';
        $data['mid_content'] = 'content/employee/list_employee';
        $this->load->model('employee');
        $data['employees'] = $this->employee->get_filter_employee();
        $username = $this->session->userdata('username');
        $data['result'] = $this->employee->get_detail_emp($username);
        $data['app_config'] = $this->admin_config->load_app_config();
        $this->load->view('includes/home_template', $data);
    }

    function load_emp_per_org() {
        $this->load->model('employee');
        $q = $this->employee->load_emp_by_org();
        echo $q;
    }
    
    function get_jabatan_by_keyword(){
        $this->load->model('employee');
        $q = $this->employee->get_jabatan_by_keyword();
        
        echo $q;
    }
    
    function get_employee_by_name(){
        $this->load->model('employee');
        $q = $this->employee->get_employee_by_name();
        
        echo $q;
    }
    
    function load_detail_profile(){
       $profid = $this->input->post('prof');
       $this->load->model('employee');
       $q = $this->employee->load_detail_profile($profid);
        
        echo $q;
    }
    
    function del_profile(){
        $this->load->model('employee');
        $q = $this->employee->del_profile();
        
        return $q;
    }
    
    function hapus_emp($empnum){
        //Eka:add session check
        if($this->session->userdata('username') != "admin"){
            echo "Forbidden Access!";
            die;
        }
        $this->load->model('employee');
        $q = $this->employee->del_emp($empnum);
        
        if($q){
            redirect("emp");
        }
    }
}