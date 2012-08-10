<?php
require_once('recaptchalib.php');
require_once('user-register-class.php');


$register = new register();

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

if(isset($_POST['username'])){

	//Validate Form
	$dat = $register->validate($username,$email,$password);

		if($dat['success']){
			//if success add user to database
			$register->add_user($username,$email,$password);
			return TRUE;
		}else{
			//if error return error reason from array
			foreach($dat['err'] as $reason){
				echo $reason;
			}
		}
}
?>