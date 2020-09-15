<?php
	function detect_browser() {
		$server = $_SERVER['HTTP_USER_AGENT'];
		$browser = "Inconnu";
		$browser_array = array('/mobile/i' => 'Navigateur mobile',
					'/msie/i'      => 'Internet Explorer',
					'/trident/i'   => 'Internet Explorer',
					'/firefox/i'   => 'Firefox',
					'/safari/i'    => 'Safari',
					'/chrome/i'    => 'Chrome',
					'/edge/i'      => 'Microsoft Edge',
					'/opera/i'     => 'Opera',
					'/netscape/i'  => 'Netscape',
					'/maxthon/i'   => 'Maxthon',
					'/konqueror/i' => 'Konqueror'
		);
		foreach ($browser_array as $regex => $value){
			if (preg_match($regex, $server)){
				$browser = $value;
			}
		}
		return $browser;	
	}

	function detect_os() {
		$server = $_SERVER['HTTP_USER_AGENT'];
		$os_platform  = "Inconnu";
		$os_array     = array('/windows nt 10/i' =>  'Windows 10',
					'/windows nt 6.3/i'     =>  'Windows 8.1',
					'/windows nt 6.2/i'     =>  'Windows 8',
					'/windows nt 6.1/i'     =>  'Windows 7',
					'/windows nt 6.0/i'     =>  'Windows Vista',
					'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
					'/windows nt 5.1/i'     =>  'Windows XP',
					'/windows xp/i'         =>  'Windows XP',
					'/windows nt 5.0/i'     =>  'Windows 2000',
					'/windows me/i'         =>  'Windows ME',
				 	'/win98/i'              =>  'Windows 98',
					'/win95/i'              =>  'Windows 95',
					'/win16/i'              =>  'Windows 3.11',
					'/macintosh|mac os x/i' =>  'Mac OS X',
					'/mac_powerpc/i'        =>  'Mac OS 9',
					'/linux/i'              =>  'Linux',
					'/ubuntu/i'             =>  'Ubuntu',
					'/iphone/i'             =>  'iPhone',
					'/ipod/i'               =>  'iPod',
					'/ipad/i'               =>  'iPad',
					'/android/i'            =>  'Android',
					'/blackberry/i'         =>  'BlackBerry',
					'/webos/i'              =>  'Mobile'
		);
		foreach ($os_array as $regex => $value){
			if (preg_match($regex, $server)){
				$os_platform = $value;
			}
		}
		return $os_platform;
	}

	function get_ip() {
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    }
	    elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
	        $ip = $_SERVER['HTTP_CLIENT_IP'];
	    }
	    else {
	        $ip = $_SERVER['REMOTE_ADDR'];
	    }
	    
	    return $ip;
	}
?>