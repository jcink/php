#!/usr/bin/php
<?php

echo "#######################################
# Catch FLV files written by Firefox to /tmp/
# Intended for desktop linux use via cli
#############################################
";

$dir = "/tmp/";
$dirtocopy = "/tmp/saved_flvs/";


while (1) {
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {

	if($file != "." && $file != "..") {

	// only copy flash files
	if(preg_match("/Flash/i", $file)) {

	// compare the copies in the folder, and the main one
	$csize=filesize($dir.$file);	
	$mb=round($csize/1048576, 2);
	if($csize != @filesize($dirtocopy.$file)) {
	$g=fopen($dirtocopy.$file, "w");
	fwrite($g, file_get_contents($dir.$file));
	fclose($g);
	echo "[ {$file}.flv copied => Size: $mb MB ]\n";
	}

	}
	}
	}
        }
        closedir($dh);
    }

sleep(10);

}

?>
