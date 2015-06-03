<?php
	//variable to return to the ajax call from client javascript
	$response = array();

	//DB values and credentials, import from db_config.php
	require_once('db_config.php');

	//init vars
	$comments = array();
	$response = array();

	//get GET data
	$text = $_GET["text"];
	$ref = $_GET["ref"];

	//connect to db
	$db = mysqli_connect(DBSERVER, DBUSER, DBPASS, DATABASE)
		or die("Unable to connect to MySQL");

	//insert data into database
	$query = "INSERT INTO `prac5_comments` (`ref_id`, `comment_text`) VALUES ('$ref','$text')";
	$result = mysqli_query($db, $query);
	if ($result) {
		$response["success"] = true;
		//after successful comment insert, retrieve all other comments to send back to client
		$query = "SELECT * FROM `prac5_comments` WHERE `ref_id`='$ref'";
		$result = mysqli_query($db, $query);

		if (mysqli_num_rows($result) > 0) {
			//get result and store values in variables
			while ($row = mysqli_fetch_row($result)) {
				array_push($comments, $row[2]);
			}
			$response["comments"] = $comments;
		}
	} else {
		$response["success"] = false;
	}

	echo json_encode($response);
?>