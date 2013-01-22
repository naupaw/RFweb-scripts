<?php
class rfgame
{
	//Only Global Setting some matters !
	public $rf_name 		  = "RF ONLINE BLAH BLAH BLAH"; // Your RF Online name
	public $download_link 	  = "DOWNLOAD LINK GOES HERE"; //place download link here
	public $group_link		  = "GROUP / FORUM LINK"; //Group Link


	/*
	SERVER STATUS ALLOW TO READ SERVER STATUS OFFLINE OR ONLINE
	LIKE LOGIN PORT AND GAME PORT
	server_status('your game ip','game port','login port');
	will be return the array object
	- lg_stat for login status
	- gm_stat for game status
	*/
	public function statuscheck($ip, $gport, $lport) {
		$gm_stat = @fsockopen($ip, $gport, $errno, $errstr, 1);
		$lg_stat = @fsockopen($ip, $lport, $errno, $errstr, 1);
		$stat = array();
		if (!$gm_stat) {
			$stat['gm_stat'] = FALSE;
		} else {
			@fclose($sockres);
			$stat['gm_stat'] = TRUE;
		}
		if (!$lg_stat) {
			$stat['lg_stat'] = FALSE;
		} else {
			@fclose($sockres);
			$stat['lg_stat'] = TRUE;
		}
		return $stat;
	}
	/*
	SERVER USER STATUS 
	THIS FUNCTION WILL BE USE 
	FOR READ HOW MANY PLAYER PLAY IN YOUR SERVER
	
	will be return as array object will number player
	- accretia
	- belato
	- cora
	*/
	// Default File is C:\RF\ZoneServer\SystemSave\ServerDisplay.ini 
	function user_status($filename){

		if (file_exists($filename)) {
		    $handle = fopen($filename, "r+");
		    $contents = fread($handle, filesize($filename));
		    fclose($handle);

		    //--Total player--
		    $total = explode('UserNum=', $contents);
		    $total2 = explode("\n",$total[1]);
		    //--accretia--
		    $A_num = explode('A_num=', $contents);
		    $A_num2 = explode("\n",$A_num[1]);
		    //--belato--
		    $B_num = explode('B_num=', $contents);
		    $B_num2 = explode("\n",$B_num[1]);
		    //--Cora--
		    $C_num = explode('C_num=', $contents);
		    $C_num2 = explode("\n",$C_num[1]);

		    $data = array(	'total' => $total2[0],
        					'accretia' => $A_num2[0],
        					'belato' => $B_num2[0],
        					'cora' => $C_num2[0]
        				 );
		}else{
			$data = "file not found";
		}

        return $data;
	}


	/*
	This only parent of user_status function for read statmen dont be noisy 
	*/
	private function rf_total($fichier, $ligne) 
	{ 
	    if (file_exists($fichier)) 
	    { 
	        if($id = fopen($fichier, "r+")) 
	            { 
	            while(!feof($id)) 
	            { 
	                $result[]= fgets($id,1000000); 
	            } 
	            fclose($id); 
	            $tab=$result; 
	            $result=$tab[$ligne-1]; 
	            return $result; 
	        } 
	        else 
	        { 
	            return pb_ouv; 
	        } 
	    } 
	    else 
	    { 
	        return no_file; 
	    } 
	}

}