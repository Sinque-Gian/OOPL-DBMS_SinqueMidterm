<?php
$servername = "localhost"; // or your database server
$username = "root"; // replace with your DB username
$password = ""; // replace with your DB password
$dbname = "online_food_delivery"; // replace with your DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
