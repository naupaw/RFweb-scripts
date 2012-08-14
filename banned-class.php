<?php
/*function for banned system */
class banned
{

	public $db_id 	= 'DATABASE USER';
	public $db_pass = 'DATABASE PASSWORD';
	public $db_base = 'DATABASE';
	public $db_host = 'DATABASE HOST';

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

	function gm_auth($login,$pass){
		session_start();
		$_SESSION['login_hash'] = md5(trim($login,"\0"))."=".$rnd."=".md5(trim($pass,"\0"));
		$_SESSION['gm_id'] = trim($login,"\0");
		header( 'Location: http://'.$_SERVER['SERVER_NAME'].'/ban-example.php' ) ;
	}

	function gm_uauth(){
		session_start();
		$_SESSION['login_hash'] = "";
		$_SESSION['gm_id'] = "";
		session_unset(); 
		header( 'Location: http://'.$_SERVER['SERVER_NAME'].'/ban-example.php' ) ;
	}

	//this function check GM on authorize login or no
	//
	function login_check(){
		session_start();
		//check
		$query = mssql_query("SELECT * FROM rf_user.dbo.tbl_StaffAccount WHERE ID = CONVERT(BINARY,'".$_SESSION['gm_id']."')");
		$dbx = mssql_fetch_row($query);
		$lg = $_SESSION['login_hash'];
		$rl = md5(trim($dbx[1],"\0"))."=".$rnd."=".md5(trim($dbx[2],"\0"));
		if($lg == $rl){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function banned_user($serial, $reason, $duration, $gmwriter, $kind){
		$time = date("Y-m-d H:i:s");
		mssql_query("INSERT INTO rf_user.dbo.tbl_UserBan(nAccountSerial, dtStartDate, nPeriod, nKind, szReason, GMReason, GMWriter, ReasonType) VALUES ('".addslashes($serial)."','".$time."','".addslashes($duration)."','".$kind."','".addslashes($reason)."','".addslashes($reason)."','".addslashes($gmwriter)."',4)");
		return true;
	}
	
	function get_serial($char){
		$query = mssql_query("SELECT AccountSerial FROM rf_world.dbo.tbl_base WHERE [Name] = '" . addslashes($char) . "'");
		$has = mssql_num_rows($query);
		if($has > 0){
			$dat = mssql_fetch_row($query);
			return $dat[0];
		}else{
			return false;
		}
	}
}