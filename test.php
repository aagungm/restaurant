<?php
$username = "infs3202";
$password = "tY8VCDtram8NQa4T";
$hostname = "localhost"; 

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
 or die("Unable to connect to MySQL");
echo "Connected to MySQL<br>";

//select a database to work with
$selected = mysql_select_db("example",$dbhandle) 
  or die("Could not select examples");

//execute the SQL query and return records
$result = mysql_query("SELECT id, model,year FROM cars");

//fetch tha data from the database 
while ($row = mysql_fetch_array($result)) {s
   echo "ID:".$row{'id'}." Name:".$row{'model'}."Year: ". //display the results
   $row{'year'}."<br>";
}
//close the connection
mysql_close($dbhandle);
?>