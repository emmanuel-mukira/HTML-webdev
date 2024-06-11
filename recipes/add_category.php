<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $CategoryName = $_POST['CategoryName'];

    $sql = "INSERT INTO Categories (CategoryName) VALUES ('$CategoryName')";

    if ($conn->query($sql) === TRUE) {
        echo "New category added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
