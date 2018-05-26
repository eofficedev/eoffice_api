<?php 
/**
* 
*/
include_once("database.php");
class nota_template_kop extends database
{
	
	function __construct()
	{
		parent::__construct();
		$this->table = "nota_template_kop";
		$this->order = "id asc";
	}
}
 ?>