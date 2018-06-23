<?php

include_once 'db_config.php';

$checkbox = $_POST['domain'];
$action = $_POST['action'];

if ($action == "save"){

for ($i=0; $i<sizeof($checkbox);$i++){
    mysqli_query($con,"INSERT INTO domains (domain) values ('$checkbox[$i]')");
    }
}

elseif ($action == "delete") {
    for ($i=0; $i<sizeof($checkbox);$i++){
    mysqli_query($con,"DELETE FROM matches WHERE domain='$checkbox[$i]'");
    }
}

mysqli_close($con);

?>