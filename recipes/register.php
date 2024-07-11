<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Fname = $_POST['Fname'];
    $Lname = $_POST['Lname'];
    $UserType = $_POST['UserType'];
    $Email = $_POST['Email'];
    $Passwords = password_hash($_POST['Passwords'], PASSWORD_DEFAULT);
    $UserImage = $_FILES['UserImage']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($UserImage);

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES['UserImage']['tmp_name'], $target_file)) {
        // Fetch the UserTypeID based on the selected UserType
        $stmt = $conn->prepare("SELECT UserTypeID FROM UserType WHERE UserGroup = ?");
        $stmt->bind_param("s", $UserType);
        $stmt->execute();
        $stmt->bind_result($UserTypeID);
        $stmt->fetch();
        $stmt->close();

        if ($UserTypeID) {
            // Insert user data into the database
            $stmt = $conn->prepare("INSERT INTO Users (Fname, Lname, UserTypeID, UserImage, Email, Passwords) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssisss", $Fname, $Lname, $UserTypeID, $target_file, $Email, $Passwords);

            if ($stmt->execute()) {
                echo "New user registered successfully";

                // Redirect to login.php
                header("Location: login.html");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Invalid user type selected.";
        }

        $conn->close();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
