<?php
$servername = "localhost";
$user = "root";
$password = "shigi460";
$dbname = "recipes";

// Create connection
$conn = mysqli_connect($servername, $user, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
