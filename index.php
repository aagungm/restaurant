<?php

session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Restaurant</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/lightbox.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/timer.js"></script>
</head>
<body>
	<?php
		
	?>
	<div class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<a href='index.php' class='navbar-brand'>My Restaurant </a>
			<form id="searchForm" class="navbar-form navbar-left">
            <div class="form-group search">
              <input id="searchTxt" type="text" placeholder="Search" name="search_text" class="form-control input-search">
            </div>
  
            <button type="button" class="btn btn-success" id="searchBtn">Search</button>
          </form>
			
			<ul class="nav navbar-nav navbar-right">
				
				<li><a href="index.php">Home</a></li>
				<li><a href="#">About Us</a></li>
				
				
				<?php
					if(isset($_SESSION["username"])){
						echo "<li><a href=\"logout.php\" id=\"login-button\" class=\"btn btn-primary\" role=\"button\">Logout</a></li>";
					}else{

						echo "<li><a href=\"login-page.php\" id=\"login-button\" class=\"btn btn-primary\" role=\"button\">Login</a></li>";
					}
				?>	
			</ul>

		</div>

	</div>

	<div class="container body-container">
		<div class="row">
			<div class="col-md-2 col-md-offset-10">
				<p id="userLocation">
				<?php
					if(isset($_SESSION["username"])){
						echo $_SESSION["username"];
					}else{
						echo "You";
					}
				?>	

				 are at 
				</p>		

			</div>

		</div>

		<div class="row">
			<div class="col-md-8">
				<h3>Location</h3>
				<div id="rest-maps" class="gmaps">
				
				</div> 	
			</div>
			<div class="col-md-4">
				<h3>Restaurant</h3>

				<div id="restaurantsTable">
				</div>

				
			</div>

		</div>
	</div>
	<div class="footer" id="home">
		<div class="container">
			<p>Copyright Aulia Agung Maulana &copy;2015</p>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjR39wgV-VcCc8kvc8CVawrA32lQTDaV8"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/lightbox.min.js"></script>
    <script src="js/script.js"></script>
    <script type="text/javascript">
			$("#searchBtn").click(function() {
				var huuah = $("#searchTxt").val();
				searchPlaces(huuah);
			});
		</script>
  </body>
</html>