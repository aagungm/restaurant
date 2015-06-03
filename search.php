<?php

session_start();
require 'searchRest.php';
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
			<form id="searchForm" class="navbar-form navbar-left" method="GET" action="search.php">
            <div class="form-group search">
              <input type="text" placeholder="Search" name="search_text" class="form-control input-search">
            </div>
  
            <button type="submit" class="btn btn-success" id="searchBtn">Search</button>
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
				<?php
				if (count($RESTAURANTS) == 0) {
							echo("<div class='alert alert-danger' role='alert'>Sorry, no results matching your search were found!</div>");
						}

				for ($i = 0; $i < count($RESTAURANTS); $i++) {

				echo ("<p class='hide' id='numRestaurants'>".count($RESTAURANTS)."</p>");
				echo ("
						<p class='hide' id='latitude".$i."'>".$RESTAURANTS[$i][5]."</p>
						<p class='hide' id='longitude".$i."'>".$RESTAURANTS[$i][6]."</p>

					");
					echo ("
								<div class='row restaurant'>
								<div class='col-md-2 col-xs-2 marker'>
										<img class='img-responsive' src='img/marker/red_Marker".$i.".png'>
								</div>
								<div class='col-md-6 col-xs-8'>
										<p>
										<b id='name".$i."'>".$RESTAURANTS[$i][0]."</b><br>
										".$RESTAURANTS[$i][1]."<br>
										".$RESTAURANTS[$i][2]."<br>
										</p>
										<p id='des".$i."' class='description'>
										".$RESTAURANTS[$i][3]."<br>
										</p>
										<a class='btn btn-primary toggle' target='".$i."'>Show More</a>
								</div>
								<div class='col-md-2 col-xs-2'>
						
							");

					for ($j = 0; $j < count($RESTAURANTS[$i][4]); $j++) {

						if ($j==0){
								echo ("
								<a href='img/restaurants/".$RESTAURANTS[$i][4][$j]."' data-lightbox='".$RESTAURANTS[$i][0]."' data-title='".$RESTAURANTS[$i][0]."'>
									<img src='img/restaurants/".$RESTAURANTS[$i][4][$j]."' alt=''>
								</a>

									");
							}else{
								echo ("

								<a href='img/restaurants/".$RESTAURANTS[$i][4][$j]."' data-lightbox='".$RESTAURANTS[$i][0]."' data-title='".$RESTAURANTS[$i][0]."'></a>
								

									");
							}
					}


								
						echo ("
									</div>
								</div>

							");
				}
				// end if

				?>


				
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
  </body>
</html>