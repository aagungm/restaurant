<?php

	session_start(); 


	unset($_SESSION["username"]);
	unset($_SESSION["password"]);
	unset($_SESSION["timer"]);
	session_destroy();

	$log = "logs/logs.txt";

	// $loginTime = $_SERVER['REQUEST_TIME'];
	// $loginTime = gmdate("Y-m-d H:i:s", $loginTime);
	$logoutTime = date('Y-m-d H:i:s');

	$content = "INFS logged out by timer ".$logoutTime."\n" ;


	file_put_contents($log,$content, FILE_APPEND);
	header("Location: index.php");
