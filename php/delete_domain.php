<?php

// Basic example of PHP script to handle with jQuery-Tabledit plug-in.
// Note that is just an example. Should take precautions such as filtering the input data.

$domain = $_POST['domain'];

include_once 'db_config.php';

mysqli_query($con,"DELETE FROM matches WHERE domain='$domain'");

mysqli_close($con);

?>