<?php
session_start();
require 'getRest.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Restaurant [admin]</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/lightbox.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/timer.js"></script>
</head>
<body>
	
	<div class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<a href='index.php' class='navbar-brand'>My Restaurant </a> 
			<ul class="nav navbar-nav navbar-right">
				<li><a href="index.php">Home</a></li>
				<li><a href="#">About Us</a></li>
				<li><a href="#">Contact Us</a></li>
				
				<?php
					if(isset($_SESSION["username"])){
						echo "<li><a href=\"logout.php\" id=\"login-button\" class=\"btn btn-primary\" role=\"button\">Logout</a></li>";
					}else{

						// echo "<li><a href=\"login-page.php\" id=\"login-button\" class=\"btn btn-primary\" role=\"button\">Login</a></li>";
						header("Location: login-page.php");
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
				<h3>List of Restaurants</h3>


		        <table class="table table-bordered">
		          <thead>
		          <tr>
		            <td><b>Name</b></td>
		            <td></td>
		            <td></td>
		          </tr>
		          </thead>
		          <tbody>
	         
 					<?php
						for ($i=0; $i < count($RESTAURANTS); $i++) {
							echo("<tr>");
							echo("<td>".$RESTAURANTS[$i][0]."</td>");
							echo("<td><button id='edit".$i."' onclick='editDesc('edit".$i."')'' type='button' class='btn btn-primary btn-sm'data-toggle='modal' data-target='#modal-edit'>Edit</button></td>");
							echo("<td><button id='remove".$i."' onclick='editDesc('remove".$i."')'' type='button' class='btn btn-primary btn-sm'data-toggle='modal' data-target='#modal-delete'>Remove</button></td>");
							echo("</tr>");
						}
					?>

		            
		          </tbody>    
		        </table>  
		        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-add">Add</button>

		         
		
			</div>
			<div class="col-md-4">
				<h3>Restaurant</h3>
				
			<?php
			echo ("<p class='hide' id='numRestaurants'>".count($RESTAURANTS)."</p>");
			echo ("
						<p id='latitude".$i."' class='hide'>".$RESTAURANTS[$i][5]."</p>
						<p id='longitude".$i."' class='hide'>".$RESTAURANTS[$i][6]."</p>

					");
				for ($i = 0; $i < count($RESTAURANTS); $i++) {
					echo ("
								<div class='row restaurant'>
								<div class='col-md-2 col-xs-2 marker'>
										<img class='img-responsive' src='img/marker/red_Marker".$i.".png'>
								</div>
								<div class='col-md-6 col-xs-8'>
										<p>
										<b>".$RESTAURANTS[$i][0]."</b><br>
										".$RESTAURANTS[$i][1]."<br>
										".$RESTAURANTS[$i][2]."<br>
										latitude : ".$RESTAURANTS[$i][5]." <br>
										longitude : ".$RESTAURANTS[$i][6]." <br>
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

		
		<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="ModalLabel">Edit</h4>
		      </div>

		      <div class="modal-body">
		       <form class="form-horizontal" method="POST" id="submitForm" action="editRest.php">
				  <div class="form-group">
				    <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="inputName" name="inputName">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="inputEmail3" class="col-sm-2 control-label">Address</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="inputAddress" name="inputAddress">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="inputEmail3" class="col-sm-2 control-label">Contact</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="inputContact" name="inputContact">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="inputEmail3" class="col-sm-2 control-label">Images</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="inputImage" name="inputImage">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="inputEmail3" class="col-sm-2 control-label">Latitude</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="inputLatitude" name="inputLatitude">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="inputEmail3" class="col-sm-2 control-label">Longitude</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="inputLongitude" name="inputLongitude">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="inputPassword3" class="col-sm-2 control-label">Description</label>
				    <div class="col-sm-10">
				      <input class="form-control" id="inputDesc" name="inputDesc">
				       <input type="hidden" name="ids" id="ids">
				    </div>
				  </div>
				  <div class="pull-right">

					   <button type="reset" class="btn btn-default ">Clear</button>
					   <button type="submit" value="submit" class="btn btn-primary">Save</button>
				  </div>	
				</form>
		      </div>

		      <div class="modal-footer">
		      
		      </div>
		    </div>
		  </div>
		</div>

		<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="ModalLabel">Add</h4>
		      </div>

		      <div class="modal-body">
		       <form class="form-horizontal" method="POST" id="submitAddForm" action="addRest.php">
				  <div class="form-group">
				    <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="addName" name="addName">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="inputEmail3" class="col-sm-2 control-label">Address</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="addAddress" name="addAddress">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="inputEmail3" class="col-sm-2 control-label">Contact</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="addContact" name="addContact">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="inputEmail3" class="col-sm-2 control-label">Images</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="addImage" name="addImage">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="inputEmail3" class="col-sm-2 control-label">Latitude</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="addLatitude" name="addLatitude">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="inputEmail3" class="col-sm-2 control-label">Longitude</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="addLongitude" name="addLongitude">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="inputPassword3" class="col-sm-2 control-label">Description</label>
				    <div class="col-sm-10">
				      <input class="form-control" id="inputDesc" name="addDesc">
				       <input type="hidden" name="addids" id="addids">
				    </div>
				  </div>
				  <div class="pull-right">

					   <button type="reset" class="btn btn-default ">Clear</button>
					   <button type="submit" value="submit" class="btn btn-primary">Save</button>
				  </div>	
				</form>
		      </div>

		      <div class="modal-footer">
		      
		      </div>
		    </div>
		  </div>
		</div>

		<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="ModalLabel">Delete</h4>
		      </div>

		      <div class="modal-body">
		      <p>
		      	Are You Sure ?
		      </p>
		       <form method="POST" id="deleteForm" action="deleteRest.php">
		       <input type="hidden" name="delIndex" id="delIndex">
			
				
				  <div class="pull-right">

					   <button type="button" class="btn btn-default " data-dismiss="modal">No</button>
					   <button type="submit" value="submit" class="btn btn-primary">Remove</button>
				  </div>	
				</form>
		      </div>

		      <div class="modal-footer">
		      
		      </div>
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
var ids;
var showData = [];

function editDesc(id){

}
$(document).ready(function() {
		<?php
		
				for ($i=0; $i < count($RESTAURANTS); $i++) {
				echo ("
					$('#edit".$i."').click(function() {
						$('#inputName').val('".$RESTAURANTS[$i][0]."');
						$('#inputAddress').val('".$RESTAURANTS[$i][1]."');
						$('#inputContact').val('".$RESTAURANTS[$i][2]."');");
				echo ("$('#inputImage').val('");
				//loop for every image link
				for ($j=0; $j < count($RESTAURANTS[$i][4]); $j++) {
					if ($j == (count($RESTAURANTS[$i][4]) - 1)) {
						echo ($RESTAURANTS[$i][4][$j]);
					} else {
						echo ($RESTAURANTS[$i][4][$j].";");
					}
				}
						echo ("');
						$('#inputDesc').val('".$RESTAURANTS[$i][3]."');
						$('#ids').val('".$RESTAURANTS[$i][7]."');
						$('#inputLatitude').val('".$RESTAURANTS[$i][5]."');
						$('#inputLongitude').val('".$RESTAURANTS[$i][6]."');
					});
				");
			}
		?>

		<?php

		for ($i=0; $i < count($RESTAURANTS); $i++){
			echo (" $('#remove".$i."').click(function() {
					$('#delIndex').val('".$RESTAURANTS[$i][7]."');


			});");

		}

		?>

	});
function validateForm() {
	    var a = document.getElementById("inputName").value;
	    if (a == null || a == "") {
	        alert("Name must be filled out");
	        return false;
	    }
	    var b = document.getElementById("inputAddress").value;
	    if (b == null || b == "") {
	        alert("Address must be filled out");
	        return false;
	    }
	    var c = document.getElementById("inputContact").value;
	    if (c == null || c == "") {
	        alert("Contact must be filled out");
	        return false;
	    }
	    var d = document.getElementById("inputDesc").value;
	    if (d == null || d == "") {
	        alert("Description must be filled out");
	        return false;
	    }
	    var e = document.getElementById("inputImage").value;
	    if (e == null || e == "") {
	        alert("Images must be filled out");
	        return false;
	    }
	    var e = document.getElementById("inputLatitude").value;
	    if (e == null || e == "") {
	        alert("Latitude must be filled out");
	        return false;
	    }
	    var e = document.getElementById("inputLongitude").value;
	    if (e == null || e == "") {
	        alert("Longitude must be filled out");
	        return false;
	    }

	    return true;
	}
	function validateAddForm() {
	    var a = document.getElementById("addName").value;
	    if (a == null || a == "") {
	        alert("Name must be filled out");
	        return false;
	    }
	    var b = document.getElementById("addAddress").value;
	    if (b == null || b == "") {
	        alert("Address must be filled out");
	        return false;
	    }
	    var c = document.getElementById("addContact").value;
	    if (c == null || c == "") {
	        alert("Contact must be filled out");
	        return false;
	    }
	    var d = document.getElementById("addDesc").value;
	    if (d == null || d == "") {
	        alert("Description must be filled out");
	        return false;
	    }
	    var e = document.getElementById("addImage").value;
	    if (e == null || e == "") {
	        alert("Images must be filled out");
	        return false;
	    }
	    var e = document.getElementById("addlatitude").value;
	    if (e == null || e == "") {
	        alert("Latitude must be filled out");
	        return false;
	    }
	    var e = document.getElementById("addLongitude").value;
	    if (e == null || e == "") {
	        alert("Longitude must be filled out");
	        return false;
	    }

	    return true;
	}

	
	document.getElementById("submitForm").addEventListener("submit", function(event) {
		// event.preventDefault();
		if (validateForm() == true) {
		} else { 
			event.preventDefault();
		}
	});
	document.getElementById("submitAddForm").addEventListener("submit", function(event) {
		// event.preventDefault();
		if (validateAddForm() == true) {
		} else { 
			event.preventDefault();
		}
	});

</script>


</body>
</html>