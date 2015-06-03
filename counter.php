<?php
	//DB values and credentials, import from db_config.php
	require_once('db_config.php');
	//init variables
	$count = 0;
	$url = $_SERVER['REQUEST_URI'];
	//connect to db
	$db = mysqli_connect(DBSERVER, DBUSER, DBPASS, DATABASE)
		or die("Unable to connect to MySQL");

	//query db to get visitor counter data
	$query = "SELECT * FROM `counter`";
	$result = mysqli_query($db, $query);
	// if got value
	if (mysqli_num_rows($result) > 0) {
		//get result and store values in variables
		$row = mysqli_fetch_row($result);
		$count = $row[1];
		$count = intval($count) + 1;
		//update counter value
		$query = "UPDATE `counter` SET `counts`=$count WHERE `id`='1'";
		$result = mysqli_query($db, $query);
	} else {
		die ("Something wrong with the MySQL database");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>My Restaurant</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/lightbox.css">
		<link rel="stylesheet" href="css/style.css">
		<script src="js/timer.js"></script>
	</head>

	<body>
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
		<?php
			echo "<h3>Visitor number ".$count."</h3>";
			header("Refresh: 2; URL=$url");
		?>
		</div>
	</div>
	<div class="footer" id="home">
		<div class="container">
			<p>Copyright Aulia Agung Maulana &copy;2015</p>
		</div>
	</div>
	</body>

</html>