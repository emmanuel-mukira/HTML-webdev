<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require 'db_connect.php';

$sql = "SELECT CategoryID, CategoryName FROM Categories";
$result = $conn->query($sql);

$categories = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}

echo json_encode($categories);

$conn->close();

