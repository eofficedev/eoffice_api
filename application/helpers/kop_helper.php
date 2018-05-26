<?php 

function generateKop($creator_num){
	$ci = &get_instance();
	$ci->load->model("notadinas/nota_template_kop","kop");
	$ci->load->model("notadinas/database","org");
	$ci->org->set_table("hrms_organization");
	$ci->org->set_order("org_num asc");
	$ci->org->set_where("org_num in (select org_id from hrms_employees where emp_num = ".$creator_num.")");
	$org = $ci->org->tampil();
	if(count($org) == 0){
		return false;
	}
	$org = $org[0];
	$ci->kop->set_where(array("id"=>$org->template_kop_id));
	$kop = $ci->kop->tampil();
	if(count($kop)==0){
		return false;
	}
	$kop = $kop[0];
	$content = $kop->isi;
	foreach($org as $k => $val){
		$content = str_replace("{{".$k."}}", $val, $content);
	}
		$content = str_replace("src=\"", "src=\"".base_url(), $content);
	
	return $content;

}
?>
