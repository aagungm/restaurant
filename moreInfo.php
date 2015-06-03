<?php
	session_start();
	//DB values and credentials, import from db_config.php
	require_once('db_config.php');

	//initialise variables
	$location = array();
	$name;
	$address;
	$phone;
	$flag = true;
	$comments = array();

	//connect to db
	$db = mysqli_connect(DBSERVER, DBUSER, DBPASS, DATABASE)
		or die("Unable to connect to MySQL");

	//initialise required variables for places api call
	$apikey = "AIzaSyCjR39wgV-VcCc8kvc8CVawrA32lQTDaV8";
	$placeRef = $_GET["ref"];

	//query db to determine if this particular restaurant has already been saved to the db
	$query = "SELECT * FROM `prac5` WHERE `ref_id`='$placeRef'";
	$result = mysqli_query($db, $query);
	//got restaurant data i.e. restaurant already in database
	if (mysqli_num_rows($result) > 0) {
		//get result and store values in variables
		while ($row = mysqli_fetch_row($result)) {
			$location["lat"] = $row[5];
			$location["lng"] = $row[6];
			$name = $row[2];
			$address = $row[3];
			$phone = $row[4];
		}
	} else {
		//no rest. data i.e. first time user clicked on more info for this restaurant i.e. need to store data to db
		//get places information given the initial variables
		$shabooshki = file_get_contents("https://maps.googleapis.com/maps/api/place/details/json?placeid=".$placeRef."&key=".$apikey);
		$shabooshki = json_decode($shabooshki, true);
		if ($shabooshki["status"] == "OK") {
			$place = $shabooshki["result"];
			//get location coords information
			$location["lat"] = $place["geometry"]["location"]["lat"];
			$location["lng"] = $place["geometry"]["location"]["lng"];
			$name = $place["name"];
			$address = $place["formatted_address"];
			$phone = $place["formatted_phone_number"];
			//insert data into database
			$query = "INSERT INTO `prac5` (`ref_id`, `name`, `address`, `phone`, `lat`, `lng`) VALUES ('$placeRef','$name','$address','$phone','$location[lat]','$location[lng]')";
			$result = mysqli_query($db, $query);
			// if (!$result) {
			// 	echo ("<script>alert('Something went wrong while inserting data.');</script>");
			// }
		}
	}

	//check for comments
	
	$query = "SELECT * FROM `prac5_comments` WHERE `ref_id`='$placeRef'";
	$result = mysqli_query($db, $query);
	if (mysqli_num_rows($result) > 0) {
		$flag = false;
		//get result and store values in variables
		while ($row = mysqli_fetch_row($result)) {
			array_push($comments, $row[2]);
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Restaurant</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/lightbox.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<a href='index.php' class='navbar-brand'>My Restaurant </a> 
			<ul class="nav navbar-nav navbar-right">
				<li><a href="index.php">Home</a></li>
				<li><a href="#">About Us</a></li>
				<li><a href="#">Contact Us</a></li>
				<li><a href="login-page.php" id="login-button" class="btn btn-primary" role="button">Login</a></li>
			</ul>

		</div>

	</div>

<!-- validate??? -->
	<div class="container body-container">
		<div class="row list-restaurants">
			<div class="col-md-6">
			<p>
				<div id="lat" style="display:none"><?php echo $location["lat"]; ?></div>
				<div id="lng" style="display:none"><?php echo $location["lng"]; ?></div>
				<div id="ref" style="display:none"><?php echo $placeRef; ?></div>
				
				<h2><?php echo $name; ?></h2>
				<?php echo $address; ?> <br>
				<?php echo $phone; ?>
			</p>
				 	
				<h3 id="review">Review</h3>
				<hr>
				<div id="commentsTable">

						

						 <?php
								if ($flag) {
									echo ("<p id='nocomm'>No comments yet.</p>");
								} else {
									for ($i=0; $i<sizeof($comments); $i++) {
										echo ("<div class='media'>
							                    <div class='media-body'>
							                        <h4 class='media-heading'>Anonymous
							                            <small>May 27, 2014 at 2:30 PM</small>
							                        </h4>
							                        <p>
							                      ".$comments[$i]."
							                        </p>
							                      </div>
							                </div>");
									}
								}
							?>
					<div class="well">
						<h4>Leave a Comment:</h4>
						<form>
							<div class="form-group">
								<input type="text" class="form-control" id="comm_text">
							</div>
							<button type="button" class="btn btn-primary" onclick="postComm()">Post</button>
						</form>
						</div>
							
                    
                </div>

					
			</div>
			<div class="col-md-6">
				<div id="rest-maps" class="gmaps"></div>
			</div>
		</div>
	</div>
	<div class="footer">
		<div class="container">
			<p>Copyright Aulia Agung Maulana &copy;2015</p>

		</div>
	</div>
	<script src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjR39wgV-VcCc8kvc8CVawrA32lQTDaV8"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/lightbox.min.js"></script>
    <script src="js/scriptRest.js"></script>
    <script>
	document.getElementById("date").innerHTML = Date();
	</script>

</body>
</html>
