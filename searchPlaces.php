<?php

	$response = array();

	$apikey = "AIzaSyCjR39wgV-VcCc8kvc8CVawrA32lQTDaV8";
	$coords = $_GET["coords"];
	$query = $_GET["query"];
	
	$contents = file_get_contents("https://maps.googleapis.com/maps/api/place/textsearch/json?query=".$query."&location=".$coords."&radius=1500&key=".$apikey);
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
			
			$tempPlace["address"] = $places[$i]["formatted_address"];
			
			$tempPlace["id"] = $places[$i]["place_id"];
			array_push($response, $tempPlace);
		}
	}

	echo (json_encode($response));
?>