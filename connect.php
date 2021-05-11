<?php


$host = "localhost";
$username = "root";
$pass = "root";
$con = mysqli_connect($host, $username, $pass, "attsystem");
mysqli_select_db($con,'attsystem') or die ('Cannot found database');

/*
$servername   = "localhost";
$database = "attsystem";
$username = "root";
$password = "root";
$con = mysqli_connect($servername, $username, $password, $database);
if ($con->connect_error) 
{
   die("Connection failed: " . $con->connect_error);
}*/

//mysql_connect('localhost','root','root') or die('Cannot connect to server');
//mysql_select_db('attsystem') or die ('Cannot found database');

?>