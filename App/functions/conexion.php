<?php
session_start();

$serverName = "localhost:3306";
$userName = "root";
$password = "root";
$dbName = "found_it";

//crear conexion 
$conn = mysqli_connect($serverName, $userName, $password, $dbName);

if(mysqli_connect_errno()) {
   exit();
} else {
}
?>