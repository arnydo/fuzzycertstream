<?php




$con = mysqli_connect("mysql","root","testpass","test");
 // Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


?>