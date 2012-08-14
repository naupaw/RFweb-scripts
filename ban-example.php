<?php
require_once('banned-class.php');
session_start();
$ban = new banned();

if($_GET['p'] == 'logout'){
	$ban->gm_uauth();
}

if(isset($_POST['username'])){
	$typ = $ban->gm_check($_POST['username'],$_POST['password']);

	if($typ){
		$ban->gm_auth($_POST['username'],$_POST['password']);
	}else{
		echo "this not valid GM User";
	}
}

?>
<?php

if(!$ban->login_check()){

?>
<form method="post" action="">
	username<br/>
	<input type="text" name="username"/> <br/>
	password<br/>
	<input type="password" name="password"/> <br/>
	<input type="submit" value="check"/>
</form>
<?php 
}else{
	echo "<center>GM is now login <a href='?p=logout'>Logout</a><br/>";
	//$re = $ban->get_serial('test3');

	if(isset($_POST['chr']) || isset($_POST['period']) || isset($_POST['kind']) || isset($_POST['reason'])){
		echo "you dont say<br/>";
		$chr = $ban->get_serial($_POST['chr']);

		if($chr){
			$ban->banned_user($chr,$_POST['reason'],$_POST['period'],'[GCP]Panel System',$_POST['kind']);
			echo "ok banned !";
		}else{
			echo "char not found";
		}
	}
?>
<form method="POST" action="">
	<table style="text-align:center">
		<tr>
			<td>Char name</td><td>Period</td><td>Banned type</td><td>Reason</td>
		</tr>
		<tr>
			<td><input type="text" name="chr"/></td>
			<td><input type="text" name="period" placeholder="999 for permanent"/></td>
			<td>
				<select name="kind">
				  <option value="0">Account</option>
				  <option value="1">Chat</option>
				</select>
			</td>
			<td><input type="text" name="reason"/></td>
		</tr>
	</table>
	<input type="submit" value="Banned !"/>
</form>
</center>
<?php
}
?>
