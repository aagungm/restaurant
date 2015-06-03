<?php


	session_start();
	$errorMessage = "";

	$username = strtolower($_POST['username']);
	$password = $_POST['password'];
	$timer = $_POST['timer'];

	if ($timer == "10") {
		$_SESSION["timer"] = 10;
	} else {
		$_SESSION["timer"] = 86400;
	}


	$myUsername = "infs";
	$myPassword = "3202";

	

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if( empty($username) || empty($password)){
			// $errorMessage = "Please input username and password";
			$_SESSION["errorMessage"] = "Please input username and password";
			header("Location: login-page.php");
		} 
		elseif($username != $myUsername && $password != $myPassword){
			// $errorMessage = "Incorrect username or password";
			$_SESSION["errorMessage"] = "Incorrect username or password";
			header("Location: login-page.php");
		}
		else
			{			
				$_SESSION["username"] = $username;
				$_SESSION["password"] = $password;

					$log = "logs/logs.txt";
	 				$loginTime = $_SERVER['REQUEST_TIME'];
	 				$loginTime = date('Y-m-d H:i:s');
	 				$content = "INFS logged in ".$loginTime."\n" ;
	 				file_put_contents($log,$content, FILE_APPEND);

				header("Location: index-admin.php");
			}
	}

