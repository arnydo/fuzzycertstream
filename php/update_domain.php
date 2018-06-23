<?php

// Basic example of PHP script to handle with jQuery-Tabledit plug-in.
// Note that is just an example. Should take precautions such as filtering the input data.

$domain = $_POST['domain'];
$matchedto = $_POST['matchedto'];

include 'db_config.php';

mysqli_query($con,"INSERT INTO domains (domain,matchedto) values ('$domain','$matchedto')");

mysqli_close($con);

?>