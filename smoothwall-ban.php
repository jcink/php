<?php

// --------------------------------------------
// Ban in Smoothwall Express v3.0 with cURL
// --------------------------------------------

$IP_ADDRESS = '1.2.3.4';

// create a new cURL resource
$ch = curl_init();

// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, "http://admin:passwordhere@192.168.0.1:81/cgi-bin/ipblock.cgi");

curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_NOBODY, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_POST, 1); 
curl_setopt($ch, CURLOPT_POSTFIELDS, "SRC_IP={$IP_ADDRESS}&TARGET=DROP&COMMENT=smoothwall_ban_php&ENABLED=on&ACTION=Add");

// grab URL and pass it to the browser
$OMG = curl_exec($ch);

// close cURL resource, and free up system resources
curl_close($ch);

?>