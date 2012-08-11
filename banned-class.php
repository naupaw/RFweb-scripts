<?php
/*function for banned system */
class banned
{

	public $db_id 	= 'martabak';
	public $db_pass = 'Qwerty12321';
	public $db_base = 'rf_user';
	public $db_host = 'HGXAKEN-580120C';

	function gm_check($username,$password){
		mssql_connect($db_host, $db_id, $db_pass) or die('Error connecting MSSQL');
		//check
		$query = mssql_query("SELECT * FROM rf_user.dbo.tbl_StaffAccount WHERE ID = CONVERT(BINARY,'".addslashes($username)."') AND PW = CONVERT(BINARY,'".addslashes($password)."')");
		$get = mssql_num_rows($query);
		if($get > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function gm_auth(){

	}

	function banned($type,$value){

	}
}