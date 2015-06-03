<?php
	
	require_once('db_config.php');

	$RESTAURANTS = array();

	
	$db = mysqli_connect(DBSERVER, DBUSER, DBPASS, DATABASE)
		or die("Unable to connect to MySQL");

	$searchquery = $_GET["search_text"];

	$query = "SELECT `name`, `location`, `contact`, `description`, `images`, `latitude`, `longitude`, `id` FROM `prac4` WHERE (`name` LIKE '%$searchquery%' OR `location` LIKE '%$searchquery%' OR `description` LIKE '%$searchquery%' OR `contact` LIKE '%$searchquery%')";
	$result = mysqli_query($db, $query);
	
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_row($result)) {
			$data = array();
			$temp = explode("#", $row[4]);
			
			array_push($data, $row[0]);
			array_push($data, $row[1]);
			array_push($data, $row[2]);
			array_push($data, $row[3]);
			array_push($data, $temp);
			array_push($data, $row[5]);
			array_push($data, $row[6]);
			array_push($data, $row[7]);
			array_push($RESTAURANTS, $data);
		}
	}
	mysqli_close($db);
?>