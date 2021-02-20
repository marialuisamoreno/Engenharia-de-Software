<?php
$servername = "localhost";
$database = "243444";
$username = "243444";
$password = "Vinicius24";
// Create connection
$DB_connect = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$DB_connect) {
    die("Connection failed: " . mysqli_connect_error());
}
/*
echo "Connected successfully";
mysqli_close($DB_connect); */
?>

