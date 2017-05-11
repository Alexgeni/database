<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "faculty";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connectio
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//create db
$result=$conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'faculty'");
if($result->num_rows==0){
  $sql = "CREATE DATABASE faculty";
  $conn->query($sql);
}
$conn->select_db($dbname);
?>
