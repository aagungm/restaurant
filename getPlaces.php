<?php
	
	$response = array();

	$apikey = "AIzaSyCjR39wgV-VcCc8kvc8CVawrA32lQTDaV8";
	$coords = $_GET["coords"];

	$contents = file_get_contents("https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=".$coords."&rankby=distance&type=restaurant&key=".$apikey);
	$contents = json_decode($contents, true);
	if ($contents["status"] == "OK") {
		$places = $contents["results"];

		(sizeof($places) > 10 ? $reps=10 : $reps=sizeof($places));
		for ($i=0; $i<$reps; $i++) {
			$tempPlace = array();
			$tempLoc = array();
			$tempLoc["lat"] = $places[$i]["geometry"]["location"]["lat"];
			$tempLoc["lng"] = $places[$i]["geometry"]["location"]["lng"];
			$tempPlace["location"] = $tempLoc;
			$tempPlace["name"] = $places[$i]["name"];
			$tempPlace["address"] = $places[$i]["vicinity"];
			$tempPlace["id"] = $places[$i]["place_id"];
			array_push($response, $tempPlace);
		}
	}

	echo (json_encode($response));
?>