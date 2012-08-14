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
		$statx = array();
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
		return $statx;
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
	function user_status($file_s){

		$tco = $this->rf_total($file_s , "15"); 
		$total_connect = substr($tco,8,15); 
		$file = file ($file_s);
		foreach($file as $line)
        {
               if(strspn($line, "[") != 1)
               parse_str($line);
        }

        $data = array(	'accretia' => $A_num,
        				'belato' => $B_num,
        				'cora' => $C_num);

        return $data;
	}


	/*
	This only parent of user_status function for read statmen dont be noisy 
	*/
	private function rf_total($fichier, $ligne) 
	{ 
	    if (file_exists("$fichier")) 
	    { 
	        if($id = fopen("$fichier", "r+")) 
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