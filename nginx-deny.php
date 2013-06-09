<?php

// --------------------------------------------------
// Generate nginx deny syntax from an ip address list
// --------------------------------------------------

$ip_addrs = file("ip_addresses.txt");

header("Content-Type: text/plain");

foreach($ip_addrs as $ip){
	$ip = trim($ip);
	if(!preg_match("/\#/", $ip) AND $ip != '') {
		print "deny {$ip};";
		print "\n";
	}
}
?>