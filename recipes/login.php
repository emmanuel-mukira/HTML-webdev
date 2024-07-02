<?php
// Start the session to manage user login state
session_start();

// Include database connection file
require 'db_connect.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get username (email) and password from form data
    $email = $_POST['username']; // Assuming 'username' corresponds to 'Email' field
    $password = $_POST['password'];

    // Prepare SQL statement to fetch user from database using email
    $stmt = $conn->prepare("SELECT UserID, Passwords,UserTypeID,Fname FROM Users WHERE Email = ?");
    $stmt->bind_param("s", $email);

    // Execute query
    $stmt->execute();

    // Bind result variables
    $stmt->bind_result($userID, $hashedPassword,$userTypeID,$firstName);

    // Fetch the user record
    if ($stmt->fetch()) {
        // Verify password
        if (password_verify($password, $hashedPassword)) {
            // Password is correct, log in the user
            $_SESSION['user_id'] = $userID; // Store user ID in session
            $_SESSION['user_type_id']=$userTypeID;
            $_SESSION['firstname']=$firstName;
            header("Location: home.php"); // Redirect to home
            exit();
        } else {
            // Incorrect password
            echo "Incorrect password. Please try again.";
        }
    } else {
        // User not found
        echo "User not found. Please check your credentials.";
    }

    // Close statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>
