<?php

	require_once ('vendor/configuration.php');
	require_once ('vendor/security.class.php');
 	$security = new security;

 	// Grab IP Address

	$ip = $security -> realIP();
	
	if($security -> blacklist($ip, $blacklist)) {
		die ('Access Denied: Your IP Address is banned!');
	}
	
	// If IP is not banned, you will be able to see this below content
	echo $security -> debug();
	
	
?>