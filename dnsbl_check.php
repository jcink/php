<?php
	/*-------------------------------------------------------------------------*/
	// dnsbl_check
	// ------------------
	// Look up an IP address and return the results from DNSBLs.
	/*-------------------------------------------------------------------------*/
	
	function dnsbl_check($ip_address) {
	global $ibforums;
	
		$white_list = array(
			'74.196.101.190',
		);
		
		if(in_array($ip_address, $white_list)){
			return array();
		}
	
		// Make a reversed IP or w/e...
		$revmake=explode(".", $ip_address);
		$rev=$revmake[3].".".$revmake[2].".".$revmake[1].".".$revmake[0];

		// DNS BL list here! 
		$dnsbl['EFnet Multi-RBL']="$rev.rbl.efnetrbl.org";
		$dnsbl['StopForumSpam DNSBL']="$rev.dnsbl.tornevall.org";

		// Attempt to see if 127.0.0.x comes back
		foreach($dnsbl as $k=>$v) {
			if(preg_match("/127\.0\.0\./", gethostbyname($v))) { 
				$blacklisted_in[$k] = 1;
			}
		}
	
	// Send us an array of who had it listed... 
	return $blacklisted_in;
	}
?>