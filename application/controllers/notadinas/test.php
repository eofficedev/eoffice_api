<?php 
/**
* 
*/
class test extends ci_controller
{
	
	function __construct()
	{
		parent::__construct();
		    $this->load->model("notadinas/lampiran","lampiran",true);
              
	}
	 function upload(){
        $nota_id = $this->input->post("notaid");
        $where = array("nota_id"=>$nota_id);
        $this->lampiran->set_where($where);

          $config = array(
            'allowed_types' => '*',
            'upload_path' =>'uploads/notadinas/',
            'max_size' => 0,
            'file_name' => $nota_id
        );
          $this->load->library('upload', $config);
        $files = $_FILES;
        $cpt = count($_FILES['nota_att']['name']);
        echo print_r( $cpt);
        for ($i = 0; $i < $cpt; $i++) {

            $_FILES['userfile']['name'] = $files['nota_att']['name'][$i];
            $_FILES['userfile']['type'] = $files['nota_att']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $files['nota_att']['tmp_name'][$i];
            $_FILES['userfile']['error'] = $files['nota_att']['error'][$i];
            $_FILES['userfile']['size'] = $files['nota_att']['size'][$i];

            if($this->upload->do_upload('userfile')){
              $this->data = array('upload_data' => $this->upload->data());
              $this->lampiran->nota_id = $nota_id;
              $this->lampiran->lampiran_name = $files['nota_att']['name'][$i];
              $this->lampiran->lampiran_link = $this->data['upload_data']['file_name'];
              $this->lampiran->set_values();
              $this->lampiran->simpan();
            }
            else{
            echo $config["upload_path"];
              $error = array('error' => $this->upload->display_errors());
              echo $error['error'];
            }
        }
      }
      function genKop($orgnum){
        $this->load->helper("kop");
        echo generateKop($orgnum);
      }
}

 ?>