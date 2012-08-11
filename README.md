#RF Web scripts
##RF info integrate with website PHP
--------------------------------------------
there are include function
-register
-server game and login status port
-server game player number status
-GM Panel for Banned with Char only (WIP will add son)

Example usage

	require_once('rf-class.php');
	$rf = new rfgame();

	//check RF Game server Online / Offline status

	$status = $rf->statuscheck('127.0.0.1','10001','27780');

	//RF game status
	$status['gm_stat']; //return TRUE / FALSE
	//login status
	$status['lg_stat']; //return TRUE / FALSE

	//how many player in the game

	$total = $rf->user_status('C:\RF\ZoneServer\SystemSave\ServerDisplay.ini');

	echo $total['accretia'];
	echo $total['belato'];
	echo $total['cora'];

Notice : this is alpha version
there are some bugs that may occur.

please mention me [@engga_enak] : http://twitter/engga_enak to more information or report bugs