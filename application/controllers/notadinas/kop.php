<?php 

/**
* 
*/
class kop extends ci_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("notadinas/nota_template_kop","kop");
	}
	function save(){
		$data = $_POST;
		if(isset($data["submit"]))
			unset($data['submit']);
		$this->kop->values = $data;
		$this->kop->simpan();
		redirect("notadinas/kop");
	}
	function update($id){
		$data = $_POST;
		if(isset($data["submit"]))
			unset($data['submit']);
		$where = array("id"=>$id);
		$this->kop->set_where($where);
		$this->kop->values = $data;
		$this->kop->update();
		redirect("notadinas/kop");

	}
	function delete(){
		$id = $this->input->post("id");
		$where = array("id"=>$id);
		$this->kop->set_where($where);
		$this->kop->hapus();		
		echo "true";
	}
	function upload(){

	}
	function form($act,$id=null){
	    $data['mid_content'] = 'content/notadinas/kop/form';
		$data["kop"] = new stdClass();
		if($act=="add"){
			$data['title'] = 'Tambah - Konfigurasi Kop Surat';
	        $data['action'] = 'save';
	        $this->load->model('employee');
	        $data['employees'] = $this->employee->get_all_emp();

	        $this->load->model('admin_config');
	        $data['config'] = $this->admin_config->load_config_data();
	        $data['app_config'] = $this->admin_config->load_app_config();
	        $data['conf'] = $this->kop->tampil();
		    $username = $this->session->userdata('username');
	        $data['result'] = $this->employee->get_detail_emp($username);
	        $this->load->view('includes/home_template', $data);
	
		}
		else{
			$where = array("id"=>$id);
			$this->kop->set_where($where);
			$kop = $this->kop->tampil();
			if(count($kop)==0){
				redirect("notadinas/kop");
			}
			$data['title'] = 'Edit - Konfigurasi Kop Surat';
	        $data['action'] = 'update/'.$id;
	        $data["kop"] = $kop[0];
	        $this->load->model('employee');
	        $data['employees'] = $this->employee->get_all_emp();
	        $this->load->model('admin_config');
	        $data['config'] = $this->admin_config->load_config_data();
	        $data['app_config'] = $this->admin_config->load_app_config();
	        $data['conf'] = $this->kop->tampil();
		    $username = $this->session->userdata('username');
	        $data['result'] = $this->employee->get_detail_emp($username);
	        $this->load->view('includes/home_template', $data);
		
		}
	}
	function index(){
		$this->show_config();
	}
	function show_config(){
		$data['title'] = 'Konfigurasi Kop Surat';
        $data['mid_content'] = 'content/notadinas/kop/index';
        $this->load->model('employee');
        $data['employees'] = $this->employee->get_all_emp();

        $this->load->model('admin_config');
        $data['config'] = $this->admin_config->load_config_data();
        $data['app_config'] = $this->admin_config->load_app_config();
        $data['conf'] = $this->kop->tampil();
	    $username = $this->session->userdata('username');
        $data['result'] = $this->employee->get_detail_emp($username);
        $this->load->view('includes/home_template', $data);

	}
}
 ?>