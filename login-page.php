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

	<div class="container body-container">
	<div class="row">
	<div class="col-md-4 col-md-offset-4">
	<h3>Login</h3>
		<form action="login.php" method="POST">
		  <div class="form-group">
		    <label class="sr-only" for="username">Email address</label>
		    <input type="text" class="form-control" id="username" placeholder="Username" name="username">
		  </div>
		  <div class="form-group">
		    <label class="sr-only" for="Password">Password</label>
		    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
		  </div>
		  <?php
			  	if(isset($_SESSION["errorMessage"])){
			  		echo ("<p class=\"errorForm\">{$_SESSION["errorMessage"]} </p>");
			  	}
			  ?>
		<div class="form-group">
		<div class="row">
			<p class="col-sm-8">Stay logged in for: </p>
			<div class="col-sm-4">
			<select class="form-control" id="timer" name="timer">
				 <option value="10">10 sec</option>
				 <option value="86400">1 day</option>
			</select>
			</div>
		</div>		
		</div>
		   
		  <div class="checkbox">
		    <label>
		      <input type="checkbox"> Remember me
		    </label>
		  </div>
		  <button type="submit" class="btn btn-default">Sign in</button>
		</form>
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

</body>
</html>