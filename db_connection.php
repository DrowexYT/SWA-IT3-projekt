<?php
$servername = "localhost"; // Replace with your server details
$username = "dovrteld"; // Replace with your database username
$password = "projekt"; // Replace with your database password
$dbname = "dovrteld_herny_databaze"; // Replace with your database name

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>