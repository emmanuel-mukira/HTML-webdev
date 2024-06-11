<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require 'db_connect.php';

$sql = "SELECT UserID, Username FROM Users";
$result = $conn->query($sql);

$users = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

echo json_encode($users);

$conn->close();
