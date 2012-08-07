<?php
//register class RF Online

class register {

	//Simple configuration for Global
	
	public $db_id 	= 'DATABASE_ID';
	public $db_pass = 'DATABASE_PASSWORD';
	public $db_base = 'DATABASE';
	public $db_host = 'DATABASE_HOST';

	function validate($id,$email,$pass){

		//mssql_connect($db_host, $db_id, $db_pass) or die('Error connecting MSSQL');

		$data = array();

		if(!preg_match('/^[a-zA-Z0-9_]+$/',$id)){
			$data['err'][] = "username not valid";
		}
		
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$data['err'][] = "email must be valid";
		}

		if(!preg_match('/^[a-zA-Z0-9_-]+$/',$pass)){
			$data['err'][] = "Password must contain a-z 0-9 - _";
		}

		if(empty($id) || empty($email) || empty($pass)){
			$data['err'][] = "Form must fill all";
		}

		$us_h = mssql_query('SELECT * FROM rf_user.dbo.tbl_rfaccount WHERE id = CONVERT(binary,\''.$id.'\')') or die("Query failed");
		if(mssql_num_rows($us_h) > 0){
			$data['err'][] = "Username Already Exits";
		}

		if($data){
			$hasil = $data;
		}else{
			$hasil = array('success'=>1);
		}

		return $hasil;
	}

	function add_user($id,$email,$pass){

		mssql_connect($db_host, $db_id, $db_pass) or die('Error connecting MSSQL');

		$username = strtolower($id);
		$q = mssql_query("INSERT INTO RF_User.dbo.tbl_rfaccount (id,password,BCodeTU,Email) VALUES ((CONVERT(binary, '$username')), (CONVERT(binary, '$pass')),'1', '$email');");
		$has = array();
		if($q){
			return $has['succed'] = 1;
		}else{
			return $has['err'] = 0;
		}
	}
}
?>