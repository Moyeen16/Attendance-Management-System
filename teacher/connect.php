<?php

$host = "localhost";
$username = "root";
$pass = "root";
$con = mysqli_connect($host, $username, $pass, "attsystem");
mysqli_select_db($con,'attsystem') or die ('Cannot found database');

?>