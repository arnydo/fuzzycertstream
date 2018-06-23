<?php

// Basic example of PHP script to handle with jQuery-Tabledit plug-in.
// Note that is just an example. Should take precautions such as filtering the input data.

include_once 'db_config.php';

mysqli_query($con,"TRUNCATE TABLE matches");

mysqli_close($mysqli);

?>