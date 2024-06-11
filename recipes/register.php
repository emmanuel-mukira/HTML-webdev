<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Fname = $_POST['Fname'];
    $Lname = $_POST['Lname'];
    $UserType = $_POST['UserType'];
    $UserName = $_POST['UserName'];
    $Passwords = password_hash($_POST['Passwords'], PASSWORD_DEFAULT);
    $UserImage = $_FILES['UserImage']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($UserImage);

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES['UserImage']['tmp_name'], $target_file)) {
        
        // Insert user data into the database
        $sql = "INSERT INTO Users (Fname, Lname, UserType, UserImage, UserName, Passwords) VALUES ('$Fname', '$Lname', '$UserType', '$target_file', '$UserName', '$Passwords')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New user registered successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

